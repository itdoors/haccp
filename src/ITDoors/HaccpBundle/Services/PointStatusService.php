<?php

namespace ITDoors\HaccpBundle\Services;
use ITDoors\HaccpBundle\Entity\PointStatusRepository;
use Symfony\Component\DependencyInjection\Container;

/**
 * PointStatusService class
 */
class PointStatusService
{
    /**
     * @var PointStatusRepository $repository
     */
    protected $repository;

    /**
     * @var Container $container
     */
    protected $container;

    /**
     * __construct()
     *
     * @param PointStatusRepository $repository
     * @param Container             $container
     */
    public function __construct(PointStatusRepository $repository, Container $container)
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
}
