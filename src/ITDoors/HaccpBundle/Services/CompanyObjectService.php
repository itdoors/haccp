<?php

namespace ITDoors\HaccpBundle\Services;
use ITDoors\HaccpBundle\Entity\CompanyObjectRepository;
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
}
