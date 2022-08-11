<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TailleRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: TailleRepository::class)]
#[ApiResource(
    denormalizationContext:["groups"=>["type:write"]]
)]
class Taille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(["type:write"])]
    #[Assert\NotBlank(message:"Le libelle ne doit pas etre vide")]
    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\Column(type: 'boolean')]
    private $is_active=1;

    #[ORM\OneToMany(mappedBy: 'taille', targetEntity: TypeTaille::class)]
    private $typeTailles;



   

    public function __construct()
    {
        $this->typeTailles = new ArrayCollection();
        $this->menus = new ArrayCollection();
        $this->menuTailles = new ArrayCollection();
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
            $typeTaille->setTaille($this);
        }

        return $this;
    }

    public function removeTypeTaille(TypeTaille $typeTaille): self
    {
        if ($this->typeTailles->removeElement($typeTaille)) {
            // set the owning side to null (unless already changed)
            if ($typeTaille->getTaille() === $this) {
                $typeTaille->setTaille(null);
            }
        }

        return $this;
    }

  

   
   
    
}
