<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientInstagramStep.
 *
 * @ORM\Table(name="client_instagram_step")
 * @ORM\Entity(repositoryClass="App\Repository\ClientInstagramStepRepository")
 */
class ClientInstagramStep
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
     * @var int
     *
     * @ORM\Column(name="client_id", type="integer")
     */
    private $clientId;

    /**
     * @var int
     *
     * @ORM\Column(name="current_step", type="integer")
     */
    private $currentStep;

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
     * Set clientId.
     *
     * @param int $clientId
     *
     * @return ClientInstagramStep
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId.
     *
     * @return int
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set currentStep.
     *
     * @param int $currentStep
     *
     * @return ClientInstagramStep
     */
    public function setCurrentStep($currentStep)
    {
        $this->currentStep = $currentStep;

        return $this;
    }

    /**
     * Get currentStep.
     *
     * @return int
     */
    public function getCurrentStep()
    {
        return $this->currentStep;
    }
}
