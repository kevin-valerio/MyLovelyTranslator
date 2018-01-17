<?php
    require 'utils/util.php';
    require 'application.php';

    session_start();
    
    $mainApp = new Application();
    $mainApp->start();
    

?>