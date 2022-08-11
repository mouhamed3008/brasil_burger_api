<?php

namespace App\Entity;

use App\Repository\MenuBoissonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuBoissonRepository::class)]
class MenuBoisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'menuBoissons')]
    private $menu;

    #[Groups(["product:write"])]
    #[ORM\ManyToOne(targetEntity: Taille::class, inversedBy: 'menuBoissons')]
    private $boisson;

    #[ORM\Column(type: 'integer')]
    private $qty;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

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
