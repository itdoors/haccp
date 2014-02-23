<?php

namespace ITDoors\HaccpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyObject
 */
class CompanyObject
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
     * @var \ITDoors\HaccpBundle\Entity\Company
     */
    private $company;


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
     * @return CompanyObject
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
     * Set company
     *
     * @param \ITDoors\HaccpBundle\Entity\Company $company
     * @return CompanyObject
     */
    public function setCompany(\ITDoors\HaccpBundle\Entity\Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \ITDoors\HaccpBundle\Entity\Company 
     */
    public function getCompany()
    {
        return $this->company;
    }
    /**
     * @var integer
     */
    private $companyId;


    /**
     * Set companyId
     *
     * @param integer $companyId
     * @return CompanyObject
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get companyId
     *
     * @return integer 
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }
}
