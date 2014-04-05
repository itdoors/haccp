<?php

namespace ITDoors\HaccpBundle\Services;
use ITDoors\HaccpBundle\Entity\PointGroupCharacteristicRepository;
use ITDoors\HaccpBundle\Entity\PointStatusRepository;
use Symfony\Component\DependencyInjection\Container;

/**
 * PointStatusApiV1Service Class
 */
class PointStatusApiV1Service
{
    /**
     * @var Container $container
     */
    protected $container;

    /**
     * __construct()
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Returns collection of statuses
     *
     * @return mixed[]
     */
    public function getAll()
    {
        /** @var PointStatusRepository $psr */
        $psr = $this->container->get('point.status.repository');

        $data = $psr->findAll();

        return $data;
    }
}