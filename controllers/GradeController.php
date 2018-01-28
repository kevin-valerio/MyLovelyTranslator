<?php
require_once 'controllers/Controler.php';

class GradeController extends Controller
{
    private static $gradeArray = array("1" => "Standard", "2" => "Premium", "3" => "Traducteur", "4" => "Administrateur");

    function __construct()
    {
        parent::checkIfValidURL();
    }

    public function getLanguages()
    {
        return $this->gradeArray;
    }
}