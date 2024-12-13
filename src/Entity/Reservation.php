<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\GreaterThan("today + 24 hours", message: "La réservation doit être effectuée au moins 24 heures à l'avance.")]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 50)]
    private ?string $timeSlot = null;

    #[ORM\Column(length: 255)]
    private ?string $eventName = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[Assert\Callback]
    public function validateUniqueDateAndTimeSlot(ExecutionContextInterface $context)
    {
        // Logique pour vérifier si une réservation avec la même date et timeSlot existe déjà
        $existingReservation = null; // Vérifiez la base de données pour les doublons

        if ($existingReservation) {
            $context->buildViolation('Cette plage horaire est déjà réservée pour cette date.')
                ->atPath('timeSlot')
                ->addViolation();
        }
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }
    
    public function getTimeSlot(): ?string
    {
        return $this->timeSlot;
    }

    public function setTimeSlot(string $timeSlot): static
    {
        $this->timeSlot = $timeSlot;

        return $this;
    }

    public function getEventName(): ?string
    {
        return $this->eventName;
    }

    public function setEventName(string $eventName): static
    {
        $this->eventName = $eventName;

        return $this;
    }
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
