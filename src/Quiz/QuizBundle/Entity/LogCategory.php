<?php

namespace Quiz\QuizBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity
 */
class LogCategory
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id; 
    
    /**
     * @ORM\OneToMany(targetEntity="Log", mappedBy="category")
     */
    protected $logs;
    
    /**
     * @ORM\Column(type="string")
     *
     * Nom de la catégorie
     */
    protected $name; 
    
    public function __construct()
    {
        $this->logs = new ArrayCollection();
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
     * Add logs
     *
     * @param Quiz\QuizBundle\Entity\Log $logs
     */
    public function addLogs(\Quiz\QuizBundle\Entity\Log $logs)
    {
        $this->logs[] = $logs;
    }

    /**
     * Get logs
     *
     * @return Doctrine\Common\Collections\Collection $logs
     */
    public function getLogs()
    {
        return $this->logs;
    }
}