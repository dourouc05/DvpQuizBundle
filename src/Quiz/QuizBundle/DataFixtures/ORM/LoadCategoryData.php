<?php
 
namespace Quiz\QuizBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Quiz\QuizBundle\Entity\Category;

/**
 * Description of LoadCategoryData
 *
 * @author Thibaut
 */
class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load($manager)
    {
        $cat = new Category();
        $cat->setTitle('Catégorie principale');
        
        $this->addReference('rub', $cat);
        $this->addReference('cat-princ', $cat);
        
        $manager->persist($cat); 
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 2;
    }
}
