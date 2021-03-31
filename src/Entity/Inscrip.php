<?php

namespace App\Entity;

use App\Repository\InscripRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscripRepository::class)
 */
class Inscrip
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
    private $courNom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $courEmail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourNom(): ?string
    {
        return $this->courNom;
    }

    public function setCourNom(string $courNom): self
    {
        $this->courNom = $courNom;

        return $this;
    }

    public function getCourEmail(): ?string
    {
        return $this->courEmail;
    }

    public function setCourEmail(string $courEmail): self
    {
        $this->courEmail = $courEmail;

        return $this;
    }
}
