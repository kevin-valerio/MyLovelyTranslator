<?php
require_once 'controllers/Controler.php';
require_once 'models/Translator.php';

class LanguageController extends Controller
{
    function __construct()
    {
        parent::checkIfValidURL();
    }

    public static function getLanguage()
    {
        $account = Controller::getMainUser();

        if (!is_null($account)) {
            return $account->getPrefLangue();
        } else {
            return $_COOKIE['lang'];
        }
    }

    public function changeLanguage()
    {
        $newLang = filter_input(INPUT_POST, 'lang');
        $user = Controller::getMainUser();

        if (!is_null($user)) {
            $user->setPrefLanguage($newLang);
        }

        createCookie('lang', $newLang, 168);
        createCookie('changedLang', '1', 168);
        $_COOKIE['lang'] = $newLang;

        refresh();
    }
}
?>