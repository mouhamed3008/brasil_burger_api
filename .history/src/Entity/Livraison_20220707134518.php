<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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

    #[ORM\OneToMany(mappedBy: 'livraison', targetEntity: Commande::class)]
    #[Groups(["livraison:write", 'livraison:read'])]
    private $commandes;



   
   


    public function __construct()
    {
        $this->commandes = new ArrayCollection();
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
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setLivraison($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getLivraison() === $this) {
                $commande->setLivraison(null);
            }
        }

        return $this;
    }

 

   

}