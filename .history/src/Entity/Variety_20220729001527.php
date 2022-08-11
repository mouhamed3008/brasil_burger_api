<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\VarietyRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: VarietyRepository::class)]
#[ApiResource(
    denormalizationContext: ["groups"=>['variety:write']],
    normalizationContext: ["groups"=>['variety:read']],
    
)]
#[UniqueEntity('libelle', message: "Cette variété existe déja")]
class Variety
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(["variety:read"])]
    #[ORM\Column(type: 'integer')]
    private $id;
    
    #[Assert\NotBlank(message:"Le libelle ne doit pas etre vide")]
    #[Groups(["variety:read", "prod:subresource"])]
    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\Column(type: 'boolean')]
    private $is_active=1;

    #[Groups(["variety:read"])]
    #[ORM\OneToMany(mappedBy: 'variety', targetEntity: TypeTaille::class)]
    private $typeTailles;

    #[Groups(["variety:read"])]
    #[ORM\Column(type: 'blob', nullable: true)]
    private $image;

    public function __construct()
    {
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
            $typeTaille->setVariety($this);
        }

        return $this;
    }

    public function removeTypeTaille(TypeTaille $typeTaille): self
    {
        if ($this->typeTailles->removeElement($typeTaille)) {
            // set the owning side to null (unless already changed)
            if ($typeTaille->getVariety() === $this) {
                $typeTaille->setVariety(null);
            }
        }

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
}
