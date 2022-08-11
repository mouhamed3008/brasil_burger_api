<?php

namespace App\Entity;

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

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'menus')]
    private $menu;

    #[Groups(["product:write"])]
    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'menus')]
    private $product;

    #[ORM\ManyToOne(targetEntity: Taille::class, inversedBy: 'menus')]
    private $boisson;

    #[ORM\Column(type: 'integer')]
    private $qtyB;

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

    public function getBoisson(): ?Taille
    {
        return $this->boisson;
    }

    public function setBoisson(?Taille $boisson): self
    {
        $this->boisson = $boisson;

        return $this;
    }

    public function getQtyB(): ?int
    {
        return $this->qtyB;
    }

    public function setQtyB(int $qtyB): self
    {
        $this->qtyB = $qtyB;

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
}
