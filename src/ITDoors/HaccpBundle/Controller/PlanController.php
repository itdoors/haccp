<?php

namespace ITDoors\HaccpBundle\Controller;

use ITDoors\HaccpBundle\Services\PlanService;
use ITDoors\HaccpBundle\Services\PointService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class PlanController
 */
class PlanController extends Controller
{
    /**
     * Execute show action
     */
    public function showAction($id)
    {
        /** @var PlanService $ps */
        $ps = $this->get('plan.service');

        /** @var PointService $pointService */
        $pointService = $this->get('point.service');

        $plan = $ps->getPlanShow($id);

        $points = $pointService->getPointsList($id);

        return $this->render('ITDoorsHaccpBundle:Plan:show.html.twig', array(
            'plan' => $plan,
            'points' => $points
        ));
    }
}
