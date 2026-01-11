<?php
session_start();
if (empty($_SESSION['user'])) {
    header('Location: /POO/views/login.php');
    exit;
}
if (strtoupper($_SESSION['user']['role'] ?? '') !== 'ADMIN') {
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
    <link rel="stylesheet" href="/POO/assets/css/auth.css">
    <style>.wrap{max-width:1100px;margin:2rem auto}.grid3{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem}</style>
</head>
<body>
  <div class="wrap">
    <header>
      <h2>Admin Panel</h2>
      <p class="small-text">Gestion globale</p>
      <p><a class="link" href="/POO/core/logout.php">Se déconnecter</a></p>
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
</body>
</html>
