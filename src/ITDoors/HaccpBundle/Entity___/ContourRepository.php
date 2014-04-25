<?php

namespace ITDoors\HaccpBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ContourRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContourRepository extends EntityRepository
{
    /**
     * Find contours by ids
     *
     * @param int[] $ids
     *
     * @return Contour[]
     */
    public function findByIds($ids)
    {
        return $this->createQueryBuilder('c')
            ->where('c.id in (:ids)')
            ->setParameter(':ids', $ids)
            ->getQuery()
            ->getResult();
    }

}
