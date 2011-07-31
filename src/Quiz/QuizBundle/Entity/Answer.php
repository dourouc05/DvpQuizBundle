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
    public function __construct()
    {
        $this->deleted = false; 
        $this->isRight = false;
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
    * Question à laquelle appartient cette réponse
    * 
    * @ORM\ManyToOne(targetEntity="Question", inversedBy="answer")
    */
   protected $question; 
    
    /**
     * Texte de la réponse
     * 
     * @ORM\Column(type="string")
     */
    protected $text; 
    
    /**
     * Cette réponse est-elle correcte ?
     * 
     * @ORM\Column(type="boolean")
     */
    protected $isRight; 
    
    /**
     * Explication affichée pour cette réponse à la correction
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
     * @return boolean 
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
     * @return text 
     */
    public function getExplanation()
    {
        return $this->explanation;
    }
}