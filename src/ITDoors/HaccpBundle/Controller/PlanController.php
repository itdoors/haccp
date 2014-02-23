<?php

namespace ITDoors\HaccpBundle\Controller;

use ITDoors\HaccpBundle\Services\PlanService;
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

        $plan = $ps->getPlanShow($id);

        return $this->render('ITDoorsHaccpBundle:Plan:show.html.twig', array(
            'plan' => $plan
        ));
    }
}
