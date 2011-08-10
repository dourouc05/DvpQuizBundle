<?php

namespace Quiz\QuizBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Role
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\generatedValue(strategy="AUTO")
    */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", length="511")
     */
    protected $description;

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
     * Set name (used internally; eg: ROLE_ADMIN)
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name (used internally; eg: ROLE_ADMIN)
     *
     * @return string $username
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set short description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $descriptione;
    }

    /**
     * Get username
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $description->description;
    }
}