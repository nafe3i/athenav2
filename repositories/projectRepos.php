<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../entities/projet.php';

class ProjectRepos
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getconnection();
    }

    // Ajoute un projet (nom, description, chef_projet_id)
    public function ajoute(string $nom, ?string $description, int $chef_projet_id): bool
    {
        // `projets` table uses `date_debut` instead of `created_at` per schema
        $sql = "INSERT INTO projets (nom, description, date_debut, chef_projet_id) VALUES (?, ?, CURDATE(), ?)";
        $stmt = $this->db->prepare($sql);
        return (bool)$stmt->execute([$nom, $description, $chef_projet_id]);
    }

    // Met à jour un projet (nom, description, id)
    public function update(string $nom, ?string $description, int $id): bool
    {
        $sql = "UPDATE projets SET nom = ?, description = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return (bool)$stmt->execute([$nom, $description, $id]);
    }

    // Retourne tous les projets
    public function findall(): array
    {
        $sql = "SELECT * FROM projets ORDER BY date_debut DESC";
        $stmt = $this->db->query($sql);
        $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $res === false ? [] : $res;
    }

    // Supprime un projet par id
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM projets WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return (bool)$stmt->execute([$id]);
    }

    // Cherche un projet par id (avec nom du chef)
    public function findById(int $id): ?array
    {
        $sql = "SELECT p.*, u.nom AS chef_nom FROM projets p LEFT JOIN utilisateurs u ON p.chef_projet_id = u.id WHERE p.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res === false ? null : $res;
    }

    // Retourne les projets d'un chef
    public function findByChef(int $chef_projet_id): array
    {
        $sql = "SELECT * FROM projets WHERE chef_projet_id = ? ORDER BY date_debut DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$chef_projet_id]);
        $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $res === false ? [] : $res;
    }

    // Rechercher avec whitelist pour la colonne
    public function search(string $propr, $value): ?array
    {
        $allowed = ['id', 'nom', 'chef_projet_id', 'statut'];
        if (!in_array($propr, $allowed, true)) {
            return null;
        }
        $sql = "SELECT * FROM projets WHERE $propr = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$value]);
        $res = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $res === false ? null : $res;
    }

    // Compte total
    public function count(): int
    {
        $sql = "SELECT COUNT(*) FROM projets";
        $stmt = $this->db->query($sql);
        $res = $stmt->fetchColumn();
        return (int)$res;
    }

    // Méthode utilitaire : projets récents (limit)
    public function findRecent(int $limit = 5): array
    {
        $sql = "SELECT p.id, p.nom, p.description, p.chef_projet_id, u.nom AS chef_nom, p.date_debut
                FROM projets p
                LEFT JOIN utilisateurs u ON p.chef_projet_id = u.id
                ORDER BY p.date_debut DESC LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $res === false ? [] : $res;
    }
}
