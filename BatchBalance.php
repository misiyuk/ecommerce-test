<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BatchBalanceRepository")
 */
class BatchBalance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="batchBalances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Batch", inversedBy="batchBalances", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $batch;

    /**
     * @ORM\Column(type="integer")
     */
    private $qty;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Stock", inversedBy="batchBalances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stock;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function getBatch(): ?Batch
    {
        return $this->batch;
    }

    public function setBatch(?Batch $batch): self
    {
        $this->batch = $batch;

        return $this;
    }

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(int $qty): self
    {
        $this->qty = $qty;

        return $this;
    }

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public static function create($product, $qty, $stock, $batch)
    {
        $batchBalance = new self();
        $batchBalance->product = $product;
        $batchBalance->qty = $qty;
        $batchBalance->stock = $stock;
        $batchBalance->batch = $batch;

        return $batchBalance;
    }
}
