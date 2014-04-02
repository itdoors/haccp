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

        /** @var PointStatisticsApiV1Service $psv1s */
        $psv1s = $this->pointStatisticsApiV1Service;

        $ids = explode(',', $ids);

        $points = $pr->ApiV1Get($ids);

        foreach ($points as $key => &$point)
        {
            $point['plan'] = array();
            $point['plan']['id'] = $point['planId'];
            $point['plan']['name'] = $point['planName'];

            $point['group'] = array();
            $point['group']['id'] = $point['groupId'];
            $point['group']['name'] = $point['groupName'];

            $point['contour'] = array();
            $point['contour']['id'] = $point['contourId'];
            $point['contour']['name'] = $point['contourName'];

            unset(
                $points[$key]['planId'],
                $points[$key]['planName'],
                $points[$key]['groupId'],
                $points[$key]['groupName'],
                $points[$key]['contourId'],
                $points[$key]['contourName']
            );

            /*$statistics = $psv1s->getLastStatistics($point['id']);
            $psv1s->formatStatistics($statistics);*/

            $statistics = $psv1s->getMoreStatistics($point['id']);

            $point['statistics'] = $statistics;
        }

        return $points;
    }
}