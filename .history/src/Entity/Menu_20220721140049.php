<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use App\Controller\CataloguesController;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
#[ORM\Entity(repositoryClass: MenuRepository::class)]

#[ApiResource(
    collectionOperations: [
        
        "CATALOGUE"=>[
            'method' => 'get', 
            'path' => "/catalogues",
            'controller'=>CataloguesController::class,
            "deserialize"=>false
        ]
    ]
)]

class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['product_read'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'menus')]
    private $produits;
    
    #[Groups(["product:write", 'product_read'])]
    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'menu', cascade:["persist"])]
    private $menus;

    #[Groups(["product:write", 'product_read'])]
    #[ORM\Column(type: 'integer')]
    private $quantity;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
