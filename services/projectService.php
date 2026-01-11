<?php
require_once __DIR__ . '/../repositories/projectRepos.php';

class ProjectService
{
    private ProjectRepos $repo;

    public function __construct()
    {
        $this->repo = new ProjectRepos();
    }

    // Récupère projets récents
    public function getRecentProjects(int $limit = 5): array
    {
        return $this->repo->findRecent($limit);
    }

    // Méthode similaire à verifierAjoute dans UtilisateurService
    public function verifierAjoute($nom, $description, $chef_projet_id)
    {
        $nom = trim($nom);
        if ($nom === '') {
            return [
                'success' => false,
                'message' => 'Le nom du projet est requis'
            ];
        }

        $ok = $this->repo->ajoute($nom, $description, $chef_projet_id);
        if ($ok) {
            return [
                'success' => true,
                'message' => 'Projet ajouté avec succès'
            ];
        }

        return [
            'success' => false,
            'message' => 'Erreur lors de l\'ajout du projet'
        ];
    }

    // Wrapper pour compatibilité (utilisé ailleurs)
    public function createProject(string $nom, ?string $description, int $chef_projet_id): array
    {
        return $this->verifierAjoute($nom, $description, $chef_projet_id);
    }

    public function getProjectsByChef(int $chef_projet_id): array
    {
        return $this->repo->findByChef($chef_projet_id);
    }
}
