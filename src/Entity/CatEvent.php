<?php

namespace App\Entity;

use App\Repository\CatEventRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CatEventRepository::class)
 */
class CatEvent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_event;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_cat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEvent(): ?Event
    {
        return $this->id_event;
    }

    public function setIdEvent(?Event $id_event): self
    {
        $this->id_event = $id_event;

        return $this;
    }

    public function getNomCat(): ?string
    {
        return $this->nom_cat;
    }

    public function setNomCat(string $nom_cat): self
    {
        $this->nom_cat = $nom_cat;

        return $this;
    }
}
