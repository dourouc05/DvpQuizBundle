<?php

namespace Quiz\QuizBundle\Entity;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class User extends BaseUser
{
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

	public function __construct()
	{
        $this->quiz = new ArrayCollection();
		parent::__construct();
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