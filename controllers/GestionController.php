<?php

require_once "models/CSVExporter.php";

class GestionController extends Controller
{
    /*
     * C'est la fonction qui est censée affichée le panneau de gestion principal
du compte traducteur(Bouton Gestion)
     */
    public function mainHandler()
    {
        $user = Controller::getMainUser();

        if (empty($user) || $user->getGrade() < 3) {
            IndexController::index();
        } else {
            showAllWithView("views/translation/main-handler.php");
        }

    }

    public function language()
    {
        showAllWithView("views/admin/lang.php");
    }

    public function addLanguage()
    {
        $newLangue = filter_input(INPUT_POST, "langue");

        $bdd = Database::getConnection();
        $query = "CREATE TABLE `$newLangue` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,  `expression` VARCHAR(1200)	 NOT NULL )";
        $bdd->exec($query);
        Translator::addLanguage($newLangue);
        redirect("/?controller=gestion&action=language&info=1");
    }

    public function exportTranslation()
    {
        showAllWithView("views/translation/export.php");
    }

    public function export()
    {
        $destLanguage = filter_input(INPUT_POST, "lang-dest");

        $translator = new Translator($destLanguage);
        $allTranslates = $translator->getTranslations($destLanguage);

        $exporter = new CSVExporter();
        $exporter->export($allTranslates);
        $exporter->download();
        $exporter->deleteTmpCSV();
    }

    /*
     * Le but de cette fonction est de répondre à l'action du traducteur en autorisant
ou pas une traduction qu'il a inspécté (dans Gérer les demandes) et qui redirige
vers cette dernière.
     */
    public function translationRequestsHandler()
    {
        /*
         * Autorisation ou refus de traduction compte premium
         */
        $user = Controller::getMainUser();
        if (empty($user) OR $user->getGrade() < 3) {
            IndexController::index();
        }

        $authorize = filter_input(INPUT_GET, "authorize");
        $transID = filter_input(INPUT_GET, "transID");

        if (isset($authorize) AND isset($transID)) {

            $request = TranslationRequest::get($transID);
            $state = "rejected";
            if ($authorize == "true") {

                $translatorBis = new Translator($request->getTranslationLanguage());
                $added = $translatorBis->add($request->getExpressionId(), $request->getTranslation(), true);

                if ($added) {
                    $state = "allowed";
                }
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
    public function changes()
    {
        $user = Controller::getMainUser();
        if (empty($user) OR $user->getGrade() < 3) {
            IndexController::index();
        }

        $exprID = filter_input(INPUT_POST, "expressionID");
        $translation = filter_input(INPUT_POST, "translation");
        $langue = filter_input(INPUT_POST, "language");
        $changed = filter_input(INPUT_GET, "changed");

        $translatorBis = new Translator($langue);

        if (isset($changed) AND $changed == "yes") {

            if (isset($exprID) AND isset($translation) AND isset($langue)) {

                $added = $translatorBis->add($exprID, $translation, true);

                if ($added) {
                    redirect("/?controller=gestion&action=changes&info=51");
                }
                else {
                    redirect("/?controller=gestion&action=changes&info=52");
                }
            } else
                redirect("/?controller=gestion&action=changes&info=50");

        }

        $_SESSION["phrases-changes"] = $translatorBis->getTranslations();

        showAllWithView("views/translation/changes.php");
    }

    public function newTranslate()
    {
        $user = Controller::getMainUser();
        if (empty($user) || ($user->getGrade() < 3)) {
            IndexController::index();
        }

        $dstLanguage = filter_input(INPUT_POST, "language-s");
        $srcLanguage = filter_input(INPUT_POST, "language-d");
        $srcTranslation = filter_input(INPUT_POST, "translation-s");
        $changing = filter_input(INPUT_GET, "changed");
        $dstTranslation = filter_input(INPUT_POST, "translation-d");

        $dstTranslator = new Translator($dstLanguage);
        $srcTranslator = new Translator($srcLanguage);

        if (isset($changing) && $changing == "yes") {

            $ajoutSrc = $srcTranslator->newOne($dstTranslation, $srcLanguage);
            $ajoutDst = $dstTranslator->newOne($srcTranslation, $dstLanguage);

            if ($ajoutSrc && $ajoutDst) {
                redirect("/?controller=gestion&action=newTranslate&info=54");
            }
            else {
                redirect("/?controller=gestion&action=newTranslate&info=55");
            }
        }


        showAllWithView("views/translation/translator-translate.php");
    }
}