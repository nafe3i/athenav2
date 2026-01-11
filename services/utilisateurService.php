<?php

include "../repositories/utilisateurRepos.php";
class UtilisateurService
{
    private UtilisateurRepos $userRepo;

    public function __construct()
    {
        $this->userRepo = new UtilisateurRepos();
    }

    public function verifierAjoute($nom, $email, $mot_de_passe)
    {
        $hash_password = password_hash($mot_de_passe,PASSWORD_DEFAULT);
        $userExist = $this->userRepo->findByEmail($email);
        if ($userExist) {
            return [
                "success" => false,
                "message" => "Email déjà utilisé"
            ];
        }
        $result = $this->userRepo->ajoute($nom, $email, $hash_password);

        if ($result) {
            return [
                "success" => true,
                "message" => "Utilisateur ajouté avec succès"
            ];
        }
        return [
            "success" => false,
            "message" => "Erreur lors de l'ajout"
        ];

    }
    public function login($email, $mot_de_passe)
    {
        $user = $this->userRepo->findByEmail($email);

        // Retourner un message générique pour éviter la fuite d'information
        $genericFail = ["success" => false, "message" => "Identifiants invalides"];

        if (!$user) {
            return $genericFail;
        }

        if (!isset($user['mot_de_passe']) || !password_verify($mot_de_passe, $user['mot_de_passe'])) {
            return $genericFail;
        }

        // Sur succès, renvoyer les infos utilisateur; la gestion de session/redirection
        // doit être effectuée par le contrôleur (core/loginme.php)
        return ["success" => true, "message" => "Connexion réussie", "user" => $user];
    }

   
}