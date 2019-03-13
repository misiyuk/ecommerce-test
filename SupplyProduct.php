<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SupplyProductRepository")
 */
class SupplyProduct
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ActInvoice", inversedBy="supplyProduct", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $actInvoice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $internalCode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActInvoice(): ?ActInvoice
    {
        return $this->actInvoice;
    }

    public function setActInvoice(ActInvoice $actInvoice): self
    {
        $this->actInvoice = $actInvoice;

        return $this;
    }

    public function getInternalCode(): ?string
    {
        return $this->internalCode;
    }

    public function setInternalCode(?string $internalCode): self
    {
        $this->internalCode = $internalCode;

        return $this;
    }
}
