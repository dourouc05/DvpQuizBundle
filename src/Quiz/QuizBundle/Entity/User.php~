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
     * @ORM\Column(type="string")
     */
    protected $username;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $email;

	public function __construct()
	{
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
}