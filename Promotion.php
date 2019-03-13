<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Promotion.
 *
 * @ORM\Table(name="promotion")
 * @ORM\Entity(repositoryClass="App\Repository\PromotionRepository")
 */
class Promotion
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
     * @var \DateTime
     *
     * @ORM\Column(name="open", type="datetimetz")
     */
    private $open;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="close", type="datetimetz")
     */
    private $close;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\PromotionProduct", mappedBy="promotion", cascade={"persist","remove"})
     */
    private $promotionProducts;

    public function __construct()
    {
        $this->promotionProducts = new ArrayCollection();
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
     * Set open.
     *
     * @param \DateTime $open
     *
     * @return Promotion
     */
    public function setOpen($open)
    {
        $this->open = $open;

        return $this;
    }

    /**
     * Get open.
     *
     * @return \DateTime
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * Set close.
     *
     * @param \DateTime $close
     *
     * @return Promotion
     */
    public function setClose($close)
    {
        $this->close = $close;

        return $this;
    }

    /**
     * Get close.
     *
     * @return \DateTime
     */
    public function getClose()
    {
        return $this->close;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ArrayCollection|PromotionProduct[] $promotionProducts
     */
    public function setPromotionProducts($promotionProducts): self
    {
        if (\is_array($promotionProducts)) {
            $promotionProducts = new ArrayCollection($promotionProducts);
        }
        $this->promotionProducts->clear();
        foreach ($promotionProducts as $promotionProduct) {
            $promotionProduct->setPromotion($this);
            $this->promotionProducts->add($promotionProduct);
        }
        $this->promotionProducts = $promotionProducts;

        return $this;
    }

    public function getPromotionProducts(): Collection
    {
        return $this->promotionProducts;
    }

    public function addPromotionProduct(PromotionProduct $promotionProduct): self
    {
        if (!$this->promotionProducts->contains($promotionProduct)) {
            $this->promotionProducts[] = $promotionProduct;
            $promotionProduct->setPromotion($this);
        }

        return $this;
    }

    public function removePromotionProduct(PromotionProduct $promotionProduct): self
    {
        if ($this->promotionProducts->contains($promotionProduct)) {
            $this->promotionProducts->removeElement($promotionProduct);
            // set the owning side to null (unless already changed)
            if ($promotionProduct->getPromotion() === $this) {
                $promotionProduct->setPromotion(null);
            }
        }

        return $this;
    }
}
