<?php

require 'controllers/UserController.php';
require 'controllers/IndexController.php';
require 'controllers/MentionsController.php';
require 'controllers/ActivationController.php';
 
class Application { 
       

    function start(){

        $controllerLink = filter_input(INPUT_GET, 'controller');
        $functionLink   = filter_input(INPUT_GET, 'action');
        
         if (file_exists('controllers/' . ucfirst($controllerLink) . 'Controller.php')) {
            $mainController =  ucfirst($controllerLink) . 'Controller';
            $mainController = new $mainController();

            if (method_exists($mainController, $functionLink)) $mainController->$functionLink();
            else {
                IndexController::index();
            }
        }

        else {
            IndexController::index();

        }
    }
}