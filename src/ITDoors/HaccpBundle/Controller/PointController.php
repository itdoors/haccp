<?php

namespace ITDoors\HaccpBundle\Controller;

use ITDoors\HaccpBundle\Services\PointService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class PointController
 */
class PointController extends Controller
{
    /**
     * Execute show ajax action
     */
    public function showAjaxAction($id)
    {
        /** @var PointService $pointService */
        $pointService = $this->get('point.service');

        $point = $pointService->getPointShow(array($id));

        return $this->render('ITDoorsHaccpBundle:Point:showAjax.html.twig', array(
            'point' => $point,
        ));
    }

    /**
     * Statistics list
     */
    public function statisticsAjaxAction($id)
    {
        /** @var PointService $pointService */
        $pointService = $this->get('point.service');

        $statistics = $pointService->getStatistics($id);

        return $this->render('ITDoorsHaccpBundle:Point:statistics.html.twig', array(
            'statistics' => $statistics
        ));
    }
}
