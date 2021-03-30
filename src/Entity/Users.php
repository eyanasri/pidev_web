<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity=Event::class)
     */
    private $id_event;

    /**
     * @ORM\OneToOne(targetEntity=Inscription::class, mappedBy="id_user", cascade={"persist", "remove"})
     */
    private $inscription;

    /**
     * @ORM\ManyToMany(targetEntity=Inscri::class, mappedBy="UserMail")
     */
    private $inscris;

    public function __construct()
    {
        $this->id_event = new ArrayCollection();
        $this->inscris = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Event[]
     */
    public function getIdEvent(): Collection
    {
        return $this->id_event;
    }

    public function addIdEvent(Event $idEvent): self
    {
        if (!$this->id_event->contains($idEvent)) {
            $this->id_event[] = $idEvent;
        }

        return $this;
    }

    public function removeIdEvent(Event $idEvent): self
    {
        $this->id_event->removeElement($idEvent);

        return $this;
    }

    public function getInscription(): ?Inscription
    {
        return $this->inscription;
    }

    public function setInscription(Inscription $inscription): self
    {
        // set the owning side of the relation if necessary
        if ($inscription->getIdUser() !== $this) {
            $inscription->setIdUser($this);
        }

        $this->inscription = $inscription;

        return $this;
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
            $inscri->addUserMail($this);
        }

        return $this;
    }

    public function removeInscri(Inscri $inscri): self
    {
        if ($this->inscris->removeElement($inscri)) {
            $inscri->removeUserMail($this);
        }

        return $this;
    }


}
