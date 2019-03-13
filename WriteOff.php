<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WriteOffRepository")
 */
class WriteOff
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employee", inversedBy="writeOffs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employee;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Act", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $act;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getAct(): ?Act
    {
        return $this->act;
    }

    public function setAct(Act $act): self
    {
        $this->act = $act;

        return $this;
    }
}
