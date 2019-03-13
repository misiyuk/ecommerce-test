<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    const STATUS_ACTIVE = 1;
    const STATUS_ARCHIVE = 2;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="qty", type="integer")
     */
    private $qty;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="cost_price", type="float")
     */
    private $costPrice;

    /**
     * @var string|null
     *
     * @ORM\Column(name="uuid", type="guid", nullable=true)
     */
    private $uuid;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sync", type="boolean", nullable=true, options={"default"=true})
     */
    private $sync = true;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="smallint", options={"default"="1"})
     */
    private $status = self::STATUS_ACTIVE;

    /**
     * @var float|null
     *
     * @ORM\Column(name="old_price", type="float", nullable=true)
     */
    private $oldPrice;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ProductStock", mappedBy="product")
     */
    private $productStocks;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ActInvoice", mappedBy="product")
     */
    private $actInvoices;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Barcode", mappedBy="product", cascade={"persist","remove"}, orphanRemoval=true)
     */
    private $barcodes;

    /**
     * @var \App\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BatchBalance", mappedBy="product")
     */
    private $batchBalances;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="products", cascade={"persist"})
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InternalCode", mappedBy="product", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $internalCodes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brand", inversedBy="products", cascade={"persist"})
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shortName;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $supplyQty;

    /**
     * @ORM\Column(type="boolean", options={"default"=false})
     */
    private $purchaseHelper;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductPhoto", mappedBy="product", cascade={"persist"})
     * @ORM\OrderBy({"sort": "ASC"})
     */
    private $productPhotos;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isECommerce;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AttributeValue", mappedBy="product", cascade={"persist"}, orphanRemoval=true)
     */
    private $attributeValues;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ECommerceCategory")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eCommerceCategory;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ECommerceTag", mappedBy="products", cascade={"persist"})
     */
    private $eCommerceTags;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductPrice", mappedBy="product", orphanRemoval=true)
     */
    private $productPrices;

    /**
     * Product constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->actInvoices = new ArrayCollection();
        $this->barcodes = new ArrayCollection();
        $this->productStocks = new ArrayCollection();
        $this->batchBalances = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->internalCodes = new ArrayCollection();
        $this->uuid = Uuid::uuid4();
        $this->productPhotos = new ArrayCollection();
        $this->attributeValues = new ArrayCollection();
        $this->eCommerceTags = new ArrayCollection();
        $this->productPrices = new ArrayCollection();
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function archiving(): Product
    {
        $this->status = self::STATUS_ARCHIVE;

        return $this;
    }

    public function activation(): Product
    {
        $this->status = self::STATUS_ACTIVE;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): Product
    {
        $this->category = $category;

        return $this;
    }

    public function getActInvoices()
    {
        return $this->actInvoices;
    }

    /**
     * @return ArrayCollection|Collection|Barcode[]
     */
    public function getBarcodes()
    {
        return $this->barcodes;
    }

    /**
     * @param Barcode[] $barcodes
     *
     * @return Product
     */
    public function setBarcodes($barcodes)
    {
        $this->barcodes = $barcodes;

        return $this;
    }

    public function addBarcode(Barcode $barcode): self
    {
        if (!$this->barcodes->contains($barcode)) {
            $this->barcodes[] = $barcode;
            $barcode->setProduct($this);
        }

        return $this;
    }

    public function barcodesClear()
    {
        foreach ($this->getBarcodes() as $barcode) {
            $this->removeBarcode($barcode);
        }
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
     * @return Product
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
     * Set qty
     *
     * @param integer $qty
     *
     * @return Product
     */
    public function setQty($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * Get qty
     *
     * @return int
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set cost price
     *
     * @param float $costPrice
     *
     * @return Product
     */
    public function setCostPrice($costPrice)
    {
        $this->costPrice = $costPrice;

        return $this;
    }

    /**
     * Get cost price
     *
     * @return float
     */
    public function getCostPrice()
    {
        return $this->costPrice;
    }

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param float|null $oldPrice
     * @return Product
     */
    public function setOldPrice($oldPrice): Product
    {
        $this->oldPrice = empty($oldPrice) ? null : (float) $oldPrice;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getOldPrice(): ?float
    {
        return $this->oldPrice;
    }

    /**
     * @param $productStocks
     * @return Product
     */
    public function setProductStocks($productStocks)
    {
        $this->productStocks = $productStocks;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getProductStocks()
    {
        return $this->productStocks;
    }

    public function getSync(): ?bool
    {
        return $this->sync;
    }

    public function setSync(?bool $sync): self
    {
        $this->sync = $sync;

        return $this;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function addProductStock(ProductStock $productStock): self
    {
        if (!$this->productStocks->contains($productStock)) {
            $this->productStocks[] = $productStock;
            $productStock->setProduct($this);
        }

        return $this;
    }

    public function removeProductStock(ProductStock $productStock): self
    {
        if ($this->productStocks->contains($productStock)) {
            $this->productStocks->removeElement($productStock);
            // set the owning side to null (unless already changed)
            if ($productStock->getProduct() === $this) {
                $productStock->setProduct(null);
            }
        }

        return $this;
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
            $this->actInvoices->removeElement($actInvoice);
            // set the owning side to null (unless already changed)
            if ($actInvoice->getAct() === $this) {
                $actInvoice->setAct(null);
            }
        }

        return $this;
    }

    public function removeBarcode(Barcode $barcode): self
    {
        if ($this->barcodes->contains($barcode)) {
            $this->barcodes->removeElement($barcode);
            // set the owning side to null (unless already changed)
            if ($barcode->getProduct() === $this) {
                $barcode->setProduct(null);
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
            $batchBalance->setProduct($this);
        }

        return $this;
    }

    public function removeBatchBalance(BatchBalance $batchBalance): self
    {
        if ($this->batchBalances->contains($batchBalance)) {
            $this->batchBalances->removeElement($batchBalance);
            // set the owning side to null (unless already changed)
            if ($batchBalance->getProduct() === $this) {
                $batchBalance->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addProduct($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            $tag->removeProduct($this);
        }

        return $this;
    }

    public function tagsClear()
    {
        foreach ($this->getTags() as $tag) {
            $this->removeTag($tag);
        }
    }

    /**
     * @return Collection|InternalCode[]
     */
    public function getInternalCodes(): Collection
    {
        return $this->internalCodes;
    }

    public function addInternalCode(InternalCode $internalCode): self
    {
        if (!$this->internalCodes->contains($internalCode)) {
            $this->internalCodes[] = $internalCode;
            $internalCode->setProduct($this);
        }

        return $this;
    }

    public function removeInternalCode(InternalCode $internalCode): self
    {
        if ($this->internalCodes->contains($internalCode)) {
            $this->internalCodes->removeElement($internalCode);
            // set the owning side to null (unless already changed)
            if ($internalCode->getProduct() === $this) {
                $internalCode->setProduct(null);
            }
        }

        return $this;
    }

    public function internalCodesClear(): void
    {
        foreach ($this->getInternalCodes() as $internalCode) {
            $this->removeInternalCode($internalCode);
        }
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getSupplyQty(): ?int
    {
        return $this->supplyQty;
    }

    public function setSupplyQty(?int $supplyQty): self
    {
        $this->supplyQty = $supplyQty;

        return $this;
    }

    public function getPurchaseHelper(): ?bool
    {
        return $this->purchaseHelper;
    }

    public function setPurchaseHelper(bool $purchaseHelper): self
    {
        $this->purchaseHelper = $purchaseHelper;

        return $this;
    }

    /**
     * @return Collection|ProductPhoto[]
     */
    public function getProductPhotos(): Collection
    {
        return $this->productPhotos;
    }

    public function addProductPhoto(ProductPhoto $productPhoto): self
    {
        if (!$this->productPhotos->contains($productPhoto)) {
            $this->productPhotos[] = $productPhoto;
            $productPhoto->setProduct($this);
        }

        return $this;
    }

    public function removeProductPhoto(ProductPhoto $productPhoto): self
    {
        if ($this->productPhotos->contains($productPhoto)) {
            $this->productPhotos->removeElement($productPhoto);
            // set the owning side to null (unless already changed)
            if ($productPhoto->getProduct() === $this) {
                $productPhoto->setProduct(null);
            }
        }

        return $this;
    }

    public function getIsECommerce(): ?bool
    {
        return $this->isECommerce;
    }

    public function setIsECommerce(bool $isECommerce): self
    {
        $this->isECommerce = $isECommerce;

        return $this;
    }

    /**
     * @return Collection|AttributeValue[]
     */
    public function getAttributeValues(): Collection
    {
        return $this->attributeValues;
    }

    public function addAttributeValue(AttributeValue $attributeValue): self
    {
        if (!$this->attributeValues->contains($attributeValue)) {
            $this->attributeValues[] = $attributeValue;
            $attributeValue->setProduct($this);
        }

        return $this;
    }

    public function removeAttributeValue(AttributeValue $attributeValue): self
    {
        if ($this->attributeValues->contains($attributeValue)) {
            $this->attributeValues->removeElement($attributeValue);
            if ($attributeValue->getProduct() === $this) {
                $attributeValue->setProduct(null);
            }
        }

        return $this;
    }

    public function attributeValuesClear(): void
    {
        foreach ($this->attributeValues as $attributeValue) {
            $this->removeAttributeValue($attributeValue);
        }
    }

    public function getECommerceCategory(): ?ECommerceCategory
    {
        return $this->eCommerceCategory;
    }

    public function setECommerceCategory(?ECommerceCategory $eCommerceCategory): self
    {
        $this->eCommerceCategory = $eCommerceCategory;

        return $this;
    }

    /**
     * @return Collection|ECommerceTag[]
     */
    public function getECommerceTags(): Collection
    {
        return $this->eCommerceTags;
    }

    public function addECommerceTag(ECommerceTag $eCommerceTag): self
    {
        if (!$this->eCommerceTags->contains($eCommerceTag)) {
            $this->eCommerceTags[] = $eCommerceTag;
            $eCommerceTag->addProduct($this);
        }

        return $this;
    }

    public function removeECommerceTag(ECommerceTag $eCommerceTag): self
    {
        if ($this->eCommerceTags->contains($eCommerceTag)) {
            $this->eCommerceTags->removeElement($eCommerceTag);
            $eCommerceTag->removeProduct($this);
        }

        return $this;
    }

    public function eCommerceTagsClear()
    {
        foreach ($this->eCommerceTags as $eCommerceTag) {
            $this->removeECommerceTag($eCommerceTag);
        }
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
            $productPrice->setProduct($this);
        }

        return $this;
    }

    public function removeProductPrice(ProductPrice $productPrice): self
    {
        if ($this->productPrices->contains($productPrice)) {
            $this->productPrices->removeElement($productPrice);
            // set the owning side to null (unless already changed)
            if ($productPrice->getProduct() === $this) {
                $productPrice->setProduct(null);
            }
        }

        return $this;
    }
}
