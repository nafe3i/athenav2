<?php
require_once "../services/utilisateurService.php";

// Le contrôleur prépare $message pour la vue sans l'echoer directement
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $mot_de_passe = $_POST["mot_de_passe"] ?? "";

    $service = new UtilisateurService();
    $result = $service->verifierAjoute($nom, $email, $mot_de_passe);
    $message = $result["message"] ?? '';
    $success = $result["success"] ?? false;
    // La vue peut afficher $message et agir sur $success
}
