<?php

class IndexController
{

    function __construct()
    {
        parent::checkIfValidURL();
    }

    public static function index($alternativeWay = false)
    {
        if ($alternativeWay) {
            redirect('index.php');
        }
        else {
            showAllWithView('views/page/index.php');
        }
    }
}

?>