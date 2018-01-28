<?php

class Database
{

    const DB_PASSWORD = "falatava";
    const DB_USER = "150206"; /* Oui, il s'agit bien de l'utilisateur ! */
    const DB_NAME = "projetphpg3_bd";
    const DB_SERVER = "mysql-projetphpg3.alwaysdata.net";

    public static function getConnection()
    {
        try {

            $connection = 'mysql:host=' . self::DB_SERVER . ';dbname=' . self::DB_NAME;
            $pdo = new PDO($connection, self::DB_USER, self::DB_PASSWORD);
            $pdo->exec('SET CHARACTER SET utf8');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;

        } catch (PDOException $e) {
            die('Erreur lors de la connection au serveur : ' . $e->getMessage());
        }
    }
}

