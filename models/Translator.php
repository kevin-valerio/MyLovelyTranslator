<?php
require_once 'controllers/LanguageController.php';
require_once 'models/Translation.php';

class Translator
{

    private $mainLanguage;
    private static $languageArray = array('EN' => 'English', 'FR' => 'Francais');


    function __construct($language)
    {
        $this->mainLanguage = $language;

    }

    public static function getLanguages()
    {
        return self::$languageArray;
    }

    public static function addLanguage($language)
    {
        array_push(self::$languageArray, $language);
    }

    /*
     * Obtient une traduction en fonction de $id
     */
    public function getTranslate($id)
    {
        $pdo = Database::getConnection();

        try {
            $query = $pdo->prepare("SELECT expression FROM " . $this->mainLanguage . " WHERE id = '" . $id . "'");
            $query->execute();
            $fetchedTranslate = $query->fetch();

        } catch (PDOException $e) {
            createCookie('lang', 'Francais');
            $this->$mainLanguage = array_search($this->mainLanguage, self::$languageArray);
            try {
                $query = $pdo->prepare("SELECT expression FROM " . $this->$mainLanguage . " WHERE id = '" . $id . "'");
                $query->execute();
                $fetchedTranslate = $query->fetch();
            } catch (PDOException $e) {
                echo "\"><p>Alerte SQL liée à Translator.php, lignes [35, 40]</p></form></div></nav></div>";
                exit;
            }

        }

        return $fetchedTranslate[0];

    }


    public function getTranslations($langue = NULL)
    {

        /*
       * Récupère toutes les traductions
       */

        $pdo = Database::getConnection();

        if (is_null($langue)) {
            $langue = $_COOKIE['lang'];
        }

        $query = $pdo->prepare("SELECT * FROM " . $langue);
        $query->execute();

        if (empty($query)) {
            return null;
        }

        $translations = [];
        while ($tuple = $query->fetch())
            array_push($translations, new Translation($tuple["id"], $tuple["expression"]));


        return $translations;
    }

    /*
     * @update : TRUE si $expression existe, si FALSE : on la crée
     *
     */
    public function add($exprId, $expression, $update)
    {
        $pdo = Database::getConnection();
        $langue = $_COOKIE['lang'];
        $query = $pdo->prepare("SELECT expression FROM " . $langue . " WHERE id = :id");
        $query->execute(array(
            "id" => $exprId
        ));
        $expr = $query->fetch()["expression"];

        /*
         * si l'expression existe déjà
         * et que le booleen update est a true
         */
        if (isset($expr) AND $update) {
            $query = $pdo->prepare("UPDATE " . self::$languageArray[$this->mainLanguage] .
                " SET expression= :expression WHERE id= :id ");
        } else if (!isset($expr) AND !$update) {
            $query = $pdo->prepare("INSERT INTO " . self::$languageArray[$this->mainLanguage] . " (id, expression)  VALUES (:id, :expression)");
        }

        $query->execute(array(
            "id" => $exprId,
            "expression" => $expression
        ));

        return $query == true;
    }

    public function newOne($expression, $langue = NULL)
    {

        $pdo = Database::getConnection();
        if ($langue == NULL) {
            $langue = $_COOKIE['lang'];
        }

        $query = $pdo->prepare("INSERT INTO " . $langue . " (expression)  VALUES (:expression)");
        $query->execute(array(
            "expression" => $expression
        ));

        return $query == true;

    }

}
 