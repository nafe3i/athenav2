<?php
require_once __DIR__ . '/../utils/auth.php';
// protection simple : vérifier la session et le rôle
if (!currentUser()) {
  header('Location: /POO/views/login.php');
  exit;
}
if (!hasAnyRole(['CHEF','ADMIN','MEMBRE'])) {
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
    <link rel="stylesheet" href="/POO/assets/css/dashboard.css">
    <link rel="stylesheet" href="/POO/assets/css/auth.css">
</head>
<body>
  <div class="dash-container">
    <div class="dash-sidebar">
      <h2>Projet</h2>
      <nav>
        <a href="/POO/views/dashborChef.php">Tableau</a>
        <a href="/POO/views/dashbordMembre.php">Mes tâches</a>
        <a href="/POO/views/dashborAdmin.php">Admin</a>
        <a href="/POO/core/logout.php">Se déconnecter</a>
      </nav>
    </div>
    <div class="dash-main">
      <header class="dash-header">
        <div class="dash-title">Bonjour, <?= htmlspecialchars($_SESSION['user']['nom']) ?></div>
        <div class="dash-actions"><span class="muted">Rôle : Chef de projet</span></div>
      </header>

      <div class="grid">
        <main>
          <div class="card">
            <h3>Projets récents</h3>
            <div class="project-list">
              <?php if (!empty($projects)): ?>
                <?php foreach ($projects as $p): ?>
                  <div class="project-row">
                    <div class="project-meta">
                      <div>
                        <strong><?= htmlspecialchars($p['nom'] ?? $p['titre'] ?? '—') ?></strong>
                        <div class="muted"><?= htmlspecialchars(substr($p['description'] ?? '', 0, 120)) ?></div>
                      </div>
                    </div>
                    <div class="badge">Chef: <?= htmlspecialchars($p['chef_nom'] ?? '') ?></div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <p class="helper">Aucun projet récent.</p>
              <?php endif; ?>
            </div>
          </div>

          <div class="card mt-2">
          <h3>Créer un projet</h3>
          <?php if (!empty($_SESSION['flash_message'])): ?>
            <p class="<?= (!empty($_SESSION['flash_success']) && $_SESSION['flash_success']) ? 'helper' : 'error' ?>"><?= htmlspecialchars($_SESSION['flash_message']) ?></p>
            <?php unset($_SESSION['flash_message'], $_SESSION['flash_success']); ?>
          <?php endif; ?>

          <?php if (hasAnyRole(['CHEF','ADMIN'])): ?>
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
                <button class="btn" type="submit">Créer</button>
              </div>
            </form>
          <?php else: ?>
            <p class="helper">Vous n'êtes pas autorisé à créer des projets.</p>
          <?php endif; ?>
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
  </div>
</body>
</html>
