<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttributeValueRepository")
 */
class AttributeValue
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="attributeValues")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Attribute")
     * @ORM\JoinColumn(nullable=false)
     */
    private $attribute;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $value;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AttributeOption", inversedBy="attributeValues", cascade={"persist"})
     */
    private $values;

    public function __construct()
    {
        $this->values = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAttribute(): ?Attribute
    {
        return $this->attribute;
    }

    public function setAttribute(?Attribute $attribute): self
    {
        $this->attribute = $attribute;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection|AttributeOption[]
     * @throws
     */
    public function getValues(): Collection
    {
        $this->isMultipleText();

        return $this->values;
    }

    /**
     * @throws
     */
    public function addValue(AttributeOption $value): self
    {
        $this->isMultipleText();
        if (!$this->values->contains($value)) {
            $this->values[] = $value;
        }

        return $this;
    }

    /**
     * @throws
     */
    public function removeValue(AttributeOption $value): self
    {
        $this->isMultipleText();
        if ($this->values->contains($value)) {
            $this->values->removeElement($value);
        }

        return $this;
    }

    public function valuesClear()
    {
        foreach ($this->values as $value) {
            $this->removeValue($value);
        }
    }

    /**
     * @throws
     */
    private function isMultipleText(): void
    {
        if (!$this->getAttribute() || $this->getAttribute()->getType() !== Attribute::TYPES['multiple_text']) {
            throw new \Exception('Invalid attribute type');
        }
    }
}
