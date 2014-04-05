<?php

namespace ITDoors\HaccpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plan
 *
 * @ORM\Table(name="plan")
 * @ORM\Entity(repositoryClass="ITDoors\HaccpBundle\Entity\PlanRepository")
 */
class Plan
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
     * @ORM\Column(name="image_src", type="string", length=50, nullable=true)
     */
    private $imageSrc;

    /**
     * @var integer
     *
     * @ORM\Column(name="image_width", type="integer", nullable=true)
     */
    private $imageWidth;

    /**
     * @var integer
     *
     * @ORM\Column(name="image_height", type="integer", nullable=true)
     */
    private $imageHeight;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=50, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=50, nullable=true)
     */
    private $longitude;

    /**
     * @var integer
     *
     * @ORM\Column(name="company_object_id", type="integer")
     */
    private $companyObjectId;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=true)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=true)
     */
    private $parentId;

    /**
     * @var string
     *
     * @ORM\Column(name="parentLatitudeTopLeft", type="string", length=50, nullable=true)
     */
    private $parentLatitudeTopLeft;

    /**
     * @var string
     *
     * @ORM\Column(name="parentLongitudeTopLeft", type="string", length=50, nullable=true)
     */
    private $parentLongitudeTopLeft;

    /**
     * @var string
     *
     * @ORM\Column(name="parentLatitudeBottomRight", type="string", length=50, nullable=true)
     */
    private $parentLatitudeBottomRight;

    /**
     * @var string
     *
     * @ORM\Column(name="parentLongitudeBottomRight", type="string", length=50, nullable=true)
     */
    private $parentLongitudeBottomRight;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_zoom", type="integer", nullable=true)
     */
    private $maxZoom;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ITDoors\HaccpBundle\Entity\Plan", mappedBy="parent")
     */
    private $children;

    /**
     * @var \ITDoors\HaccpBundle\Entity\CompanyObject
     *
     * @ORM\ManyToOne(targetEntity="ITDoors\HaccpBundle\Entity\CompanyObject")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company_object_id", referencedColumnName="id")
     * })
     */
    private $companyObject;

    /**
     * @var \ITDoors\HaccpBundle\Entity\Plan
     *
     * @ORM\ManyToOne(targetEntity="ITDoors\HaccpBundle\Entity\Plan", inversedBy="children")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Plan
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
     * Set imageSrc
     *
     * @param string $imageSrc
     * @return Plan
     */
    public function setImageSrc($imageSrc)
    {
        $this->imageSrc = $imageSrc;

        return $this;
    }

    /**
     * Get imageSrc
     *
     * @return string 
     */
    public function getImageSrc()
    {
        return $this->imageSrc;
    }

    /**
     * Set imageWidth
     *
     * @param integer $imageWidth
     * @return Plan
     */
    public function setImageWidth($imageWidth)
    {
        $this->imageWidth = $imageWidth;

        return $this;
    }

    /**
     * Get imageWidth
     *
     * @return integer 
     */
    public function getImageWidth()
    {
        return $this->imageWidth;
    }

    /**
     * Set imageHeight
     *
     * @param integer $imageHeight
     * @return Plan
     */
    public function setImageHeight($imageHeight)
    {
        $this->imageHeight = $imageHeight;

        return $this;
    }

    /**
     * Get imageHeight
     *
     * @return integer 
     */
    public function getImageHeight()
    {
        return $this->imageHeight;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return Plan
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Plan
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set companyObjectId
     *
     * @param integer $companyObjectId
     * @return Plan
     */
    public function setCompanyObjectId($companyObjectId)
    {
        $this->companyObjectId = $companyObjectId;

        return $this;
    }

    /**
     * Get companyObjectId
     *
     * @return integer 
     */
    public function getCompanyObjectId()
    {
        return $this->companyObjectId;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Plan
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return Plan
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set parentLatitudeTopLeft
     *
     * @param string $parentLatitudeTopLeft
     * @return Plan
     */
    public function setParentLatitudeTopLeft($parentLatitudeTopLeft)
    {
        $this->parentLatitudeTopLeft = $parentLatitudeTopLeft;

        return $this;
    }

    /**
     * Get parentLatitudeTopLeft
     *
     * @return string 
     */
    public function getParentLatitudeTopLeft()
    {
        return $this->parentLatitudeTopLeft;
    }

    /**
     * Set parentLongitudeTopLeft
     *
     * @param string $parentLongitudeTopLeft
     * @return Plan
     */
    public function setParentLongitudeTopLeft($parentLongitudeTopLeft)
    {
        $this->parentLongitudeTopLeft = $parentLongitudeTopLeft;

        return $this;
    }

    /**
     * Get parentLongitudeTopLeft
     *
     * @return string 
     */
    public function getParentLongitudeTopLeft()
    {
        return $this->parentLongitudeTopLeft;
    }

    /**
     * Set parentLatitudeBottomRight
     *
     * @param string $parentLatitudeBottomRight
     * @return Plan
     */
    public function setParentLatitudeBottomRight($parentLatitudeBottomRight)
    {
        $this->parentLatitudeBottomRight = $parentLatitudeBottomRight;

        return $this;
    }

    /**
     * Get parentLatitudeBottomRight
     *
     * @return string 
     */
    public function getParentLatitudeBottomRight()
    {
        return $this->parentLatitudeBottomRight;
    }

    /**
     * Set parentLongitudeBottomRight
     *
     * @param string $parentLongitudeBottomRight
     * @return Plan
     */
    public function setParentLongitudeBottomRight($parentLongitudeBottomRight)
    {
        $this->parentLongitudeBottomRight = $parentLongitudeBottomRight;

        return $this;
    }

    /**
     * Get parentLongitudeBottomRight
     *
     * @return string 
     */
    public function getParentLongitudeBottomRight()
    {
        return $this->parentLongitudeBottomRight;
    }

    /**
     * Set maxZoom
     *
     * @param integer $maxZoom
     * @return Plan
     */
    public function setMaxZoom($maxZoom)
    {
        $this->maxZoom = $maxZoom;

        return $this;
    }

    /**
     * Get maxZoom
     *
     * @return integer 
     */
    public function getMaxZoom()
    {
        return $this->maxZoom;
    }

    /**
     * Add children
     *
     * @param \ITDoors\HaccpBundle\Entity\Plan $children
     * @return Plan
     */
    public function addChild(\ITDoors\HaccpBundle\Entity\Plan $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \ITDoors\HaccpBundle\Entity\Plan $children
     */
    public function removeChild(\ITDoors\HaccpBundle\Entity\Plan $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set companyObject
     *
     * @param \ITDoors\HaccpBundle\Entity\CompanyObject $companyObject
     * @return Plan
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
     * Set parent
     *
     * @param \ITDoors\HaccpBundle\Entity\Plan $parent
     * @return Plan
     */
    public function setParent(\ITDoors\HaccpBundle\Entity\Plan $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \ITDoors\HaccpBundle\Entity\Plan 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * __toString()
     */
    public function __toString()
    {
        return $this->getName();
    }
}
