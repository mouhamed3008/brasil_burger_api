<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\QuartierRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: QuartierRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['quartier:read']
    ],
    denormalizationContext: [
        'groups' => ['quartier:write']
    ],
    collectionOperations:['GET', 'POST'],
    itemOperations:[
        'GET', 'PUT','PATCH', 'DELETE'
    ]
)]
class Quartier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(["quartier:read", "quartier:write", "zone:read"])]
    #[Assert\NotBlank(message:"Le libelle ne doit pas etre vide")]
    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\Column(type: 'boolean')]
    private $is_active=1;

    #[Groups(["quartier:read", "quartier:write"])]
    #[ORM\ManyToOne(targetEntity: Zone::class, inversedBy: 'quartiers')]
    #[Assert\NotBlank(message:"Veuillez une zone")]
    private $zone;

    public function __construct(){
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getZone(): ?Zone
    {
        return $this->zone;
    }

    public function setZone(?Zone $zone): self
    {
        $this->zone = $zone;

        return $this;
    }
}
