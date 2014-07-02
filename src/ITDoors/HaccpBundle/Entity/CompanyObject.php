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
     *
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
     *
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
     *
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
     * __toString()
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="impermeability_id", type="integer", nullable=true)
     */
    private $impermeabilityId;

    /**
     * @var \ITDoors\LookupBundle\Entity\Lookup
     *
     * @ORM\ManyToOne(targetEntity="ITDoors\LookupBundle\Entity\Lookup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="impermeability_id", referencedColumnName="id")
     * })
     */
    private $impermeability;

    /**
     * @var integer
     *
     * @ORM\Column(name="terrain_id", type="integer", nullable=true)
     */
    private $terrainId;

    /**
     * @var \ITDoors\LookupBundle\Entity\Lookup
     *
     * @ORM\ManyToOne(targetEntity="ITDoors\LookupBundle\Entity\Lookup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="terrain_id", referencedColumnName="id")
     * })
     */
    private $terrain;

    /**
     * Set impermeabilityId
     *
     * @param integer $impermeabilityId
     * @return CompanyObject
     */
    public function setImpermeabilityId($impermeabilityId)
    {
        $this->impermeabilityId = $impermeabilityId;

        return $this;
    }

    /**
     * Get impermeabilityId
     *
     * @return integer 
     */
    public function getImpermeabilityId()
    {
        return $this->impermeabilityId;
    }

    /**
     * Set terrainId
     *
     * @param integer $terrainId
     * @return CompanyObject
     */
    public function setTerrainId($terrainId)
    {
        $this->terrainId = $terrainId;

        return $this;
    }

    /**
     * Get terrainId
     *
     * @return integer 
     */
    public function getTerrainId()
    {
        return $this->terrainId;
    }

    /**
     * Set impermeability
     *
     * @param \ITDoors\LookupBundle\Entity\Lookup $impermeability
     * @return CompanyObject
     */
    public function setImpermeability(\ITDoors\LookupBundle\Entity\Lookup $impermeability = null)
    {
        $this->impermeability = $impermeability;

        return $this;
    }

    /**
     * Get impermeability
     *
     * @return \ITDoors\LookupBundle\Entity\Lookup 
     */
    public function getImpermeability()
    {
        return $this->impermeability;
    }

    /**
     * Set terrain
     *
     * @param \ITDoors\LookupBundle\Entity\Lookup $terrain
     * @return CompanyObject
     */
    public function setTerrain(\ITDoors\LookupBundle\Entity\Lookup $terrain = null)
    {
        $this->terrain = $terrain;

        return $this;
    }

    /**
     * Get terrain
     *
     * @return \ITDoors\LookupBundle\Entity\Lookup 
     */
    public function getTerrain()
    {
        return $this->terrain;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        $fullName = $this->getName();

        if ($this->getImpermeability()) {
            $fullName .= ' - ' . $this->getImpermeability();
        }

        if ($this->getTerrain()) {
            $fullName .= ' - ' . $this->getTerrain();
        }

        return $fullName;
    }
}
