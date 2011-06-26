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
    private $catrep;
    
    public function importRubriquesAction()
    {
        $this->em = $this->getDoctrine()->getEntityManager();
        $this->catrep = $this->getDoctrine()->getRepository('QuizQuizBundle:Category');
        
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
            if($r['PORTAIL'] && $r['XITISITE'] && $r['LIB'] && $r['URL'] && $r['ID_RUBRIQUE'])
            {
                $rb = $this->getDoctrine()->getRepository('QuizQuizBundle:Rubrique')->find($r['ID_RUBRIQUE']);
                
                if(! (bool) $rb)
                {
                    $this->doRubrique($r);
                }
            }
        }
    }
    
    private function importCategories()
    {
        $rbs = $this->getDoctrine()->getRepository('QuizQuizBundle:Category')->findAll(); 
        
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
        }
    }
    
    /**
     * Génère toutes les entités pour une rubrique : la rubrique elle-même et 
     * la catégorie associée (racine au besoin). 
     * 
     * @param array $r Une ligne de la table du gabarit
     */
    private function doRubrique($r)
    {
        $en = new Rubrique();
        $en->setId($r['ID_RUBRIQUE']);
        $en->setXiti($r['XITISITE']);
        $en->setName($r['LIB']);
        $en->setColonneDroite('http://' . $r['URL'] . '/index/rightColumn');
        $en->setParent($r['ID_PARENT']);
        $this->em->persist($en);
        
        if(! $this->root && (int) $r['ID_RUBRIQUE'] == 1)
        {
            $this->root = new Category();
            $this->root->setRubrique($en);
            $this->root->setTitle($r['LIB']);
            $this->em->persist($this->root);
        }
        else
        {
            $cat = new Category();
            $cat->setRubrique($en);
            $cat->setTitle($r['LIB']);
            
            if($r['ID_RUBRIQUE'] == 21)
            {
                $this->autres = $cat; 
            }
            
            // Si on a affaire à une rubrique de premier niveau, alors on la 
            // scotche en enfant de Accueil
            if($r['ID_PARENT'] == 0)
            {
                $cat->setParent($this->root);
            }
            else
            {
                // Il est possible que la rubrique parente n'ait pas encore été
                // importée, on met donc cette catégorie de côté pour la créer
                // plus tard
                $parent = $this->catrep->find($r['ID_PARENT']);
                try
                {
                    $cat->setParent($parent);
                }
                catch(ErrorException $e)
                {
                    $this->cats[] = array('rb' => &$en, 
                                          'title' => $r['LIB'], 
                                          'parent' => $r['ID_PARENT']);
                    return;
                }
            }
            
            $this->em->persist($cat);
        }
    }
}
