<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Spend.
 *
 * @ORM\Table(name="spend")
 * @ORM\Entity(repositoryClass="App\Repository\SpendRepository")
 */
class Spend
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
     * @var float
     *
     * @ORM\Column(name="cost", type="float")
     */
    private $cost;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetimetz")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

    /**
     * @var \App\Entity\SpendCategory
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\SpendCategory", inversedBy="spends")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $category;

    public function getCategory(): ?SpendCategory
    {
        return $this->category;
    }

    public function setCategory(SpendCategory $spendCategory): self
    {
        $this->category = $spendCategory;

        return $this;
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
     * Set cost.
     *
     * @param float $cost
     *
     * @return Spend
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost.
     *
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Spend
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set comment.
     *
     * @param string $comment
     *
     * @return Spend
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
}
