<?php

namespace ITDoors\HaccpBundle\Services;
use ITDoors\HaccpBundle\Entity\Contour;
use ITDoors\HaccpBundle\Entity\ContourRepository;
use ITDoors\HaccpBundle\Entity\Service;
use ITDoors\HaccpBundle\Entity\ServiceRepository;
use Symfony\Component\DependencyInjection\Container;

/**
 * ContourService class
 */
class ContourService
{
    /**
     * @var ContourRepository $repository
     */
    protected $repository;

    /**
     * @var Container $container
     */
    protected $container;

    /**
     * __construct()
     *
     * @param ContourRepository $repository
     * @param Container         $container
     */
    public function __construct(ContourRepository $repository, Container $container)
    {
        $this->repository = $repository;
        $this->container = $container;
    }

    /**
     * Return service choices
     *
     * @return Contour[]
     */
    public function getServiceChoices()
    {
        /** @var ServiceRepository $sr */

        $sr = $this->container->get('service.repository');

        /** @var Service[] $services */
        $services = $sr->findAll();

        $result = array();

        foreach ($services as $service) {
            $result[$service->getId()] = $service->getName();
        }

        return $result;
    }

    /**
     * Return contour slug choices
     *
     * @return mixed[]
     */
    public function getContourSlugChoices()
    {
        /** @var Contour[] $contours */
        $contours = $this->repository->findAll();

        $result = array();

        foreach ($contours as $contour) {
            $result[$contour->getSlug()] = $contour->getName();
        }

        return $result;
    }

    /**
     * Return contour choices
     *
     * @param int[] $ids
     *
     * @return mixed[]
     */
    public function getContourChoices($ids = array())
    {
        if (sizeof($ids)) {
            $contours = $this->repository->findByIds($ids);
        } else {
            $contours = $this->repository->findAll();
        }

        $result = array();

        /** @var Contour[] $contours */
        foreach ($contours as $contour) {
            $result[] = array(
                'id' => $contour->getId(),
                'text' =>(string) $contour->getName()
            );
        }

        return $result;
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
