<?php

namespace ITDoors\HaccpBundle\Services;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use ITDoors\HaccpBundle\Entity\Point;
use ITDoors\HaccpBundle\Entity\PointRepository;
use ITDoors\HaccpBundle\Entity\PointStatistics;
use ITDoors\HaccpBundle\Entity\PointStatisticsRepository;
use ITDoors\HaccpBundle\Entity\PointStatus;
use ITDoors\HaccpBundle\Entity\PointStatusRepository;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * PointService Class
 */
class PointStatisticsApiV1Service
{
    /**
     * @var Container $container
     */
    protected $container;

    /**
     * @var PointStatisticsRepository $repository
     */
    protected $repository;

    /**
     * @var int
     */
    protected $baseStatisticsLimit;

    /**
     * __construct()
     *
     * @param Container                 $container
     * @param PointStatisticsRepository $repository
     * @param string                    $baseStatisticsLimit
     */
    public function __construct(Container $container, PointStatisticsRepository $repository, $baseStatisticsLimit)
    {
        $this->container = $container;
        $this->repository = $repository;
        $this->baseStatisticsLimit = $baseStatisticsLimit;
    }

    /**
     * Returns last statistics depending on $baseStatisticsLimit
     *
     * @param int $pointId
     *
     * @return mixed[]
     */
    public function getLastStatistics($pointId)
    {
        $statisticOptions = array(
            'pointIds' => array($pointId),
            'limit' => $this->baseStatisticsLimit
        );

        $statistics = $this->repository->getStatistics($statisticOptions);

        return $statistics;
    }

    /**
     * Returns statistics by range
     *
     * @param int       $pointId
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param int       $lastStatisticId
     *
     * @return mixed[]
     */
    public function getRangeStatistics($pointId, $startDate, $endDate, $lastStatisticId = null)
    {
        $statisticOptions = array(
            'pointIds' => array($pointId),
            'startDate' => $startDate,
            'limit' => $this->baseStatisticsLimit + 1
        );

        if (intval($lastStatisticId)) {
            $statisticOptions['lastStatisticId'] = intval($lastStatisticId);
        }

        if ($endDate) {
            $statisticOptions['endDate'] = $endDate;
        }

        $statistics = $this->repository->getStatistics($statisticOptions);

        $this->formatStatistics($statistics);

        $result = $this->formatStatisticsWithMore($statistics);

        return $result;
    }

    /**
     * Returns more statistics less then {lastStatisticsId}
     *
     * @param int $pointId
     * @param int $lastStatisticId
     *
     * @return mixed[]
     */
    public function getMoreStatistics($pointId, $lastStatisticId = null)
    {
        $statisticOptions = array(
            'pointIds' => array($pointId),
            'lastStatisticId' => intval($lastStatisticId),
            'limit' => $this->baseStatisticsLimit + 1
        );

        $statistics = $this->repository->getStatistics($statisticOptions);

        $this->formatStatistics($statistics);

        $result = $this->formatStatisticsWithMore($statistics);

        return $result;
    }

    /**
     * Format Statistics to api output with "show more" param
     *
     * @param mixed[] &$statistics
     *
     * @return mixed[] -1 $statistics element
     */
    public function formatStatisticsWithMore(&$statistics)
    {
        $result = array(
            'more' => false,
            //'entryDate' => null
        );

        if (sizeof($statistics) > $this->baseStatisticsLimit) {
            $result['more'] = true;

            $lastStatisticsIndex = sizeof($statistics) - 1;

            if (isset($statistics[$lastStatisticsIndex])) {

                unset($statistics[$lastStatisticsIndex]);
            }
        }

        $result['statistics'] = $statistics;

        return $result;
    }

    /**
     * Format Statistics to api output
     *
     * @param mixed[] &$statistics
     *
     * @return mixed[]
     */
    public function formatStatistics(&$statistics)
    {
        foreach ($statistics as &$value) {
            $this->formatStatisticsRecord($value);
        }
    }

    /**
     * Format Statistics to api output
     *
     * @param mixed[] &$value
     *
     * @return mixed[]
     */
    public function formatStatisticsRecord(&$value)
    {
        $value['characteristic'] = array();

        $value['characteristic']['id'] = $value['characteristicId'];
        $value['characteristic']['name'] = $value['characteristicName'];
        $value['characteristic']['unit'] = $value['characteristicUnit'];
        $value['characteristic']['criticalValueBottom'] = $value['criticalValueBottom'];
        $value['characteristic']['criticalValueTop'] = $value['criticalValueTop'];

        unset(
            $value['characteristicId'],
            $value['characteristicName'],
            $value['characteristicUnit'],
            $value['criticalValueBottom'],
            $value['criticalValueTop']
        );
    }

    /**
     * Format Statistics to api output after post
     *
     * @param mixed[] &$value
     *
     * @return mixed[]
     */
    public function formatStatisticsRecordShort(&$value)
    {
        unset(

            $value['characteristicName'],
            $value['characteristicUnit'],
            $value['criticalValueBottom'],
            $value['criticalValueTop']
        );
    }

    /**
     * Persists statistics info
     *
     * @param int     $id
     * @param Request $request
     *
     * @return mixed[]
     */
    public function postPointStatistics($id, Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->container->get('doctrine.orm.entity_manager');

        /** @var Form $form */
        $form = $this->container->get('form.factory')->create('pointStatisticsApiForm');

        /** @var PointRepository $pr */
        $pr = $this->container->get('point.repository');

        /** @var Point $point */
        $point = $pr->find($id);

        $form->handleRequest($request);

        /** @var PointStatistics $pointStatistics */
        $pointStatistics = $form->getData();

        // Request data TEMP
        $dataRequest = $request->request->get($form->getName());
        $createdAt = new \DateTime();
        $createdAt->setTimestamp($dataRequest['createdAt']);
        $entryDate = new \DateTime();
        $entryDate->setTimestamp($dataRequest['entryDate']);

        $pointStatistics->setCreatedAt($createdAt);
        $pointStatistics->setEntryDate($entryDate);

        // EOF Request data TEMP

        $pointStatistics->setPoint($point);

        $em->persist($pointStatistics);
        $em->flush();

        $em->refresh($pointStatistics);

        /** @var PointStatisticsRepository $psr */
        $psr = $this->container->get('point.statistics.repository');

        $statisticOptions = array(
            'id' => array($pointStatistics->getId())
        );

        $statisticsQuery = $psr->getDBQuery($statisticOptions);

        /** @var PointStatistics $result */
        $result = $statisticsQuery->getSingleResult(Query::HYDRATE_ARRAY);

        return $result;
    }

    /**
     * Persists status info
     *
     * @param int     $id
     * @param Request $request
     *
     * @return mixed[]
     */
    public function postPointStatus($id, Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->container->get('doctrine.orm.entity_manager');

        /** @var PointRepository $pr */
        $pr = $this->container->get('point.repository');

        /** @var PointStatusRepository $psr */
        $psr = $this->container->get('point.status.repository');

        /** @var Point $point */
        $point = $pr->find($id);

        $requestData = $request->request->get('pointStatusApiForm');

        /** @var PointStatus $status*/
        $status = $psr->find($requestData['statusId']);

        // EOF Request data TEMP

        $point->setStatus($status);

        $em->persist($point);
        $em->flush();

        $em->refresh($point);

        /** @var PointRepository $pr */
        $pr = $this->container->get('point.repository');

        $options = array(
            'id' => $point->getId()
        );

        $dataQuery = $pr->getDBquery($options);

        $data = $dataQuery->getSingleResult(Query::HYDRATE_ARRAY);

        return $data;
    }
}
