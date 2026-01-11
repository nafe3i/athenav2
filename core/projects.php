<?php
// Démarre la session (nécessaire pour accéder à $_SESSION)
session_start();

// Charge le service métiers projets
require_once __DIR__ . '/../services/projectService.php';

// Ce contrôleur gère la création de projet via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifie que l'utilisateur est connecté
    if (empty($_SESSION['user'])) {
        header('Location: /POO/views/login.php');
        exit;
    }

    // Récupère l'ID et le rôle de l'utilisateur courant
    $currentUserId = intval($_SESSION['user']['id'] ?? 0);
    $currentRole = strtoupper($_SESSION['user']['role'] ?? '');

    // Récupère les champs du formulaire en appliquant trim
    $nom = trim($_POST['nom'] ?? '');
    $description = trim($_POST['description'] ?? '');

    // Détermine le chef du projet : si l'utilisateur est ADMIN, il peut préciser un chef
    $chef_projet_id = $currentUserId;
    if ($currentRole === 'ADMIN' && !empty($_POST['chef_projet_id'])) {
        $chef_projet_id = intval($_POST['chef_projet_id']);
    }

    // Appel du service pour créer le projet
    $svc = new ProjectService();
    $result = $svc->createProject($nom, $description, $chef_projet_id);

    // Stocke un message flash pour la vue suivante
    $_SESSION['flash_message'] = $result['message'] ?? '';
    $_SESSION['flash_success'] = $result['success'] ?? false;

    // Redirige vers le dashboard approprié
    if ($currentRole === 'ADMIN') {
        header('Location: /POO/views/dashborAdmin.php');
        exit;
    }
    header('Location: /POO/views/dashborChef.php');
    exit;
}
