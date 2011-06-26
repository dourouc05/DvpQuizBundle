<?php

namespace Quiz\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Quiz\QuizBundle\Entity\Rubrique;

/**
 * Description of InitController
 *
 * @author Thibaut
 */
class InitController extends Controller
{
    public function importRubriquesAction()
    {
        $this->importRubriques();
        
        return $this->render('QuizQuizBundle:Init:index.html.twig');
    }
    
    private function importRubriques()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        require_once($_SERVER['DOCUMENT_ROOT'] . '/template/connexion.php');
        $result = mysql_query('SELECT * FROM RUBRIQUE ORDER BY ID_RUBRIQUE');
        
        while($r = mysql_fetch_assoc($result))
        {
            if($r['PORTAIL'] && $r['XITISITE'] && $r['LIB'] && $r['URL'] && $r['ID_RUBRIQUE'])
            {
                $rb = $this->getDoctrine()->getRepository('QuizQuizBundle:Rubrique')->find($r['ID_RUBRIQUE']);
                
                if(! (bool) $rb)
                {
                    $en = new Rubrique();
                    $en->setId($r['ID_RUBRIQUE']);
                    $en->setXiti($r['XITISITE']);
                    $en->setName($r['LIB']);
                    $en->setColonneDroite('http://' . $r['URL'] . '/index/rightColumn');
                    $em->persist($en);
                }
            }
        }
        
        $em->flush();
    }
}
