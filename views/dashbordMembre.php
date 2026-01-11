<?php
session_start();
if (empty($_SESSION['user'])) {
    header('Location: /POO/views/login.php');
    exit;
}
if (strtoupper($_SESSION['user']['role'] ?? '') !== 'MEMBRE') {
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
    <link rel="stylesheet" href="/POO/assets/css/auth.css">
    <style>.container{max-width:900px;margin:2rem auto}</style>
</head>
<body>
  <div class="container">
    <header>
      <h2>Bienvenue, <?= htmlspecialchars($_SESSION['user']['nom']) ?></h2>
      <p class="small-text">Vos tâches assignées</p>
      <p><a class="link" href="/POO/core/logout.php">Se déconnecter</a></p>
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
</body>
</html>
