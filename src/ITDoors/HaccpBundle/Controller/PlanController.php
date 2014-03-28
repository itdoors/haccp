<?php

namespace ITDoors\HaccpBundle\Controller;

use ITDoors\CommonBundle\Controller\BaseFilterController;
use ITDoors\HaccpBundle\Services\PlanService;
use ITDoors\HaccpBundle\Services\PointService;

/**
 * Class PlanController
 */
class PlanController extends BaseFilterController
{
    /**
     * Execute show action
     */
    public function showAction($planId)
    {
        /** @var PlanService $ps */
        $ps = $this->get('plan.service');

        $plan = $ps->getPlanShow($planId);

        return $this->render('ITDoorsHaccpBundle:Plan:show.html.twig', array(
            'plan' => $plan
        ));
    }

    /**
     * Execute map action
     */
    public function mapAction($planId)
    {
        /** @var PlanService $ps */
        $ps = $this->get('plan.service');

        /** @var PointService $pointService */
        $pointService = $this->get('point.service');

        $plan = $ps->getPlanShow($planId);

        $filterNamespace = $this->container->getParameter('ajax.filter.namespace.point.service');

        $filters = $this->getFilters($filterNamespace);

        $pointsByContours = $pointService->getPointsList($planId, $filters);

        return $this->render('ITDoorsHaccpBundle:Plan:map.html.twig', array(
            'plan' => $plan,
            'contours' => $pointsByContours
        ));
    }
}
