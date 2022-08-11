<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TypeRepository;
use App\Controller\CataloguesController;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: TypeRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['type_read']],
    denormalizationContext: ['groups' => ['type:write']],
    collectionOperations:[
        "GET","POST",
        "MAKE"=>[
            "method"=>"POST",
            "path"=>"/addCatalogue",
            "denormalization_context"=> ['groups' => ['catalogue:write']],
            'controller'=>CataloguesController::class,
        ]
    ],

)]

class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["catalogue:write"])]
    private $id;
    
    #[Groups(["type_read", "product_read", "type:write"])]
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message:"Le libelle ne doit pas etre vide")]
    private $libelle;

    // #[Groups(["type_read"])]
    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Product::class)]
    private $products;

    #[ORM\Column(type: 'boolean')]
    private $is_catalogue=0;

    // #[Groups(["type_read"])]
    // #[ORM\OneToMany(mappedBy: 'type', targetEntity: TypeTaille::class)]
    // private $typeTailles;

    public function __construct()
    {
        $this->products = new ArrayCollection();
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

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setType($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getType() === $this) {
                $product->setType(null);
            }
        }

        return $this;
    }

    public function isIsCatalogue(): ?bool
    {
        return $this->is_catalogue;
    }

    public function setIsCatalogue(bool $is_catalogue): self
    {
        $this->is_catalogue = $is_catalogue;

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
            $typeTaille->setType($this);
        }

        return $this;
    }

    public function removeTypeTaille(TypeTaille $typeTaille): self
    {
        if ($this->typeTailles->removeElement($typeTaille)) {
            // set the owning side to null (unless already changed)
            if ($typeTaille->getType() === $this) {
                $typeTaille->setType(null);
            }
        }

        return $this;
    }
}
