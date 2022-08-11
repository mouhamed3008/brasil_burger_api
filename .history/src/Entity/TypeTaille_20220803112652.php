<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TypeTailleRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TypeTailleRepository::class)]
#[ApiResource(
    denormalizationContext:["groups"=>["typetaille:write"]],
    normalizationContext:["groups"=>["typetaille:read"]];
    subresourceOperations:[
        'api_products_type_tailles_get_subresource'=>[
            "normalization_context"=>["groups"=>["prod:subresource"]]
        ]
    ],
)]
class TypeTaille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(["cmd:write","prod:subresource"])]
    #[ORM\Column(type: 'integer')]
    private $id;
 
   
    #[Groups(["product:write", "prod:subresource"])]
    #[ORM\Column(type: 'integer', nullable: true)]
    private $stock;

    #[ORM\OneToMany(mappedBy: 'variety', targetEntity: Product::class)]
    private $products;

    #[Groups(["product:write", "prod:subresource"])]
    #[ORM\ManyToOne(targetEntity: Variety::class, inversedBy: 'typeTailles', cascade:["persist"])]
    private $variety;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'typeTailles', cascade:["persist"])]
    private $product;

    #[ORM\OneToMany(mappedBy: 'boisson', targetEntity: Components::class)]
    private $components;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->components = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

   

    public function getVariety(): ?Variety
    {
        return $this->variety;
    }

    public function setVariety(?Variety $variety): self
    {
        $this->variety = $variety;

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

    /**
     * @return Collection<int, Components>
     */
    public function getComponents(): Collection
    {
        return $this->components;
    }

    public function addComponent(Components $component): self
    {
        if (!$this->components->contains($component)) {
            $this->components[] = $component;
            $component->setBoisson($this);
        }

        return $this;
    }

    public function removeComponent(Components $component): self
    {
        if ($this->components->removeElement($component)) {
            // set the owning side to null (unless already changed)
            if ($component->getBoisson() === $this) {
                $component->setBoisson(null);
            }
        }

        return $this;
    }
}
