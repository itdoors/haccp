<?php

namespace ITDoors\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ITDoorsDashboardBundle:Default:index.html.twig');
    }
}
