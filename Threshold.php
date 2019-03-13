<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Threshold
 *
 * @ORM\Table(name="threshold")
 * @ORM\Entity(repositoryClass="App\Repository\ThresholdRepository")
 */
class Threshold
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="threshold_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="value", type="float")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Store", inversedBy="thresholds")
     * @ORM\JoinColumn(nullable=false)
     */
    private $store;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

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
