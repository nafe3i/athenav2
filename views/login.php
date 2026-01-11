<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Connexion</title>
    <link rel="stylesheet" href="/POO/assets/css/auth.css">
</head>
<body>
<div class="auth-container">
  <div class="auth-card">
    <div class="auth-header">
      <h1>Connexion</h1>
      <p class="small-text">Connectez-vous avec votre email et mot de passe</p>
    </div>
    <?php
    $lien = require "../core/loginme.php";
    ?>
    <form action="<?php $lien ?>" method="POST">
        <div class="form-group">
            <label class="form-label">Email</label>
            <input class="form-control" type="email" name="email" required>
        </div>
        <div class="form-group">
            <label class="form-label">Mot de passe</label>
            <input class="form-control" type="password" name="mot_de_passe" required>
        </div>
       
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Se connecter</button>
        </div>
        <?php if (!empty($message)): ?>
          <p class="error"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <div class="meta">
          <p class="small-text">Pas de compte ? <a class="link" href="/POO/views/registre.php">S'inscrire</a></p>
        </div>
    </form>
  </div>
</div>
</body>
</html>