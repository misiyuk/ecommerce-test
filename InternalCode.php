<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InternalCodeRepository")
 */
class InternalCode
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="internalCodes")
     */
    private $product;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ActInvoice", inversedBy="internalCode")
     * @ORM\JoinColumn(name="act_invoice_id", referencedColumnName="id", nullable=true)
     */
    private $actInvoice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public static function create(string $value, Product $product, ?ActInvoice $actInvoice): self
    {
        $internalCode = new self();
        $internalCode->value = $value;
        $internalCode->product = $product;
        $internalCode->actInvoice = $actInvoice;

        return $internalCode;
    }

    public function getActInvoice(): ?ActInvoice
    {
        return $this->actInvoice;
    }

    public function setActInvoice(?ActInvoice $actInvoice): self
    {
        $this->actInvoice = $actInvoice;

        return $this;
    }
}
