<?php

$requests = isset($_SESSION["my-requests"]) ? $_SESSION["my-requests"] : null;
?>

<div class="navbar-text">

    <h2><?php echo $translator->getTranslate(23); ?></h2>
    <br>
    <p><?php echo $translator->getTranslate(1116); ?></p>

    <table style="width: 1100px;">
        <tr>
            <td><strong><?php echo $translator->getTranslate(1056); ?></strong></td>
            <td><strong><?php echo $translator->getTranslate(1057); ?></strong></td>
            <td><strong><?php echo $translator->getTranslate(1058); ?></strong></strong></td>
            <td><strong><?php echo $translator->getTranslate(1059); ?></strong></td>
            <td><strong><?php echo $translator->getTranslate(1060); ?></strong></td>
        </tr>
        <?php for ($i = 0; $i < count($requests); ++$i) { ?>
            <tr>
                <td><?php echo $requests[$i]->getId() ?></td>
                <td><?php echo $translator->getTranslate($requests[$i]->getExpressionId()) ?></td>
                <td><?php echo $requests[$i]->getTranslation() ?></td>
                <td><?php echo $requests[$i]->getTranslationLanguage() ?></td>
                <td><?php echo $requests[$i]->getState() ?></td>
            </tr>

        <?php } ?>
    </table>
</div>

