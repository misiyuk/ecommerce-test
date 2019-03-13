<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Cashbox.
 *
 * @ORM\Table(name="cashbox")
 * @ORM\Entity(repositoryClass="App\Repository\CashboxRepository")
 */
class Cashbox
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
     * @var string
     *
     * @ORM\Column(name="store_uuid", type="guid")
     */
    private $storeUuid;

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
     * @var \App\Entity\Store
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Store")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="store_uuid", referencedColumnName="id", nullable=true)
     * })
     */
    private $store;

    /**
     * Cashbox constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
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
     * @return Cashbox
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

    /**
     * Set storeUuid.
     *
     * @param string $storeUuid
     *
     * @return Cashbox
     */
    public function setStoreUuid($storeUuid)
    {
        $this->storeUuid = $storeUuid;

        return $this;
    }

    /**
     * Get storeUuid.
     *
     * @return string
     */
    public function getStoreUuid()
    {
        return $this->storeUuid;
    }

    public function getStockUuid(): ?string
    {
        return $this->stockUuid;
    }

    public function setStockUuid(string $stockUuid): self
    {
        $this->stockUuid = $stockUuid;

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

    public function getStore(): ?Store
    {
        return $this->store;
    }

    public function setStore(?Store $store): self
    {
        $this->store = $store;

        return $this;
    }
}
