<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * RetailShift.
 *
 * @ORM\Table(name="retail_shift")
 * @ORM\Entity(repositoryClass="App\Repository\RetailShiftRepository")
 */
class RetailShift
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="open_at", type="datetimetz")
     */
    private $openAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="close_at", type="datetimetz", nullable=true)
     */
    private $closeAt;

    /**
     * @var string
     *
     * @ORM\Column(name="cashbox_uuid", type="guid")
     */
    private $cashboxUuid;

    /**
     * @var float|null
     *
     * @ORM\Column(name="revenue", type="float", nullable=true)
     */
    private $revenue;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cash_revenue", type="float", nullable=true)
     */
    private $cashRevenue;

    /**
     * @var float|null
     *
     * @ORM\Column(name="nocash_revenue", type="float", nullable=true)
     */
    private $nocashRevenue;

    /**
     * @var string
     *
     * @ORM\Column(name="stock_uuid", type="guid")
     */
    private $stockUuid;

    /**
     * @var \App\Entity\Stock
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Stock")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="stock_uuid", referencedColumnName="id", nullable=true)
     * })
     */
    private $stock;

    /**
     * @var \App\Entity\Cashbox
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Cashbox")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cashbox_uuid", referencedColumnName="id", nullable=true)
     * })
     */
    private $cashbox;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SaleReturn", mappedBy="retailShift")
     */
    private $saleReturns;

    /**
     * RetailShift constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->saleReturns = new ArrayCollection();
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
     * Set openAt.
     *
     * @param \DateTime $openAt
     *
     * @return RetailShift
     */
    public function setOpenAt($openAt)
    {
        $this->openAt = $openAt;

        return $this;
    }

    /**
     * Get openAt.
     *
     * @return \DateTime
     */
    public function getOpenAt()
    {
        return $this->openAt;
    }

    /**
     * Set closeAt.
     *
     * @param \DateTime $closeAt
     *
     * @return RetailShift
     */
    public function setCloseAt($closeAt)
    {
        $this->closeAt = $closeAt;

        return $this;
    }

    /**
     * Get closeAt.
     *
     * @return \DateTime
     */
    public function getCloseAt()
    {
        return $this->closeAt;
    }

    /**
     * Set cashboxUuid.
     *
     * @param string $cashboxUuid
     *
     * @return RetailShift
     */
    public function setCashboxUuid($cashboxUuid)
    {
        $this->cashboxUuid = $cashboxUuid;

        return $this;
    }

    /**
     * Get cashboxUuid.
     *
     * @return string
     */
    public function getCashboxUuid()
    {
        return $this->cashboxUuid;
    }

    /**
     * Set revenue.
     *
     * @param float $revenue
     *
     * @return RetailShift
     */
    public function setRevenue($revenue)
    {
        $this->revenue = $revenue;

        return $this;
    }

    /**
     * Get revenue.
     *
     * @return float
     */
    public function getRevenue()
    {
        return $this->revenue;
    }

    /**
     * Set cashRevenue.
     *
     * @param float $cashRevenue
     *
     * @return RetailShift
     */
    public function setCashRevenue($cashRevenue)
    {
        $this->cashRevenue = $cashRevenue;

        return $this;
    }

    /**
     * Get cashRevenue.
     *
     * @return float
     */
    public function getCashRevenue()
    {
        return $this->cashRevenue;
    }

    /**
     * Set nocashRevenue.
     *
     * @param float $nocashRevenue
     *
     * @return RetailShift
     */
    public function setNocashRevenue($nocashRevenue)
    {
        $this->nocashRevenue = $nocashRevenue;

        return $this;
    }

    /**
     * Get nocashRevenue.
     *
     * @return float
     */
    public function getNocashRevenue()
    {
        return $this->nocashRevenue;
    }

    /**
     * Set stockUuid.
     *
     * @param string $stockUuid
     *
     * @return RetailShift
     */
    public function setStockUuid($stockUuid)
    {
        $this->stockUuid = $stockUuid;

        return $this;
    }

    /**
     * Get stockUuid.
     *
     * @return string
     */
    public function getStockUuid()
    {
        return $this->stockUuid;
    }

    /**
     * @param Stock $stock
     *
     * @return RetailShift
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param Cashbox $cashbox
     *
     * @return RetailShift
     */
    public function setCashbox($cashbox)
    {
        $this->cashbox = $cashbox;

        return $this;
    }

    /**
     * @return Cashbox
     */
    public function getCashbox()
    {
        return $this->cashbox;
    }

    /**
     * @param $openAt
     * @param $closeAt
     *
     * @throws \Exception
     *
     * @return RetailShift
     */
    public static function create(
        $openAt,
        $closeAt,
        Cashbox $cashBox,
        float $revenue,
        float $cashRevenue,
        float $noCashRevenue,
        Stock $stock
    ): self {
        $retailShift = new self();
        $retailShift->openAt = $openAt;
        $retailShift->closeAt = $closeAt;
        $retailShift->cashbox = $cashBox;
        $retailShift->revenue = $revenue;
        $retailShift->cashRevenue = $cashRevenue;
        $retailShift->nocashRevenue = $noCashRevenue;
        $retailShift->stock = $stock;

        return $retailShift;
    }

    public function edit(
        $openAt,
        $closeAt,
        Cashbox $cashBox,
        float $revenue,
        float $cashRevenue,
        float $noCashRevenue,
        Stock $stock
    ): void {
        $this->openAt = $openAt;
        $this->closeAt = $closeAt;
        $this->cashbox = $cashBox;
        $this->revenue = $revenue;
        $this->cashRevenue = $cashRevenue;
        $this->nocashRevenue = $noCashRevenue;
        $this->stock = $stock;
    }

    /**
     * @return Collection|SaleReturn[]
     */
    public function getSaleReturns(): Collection
    {
        return $this->saleReturns;
    }

    public function addSaleReturn(SaleReturn $saleReturn): self
    {
        if (!$this->saleReturns->contains($saleReturn)) {
            $this->saleReturns[] = $saleReturn;
            $saleReturn->setRetailShift($this);
        }

        return $this;
    }

    public function removeSaleReturn(SaleReturn $saleReturn): self
    {
        if ($this->saleReturns->contains($saleReturn)) {
            $this->saleReturns->removeElement($saleReturn);
            // set the owning side to null (unless already changed)
            if ($saleReturn->getRetailShift() === $this) {
                $saleReturn->setRetailShift(null);
            }
        }

        return $this;
    }
}
