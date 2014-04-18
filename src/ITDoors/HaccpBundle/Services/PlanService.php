<?php

namespace ITDoors\HaccpBundle\Services;
use Doctrine\ORM\Query;
use ITDoors\HaccpBundle\Entity\Plan;
use ITDoors\HaccpBundle\Entity\PlanRepository;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Routing\Router;

/**
 * PlanService Class
 */
class PlanService
{
    const PLAN_TYPE_MAP = 'map';
    const PLAN_TYPE_IMAGE = 'image';
    const PLAN_TYPE_TAILS = 'tails';

    /**
     * @var Container $container
     */
    protected $container;

    /**
     * @var PlanRepository $repository
     */
    protected $repository;

    /**
     * @var string $uploadDir
     */
    protected $uploadDir;

    /**
     * __construct()
     *
     * @param Container      $container
     * @param PlanRepository $repository
     * @param string         $uploadDir
     */
    public function __construct(Container $container, PlanRepository $repository, $uploadDir)
    {
        $this->container = $container;
        $this->repository = $repository;
        $this->uploadDir = $uploadDir;
    }

    /**
     * Returns formatted plan data for show
     *
     * @param int $id
     *
     * @return mixed
     */
    public function getPlanShow($id)
    {
        /** @var Query $planQuery */
        $planQuery = $this->repository->getForShowQuery(array($id));

        $planShow = $planQuery->getSingleResult();

        $planShow['imageFullPath'] = $this->getImageFullPath($planShow);

        return $planShow;
    }

    /**
     * Returns formatted plan data for show
     *
     * @param int $id
     *
     * @return mixed
     */
    public function getPlanChildren($id)
    {
        /** @var Router $router */
        $router = $this->container->get('router');

        /** @var Query $planQuery */
        $planQuery = $this->repository->getChildrenQuery(array($id));

        $children = $planQuery->getResult();

        foreach ($children as &$child) {
            $child['url'] = $router->generate('plan_show', array('planId' => $child['id']));
        }

        return $children;
    }

    /**
     * Returns plan image full path depending on company & company object
     *
     * @param mixed $planShow
     *
     * @return string
     */
    public function getImageFullPath($planShow)
    {
        return  $this->getUploadDir() . DIRECTORY_SEPARATOR .
                $planShow['companyId'] . DIRECTORY_SEPARATOR .
                $planShow['companyObjectId'] . DIRECTORY_SEPARATOR .
                $planShow['imageSrc'];
    }

    /**
     * Returns plan upload dir
     *
     * @return string
     */
    public function getUploadDir()
    {
        return $this->uploadDir;
    }
}
