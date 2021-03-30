<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;




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
     * @Assert\NotBlank()
     */
    private $NomCompletCours;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $NomAbergeCours;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    private $DateDebutCours;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    private $DateFinCours;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $Categorie;

    /**
     * @ORM\OneToOne(targetEntity=Inscription::class, mappedBy="id_cours", cascade={"persist", "remove"})
     */
    private $inscription;

    /**
     * @ORM\ManyToMany(targetEntity=Inscri::class, mappedBy="CourName")
     */
    private $inscris;

    public function __construct()
    {
        $this->DateDebutCours = new \DateTime('now');
        $this->DateFinCours = new \DateTime('now');
        $this->inscris = new ArrayCollection();
    }




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

    public function getCategorie()
    {
        return $this->Categorie;
    }

    public function setCategorie($Categorie)
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getInscription(): ?Inscription
    {
        return $this->inscription;
    }

    public function setInscription(Inscription $inscription): self
    {
        // set the owning side of the relation if necessary
        if ($inscription->getIdCours() !== $this) {
            $inscription->setIdCours($this);
        }

        $this->inscription = $inscription;

        return $this;
    }
    public function __toString(){
        return $this->NomCompletCours;
    }

    /**
     * @return Collection|Inscri[]
     */
    public function getInscris(): Collection
    {
        return $this->inscris;
    }

    public function addInscri(Inscri $inscri): self
    {
        if (!$this->inscris->contains($inscri)) {
            $this->inscris[] = $inscri;
            $inscri->addCourName($this);
        }

        return $this;
    }

    public function removeInscri(Inscri $inscri): self
    {
        if ($this->inscris->removeElement($inscri)) {
            $inscri->removeCourName($this);
        }

        return $this;
    }


}
