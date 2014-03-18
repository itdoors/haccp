<?php

namespace ITDoors\RestBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use ITDoors\HaccpBundle\Services\PointApiV1Service;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

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
     *
     *
     * @ApiDoc(
     *  description="Returns a collection of Points",
     *  requirements={
     *      {
     *          "name"="ids",
     *          "dataType"="string",
     *          "requirement"="(?:\d,)+\d",
     *          "description"="Point Ids (comma separated)"
     *      }
     *  },
     *  output="ITDoors\RestBundle\Output\Point"
     * )
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