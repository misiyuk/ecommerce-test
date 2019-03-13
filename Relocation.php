<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RelocationRepository")
 */
class Relocation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Act", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $fromAct;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Act", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $toAct;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromAct(): ?Act
    {
        return $this->fromAct;
    }

    public function setFromAct(Act $fromAct): self
    {
        $this->fromAct = $fromAct;

        return $this;
    }

    public function getToAct(): ?Act
    {
        return $this->toAct;
    }

    public function setToAct(Act $toAct): self
    {
        $this->toAct = $toAct;

        return $this;
    }

    public static function create(Act $from, Act $to): self
    {
        $relocation = new self();
        $relocation->fromAct = $from;
        $relocation->toAct = $to;

        return $relocation;
    }
}
