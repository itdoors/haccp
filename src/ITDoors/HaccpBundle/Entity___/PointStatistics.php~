<?php

namespace ITDoors\HaccpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PointStatistics
 */
class PointStatistics
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $entryDate;

    /**
     * @var integer
     */
    private $pointId;

    /**
     * @var integer
     */
    private $characteristicId;

    /**
     * @var string
     */
    private $value;

    /**
     * @var \ITDoors\HaccpBundle\Entity\PointGroupCharacteristic
     */
    private $Characteristic;

    /**
     * @var \ITDoors\HaccpBundle\Entity\Point
     */
    private $Point;


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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PointStatistics
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set entryDate
     *
     * @param \DateTime $entryDate
     * @return PointStatistics
     */
    public function setEntryDate($entryDate)
    {
        $this->entryDate = $entryDate;

        return $this;
    }

    /**
     * Get entryDate
     *
     * @return \DateTime 
     */
    public function getEntryDate()
    {
        return $this->entryDate;
    }

    /**
     * Set pointId
     *
     * @param integer $pointId
     * @return PointStatistics
     */
    public function setPointId($pointId)
    {
        $this->pointId = $pointId;

        return $this;
    }

    /**
     * Get pointId
     *
     * @return integer 
     */
    public function getPointId()
    {
        return $this->pointId;
    }

    /**
     * Set characteristicId
     *
     * @param integer $characteristicId
     * @return PointStatistics
     */
    public function setCharacteristicId($characteristicId)
    {
        $this->characteristicId = $characteristicId;

        return $this;
    }

    /**
     * Get characteristicId
     *
     * @return integer 
     */
    public function getCharacteristicId()
    {
        return $this->characteristicId;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return PointStatistics
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set Characteristic
     *
     * @param \ITDoors\HaccpBundle\Entity\PointGroupCharacteristic $characteristic
     * @return PointStatistics
     */
    public function setCharacteristic(\ITDoors\HaccpBundle\Entity\PointGroupCharacteristic $characteristic = null)
    {
        $this->Characteristic = $characteristic;

        return $this;
    }

    /**
     * Get Characteristic
     *
     * @return \ITDoors\HaccpBundle\Entity\PointGroupCharacteristic 
     */
    public function getCharacteristic()
    {
        return $this->Characteristic;
    }

    /**
     * Set Point
     *
     * @param \ITDoors\HaccpBundle\Entity\Point $point
     * @return PointStatistics
     */
    public function setPoint(\ITDoors\HaccpBundle\Entity\Point $point = null)
    {
        $this->Point = $point;

        return $this;
    }

    /**
     * Get Point
     *
     * @return \ITDoors\HaccpBundle\Entity\Point 
     */
    public function getPoint()
    {
        return $this->Point;
    }
}
