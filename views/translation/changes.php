<?php

$translations = isset($_SESSION["phrases-changes"]) ? $_SESSION["phrases-changes"] : null;
?>

<form action="/?controller=gestion&action=changes&changed=yes" method="post">

    <div class="form-group">
        <h2><?php echo $translator->getTranslate(18); ?> ! </h2>
        <br>
        <p><?php echo $translator->getTranslate(1114); ?></p>

        <br>
        <label><?php echo $translator->getTranslate(1088); ?> :
            <select class="form-group" name="expressionID"><?
                for ($i = 0; $i < count($translations); ++$i) { ?>
                    <option value="<?php echo $translations[$i]->getId() ?>"> <?php echo $translations[$i]->
                        getExpression() ?>
                    </option>
                    ;
                <? } ?>
            </select>
        </label>
    </div>
    <div class="form-group">
        <label for="mail"><?php echo $translator->getTranslate(33) ?></label>
        <label><?php echo $translator->getTranslate(1064); ?> : </label><input type="text" class="form-control"
                                                                               name="translation"
                                                                               placeholder="<?php echo $translator->getTranslate(1084); ?>">
    </div>
    <div class="form-group">
        <label for="password"><?php echo $translator->getTranslate(1114); ?></label>

        <?php
        $languages = $translator->getLanguages();
        echo "<select class=\"form-group\" name=\"language\">";
        foreach ($languages as $key => $value) {
            echo "    <option value='$value'>$value</option> ";
        }
        echo "</select>";
        ?>

    </div>
    <button type="submit" class="btn btn-primary"><?php echo $translator->getTranslate(27) ?></button>

</form>

<?php


$informationMsg = filter_input(INPUT_GET, 'info');

if ($informationMsg == '50') {
    Alerte::printAlert(Alerte::DANGER, 'Les identifiants sont mal saisis, veuillez recommencer');
}
if ($informationMsg == '51') {
    Alerte::printAlert(Alerte::SUCCESS, "La traduction s'est déroulée avec succès ");
}

if ($informationMsg == '52') {
    Alerte::printAlert(Alerte::DANGER, "Erreur inconnue ");
}
?>

