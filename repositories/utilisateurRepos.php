<?php
require '../config/database.php';
require '../entities/utilisateur.php';

class UtilisateurRepos
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getconnection();
    }

    public function ajoute($nom, $email, $mot_de_passe): bool
    {
        $sql = "INSERT INTO utilisateurs (nom,email,mot_de_passe) VALUES (?,?,?)";
        $stmt = $this->db->prepare($sql);
        return (bool)$stmt->execute([$nom, $email, $mot_de_passe]);
    }

    public function update($nom, $email, $actif, $id)
    {
        $sql = "UPDATE utilisateurs SET nom = ? , email = ? , actif = ? where id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nom, $email, $actif, $id]);

    }
    public function findall()
    {
        $sql = "SELECT * FROM utilisateurs";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM utilisateurs WHERE id = ? ";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);

    }
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM utilisateurs WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function findByRole($role)
    {
        $sql = "SELECT * FROM utilisateurs WHERE role = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$role]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function search($propr, $value)
    {
        // Whitelist des colonnes autorisées pour éviter l'injection SQL via le nom de colonne
        $allowed = ['id', 'nom', 'email', 'role', 'actif'];
        if (!in_array($propr, $allowed, true)) {
            return false; // ou throw new Exception('Colonne non autorisée');
        }
        $sql = "SELECT * FROM utilisateurs WHERE $propr = ?";
        $stml = $this->db->prepare($sql);
        $stml->execute([$value]);
        return $stml->fetch(PDO::FETCH_ASSOC);
    }
    public function count()
    {
        $sql = "SELECT COUNT(*) FROM utilisateurs ";
        $stmt = $this->db->query($sql);
        return $stmt->fetchColumn();
        
    }
}