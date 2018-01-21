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
                $added = $translatorBis->add($request->getExpressionId(),$request->getTranslation());

                if($added)
                    $state = "allowed";
            }
            $request->setState($state);

        }


        $_SESSION["all-requests"] = TranslationRequest::getAll();

        showAllWithView("views/translation/translation-requests-handler.php");

    }
}