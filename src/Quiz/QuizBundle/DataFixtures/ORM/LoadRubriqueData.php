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
            $this->newRubrique($row);exit;
        }
    }
    
    private function newRubrique($row)
    {
        if(! $this->check404('http://' . $row['url'] . '/index/rightColumn'))
                // Si pas de portail, on ne peut pas afficher correctement le 
                // template, donc on zappe. 
        {
            return; 
        }
        
        $rb = new Rubrique();
        $rb->setXiti($row['xiti']); 
        $rb->setName((string) $row); 
        $rb->setColonneDroite('http://' . $row['url'] . '/index/rightColumn'); 
        $this->manager->persist($rb);
    }
    
    /**
     *
     * @param URL $url
     * @return boolean true if not 404, false if 404
     */
    private function check404($url)
    {
        return truz; 
    }
 
    public function getOrder()
    {
        return 2; 
    }
}
