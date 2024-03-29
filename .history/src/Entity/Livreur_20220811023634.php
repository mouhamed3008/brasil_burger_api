<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivreurRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LivreurRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['livreur:read']],
    denormalizationContext: ['groups' => ['livreur:write']],
    subresourceOperations:[
        'livraisons_get_subresource'=>[
            "method"=>"GET",
            "path"=>"livreurs/{id}/livraisons"
        ]
    ],
)]

class Livreur extends User
{
    

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['livraison:read', 'livreur:read'])]
    private $matricule;

    #[Groups(['livraison:read', 'livreur:read'])]
    #[ApiSubresource()]
    #[ORM\OneToMany(mappedBy: 'livreurs', targetEntity: Livraison::class)]
    private $livraisons;

    #[ORM\Column]
    private ?bool $is_disponible = true;

    public function __construct()
    {
        parent::__construct();
        $this->roles = ["ROLE_LIVREUR"];
        $this->livraisons = new ArrayCollection();
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * @return Collection<int, Livraison>
     */
    public function getLivraisons(): Collection
    {
        return $this->livraisons;
    }

    public function addLivraison(Livraison $livraison): self
    {
        if (!$this->livraisons->contains($livraison)) {
            $this->livraisons[] = $livraison;
            $livraison->setLivreurs($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): self
    {
        if ($this->livraisons->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getLivreurs() === $this) {
                $livraison->setLivreurs(null);
            }
        }

        return $this;
    }

    public function isIsDisponible(): ?bool
    {
        return $this->is_disponible;
    }

    public function setIsDisponible(bool $is_disponible): self
    {
        $this->is_disponible = $is_disponible;

        return $this;
    }
}
