<?php

namespace Quiz\QuizBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\FixtureInterface;
use Quiz\QuizBundle\Entity\Rubrique;

/**
 * Description of LoadRubriqueData
 *
 * @author Thibaut
 */
class LoadRubriqueData implements FixtureInterface
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
        $xml = new \SimpleXMLElement(file_get_contents('http://www.developpez.com/template/rubrique_xml.php'));
        
        foreach($xml->rubriques->rubrique as $row)
        {
            $this->newRubrique($row);
        }
    }
    
    private function newRubrique($row)
    {
        $rb = new Rubrique();
        $rb->setXiti($row['xiti']); 
        $rb->setName(utf8_decode((string) $row)); 
        $rb->setColonneDroite('http://' . $row['url'] . '/index/rightColumn'); 
        $this->manager->persist($rb);
    }
 
    public function getOrder()
    {
        return 2; 
    }
}
