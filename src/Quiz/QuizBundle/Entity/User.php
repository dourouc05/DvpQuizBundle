<?php

namespace Quiz\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    public function __construct()
    {
        parent::__construct();
        
        $this->quiz = new \Doctrine\Common\Collections\ArrayCollection();
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enabled = true; 
        
        $this->firstName = "";
        $this->name = "";
        
        $this->redaction = false;
        $this->responsable = false;
        $this->administrateur = false;
    }

    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
     * 
     * L'identifiant est voulu par le forum !
    */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Quiz", mappedBy="user")
     */
    protected $quiz; 
    
    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $firstName;
    
    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $name;
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $redaction;
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $responsable;
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $administrateur;
    
    /**
     * @ORM\ManyToMany(targetEntity="Quiz\QuizBundle\Entity\Group")
     */
    protected $groups;

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
     * Set id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Get firstName
     *
     * @return string $firstName
     */
    public function getFirstNames()
    {
        return $this->firstName;
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
     * Set redaction
     *
     * @param boolean $redaction
     */
    public function setRedaction($redaction)
    {
        $this->redaction = $redaction;
    }

    /**
     * Get redaction
     *
     * @return boolean $redaction
     */
    public function getRedaction()
    {
        return $this->redaction;
    }

    /**
     * Set responsable
     *
     * @param boolean $responsable
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;
    }

    /**
     * Get responsable
     *
     * @return boolean $responsable
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set administrateur
     *
     * @param boolean $administrateur
     */
    public function setAdministrateur($administrateur)
    {
        $this->administrateur = $administrateur;
    }

    /**
     * Get administrateur
     *
     * @return boolean $administrateur
     */
    public function getAdministrateur()
    {
        return $this->administrateur;
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