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
     * __construct()
     *
     * @param PointRepository             $repository
     * @param PointStatisticsApiV1Service $pointStatisticsApiV1Service
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

        foreach ($points as $key => &$point) {
            $point['plan'] = array();
            $point['plan']['id'] = $point['planId'];
            $point['plan']['name'] = $point['planName'];

            $point['group'] = array();
            $point['group']['id'] = $point['groupId'];
            $point['group']['name'] = $point['groupName'];

            $point['contour'] = array();
            $point['contour']['id'] = $point['contourId'];
            $point['contour']['name'] = $point['contourName'];

            $point['status'] = array();
            $point['status']['id'] = $point['statusId'];
            $point['status']['slug'] = $point['statusSlug'];
            $point['status']['name'] = $point['statusName'];

            unset(
                $points[$key]['planId'],
                $points[$key]['planName'],
                $points[$key]['groupId'],
                $points[$key]['groupName'],
                $points[$key]['contourId'],
                $points[$key]['contourName'],
                $point['statusId'],
                $point['statusSlug'],
                $point['statusName']
            );

            $statistics = $psv1s->getMoreStatistics($point['id']);

            $point['statistics'] = $statistics;
        }

        return $points;
    }
}
