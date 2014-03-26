<?php

namespace ITDoors\RestBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use ITDoors\HaccpBundle\Services\PointGroupApiV1Service;
use JMS\Serializer\SerializationContext;

/**
 * REST API PointGroup Controller class
 *
 * @author Pavel Pecheny <ppecheny@gmail.com>
 *
 */
class PointGroupController extends FOSRestController
{
    /**
     * @Rest\Get("/{id}/characteristics")
     *
     * @ApiDoc(
     *  description="Returns a collection of PointGroupCharacteristic",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="+\d",
     *          "description"="Point Group Id"
     *      }
     *  },
     *  output={
     *      "class"="ArrayCollection<ITDoors\HaccpBundle\Entity\PointGroupCharacteristic>",
     *      "groups"={"apiFull"}
     *  }
     * )
     */
    public function getCharacteristicsAction($id)
    {
        /** @var PointGroupApiV1Service $pgs*/
        $pgs = $this->container->get('point.group.api.v1.service');

        $data = $pgs->getCharacteristics($id);
        $view = $this->view($data, 200);
        $view->setSerializationContext(SerializationContext::create()->setGroups(array('apiFull')));

        return $this->handleView($view);
    }
}