<?php

class Commentaire
{
    private ?int $id;
    private string $contenu;
    private DateTime $date_creation;
    private int $utilisateur_id;
    private int $tache_id;

    public function __construct(?int $id, string $contenu, ?string $date_creation, int $utilisateur_id, int $tache_id)
    {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->date_creation = $date_creation ? new DateTime($date_creation) : new DateTime();
        $this->utilisateur_id = $utilisateur_id;
        $this->tache_id = $tache_id;
    }

    public function getId(): ?int { return $this->id; }
    public function getContenu(): string { return $this->contenu; }
    public function getDateCreation(): DateTime { return $this->date_creation; }
    public function getUtilisateurId(): int { return $this->utilisateur_id; }
    public function getTacheId(): int { return $this->tache_id; }
}
