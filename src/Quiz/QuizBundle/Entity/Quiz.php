<?php

namespace Quiz\QuizBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/** 
 * @ORM\Entity(repositoryClass="Quiz\QuizBundle\Entity\Repository\SoftDeleteRepository")
 * @Gedmo\Loggable
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
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Category")
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
    
    /**
     * @ORM\Column(type="integer")
     * 
     * Auteur du quiz
     */
    protected $author; 
    
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
    
    public function addVisit()
    {
        $this->visits += 1;
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
     * Set deleted
     *
     * @param boolean $deleted
     */
    private function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * Get deleted
     *
     * @return boolean $deleted
     */
    private function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set name
     *
     * @param text $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return text $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set visits
     *
     * @param integer $visits
     */
    private function setVisits($visits)
    {
        $this->visits = $visits;
    }

    /**
     * Get visits
     *
     * @return integer $visits
     */
    public function getVisits()
    {
        return $this->visits;
    }

    /**
     * Set random
     *
     * @param boolean $random
     */
    public function setRandom($random)
    {
        $this->random = $random;
    }

    /**
     * Get random
     *
     * @return boolean $random
     */
    public function getRandom()
    {
        return $this->random;
    }

    /**
     * Set questionsToShow
     *
     * @param integer $questionsToShow
     */
    public function setQuestionsToShow($questionsToShow)
    {
        $this->questionsToShow = $questionsToShow;
        
        if(! $this->random)
        {
            $this->random = true;
        }
    }

    /**
     * Set category
     *
     * @param integer $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return integer $category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }
}