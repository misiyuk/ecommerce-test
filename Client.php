<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Client.
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client implements UserInterface
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
     * @var int|null
     *
     * @ORM\Column(name="contractor_id", type="integer", nullable=true)
     */
    private $contractorId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="father_name", type="string", length=255, nullable=true)
     */
    private $fatherName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mobile_phone", type="string", length=255, nullable=true)
     */
    private $mobilePhone;

    /**
     * @var float|null
     *
     * @ORM\Column(name="amt_bonus", type="float", nullable=true)
     */
    private $amtBonus;

    /**
     * @var int|null
     *
     * @ORM\Column(name="amt_sales", type="integer", nullable=true)
     */
    private $amtSales;

    /**
     * @var float|null
     *
     * @ORM\Column(name="avg_sale", type="float", nullable=true)
     */
    private $avgSale;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bonus_card", type="string", length=255, nullable=true)
     */
    private $bonusCard;

    /**
     * @var string|null
     *
     * @ORM\Column(name="instagram_id", type="string", nullable=true)
     */
    private $instagramId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="age", type="integer", nullable=true)
     */
    private $age;

    /**
     * @var int|null
     *
     * @ORM\Column(name="type_skin", type="integer", nullable=true)
     */
    private $typeSkin;

    /**
     * @var int|null
     *
     * @ORM\Column(name="refferer_id", type="integer", nullable=true)
     */
    private $reffererId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code", type="string", nullable=true)
     */
    private $code;

    /**
     * @var int|null
     *
     * @ORM\Column(name="amt_promo", type="integer", nullable=true)
     */
    private $amtPromo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="auth_instagram_token", type="string", length=255, nullable=true)
     */
    private $authInstagramToken;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Sale", mappedBy="contractor")
     */
    private $sales;

    /**
     * @var \App\Entity\Contractor
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Contractor", inversedBy="clients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contractor_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $contractor;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $zip;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClientCartItem", mappedBy="client", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $clientCartItems;

    /**
     * @ORM\OneToMany(targetEntity="ClientOrder", mappedBy="client", orphanRemoval=true, cascade={"persist"})
     */
    private $orders;

    public function __construct()
    {
        $this->sales = new ArrayCollection();
        $this->clientCartItems = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function getSales()
    {
        return $this->sales;
    }

    public function getContractor()
    {
        return $this->contractor;
    }

    public function setContractor($contractor): self
    {
        $this->contractor = $contractor;

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
     * Set contractorId.
     *
     * @param int $contractorId
     *
     * @return Client
     */
    public function setContractorId($contractorId)
    {
        $this->contractorId = $contractorId;

        return $this;
    }

    /**
     * Get contractorId.
     *
     * @return int
     */
    public function getContractorId()
    {
        return $this->contractorId;
    }

    /**
     * Set firstName.
     *
     * @param string $firstName
     *
     * @return Client
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set secondName.
     *
     * @param string $fatherName
     *
     * @return Client
     */
    public function setFatherName($fatherName)
    {
        $this->fatherName = $fatherName;

        return $this;
    }

    /**
     * Get secondName.
     *
     * @return string
     */
    public function getFatherName()
    {
        return $this->fatherName;
    }

    /**
     * Set lastName.
     *
     * @param string $lastName
     *
     * @return Client
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set mobilePhone.
     *
     * @param string $mobilePhone
     *
     * @return Client
     */
    public function setMobilePhone($mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    /**
     * Get mobilePhone.
     *
     * @return string
     */
    public function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    /**
     * Set amtBonus.
     *
     * @param float $amtBonus
     *
     * @return Client
     */
    public function setAmtBonus($amtBonus)
    {
        $this->amtBonus = $amtBonus;

        return $this;
    }

    /**
     * Get amtBonus.
     *
     * @return float
     */
    public function getAmtBonus()
    {
        return $this->amtBonus;
    }

    /**
     * Set amtSales.
     *
     * @param int $amtSales
     *
     * @return Client
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
     * Set avgSale.
     *
     * @param float $avgSale
     *
     * @return Client
     */
    public function setAvgSale($avgSale)
    {
        $this->avgSale = $avgSale;

        return $this;
    }

    /**
     * Get avgSale.
     *
     * @return float
     */
    public function getAvgSale()
    {
        return $this->avgSale;
    }

    /**
     * Set bonusCard.
     *
     * @param float $bonusCard
     *
     * @return Client
     */
    public function setBonusCard($bonusCard)
    {
        $this->bonusCard = $bonusCard;

        return $this;
    }

    /**
     * Get bonusCard.
     *
     * @return string
     */
    public function getBonusCard()
    {
        return $this->bonusCard;
    }

    public function getShortFullName()
    {
        return $this->lastName.' '.mb_substr($this->firstName, 0, 1).'. '.mb_substr($this->fatherName, 0, 1).'.';
    }

    public function getInstagramId(): ?string
    {
        return $this->instagramId;
    }

    public function setInstagramId(?string $instagramId): self
    {
        $this->instagramId = $instagramId;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getTypeSkin(): ?int
    {
        return $this->typeSkin;
    }

    public function setTypeSkin(?int $typeSkin): self
    {
        $this->typeSkin = $typeSkin;

        return $this;
    }

    public function getReffererId(): ?int
    {
        return $this->reffererId;
    }

    public function setReffererId(?int $reffererId): self
    {
        $this->reffererId = $reffererId;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getAmtPromo(): ?int
    {
        return $this->amtPromo;
    }

    public function setAmtPromo(?int $amtPromo): self
    {
        $this->amtPromo = $amtPromo;

        return $this;
    }

    public function getAuthInstagramToken(): ?string
    {
        return $this->authInstagramToken;
    }

    public function setAuthInstagramToken(?string $authInstagramToken): self
    {
        $this->authInstagramToken = $authInstagramToken;

        return $this;
    }

    public function addSale(Sale $sale): self
    {
        if (!$this->sales->contains($sale)) {
            $this->sales[] = $sale;
            $sale->setContractor($this);
        }

        return $this;
    }

    public function removeSale(Sale $sale): self
    {
        if ($this->sales->contains($sale)) {
            $this->sales->removeElement($sale);
            // set the owning side to null (unless already changed)
            if ($sale->getContractor() === $this) {
                $sale->setContractor(null);
            }
        }

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->mobilePhone;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(?string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(?string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * @return Collection|ClientCartItem[]
     */
    public function getClientCartItems(): Collection
    {
        return $this->clientCartItems;
    }

    public function addClientCartItem(ClientCartItem $clientCartItem): self
    {
        if (!$this->clientCartItems->contains($clientCartItem)) {
            $this->clientCartItems[] = $clientCartItem;
            $clientCartItem->setClient($this);
        }

        return $this;
    }

    public function removeClientCartItem(ClientCartItem $clientCartItem): self
    {
        if ($this->clientCartItems->contains($clientCartItem)) {
            $this->clientCartItems->removeElement($clientCartItem);
            // set the owning side to null (unless already changed)
            if ($clientCartItem->getClient() === $this) {
                $clientCartItem->setClient(null);
            }
        }

        return $this;
    }

    public function clearClientCartItems()
    {
        foreach ($this->clientCartItems as $item) {
            $this->removeClientCartItem($item);
        }
    }

    /**
     * @return Collection|ClientOrder[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(ClientOrder $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setClient($this);
        }

        return $this;
    }

    public function removeOrder(ClientOrder $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getClient() === $this) {
                $order->setClient(null);
            }
        }

        return $this;
    }

    public function foolName(): string
    {
        return "{$this->firstName} {$this->fatherName} {$this->lastName}";
    }

    public function isValidAddress(): bool
    {
        return $this->city && $this->address1 && $this->zip;
    }
}
