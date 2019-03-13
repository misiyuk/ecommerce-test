<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Sale.
 *
 * @ORM\Table(name="sale")
 * @ORM\Entity(repositoryClass="App\Repository\SaleRepository")
 */
class Sale
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
     * @var \App\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="sales", fetch="EXTRA_LAZY")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contractor_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $contractor;

    /**
     * @var \App\Entity\Act
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Act")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="act_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $act;

    /**
     * @var \App\Entity\Store
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Store")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="store_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $store;

    /**
     * @var \App\Entity\RetailShift
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RetailShift")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="retail_shift_uuid", referencedColumnName="id", nullable=true)
     * })
     */
    private $retailShift;

    public function setRetailShift(RetailShift $retailShift)
    {
        $this->retailShift = $retailShift;

        return $this;
    }

    public function getRetailShift()
    {
        return $this->retailShift;
    }

    public function getClient()
    {
        return $this->contractor;
    }

    public function setClient($contractor): self
    {
        $this->contractor = $contractor;

        return $this;
    }

    public function getAct()
    {
        return $this->act;
    }

    public function setAct($act): self
    {
        $this->act = $act;

        return $this;
    }

    public function getAmtQty()
    {
        return $this->amtQty;
    }

    public function setAmtQty($amtQty)
    {
        $this->amtQty = $amtQty;

        return $this;
    }

    public function getAmtSum()
    {
        return $this->amtSum;
    }

    public function setAmtSum($amtSum)
    {
        $this->amtSum = $amtSum;

        return $this;
    }

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
     * @return Sale
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
     * @return Sale
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
     * @return Sale
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
     * @return Sale
     */
    public function setStore(Store $store)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * @return Store
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * Set cashSum.
     *
     * @param float $cashSum
     *
     * @return Sale
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
     * @return Sale
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
     * Set retailShiftUuid.
     *
     * @param string $retailShiftUuid
     *
     * @return Sale
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

    /**
     * @param $cashSum
     * @param $cashlessSum
     * @param $amtQty
     * @param $amtSum
     *
     * @throws \Exception
     *
     * @return Sale
     */
    public static function create(
        Act $act,
        $cashSum,
        $cashlessSum,
        $amtQty,
        $amtSum,
        Client $client,
        Store $store,
        RetailShift $retailShift
    ): self {
        $sale = new self();
        $sale->setAct($act);
        $sale->setCreatedAt(new \DateTime());
        $sale->setCashSum($cashSum);
        $sale->setCashlessSum($cashlessSum);
        $sale->setAmtQty($amtQty);
        $sale->setAmtSum($amtSum);
        $sale->setClient($client);
        $sale->setStore($store);
        $sale->setRetailShift($retailShift);
        $sale->uuid = Uuid::uuid4();

        return $sale;
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

    public function getContractor(): ?Client
    {
        return $this->contractor;
    }

    public function setContractor(?Client $contractor): self
    {
        $this->contractor = $contractor;

        return $this;
    }
}
