<?php

namespace Quiz\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 */
class User implements UserInterface
{
    public function __construct()
    {
        $this->quiz = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct();
    }

    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\generatedValue(strategy="AUTO")
    */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Quiz", mappedBy="user")
     */
    protected $quiz; 
    
    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $username;
    
    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $email;
    
    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $prenom;
    
    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $nom;
    
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
     * @ORM\OneToMany(targetEntity="Role", mappedBy="user")
     */
    protected $roles; 
    
    public function __toString()
    {
        return $this->username; 
    }
    
    public function getPassword()
    {
        return null;
    }
    
    public function getSalt()
    {
        return null;
    }
    
    public function eraseCredentials()
    {
        return;
    }
    
    public function equals(UserInterface $u)
    {
        if(! $u instanceof User)
            return false;
        if($this->username != $u->getUsername())
            return false;
        return true;
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
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set nom
     *
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * Get nom
     *
     * @return string $nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * Get prenom
     *
     * @return string $prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
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

    /**
     * Add role
     *
     * @param Quiz\QuizBundle\Entity\Role $role
     */
    public function addRole(\Quiz\QuizBundle\Entity\Role $role)
    {
        $this->roles[] = $role;
    }

    /**
     * Get roles
     *
     * @return Doctrine\Common\Collections\Collection $role
     */
    public function getRoles()
    {
        return $this->roles;
    }
}