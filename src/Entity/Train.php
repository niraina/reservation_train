<?php

namespace App\Entity;

use App\Repository\TrainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrainRepository::class)
 */
class Train
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numerotrain;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $design;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $itineraire;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="numerotrain", orphanRemoval=true)
     */
    private $reservations;
    

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumerotrain(): ?string
    {
        return $this->numerotrain;
    }

    public function setNumerotrain(string $numerotrain): self
    {
        $this->numerotrain = $numerotrain;

        return $this;
    }

    public function getDesign(): ?string
    {
        return $this->design;
    }

    public function setDesign(string $design): self
    {
        $this->design = $design;

        return $this;
    }

    public function getItineraire(): ?string
    {
        return $this->itineraire;
    }

    public function setItineraire(string $itineraire): self
    {
        $this->itineraire = $itineraire;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setNumerotrain($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getNumerotrain() === $this) {
                $reservation->setNumerotrain(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->numerotrain;
    }
}
