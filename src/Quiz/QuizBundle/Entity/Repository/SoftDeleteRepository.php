<?php

namespace Quiz\QuizBundle\Entity\Repository;

class SoftDeleteRepository extends \Doctrine\ORM\EntityRepository
{
    public function findBy(array $criteria)
    {
        return parent::findBy($this->fixCriteria($criteria));
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
        // À moins que ce ne soit explicitement précisé, on ne veut pas d'enregistrement marqué comme supprimés
        if(!in_array('deleted', $criteria))
        {
            $criteria['deleted'] = false;
        }

        return $criteria;
    }
}