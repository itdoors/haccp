<?php

namespace ITDoors\HaccpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PointGroupCharacteristic
 */
class PointGroupCharacteristic
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
    private $description;

    /**
     * @var string
     */
    private $unit;

    /**
     * @var string
     */
    private $dataType;

    /**
     * @var string
     */
    private $allowValueMax;

    /**
     * @var string
     */
    private $allowValueMin;

    /**
     * @var string
     */
    private $criticalValueTop;

    /**
     * @var string
     */
    private $criticalValueBottom;

    /**
     * @var string
     */
    private $criticalColorTop;

    /**
     * @var string
     */
    private $criticalColorBottom;

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
     * @return PointGroupCharacteristic
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
     * Set description
     *
     * @param string $description
     * @return PointGroupCharacteristic
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set unit
     *
     * @param string $unit
     * @return PointGroupCharacteristic
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string 
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set dataType
     *
     * @param string $dataType
     * @return PointGroupCharacteristic
     */
    public function setDataType($dataType)
    {
        $this->dataType = $dataType;

        return $this;
    }

    /**
     * Get dataType
     *
     * @return string 
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * Set allowValueMax
     *
     * @param string $allowValueMax
     * @return PointGroupCharacteristic
     */
    public function setAllowValueMax($allowValueMax)
    {
        $this->allowValueMax = $allowValueMax;

        return $this;
    }

    /**
     * Get allowValueMax
     *
     * @return string 
     */
    public function getAllowValueMax()
    {
        return $this->allowValueMax;
    }

    /**
     * Set allowValueMin
     *
     * @param string $allowValueMin
     * @return PointGroupCharacteristic
     */
    public function setAllowValueMin($allowValueMin)
    {
        $this->allowValueMin = $allowValueMin;

        return $this;
    }

    /**
     * Get allowValueMin
     *
     * @return string 
     */
    public function getAllowValueMin()
    {
        return $this->allowValueMin;
    }

    /**
     * Set criticalValueTop
     *
     * @param string $criticalValueTop
     * @return PointGroupCharacteristic
     */
    public function setCriticalValueTop($criticalValueTop)
    {
        $this->criticalValueTop = $criticalValueTop;

        return $this;
    }

    /**
     * Get criticalValueTop
     *
     * @return string 
     */
    public function getCriticalValueTop()
    {
        return $this->criticalValueTop;
    }

    /**
     * Set criticalValueBottom
     *
     * @param string $criticalValueBottom
     * @return PointGroupCharacteristic
     */
    public function setCriticalValueBottom($criticalValueBottom)
    {
        $this->criticalValueBottom = $criticalValueBottom;

        return $this;
    }

    /**
     * Get criticalValueBottom
     *
     * @return string 
     */
    public function getCriticalValueBottom()
    {
        return $this->criticalValueBottom;
    }

    /**
     * Set criticalColorTop
     *
     * @param string $criticalColorTop
     * @return PointGroupCharacteristic
     */
    public function setCriticalColorTop($criticalColorTop)
    {
        $this->criticalColorTop = $criticalColorTop;

        return $this;
    }

    /**
     * Get criticalColorTop
     *
     * @return string 
     */
    public function getCriticalColorTop()
    {
        return $this->criticalColorTop;
    }

    /**
     * Set criticalColorBottom
     *
     * @param string $criticalColorBottom
     * @return PointGroupCharacteristic
     */
    public function setCriticalColorBottom($criticalColorBottom)
    {
        $this->criticalColorBottom = $criticalColorBottom;

        return $this;
    }

    /**
     * Get criticalColorBottom
     *
     * @return string 
     */
    public function getCriticalColorBottom()
    {
        return $this->criticalColorBottom;
    }

    /**
     * Set group
     *
     * @param \ITDoors\HaccpBundle\Entity\PointGroup $group
     * @return PointGroupCharacteristic
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
    private $criticalColorMiddle;


    /**
     * Set criticalColorMiddle
     *
     * @param string $criticalColorMiddle
     * @return PointGroupCharacteristic
     */
    public function setCriticalColorMiddle($criticalColorMiddle)
    {
        $this->criticalColorMiddle = $criticalColorMiddle;

        return $this;
    }

    /**
     * Get criticalColorMiddle
     *
     * @return string 
     */
    public function getCriticalColorMiddle()
    {
        return $this->criticalColorMiddle;
    }

    /**
     * __toString()
     */
    public function __toString()
    {
        return $this->getName();
    }
    /**
     * @var integer
     */
    private $groupId;


    /**
     * Set groupId
     *
     * @param integer $groupId
     * @return PointGroupCharacteristic
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * Get groupId
     *
     * @return integer 
     */
    public function getGroupId()
    {
        return $this->groupId;
    }
}
