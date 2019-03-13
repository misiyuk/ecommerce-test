<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * SpendCategory.
 *
 * @ORM\Table(name="spend_category")
 * @ORM\Entity(repositoryClass="App\Repository\SpendCategoryRepository")
 */
class SpendCategory implements CategoryInterface
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Spend", mappedBy="category")
     */
    private $spends;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\SpendCategory", mappedBy="parent")
     */
    private $children;

    /**
     * @var \App\Entity\SpendCategory
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\SpendCategory", inversedBy="children")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $parent;

    public function __construct()
    {
        $this->spends = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

    /**
     * @return SpendCategory[]|ArrayCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    public function getParent(): ?CategoryInterface
    {
        return $this->parent;
    }

    public function setParent(?CategoryInterface $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Spend[]|ArrayCollection
     */
    public function getSpends()
    {
        return $this->spends;
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
     * Set name.
     *
     *
     * @return SpendCategory
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    public function addSpend(Spend $spend): self
    {
        if (!$this->spends->contains($spend)) {
            $this->spends[] = $spend;
            $spend->setCategory($this);
        }

        return $this;
    }

    public function removeSpend(Spend $spend): self
    {
        if ($this->spends->contains($spend)) {
            $this->spends->removeElement($spend);
            // set the owning side to null (unless already changed)
            if ($spend->getCategory() === $this) {
                $spend->setCategory(null);
            }
        }

        return $this;
    }

    public function addChild(self $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): self
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }
}
