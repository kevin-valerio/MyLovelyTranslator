<?php

$translations = isset($_SESSION["phrases"]) ? $_SESSION["phrases"] : null;
?>

    <form action="/?controller=traduction&action=add" method="post">

        <h2><?php echo $translator->getTranslate(15); ?></h2>
        <br>
        <p><?php echo $translator->getTranslate(1110); ?></p>

        <br>

        <div class="form-group">
            <?php echo $translator->getTranslate(1119); ?>
            <?php echo '</br>' ?>

            <?php
            $languages = $translator->getLanguages();
            echo "<select class=\"form-group\" name=\"languageSource\">";
            foreach ($languages as $key => $value) {
                echo "    <option value='$value'>$value</option> ";
            }
            echo "</select>";
            ?>

            <?php echo '</br>' ?>
            <input type="text" class="form-control" name="searchSentence"
                   placeholder="<?php echo $translator->getTranslate(1121); ?>">
            <?php echo '</br>' ?>
            <?php echo $translator->getTranslate(1120); ?>
            <?php echo '</br>' ?>

            <?php
            $languages = $translator->getLanguages();
            echo "<select class=\"form-group\" name=\"languageDest\">";
            foreach ($languages as $key => $value) {
                echo "    <option value='$value'>$value</option> ";
            }
            echo "</select>";
            ?>

            <?php echo '</br>' ?>
            <input type="text" class="form-control" name="translateSentence"
                   placeholder="<?php echo $translator->getTranslate(1122); ?>">
            <?php echo '</br>' ?>
            <button type="submit" class="btn btn-primary"><?php echo $translator->getTranslate(1062); ?></button>
        </div>

    </form>

<?php
$informationMsg = filter_input(INPUT_GET, 'info');

if ($informationMsg == '50') {
    Alerte::printAlert(Alerte::DANGER, 'Merci de saisir les données demandées');
}

if ($informationMsg == '51') {
    Alerte::printAlert(Alerte::SUCCESS, 'Merci de votre demande, elle sera bientôt traitée');
}
if ($informationMsg == '52') {
    Alerte::printAlert(Alerte::DANGER, "Erreur inconnue");
}

if ($informationMsg == '53') {
    Alerte::printAlert(Alerte::DANGER, "Cette expresssion n'a pas été trouvée dans la base");
}

?>