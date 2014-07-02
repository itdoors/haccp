<?php

namespace ITDoors\HaccpBundle\Controller;

use ITDoors\AjaxBundle\Controller\BaseFilterController;
use ITDoors\HaccpBundle\Services\PlanService;
use ITDoors\HaccpBundle\Services\PointService;

/**
 * Class PlanController
 */
class PlanController extends BaseFilterController
{
    /**
     * Execute show action
     *
     * @param int $planId
     *
     * @return string
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
     *
     * @param int $planId
     *
     * @return string
     */
    public function mapAction($planId)
    {
        /** @var PlanService $ps */
        $ps = $this->get('plan.service');

        /** @var PointService $pointService */
        $pointService = $this->get('point.service');

        $plan = $ps->getPlanShow($planId);
        $plan['children'] = $ps->getPlanChildren($planId);

        $filterServiceNamespace = $this->container->getParameter('ajax.filter.namespace.point.service');
        $filterContourNamespace = $this->container->getParameter('ajax.filter.namespace.point.contour');

        $filtersService = $this->getFilters($filterServiceNamespace) ? $this->getFilters($filterServiceNamespace) : array();
        $filtersContour = $this->getFilters($filterContourNamespace) ? $this->getFilters($filterContourNamespace) : array();

        $filters = array_merge($filtersService, $filtersContour);

        $plan['maxClusterZoom'] = $plan['maxZoom'];

        // Temporary hack
        if (isset($filters['clusterization']) && !$filters['clusterization']) {
            $plan['maxClusterZoom'] = -1;
        }
        // eof Temporary hack

        $pointsByContours = $pointService->getPointsList($planId, $filters);

        return $this->render('ITDoorsHaccpBundle:Plan:map.html.twig', array(
            'plan' => $plan,
            'contours' => $pointsByContours
        ));
    }
}
