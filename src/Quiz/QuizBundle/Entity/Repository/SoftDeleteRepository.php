<?php

namespace Quiz\QuizBundle\Entity\Repository;

use Quiz\QuizBundle\Entity\User;

class SoftDeleteRepository extends \Doctrine\ORM\EntityRepository
{
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return parent::findBy($this->fixCriteria($criteria), $orderBy, $limit, $offset);
    }
    
    public function findByWithUser(array $criteria, array $orderBy = null, $limit = null, $offset = null, User $user = null)
    {
        // If user is allowed to see deleted quizzes, let's show him! 
        if(@$user && $user->hasRole('ROLE_QUIZ_SEE_ALL'))
            return parent::findBy($criteria, $orderBy, $limit, $offset);
        else
            return parent::findBy($this->fixCriteria($criteria), $orderBy, $limit, $offset);
    }

    public function findOneBy(array $criteria)
    {
        return parent::findOneBy($this->fixCriteria($criteria));
    }

    public function find($id, $lockMode = \Doctrine\DBAL\LockMode::NONE, $lockVersion = null)
    {
        return $this->findOneBy(array('id' => $id));
    }

    private function fixCriteria(array $criteria)
    {
        // À moins que ce ne soit explicitement précisé, on ne veut pas d'enregistrement marqués comme supprimés
        if(! in_array('deleted', $criteria))
        {
            $criteria['deleted'] = false;
        }

        return $criteria;
    }
}