<?php
require 'utilisateur.php';

class Admin extends Utilisateur
{
    public function __construct($id, $nom, $email, $mot_de_passe, $actif, $created_at)
    {
        parent::__construct($id, $nom, $email, $mot_de_passe, "ADMIN", $actif, $created_at);
    }
}

