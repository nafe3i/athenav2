<?php

class Notification
{
    private ?int $id;
    private int $utilisateur_id;
    private string $sujet;
    private string $contenu;
    private string $type_evenement;
    private string $statut_envoi;
    private DateTime $date_creation;
    private ?DateTime $date_envoi_reelle;

    public function __construct(?int $id, int $utilisateur_id, string $sujet, string $contenu, string $type_evenement, string $statut_envoi = 'PENDING', ?string $date_creation = null, ?string $date_envoi_reelle = null)
    {
        $this->id = $id;
        $this->utilisateur_id = $utilisateur_id;
        $this->sujet = $sujet;
        $this->contenu = $contenu;
        $this->type_evenement = $type_evenement;
        $this->statut_envoi = $statut_envoi;
        $this->date_creation = $date_creation ? new DateTime($date_creation) : new DateTime();
        $this->date_envoi_reelle = $date_envoi_reelle ? new DateTime($date_envoi_reelle) : null;
    }

    public function getId(): ?int { return $this->id; }
    public function getUtilisateurId(): int { return $this->utilisateur_id; }
    public function getSujet(): string { return $this->sujet; }
    public function getContenu(): string { return $this->contenu; }
    public function getTypeEvenement(): string { return $this->type_evenement; }
    public function getStatutEnvoi(): string { return $this->statut_envoi; }
    public function getDateCreation(): DateTime { return $this->date_creation; }
    public function getDateEnvoiReelle(): ?DateTime { return $this->date_envoi_reelle; }
}
