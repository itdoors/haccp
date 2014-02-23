<?php

namespace ITDoors\HaccpBundle\Controller;

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
        return $this->render('ITDoorsHaccpBundle:Point:showAjax.html.twig');
    }
}
