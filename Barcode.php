<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Barcode.
 *
 * @ORM\Table(name="barcode")
 * @ORM\Entity(repositoryClass="App\Repository\BarcodeRepository")
 */
class Barcode
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
     * @var string
     *
     * @ORM\Column(name="value", type="string", unique=true)
     */
    private $value;

    /**
     * @var \App\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="barcodes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /***
     * @param int $value
     *
     * @return Barcode
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return Barcode
     */
    public function setProduct(?Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    public static function create(string $value): self
    {
        $barcode = new self();
        $barcode->value = $value;

        return $barcode;
    }
}
