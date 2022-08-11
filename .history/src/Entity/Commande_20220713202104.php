<?php

namespace App\Entity;

use App\Entity\Gestionnaire;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use Symfony\Component\Serializer\Annotation\SerializedName;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource(
    
    subresourceOperations:[
        'api_clients_commandes_get_subresource'=>[
            "normalization_context"=>["groups"=>["commande:subresource"]]
        ]
    ],
    normalizationContext: ['groups' => ['cmd_read']],
    denormalizationContext: ['groups' => ['cmd:write']]

)]
#[ApiFilter(SearchFilter::class,properties:["libelle"=>"partial","lastname","customer"])]
#[ApiFilter(DateFilter::class, properties: ['commandeAt'])]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["livraison:write", "cmd_read", 'cmd_read', "commande:subresource", 'livraison:read', "livreur:subresource"])]
    private $id;
    
    #[Groups(["type_read", "cmd_read", 'cmd_read', "commande:subresource", 'livraison:read', 'livreur:read', "livreur:subresource"])]
    #[ORM\Column(type: 'datetime')]
    private $commandeAt;

    #[Groups(["cmd_read"])]
    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'commandes')]
    private $gestionnaire;

    #[Groups(["cmd_read",  'cmd:write', "commande:subresource", 'livraison:read', 'livreur:read', "livreur:subresource"])]
    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private $client;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $status="en cours";

    #[SerializedName("produits")]
    #[Groups(['cmd:write',"commande:subresource", 'livraison:read', 'livreur:read', "livreur:subresource"])]
    #[ORM\OneToMany(mappedBy: 'commandes', targetEntity: LigneDeCommande::class, cascade:["persist", "remove"])]
    private $ligneDeCommandes;
    
    #[Groups(['cmd:write', 'livraison:read'])]
    #[ORM\ManyToOne(targetEntity: Zone::class, inversedBy: 'commandes')]
    private $zone;

    #[ORM\ManyToOne(targetEntity: Livraison::class, inversedBy: 'commandes')]
    private $livraison;


    

    

    public function __construct()
    {
        $this->commandeAt = new \DateTime();
        $this->ligneDeCommandes = new ArrayCollection();
        $this->livraisons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommandeAt(): ?\DateTimeInterface
    {
        return $this->commandeAt;
    }

    public function setCommandeAt(\DateTimeInterface $commandeAt): self
    {
        $this->commandeAt = $commandeAt;

        return $this;
    }

    // public function getTotalProd():int
    // {
    //     return array_reduce($this->products->toArray(), function($total,$product){
    //         return $total + $product->getPrix() ;
            
    //     },0);
    // }


    // #[Groups(["cmd_read"])]
    // public function getTotal():int
    // {
    //     return $this->getTotalProd() ;
    // }


    /**
     * @return Collection<int, Product>
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    #[Groups(["cmd_read"])]
    public function getGestionnaire(): ?Gestionnaire
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Gestionnaire $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, LigneDeCommande>
     */
    public function getLigneDeCommandes(): Collection
    {
        return $this->ligneDeCommandes;
    }

    public function addLigneDeCommande(LigneDeCommande $ligneDeCommande): self
    {
        if (!$this->ligneDeCommandes->contains($ligneDeCommande)) {
            $this->ligneDeCommandes[] = $ligneDeCommande;
            $ligneDeCommande->setCommandes($this);
        }

        return $this;
    }

    public function removeLigneDeCommande(LigneDeCommande $ligneDeCommande): self
    {
        if ($this->ligneDeCommandes->removeElement($ligneDeCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneDeCommande->getCommandes() === $this) {
                $ligneDeCommande->setCommandes(null);
            }
        }

        return $this;
    }

   

    /**
     * Get the value of produits
     */ 
    public function getProduits()
    {
        return $this->produits;
    }

    /**
     * Set the value of produits
     *
     * @return  self
     */ 
    public function setProduits($produits)
    {
        $this->produits = $produits;

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

    public function getLivraison(): ?Livraison
    {
        return $this->livraison;
    }

    public function setLivraison(?Livraison $livraison): self
    {
        $this->livraison = $livraison;

        return $this;
    }

  

  
}
