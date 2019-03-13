<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActInvoice.
 *
 * @ORM\Table(name="act_invoice")
 * @ORM\Entity(repositoryClass="App\Repository\ActInvoiceRepository")
 */
class ActInvoice
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
     * @var int
     *
     * @ORM\Column(name="product_id", type="integer")
     */
    private $productId;

    /**
     * @var int
     *
     * @ORM\Column(name="qty", type="integer")
     */
    private $qty;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cost_price", type="float", nullable=true)
     */
    private $costPrice;

    /**
     * @var float|null
     *
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;

    /**
     * @var float|null
     *
     * @ORM\Column(name="discount", type="float", nullable=true)
     */
    private $discount;

    /**
     * @var \App\Entity\Act
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Act", inversedBy="actInvoices")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="act_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $act;

    /**
     * @var \App\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="actInvoices", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $product;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\InternalCode", mappedBy="actInvoice", cascade={"persist"})
     */
    private $internalCode;

    /**
     * @var SupplyProduct|null
     * @ORM\OneToOne(targetEntity="App\Entity\SupplyProduct", mappedBy="actInvoice", cascade={"persist", "remove"})
     */
    private $supplyProduct;

    public function getDiscount()
    {
        return $this->discount;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;

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

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product): self
    {
        $this->product = $product;

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
     * @return ActInvoice
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
     * Set productId.
     *
     * @param int $productId
     *
     * @return ActInvoice
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
     * Set qty.
     *
     * @param int $qty
     *
     * @return ActInvoice
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

    /**
     * Set costPrice.
     *
     * @param float $costPrice
     *
     * @return ActInvoice
     */
    public function setCostPrice($costPrice)
    {
        $this->costPrice = $costPrice;

        return $this;
    }

    /**
     * Get costPrice.
     *
     * @return float
     */
    public function getCostPrice()
    {
        return $this->costPrice;
    }

    /**
     * Set price.
     *
     * @param float $price
     *
     * @return ActInvoice
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return ActInvoice
     */
    public static function create(Act $act, Product $product, int $qty, float $price, float $discount): self
    {
        $actInvoice = new self();
        $actInvoice->setAct($act);
        $actInvoice->setProduct($product);
        $actInvoice->setQty($qty);
        $actInvoice->setPrice($price);
        $actInvoice->setDiscount($discount);

        return $actInvoice;
    }

    public function getInternalCode(): ?InternalCode
    {
        return $this->internalCode;
    }

    public function setInternalCode(InternalCode $internalCode): self
    {
        $this->internalCode = $internalCode;

        if ($this !== $internalCode->getActInvoice()) {
            $internalCode->setActInvoice($this);
        }

        return $this;
    }

    public function getSupplyProduct(): ?SupplyProduct
    {
        return $this->supplyProduct;
    }

    public function setSupplyProduct(SupplyProduct $supplyProduct): self
    {
        $this->supplyProduct = $supplyProduct;

        if ($this !== $supplyProduct->getActInvoice()) {
            $supplyProduct->setActInvoice($this);
        }

        return $this;
    }
}
