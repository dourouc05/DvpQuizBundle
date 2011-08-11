<?php

namespace Quiz\QuizBundle\Entity;

use FOS\UserBundle\Entity\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity
 * @ORM\Table(name="fos_group")
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
     protected $id;
     
     public function setId($id)
     {
         $this->id = $id; 
     }
     
     public function addRoles($roles)
     {
         foreach($roles as $r)
             $this->addRole($r);
     }
}