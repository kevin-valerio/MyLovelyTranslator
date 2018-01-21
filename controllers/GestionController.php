<?php
/**
 * Created by PhpStorm.
 * User: Fallou
 * Date: 19/01/2018
 * Time: 11:00
 */

class GestionController extends Controller
{
    public function mainHandler(){
        $user = Controller::getMainUser();

        if(empty($user)) IndexController::index();
        if($user->getGrade() < 3) IndexController::index();

        showAllWithView("views/translation/main-handler.php");
    }

    /*
     * Autorisation ou refus de traduction compte premium
     */
    public function translationRequestsHandler(){
        $user = Controller::getMainUser();

        if(empty($user)) IndexController::index();
        if($user->getGrade() < 3) IndexController::index();


        $authorize = filter_input(INPUT_GET, "authorize");
        $transID = filter_input(INPUT_GET,"transID");

        if(isset($authorize) AND isset($transID)){

            $request = TranslationRequest::get($transID);
            $state = "rejected";
            if($authorize == "true"){

                $translatorBis = new Translator($request->getTranslationLanguage());
                $added = $translatorBis->add($request->getExpressionId(),$request->getTranslation(), false);

                if($added)
                    $state = "allowed";
            }
            $request->setState($state);

        }


        $_SESSION["all-requests"] = TranslationRequest::getAll();

        showAllWithView("views/translation/translation-requests-handler.php");

    }


/*
 * Modification de traductions
 * existante
 */
    public function changes(){

        $user = Controller::getMainUser();
        if(empty($user)) IndexController::index();
        if($user->getGrade() < 3) IndexController::index();

        $exprID = filter_input(INPUT_POST, "expressionID");
        $langue = filter_input(INPUT_POST, "language");

        if(empty($langue) OR empty($exprID))
            showAllWithView("/controller=gestion&action=changes&info=50");


        $translatorBis = new Translator($langue);



        $_SESSION["phrases-changes"] = $translatorBis->getTranslations();

        showAllWithView("views/translation/changes.php");
    }
}