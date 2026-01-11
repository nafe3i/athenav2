<?php

class TacheUtilisateur
{
    private ?int $id;
    private int $tache_id;
    private int $utilisateur_id;
    private DateTime $date_affectation;

    public function __construct(?int $id, int $tache_id, int $utilisateur_id, ?string $date_affectation = null)
    {
        $this->id = $id;
        $this->tache_id = $tache_id;
        $this->utilisateur_id = $utilisateur_id;
        $this->date_affectation = $date_affectation ? new DateTime($date_affectation) : new DateTime();
    }

    public function getId(): ?int { return $this->id; }
    public function getTacheId(): int { return $this->tache_id; }
    public function getUtilisateurId(): int { return $this->utilisateur_id; }
    public function getDateAffectation(): DateTime { return $this->date_affectation; }
}
