<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cv;

    /**
     * @ORM\ManyToMany(targetEntity=Users::class)
     */
    private $id_user;

    /**
     * @ORM\ManyToOne(targetEntity=Comment::class, inversedBy="id_user")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_note;

    public function __construct()
    {
        $this->id_user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * @return Collection|Users[]
     */
    public function getIdUser(): Collection
    {
        return $this->id_user;
    }

    public function addIdUser(Users $idUser): self
    {
        if (!$this->id_user->contains($idUser)) {
            $this->id_user[] = $idUser;
        }

        return $this;
    }

    public function removeIdUser(Users $idUser): self
    {
        $this->id_user->removeElement($idUser);

        return $this;
    }

    public function getIdNote(): ?Comment
    {
        return $this->id_note;
    }

    public function setIdNote(?Comment $id_note): self
    {
        $this->id_note = $id_note;

        return $this;
    }
}
