<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * CashIncome.
 *
 * @ORM\Table(name="cash_income")
 * @ORM\Entity(repositoryClass="App\Repository\CashIncomeRepository")
 */
class CashIncome
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="retail_shift_uuid", type="guid")
     */
    private $retailShiftUuid;

    /**
     * @var float
     *
     * @ORM\Column(name="amt", type="float")
     */
    private $amt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetimetz")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="msg", type="string", length=255)
     */
    private $msg;

    /**
     * CashIncome constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
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
     * Set retailShiftUuid.
     *
     * @param string $retailShiftUuid
     *
     * @return CashIncome
     */
    public function setRetailShiftUuid($retailShiftUuid)
    {
        $this->retailShiftUuid = $retailShiftUuid;

        return $this;
    }

    /**
     * Get retailShiftUuid.
     *
     * @return string
     */
    public function getRetailShiftUuid()
    {
        return $this->retailShiftUuid;
    }

    /**
     * Set amt.
     *
     * @param float $amt
     *
     * @return CashIncome
     */
    public function setAmt($amt)
    {
        $this->amt = $amt;

        return $this;
    }

    /**
     * Get amt.
     *
     * @return float
     */
    public function getAmt()
    {
        return $this->amt;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return CashIncome
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

    /**
     * Set msg.
     *
     * @param string $msg
     *
     * @return CashIncome
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }

    /**
     * Get msg.
     *
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }
}
