<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;


#[ApiResource(
    normalizationContext: ['groups' => ['catalogue:read']]
)]
class Catalogue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[ORM\OneToMany(mappedBy: 'catalogue', targetEntity: Menu::class)]
    private $commandes;

    #[ORM\OneToMany(mappedBy: 'catalogue', targetEntity: Product::class)]
    private $products;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Menu $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setCatalogue($this);
        }

        return $this;
    }

    public function removeCommande(Menu $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getCatalogue() === $this) {
                $commande->setCatalogue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setCatalogue($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCatalogue() === $this) {
                $product->setCatalogue(null);
            }
        }

        return $this;
    }
}
