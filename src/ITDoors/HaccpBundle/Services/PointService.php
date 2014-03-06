<?php

namespace ITDoors\HaccpBundle\Services;
use Doctrine\ORM\Query;
use ITDoors\HaccpBundle\Entity\PointRepository;
use ITDoors\HaccpBundle\Entity\PointStatisticsRepository;
use Symfony\Component\DependencyInjection\Container;

/**
 * PointService Class
 */
class PointService
{
    /**
     * @var PointRepository $repository
     */
    protected $repository;

    /**
     * @var Container $container
     */
    protected $container;

    /**
     * __construct
     */
    public function __construct(PointRepository $repository, Container $container)
    {
        $this->repository = $repository;
        $this->container = $container;
    }

    /**
     * Returns formatted point data for list
     *
     * @param int $planId
     *
     * @return mixed
     */
    public function getPointsList($planId)
    {
        /** @var Query $pointQuery */
        $pointQuery = $this->repository->getPointsListQuery(array($planId));

        $pointList = $pointQuery->getResult();

        /** @var PointGroupCharacteristicService $characteristicService */
        $characteristicService = $this->container->get('point.characteristic.service');

        foreach ($pointList as &$point)
        {
            $criticalChar = $characteristicService->getCriticalChar($point['pointGroupId'], $point['pointAVG']);

            $classNameStatistics = PointGroupCharacteristicService::$criticalChars[$criticalChar]['classNameStatistics'];

            $point['classNameStatistics'] = $classNameStatistics;
        }

        return $pointList;
    }

    /**
     * Returns formatted point data for list
     *
     * @param int $planId
     *
     * @return mixed
     */
    public function getPointShow($planId)
    {
        /** @var Query $pointQuery */
        $pointQuery = $this->repository->getPointShowQuery(array($planId));

        $pointShow = $pointQuery->getSingleResult();

        $pointShow['coordinates'] = $this->getCoordinates($pointShow);

        $pointShow['qrCodePath'] = $this->generateQRCode($pointShow);

        return $pointShow;
    }

    /**
     * Returns point coordinates depends on plan type
     *
     * @param mixed[] $pointShow
     *
     * @return string
     */
    public function getCoordinates($pointShow)
    {
        return $pointShow['planType'] == PlanService::PLAN_TYPE_MAP ?
            $this->getMapCoordinates($pointShow) :
            $this->getImageCoordinates($pointShow);
    }

    /**
     * Returns point map coordinates
     *
     * @param mixed[] $pointShow
     *
     * @return string
     */
    public function getMapCoordinates($pointShow)
    {
        return '(' . $pointShow['mapLatitude'] . ', ' . $pointShow['mapLongitude'] . ')';
    }

    /**
     * Returns point map coordinates
     *
     * @param mixed[] $pointShow
     *
     * @return string
     */
    public function getImageCoordinates($pointShow)
    {
        return '(' . $pointShow['imageLatitude'] . ', ' . $pointShow['imageLongitude'] . ')';
    }

    /**
     * Returns point statistics by period
     *
     * @param int $id
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     *
     * @return mixed[]
     */
    public function getStatistics($id, $startDate = null, $endDate = null)
    {
        /** @var PointStatisticsRepository $psr */
        $psr = $this->container->get('point.statistics.repository');

        /** @var Query $statisticsQuery */
        $statisticsQuery = $psr->getStatisticsQuery(array($id), $startDate, $endDate);

        $statistics = $statisticsQuery
            ->getResult();

        foreach ($statistics as &$item)
        {
            $item['color'] = $this->getStatisticsColor($item);
            $item['text'] = $this->getStatisticsText($item);
            $item['className'] = $this->getStatisticsClassName($item);
        }

        return $statistics;
    }

    /**
     * Returns statistics color depending on critical values
     *
     * @param mixed[] $statistics
     *
     * @return string
     */
    public function getStatisticsColor($statistics)
    {
        if ($statistics['value'] > $statistics['criticalValueTop'])
        {
            return $statistics['criticalColorTop'];
        }

        if ($statistics['value'] > $statistics['criticalValueBottom'])
        {
            return $statistics['criticalColorMiddle'];
        }

        return $statistics['criticalColorBottom'];
    }

    /**
     * Returns statistics color depending on critical values
     *
     * @param mixed[] $statistics
     *
     * @return string
     */
    public function getStatisticsClassName($statistics)
    {
        if ($statistics['value'] > $statistics['criticalValueTop'])
        {
            return 'label-danger';
        }

        if ($statistics['value'] > $statistics['criticalValueBottom'])
        {
            return 'label-warning';
        }

        return 'label-success';
    }

    /**
     * Returns statistics color depending on critical values
     *
     * @param mixed[] $statistics
     *
     * @return string
     */
    public function getStatisticsText($statistics)
    {
        $translator = $this->container->get('translator');

        if ($statistics['value'] > $statistics['criticalValueTop'])
        {
            return $translator->trans("Danger", array(), 'messages');
        }

        if ($statistics['value'] > $statistics['criticalValueBottom'])
        {
            return $translator->trans("Warning", array(), 'messages');
        }

        return $translator->trans("Approved", array(), 'messages');
    }

    /**
     * Returns QRCode upload dir
     *
     * @return string
     */
    protected function getQRCodeUploadDir()
    {
        return $this->container->getParameter('qrcode.upload_dir');
    }

    /**
     * Returns QRCode upload dir absolute path
     *
     * @return string
     */
    protected function getQRCodeUploadDirAbsolutePath()
    {
        return $this->container->getParameter('project.web.dir') .
                DIRECTORY_SEPARATOR .
                $this->getQRCodeUploadDir();
    }

    /**
     * Returns QRCode imagePath
     *
     * @param mixed[] $pointShow
     *
     * @return string
     */
    public function getQRCodeImagePath($pointShow)
    {
        return $this->getQRCodeUploadDir() . DIRECTORY_SEPARATOR . "{$pointShow['id']}.png";
    }

    /**
     * Returns QRCode imagePath
     *
     * @param mixed[] $pointShow
     *
     * @return string
     */
    public function getQRCodeImagePathAbsolutePath($pointShow)
    {
        return $this->getQRCodeUploadDirAbsolutePath() . DIRECTORY_SEPARATOR . "{$pointShow['id']}.png";
    }

    /**
     * Generates QRCode img in {qrcode.upload_dir} and returns img_path
     *
     * @param mixed[] $pointShow
     *
     * @return string
     */
    public function generateQRCode($pointShow)
    {
        $imgAbsolutePath = $this->getQRCodeImagePathAbsolutePath($pointShow);
        $imgPath = $this->getQRCodeImagePath($pointShow);

        if (file_exists($imgAbsolutePath))
        {
            unlink($imgAbsolutePath);
        }

        \PHPQRCode\QRcode::png($this->getPointQRCodeInfo($pointShow), $imgAbsolutePath, 'L', 10, 2);

        return $imgPath;
    }

    /**
     * Returns point info for qrcode
     *
     * @param mixed[] $pointShow
     *
     * @return string
     */
    protected function getPointQRCodeInfo($pointShow)
    {
        $pointInfo = array(
            'id' => $pointShow['id']
        );

        return json_encode($pointInfo);
    }
}