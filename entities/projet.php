<?php

class Projet
{
    private ?int $id;
    private string $nom;
    private ?string $description;
    private DateTime $date_debut;
    private ?DateTime $date_fin;
    private string $statut;
    private int $chef_projet_id;
    private bool $actif;
    private ?DateTime $created_at;

    public function __construct(?int $id, string $nom, ?string $description, string $date_debut, ?string $date_fin, string $statut, int $chef_projet_id, bool $actif = true, ?string $created_at = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->date_debut = new DateTime($date_debut);
        $this->date_fin = $date_fin ? new DateTime($date_fin) : null;
        $this->statut = $statut;
        $this->chef_projet_id = $chef_projet_id;
        $this->actif = $actif;
        $this->created_at = $created_at ? new DateTime($created_at) : new DateTime();
    }

    public function getId(): ?int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getDescription(): ?string { return $this->description; }
    public function getDateDebut(): DateTime { return $this->date_debut; }
    public function getDateFin(): ?DateTime { return $this->date_fin; }
    public function getStatut(): string { return $this->statut; }
    public function getChefProjetId(): int { return $this->chef_projet_id; }
    public function isActif(): bool { return $this->actif; }
    public function getCreatedAt(): ?DateTime { return $this->created_at; }
}
