<?php

require_once 'models/User.php';
require_once 'utils/util.php';
require_once 'controllers/Controler.php';
require_once 'models/Search.php';


class SearchController extends Controller
{

    public function doSearch()    //cette fonction gere l'affichage d'une traduction
    {
        $langue = Controller::getLangueInAnyContext();
        $translator = new Translator($langue);
        showAllWithView('views/translation/translation-search.php');
        $user = UserController::getMainUser();
        if (empty($user) && Search::verifySearch() || !empty($user)) { //on verifie la contrainte de 10minutes
            $sentence = $_POST['sentenceToTranslate'];
            $langageSource = $_POST['languageSource'];
            $langageDest = $_POST['languageDestination'];
            if (!$sentence) {
                echo $translator->getTranslate(1099) . '</br>';       //on verifie que l'utilisateur ai saisi quelque chose
                echo '</br>';
                return;
            }
            if (!empty($user) && $user->getGrade() >= 2) {
                $langageDetect = Search::detectLangage($sentence);   //on applique la detection de langue si l'user en a le droit
            }
            echo $translator->getTranslate(1068) . ' ' . $sentence . '</br>';
            echo '</br>';
            if ($langageDetect != '') {
                echo $translator->getTranslate(1071) . ' ' . $langageDetect . '</br>';  //sinon avec la langue detectée au cas ou l'user
                echo '</br>';                                                          //aurait oublier de selectionné une langue source
                $idSentence = Search::searchExpression($sentence, $langageDetect);
            }
            else {
                echo $translator ->getTranslate(1073). '</br>';
                echo  '</br>';
                $idSentence = Search::searchExpression($sentence, $langageSource); //si aucune langue detecter on effectue la
            }                                                                      //recherche avec la langue source selectionné
            if ($idSentence != 0) {
                $translateSentence = Search::translateExpression($idSentence, $langageDest);    //si le mot recherché existe dans la bd
                if ($translateSentence != '') {                                                 //retourne la traduction associé dans la langue voulu
                    echo $translator->getTranslate(1072) . ' ' . $translateSentence . '</br>';
                    echo '</br>';
                }
                else{
                    echo $translator ->getTranslate(1076) . ' ' .$langageDest . '</br>';
                    echo '</br>';
                    echo $translator ->getTranslate(1070) . '</br>';
                    echo  '</br>';
                }
            }
            else{
                echo $translator ->getTranslate(1069) . ' ' .$langageSource . '</br>';
                echo '</br>';
                echo $translator ->getTranslate(1070) . '</br>';
                echo  '</br>';
            }
        }
        else{
                echo $translator ->getTranslate(1074) .' '.(600 - User::getLastVisit()) . ' ' . $translator ->getTranslate(1075) . '<br>';
            echo '</br>';
        }
    }
}