<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Gestionnaire;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['cmd_read']],

)]
#[ApiFilter(SearchFilter::class,properties:["menu.libelle"=>"partial","lastname","customer"])]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    
    #[Groups(["type_read", "cmd_read"])]
    #[ORM\Column(type: 'datetime')]
    private $commandeAt;

    #[Groups(["cmd_read"])]
    #[ORM\ManyToMany(targetEntity: Menu::class, inversedBy: 'commandes')]
    private $menus;

    #[Groups(["cmd_read"])]
    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'commandes')]
    private $products;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'commandes')]
    private $gestionnaire;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private $client;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $status;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
        $this->products = new ArrayCollection();
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

    public function getTotalProd():int
    {
        return array_reduce($this->products->toArray(), function($total,$product){
            return $total + $product->getPrix() ;
            
        },0);
    }

    public function getTotalMenu():int
    {
        return array_reduce($this->menus->toArray(), function($total,$menu){
            return $total + $menu->getPrice();
            
        },0);
    }

    #[Groups(["cmd_read"])]
    public function getTotal():int
    {
        return $this->getTotalProd() + $this->getTotalMenu();
    }

    public function getUser():Gestionnaire
    {
        # code...
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }



    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        $this->menus->removeElement($menu);

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

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
}
