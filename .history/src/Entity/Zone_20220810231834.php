<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ZoneRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ZoneRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['zone:read']
    ],
    denormalizationContext: [
        'groups' => ['zone:write']
    ],
    collectionOperations:['GET', 'POST'],
    itemOperations:[
        'GET', 'PUT','PATCH', 'DELETE'
    ]
)]
#[UniqueEntity('libelle', message: "Cette zone existe déja")]

class Zone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["quartier:write", "livraison:write", 'cmd:write', 'zone:read', 'cmd_read'])]
    private $id;

    #[Groups(["zone:write", 'zone:read', 'livraison:read', 'cmd_read'])]
    #[Assert\NotBlank(message:"Le libelle ne doit pas etre vide")]
    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\Column(type: 'boolean')]
    private $is_active=1;

    #[Groups(['zone:read', 'livraison:read'])]
    #[ORM\OneToMany(mappedBy: 'zone', targetEntity: Quartier::class)]
    private $quartiers;


    #[ORM\OneToMany(mappedBy: 'zone', targetEntity: Commande::class)]
    #[Groups(['zone:read'])]
    private $commandes;

    #[ORM\OneToMany(mappedBy: 'zone', targetEntity: Livraison::class)]
    private $livraisons;

    #[Groups(["zone:write", 'zone:read', 'livraison:read'])]
    #[ORM\Column(type: 'integer')]
    private $prix;

    public function __construct()
    {
        $this->quartiers = new ArrayCollection();
        $this->livraisons = new ArrayCollection();
        $this->commandes = new ArrayCollection();
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
     * @return Collection<int, Quartier>
     */
    public function getQuartiers(): Collection
    {
        return $this->quartiers;
    }

    public function addQuartier(Quartier $quartier): self
    {
        if (!$this->quartiers->contains($quartier)) {
            $this->quartiers[] = $quartier;
            $quartier->setZone($this);
        }

        return $this;
    }

    public function removeQuartier(Quartier $quartier): self
    {
        if ($this->quartiers->removeElement($quartier)) {
            // set the owning side to null (unless already changed)
            if ($quartier->getZone() === $this) {
                $quartier->setZone(null);
            }
        }

        return $this;
    }

  

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setZone($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getZone() === $this) {
                $commande->setZone(null);
            }
        }

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
            $livraison->setZone($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): self
    {
        if ($this->livraisons->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getZone() === $this) {
                $livraison->setZone(null);
            }
        }

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
}
