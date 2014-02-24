<?php

namespace ITDoors\HaccpBundle\Services;
use Doctrine\ORM\Query;
use ITDoors\HaccpBundle\Entity\PointRepository;

/**
 * PointService Class
 */
class PointService
{
    /**
     * @var PointRepository $repository
     */
    protected $repository;

    /**
     * __construct
     */
    public function __construct(PointRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Returns formatted point data for list
     *
     * @param int $planId
     *
     * @return mixed
     */
    public function getPointsList($planId)
    {
        /** @var Query $pointQuery */
        $pointQuery = $this->repository->getPointsListQuery(array($planId));

        $pointList = $pointQuery->getResult();

        return $pointList;
    }
}