<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TacheRepository::class)]
class Tache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $tache = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTache(): ?string
    {
        return $this->tache;
    }

    public function setTache(string $tache): static
    {
        $this->tache = $tache;

        return $this;
    }
}
