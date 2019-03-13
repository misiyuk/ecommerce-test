<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportColumn.
 *
 * @ORM\Table(name="report_column")
 * @ORM\Entity(repositoryClass="App\Repository\ReportColumnRepository")
 */
class ReportColumn
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="sum", type="boolean")
     */
    private $sum = false;

    /**
     * @var \App\Entity\Report
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Report", inversedBy="columns")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="report_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $report;

    public function getReport(): ?Report
    {
        return $this->report;
    }

    public function setReport(?Report $report): void
    {
        $this->report = $report;
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
     * @param string $name
     *
     * @return ReportColumn
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set sum.
     *
     *
     * @return ReportColumn
     */
    public function setSum(bool $sum)
    {
        $this->sum = $sum;

        return $this;
    }

    /**
     * Get sum.
     *
     * @return bool
     */
    public function getSum()
    {
        return $this->sum;
    }
}
