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
     * @param int[] $planIds
     * @param mixed[] $filters
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
            ->addSelect('Contour.color as contourColor')
            ->addSelect('Contour.id as contourId')
            ->addSelect('Contour.slug as contourSlug')
            ->addSelect('PointGroup.id as pointGroupId')
            ->addSelect('Plan.type as planType')
            ->leftJoin('p.Contour', 'Contour')
            ->leftJoin('p.Group', 'PointGroup')
            ->leftJoin('p.Plan', 'Plan')
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
     * @param mixed[] $filters
     *
     */
    protected function processFilters($sql, $filters)
    {
        if (isset($filters['serviceId']) && $filters['serviceId']) {
            $sql
                ->andWhere('Contour.id = :serviceId')
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
        }
        else
        {
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
    }

    /**
     * Return point data for ajax show
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
            ->addSelect('Contour.color as contourColor')
            ->addSelect('Contour.name as contourName')
            ->addSelect('Plan.name as objectName')
            ->addSelect('Plan.type as planType')
            ->leftJoin('p.Contour', 'Contour')
            ->leftJoin('p.Group', 'PointGroup')
            ->leftJoin('p.Plan', 'Plan')
            ->where('p.id in (:pointIds)')
            ->setParameter(':pointIds', $pointIds)
            ->getQuery();
    }

    /**
     * Return point statistic query for show
     *
     * @param int[] $ids
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     *
     * return Query
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
            ->addSelect('Plan.id as planId')
            ->addSelect('Plan.name as planName')
            ->addSelect('Contour.name as contourName')
            ->addSelect('Contour.id as contourId')
            ->addSelect('p.installationDate as installationDate')
            ->leftJoin('p.Group', 'PointGroup')
            ->leftJoin('p.Plan', 'Plan')
            ->leftJoin('p.Contour', 'Contour');

        $sql->where('p.id in (:ids)')
            ->setParameter(':ids', $ids);

        return $sql
            ->getQuery()
            ->getResult();
    }
}
