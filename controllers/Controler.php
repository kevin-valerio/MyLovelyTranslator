<?php

require_once 'utils/alert.php';

require 'models/Translator.php';

class Controller
{
    /*
     * Cette classe est la classe mère de tous les controlleurs.
     * Chaque controlleur hérite de cette classe.
     */
    private static $mainUser;

    /*
     * Renvoie la langue "préférée"
     */
    public static function getLangueInAnyContext()
    {
        $langue = $_COOKIE['lang'];
        return $langue;
    }

    /*
     * Renvoie l'utilisateur connecté
     */
    public static function getMainUser()
    {
        self::$mainUser = $_SESSION['account'];
        return self::$mainUser;
    }

    /*
     * Return false si l'URL n'est pas valide
     */
    public function checkIfValidURL()
    {
        $action = filter_input(INPUT_GET, 'action');
        if (is_null($action) || $action == '') {
            Alerte::printAlert(Alerte::INFO, 'Aucune action connue !');
        }
    }

    /*
     * Définit Français comme langue par défaut
     */
    public function defineDefaultLanguage()
    {
        if (is_null(self::$mainUser)) {
            createCookie('lang', 'Francais', 168);
        }
    }
}