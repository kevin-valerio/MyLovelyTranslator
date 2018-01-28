<?php

$requests = isset($_SESSION["all-requests"]) ? $_SESSION["all-requests"] : null;
?>

<div class="navbar-text">

    <h2><?php echo $translator->getTranslate(17); ?> ! </h2>
    <br>
    <p><?php echo $translator->getTranslate(1115); ?></p>

    <br>

    <table style="width: 1100px;">
        <tr>
            <td><strong><?php echo $translator->getTranslate(1056); ?></strong></td>
            <td><strong><?php echo $translator->getTranslate(1057); ?></strong></td>
            <td><strong><?php echo $translator->getTranslate(1058); ?></strong></td>
            <td><strong><?php echo $translator->getTranslate(1059); ?></strong></td>
            <td><strong><?php echo $translator->getTranslate(6); ?></strong></td>
            <td><strong><?php echo $translator->getTranslate(1063); ?></strong></td>
        </tr>
        <?php for ($i = 0; $i < count($requests); ++$i) { ?>
            <tr>
                <td><?php echo $requests[$i]->getId() ?></td>
                <td><?php echo $translator->getTranslate($requests[$i]->getExpressionId()) ?></td>
                <td><?php echo $requests[$i]->getTranslation() ?></td>
                <td><?php echo $requests[$i]->getTranslationLanguage() ?></td>
                <td><?php echo $requests[$i]->getTranslator() ?></td>
                <td>
                    <a href="/?controller=gestion&action=translationRequestsHandler&transID=<?php echo $requests[$i]->getId() ?>&authorize=true"
                       class="btn btn-primary btn-lg " role="button"
                       aria-pressed="true"><?php echo $translator->getTranslate(21); ?></a>

                    <a href="/?controller=gestion&action=translationRequestsHandler&transID=<?php echo $requests[$i]->getId() ?>&authorize=false"
                       class="btn btn-primary btn-lg " role="button"
                       aria-pressed="true"><?php echo $translator->getTranslate(22); ?></a>
                </td>
            </tr>

        <?php } ?>
    </table>
</div>

