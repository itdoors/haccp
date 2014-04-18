<?php

namespace ITDoors\RestBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use ITDoors\HaccpBundle\Services\PointApiV1Service;

use ITDoors\HaccpBundle\Services\PointStatisticsApiV1Service;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * REST API Point Controller class
 *
 * @author Pavel Pecheny <ppecheny@gmail.com>
 *
 */
class PointController extends FOSRestController
{
    /**
     * @param string $ids
     *
     * @Rest\Get("/{ids}")
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
     *  output={
     *      "class"="ArrayCollection<ITDoors\HaccpBundle\Entity\Point>",
     *      "groups"={"api"}
     *  }
     * )
     *
     * @return string
     */
    public function getPointAction($ids)
    {
        /** @var PointApiV1Service $ps */
        $ps = $this->container->get('point.api.v1.service');

        $data = $ps->get($ids);
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @param int    $id
     * @param string $startDate
     * @param string $endDate
     * @param int    $lastStatisticId
     *
     * @Rest\Get("/{id}/statistics/{startDate}/{endDate}")
     *
     * @ApiDoc(
     *  description="Returns a collection of PointStatistics",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="+\d",
     *          "description"="Point Id"
     *      },
     *      {
     *          "name"="startDate",
     *          "dataType"="integer",
     *          "requirement"="+\d",
     *          "description"="Start date in unix timestamp"
     *      },
     *      {
     *          "name"="endDate",
     *          "dataType"="integer",
     *          "requirement"="+\d",
     *          "description"="End date in unix timestamp"
     *      }
     *  },
     *  output={
     *      "class"="ArrayCollection<ITDoors\HaccpBundle\Entity\PointStatistics>",
     *      "groups"={"api"}
     *  }
     * )
     *
     * @return string
     */
    public function getPointStatisticsRangeAction($id, $startDate, $endDate, $lastStatisticId = null)
    {
        $startDateU = new \DateTime();
        $endDateU = new \DateTime();

        /** @var PointStatisticsApiV1Service $pss*/
        $pss = $this->container->get('point.statistics.api.v1.service');

        $endDateObject = intval($endDate) ? $endDateU->setTimestamp($endDate) : null;

        $data = $pss->getRangeStatistics($id, $startDateU->setTimestamp($startDate), $endDateObject, $lastStatisticId);
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @param int    $id
     * @param string $startDate
     * @param string $endDate
     * @param int    $lastStatisticId
     *
     * @Rest\Get("/{id}/statistics/{startDate}/{endDate}/{lastStatisticId}")
     *
     * @ApiDoc(
     *  description="Returns a collection of PointStatistics",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="+\d",
     *          "description"="Point Id"
     *      },
     *      {
     *          "name"="startDate",
     *          "dataType"="integer",
     *          "requirement"="+\d",
     *          "description"="Start date in unix timestamp"
     *      },
     *      {
     *          "name"="endDate",
     *          "dataType"="integer",
     *          "requirement"="+\d",
     *          "description"="End date in unix timestamp"
     *      },
     *      {
     *          "name"="lastStatisticId",
     *          "dataType"="integer",
     *          "requirement"="+\d",
     *          "description"="Last Point Id"
     *      }
     *  },
     *  output={
     *      "class"="ArrayCollection<ITDoors\HaccpBundle\Entity\PointStatistics>",
     *      "groups"={"api"}
     *  }
     * )
     *
     * @return string
     */
    public function getPointStatisticsRangeMoreAction($id, $startDate, $endDate, $lastStatisticId)
    {
        return $this->getPointStatisticsRangeAction($id, $startDate, $endDate, $lastStatisticId);
    }

    /**
     * @param int $id
     *
     * @Rest\Get("/{id}/statistics")
     *
     * @ApiDoc(
     *  description="Returns a collection of PointStatistics",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="+\d",
     *          "description"="Point Id"
     *      }
     *  },
     *  output={
     *      "class"="ArrayCollection<ITDoors\HaccpBundle\Entity\PointStatistics>",
     *      "groups"={"api"}
     *  }
     * )
     *
     * @return string
     */
    public function getPointStatisticsAction($id)
    {
        return $this->getPointStatisticsMoreAction($id, null);
    }

    /**
     * @param int $id
     * @param int $lastStatisticId
     *
     * @Rest\Get("/{id}/statistics/{lastStatisticId}")
     *
     * @ApiDoc(
     *  description="Returns a collection of PointStatistics",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="+\d",
     *          "description"="Point Id"
     *      },
     *      {
     *          "name"="lastStatisticId",
     *          "dataType"="integer",
     *          "requirement"="+\d",
     *          "description"="Last Point Id"
     *      }
     *  },
     *  output={
     *      "class"="ArrayCollection<ITDoors\HaccpBundle\Entity\PointStatistics>",
     *      "groups"={"api"}
     *  }
     * )
     *
     * @return string
     */
    public function getPointStatisticsMoreAction($id, $lastStatisticId)
    {
        /** @var PointStatisticsApiV1Service $pss*/
        $pss = $this->container->get('point.statistics.api.v1.service');

        $data = $pss->getMoreStatistics($id, $lastStatisticId);
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @param int     $id
     * @param Request $request
     *
     * @Rest\Post("/{id}/statistics")
     *
     * @ApiDoc(
     *  description="Returns PointStatistic",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="+\d",
     *          "description"="Point Id"
     *      }
     * },
     * input="ITDoors\HaccpBundle\Form\PointStatisticsApiForm",
     * output={
     *      "class"="ITDoors\HaccpBundle\Entity\PointStatistics",
     *      "groups"={"api"}
     *  }
     * )
     *
     * @return string
     */
    public function postPointStatisticsAction($id, Request $request)
    {
        /** @var PointStatisticsApiV1Service $pss*/
        $pss = $this->container->get('point.statistics.api.v1.service');

        $data = $pss->postPointStatistics($id, $request);

        $view = $this->view($data, 201);

        return $this->handleView($view);
    }

    /**
     * @param int     $id
     * @param Request $request
     *
     * @Rest\Post("/{id}/status")
     *
     * @ApiDoc(
     *  description="Returns PointStatistic",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="+\d",
     *          "description"="Point Id"
     *      }
     * },
     * input="ITDoors\HaccpBundle\Form\PointStatusApiForm",
     * output={
     *      "class"="ITDoors\HaccpBundle\Entity\Point",
     *      "groups"={"api"}
     *  }
     * )
     *
     * @return string
     */
    public function postPointStatusAction($id, Request $request)
    {
        /** @var PointStatisticsApiV1Service $pss*/
        $pss = $this->container->get('point.statistics.api.v1.service');

        $data = $pss->postPointStatus($id, $request);

        $view = $this->view($data, 201);

        return $this->handleView($view);
    }
}
