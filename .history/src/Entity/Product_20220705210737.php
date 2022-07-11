<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Controller\ProductActions;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    forceEager: false,
    normalizationContext: ['groups' => ['product_read']],
    denormalizationContext: ['groups' => ['product:write'], "enable_max_depth"=>true],
    collectionOperations: [
        'GET',
        'POST'
    ]
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

    // #[Groups(["product_read","gestion_read", "cmd_read"])]
    #[ORM\Column(type: 'blob')]
    private $image;

    #[Groups(["product:write"])]
    #[SerializedName('image')]
    private $imageFile;




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



    #[ORM\OneToMany(mappedBy: 'products', targetEntity: LigneDeCommande::class)]
    private $ligneDeCommandes;

    #[Groups(["product:write"])]
    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Menu::class, cascade:["persist"])]
    private $menus;

    

  




    public function __construct()
    {
       
        $this->ligneDeCommandes = new ArrayCollection();
        $this->menus = new ArrayCollection();
       
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
        return $this->image;
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
     * @return Collection<int, self>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(self $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
        }

        return $this;
    }

    public function removeMenu(self $menu): self
    {
        $this->menus->removeElement($menu);

        return $this;
    }

    

   

 
}
