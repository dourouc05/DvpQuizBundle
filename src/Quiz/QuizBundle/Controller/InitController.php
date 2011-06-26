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
    
    public function importRubriquesAction()
    {
        $this->em = $this->getDoctrine()->getEntityManager();
        
        $this->importRubriquesAndCategories();
        
        return $this->render('QuizQuizBundle:Init:index.html.twig');
    }
    
    private function importRubriquesAndCategories()
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
        
        $this->em->flush();
    }
    
    private function doRubrique($r)
    {
        $en = new Rubrique();
        $en->setId($r['ID_RUBRIQUE']);
        $en->setXiti($r['XITISITE']);
        $en->setName($r['LIB']);
        $en->setColonneDroite('http://' . $r['URL'] . '/index/rightColumn');
        $this->em->persist($en);
        
        if(! $this->root && (int) $r['ID_RUBRIQUE'] == 1)
        {
            $this->root = new Category();
            $this->root->setRubrique($en);
            $this->root->setTitle($r['LIB']);
            $this->em->persist($this->root);
        }
    }
}
