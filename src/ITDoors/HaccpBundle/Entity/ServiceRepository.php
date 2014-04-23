<?php

namespace ITDoors\HaccpBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ServiceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ServiceRepository extends EntityRepository
{
    /**
     * Returns data for backup
     *
     * @return array
     */
    public function getBackupData()
    {
        return $this->createQueryBuilder('obj')
            ->getQuery()
            ->getArrayResult();
    }
}
