<?php
    require_once 'utils/database.php';
    class User {

        private $mailAdress;
        private $username;
        private $password;
        private $prefLanguage;
        private $grade;
        private $registerKey;
 
        public function __construct($mail, $username, $pw, $prefLang, $grade)
        {
            $this->mailAdress = $mail;
            $this->username = $username;
            $this->password = $pw;
            $this->prefLanguage = $prefLang;
            $this->grade = $grade;
        }

 
        public static function unlockAccountWithKey($key){
            
            try{
                $pdo = Database::getConnection();
                $query = $pdo->prepare("UPDATE users SET isActivated = '1' WHERE register_key = :register_key");
                $query->execute(array("register_key" => $key));
                redirect("/?info=3");

            }
            catch (PDOException $e) {
                redirect("/?info=4");
            }
        
        }

        public function isAccountValidated(){

            try{
                $pdo = Database::getConnection();
                $query = $pdo->prepare("SELECT isActivated, COUNT(*) count FROM users WHERE mail = :mail");
                $query->execute(array("mail" => $this->mailAdress));  
                $fetchedUser = $query->fetch();
 
                return $fetchedUser["isActivated"];
            }
            catch (PDOException $e) {
               redirect("/?controller=user&action=login&info=5");
               return 2;
            }

        }

        public function setAccountValidated(){         

            $pdo = Database::getConnection();
            $query = $pdo->prepare("UPDATE users SET isActivated = '1' WHERE mail = :mail");
            $query->execute(array("mail" => $this->mail));

        }


        public function sendRegisterMail($to, $key){

            $link = WEBSITE_URL . "/?controller=activation&action=unlock&key=" . $key;

            $subject = "My Lovely Translator - Activation de compte";
            $message="<html><body>Bonjour" . $username . ". <br><br><p>Voici le lien qui vous permettra de valider votre compte :
            </p><br><a href=\"" . $link . "\">" . $link . "</a></body></html>";
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            mail($to, $subject, $message, $headers);
        }


        public function setPrefLanguage($language){

            $this->prefLanguage = $language;
            $pdo = Database::getConnection();
            $query = $pdo->prepare("UPDATE users SET langue = :langue WHERE mail = :mail");
            $query->execute(array("langue" => $language, "mail" => $this->mail));
        }

        public function getPrefLangue(){
            /* FR, EN */
            return $this->prefLanguage;
        }

        public function getMail() {
            return $this->mailAdress;
        }

        public function disconnect(){
            session_destroy();
         }

        public function createSession(){
            session_start();
            $_SESSION['account'] = $this;
          }

         public static function addAccount() {

            $pseudo             = filter_input(INPUT_POST, 'pseudo');
            $mailAdress               = filter_input(INPUT_POST, 'mail');
            $pass               = filter_input(INPUT_POST, 'pass');
            $confirmPassword    = filter_input(INPUT_POST, 'confirmPassword');
            $language           = filter_input(INPUT_POST, 'langue');
            $grade              = filter_input(INPUT_POST, 'grade');
            $registerKey        = uniqid();

            if($confirmPassword != $pass){
                redirect('/?controller=user&action=register&match=1');
                exit;
            }
            else{
                $pdo = Database::getConnection();
                $stmt = $pdo->prepare("INSERT INTO users (pseudo, mail, pass, langue, grade, register_key) VALUES 
                (:myPseudo,  :myMail,  :myPass, :myLanguage, :myGrade, :myRegisterKey)");
                $stmt->execute(array(
                    "myPseudo"      => $pseudo,
                    "myMail"        => $mailAdress,
                    "myPass"        => $pass,
                    "myLanguage"    => $language,
                    "myGrade"       => $grade,
                    "myRegisterKey"   => $registerKey
                ));
                
                if($stmt) {
                    self::sendRegisterMail($mailAdress, $registerKey);
                   redirect("/?info=2");
                }
            }
        }

        public static function getUser($mailAdresse, $password){

            try{
                    
                $pdo = Database::getConnection();

                $query = $pdo->prepare("SELECT *, COUNT(*) count
                                                FROM users
                                                WHERE mail = :mail AND pass = :pass");

                $query->execute(array(
                    "mail" => $mailAdresse,
                    "pass" => $password
                ));

                $fetchedUser = $query->fetch();
            }
            catch (PDOException $e) {

                redirect("/controller=user&action=login&info=0");
                return;
            }
            return new User($fetchedUser["mail"], $fetchedUser["pseudo"], $fetchedUser["pass"], $fetchedUser["langue"], $fetchedUser["grade"]);

        }

        /**
         * @return mixed
         */
        public function getGrade()
        {
            return $this->grade;
        }

        /**
         * @return mixed
         */
        public function getMailAdress()
        {
            return $this->mailAdress;
        }

        /**
         * @return mixed
         */
        public function getPrefLanguage()
        {
            return $this->prefLanguage;
        }




    }
?>