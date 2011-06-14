<?php

namespace Quiz\QuizBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\FixtureInterface;
use Quiz\QuizBundle\Entity\LogCategory;
 
class LoadLogEntryData implements FixtureInterface
{
    private $mgr; 

    public function load($manager)
    {
        $this->mgr = $manager; 
        $this->newCat('Édition de catégorie');
        $this->newCat('Édition de quiz');
        $this->mgr->flush();
    }
    
    private function newCat($name)
    {
        $cat = new LogCategory();
        $cat->setName($name);
 
        $this->mgr->persist($cat);
    }
}