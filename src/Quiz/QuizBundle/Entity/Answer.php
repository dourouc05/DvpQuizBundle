<?php

namespace Quiz\QuizBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/** 
 * @ORM\Entity(repositoryClass="Quiz\QuizBundle\Entity\Repository\SoftDeleteRepository")
 * @Gedmo\Loggable
 */
class Answer
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /** 
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="answer")
     */
    protected $question; 
    
    /**
     * @ORM\Column(type="string")
     */
    protected $text; 
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $isRight; 
    
    /**
     * @ORM\Column(type="text")
     */
    protected $explanation; 

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Get text
     *
     * @return string $text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set isRight
     *
     * @param boolean $isRight
     */
    public function setIsRight($isRight)
    {
        $this->isRight = $isRight;
    }

    /**
     * Get isRight
     *
     * @return boolean $isRight
     */
    public function getIsRight()
    {
        return $this->isRight;
    }

    /**
     * Set explanation
     *
     * @param text $explanation
     */
    public function setExplanation($explanation)
    {
        $this->explanation = $explanation;
    }

    /**
     * Get explanation
     *
     * @return text $explanation
     */
    public function getExplanation()
    {
        return $this->explanation;
    }

    /**
     * Set quiz
     *
     * @param Quiz\QuizBundle\Entity\Question $quiz
     */
    public function setQuestion(\Quiz\QuizBundle\Entity\Question $question)
    {
        $this->question = $question;
    }

    /**
     * Get quiz
     *
     * @return Quiz\QuizBundle\Entity\Question $quiz
     */
    public function getQuestion()
    {
        return $this->question;
    }
}