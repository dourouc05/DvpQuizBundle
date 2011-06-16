<?php

namespace Quiz\QuizBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\FixtureInterface;
use Quiz\QuizBundle\Entity\Answer;
use Quiz\QuizBundle\Entity\Catefory;

/**
 * Description of LoadRubriqueData
 *
 * @author Thibaut
 */
class LoadRubriqueData
{
    private $manager; 
    
    public function load($manager)
    {
        $this->manager = $manager; 
        
        $this->generateRubriques();
        
        $this->manager->flush();
    }
    
    public function generateRubriques()
    {
        // $xml = file_get_contents('http://www.developpez.com/template/rubrique_xml.php'); 
        require_once($_SERVER['DOCUMENT_ROOT'] . '/template/connexion.php'); 
        $res = mysql_query('SELECT * FROM RUBRIQUE ORDER BY ID_RUBRIQUE');
    }
 
    public function getOrder()
    {
        return 1; 
    }
}
