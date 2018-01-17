<?php

require_once 'controllers/Controler.php';
require_once 'views/core.php';

class MentionsController extends Controller
{

    function __construct(){
        parent::checkIfValidURL();

    }

    public function mentions()
    {
        showAllWithView('views/page/mentions.php');
    }


    public static function getMentionById($id){
   
        $pdo = Database::getConnection();
        $query = $pdo->prepare("SELECT expression FROM " . Controller::getLangueInAnyContext() . " WHERE id = :id");
        $query->execute(array("id" => $id));
        $fetchedMention = $query->fetch();

        return $fetchedMention["expression"];
    }

}

?>