<?php

namespace Quiz\QuizBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/** 
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 * @Gedmo\Tree(type="nested") 
 */
class Category
{
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
     * @ORM\Column(name="slug", type="string", unique=true) 
     */
    protected $slug; 
    
    /** 
     * @ORM\ManyToOne(targetEntity="Rubrique")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $rubrique; 
    
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
     * @OneToMany(targetEntity="Category", mappedBy="parent") 
     * @ORM\OrderBy({"lft" = "ASC"}) 
     */
    protected $children; 
}