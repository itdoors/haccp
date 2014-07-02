<?php

namespace ITDoors\HaccpBundle\Services;
use ITDoors\HaccpBundle\Entity\CompanyObject;
use ITDoors\HaccpBundle\Entity\CompanyObjectRepository;
use ITDoors\HaccpBundle\Entity\PointStatistics;
use ITDoors\HaccpBundle\Entity\PointStatisticsRepository;
use Symfony\Component\DependencyInjection\Container;

/**
 * CompanyObjectService class
 */
class CompanyObjectService
{
    /**
     * @var CompanyObjectRepository $repository
     */
    protected $repository;

    /**
     * @var Container $container
     */
    protected $container;

    /**
     * __construct()
     *
     * @param CompanyObjectRepository $repository
     * @param Container               $container
     */
    public function __construct(CompanyObjectRepository $repository, Container $container)
    {
        $this->repository = $repository;
        $this->container = $container;
    }

    /**
     * Returns all data for backup (mobile sync)
     *
     * @return array
     */
    public function getBackupData()
    {
        return $this->repository->getBackupData();
    }

    /**
     * Get Infestation of all point (1,2 contour) for object
     *
     * @param CompanyObject $object
     * @param \DateTime     $date
     *
     * @return int
     */
    public function getInfestation(CompanyObject $object, \DateTime $date)
    {
        /** @var PointStatisticsRepository $cor */
        $cor = $this->container->get('point.statistics.repository');

        $statistics = $cor->getInfestation($object, $date);

        $infestation = $this->getInfestationArray($statistics, $object);

        return $infestation;
    }

    /**
     * @param PointStatistics[] $statistics
     * @param CompanyObject     $object
     *
     * @return mixed[]
     */
    protected function getInfestationArray($statistics, $object)
    {
        $results = array();

        $impermeability = $object->getImpermeability()->getValue();
        $terrain = $object->getTerrain()->getValue();

        foreach ($statistics as $statistic) {

            $year = $statistic->getEntryDate()->format('Y');
            $month = $statistic->getEntryDate()->format('m');
            $day = $statistic->getEntryDate()->format('d');

            $dateTime = new \DateTime();

            $dateTime->setDate($year, $month, $day);

            $date = $dateTime->format('U');

            // @todo remove Temporary hack
            if (intval($statistic->getEntryDate()->format('Y')) < 2013) {
                continue;
            }

            if (!isset($results[$date])) {
                $results[$date] = array();
            }

            $results[$date][] = $statistic->getValue();
        }

        $resultAVR = array();

        foreach ($results as $key => $values) {
            $count = sizeof($values);

            $keyJs = $key * 1000;

            if ($count == 0) {
                $resultAVR[] = array($keyJs, 0);
                continue;
            }

            $valueSum = 0;

            $month = date('m', $key);

            $seasonality = 1;

            if (in_array($month, array(12,1,2))) {
                $seasonality = 1;
            } elseif (in_array($month, array(2,3,5))) {
                $seasonality = 0.5;
            } elseif (in_array($month, array(6,7,8))) {
                $seasonality = 0.75;
            } elseif (in_array($month, array(9,10,11))) {
                $seasonality = 0.4;
            }

            foreach ($values as $value) {
                $valueSum += $value;
            }

            $infestation = round($valueSum / $count) * $seasonality * $impermeability * $terrain;

            $resultAVR[] = array($keyJs, $infestation);
        }

        return $resultAVR;
    }
}
