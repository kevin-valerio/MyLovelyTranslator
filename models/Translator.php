<?php
require_once 'controllers/LanguageController.php';
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

            return $query;
        }

        public function add($exprId, $expression){
            $pdo = Database::getConnection();

            $query = $pdo->prepare ("SELECT expression FROM ". self::$languageArray[$this->$mainLanguage] ." WHERE id = :id");
            $query->execute(array(
                "id" => $exprId
            ));
            $expr = $query->fetch()["expression"];

            if(isset($expr)){
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

      
    }
 