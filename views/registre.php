<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Inscription</title>
    <link rel="stylesheet" href="/POO/assets/css/auth.css">
</head>
<body>
<div class="auth-container">
  <div class="auth-card">
    <div class="auth-header">
      <h1>Inscription</h1>
      <p class="small-text">Créez un compte en quelques secondes</p>
    </div>
    <?php
    $lien = require "../core/registre.php";
    ?>
    <form action="<?php $lien?>" method="POST">
        <div class="form-group">
            <label class="form-label">Nom</label>
            <input class="form-control" type="text" name="nom" required>
        </div>
        <div class="form-group">
            <label class="form-label">Email</label>
            <input class="form-control" type="email" name="email" required>
        </div>
        <div class="form-group">
            <label class="form-label">Mot de passe</label>
            <input class="form-control" type="password" name="mot_de_passe" required>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">S'inscrire</button>
        </div>
        <?php if (!empty($message)): ?>
            <p class="<?= (!empty($success) && $success) ? 'helper' : 'error' ?>"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
    </form>
    <div class="meta">
        <p class="small-text">Déjà inscrit ? <a class="link" href="/POO/views/login.php">Se connecter</a></p>
    </div>
  </div>
</div>
</body>
</html>
