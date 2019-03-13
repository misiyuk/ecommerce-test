<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Act.
 *
 * @ORM\Table(name="act")
 * @ORM\Entity(repositoryClass="App\Repository\ActRepository")
 */
class Act
{
    const ENTER_TYPE = 1;
    const SUPPLY_TYPE = 2;
    const SALE_TYPE = 3;
    const SALE_RETURN_TYPE = 4;
    const RELOCATION_FROM_TYPE = 5;
    const RELOCATION_TO_TYPE = 6;
    const PURCHASE_TYPE = 7;
    const WRITE_OFF_TYPE = 8;
    const ORDER = 9;

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
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_act", type="date")
     */
    private $dateAct;

    /**
     * @var string|null
     *
     * @ORM\Column(name="stock_uuid", type="guid", nullable=true)
     */
    private $stockUuid;

    /**
     * @var \Doctrine\Common\Collections\Collection|ActInvoice[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ActInvoice", mappedBy="act", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $actInvoices;

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
     * @ORM\OneToMany(targetEntity="App\Entity\Batch", mappedBy="act")
     */
    private $batches;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Purchase", cascade={"persist", "remove"}, mappedBy="act")
     */
    private $purchase;

    /**
     * @throws
     */
    public function __construct()
    {
        $this->actInvoices = new ArrayCollection();
        $this->batches = new ArrayCollection();
        $this->dateAct = new \DateTime();
    }

    /**
     * @return ArrayCollection|Collection|ActInvoice[]
     */
    public function getActInvoices()
    {
        return $this->actInvoices;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getTotalSum()
    {
        $invoices = $this->getActInvoices();
        $sum = 0;
        foreach ($invoices as $invoice) {
            $sum += $invoice->getCostPrice();
        }

        return $sum;
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
     * Set type.
     *
     * @param int $type
     *
     * @return Act
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set dateAct.
     *
     * @param \DateTime $dateAct
     *
     * @return Act
     */
    public function setDateAct($dateAct)
    {
        $this->dateAct = $dateAct;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateAct()
    {
        return $this->dateAct;
    }

    /**
     * Set stockUuid.
     *
     * @param int $stockUuid
     *
     * @return Act
     */
    public function setStockUuid($stockUuid)
    {
        $this->stockUuid = $stockUuid;

        return $this;
    }

    /**
     * Get stockUuid.
     *
     * @return int
     */
    public function getStockUuid()
    {
        return $this->stockUuid;
    }

    /**
     * @throws \Exception
     *
     * @return Act
     */
    public static function create(int $actType, Stock $stock)
    {
        $act = new self();
        $act->setType($actType);
        $act->setStock($stock);
        $act->setDateAct(new \DateTime());

        return $act;
    }

    public function addActInvoice(ActInvoice $actInvoice): self
    {
        if (!$this->actInvoices->contains($actInvoice)) {
            $this->actInvoices[] = $actInvoice;
            $actInvoice->setAct($this);
        }

        return $this;
    }

    public function removeActInvoice(ActInvoice $actInvoice): self
    {
        if ($this->actInvoices->contains($actInvoice)) {
            if ($actInvoice->getInternalCode()) {
                $actInvoice->getInternalCode()->setActInvoice(null);
            }
            $this->actInvoices->removeElement($actInvoice);
            // set the owning side to null (unless already changed)
            if ($actInvoice->getAct() === $this) {
                $actInvoice->setAct(null);
            }
        }

        return $this;
    }

    public function actInvoicesClear(): void
    {
        foreach ($this->actInvoices as $actInvoice) {
            $this->removeActInvoice($actInvoice);
        }
    }

    /**
     * @return Collection|Batch[]
     */
    public function getBatches(): Collection
    {
        return $this->batches;
    }

    public function addBatch(Batch $batch): self
    {
        if (!$this->batches->contains($batch)) {
            $this->batches[] = $batch;
            $batch->setAct($this);
        }

        return $this;
    }

    public function removeBatch(Batch $batch): self
    {
        if ($this->batches->contains($batch)) {
            $this->batches->removeElement($batch);
            // set the owning side to null (unless already changed)
            if ($batch->getAct() === $this) {
                $batch->setAct(null);
            }
        }

        return $this;
    }

    public function getPurchase(): ?Purchase
    {
        return $this->purchase;
    }

    public function setPurchase(?Purchase $purchase): self
    {
        $this->purchase = $purchase;

        return $this;
    }
}
