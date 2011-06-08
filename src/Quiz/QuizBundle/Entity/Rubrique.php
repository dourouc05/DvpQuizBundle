<?php

namespace Quiz\QuizBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Rubrique
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /** 
     * @ORM\Column(name="name", type="string")
     * 
     * Nom de la rubrique
     */
    protected $name; 
    
    /**
     * @ORM\Column(name="coldr", type="string")
     * 
     * URL de la colonne de droite à inclure
     */
    protected $colonneDroite; 
    
    /** 
     * @ORM\Column(name="xiti", type="integer")
     * 
     * Numéro XiTi de la rubrique
     */
    protected $xiti; 

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
}