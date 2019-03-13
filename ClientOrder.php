<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientOrderRepository")
 */
class ClientOrder
{
    const SHIPPING_METHODS = [
        'courier' => [
            'id' => 1,
            'name' => 'Курьер',
            'cost' => 100,
            'deliveryTime' => 'От 1 до 7 дней',
        ],
        'mail' => [
            'id' => 2,
            'name' => 'Почта',
            'cost' => 50,
            'deliveryTime' => 'От 7 до 30 дней',
        ],
        'pickup' => [
            'id' => 3,
            'name' => 'Самовывоз',
            'cost' => 0,
            'deliveryTime' => '—',
        ],
    ];
    const STATUSES = [
        'payment' => -1,
        'creating' => 0,
        'new' => 1,
        'processing' => 2,
        'shipped' => 3,
        'delivered' => 4,
    ];
    const STATUS_LABELS = [
        self::STATUSES['payment'] => [
            'label' => 'Оплачивается',
            'type' => 'warning',
        ],
        self::STATUSES['creating'] => [
            'label' => 'Оформляется',
            'type' => 'muted',
        ],
        self::STATUSES['new'] => [
            'label' => 'Новый',
            'type' => 'info',
        ],
        self::STATUSES['processing'] => [
            'label' => 'В обработке',
            'type' => 'primary',
        ],
        self::STATUSES['shipped'] => [
            'label' => 'Отправлен',
            'type' => 'dark',
        ],
        self::STATUSES['delivered'] => [
            'label' => 'Доставлен',
            'type' => 'success',
        ],
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\Column(type="integer")
     */
    private $shippingMethod;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Act", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $act;

    public function __construct()
    {
        $this->status = self::STATUSES['creating'];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getShippingMethod(): ?int
    {
        return $this->shippingMethod;
    }

    public function getShippingMethodCost(): ?float
    {
        $arr = array_filter(self::SHIPPING_METHODS, function (array $method) {
            return $method['id'] === $this->getShippingMethod();
        });

        return reset($arr)['cost'] ?? null;
    }

    public function setShippingMethod(int $shippingMethod): self
    {
        $this->shippingMethod = $shippingMethod;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAct(): ?Act
    {
        return $this->act;
    }

    public function setAct(?Act $act): self
    {
        $act->setType(Act::ORDER);
        $this->act = $act;

        return $this;
    }

    public function cost(): float
    {
        return array_sum(
                array_map(
                    function (ActInvoice $ai) {
                        return $ai->getPrice() * $ai->getQty();
                    },
                    $this->getAct()->getActInvoices()->toArray()
                )
            ) + $this->getShippingMethodCost()
        ;
    }

    public function getStatusLabel(): ?string
    {
        return self::STATUS_LABELS[$this->status]['label'] ?? null;
    }

    public function getStatusType(): ?string
    {
        return self::STATUS_LABELS[$this->status]['type'] ?? null;
    }

    public function updatePrices()
    {
        foreach ($this->getAct()->getActInvoices() as $ai) {
            $price = $ai->getProduct()->getPrice();
            $ai->setPrice($price);
            $costPrice = $ai->getProduct()->getCostPrice();
            $ai->setCostPrice($costPrice);
        }
    }
}
