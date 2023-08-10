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

    #[ORM\ManyToOne(inversedBy: 'taches')]
    private ?Project $project_name = null;

    #[ORM\ManyToOne(inversedBy: 'taches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

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

    public function getProjectName(): ?Project
    {
        return $this->project_name;
    }

    public function setProjectName(?Project $project_name): static
    {
        $this->project_name = $project_name;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }
}
