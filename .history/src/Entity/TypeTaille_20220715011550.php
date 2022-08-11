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
    denormalizationContext:["groups"=>["typetaille:write"]]
)]
class TypeTaille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    #[Groups(["product:write"])]
    #[ORM\ManyToOne(targetEntity: Type::class, inversedBy: 'typeTailles', cascade:["persist"])]
    private $type;

   
    #[Groups(["product:write"])]
    #[ORM\Column(type: 'integer', nullable: true)]
    private $stock;

    #[ORM\OneToMany(mappedBy: 'variety', targetEntity: Product::class)]
    private $products;

    #[Groups(["product:write"])]
    #[ORM\ManyToOne(targetEntity: Variety::class, inversedBy: 'typeTailles', cascade:["persist"])]
    private $variety;

    public function __construct()
    {
        $this->products = new ArrayCollection();
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

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setVariety($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getVariety() === $this) {
                $product->setVariety(null);
            }
        }

        return $this;
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
}
