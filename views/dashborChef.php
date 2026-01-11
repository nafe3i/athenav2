<?php
session_start();
// protection simple : vérifier la session et le rôle
if (empty($_SESSION['user'])) {
    header('Location: /POO/views/login.php');
    exit;
}
if (strtoupper($_SESSION['user']['role'] ?? '') !== 'CHEF') {
    echo 'Accès refusé.';
    exit;
}
// charger le service projets
require_once __DIR__ . '/../services/projectService.php';
$projectService = new ProjectService();
$projects = $projectService->getRecentProjects(5);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard Chef de projet</title>
    <link rel="stylesheet" href="/POO/assets/css/auth.css">
    <style>
      .dash { max-width:1100px; margin:2rem auto; }
      .grid { display:grid; grid-template-columns: 1fr 320px; gap:1rem; }
      .card{ background:#fff; padding:1rem; border-radius:8px; box-shadow:0 6px 18px rgba(2,6,23,0.04);} 
    </style>
</head>
<body>
  <div class="dash">
    <header class="mb-2">
      <h2>Bonjour, <?= htmlspecialchars($_SESSION['user']['nom']) ?></h2>
      <p class="small-text">Rôle : Chef de projet</p>
      <p><a class="link" href="/POO/core/logout.php">Se déconnecter</a></p>
    </header>

    <div class="grid">
      <main>
        <div class="card">
          <h3>Projets récents</h3>
          <?php if (!empty($projects)): ?>
            <ul>
              <?php foreach ($projects as $p): ?>
                <li><strong><?= htmlspecialchars($p['nom'] ?? $p['titre'] ?? '—') ?></strong>
                    <div class="small-text"><?= htmlspecialchars(substr($p['description'] ?? '', 0, 120)) ?></div>
                    <div class="small-text">Chef: <?= htmlspecialchars($p['chef_nom'] ?? '') ?></div>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <p class="helper">Aucun projet récent.</p>
          <?php endif; ?>
        </div>
        <div class="card mt-2">
          <h3>Créer un projet</h3>
          <?php if (!empty($_SESSION['flash_message'])): ?>
              <p class="<?= (!empty($_SESSION['flash_success']) && $_SESSION['flash_success']) ? 'helper' : 'error' ?>"><?= htmlspecialchars($_SESSION['flash_message']) ?></p>
              <?php unset($_SESSION['flash_message'], $_SESSION['flash_success']); ?>
          <?php endif; ?>
          <form action="/POO/core/projects.php" method="POST">
              <div class="form-group">
                  <label class="form-label">Titre</label>
                  <input class="form-control" type="text" name="titre" required>
              </div>
              <div class="form-group">
                  <label class="form-label">Description</label>
                  <textarea class="form-control" name="description" rows="3"></textarea>
              </div>
              <div class="form-group">
                  <button class="btn btn-primary" type="submit">Créer</button>
              </div>
          </form>
        </div>
        <div class="card mt-2">
          <h3>Board du sprint</h3>
          <p class="helper">Kanban simplifié (placeholder)</p>
        </div>
      </main>
      <aside>
        <div class="card">
          <h4>Statistiques</h4>
          <ul>
            <li>Total tâches : --</li>
            <li>Tâches ouvertes : --</li>
            <li>Sprints en cours : --</li>
          </ul>
        </div>
        <div class="card mt-2">
          <h4>Membres</h4>
          <p class="helper">Liste des membres du projet</p>
        </div>
      </aside>
    </div>
  </div>
</body>
</html>
