<?php
require_once 'controllers/LanguageController.php';
require_once 'models/Translation.php';

    class Translator {

        private $mainLanguage;
        private static $languageArray = array('EN' => 'English', 'FR' => 'Francais');

      
        function __construct($language){      
              $this->$mainLanguage = $language;
          }

         public static function  getLanguages(){
             return self::$languageArray;
         } 

        public function getTranslate($id) {

            $pdo = Database::getConnection();
            $query = $pdo->prepare ("SELECT expression FROM " . $this->$mainLanguage . " WHERE id = '" . $id . "'");
            $query->execute();
            $fetchedTranslate = $query->fetch(); 
            return $fetchedTranslate[0];
  
        }

        public function getTranslations(){

            $pdo = Database::getConnection();
            $req = "SELECT * FROM " . self::$languageArray[$this->$mainLanguage];
            $query = $pdo->prepare ($req);
            $query->execute();

            if(empty($query)) return null;

            $translations = [];
            while($tuple = $query->fetch())
                array_push($translations, new Translation($tuple["id"], $tuple["expression"]));


            return $translations;
        }

        public function add($exprId, $expression, $update){
            $pdo = Database::getConnection();

            $query = $pdo->prepare ("SELECT expression FROM ". self::$languageArray[$this->$mainLanguage] ." WHERE id = :id");
            $query->execute(array(
                "id" => $exprId
            ));
            $expr = $query->fetch()["expression"];

            /*
             * si l'expression existe déjà
             * et que le booleen update est a true
             */
            if(isset($expr) AND $update){
                $query = $pdo->prepare("UPDATE ". self::$languageArray[$this->$mainLanguage]  .
                                                " SET expression= :expression WHERE id= :id ");
            }else {
                $query = $pdo->prepare("INSERT INTO " . self::$languageArray[$this->$mainLanguage] . " (id, expression)  VALUES (:id, :expression)");
            }

            $query->execute(array(
                "id" => $exprId,
                "expression" => $expression
            ));

            return $query == true;
        }

        public function change($exprId, $expression){

        }

      
    }
 