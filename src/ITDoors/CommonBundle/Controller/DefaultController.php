<?php

namespace ITDoors\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ITDoorsCommonBundle:Default:index.html.twig', array('name' => $name));
    }
}
