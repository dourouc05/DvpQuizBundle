<?php

namespace Quiz\QuizBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/** 
 * @ORM\Entity(repositoryClass="Quiz\QuizBundle\Entity\Repository\SoftDeleteRepository")
 * @Gedmo\Loggable
 */
class Question
{
    public function __construct()
    {
        $this->answer = new \Doctrine\Common\Collections\ArrayCollection();
        // On définit les valeurs par défaut, sinon l'ORM plante (colonnes requises)
        $this->deleted = false; 
        $this->multipleAnswers = false;
        $this->explanation = '';
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
     * Quiz auquel appartient cette question
     * 
     * @ORM\ManyToOne(targetEntity="Quiz", inversedBy="question")
     */
    protected $quiz;
    
    /**
     * Tableau de réponses possibles
     * 
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question")
     */
    protected $answer; 
    
    /**
     * Texte de la question posée
     * 
     * @ORM\Column(type="string")
     */
    protected $text; 
    
    /**
     * Peut-on sélectionner plusieurs réponses ?
     * 
     * @ORM\Column(type="boolean")
     */
    protected $multipleAnswers; 
    
    /**
     * Explication affichée en haut de correction
     * 
     * @ORM\Column(type="text")
     */
    protected $explanation; 
    
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

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
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
     * @return string 
     */
    public function getText()
    {
        return $this->text;
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
     * @return boolean 
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
     * @return text 
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
     * @return Quiz\QuizBundle\Entity\Quiz 
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
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAnswer()
    {
        return $this->answer;
    }
    
    public function getAnswers()
    {
        return $this->getAnswer();
    }
}