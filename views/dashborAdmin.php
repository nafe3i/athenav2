<?php
require_once __DIR__ . '/../utils/auth.php';
// protection simple : vérifier la session et le rôle
if (!currentUser()) {
  header('Location: /POO/views/login.php');
  exit;
}
if (!hasRole('ADMIN')) {
  echo 'Accès refusé.';
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="/POO/assets/css/dashboard.css">
    <link rel="stylesheet" href="/POO/assets/css/auth.css">
</head>
<body>
  <div class="dash-container">
    <div class="dash-sidebar">
      <h2>Admin</h2>
      <nav>
        <a href="/POO/views/dashborAdmin.php">Panel</a>
        <a href="/POO/views/dashborChef.php">Projets</a>
        <a href="/POO/views/dashbordMembre.php">Membres</a>
        <a href="/POO/core/logout.php">Se déconnecter</a>
      </nav>
    </div>
    <div class="dash-main wrap">
      <header class="dash-header">
        <div class="dash-title">Admin Panel</div>
        <div class="dash-actions"><span class="muted">Gestion globale</span></div>
      </header>

      <div class="grid3 mt-2">
        <div class="card">
          <h4>Utilisateurs</h4>
          <p class="helper">Total utilisateurs, activer/désactiver</p>
        </div>
        <div class="card">
          <h4>Projets</h4>
          <p class="helper">Créer / désactiver projets</p>
        </div>
        <div class="card">
          <h4>Statistiques</h4>
          <p class="helper">Métriques globales</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
