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
        $this->rubrep = $this->getDoctrine()->getRepository('\Quiz\QuizBundle\Entity\Rubrique');
        $this->catrep = $this->getDoctrine()->getRepository('\Quiz\QuizBundle\Entity\Category');
        
        $this->importRubriques();
        $this->em->flush();
        
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

                // Quand le gabarit n'a pas de rubrique parente, deux cas sont 
                // possibles : 
                // - soit c'est une vraie rubrique de premier niveau (d'où le 
                //   tableau harcodé) ; 
                // - soit c'est une erreur et on se met sous Autres (21). 
                if($r['ID_PARENT'] == 0)
                    if(in_array($r['ID_RUBRIQUE'], array(1, 4, 8, 13, 20, 30, 42, 54, 86, 88, 89, 90)))
                        $en->setParent(0);
                    else
                        $en->setParent(21);
                else
                    $en->setParent($r['ID_PARENT']);
                
                $this->em->persist($en);
            }
        }
    }
    
    private function importCategories()
    {
        try
        {
            $this->root = $this->catrep->getRootNodesQuery()->setMaxResults(1)->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e)
        {
            $rub = $this->rubrep->findOneById(1);
            $this->root = new Category();
            $this->root->setRubrique($rub);
            $this->root->setTitle($rub->getName());
            $this->em->persist($rub);
        }
        
        $rubs = $this->rubrep->findAll();
        
        foreach($rubs as $r)
        {
            
        }
    }
    /*
    private function importCategories($bis = false)
    {
        $rbs = $this->rubrep->findAll(); 
        
        $find = $this->catrep->find(1); 
        if((bool) $find)
        {
            $this->root = $find; 
        }
        
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
                $dep = $r->getCategories(); 
                if(count($dep) > 0)
                {
                    $cat = $dep[0]; 
                }
                else
                {
                    $cat = new Category();
                }
                
                $cat->setRubrique($r); 
                $cat->setTitle($r->getName());

                // Le cas de la rubrique bordel Autres. 
                if($r->getId() == 21)
                {
                    $this->autres = &$cat; 
                }

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
                else
                {
                    if($bis)
                    {
                        $rp = $this->rubrep->find($r->getParent());
                        $cp = $rp->getCategories();
                        $cat->setParent($cp[0]); 
                    }
                }

                $this->em->persist($cat); 
            }
        }
    }*/
}
