<?php

namespace ITDoors\HaccpBundle\Services;
use ITDoors\HaccpBundle\Entity\PointStatisticsRepository;

/**
 * PointService Class
 */
class PointStatisticsApiV1Service
{
    /**
     * @var PointStatisticsRepository $repository
     */
    protected $repository;

    /**
     * @var int
     */
    protected $baseStatisticsLimit;

    /**
     * __construct
     */
    public function __construct(PointStatisticsRepository $repository, $baseStatisticsLimit)
    {
        $this->repository = $repository;
        $this->baseStatisticsLimit = $baseStatisticsLimit;
    }

    /**
     * Returns last statistics depending on $baseStatisticsLimit
     *
     * @param int $pointId
     *
     * @return mixed[]
     */
    public function getLastStatistics($pointId)
    {
        $statistics = $this->repository->getLastStatistics($pointId, $this->baseStatisticsLimit);

        return $statistics;
    }
}