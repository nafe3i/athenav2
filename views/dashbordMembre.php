<?php
require_once __DIR__ . '/../utils/auth.php';
// protection simple : vérifier la session et le rôle
if (!currentUser()) {
  header('Location: /POO/views/login.php');
  exit;
}
if (!hasAnyRole(['MEMBRE','CHEF','ADMIN'])) {
  echo 'Accès refusé.';
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard Membre</title>
    <link rel="stylesheet" href="/POO/assets/css/dashboard.css">
    <link rel="stylesheet" href="/POO/assets/css/auth.css">
</head>
<body>
  <div class="dash-container">
    <div class="dash-sidebar">
      <h2>Menu</h2>
      <nav>
        <a href="/POO/views/dashbordMembre.php">Mes tâches</a>
        <a href="/POO/core/logout.php">Se déconnecter</a>
      </nav>
    </div>
    <div class="dash-main container">
      <header class="dash-header">
        <div class="dash-title">Bienvenue, <?= htmlspecialchars($_SESSION['user']['nom']) ?></div>
        <div class="dash-actions"><span class="muted">Vos tâches assignées</span></div>
      </header>

      <section class="card mt-2">
        <h3>Mes tâches</h3>
        <p class="helper">Liste des tâches qui vous sont assignées (placeholder)</p>
      </section>

      <section class="card mt-2">
        <h3>Sprints assignés</h3>
        <p class="helper">Sprints en cours et à venir</p>
      </section>
    </div>
  </div>
</body>
</html>
