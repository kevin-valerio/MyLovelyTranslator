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
      
    }
 