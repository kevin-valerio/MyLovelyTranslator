<?php
/**
 * Created by PhpStorm.
 * User: Fallou
 * Date: 19/01/2018
 * Time: 11:00
 */

require_once 'models/User.php';
require_once 'utils/util.php';
require_once 'views/core.php';
require_once 'controllers/Controler.php';
require_once 'models/Translator.php';
require_once 'models/TranslationRequest.php';

class TraductionController extends Controller
{

    public function translate(){

        $user = Controller::getMainUser();

        if(empty($user) OR $user->getGrade() != 2)
            IndexController::index();

        $translator = new Translator($user->getPrefLanguage());

        $_SESSION["phrases"] = $translator->getTranslations();
        showAllWithView('views/translation/translate.php');
    }

    public function myRequests(){
        $user = Controller::getMainUser();

        if(empty($user) OR $user->getGrade() != 2)
            IndexController::index();

        $_SESSION["my-requests"] = TranslationRequest::getByEmail($user->getMailAdress());


        showAllWithView('views/translation/premium-requests.php');
    }

    public function add(){

        $user = Controller::getMainUser();

        if(empty($user) OR $user->getGrade() != 2)
            IndexController::index();

        $expressionId = filter_input(INPUT_POST, 'expressionId');
        $phrase = filter_input(INPUT_POST, 'translation');
        $langue = filter_input(INPUT_POST, 'language');


        if(empty($phrase) OR empty($langue))
            redirect("/?controller=traduction&action=translate&info=7");

        // on ajoute la demande de traduction et un compta traducteur gerera tous ca
        $tr = new TranslationRequest(null, $expressionId, $phrase,$langue, $user->getMailAdress(), null);
        if (!$tr->addRequest())
            redirect("/?controller=traduction&action=translate&info=9");
        else
            redirect("/?info=5");
    }
}