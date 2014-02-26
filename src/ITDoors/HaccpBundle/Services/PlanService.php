<?php

namespace ITDoors\HaccpBundle\Services;
use Doctrine\ORM\Query;
use ITDoors\HaccpBundle\Entity\Plan;
use ITDoors\HaccpBundle\Entity\PlanRepository;

/**
 * PlanService Class
 */
class PlanService
{
    const PLAN_TYPE_MAP = 'map';
    const PLAN_TYPE_IMAGE = 'image';

    /**
     * @var PlanRepository $repository
     */
    protected $repository;

    /**
     * @var string $uploadDir
     */
    protected $uploadDir;

    /**
     * __construct
     */
    public function __construct(PlanRepository $repository, $uploadDir)
    {
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