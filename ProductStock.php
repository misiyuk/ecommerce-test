<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductStock.
 *
 * @ORM\Table(name="product_stock")
 * @ORM\Entity(repositoryClass="App\Repository\ProductStockRepository")
 */
class ProductStock
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
     * @ORM\Column(name="product_id", type="integer")
     */
    private $productId;

    /**
     * @var string
     *
     * @ORM\Column(name="stock_uuid", type="string", length=255)
     */
    private $stockUuid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="qty", type="integer", nullable=true)
     */
    private $qty;

    /**
     * @var \App\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="productStocks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

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
     * Set productId.
     *
     * @param int $productId
     *
     * @return ProductStock
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId.
     *
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set stockUuid.
     *
     * @param string $stockUuid
     *
     * @return ProductStock
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
     * @param $qty
     *
     * @throws \Exception
     *
     * @return $this
     */
    public function setQty($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * Get qty.
     *
     * @return int
     */
    public function getQty()
    {
        return $this->qty;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public static function create(Product $product, Stock $stock, int $qty): self
    {
        $productStock = new self();

        $productStock->product = $product;
        $productStock->stockUuid = $stock->getId();
        $productStock->qty = $qty;

        return $productStock;
    }
}
