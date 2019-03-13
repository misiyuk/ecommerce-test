<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Report.
 *
 * @ORM\Table(name="report")
 * @ORM\Entity(repositoryClass="App\Repository\ReportRepository")
 */
class Report
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
     * @ORM\Column(name="query", type="string", length=1000)
     */
    private $query;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=1000)
     */
    private $title;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ReportColumn", mappedBy="report")
     */
    private $columns;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ReportCondition", mappedBy="report")
     */
    private $conditions;

    public function __construct()
    {
        $this->columns = new ArrayCollection();
        $this->conditions = new ArrayCollection();
    }

    /**
     * @return ReportColumn[]|ArrayCollection
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @throws \Exception
     *
     * @return ReportColumn[]
     */
    public function getReverseColumns()
    {
        if ($this->getColumns() instanceof Collection) {
            $columns = $this->getColumns()->toArray();
            krsort($columns);

            return array_values($columns);
        }
        throw new \Exception('Report columns not support this method');
    }

    /**
     * @return ReportCondition[]|ArrayCollection
     */
    public function getConditions()
    {
        return $this->conditions;
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
     * Set query.
     *
     * @param string $query
     *
     * @return Report
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get query.
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Report
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function addColumn(ReportColumn $column): self
    {
        if (!$this->columns->contains($column)) {
            $this->columns[] = $column;
            $column->setReport($this);
        }

        return $this;
    }

    public function removeColumn(ReportColumn $column): self
    {
        if ($this->columns->contains($column)) {
            $this->columns->removeElement($column);
            // set the owning side to null (unless already changed)
            if ($column->getReport() === $this) {
                $column->setReport(null);
            }
        }

        return $this;
    }

    public function addCondition(ReportCondition $condition): self
    {
        if (!$this->conditions->contains($condition)) {
            $this->conditions[] = $condition;
            $condition->setReport($this);
        }

        return $this;
    }

    public function removeCondition(ReportCondition $condition): self
    {
        if ($this->conditions->contains($condition)) {
            $this->conditions->removeElement($condition);
            // set the owning side to null (unless already changed)
            if ($condition->getReport() === $this) {
                $condition->setReport(null);
            }
        }

        return $this;
    }
}
