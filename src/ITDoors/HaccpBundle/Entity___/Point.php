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
     * @var integer
     */
    private $contourId;

    /**
     * @var integer
     */
    private $planId;

    /**
     * @var \ITDoors\HaccpBundle\Entity\Plan
     */
    private $Plan;

    /**
     * @var \ITDoors\HaccpBundle\Entity\Contour
     */
    private $Contour;

    /**
     * @var \ITDoors\HaccpBundle\Entity\PointGroup
     */
    private $Group;


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

    /**
     * Set contourId
     *
     * @param integer $contourId
     * @return Point
     */
    public function setContourId($contourId)
    {
        $this->contourId = $contourId;

        return $this;
    }

    /**
     * Get contourId
     *
     * @return integer 
     */
    public function getContourId()
    {
        return $this->contourId;
    }

    /**
     * Set planId
     *
     * @param integer $planId
     * @return Point
     */
    public function setPlanId($planId)
    {
        $this->planId = $planId;

        return $this;
    }

    /**
     * Get planId
     *
     * @return integer 
     */
    public function getPlanId()
    {
        return $this->planId;
    }

    /**
     * Set Plan
     *
     * @param \ITDoors\HaccpBundle\Entity\Plan $plan
     * @return Point
     */
    public function setPlan(\ITDoors\HaccpBundle\Entity\Plan $plan = null)
    {
        $this->Plan = $plan;

        return $this;
    }

    /**
     * Get Plan
     *
     * @return \ITDoors\HaccpBundle\Entity\Plan 
     */
    public function getPlan()
    {
        return $this->Plan;
    }

    /**
     * Set Contour
     *
     * @param \ITDoors\HaccpBundle\Entity\Contour $contour
     * @return Point
     */
    public function setContour(\ITDoors\HaccpBundle\Entity\Contour $contour = null)
    {
        $this->Contour = $contour;

        return $this;
    }

    /**
     * Get Contour
     *
     * @return \ITDoors\HaccpBundle\Entity\Contour 
     */
    public function getContour()
    {
        return $this->Contour;
    }

    /**
     * Set Group
     *
     * @param \ITDoors\HaccpBundle\Entity\PointGroup $group
     * @return Point
     */
    public function setGroup(\ITDoors\HaccpBundle\Entity\PointGroup $group = null)
    {
        $this->Group = $group;

        return $this;
    }

    /**
     * Get Group
     *
     * @return \ITDoors\HaccpBundle\Entity\PointGroup 
     */
    public function getGroup()
    {
        return $this->Group;
    }
    /**
     * @var \DateTime
     */
    private $installationDate;


    /**
     * Set installationDate
     *
     * @param \DateTime $installationDate
     * @return Point
     */
    public function setInstallationDate($installationDate)
    {
        $this->installationDate = $installationDate;

        return $this;
    }

    /**
     * Get installationDate
     *
     * @return \DateTime 
     */
    public function getInstallationDate()
    {
        return $this->installationDate;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Statistics;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Statistics = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add Statistics
     *
     * @param \ITDoors\HaccpBundle\Entity\PointStatistics $statistics
     * @return Point
     */
    public function addStatistic(\ITDoors\HaccpBundle\Entity\PointStatistics $statistics)
    {
        $this->Statistics[] = $statistics;

        return $this;
    }

    /**
     * Remove Statistics
     *
     * @param \ITDoors\HaccpBundle\Entity\PointStatistics $statistics
     */
    public function removeStatistic(\ITDoors\HaccpBundle\Entity\PointStatistics $statistics)
    {
        $this->Statistics->removeElement($statistics);
    }

    /**
     * Get Statistics
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStatistics()
    {
        return $this->Statistics;
    }

    /**
     * __toString()
     */
    public function __toString()
    {
        return $this->getName() . ' ' . $this->getGroup() . ' ' . $this->getContour();
    }
}
