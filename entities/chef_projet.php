<?php
require 'utilisateur.php';

class Chef_projet extends Utilisateur
{
    public function __construct($id, $nom, $email, $mot_de_passe, $actif, $created_at)
    {
        parent::__construct($id, $nom, $email, $mot_de_passe, "CHEF_PROJET", $actif, $created_at);
    }
}