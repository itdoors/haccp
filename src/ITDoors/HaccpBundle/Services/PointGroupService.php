<?php

namespace ITDoors\HaccpBundle\Services;
use ITDoors\HaccpBundle\Entity\PointGroupRepository;
use Symfony\Component\DependencyInjection\Container;

/**
 * PointGroupService class
 */
class PointGroupService
{
    /**
     * @var PointGroupRepository $repository
     */
    protected $repository;

    /**
     * @var Container $container
     */
    protected $container;

    /**
     * __construct()
     *
     * @param PointGroupRepository $repository
     * @param Container            $container
     */
    public function __construct(PointGroupRepository $repository, Container $container)
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
