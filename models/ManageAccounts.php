<?php

class Manager
{
    // Permet de retourner tout les mails des utilisateurs
    public function fetchAllUsers()
    {
        $pdo = Database::getConnection();

        $added = $pdo->prepare("SELECT mail FROM users");
        $added->execute();
        return $added->fetchAll();
    }

    //
    public function fetchUser($mail)
    {
        $pdo = Database::getConnection();

        $added = $pdo->prepare("SELECT * FROM users WHERE mail=:mail");
        $added->execute(array("mail" => $mail));
        return $added->fetch();
    }
}

?>