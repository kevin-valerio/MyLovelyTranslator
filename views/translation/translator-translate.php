<?php

?>

<form action="/?controller=gestion&action=newTranslate&changed=yes" method="post">

    <div class="form-group">
    </div>
    <div class="form-group">
        <h2><?php echo $translator->getTranslate(1109); ?> ! </h2>
        <br>
        <p><?php echo $translator->getTranslate(1110); ?></p>

        <br>
        <label><?php echo $translator->getTranslate(1066); ?> : </label>
        <select class="form-group" name="language-s">
            <?php

            $languages = $translator->getLanguages();
            foreach ($languages as $key => $value) {
                echo "   <option value='$value'>$value</option> ";
            }

            ?>
        </select>
        <input type="text" class="form-control" name="translation-s"
               placeholder="<?php echo $translator->getTranslate(1111); ?>">

        <br><br>

        <label><?php echo $translator->getTranslate(1067); ?> : </label>
        <select class="form-group" name="language-d">
            <?php

            $languages = $translator->getLanguages();
            foreach ($languages as $key => $value) {
                echo "   <option value='$value'>$value</option> ";
            }

            ?>
        </select>
        <input type="text" class="form-control" name="translation-d"
               placeholder="<?php echo $translator->getTranslate(1112); ?>">


    </div>

    <button type="submit" class="btn btn-primary btn-dark "><?php echo $translator->getTranslate(1113); ?></button>

</form>

<?php


$informationMsg = filter_input(INPUT_GET, 'info');

if ($informationMsg == '53') {
    Alerte::printAlert(Alerte::DANGER, 'Les identifiants sont mal saisis, veuillez recommencer');
}
if ($informationMsg == '54') {
    Alerte::printAlert(Alerte::SUCCESS, "La traduction s'est déroulée avec succès ");
}
if ($informationMsg == '55') {
    Alerte::printAlert(Alerte::DANGER, "Erreur inconnue ");
}
?>



