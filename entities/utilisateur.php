<?php

abstract class Utilisateur
{
    private ?int $id = null;
    private string $nom;
    private string $email;
    private $mot_de_passe;
    private $role;
    private bool $actif;
    private ?DateTime $created_at = null;

    protected function __construct($id, $nom, $email, $mot_de_passe, $role, $actif, $created_at)
    {
        $this->id=$id;
        $this->nom= $nom;
        $this->email = $email;
        $this->mot_de_passe=$mot_de_passe;
        $this->role=$role;
        $this->actif=$actif;
        $this->created_at=$created_at;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMotDePasse()
    {
        return $this->mot_de_passe;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function isActif(): bool
    {
        return $this->actif;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->created_at;
    }

}