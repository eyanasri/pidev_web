<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionRepository::class)
 */
class Inscription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Cours::class, inversedBy="inscription", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_cours;

    /**
     * @ORM\OneToOne(targetEntity=Users::class, inversedBy="inscription", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCours(): ?Cours
    {
        return $this->id_cours;
    }

    public function setIdCours(Cours $id_cours): self
    {
        $this->id_cours = $id_cours;

        return $this;
    }

    public function getIdUser(): ?Users
    {
        return $this->id_user;
    }

    public function setIdUser(Users $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }
}
