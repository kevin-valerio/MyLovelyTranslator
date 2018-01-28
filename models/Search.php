<?php


/**
 * Created by PhpStorm.
 * User: t16016200
 * Date: 22/01/18
 * Time: 16:45
 */
require_once 'models/User.php';
class Search
{
    public function verifySearch() //cette fonction consiste a verifier la contrainte de temps pour les utilisateur non connecté
    {
        $pdo = Database::getConnection();
        $leftTime = User::getLastVisit(); //permet de savoir le temps qu'il s'est ecoulé depuis la denriere demande de traduction
        if ($leftTime > 600) {//doit etre superieur à 600
            $query = $pdo->prepare("UPDATE Visite SET lastVisit = :visit   WHERE ipUser = :ip");
            $query->bindParam(':visit', date('Y-m-d H:i:s', getTime()), PDO::PARAM_INT);
            $query->bindParam(':ip', getIPAdress(), PDO::PARAM_STR);
            if (!($query->execute())) {
                var_dump($query->errorInfo());
            }
            return true;
        } else {
            return false;
        }

    }

    public function searchExpression($sentence, $langageSource)//permet de savoir si une expression est presente dans une langue source
    {
        $pdo = Database::getConnection();
        $query = $pdo->prepare("SELECT id FROM $langageSource WHERE expression = :expression"); //on verifie qu'il existe dans la bd
        $query->execute(array(expression => $sentence));
        if ($fetchedMention = $query->fetch()) {
            $idSentence = $fetchedMention['id'];
            return $idSentence;
        } else {
            return $idSentence = 0;      //on retourne l'id de l'expression
        }

    }

    public function translateExpression($id, $langageDest) //permet de traduire une expression donnée dans une langue souhaitée
    {
        $pdo = Database::getConnection();
        $query = $pdo->prepare("SELECT expression FROM $langageDest WHERE id = :id");
        $query->execute(array(id => $id));          //on récupere l'expression de l'id correspondant dans la bd
        if ($fetchedMention = $query->fetch()) {
            if ($fetchedMention['expression'] != '') {
                $translateSentence = $fetchedMention['expression'];
                return $translateSentence;          //on retourne l'expression
            }
        }



    }

    public function detectLangage($expression) //permet de detecter une langue
    {
        $tabLang = Translator::getLanguages();  //on recupere toute les langues de notre bd
        $pdo = Database::getConnection();
        foreach ($tabLang as $langTmp) {
            $query = $pdo->prepare("SELECT * FROM $langTmp WHERE expression = '$expression'");
            $query->execute();      //on regarde si l'expression est existe dans une dans des langues
            if ($fetchedMention = $query->fetch()) {
                $language = $langTmp;
                return $language; //si oui on retourne la langue
            }
        }
    }
}