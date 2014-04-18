<?php

namespace ITDoors\HaccpBundle\Services;
use ITDoors\HaccpBundle\Entity\PointGroupCharacteristicRepository;
use Symfony\Component\DependencyInjection\Container;

/**
 * PointGroupService Class
 */
class PointGroupApiV1Service
{
    /**
     * @var Container $container
     */
    protected $container;

    /**
     * __construct()
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Returns collection of group characteristics
     *
     * @param int $id
     *
     * @return mixed[]
     */
    public function getCharacteristics($id)
    {
        /** @var PointGroupCharacteristicRepository $pgcr */
        $pgcr = $this->container->get('point.group.characteristic.repository');

        $data = $pgcr->getCharacteristicsQueryByGroupId($id);

        return $data->getResult();
    }
}
