<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivraisonRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['livraison:read']
    ],
    denormalizationContext: [
        'groups' => ['livraison:write']
    ],
    collectionOperations:['GET', 'POST'],
    itemOperations:[
        'GET', 'PUT','PATCH', 'DELETE'
    ]
)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(["livraison:write", 'livraison:read'])]
    #[ORM\ManyToOne(targetEntity: Livreur::class, inversedBy: 'livraisons')]
    #[ORM\JoinColumn(nullable: false)]
    private $livreurs;

    #[Groups(["livraison:write", 'livraison:read'])]
    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'livraisons')]
    private $commandes;

   
   


    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLivreurs(): ?Livreur
    {
        return $this->livreurs;
    }

    public function setLivreurs(?Livreur $livreurs): self
    {
        $this->livreurs = $livreurs;

        return $this;
    }

 

    /**
     * @return Collection<int, Zone>
     */
    public function getZone(): Collection
    {
        return $this->zone;
    }

    public function addZone(Zone $zone): self
    {
        if (!$this->zone->contains($zone)) {
            $this->zone[] = $zone;
        }

        return $this;
    }

    public function removeZone(Zone $zone): self
    {
        $this->zone->removeElement($zone);

        return $this;
    }

    public function getCommandes(): ?Commande
    {
        return $this->commandes;
    }

    public function setCommandes(?Commande $commandes): self
    {
        $this->commandes = $commandes;

        return $this;
    }
}
