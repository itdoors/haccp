<?php

namespace ITDoors\HaccpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyObject
 *
 * @ORM\Table(name="company_object")
 * @ORM\Entity(repositoryClass="ITDoors\HaccpBundle\Entity\CompanyObjectRepository")
 */
class CompanyObject
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
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="company_id", type="integer")
     */
    private $companyId;

    /**
     * @var \ITDoors\HaccpBundle\Entity\Company
     *
     * @ORM\ManyToOne(targetEntity="ITDoors\HaccpBundle\Entity\Company")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     * })
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
}
