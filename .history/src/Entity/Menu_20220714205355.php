<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use Symfony\Component\Serializer\Annotation\Groups;
#[ORM\Entity(repositoryClass: MenuRepository::class)]

class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

 

    #[Groups(["product:write"])]
    #[ORM\Column(type: 'integer')]
    private $qtyP;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'menus', cascade:["persist"])]
    private $menu;

    #[Groups(["product:write"])]
    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'menus')]
    private $product;

   

    public function __construct()
    {
        $this->menuBoissons = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduits(): ?Product
    {
        return $this->produits;
    }

    public function setProduits(?Product $produits): self
    {
        $this->produits = $produits;

        return $this;
    }

    public function getMenus(): ?Product
    {
        return $this->menus;
    }

    public function setMenus(?Product $menus): self
    {
        $this->menus = $menus;

        return $this;
    }

   

    public function getMenu(): ?Product
    {
        return $this->menu;
    }

    public function setMenu(?Product $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get the value of qtyP
     */ 
    public function getQtyP()
    {
        return $this->qtyP;
    }

    /**
     * Set the value of qtyP
     *
     * @return  self
     */ 
    public function setQtyP($qtyP)
    {
        $this->qtyP = $qtyP;

        return $this;
    }

    /**
     * @return Collection<int, MenuBoisson>
     */
    public function getMenuBoissons(): Collection
    {
        return $this->menuBoissons;
    }

    public function addMenuBoisson(MenuBoisson $menuBoisson): self
    {
        if (!$this->menuBoissons->contains($menuBoisson)) {
            $this->menuBoissons[] = $menuBoisson;
            $menuBoisson->setMenu($this);
        }

        return $this;
    }

    public function removeMenuBoisson(MenuBoisson $menuBoisson): self
    {
        if ($this->menuBoissons->removeElement($menuBoisson)) {
            // set the owning side to null (unless already changed)
            if ($menuBoisson->getMenu() === $this) {
                $menuBoisson->setMenu(null);
            }
        }

        return $this;
    }
}
