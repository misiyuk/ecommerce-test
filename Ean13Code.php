<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ean13Code.
 *
 * @ORM\Table(name="ean13code")
 * @ORM\Entity
 */
class Ean13Code
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="smallint", options={"default"="1"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="value", type="bigint", options={"default"="9000000000001","unsigned"=true})
     */
    private $value = 9000000000001;

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
     * Set value.
     *
     * @param int $value
     *
     * @return Ean13Code
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     *
     * @return Ean13Code
     */
    public static function create($value)
    {
        $entity = new self();
        $entity->id = 1;
        $entity->value = $value;

        return $entity;
    }
}
