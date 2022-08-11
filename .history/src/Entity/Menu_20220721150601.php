<?php

namespace App\Entity;

use App\Entity\Product;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
#[ORM\Entity(repositoryClass: MenuRepository::class)]

class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

 
    #[Groups(["product:write", 'product_read'])]
    #[ORM\Column(type: 'integer')]
    private $quantity;

    #[ORM\ManyToOne(inversedBy: 'menus', cascade:["persist"])]
    private ?Product $menu = null;

    #[Groups(["product:write", 'product_read'])]
    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Product $product = null;

    #
    public function __construct()
    {
        $this->menu = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
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
    


    public function addMenus(Product $beignet,int $qt=1){
        $pb= new Menu();
        $pb->setProduct($beignet);
        $pb->setP($this);
        $pb->setQuantite($qt);
        $this->addPlateauBeignet($pb);
    }

    
}
