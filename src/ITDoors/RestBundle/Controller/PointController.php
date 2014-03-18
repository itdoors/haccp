<?php

namespace ITDoors\RestBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use ITDoors\HaccpBundle\Services\PointApiService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use ITDoors\HaccpBundle\Services\PointApiV1Service;
use ITDoors\HaccpBundle\Services\PointService;

/**
 * REST API Point Controller class
 *
 * @author Pavel Pecheny <ppecheny@gmail.com>
 *
 */
class PointController extends FOSRestController
{
    /**
     * @Rest\Get("/point/{ids}")
     */
    public function getPointAction($ids)
    {
        /** @var PointApiV1Service $ps*/
        $ps = $this->container->get('point.api.v1.service');

        $data = $ps->get($ids);
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }
}