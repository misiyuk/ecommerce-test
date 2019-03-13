<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttributeRepository")
 */
class Attribute
{
    const TYPES = [
        'text' => 1,
        'multiple_text' => 2,
    ];

    const TYPE_LABELS = [
        self::TYPES['text'] => 'Текст',
        self::TYPES['multiple_text'] => 'Множественный',
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="smallint")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AttributeOption", mappedBy="attribute", cascade={"persist"}, orphanRemoval=true)
     */
    private $attributeOptions;

    public function __construct()
    {
        $this->attributeOptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|AttributeOption[]
     */
    public function getAttributeOptions(): Collection
    {
        return $this->attributeOptions;
    }

    public function addAttributeOption(AttributeOption $attributeOption): self
    {
        if (!$this->attributeOptions->contains($attributeOption)) {
            $this->attributeOptions[] = $attributeOption;
            $attributeOption->setAttribute($this);
        }

        return $this;
    }

    public function removeAttributeOption(AttributeOption $attributeOption): self
    {
        if ($this->attributeOptions->contains($attributeOption)) {
            $this->attributeOptions->removeElement($attributeOption);
            if ($attributeOption->getAttribute() === $this) {
                $attributeOption->setAttribute(null);
            }
        }

        return $this;
    }

    public function clearAttributeOptions(): void
    {
        foreach ($this->attributeOptions as $attributeOption) {
            $this->removeAttributeOption($attributeOption);
        }
    }

    public function getTypeLabel(): string
    {
        return self::TYPE_LABELS[$this->type] ?? 'Не задан';
    }

    public function isMultipleText(): bool
    {
        return $this->type == self::TYPES['multiple_text'];
    }
}
