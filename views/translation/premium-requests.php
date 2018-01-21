<?php
/**
 * Created by PhpStorm.
 * User: Fallou
 * Date: 21/01/2018
 * Time: 12:30
 */
$requests = isset($_SESSION["my-requests"]) ? $_SESSION["my-requests"]: null;
?>

<div class="navbar-text">

    <table style="width: 1100px;">
        <tr>
            <td><strong>Identifiant</strong></td>
            <td><strong>Expression</strong></td>
            <td><strong>Traduction</strong></td>
            <td><strong>Langue de traduction</strong></td>
            <td><strong>Etat</strong></td>
            </tr>
        <?php for($i = 0; $i < count($requests); ++$i){ ?>
            <tr>
                <td><?php echo $requests[$i]->getId()?></td>
                <td><?php echo $translator->getTranslate($requests[$i]->getExpressionId())?></td>
                <td><?php echo $requests[$i]->getTranslation()?></td>
                <td><?php echo $requests[$i]->getTranslationLanguage()?></td>
                <td><?php echo $requests[$i]->getState()?></td>
            </tr>

        <?php } ?>
    </table>
</div>

