<?php

namespace Quiz\QuizBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/** 
 * @ORM\Entity(repositoryClass="Quiz\QuizBundle\Entity\Repository\SoftDeleteRepository")
 */
class Quiz
{
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
     * @ORM\Column(type="text")
     * @Gedmo\Sluggable
     * 
     * Le nom du quiz
     */
    protected $name; 
    
    /** 
     * @ORM\Column(type="integer")
     * 
     * Le nombre de visites 
     */
    protected $visits; 
    
    /** 
     * @ORM\Column(type="boolean")
     * 
     * Faut-il afficher les questions liées de manière aléatoire (ordre et choix) ? 
     */
    protected $random; 
    
    /**
     * @ORM\Column(type="integer")
     * 
     * Si le quiz est aléatoire, le nombre de questions à montrer
     */
    protected $questionsToShow; 
    
    /**
     * @ORM\Column(name="category_id", type="integer")
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * 
     * Catégorie du quiz
     */
    protected $category; 
    
    /** 
     * @Gedmo\Slug(updatable=false)
     * @ORM\Column(name="slug", type="string", unique=true) 
     * 
     */
    protected $slug; 
    
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
    
    public function getQuestionsToShow()
    {
        // On ne peut donner un nombre de questions à montrer que si le quiz est aléatoire
        if($this->isRandom())
        {
            return $this->questionsToShow; 
        }
        else
        {
            return -1; 
        }
    }
}