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
    #[ORM\Column(type: 'integer', nullable: true)]
    private $stock;


    #[Groups(["product:write"])]
    #[ORM\ManyToOne(targetEntity: Variety::class, inversedBy: 'typeTailles', cascade:["persist"])]
    private $variety;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'typeTailles')]
    private $product;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
