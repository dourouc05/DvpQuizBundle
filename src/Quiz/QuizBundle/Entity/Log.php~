<?php

namespace Quiz\QuizBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity
 */
class Log
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id; 
    
    /**
     * @ORM\ManyToOne(targetEntity="LogCategory", inversedBy="logs")
     */
    protected $category;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="logs")
     */
    protected $who; 
    
    /**
     * @ORM\Column(type="integer")
     *
     * Identifiant de l'objet changé (type d'objet connu par la catégorie)
     */
    protected $what; 
    
    /**
     * @ORM\Column(type="object")
     *
     * Ancienne valeur
     */
    protected $old; 
    
    /**
     * @ORM\Column(type="object")
     *
     * Nouvelle valeur
     */
    protected $new; 

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
     * Set what
     *
     * @param integer $what
     */
    public function setWhat($what)
    {
        $this->what = $what;
    }

    /**
     * Get what
     *
     * @return integer $what
     */
    public function getWhat()
    {
        return $this->what;
    }

    /**
     * Set old
     *
     * @param object $old
     */
    public function setOld($old)
    {
        $this->old = $old;
    }

    /**
     * Get old
     *
     * @return object $old
     */
    public function getOld()
    {
        return $this->old;
    }

    /**
     * Set new
     *
     * @param object $new
     */
    public function setNew($new)
    {
        $this->new = $new;
    }

    /**
     * Get new
     *
     * @return object $new
     */
    public function getNew()
    {
        return $this->new;
    }

    /**
     * Set category
     *
     * @param Quiz\QuizBundle\Entity\LogCategory $category
     */
    public function setCategory(\Quiz\QuizBundle\Entity\LogCategory $category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return Quiz\QuizBundle\Entity\LogCategory $category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set who
     *
     * @param Quiz\QuizBundle\Entity\User $who
     */
    public function setWho(\Quiz\QuizBundle\Entity\User $who)
    {
        $this->who = $who;
    }

    /**
     * Get who
     *
     * @return Quiz\QuizBundle\Entity\User $who
     */
    public function getWho()
    {
        return $this->who;
    }
}