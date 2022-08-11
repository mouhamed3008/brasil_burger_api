<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LigneDeCommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LigneDeCommandeRepository::class)]
#[ApiResource]
class LigneDeCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(['cmd:write', "commande:subresource", 'livraison:read', 'livreur:read', "livreur:subresource"])]
    #[ORM\Column(type: 'integer')]
    private $qty;

    #[ORM\Column(type: 'float')]
    private $prix=1000;

 
    #[Groups(["cmd_read", 'cmd:write', 'livraison:read', 'livreur:read', "livreur:subresource"])]
    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'ligneDeCommandes',cascade:['persist'])]
    private $products;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'ligneDeCommandes',cascade:['persist'])]
    private $commandes;

    #[Groups(['cmd:write', "commande:subresource", 'livraison:read', 'livreur:read', "livreur:subresource"])]
    #[ORM\OneToMany(mappedBy: 'ligneCom', targetEntity: Components::class, cascade:["persist"])]
    private $components;

    public function __construct()
    {
        // $this->commande = new ArrayCollection();
        $this->components = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(int $qty): self
    {
        $this->qty = $qty;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

  

    public function getProducts(): ?Product
    {
        return $this->products;
    }

    public function setProducts(?Product $products): self
    {
        $this->products = $products;

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

    /**
     * @return Collection<int, Components>
     */
    public function getComponents(): Collection
    {
        return $this->components;
    }

    public function addComponent(Components $component): self
    {
        if (!$this->components->contains($component)) {
            $this->components[] = $component;
            $component->setLigneCom($this);
        }

        return $this;
    }

    public function removeComponent(Components $component): self
    {
        if ($this->components->removeElement($component)) {
            // set the owning side to null (unless already changed)
            if ($component->getLigneCom() === $this) {
                $component->setLigneCom(null);
            }
        }

        return $this;
    }
}
