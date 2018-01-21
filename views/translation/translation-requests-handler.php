<?php
/**
 * Created by PhpStorm.
 * User: Fallou
 * Date: 20/01/2018
 * Time: 13:55
 */
$requests = isset($_SESSION["all-requests"]) ? $_SESSION["all-requests"]: null;
?>

<div class="navbar-text">

    <table style="width: 1100px;">
        <tr>
            <td><strong>Identifiant</strong></td>
            <td><strong>Expression</strong></td>
            <td><strong>Traduction</strong></td>
            <td><strong>Langue de traduction</strong></td>
            <td><strong>Traducteur</strong></td>
            <td><strong>Action</strong></td>
        </tr>
<?php for($i = 0; $i < count($requests); ++$i){ ?>
        <tr>
            <td><?php echo $requests[$i]->getId()?></td>
            <td><?php echo $translator->getTranslate($requests[$i]->getExpressionId())?></td>
            <td><?php echo $requests[$i]->getTranslation()?></td>
            <td><?php echo $requests[$i]->getTranslationLanguage()?></td>
            <td><?php echo $requests[$i]->getTranslator()?></td>
            <td>
                <a href="/?controller=gestion&action=translationRequestsHandler&transID=<?php echo $requests[$i]->getId()?>&authorize=true" class="btn btn-primary btn-lg " role="button"
                   aria-pressed="true"><?php echo $translator->getTranslate(21); ?></a>

                <a href="/?controller=gestion&action=translationRequestsHandler&transID=<?php echo $requests[$i]->getId()?>&authorize=false" class="btn btn-primary btn-lg " role="button"
                   aria-pressed="true"><?php echo $translator->getTranslate(22); ?></a>
            </td>
        </tr>

    <?php } ?>
    </table>
</div>

