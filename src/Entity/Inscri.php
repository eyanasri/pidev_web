<?php

namespace App\Entity;

use App\Repository\InscriRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriRepository::class)
 */
class Inscri
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Cours::class, inversedBy="inscris")
     */
    private $CourName;

    /**
     * @ORM\ManyToMany(targetEntity=Users::class, inversedBy="inscris")
     */
    private $UserMail;

    public function __construct()
    {
        $this->CourName = new ArrayCollection();
        $this->UserMail = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Cours[]
     */
    public function getCourName(): Collection
    {
        return $this->CourName;
    }

    public function addCourName(Cours $courName): self
    {
        if (!$this->CourName->contains($courName)) {
            $this->CourName[] = $courName;
        }

        return $this;
    }

    public function removeCourName(Cours $courName): self
    {
        $this->CourName->removeElement($courName);

        return $this;
    }

    /**
     * @return Collection|Users[]
     */
    public function getUserMail(): Collection
    {
        return $this->UserMail;
    }

    public function addUserMail(Users $userMail): self
    {
        if (!$this->UserMail->contains($userMail)) {
            $this->UserMail[] = $userMail;
        }

        return $this;
    }

    public function removeUserMail(Users $userMail): self
    {
        $this->UserMail->removeElement($userMail);

        return $this;
    }
}
