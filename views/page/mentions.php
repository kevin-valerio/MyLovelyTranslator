<?php
    require_once 'controllers/MentionsController.php';

    for ($id = 1000; $id <= 1045; $id++) {
        echo  MentionsController::getMentionById($id);
        echo '<br>';
    }

?>