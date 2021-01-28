<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Train::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $numerotrain;

    /**
     * @ORM\ManyToOne(targetEntity=Voyageur::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $numerovoyageur;

    /**
     * @ORM\Column(type="date")
     */
    private $datereservation;

    /**
     * @ORM\Column(type="integer")
     */
    private $frais;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumerotrain(): ?Train
    {
        return $this->numerotrain;
    }

    public function setNumerotrain(?Train $numerotrain): self
    {
        $this->numerotrain = $numerotrain;

        return $this;
    }

    public function getNumerovoyageur(): ?Voyageur
    {
        return $this->numerovoyageur;
    }

    public function setNumerovoyageur(?Voyageur $numerovoyageur): self
    {
        $this->numerovoyageur = $numerovoyageur;

        return $this;
    }

    public function getDatereservation(): ?\DateTimeInterface
    {
        return $this->datereservation;
    }

    public function setDatereservation(\DateTimeInterface $datereservation): self
    {
        $this->datereservation = $datereservation;

        return $this;
    }

    public function getFrais(): ?int
    {
        return $this->frais;
    }

    public function setFrais(int $frais): self
    {
        $this->frais = $frais;

        return $this;
    }
}
