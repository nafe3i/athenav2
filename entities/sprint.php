<?php

class Sprint
{
    private ?int $id;
    private string $nom;
    private DateTime $date_debut;
    private DateTime $date_fin;
    private int $projet_id;

    public function __construct(?int $id, string $nom, string $date_debut, string $date_fin, int $projet_id)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->date_debut = new DateTime($date_debut);
        $this->date_fin = new DateTime($date_fin);
        $this->projet_id = $projet_id;
    }

    public function getId(): ?int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getDateDebut(): DateTime { return $this->date_debut; }
    public function getDateFin(): DateTime { return $this->date_fin; }
    public function getProjetId(): int { return $this->projet_id; }
}
