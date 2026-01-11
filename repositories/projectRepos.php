<?php
require '../config/database.php';
require '../entities/projet.php';

class ProjectRepos
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getconnection();
    }

    // Ajoute un projet (nom, description, chef_projet_id)
    public function ajoute($nom, $description, $chef_projet_id)
    {
        $sql = "INSERT INTO projets (nom, description, chef_projet_id, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nom, $description, $chef_projet_id]);
    }

    // Met à jour un projet (nom, description, actif, id)
    public function update($nom, $description, $actif, $id)
    {
        $sql = "UPDATE projets SET nom = ?, description = ?, actif = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nom, $description, $actif, $id]);
    }

    // Retourne tous les projets
    public function findall()
    {
        $sql = "SELECT * FROM projets ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Supprime un projet par id
    public function delete($id)
    {
        $sql = "DELETE FROM projets WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Cherche un projet par id (avec nom du chef)
    public function findById($id)
    {
        $sql = "SELECT p.*, u.nom AS chef_nom FROM projets p LEFT JOIN utilisateurs u ON p.chef_projet_id = u.id WHERE p.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Retourne les projets d'un chef
    public function findByChef($chef_projet_id)
    {
        $sql = "SELECT * FROM projets WHERE chef_projet_id = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$chef_projet_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Rechercher avec whitelist pour la colonne
    public function search($propr, $value)
    {
        $allowed = ['id', 'nom', 'chef_projet_id', 'actif'];
        if (!in_array($propr, $allowed, true)) {
            return false;
        }
        $sql = "SELECT * FROM projets WHERE $propr = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$value]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Compte total
    public function count()
    {
        $sql = "SELECT COUNT(*) FROM projets";
        $stmt = $this->db->query($sql);
        return $stmt->fetchColumn();
    }

    // Méthode utilitaire : projets récents (limit)
    public function findRecent($limit = 5)
    {
        $sql = "SELECT p.id, p.nom, p.description, p.chef_projet_id, u.nom AS chef_nom, p.created_at
                FROM projets p
                LEFT JOIN utilisateurs u ON p.chef_projet_id = u.id
                ORDER BY p.created_at DESC LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
