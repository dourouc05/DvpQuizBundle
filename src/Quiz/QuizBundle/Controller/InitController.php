<?php

namespace Quiz\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Quiz\QuizBundle\Entity\Rubrique;
use Quiz\QuizBundle\Entity\Category;

/**
 * Description of InitController
 *
 * @author Thibaut
 */
class InitController extends Controller
{
    private $root;
    private $autres;
    private $rubrep;
    private $catrep;
    
    public function importRubriquesAction()
    {
        $this->em = $this->getDoctrine()->getEntityManager();
        $this->rubrep = $this->getDoctrine()->getRepository('QuizQuizBundle:Rubrique');
        $this->catrep = $this->getDoctrine()->getRepository('QuizQuizBundle:Category');
        
        $this->importRubriques();
        $this->importRubriques();
        $this->importCategories();
        
        $this->em->flush();
        
        return $this->render('QuizQuizBundle:Init:index.html.twig');
    }
    
    private function importRubriques()
    {
        // Du gabarit, crée une connexion MySQL qu'on utilise
        require_once($_SERVER['DOCUMENT_ROOT'] . '/template/connexion.php');
        $result = mysql_query('SELECT * FROM RUBRIQUE ORDER BY ID_RUBRIQUE');
        
        // Pour chaque ligne, on vérifie qu'on a les infos nécessaires (sans quoi
        // tout peut planter à l'affichage...), qu'on n'a pas déjà la rubrique en 
        // base, puis seulement on l'ajoute. 
        while($r = mysql_fetch_assoc($result))
        {
            $rb = $this->getDoctrine()->getRepository('QuizQuizBundle:Rubrique')->find($r['ID_RUBRIQUE']);

            // Si la rubrique existe déjà, on vérifie qu'on ne doit rien mettre 
            // à jour. 
            if((bool) $rb)
            {
                if($r['PORTAIL'])
                    $rb->setColonneDroite('http://' . $r['URL'] . '/index/rightColumn');
                if($r['XITISITE'] != 0)
                    $rb->setXiti($r['XITISITE']);
                $this->em->persist($rb);
            }
            else
            {
                $en = new Rubrique();
                $en->setId($r['ID_RUBRIQUE']);
                $en->setName($r['LIB']);

                if($r['PORTAIL'])
                    // Quand pas de portail installé (mégarubriques EDI, Langages, 
                    // etc.), on défaulte sur l'accueil. 
                    $en->setColonneDroite('http://' . $r['URL'] . '/index/rightColumn');
                else
                    $en->setColonneDroite('http://www.developpez.com/index/rightColumn');

                if($r['XITISITE'] == 0)
                    // Quand on n'a pas de XiTi, on se démerde et on défaulte 
                    // sur l'accueil. 
                    $en->setXiti(1);
                else
                    $en->setXiti($r['XITISITE']);

                if($r['ID_PARENT'] == 0 && $r['ID_RUBRIQUE'] != 1)
                    // Seul l'accueil a le droit de ne pas avoir de parent. 
                    $en->setParent(1);
                else
                    $en->setParent($r['ID_PARENT']);
                
                $this->em->persist($en);
            }
        }
    }
    
    private function importCategories()
    {
        $rbs = $this->rubrep->findAll(); 
        
        foreach($rbs as $r)
        {
            // S'il n'y a pas de rubrique racine Accueil, on la crée
            if($r->getId() == 1 && ! $this->root)
            {
                $this->root = new Category();
                $this->root->setRubrique($r); 
                $this->root->setTitle($r->getName());
                $this->em->persist($this->root); 
                
            }
            // On est forcément dans une autre rubrique que l'accueil, traitement 
            // plus normal ; on évacue l'exception si rencontrée, car on lance ce
            // traitement deux fois, pour créer les catégories dont les parents
            // ont un ID supérieur. 
            else
            {
                try
                {
                    $cat = new Category();
                    $cat->setRubrique($r); 
                    $cat->setTitle($r->getName());
                    
                    if($r->getParent() == 0)
                    {
                        // Pour toutes les rubriques de premier niveau, le parent
                        // est l'accueil. 
                        if(in_array($r->getId(), array(4, 8, 13, 20, 30, 42, 54, 86, 88, 89, 90)))
                        {
                            $cat->setParent($this->root); 
                        }
                        // Les autres sont des erreurs du gabarit, donc dans autres, 
                        // si la catégorie a déjà été créée. 
                        elseif($this->autres)
                        {
                            $cat->setParent($this->autres); 
                        }
                        // Sinon, inutile de terminer cet élément, on passe à la 
                        // rubrique suivante. 
                        else
                        {
                            continue; 
                        }
                    }
                    // Le cas de la rubrique bordel Autres. 
                    elseif($r->getId() == 21)
                    {
                        $this->autres = &$cat; 
                    }
                    else
                    {
//                        $rp = $this->rubrep->find($r->getParent());
//                        $cp = $this->catrep->findOneByRubrique($rp); 
//                        $cat->setParent($cp); 
                    }
                    
                    $this->em->persist($cat); 
                    $this->em->flush();
                }
                catch(ErrorException $e)
                {}
            }
        }
    }
}
