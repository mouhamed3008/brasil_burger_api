<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource()]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(["product:write"])]
    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'menus', cascade:["persist"])]
    private $product;
    
    
    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'menus')]
    private $menuP;

    #[Groups(["product:write"])]
    #[ORM\Column(type: 'integer')]
    private $qty;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMenuP(): ?Product
    {
        return $this->menuP;
    }

    public function setMenuP(?Product $menuP): self
    {
        $this->menuP = $menuP;

        return $this;
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
}
