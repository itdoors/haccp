<?php

namespace ITDoors\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * DefaultController
 */
class DefaultController extends Controller
{
    /**
     * indexAction
     *
     * @return string
     */
    public function indexAction()
    {
        return $this->render('ITDoorsDashboardBundle:Default:index.html.twig');
    }
}
