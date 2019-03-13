<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DaySaleStat.
 *
 * @ORM\Table(name="day_sale_stat")
 * @ORM\Entity(repositoryClass="App\Repository\DaySaleStatRepository")
 */
class DaySaleStat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="day_sale_stat_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="amt_sales", type="integer")
     */
    private $amtSales;

    /**
     * @var float
     *
     * @ORM\Column(name="sum_sales", type="float")
     */
    private $sumSales;

    /**
     * @var float
     *
     * @ORM\Column(name="avg_amt_sale", type="float")
     */
    private $avgAmtSale;

    /**
     * @var float
     *
     * @ORM\Column(name="avg_qty_sale", type="float")
     */
    private $avgQtySale;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetimetz")
     */
    private $createdAt;

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
     * Set amtSales.
     *
     * @param int $amtSales
     *
     * @return DaySaleStat
     */
    public function setAmtSales($amtSales)
    {
        $this->amtSales = $amtSales;

        return $this;
    }

    /**
     * Get amtSales.
     *
     * @return int
     */
    public function getAmtSales()
    {
        return $this->amtSales;
    }

    /**
     * Set sumSales.
     *
     * @param float $sumSales
     *
     * @return DaySaleStat
     */
    public function setSumSales($sumSales)
    {
        $this->sumSales = $sumSales;

        return $this;
    }

    /**
     * Get sumSales.
     *
     * @return float
     */
    public function getSumSales()
    {
        return $this->sumSales;
    }

    /**
     * Set avgAmtSale.
     *
     * @param float $avgAmtSale
     *
     * @return DaySaleStat
     */
    public function setAvgAmtSale($avgAmtSale)
    {
        $this->avgAmtSale = $avgAmtSale;

        return $this;
    }

    /**
     * Get avgAmtSale.
     *
     * @return float
     */
    public function getAvgAmtSale()
    {
        return $this->avgAmtSale;
    }

    /**
     * Set avgQtySale.
     *
     * @param float $avgQtySale
     *
     * @return DaySaleStat
     */
    public function setAvgQtySale($avgQtySale)
    {
        $this->avgQtySale = $avgQtySale;

        return $this;
    }

    /**
     * Get avgQtySale.
     *
     * @return float
     */
    public function getAvgQtySale()
    {
        return $this->avgQtySale;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return DaySaleStat
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
