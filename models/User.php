<?php
require_once 'utils/database.php';

class User
{

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

    /*
     * Débloque le compte actuel si la clée est bonne
     */
    public static function unlockAccountWithKey($key)
    {

        try {
            $pdo = Database::getConnection();
            $query = $pdo->prepare("UPDATE users SET isActivated = '1' WHERE register_key = :register_key");
            $query->execute(array("register_key" => $key));
            redirect("/?info=3");

        } catch (PDOException $e) {
            redirect("/?info=4");
        }

    }

    /*
     * Détermine si le compte est débloqué ou pas
     */
    public function isAccountValidated()
    {

        try {
            $pdo = Database::getConnection();
            $query = $pdo->prepare("SELECT isActivated, COUNT(*) count FROM users WHERE mail = :mail");
            $query->execute(array("mail" => $this->mailAdress));
            $fetchedUser = $query->fetch();

            return $fetchedUser["isActivated"];
        } catch (PDOException $e) {
            redirect("/?controller=user&action=login&info=5");
            return 2;
        }

    }

    /*
     * Définit le compte actuel comme validé
     */
    public function setAccountValidated()
    {

        $pdo = Database::getConnection();
        $query = $pdo->prepare("UPDATE users SET isActivated = '1' WHERE mail = :mail");
        $query->execute(array("mail" => $this->mail));

    }

    /*
     * Envoie un mail d'enregistrement à la personne
     */
    public function sendRegisterMail($to, $key)
    {

        $link = WEBSITE_URL . "/?controller=activation&action=unlock&key=" . $key;

        $subject = "My Lovely Translator - Activation de compte";
        $message = "<html><body>Bonjour" . $username . ". <br><br><p>Voici le lien qui vous permettra de valider votre compte :
            </p><br><a href=\"" . $link . "\">" . $link . "</a></body></html>";
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        mail($to, $subject, $message, $headers);
    }

    /*
     * Permet de changer le pseudo
     */
    public function setPseudo($pseudo)
    {

        $this->username = $pseudo;
        $pdo = Database::getConnection();

        $sql = "UPDATE users SET pseudo = :pseudo    WHERE mail = :mail";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mail', $this->mailAdress, PDO::PARAM_STR);
        $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $stmt->execute();

    }

    /*
     * Permet de changer l'adresse mail
     */
    public function setMail($mail)
    {

        $this->mailAdress = $mail;
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("UPDATE users SET mail = :mail WHERE pseudo = :pseudo AND pass = :pass");

        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindParam(':pseudo', $this->$pseudo, PDO::PARAM_STR);
        $stmt->execute();
    }


    /*
     * Permet de changer le mot de passe
     */
    public function setPassword($password)
    {

        $this->password = $password;
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("UPDATE users SET pass = :pass WHERE mail = :mail");
        $stmt->bindParam(':mail', $this->mailAdress, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $password, PDO::PARAM_STR);
        $stmt->execute();
    }


    /*
     * Permet de changer le grade
     */
    public function setGrade($grade)
    {

        $this->grade = $grade;
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("UPDATE users SET grade = :grade WHERE mail = :mail");
        $stmt->bindParam(':mail', $this->mailAdress, PDO::PARAM_STR);
        $stmt->bindParam(':grade', $grade, PDO::PARAM_STR);
        $stmt->execute();
    }



    /*
     * Permet de changer la langue préférée
     */
    public function setPrefLanguage($language)
    {

        $this->prefLanguage = $language;
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("UPDATE users SET langue = \"" . $language . "\" WHERE mail = \"" . $this->mailAdress . "\"");

        $stmt->execute();

    }

    public function getGrade()
    {
        return $this->grade;
    }

    public function getMail()
    {
        return $this->mailAdress;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPrefLanguage()
    {
        return $this->prefLanguage;
    }

    /*
     * Déconnecte l'utilisateur
     */
    public function disconnect()
    {
        session_destroy();
    }


    /*
     * Crée la sessipon associée au compte
     */
    public function createSession()
    {
        session_start();
        $_SESSION['account'] = $this;
    }


    /*
     * Ajout un compte dans la base de donnée avec les bons parametres
     */
    public static function addAccount()
    {

        $pseudo = filter_input(INPUT_POST, 'pseudo');
        $mailAdress = filter_input(INPUT_POST, 'mail');
        $pass = filter_input(INPUT_POST, 'pass');
        $confirmPassword = filter_input(INPUT_POST, 'confirmPassword');
        $language = filter_input(INPUT_POST, 'langue');
        /* PLUS POSSIBLE
        $grade              = filter_input(INPUT_POST, 'grade'); */
        $registerKey = uniqid();

        if ($confirmPassword != $pass) {
            redirect('/?controller=user&action=register&match=1');
            exit;
        } else {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("INSERT INTO users (pseudo, mail, pass, langue/*, grade*/, register_key) VALUES 
                (:myPseudo,  :myMail,  :myPass, :myLanguage, :myRegisterKey)");
            $stmt->execute(array(
                "myPseudo" => $pseudo,
                "myMail" => $mailAdress,
                "myPass" => $pass,
                "myLanguage" => $language,
                "myRegisterKey" => $registerKey
            ));

            if ($stmt) {
                self::sendRegisterMail($mailAdress, $registerKey);
                redirect("/?info=2");
            }
        }
    }


    /*
     * Return l'objet User associé au $mailAdresse et $password associé
     */
    public static function getUser($mailAdresse, $password)
    {

        try {

            $pdo = Database::getConnection();

            $query = $pdo->prepare("SELECT *, COUNT(*) count
                                                FROM users
                                                WHERE mail = :mail AND pass = :pass");

            $query->execute(array(
                "mail" => $mailAdresse,
                "pass" => $password
            ));

            $fetchedUser = $query->fetch();
        } catch (PDOException $e) {

            redirect("/controller=user&action=login&info=0");
            return;
        }
        return new User($fetchedUser["mail"], $fetchedUser["pseudo"], $fetchedUser["pass"], $fetchedUser["langue"], $fetchedUser["grade"]);

    }


    /*
     * Retourne la derniere visite de l'utilisateur
     */
    public function getLastVisit()
    {
        $pdo = Database::getConnection();
        $query = $pdo->prepare("SELECT lastVisit FROM Visite WHERE ipUser = :ip");
        $query->execute(array(ip => getIPAdress()));
        $fetchedMention = $query->fetch();
        if (!$fetchedMention) {
            $query = $pdo->prepare("INSERT INTO Visite VALUES (:visit , :ip)");
            $query->bindParam(':visit', date('Y-m-d H:i:s', getTime()), PDO::PARAM_INT);
            $query->bindParam(':ip', getIPAdress(), PDO::PARAM_STR);
            $query->execute();
        }
        $timeNow = time();
        $lastVisit = $fetchedMention['lastVisit'];
        $timeLastVisit = strtotime($lastVisit);
        $leftTime = abs($timeNow - $timeLastVisit);
        return $leftTime;
    }


    /*
     * Retourne l'utilisateur (l'objet) associé à l'adresse mail
     */
    public static function getUserByMail($mail)
    {

        try {

            $pdo = Database::getConnection();

            $query = $pdo->prepare("SELECT * FROM users WHERE mail=:mail");

            $query->execute(array(
                "mail" => $mail
            ));

            $fetchedUser = $query->fetch();
        } catch (PDOException $e) {

            redirect("/controller=user&action=login&info=0");       // PAS ICI
            return;
        }
        return new User($fetchedUser["mail"], $fetchedUser["pseudo"], $fetchedUser["pass"], $fetchedUser["langue"], $fetchedUser["grade"]);
    }


}

?>