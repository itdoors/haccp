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

        foreach ($points as $key => &$point)
        {
            $statistics = $this->pointStatisticsApiV1Service->getLastStatistics($point['id']);

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


            foreach ($statistics as &$value)
            {
                $value['characteristic'] = array();

                $value['characteristic']['id'] = $value['characteristicId'];
                $value['characteristic']['name'] = $value['characteristicName'];
                $value['characteristic']['unit'] = $value['characteristicUnit'];
                $value['characteristic']['criticalValueBottom'] = $value['criticalValueBottom'];
                $value['characteristic']['criticalValueTop'] = $value['criticalValueTop'];

                unset(
                    $value['characteristicId'],
                    $value['characteristicName'],
                    $value['characteristicUnit'],
                    $value['criticalValueBottom'],
                    $value['criticalValueTop']
                );
            }

            $point['statistics'] = $statistics;
        }

        return $points;
    }
}