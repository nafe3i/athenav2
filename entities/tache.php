<?php

class Tache
{
    private ?int $id;
    private string $titre;
    private ?string $description;
    private string $statut;
    private string $priorite;
    private int $sprint_id;
    private DateTime $date_creation;

    public function __construct(?int $id, string $titre, ?string $description, string $statut, string $priorite, int $sprint_id, ?string $date_creation = null)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->statut = $statut;
        $this->priorite = $priorite;
        $this->sprint_id = $sprint_id;
        $this->date_creation = $date_creation ? new DateTime($date_creation) : new DateTime();
    }

    public function getId(): ?int { return $this->id; }
    public function getTitre(): string { return $this->titre; }
    public function getDescription(): ?string { return $this->description; }
    public function getStatut(): string { return $this->statut; }
    public function getPriorite(): string { return $this->priorite; }
    public function getSprintId(): int { return $this->sprint_id; }
    public function getDateCreation(): DateTime { return $this->date_creation; }
}
