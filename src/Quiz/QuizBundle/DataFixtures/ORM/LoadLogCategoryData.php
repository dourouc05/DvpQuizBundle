<?php

namespace Quiz\QuizBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\FixtureInterface;
use Quiz\QuizBundle\Entity\LogCategory;
 
class LoadLogEntryData implements FixtureInterface
{
    public function load($manager)
    {
        $cat = new LogCategory();
        $cat->setName('�dition de cat�gorie');
 
        $manager->persist($cat);
        $manager->flush();
    }
}