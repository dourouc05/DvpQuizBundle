<?php

namespace Quiz\QuizBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @Gedmo\Loggable
 */
class Rubrique
{
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    protected $id;
    
    /** 
     * @ORM\Column(type="string")
     * 
     * Nom de la rubrique
     */
    protected $name; 
    
    /**
     * @ORM\Column(type="string")
     * 
     * URL de la colonne de droite à inclure
     */
    protected $colonneDroite; 
    
    /** 
     * @ORM\Column(type="integer")
     * 
     * Numéro XiTi de la rubrique
     */
    protected $xiti; 
    
    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="rubrique")
     */
    protected $categories;
    
    /**
     * @ORM\Column(type="integer")
     * 
     * Rubrique parente dans le gabarit (utilisé exclusivement pour la création
     * des catégories ; après, on l'espère inutile...).
     */
    protected $parent; 

    /**
     * Set id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set colonneDroite
     *
     * @param string $colonneDroite
     */
    public function setColonneDroite($colonneDroite)
    {
        $this->colonneDroite = $colonneDroite;
    }

    /**
     * Get colonneDroite
     *
     * @return string $colonneDroite
     */
    public function getColonneDroite()
    {
        return $this->colonneDroite;
    }

    /**
     * Set xiti
     *
     * @param integer $xiti
     */
    public function setXiti($xiti)
    {
        $this->xiti = $xiti;
    }

    /**
     * Get xiti
     *
     * @return integer $xiti
     */
    public function getXiti()
    {
        return $this->xiti;
    }

    /**
     * Add categories
     *
     * @param Quiz\QuizBundle\Entity\Category $categories
     */
    public function addCategories(\Quiz\QuizBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;
    }

    /**
     * Get categories
     *
     * @return Doctrine\Common\Collections\Collection $categories
     */
    public function getCategories()
    {
        return $this->categories;
    }
    
    /**
     * Set parent
     *
     * @param integer $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return integer $parent
     */
    public function getParent()
    {
        return $this->parent;
    }
}