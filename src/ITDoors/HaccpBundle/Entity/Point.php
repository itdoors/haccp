<?php

namespace ITDoors\HaccpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Point
 */
class Point
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \ITDoors\HaccpBundle\Entity\CompanyObject
     */
    private $companyObject;

    /**
     * @var \ITDoors\HaccpBundle\Entity\PointGroup
     */
    private $group;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Point
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set companyObject
     *
     * @param \ITDoors\HaccpBundle\Entity\CompanyObject $companyObject
     * @return Point
     */
    public function setCompanyObject(\ITDoors\HaccpBundle\Entity\CompanyObject $companyObject = null)
    {
        $this->companyObject = $companyObject;

        return $this;
    }

    /**
     * Get companyObject
     *
     * @return \ITDoors\HaccpBundle\Entity\CompanyObject 
     */
    public function getCompanyObject()
    {
        return $this->companyObject;
    }

    /**
     * Set group
     *
     * @param \ITDoors\HaccpBundle\Entity\PointGroup $group
     * @return Point
     */
    public function setGroup(\ITDoors\HaccpBundle\Entity\PointGroup $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \ITDoors\HaccpBundle\Entity\PointGroup 
     */
    public function getGroup()
    {
        return $this->group;
    }
    /**
     * @var string
     */
    private $imageLatitude;

    /**
     * @var string
     */
    private $imageLongitude;

    /**
     * @var string
     */
    private $mapLatitude;

    /**
     * @var string
     */
    private $mapLongitude;


    /**
     * Set imageLatitude
     *
     * @param string $imageLatitude
     * @return Point
     */
    public function setImageLatitude($imageLatitude)
    {
        $this->imageLatitude = $imageLatitude;

        return $this;
    }

    /**
     * Get imageLatitude
     *
     * @return string 
     */
    public function getImageLatitude()
    {
        return $this->imageLatitude;
    }

    /**
     * Set imageLongitude
     *
     * @param string $imageLongitude
     * @return Point
     */
    public function setImageLongitude($imageLongitude)
    {
        $this->imageLongitude = $imageLongitude;

        return $this;
    }

    /**
     * Get imageLongitude
     *
     * @return string 
     */
    public function getImageLongitude()
    {
        return $this->imageLongitude;
    }

    /**
     * Set mapLatitude
     *
     * @param string $mapLatitude
     * @return Point
     */
    public function setMapLatitude($mapLatitude)
    {
        $this->mapLatitude = $mapLatitude;

        return $this;
    }

    /**
     * Get mapLatitude
     *
     * @return string 
     */
    public function getMapLatitude()
    {
        return $this->mapLatitude;
    }

    /**
     * Set mapLongitude
     *
     * @param string $mapLongitude
     * @return Point
     */
    public function setMapLongitude($mapLongitude)
    {
        $this->mapLongitude = $mapLongitude;

        return $this;
    }

    /**
     * Get mapLongitude
     *
     * @return string 
     */
    public function getMapLongitude()
    {
        return $this->mapLongitude;
    }
}
