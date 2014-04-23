<?php

namespace ITDoors\HaccpBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * PointRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PointRepository extends EntityRepository
{
    /**
     * Returns point info for list
     *
     * @param int[]   $planIds
     * @param mixed[] $filters
     *
     * @return Query
     */
    public function getPointsListQuery($planIds, $filters)
    {
        $sql = $this->createQueryBuilder('p')
            ->select('p.id as id')
            ->addSelect('p.name as name')
            ->addSelect('p.imageLatitude as imageLatitude')
            ->addSelect('p.imageLongitude as imageLongitude')
            ->addSelect('p.mapLatitude as mapLatitude')
            ->addSelect('p.mapLongitude as mapLongitude')
            ->addSelect('contour.color as contourColor')
            ->addSelect('contour.id as contourId')
            ->addSelect('contour.slug as contourSlug')
            ->addSelect('contour.level as contourLevel')
            ->addSelect('PointGroup.id as pointGroupId')
            ->addSelect('plan.type as planType')
            ->leftJoin('p.contour', 'contour')
            ->leftJoin('p.group', 'PointGroup')
            ->leftJoin('p.plan', 'plan')
            ->where('p.planId in (:planIds)')
            ->setParameter(':planIds', $planIds);

        $this->processFilters($sql, $filters);

        return $sql
            ->getQuery();
    }

    /**
     * Processes filters
     *
     * @param QueryBuilder $sql
     * @param mixed[]      $filters
     */
    protected function processFilters($sql, $filters)
    {
        if (isset($filters['serviceId']) && $filters['serviceId']) {
            $sql
                ->andWhere('contour.id = :serviceId')
                ->setParameter(':serviceId', $filters['serviceId']);
        }

        if (isset($filters['daterangecustom']['start']) &&
            isset($filters['daterangecustom']['end']) &&
            $filters['daterangecustom']['start'] &&
            $filters['daterangecustom']['end']) {
            $sql
                ->addSelect('(
                    SELECT
                        AVG(to_integer(ps.value))
                    FROM
                        ITDoorsHaccpBundle:PointStatistics ps
                    WHERE
                        ps.pointId = p.id AND
                        ps.entryDate >= :startDate AND
                        ps.entryDate <= :endDate
                     ) as pointAVG')
                ->setParameter(':startDate', $filters['daterangecustom']['start'])
                ->setParameter(':endDate', $filters['daterangecustom']['end']);
        } else {
            $sql
                ->addSelect('(
                    SELECT
                        AVG(to_integer(ps.value))
                    FROM
                        ITDoorsHaccpBundle:PointStatistics ps
                    WHERE
                        ps.pointId = p.id
                     ) as pointAVG');
        }

        if (isset($filters['contourId']) && $filters['contourId']) {
            $contourIds = explode(',', $filters['contourId']);

            $sql
                ->andWhere('contour.id in (:contourIds)')
                ->setParameter(':contourIds', $contourIds);
        }
    }

    /**
     * Return point data for ajax show
     *
     * @param int[] $pointIds
     *
     * @return Query
     */
    public function getPointShowQuery($pointIds)
    {
        return $this->createQueryBuilder('p')
            ->select('p.id as id')
            ->addSelect('p.name as name')
            ->addSelect('p.installationDate as installationDate')
            ->addSelect('p.imageLatitude as imageLatitude')
            ->addSelect('p.imageLongitude as imageLongitude')
            ->addSelect('p.mapLatitude as mapLatitude')
            ->addSelect('p.mapLongitude as mapLongitude')
            ->addSelect('PointGroup.name as groupName')
            ->addSelect('contour.color as contourColor')
            ->addSelect('contour.name as contourName')
            ->addSelect('contour.level as contourLevel')
            ->addSelect('plan.name as objectName')
            ->addSelect('plan.type as planType')
            ->addSelect('status.id as statusId')
            ->addSelect('status.name as statusName')
            ->leftJoin('p.contour', 'contour')
            ->leftJoin('p.group', 'PointGroup')
            ->leftJoin('p.plan', 'plan')
            ->leftJoin('p.status', 'status')
            ->where('p.id in (:pointIds)')
            ->setParameter(':pointIds', $pointIds)
            ->getQuery();
    }

    /**
     * Return point statistic query for show
     *
     * @param int[]     $ids
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     *
     * @return Query
     */
    public function getPointStatisticQuery($ids, $startDate, $endDate)
    {

    }

    /**
     * Returns data for ApiV1Get
     *
     * @param int[] $ids
     *
     * @return mixed[]
     */
    public function ApiV1Get($ids)
    {
        $sql = $this->createQueryBuilder('p')
            ->select('p.id as id')
            ->addSelect('p.name as number')
            ->addSelect('PointGroup.id as groupId')
            ->addSelect('PointGroup.name as groupName')
            ->addSelect('plan.id as planId')
            ->addSelect('plan.name as planName')
            ->addSelect('contour.name as contourName')
            ->addSelect('contour.id as contourId')
            ->addSelect('p.installationDate as installationDate')
            ->addSelect('status.id as statusId')
            ->addSelect('status.slug as statusSlug')
            ->addSelect('status.name as statusName')
            ->leftJoin('p.group', 'PointGroup')
            ->leftJoin('p.plan', 'plan')
            ->leftJoin('p.contour', 'contour')
            ->leftJoin('p.status', 'status');

        $sql->where('p.id in (:ids)')
            ->setParameter(':ids', $ids);

        return $sql
            ->getQuery()
            ->getResult();
    }

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
