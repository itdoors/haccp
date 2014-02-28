<?php

namespace ITDoors\HaccpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plan
 */
class Plan
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
    private $imageSrc;

    /**
     * @var integer
     */
    private $companyObjectId;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * @var \ITDoors\HaccpBundle\Entity\CompanyObject
     */
    private $companyObject;

    /**
     * @var \ITDoors\HaccpBundle\Entity\Plan
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
     * @var integer
     */
    private $imageWidth;

    /**
     * @var integer
     */
    private $imageHeight;


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
     * @var string
     */
    private $latitude;

    /**
     * @var string
     */
    private $longitude;

    /**
     * @var string
     */
    private $type;


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
     * @var integer
     */
    private $parentId;


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
}
