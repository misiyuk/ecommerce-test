<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Stock.
 *
 * @ORM\Table(name="stock")
 * @ORM\Entity(repositoryClass="App\Repository\StockRepository")
 */
class Stock
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Store", mappedBy="stock")
     */
    private $stores;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BatchBalance", mappedBy="stock")
     */
    private $batchBalances;

    /**
     * Stock constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->stores = new ArrayCollection();
        $this->id = Uuid::uuid4();
        $this->batchBalances = new ArrayCollection();
    }

    /**
     * @return Store[]|ArrayCollection
     */
    public function getStores()
    {
        return $this->stores;
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
     * Set name.
     *
     * @param string $name
     *
     * @return Stock
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function addStore(Store $store): self
    {
        if (!$this->stores->contains($store)) {
            $this->stores[] = $store;
            $store->setStock($this);
        }

        return $this;
    }

    public function removeStore(Store $store): self
    {
        if ($this->stores->contains($store)) {
            $this->stores->removeElement($store);
            // set the owning side to null (unless already changed)
            if ($store->getStock() === $this) {
                $store->setStock(null);
            }
        }

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
            $batchBalance->setStock($this);
        }

        return $this;
    }

    public function removeBatchBalance(BatchBalance $batchBalance): self
    {
        if ($this->batchBalances->contains($batchBalance)) {
            $this->batchBalances->removeElement($batchBalance);
            // set the owning side to null (unless already changed)
            if ($batchBalance->getStock() === $this) {
                $batchBalance->setStock(null);
            }
        }

        return $this;
    }
}
