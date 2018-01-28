<?php

require_once 'controllers/Controler.php';
require_once 'views/core.php';
require 'models/ManageAccounts.php';

class AdministrationController extends Controller
{
    // Permet la redirection pour gérer les comptes
    public function gererComptes()
    {
        // Information de MAJ des données
        $informationMsg = filter_input(INPUT_GET, 'info');
        if ($informationMsg == '2') {
            Alerte::printAlert(Alerte::SUCCESS, 'Vos informations ont bien été mises à jour !');
        }

        $manager = new Manager();
        $_SESSION["comptes-user-list"] = $manager->fetchAllUsers();
        showAllWithView('views/admin/comptes.php');
    }

    // Permet de modifier les informations d'un compte
    public function editInfos()
    {
        $myUser = $_POST["list-users"];
        $_SESSION["user-edit"] = User::getUserByMail($myUser);
        $_SESSION['user-action'] = 'controller=administration&action=editAccount';
        /*
        if (1) {
            $_SESSION["user-action"] = "admin";
        }
        else {
            $_SESSION["user-action"] = "edit";
        }
        */
        showAllWithView('views/user/edit.php');
    }

    // Permet de modifier un compte
    public function editAccount()
    {

        $user = $_SESSION["user-edit"];
        $pseudo = filter_input(INPUT_POST, 'pseudo');
        $password = filter_input(INPUT_POST, 'password');
        $lang = filter_input(INPUT_POST, 'lang');
        $grade = filter_input(INPUT_POST, 'grade');

        // Ne peut changer son adresse mail de base

        $user->setPseudo($pseudo);
        $user->setPrefLanguage($lang);
        $user->setGrade($grade);
        if ($password != "") {
            $user->setPassword($password);
        }

        redirect("?controller=administration&action=gererComptes&info=2");
    }
}

?>