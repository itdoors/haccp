<?php

namespace ITDoors\HaccpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Point
 *
 * @ORM\Table(name="point")
 * @ORM\Entity(repositoryClass="ITDoors\HaccpBundle\Entity\PointRepository")
 */
class Point
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="installationDate", type="date", nullable=true)
     */
    private $installationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="imageLatitude", type="string", length=50, nullable=true)
     */
    private $imageLatitude;

    /**
     * @var string
     *
     * @ORM\Column(name="imageLongitude", type="string", length=50, nullable=true)
     */
    private $imageLongitude;

    /**
     * @var string
     *
     * @ORM\Column(name="mapLatitude", type="string", length=50, nullable=true)
     */
    private $mapLatitude;

    /**
     * @var string
     *
     * @ORM\Column(name="mapLongitude", type="string", length=50, nullable=true)
     */
    private $mapLongitude;

    /**
     * @var integer
     *
     * @ORM\Column(name="contour_id", type="integer", nullable=true)
     */
    private $contourId;

    /**
     * @var integer
     *
     * @ORM\Column(name="plan_id", type="integer")
     */
    private $planId;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ITDoors\HaccpBundle\Entity\PointStatistics", mappedBy="Point")
     */
    private $Statistics;

    /**
     * @var \ITDoors\HaccpBundle\Entity\Plan
     *
     * @ORM\ManyToOne(targetEntity="ITDoors\HaccpBundle\Entity\Plan")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="plan_id", referencedColumnName="id")
     * })
     */
    private $Plan;

    /**
     * @var \ITDoors\HaccpBundle\Entity\Contour
     *
     * @ORM\ManyToOne(targetEntity="ITDoors\HaccpBundle\Entity\Contour")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contour_id", referencedColumnName="id")
     * })
     */
    private $Contour;

    /**
     * @var \ITDoors\HaccpBundle\Entity\PointGroup
     *
     * @ORM\ManyToOne(targetEntity="ITDoors\HaccpBundle\Entity\PointGroup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="point_group_id", referencedColumnName="id")
     * })
     */
    private $Group;

    /**
     * @var \ITDoors\HaccpBundle\Entity\PointStatus
     *
     * @ORM\ManyToOne(targetEntity="ITDoors\HaccpBundle\Entity\PointStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     * })
     */
    private $Status;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Statistics = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * __toString()
     */
    public function __toString()
    {
        return $this->getName() . ' ' . $this->getGroup() . ' ' . $this->getContour();
    }

    /**
     * Set Status
     *
     * @param \ITDoors\HaccpBundle\Entity\PointStatus $status
     * @return Point
     */
    public function setStatus(\ITDoors\HaccpBundle\Entity\PointStatus $status = null)
    {
        $this->Status = $status;

        return $this;
    }

    /**
     * Get Status
     *
     * @return \ITDoors\HaccpBundle\Entity\PointStatus 
     */
    public function getStatus()
    {
        return $this->Status;
    }
}
