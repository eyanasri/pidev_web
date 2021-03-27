<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TestRepository::class)
 */
class Test
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
    private $Question1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Reponse1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Question2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Reponse2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Question3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Reponse3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Question4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Reponse4;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Question5;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Reponse5;

    /**
     * @ORM\ManyToMany(targetEntity=Users::class)
     */
    private $id_uesr;

    public function __construct()
    {
        $this->id_uesr = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion1(): ?string
    {
        return $this->Question1;
    }

    public function setQuestion1(string $Question1): self
    {
        $this->Question1 = $Question1;

        return $this;
    }

    public function getReponse1(): ?string
    {
        return $this->Reponse1;
    }

    public function setReponse1(?string $Reponse1): self
    {
        $this->Reponse1 = $Reponse1;

        return $this;
    }

    public function getQuestion2(): ?string
    {
        return $this->Question2;
    }

    public function setQuestion2(string $Question2): self
    {
        $this->Question2 = $Question2;

        return $this;
    }

    public function getReponse2(): ?string
    {
        return $this->Reponse2;
    }

    public function setReponse2(string $Reponse2): self
    {
        $this->Reponse2 = $Reponse2;

        return $this;
    }

    public function getQuestion3(): ?string
    {
        return $this->Question3;
    }

    public function setQuestion3(string $Question3): self
    {
        $this->Question3 = $Question3;

        return $this;
    }

    public function getReponse3(): ?string
    {
        return $this->Reponse3;
    }

    public function setReponse3(?string $Reponse3): self
    {
        $this->Reponse3 = $Reponse3;

        return $this;
    }

    public function getQuestion4(): ?string
    {
        return $this->Question4;
    }

    public function setQuestion4(string $Question4): self
    {
        $this->Question4 = $Question4;

        return $this;
    }

    public function getReponse4(): ?string
    {
        return $this->Reponse4;
    }

    public function setReponse4(?string $Reponse4): self
    {
        $this->Reponse4 = $Reponse4;

        return $this;
    }

    public function getQuestion5(): ?string
    {
        return $this->Question5;
    }

    public function setQuestion5(string $Question5): self
    {
        $this->Question5 = $Question5;

        return $this;
    }

    public function getReponse5(): ?string
    {
        return $this->Reponse5;
    }

    public function setReponse5(?string $Reponse5): self
    {
        $this->Reponse5 = $Reponse5;

        return $this;
    }

    /**
     * @return Collection|Users[]
     */
    public function getIdUesr(): Collection
    {
        return $this->id_uesr;
    }

    public function addIdUesr(Users $idUesr): self
    {
        if (!$this->id_uesr->contains($idUesr)) {
            $this->id_uesr[] = $idUesr;
        }

        return $this;
    }

    public function removeIdUesr(Users $idUesr): self
    {
        $this->id_uesr->removeElement($idUesr);

        return $this;
    }
}
