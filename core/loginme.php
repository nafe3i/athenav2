<?php
session_start();
require_once __DIR__ . '/../services/utilisateurService.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    $service = new UtilisateurService();
    $result = $service->login($email, $mot_de_passe);

    if (!empty($result) && $result['success'] === true) {
        // Connexion réussie : gérer la session et redirection ici
        session_regenerate_id(true);
        $user = $result['user'];
        $_SESSION['user'] = [
            'id' => $user['id'],
            'nom' => $user['nom'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        // Redirection basée sur le rôle
        $role = strtoupper($_SESSION['user']['role'] ?? '');
        switch ($role) {
            case 'CHEF':
                header("Location: ../views/dashborChef.php");
                exit;
            case 'MEMBRE':
                header("Location: ../views/dashbordMembre.php");
                exit;
            default:
                header("Location: ../views/dashborAdmin.php");
                exit;
        }
    } else {
        // message générique affiché dans la vue
        $message = $result['message'] ?? 'Identifiants invalides';
    }
}
