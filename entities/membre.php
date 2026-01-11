<?php
require 'utilisateur.php';

class Membre extends Utilisateur
{
    public function __construct($id, $nom, $email, $mot_de_passe, $actif, $created_at)
    {
        parent::__construct($id, $nom, $email, $mot_de_passe, "MEMBRE", $actif, $created_at);
    }
}