<?php

namespace GFS\statistiquesBundle\Repository;

/**
 * OptionDepRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OptionDepRepository extends \Doctrine\ORM\EntityRepository
{
    public function getOptionAtSelectedDept($departement) {
        $qb = $this->createQueryBuilder('Option')
            ->select('Option.id, Option.nom')
            ->where('Option.departement = :departement')
            ->setParameter('departement', $departement)
        ;
        return $qb->getQuery()->getArrayResult();
    }
}
