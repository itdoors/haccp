<?php

namespace ITDoors\HaccpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contour
 */
class Contour
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
    private $color;

    /**
     * @var integer
     */
    private $serviceId;

    /**
     * @var \ITDoors\HaccpBundle\Entity\Service
     */
    private $Service;


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
     * @return Contour
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
     * Set color
     *
     * @param string $color
     * @return Contour
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set serviceId
     *
     * @param integer $serviceId
     * @return Contour
     */
    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;

        return $this;
    }

    /**
     * Get serviceId
     *
     * @return integer 
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * Set Service
     *
     * @param \ITDoors\HaccpBundle\Entity\Service $service
     * @return Contour
     */
    public function setService(\ITDoors\HaccpBundle\Entity\Service $service = null)
    {
        $this->Service = $service;

        return $this;
    }

    /**
     * Get Service
     *
     * @return \ITDoors\HaccpBundle\Entity\Service 
     */
    public function getService()
    {
        return $this->Service;
    }
    /**
     * @var string
     */
    private $slug;


    /**
     * Set slug
     *
     * @param string $slug
     * @return Contour
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * __toString()
     */
    public function __toString()
    {
        return $this->getName();
    }
}
