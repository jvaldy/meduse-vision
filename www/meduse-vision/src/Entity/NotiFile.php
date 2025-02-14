<?php

namespace App\Entity;

use App\Repository\NotiFileRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: NotiFileRepository::class)]
#[Vich\Uploadable]
class NotiFile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $expirationDate;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $reminderBeforeDays = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $reminderAfterDays = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $email;

    #[Vich\UploadableField(mapping: 'notifile_files', fileNameProperty: 'fileName')]
    private ?File $file = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $fileName = null;

    #[ORM\Column(type: 'smallint')]
    private int $priority;

    #[ORM\Column(type: 'string', length: 50)]
    private string $status; // À renouveler, Terminé, Oublié

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $notes = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    // Getters et Setters

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function getExpirationDate(): \DateTimeInterface { return $this->expirationDate; }
    public function setExpirationDate(\DateTimeInterface $expirationDate): self { $this->expirationDate = $expirationDate; return $this; }
    public function getReminderBeforeDays(): ?int { return $this->reminderBeforeDays; }
    public function setReminderBeforeDays(?int $days): self { $this->reminderBeforeDays = $days; return $this; }
    public function getReminderAfterDays(): ?int { return $this->reminderAfterDays; }
    public function setReminderAfterDays(?int $days): self { $this->reminderAfterDays = $days; return $this; }
    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }
    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }
    public function getFile(): ?File { return $this->file; }
    public function setFile(?File $file): self { $this->file = $file; return $this; }
    public function getFileName(): ?string { return $this->fileName; }
    public function setFileName(?string $fileName): self { $this->fileName = $fileName; return $this; }
    public function getPriority(): int { return $this->priority; }
    public function setPriority(int $priority): self { $this->priority = $priority; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function getUpdatedAt(): ?\DateTimeInterface { return $this->updatedAt; }
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self { $this->updatedAt = $updatedAt; return $this; }
    public function getCreatedAt(): \DateTimeInterface { return $this->createdAt; }
    public function getNotes(): ?string { return $this->notes; }
    public function setNotes(?string $notes): self { $this->notes = $notes; return $this; }
}
