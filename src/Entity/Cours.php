<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 */
class Cours
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
    private $NomCompletCours;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomAbergeCours;

    /**
     * @ORM\Column(type="date")
     */
    private $DateDebutCours;

    /**
     * @ORM\Column(type="date")
     */
    private $DateFinCours;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Categorie;






    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCompletCours(): ?string
    {
        return $this->NomCompletCours;
    }

    public function setNomCompletCours(string $NomCompletCours): self
    {
        $this->NomCompletCours = $NomCompletCours;

        return $this;
    }

    public function getNomAbergeCours(): ?string
    {
        return $this->NomAbergeCours;
    }

    public function setNomAbergeCours(string $NomAbergeCours): self
    {
        $this->NomAbergeCours = $NomAbergeCours;

        return $this;
    }

    public function getDateDebutCours(): ?\DateTimeInterface
    {
        return $this->DateDebutCours;
    }

    public function setDateDebutCours(\DateTimeInterface $DateDebutCours): self
    {
        $this->DateDebutCours = $DateDebutCours;

        return $this;
    }

    public function getDateFinCours(): ?\DateTimeInterface
    {
        return $this->DateFinCours;
    }

    public function setDateFinCours(\DateTimeInterface $DateFinCours): self
    {
        $this->DateFinCours = $DateFinCours;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->Categorie;
    }

    public function setCategorie(string $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }




}
