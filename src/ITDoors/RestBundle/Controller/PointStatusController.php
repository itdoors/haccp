<?php

namespace ITDoors\RestBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use ITDoors\HaccpBundle\Services\PointStatusApiV1Service;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * REST API PointGroup Controller class
 *
 * @author Pavel Pecheny <ppecheny@gmail.com>
 *
 */
class PointStatusController extends FOSRestController
{
    /**
     * @Rest\Get("/")
     *
     * @ApiDoc(
     *  description="Returns a collection of PointStatus",
     *  output={
     *      "class"="ArrayCollection<ITDoors\HaccpBundle\Entity\PointStatus>",
     *      "groups"={"apiFull"}
     *  }
     * )
     *
     * @return string
     */
    public function getAction()
    {
        /** @var PointStatusApiV1Service $pss */
        $pss = $this->container->get('point.status.api.v1.service');

        $data = $pss->getAll();
        $view = $this->view($data, 200);
        //$view->setSerializationContext(SerializationContext::create()->setGroups(array('apiFull')));
        return $this->handleView($view);
    }
}
