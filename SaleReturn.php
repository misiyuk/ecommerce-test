<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SaleReturn.
 *
 * @ORM\Table(name="sale_return")
 * @ORM\Entity(repositoryClass="App\Repository\SaleReturnRepository")
 */
class SaleReturn
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="act_id", type="integer")
     */
    private $actId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetimetz")
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="contractor_id", type="integer", nullable=true)
     */
    private $contractorId;

    /**
     * @var float
     *
     * @ORM\Column(name="cash_sum", type="float")
     */
    private $cashSum;

    /**
     * @var float
     *
     * @ORM\Column(name="cashless_sum", type="float")
     */
    private $cashlessSum;

    /**
     * @var int|null
     *
     * @ORM\Column(name="amt_qty", type="integer", nullable=true)
     */
    private $amtQty;

    /**
     * @var float|null
     *
     * @ORM\Column(name="amt_sum", type="float", nullable=true)
     */
    private $amtSum;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sale_act_id", type="integer", nullable=true)
     */
    private $saleActId;

    /**
     * @var \App\Entity\Act
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Act")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sale_act_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $saleAct;

    /**
     * @var string|null
     *
     * @ORM\Column(name="retail_shift_uuid", type="guid", nullable=true)
     */
    private $retailShiftUuid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="uuid", type="guid", nullable=true)
     */
    private $uuid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RetailShift", inversedBy="saleReturns")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="retail_shift_uuid", referencedColumnName="id", nullable=true)
     * })
     */
    private $retailShift;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set actId.
     *
     * @param int $actId
     *
     * @return SaleReturn
     */
    public function setActId($actId)
    {
        $this->actId = $actId;

        return $this;
    }

    /**
     * Get actId.
     *
     * @return int
     */
    public function getActId()
    {
        return $this->actId;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return SaleReturn
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set contractorId.
     *
     * @param int $contractorId
     *
     * @return SaleReturn
     */
    public function setContractorId($contractorId)
    {
        $this->contractorId = $contractorId;

        return $this;
    }

    /**
     * Get contractorId.
     *
     * @return int
     */
    public function getContractorId()
    {
        return $this->contractorId;
    }

    /**
     * Set cashSum.
     *
     * @param float $cashSum
     *
     * @return SaleReturn
     */
    public function setCashSum($cashSum)
    {
        $this->cashSum = $cashSum;

        return $this;
    }

    /**
     * Get cashSum.
     *
     * @return float
     */
    public function getCashSum()
    {
        return $this->cashSum;
    }

    /**
     * Set cashlessSum.
     *
     * @param float $cashlessSum
     *
     * @return SaleReturn
     */
    public function setCashlessSum($cashlessSum)
    {
        $this->cashlessSum = $cashlessSum;

        return $this;
    }

    /**
     * Get cashlessSum.
     *
     * @return float
     */
    public function getCashlessSum()
    {
        return $this->cashlessSum;
    }

    /**
     * Set amtQty.
     *
     * @param int $amtQty
     *
     * @return SaleReturn
     */
    public function setAmtQty($amtQty)
    {
        $this->amtQty = $amtQty;

        return $this;
    }

    /**
     * Get amtQty.
     *
     * @return int
     */
    public function getAmtQty()
    {
        return $this->amtQty;
    }

    /**
     * Set amtSum.
     *
     * @param float $amtSum
     *
     * @return SaleReturn
     */
    public function setAmtSum($amtSum)
    {
        $this->amtSum = $amtSum;

        return $this;
    }

    /**
     * Get amtSum.
     *
     * @return float
     */
    public function getAmtSum()
    {
        return $this->amtSum;
    }

    /**
     * Set saleActId.
     *
     * @param int $saleActId
     *
     * @return SaleReturn
     */
    public function setSaleActId($saleActId)
    {
        $this->saleActId = $saleActId;

        return $this;
    }

    /**
     * Get saleActId.
     *
     * @return int
     */
    public function getSaleActId()
    {
        return $this->saleActId;
    }

    /**
     * Set retailShiftUuid.
     *
     * @param string $retailShiftUuid
     *
     * @return SaleReturn
     */
    public function setRetailShiftUuid($retailShiftUuid)
    {
        $this->retailShiftUuid = $retailShiftUuid;

        return $this;
    }

    /**
     * Get retailShiftUuid.
     *
     * @return string
     */
    public function getRetailShiftUuid()
    {
        return $this->retailShiftUuid;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(?string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function setSaleAct(?Act $saleAct): self
    {
        $this->saleAct = $saleAct;

        return $this;
    }

    public function getSaleAct(): ?Act
    {
        return $this->saleAct;
    }

    public function getRetailShift(): ?RetailShift
    {
        return $this->retailShift;
    }

    public function setRetailShift(?RetailShift $retailShift): self
    {
        $this->retailShift = $retailShift;

        return $this;
    }
}
