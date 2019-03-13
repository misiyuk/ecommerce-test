<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportCondition.
 *
 * @ORM\Table(name="report_condition")
 * @ORM\Entity(repositoryClass="App\Repository\ReportConditionRepository")
 */
class ReportCondition
{
    const FIELD_TYPES = [
        'Текст',
        'Дата',
        'Список',
    ];

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
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="entity", type="string", length=255, nullable=true)
     */
    private $entity;

    /**
     * @var string
     *
     * @ORM\Column(name="field_type", type="string", length=255)
     */
    private $fieldType;

    /**
     * @var \App\Entity\Report
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Report", inversedBy="conditions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="report_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $report;

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
     * @return ReportCondition
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
     * Set value.
     *
     * @param string $value
     *
     * @return ReportCondition
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set entity.
     *
     * @param string $entity
     *
     * @return ReportCondition
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get entity.
     *
     * @return string
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @return string
     */
    public function getEntityName()
    {
        return explode('|', $this->entity)[0];
    }

    /**
     * @return string
     */
    public function getEntityField()
    {
        return explode('|', $this->entity)[1];
    }

    /**
     * Set report.
     *
     *
     * @return ReportCondition
     */
    public function setReport(Report $report)
    {
        $this->report = $report;

        return $this;
    }

    /**
     * Get report.
     *
     * @return Report|null
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * Set field type.
     *
     * @param $fieldType
     *
     * @throws \Exception
     *
     * @return $this
     */
    public function setFieldType($fieldType)
    {
        if (\in_array($fieldType, self::FIELD_TYPES, true)) {
            $this->fieldType = $fieldType;
        } else {
            throw new \Exception('Недопустимое значение');
        }

        return $this;
    }

    /**
     * Get field type.
     *
     * @return string
     */
    public function getFieldType()
    {
        return $this->fieldType;
    }
}
