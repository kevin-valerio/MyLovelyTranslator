<?php
/**
 * Created by PhpStorm.
 * User: Fallou
 * Date: 19/01/2018
 * Time: 11:36
 */

require_once 'utils/database.php';

class TranslationRequest
{
    private $id;
    private $expressionId;
    private $translation;
    private $translationLanguage;
    private $translator;
    private $state;

    public function __construct($id, $expressionId, $translation, $translationLanguage, $translator, $state)
    {
        $this->id = $id;
        $this->expressionId = $expressionId;
        $this->translation = $translation;
        $this->translationLanguage = $translationLanguage;
        $this->translator = $translator;
        $this->state = $state;
    }

    public function addRequest(){
        $pdo = Database::getConnection();

        $added = $pdo->prepare("INSERT INTO translation_request (expressionId, translation, translation_language, translator, state)
                                          VALUES (:expressionId, :translation, :tl, :translator, :state)");
        $added->execute(array(
           "expressionId" => $this->expressionId,
           "translation"  => $this->translation,
           "tl"           => $this->translationLanguage,
           "translator"   => $this->translator,
            "state"       => "waiting"
        ));

        return $added;
    }

    public static function getAll(){
        $pdo = Database::getConnection();

        $query = $pdo->prepare("SELECT * FROM translation_request WHERE state=:state");
        $query->execute(array(
            "state" => "waiting"
        ));

        if(empty($query)) return false;

        $requests = [];

        while($tuple = $query->fetch())
            array_push($requests, new TranslationRequest($tuple["id"], $tuple["expressionid"], $tuple["translation"], $tuple["translation_language"], $tuple["translator"], $tuple["state"]));

        return $requests;

    }

    public static function get($id){
        $pdo = Database::getConnection();

        $query = $pdo->prepare("SELECT * FROM translation_request WHERE id= :id");
        $query->execute(array(
            "id" => $id
        ));


        if(empty($query)) return false;

        $tuple = $query->fetch();

        return new TranslationRequest($tuple["id"], $tuple["expressionid"], $tuple["translation"], $tuple["translation_language"], $tuple["translator"], $tuple["state"]);

    }

    public function setState($state){

        if($state != "allowed" AND $state != "rejected")
            return null;

        $pdo = Database::getConnection();

        $query = $pdo->prepare("UPDATE translation_request
                                          SET state = :state 
                                          WHERE id= :id");
        $query->execute(array(
           "id" => $this->id,
           "state" => $state
        ));

        return $query == true;
    }

    public static function getByEmail($email){
        $pdo = Database::getConnection();

        $query = $pdo->prepare("SELECT * FROM translation_request WHERE translator= :email");
        $query->execute(array(
            "email" => $email
        ));


        if(empty($query)) return false;

        $requests = [];
        while($tuple = $query->fetch())
            array_push($requests,new TranslationRequest($tuple["id"], $tuple["expressionid"], $tuple["translation"], $tuple["translation_language"], $tuple["translator"], $tuple["state"]));

        return $requests;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getExpressionId()
    {
        return $this->expressionId;
    }

    /**
     * @return mixed
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * @return mixed
     */
    public function getTranslationLanguage()
    {
        return $this->translationLanguage;
    }

    /**
     * @return mixed
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }



}