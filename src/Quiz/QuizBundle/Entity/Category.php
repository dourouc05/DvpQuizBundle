<?php

namespace Quiz\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 * @Gedmo\Tree(type="nested") 
 * @Gedmo\Loggable
 * 
 * Simple version, without soft delete: 
 */
class Category
{
    public function __toString()
    {
        return $this->title;
    }
    
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->quiz = new \Doctrine\Common\Collections\ArrayCollection();
        $this->deleted = false; 
    }
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id; 
    
    /** 
     * @ORM\Column(type="string")
     * @Gedmo\Sluggable
     * 
     * Le titre de la catégorie
     */
    protected $title; 
    
    /** 
     * @Gedmo\Slug(updatable=false)
     * @ORM\Column(type="string", unique=true) 
     */
    protected $slug; 
    
    /** 
     * @ORM\ManyToOne(targetEntity="Rubrique", inversedBy="categories")
     */
    protected $rubrique; 
    
    /**
     * @ORM\OneToMany(targetEntity="Quiz", mappedBy="category")
     */
    protected $quiz;
    
    /** 
     * @Gedmo\TreeLeft 
     * @ORM\Column(name="lft", type="integer") 
     */
    protected $lft; 
      
    /** 
     * @Gedmo\TreeLevel 
     * @ORM\Column(name="lvl", type="integer") 
     */
    protected $lvl; 
      
    /** 
     * @Gedmo\TreeRight 
     * @ORM\Column(name="rgt", type="integer") 
     */
    protected $rgt; 
      
    /** 
     * @Gedmo\TreeRoot 
     * @ORM\Column(name="root", type="integer") 
     */
    protected $root; 
      
    /** 
     * @Gedmo\TreeParent 
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children") 
     */
    protected $parent; 
      
    /** 
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent") 
     * @ORM\OrderBy({"lft" = "ASC"}) 
     */
    protected $children; 
    
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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        
        // $log = new Log();
        // $log->
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
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

    /**
     * Set lft
     *
     * @param integer $lft
     */
    public function setLft($lft)
    {
        $this->lft = $lft;
    }

    /**
     * Get lft
     *
     * @return integer $lft
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;
    }

    /**
     * Get lvl
     *
     * @return integer $lvl
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;
    }

    /**
     * Get rgt
     *
     * @return integer $rgt
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param integer $root
     */
    public function setRoot($root)
    {
        $this->root = $root;
    }

    /**
     * Get root
     *
     * @return integer $root
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set rubrique
     *
     * @param Quiz\QuizBundle\Entity\Rubrique $rubrique
     */
    public function setRubrique(\Quiz\QuizBundle\Entity\Rubrique $rubrique)
    {
        $this->rubrique = $rubrique;
    }

    /**
     * Get rubrique
     *
     * @return Quiz\QuizBundle\Entity\Rubrique $rubrique
     */
    public function getRubrique()
    {
        return $this->rubrique;
    }

    /**
     * Set parent
     *
     * @param Quiz\QuizBundle\Entity\Category $parent
     */
    public function setParent(\Quiz\QuizBundle\Entity\Category $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return Quiz\QuizBundle\Entity\Category $parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param Quiz\QuizBundle\Entity\Category $children
     */
    public function addChildren(\Quiz\QuizBundle\Entity\Category $children)
    {
        $this->children[] = $children;
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection $children
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add quiz
     *
     * @param Quiz\QuizBundle\Entity\Quiz $quiz
     */
    public function addQuiz(\Quiz\QuizBundle\Entity\Quiz $quiz)
    {
        $this->quiz[] = $quiz;
    }

    /**
     * Get quiz
     *
     * @return Doctrine\Common\Collections\Collection $quiz
     */
    public function getQuiz()
    {
        return $this->quiz;
    }
}