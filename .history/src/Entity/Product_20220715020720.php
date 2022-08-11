<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Controller\ProductActions;
use App\Repository\ProductRepository;
use App\Controller\CataloguesController;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    forceEager: false,
    normalizationContext: ['groups' => ['product_read']],
    denormalizationContext: ['groups' => ['product:write']],
    collectionOperations: [
        'GET','POST',
        "MENU"=>[
            'method' => 'POST', 
            'path' => "/menu2",
            'controller'=>ProductActions::class,
        ],
        "CATALOGUE"=>[
            'method' => 'get', 
            'path' => "/catalogues",
            'controller'=>CataloguesController::class,
        ]
    ]
)]

class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["product_read","gestion_read", "product:write", 'livraison:read', "livreur:subresource"])]
    private $id;

    #[Assert\NotBlank(message:"Le libelle ne doit pas etre vide")]
    #[Groups(["product_read","gestion_read", "cmd_read", "type_read", "product:write", 'livraison:read','livreur:read', "livreur:subresource"])]
    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[Assert\NotBlank(message:"Le prix ne doit pas etre vide")]
    #[Groups(["product_read","gestion_read", "cmd_read", "product:write"])]
    #[ORM\Column(type: 'integer')]
    private $prix=1000;

    // #[Groups(["product_read","gestion_read", "cmd_read"])]
    #[Groups(["product_read"])]
    #[ORM\Column(type: 'blob', nullable: true)]
    private $image;
    
    #[Groups(["product:write"])]
    #[Assert\NotBlank(message:"Veuillez choisir une image")]
    #[SerializedName('image')]
    private $imageFile;


    #[Groups(["product_read", "product:write"])]
    #[ORM\ManyToOne(targetEntity: Type::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: true)]
    private $type;
    
    #[Groups(["product_read", "product:write"])]
    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $gestionnaire;

    #[Groups(["product_read","gestion_read", "cmd_read", "product:write"])]
    #[ORM\Column(type: 'boolean')]
    private $is_active=1;

    #[ORM\OneToMany(mappedBy: 'products', targetEntity: LigneDeCommande::class)]
    private $ligneDeCommandes;

    #[Groups(["product_read","gestion_read", "product:write"])]
    #[ORM\OneToMany(mappedBy: 'produits', targetEntity: Menu::class,  cascade:["persist"])]
    private $menus;
    
    #[ORM\OneToMany(mappedBy: 'menus', targetEntity: Menu::class, cascade:["persist"])]
    private $menu;


    

    #[Groups(["product_read","gestion_read", "product:write"])]
    // #[SerializedName("Choisir type, taille et variété")]
    // #[ORM\ManyToOne(targetEntity: TypeTaille::class, inversedBy: 'products', cascade:["persist"])]
    // private $variety;




    public function __construct()
    {
       
        $this->ligneDeCommandes = new ArrayCollection();
        $this->menus = new ArrayCollection();
        // $this->menu = new ArrayCollection();
        $this->typeTailles = new ArrayCollection();
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
     * Get the value of image
     */ 
    public function getImage()
    {
        return is_resource($this->image) ?utf8_encode(base64_encode(stream_get_contents($this->image)))  : $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of imageFile
     */ 
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @return  self
     */ 
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    /**
     * @return Collection<int, LigneDeCommande>
     */
    public function getLigneDeCommandes(): Collection
    {
        return $this->ligneDeCommandes;
    }

    public function addLigneDeCommande(LigneDeCommande $ligneDeCommande): self
    {
        if (!$this->ligneDeCommandes->contains($ligneDeCommande)) {
            $this->ligneDeCommandes[] = $ligneDeCommande;
            $ligneDeCommande->setProducts($this);
        }

        return $this;
    }

    public function removeLigneDeCommande(LigneDeCommande $ligneDeCommande): self
    {
        if ($this->ligneDeCommandes->removeElement($ligneDeCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneDeCommande->getProducts() === $this) {
                $ligneDeCommande->setProducts(null);
            }
        }

        return $this;
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
            $menu->setProduits($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            // set the owning side to null (unless already changed)
            if ($menu->getProduits() === $this) {
                $menu->setProduits(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

   

    /**
     * @return Collection<int, TypeTaille>
     */
    public function getTypeTailles(): Collection
    {
        return $this->typeTailles;
    }

    public function addTypeTaille(TypeTaille $typeTaille): self
    {
        if (!$this->typeTailles->contains($typeTaille)) {
            $this->typeTailles[] = $typeTaille;
            $typeTaille->setProduct($this);
        }

        return $this;
    }

    public function removeTypeTaille(TypeTaille $typeTaille): self
    {
        if ($this->typeTailles->removeElement($typeTaille)) {
            // set the owning side to null (unless already changed)
            if ($typeTaille->getProduct() === $this) {
                $typeTaille->setProduct(null);
            }
        }

        return $this;
    }

   

    

   

 
}
