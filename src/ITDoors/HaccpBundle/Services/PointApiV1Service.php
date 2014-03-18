<?php

namespace ITDoors\HaccpBundle\Services;
use ITDoors\HaccpBundle\Entity\PointRepository;

/**
 * PointService Class
 */
class PointApiV1Service
{
    /**
     * @var PointRepository $repository
     */
    protected $repository;

    /**
     * @var PointStatisticsApiV1Service $pointStatisticsApiV1Service
     */
    protected $pointStatisticsApiV1Service;

    /**
     * __construct
     */
    public function __construct(PointRepository $repository, PointStatisticsApiV1Service $pointStatisticsApiV1Service)
    {
        $this->repository = $repository;

        $this->pointStatisticsApiV1Service = $pointStatisticsApiV1Service;
    }

    /**
     * Returns info for get api method
     *
     * @param string $ids
     *
     * @return mixed[]
     */
    public function get($ids)
    {
        /** @var PointRepository $pr*/
        $pr = $this->repository;

        $ids = explode(',', $ids);

        $points = $pr->ApiV1Get($ids);

        foreach ($points as &$point)
        {
            $statistics = $this->pointStatisticsApiV1Service->getLastStatistics($point['id']);

            $point['statistics'] = $statistics;
        }

        return $points;
    }
}