<?php

namespace ITDoors\HaccpBundle\Services;
use ITDoors\HaccpBundle\Entity\PointGroupCharacteristic;
use ITDoors\HaccpBundle\Entity\PointGroupCharacteristicRepository;
use Symfony\Component\DependencyInjection\Container;

/**
 * PointGroupCharacteristicService Class
 */
class PointGroupCharacteristicService
{
    // APPROVED
    const CRITICAL_CHAR_A = 'A';
    // WARNING
    const CRITICAL_CHAR_W = 'W';
    // DANGER
    const CRITICAL_CHAR_D = 'D';
    /**
     * @var PointGroupCharacteristicRepository $repository
     */
    protected $repository;

    /**
     * @var Container $container
     */
    protected $container;

    /**
     * @var mixed $criticalChars
     */
    public static $criticalChars = array(
        self::CRITICAL_CHAR_A => array(
            'color' => '#000000',
            'classNameStatistics' => 'success'
        ),
        self::CRITICAL_CHAR_W => array(
            'color' => '#000000',
            'classNameStatistics' => 'warning'
        ),
        self::CRITICAL_CHAR_D => array(
            'color' => '#000000',
            'classNameStatistics' => 'danger'
        )
    );

    /**
     * __construct()
     *
     * @param PointGroupCharacteristicRepository $repository
     * @param Container                          $container
     */
    public function __construct(PointGroupCharacteristicRepository $repository, Container $container)
    {
        $this->repository = $repository;
        $this->container = $container;
    }

    /**
     * Returns char depending on characteristicId & value
     *
     * @param int   $characteristicId
     * @param mixed $value
     *
     * @return string
     */
    public function getCriticalChar($characteristicId, $value)
    {
        /** @var PointGroupCharacteristic $characteristic*/
        $characteristic = $this->repository->find($characteristicId);

        if (!$characteristic) {
            return self::CRITICAL_CHAR_A;
        }

        if ($value > $characteristic->getCriticalValueTop()) {
            return self::CRITICAL_CHAR_D;
        }

        if ($value > $characteristic->getCriticalValueBottom()) {
            return self::CRITICAL_CHAR_W;
        }

        return self::CRITICAL_CHAR_A;
    }
}
