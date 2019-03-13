<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PurchaseRepository")
 */
class Purchase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $deliveryCost;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Act", cascade={"persist", "remove"}, orphanRemoval=true, inversedBy="purchase")
     * @ORM\JoinColumn(name="act_id", referencedColumnName="id", nullable=false)
     */
    private $act;

    /**
     * @ORM\Column(type="boolean", options={"default"=true})
     */
    private $confirmed;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeliveryCost(): ?float
    {
        return $this->deliveryCost;
    }

    public function setDeliveryCost(float $deliveryCost): self
    {
        $this->deliveryCost = $deliveryCost;

        return $this;
    }

    public function getAct(): ?Act
    {
        return $this->act;
    }

    public function setAct(Act $act): self
    {
        $act->setType(Act::PURCHASE_TYPE);
        $this->act = $act;

        return $this;
    }

    public function getConfirmed(): ?bool
    {
        return $this->confirmed;
    }

    public function setConfirmed(bool $confirmed): self
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
