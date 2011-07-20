<?php

namespace Quiz\QuizBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/** 
 * @ORM\Entity(repositoryClass="Quiz\QuizBundle\Entity\Repository\SoftDeleteRepository")
 ** @Gedmo\Loggable
 */
class Question
{
    public function __construct()
    {
        $this->answer = new \Doctrine\Common\Collections\ArrayCollection();
        $this->deleted = false; 
    }
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $deleted;
    
    /**
     * @ORM\ManyToOne(targetEntity="Quiz", inversedBy="question")
     */
    protected $quiz;
    
    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question")
     */
    protected $answer; 
    
    /**
     * @ORM\Column(type="string")
     */
    protected $question; 
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $multipleAnswers; 
    
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
    
    public function delete()
    {
        $this->deleted = true;
    }
    
    public function undelete()
    {
        $this->deleted = false; 
    }
    
    public function isDeleted()
    {
        return $this->deleted; 
    }
    
    private function setDeleted($deleted)
    {
        $this->deleted = $deleted; 
    }
    
    private function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set question
     *
     * @param string $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * Get question
     *
     * @return string $question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set multipleAnswers
     *
     * @param boolean $multipleAnswers
     */
    public function setMultipleAnswers($multipleAnswers)
    {
        $this->multipleAnswers = $multipleAnswers;
    }

    /**
     * Get multipleAnswers
     *
     * @return boolean $multipleAnswers
     */
    public function getMultipleAnswers()
    {
        return $this->multipleAnswers;
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
     * @param Quiz\QuizBundle\Entity\Quiz $quiz
     */
    public function setQuiz(\Quiz\QuizBundle\Entity\Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    /**
     * Get quiz
     *
     * @return Quiz\QuizBundle\Entity\Quiz $quiz
     */
    public function getQuiz()
    {
        return $this->quiz;
    }

    /**
     * Add answer
     *
     * @param Quiz\QuizBundle\Entity\Answer $answer
     */
    public function addAnswer(\Quiz\QuizBundle\Entity\Answer $answer)
    {
        $this->answer[] = $answer;
    }

    /**
     * Get answer
     *
     * @return Doctrine\Common\Collections\Collection $answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}