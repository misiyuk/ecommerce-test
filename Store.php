<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Store
 *
 * @ORM\Table(name="store")
 * @ORM\Entity(repositoryClass="App\Repository\StoreRepository")
 */
class Store
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
     * @var \App\Entity\Stock
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Stock", inversedBy="stores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="stock_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $stock;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Threshold", mappedBy="store", orphanRemoval=true, cascade={"persist"})
     * @ORM\OrderBy({"value": "ASC"})
     */
    private $thresholds;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductPrice", mappedBy="store")
     */
    private $productPrices;

    /**
     * Store constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->thresholds = new ArrayCollection();
        $this->productPrices = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
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
     * @return Store
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
     * @param Stock $stock
     *
     * @return Store
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
     * @return Collection|Threshold[]
     */
    public function getThresholds(): Collection
    {
        return $this->thresholds;
    }

    public function addThreshold(Threshold $threshold): self
    {
        if (!$this->thresholds->contains($threshold)) {
            $this->thresholds[] = $threshold;
            $threshold->setStore($this);
        }

        return $this;
    }

    public function removeThreshold(Threshold $threshold): self
    {
        if ($this->thresholds->contains($threshold)) {
            $this->thresholds->removeElement($threshold);
            // set the owning side to null (unless already changed)
            if ($threshold->getStore() === $this) {
                $threshold->setStore(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProductPrice[]
     */
    public function getProductPrices(): Collection
    {
        return $this->productPrices;
    }

    public function addProductPrice(ProductPrice $productPrice): self
    {
        if (!$this->productPrices->contains($productPrice)) {
            $this->productPrices[] = $productPrice;
            $productPrice->setStore($this);
        }

        return $this;
    }

    public function removeProductPrice(ProductPrice $productPrice): self
    {
        if ($this->productPrices->contains($productPrice)) {
            $this->productPrices->removeElement($productPrice);
            // set the owning side to null (unless already changed)
            if ($productPrice->getStore() === $this) {
                $productPrice->setStore(null);
            }
        }

        return $this;
    }


}
