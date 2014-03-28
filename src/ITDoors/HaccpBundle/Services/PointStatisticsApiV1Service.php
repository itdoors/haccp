<?php

namespace ITDoors\HaccpBundle\Services;
use Doctrine\ORM\EntityManager;
use ITDoors\HaccpBundle\Entity\Point;
use ITDoors\HaccpBundle\Entity\PointGroupCharacteristicRepository;
use ITDoors\HaccpBundle\Entity\PointRepository;
use ITDoors\HaccpBundle\Entity\PointStatistics;
use ITDoors\HaccpBundle\Entity\PointStatisticsRepository;
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
     * __construct
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
        $statistics = $this->repository->getLastStatistics($pointId, $this->baseStatisticsLimit);

        return $statistics;
    }

    /**
     * Returns statistics by range
     *
     * @param int $pointId
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     *
     * @return mixed[]
     */
    public function getRangeStatistics($pointId, \DateTime $startDate, \DateTime $endDate)
    {
        $statistics = $this->repository->getRangeStatistics($pointId, $startDate, $endDate);

        $this->formatStatistics($statistics);

        return $statistics;
    }

    /**
     * Format Statistics to api output
     *
     * @param mixed[] $statistics
     *
     * @return mixed[]
     */
    public function formatStatistics(&$statistics)
    {
        foreach ($statistics as &$value)
        {
            $this->formatStatisticsRecord($value);
        }
    }

    /**
     * Format Statistics to api output
     *
     * @param mixed[] $value
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
     * Persists statistics info
     *
     * @param int $id
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

        $statisticsQuery = $psr->getRangeStatisticsQuery($point->getId(), null, null, array($pointStatistics->getId()));

        $result = $statisticsQuery->getSingleResult();

        $this->formatStatisticsRecord($result);

        return $result;
    }
}