<?php

namespace App\Entity;

use App\Repository\MeetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MeetRepository::class)
 */
class Meet
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
    private $titre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity=Users::class)
     */
    private $id_meet;

    public function __construct()
    {
        $this->id_meet = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|Users[]
     */
    public function getIdMeet(): Collection
    {
        return $this->id_meet;
    }

    public function addIdMeet(Users $idMeet): self
    {
        if (!$this->id_meet->contains($idMeet)) {
            $this->id_meet[] = $idMeet;
        }

        return $this;
    }

    public function removeIdMeet(Users $idMeet): self
    {
        $this->id_meet->removeElement($idMeet);

        return $this;
    }
}
