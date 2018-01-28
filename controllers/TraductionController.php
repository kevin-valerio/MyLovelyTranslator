<?php

require_once 'models/User.php';
require_once 'utils/util.php';
require_once 'views/core.php';
require_once 'controllers/Controler.php';
require_once 'models/Translator.php';
require_once 'models/TranslationRequest.php';

class TraductionController extends Controller
{
    /*
     * Affiche la vue qui permettra de saisir les données nécessaire à la demande de traduction
     */
    public function translate()
    {
        $user = Controller::getMainUser();

        if (empty($user) OR $user->getGrade() < 2) {
            IndexController::index();
        }

        $translator = new Translator($user->getPrefLanguage());

        $_SESSION["phrases"] = $translator->getTranslations();
        showAllWithView('views/translation/translate.php');
    }

    /*
     * Fonction qui affiche les demandes de l'utilisateur connecté
     */
    public function myRequests()
    {
        $user = Controller::getMainUser();

        if (empty($user) OR $user->getGrade() < 2) {
            IndexController::index();
        }

        $_SESSION["my-requests"] = TranslationRequest::getByEmail($user->getMail());

        showAllWithView('views/translation/premium-requests.php');
    }

    /*
     * Permet d'ajouter la demande de traduction dans la base
     * si la phrase recherché existe (Search::)
     */
    public function add()
    {
        $user = Controller::getMainUser();

        if (empty($user) OR $user->getGrade() <= 1) {
            IndexController::index();
        }

        $languageSource = filter_input(INPUT_POST, 'languageSource');
        $languageDest = filter_input(INPUT_POST, 'languageDest');
        $searchSentence = filter_input(INPUT_POST, 'searchSentence');
        $translateSentence = filter_input(INPUT_POST, 'translateSentence');

        if (empty($searchSentence) OR empty($translateSentence)) {
            redirect("/?controller=traduction&action=translate&info=50");
        }
        $idSentence = Search::searchExpression($searchSentence, $languageSource);

        if ($idSentence != 0) {
            if (empty($languageSource) OR empty($languageDest)) {
                redirect("/?controller=traduction&action=translate&info=50");
            }
            // on ajoute la demande de traduction et un compta traducteur gerera tous ca
            $tr = new TranslationRequest(null, $idSentence, $translateSentence, $languageSource, $user->getMail(), null);
            if (!$tr->addRequest()) {
                redirect("/?controller=traduction&action=translate&info=52");
            }
            else {
                redirect("/?controller=traduction&action=translate&info=51");
            }
        } else {
            redirect("/?controller=traduction&action=translate&info=53");
        }
    }
}
