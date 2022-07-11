<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['product_read']],
    denormalizationContext: ['groups' => ['product:write']]
)]

class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["product_read","gestion_read"])]
    private $id;

    #[Groups(["product_read","gestion_read", "cmd_read", "type_read", "product:write"])]
    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[Groups(["product_read","gestion_read", "cmd_read", "product:write"])]
    #[ORM\Column(type: 'integer')]
    private $prix;

    #[ORM\Column(type: 'blob')]
    private $image;

    private $imageFile;


    #[ORM\ManyToMany(targetEntity: Commande::class, mappedBy: 'products')]
    private $commandes;

    #[Groups(["product_read", "product:write"])]
    #[ORM\ManyToOne(targetEntity: Type::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $type;
    
    #[Groups(["product_read"])]
    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $gestionnaire;

    #[Groups(["product_read","gestion_read", "cmd_read", "product:write"])]
    #[ORM\Column(type: 'boolean')]
    private $is_active=1;

    #[Groups(["product_read","gestion_read", "cmd_read", "product:write"])]
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'products')]
    private $menu;

    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'menu')]
    private $products;




    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->menu = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

  

 

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }


    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
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

    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function addMenu(self $menu): self
    {
        if (!$this->menu->contains($menu)) {
            $this->menu[] = $menu;
        }

        return $this;
    }

    public function removeMenu(self $menu): self
    {
        $this->menu->removeElement($menu);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(self $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addMenu($this);
        }

        return $this;
    }

    public function removeProduct(self $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeMenu($this);
        }

        return $this;
    }

  
}
