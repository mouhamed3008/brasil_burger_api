<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TypeRepository;
use App\Controller\CataloguesController;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['type_read']],
    denormalizationContext: ['groups' => ['type:write']],
    collectionOperations:[
        "GET","POST",
        "MAKE"=>[
            "method"=>"POST",
            "path"=>"/addCatalogue",
            'controller'=>CataloguesController::class,
            "denormalization_context"=> ['groups' => ['catalogue:write']],
        ]
    ],

)]

class Type
{
    #[Groups(["catalogue:write"])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    
    #[Groups(["type_read", "product_read", "type:write"])]
    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    // #[Groups(["type_read"])]
    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Product::class)]
    private $products;

    #[ORM\Column(type: 'boolean')]
    private $is_catalogue=0;

    public function __construct()
    {
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
}
