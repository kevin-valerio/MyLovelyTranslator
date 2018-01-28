<?php

class Alerte
{

    const DANGER = 'DANGER';
    const WARNING = 'WARNING';
    const INFO = 'INFO';
    const SUCCESS = 'SUCCESS';


    static function printAlert($type, $content)
    {
        echo '
            <div class="row">
            <br><br>
            <div class="error-notice">';
        if ($type == DANGER) {
            echo "<div class='oaerror danger'><strong>Alert !</strong> " . $content . "</div>";
        } elseif ($type == WARNING) {
            echo '<div class="oaerror warning"><strong>Warning !</strong> ' . $content . '</div>';
        } elseif ($type == INFO) {
            echo '<div class="oaerror info"><strong>Information :</strong> ' . $content . '</div>';
        } elseif ($type == SUCCESS) {
            echo '<div class="oaerror success"><strong>Success !</strong> ' . $content . '</div>';
        }

        echo ' </div>  </div>    ';
    }
}

?>
       