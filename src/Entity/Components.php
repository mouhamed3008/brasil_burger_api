<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ComponentsRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ComponentsRepository::class)]
class Components
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[ORM\ManyToOne(targetEntity: LigneDeCommande::class, inversedBy: 'components', cascade:["persist"])]
    private $ligneCom;

    #[Groups(['cmd:write', "commande:subresource", 'livraison:read', 'livreur:read', "livreur:subresource", 'cmd_read'])]
    #[ORM\ManyToOne(targetEntity: TypeTaille::class, inversedBy: 'components')]
    private $boisson;

    #[Groups(['cmd:write', "commande:subresource", 'livraison:read', 'livreur:read', "livreur:subresource", 'cmd_read'])]
    #[ORM\Column(type: 'integer')]
    private $qty;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLigneCom(): ?LigneDeCommande
    {
        return $this->ligneCom;
    }

    public function setLigneCom(?LigneDeCommande $ligneCom): self
    {
        $this->ligneCom = $ligneCom;

        return $this;
    }

    public function getBoisson(): ?TypeTaille
    {
        return $this->boisson;
    }

    public function setBoisson(?TypeTaille $boisson): self
    {
        $this->boisson = $boisson;

        return $this;
    }

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(int $qty): self
    {
        $this->qty = $qty;

        return $this;
    }
}
