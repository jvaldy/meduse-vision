<?php

namespace App\Entity;

use App\Repository\EpisodeProgressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EpisodeProgressRepository::class)]
class EpisodeProgress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name; // Nom du contenu

    #[ORM\Column(type: 'string', length: 50)]
    private string $type; // Film, Série, Livre, Saga, Animé, Documentaire, Dessin Animé

    #[ORM\Column(type: 'string', length: 50)]
    private string $status; // Fini, En cours, Recommencer, En attente

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $page = null; // Page actuelle (si livre)

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $chapter = null; // Chapitre actuel (si livre)

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $season = null; // Saison actuelle (si série)

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $episode = null; // Épisode actuel (si série)

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $filmNumber = null; // Numéro du film (si saga)

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $timerHours = null; // Heures arrêtées (si film, série, animé)

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $timerMinutes = null; // Minutes arrêtées (si film, série, animé)

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $reminder = null; // Date de rappel

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $platform = null; // Plateforme (Netflix, Disney+, etc.)

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $notes = null; // Notes et commentaires

    // ==================== Getters & Setters ====================

    public function getId(): int { return $this->id; }
    
    public function getName(): string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }

    public function getType(): string { return $this->type; }
    public function setType(string $type): self { $this->type = $type; return $this; }

    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }

    public function getPage(): ?int { return $this->page; }
    public function setPage(?int $page): self { $this->page = $page; return $this; }

    public function getChapter(): ?int { return $this->chapter; }
    public function setChapter(?int $chapter): self { $this->chapter = $chapter; return $this; }

    public function getSeason(): ?int { return $this->season; }
    public function setSeason(?int $season): self { $this->season = $season; return $this; }

    public function getEpisode(): ?int { return $this->episode; }
    public function setEpisode(?int $episode): self { $this->episode = $episode; return $this; }

    public function getFilmNumber(): ?int { return $this->filmNumber; }
    public function setFilmNumber(?int $filmNumber): self { $this->filmNumber = $filmNumber; return $this; }

    public function getTimerHours(): ?int { return $this->timerHours; }
    public function setTimerHours(?int $hours): self { $this->timerHours = $hours; return $this; }

    public function getTimerMinutes(): ?int { return $this->timerMinutes; }
    public function setTimerMinutes(?int $minutes): self { $this->timerMinutes = $minutes; return $this; }

    public function getReminder(): ?\DateTimeInterface { return $this->reminder; }
    public function setReminder(?\DateTimeInterface $reminder): self { $this->reminder = $reminder; return $this; }

    public function getPlatform(): ?string { return $this->platform; }
    public function setPlatform(?string $platform): self { $this->platform = $platform; return $this; }

    public function getNotes(): ?string { return $this->notes; }
    public function setNotes(?string $notes): self { $this->notes = $notes; return $this; }
}
