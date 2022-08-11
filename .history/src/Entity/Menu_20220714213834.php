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

    #[Groups(["product:write"])]
    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuTaille::class)]
    private $menuTailles;

   

    public function __construct()
    {
        $this->menuBoissons = new ArrayCollection();
        $this->menuTailles = new ArrayCollection();
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
     * @return Collection<int, MenuTaille>
     */
    public function getMenuTailles(): Collection
    {
        return $this->menuTailles;
    }

    public function addMenuTaille(MenuTaille $menuTaille): self
    {
        if (!$this->menuTailles->contains($menuTaille)) {
            $this->menuTailles[] = $menuTaille;
            $menuTaille->setMenu($this);
        }

        return $this;
    }

    public function removeMenuTaille(MenuTaille $menuTaille): self
    {
        if ($this->menuTailles->removeElement($menuTaille)) {
            // set the owning side to null (unless already changed)
            if ($menuTaille->getMenu() === $this) {
                $menuTaille->setMenu(null);
            }
        }

        return $this;
    }


}
