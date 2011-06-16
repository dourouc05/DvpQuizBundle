<?php
 
namespace Quiz\QuizBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\FixtureInterface;
use Quiz\QuizBundle\Entity\Answer;
use Quiz\QuizBundle\Entity\Question;
use Quiz\QuizBundle\Entity\Quiz;
use Quiz\QuizBundle\Entity\Category;
 
class LoadAnswerData implements FixtureInterface
{
    private $manager; 
    
    public function load($manager)
    {return; 
        $this->manager = $manager; 
        
        $this->newCategory();
        $this->newQuiz();
        $this->newQuestion();
        
        $this->newAnswer('R1', false);
        $this->newAnswer('R2', true);
        $this->newAnswer('R3', false);
        
        $this->manager->flush();
    }
    
    public function newAnswer($text, $isRight = false, $explanation = "")
    {
        $ans = new Answer();
        $ans->setText($text); 
        $ans->setIsRight($isRight);
        $ans->setExplanation($explanation); 
        $ans->setQuestion($this->quiz);
        $this->manager->persist($ans);
    }
    
    public function newQuestion()
    {
        
    }
    
    public function newQuiz()
    {
        
    }
    
    public function newCategory()
    {
        
    }
 
    public function getOrder()
    {
        return 1; 
    }
}