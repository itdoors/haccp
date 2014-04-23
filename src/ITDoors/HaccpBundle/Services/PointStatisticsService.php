<?php

namespace ITDoors\HaccpBundle\Services;
use Doctrine\ORM\EntityManager;
use ITDoors\HaccpBundle\Entity\Point;
use ITDoors\HaccpBundle\Entity\PointGroupCharacteristic;
use ITDoors\HaccpBundle\Entity\PointGroupCharacteristicRepository;
use ITDoors\HaccpBundle\Entity\PointRepository;
use ITDoors\HaccpBundle\Entity\PointStatistics;
use ITDoors\HaccpBundle\Entity\PointStatisticsRepository;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * PointStatisticsService Class
 */
class PointStatisticsService
{
    /**
     * @var PointStatisticsRepository $repository
     */
    protected $repository;

    /**
     * @var Container $container
     */
    protected $container;

    /**
     * __construct()
     *
     * @param PointStatisticsRepository $repository
     * @param Container                 $container
     */
    public function __construct(PointStatisticsRepository $repository, Container $container)
    {
        $this->repository = $repository;
        $this->container = $container;
    }

    /**
     * Add form defaults depending on defaults)
     *
     * @param Form    $form
     * @param mixed[] $defaults
     */
    public function addFormDefaults(Form $form, $defaults)
    {
        /** @var PointService $ps */
        $ps = $this->container->get('point.service');

        $characteristics = $ps->getCharacteristics($defaults['pointId']);

        /** @var PointGroupCharacteristic[] $characteristics */
        foreach ($characteristics as $key => $characteristic) {
            $form
                ->add("characteristicId", 'hidden', array(
                    'data' => $characteristic->getId(),
                    'attr' => array(
                        'class_outer' => 'col-md-0',
                    )
                ))
                ->add("characteristicName", 'text', array(
                    'data' => $characteristic->getName() . ' (' . $characteristic->getUnit() . ')',
                    'attr' => array(
                        'class_outer' => 'col-md-3',
                        'class' => 'form-control',
                    )
                ))
                ->add("value", 'text', array(
                    'attr' => array(
                        'class_outer' => 'col-md-3',
                        'class' => 'form-control',
                        'placeholder' => 'Value'
                    )
                ))
                ->add('entryDate', 'datetime', array(
                    'widget' => 'single_text',
                    'format' => 'dd.MM.yyyy',
                    'attr' => array(
                        'class_outer' => 'col-md-4',
                        'class' => 'form-control',
                        'placeholder' => 'EntryDate (dd.MM.yyyy)'
                    )
                ));
        }
    }

    /**
     * Save form
     *
     * @param Form    $form
     * @param Request $request
     * @param mixed[] $params
     */
    public function saveForm(Form $form, Request $request, $params)
    {
        $data = $form->getData();

        /** @var EntityManager $em */
        $em = $this->container->get('doctrine.orm.entity_manager');

        /** @var PointRepository $pr */
        $pr = $this->container->get('point.repository');

        /** @var PointGroupCharacteristicRepository $pgcr */
        $pgcr = $this->container->get('point.group.characteristic.repository');

        /** @var Point $point */
        $point = $pr->find($data['pointId']);
        /** @var PointGroupCharacteristic $characteristic */
        $characteristic = $pgcr->find($data['characteristicId']);

        $pointStatistics = new PointStatistics();

        $pointStatistics->setPoint($point);
        $pointStatistics->setCharacteristic($characteristic);
        $pointStatistics->setValue($data['value']);
        $pointStatistics->setEntryDate($data['entryDate']);
        $pointStatistics->setCreatedAt(new \DateTime());

        $em->persist($pointStatistics);
        $em->flush();
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
