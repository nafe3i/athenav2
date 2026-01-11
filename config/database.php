<?php
class Database
{
    private static $instance = null;
    private $connect;
    private function __construct()
    {
        $serveur = "localhost";
        $username = "root";
        $password = "amine@2002@N";
        $namedb = "athena";
        try {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $this->connect = new PDO("mysql:host=$serveur;dbname=$namedb;charset=utf8mb4", $username, $password, $options);
        } catch (PDOException $e) {
            error_log('Database connection error: ' . $e->getMessage());
            // Ne pas afficher l'erreur détaillée en production
            die('Database connection error');
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getconnection()
    {
        return $this->connect;
    }
}

$db = Database::getInstance();
$db->getconnection();




