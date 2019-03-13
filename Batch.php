<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BatchRepository")
 */
class Batch
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Act", cascade={"persist", "remove"}, inversedBy="batches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $act;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BatchBalance", mappedBy="batch", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $batchBalances;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $deliveryCost;

    public function __construct()
    {
        $this->batchBalances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAct(): ?Act
    {
        return $this->act;
    }

    public function setAct(Act $act): self
    {
        $this->act = $act;

        return $this;
    }

    /**
     * @return Collection|BatchBalance[]
     */
    public function getBatchBalances(): Collection
    {
        return $this->batchBalances;
    }

    public function addBatchBalance(BatchBalance $batchBalance): self
    {
        if (!$this->batchBalances->contains($batchBalance)) {
            $this->batchBalances[] = $batchBalance;
            $batchBalance->setBatch($this);
        }

        return $this;
    }

    public function removeBatchBalance(BatchBalance $batchBalance): self
    {
        if ($this->batchBalances->contains($batchBalance)) {
            $this->batchBalances->removeElement($batchBalance);
            // set the owning side to null (unless already changed)
            if ($batchBalance->getBatch() === $this) {
                $batchBalance->setBatch(null);
            }
        }

        return $this;
    }

    public function batchBalancesClear(): void
    {
        foreach ($this->batchBalances as $batchBalance) {
            $this->removeBatchBalance($batchBalance);
        }
    }

    public static function create(Act $act): self
    {
        $batch = new self();
        $batch->act = $act;

        return $batch;
    }

    public function getDeliveryCost(): ?float
    {
        return $this->deliveryCost;
    }

    public function setDeliveryCost(?float $deliveryCost): self
    {
        $this->deliveryCost = $deliveryCost;

        return $this;
    }
}
