<?php

namespace ITDoors\HaccpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contour
 *
 * @ORM\Table(name="contour")
 * @ORM\Entity(repositoryClass="ITDoors\HaccpBundle\Entity\ContourRepository")
 */
class Contour
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
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=50, nullable=true)
     */
    private $color;

    /**
     * @var integer
     *
     * @ORM\Column(name="service_id", type="integer", nullable=true)
     */
    private $serviceId;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=50)
     */
    private $slug;

    /**
     * @var \ITDoors\HaccpBundle\Entity\Service
     *
     * @ORM\ManyToOne(targetEntity="ITDoors\HaccpBundle\Entity\Service")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     * })
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
     * __toString()
     */
    public function __toString()
    {
        return $this->getName();
    }
}
