<?php
$informationMsg = filter_input(INPUT_GET, 'info');
if ($informationMsg == '2') {
    Alerte::printAlert(Alerte::SUCCESS, 'Votre compte a bien été crée ! <b>Un email vous sera envoyé afin de valider votre compte. </b>');
} elseif ($informationMsg == '1') {
    Alerte::printAlert(Alerte::SUCCESS, 'Vous avez été identifié ! Vous pouvez désormais naviguer dans le site entierement');
} elseif ($informationMsg == '3') {
    Alerte::printAlert(Alerte::WARNING, 'La clée entrée ne correspond à aucun compte existant !');
} elseif ($informationMsg == '4') {
    Alerte::printAlert(Alerte::SUCCESS, 'Le compte a été validé ! Vous pouvez vous connecter');
} elseif ($informationMsg == '5') {
    Alerte::printAlert(Alerte::SUCCESS, 'Votre demande a été soumise, un traducteur se chargera d\'accepter ou non votre demande');
}

?>

<div class="body" id="corpsIndex"><br><br>
    <h1><?php echo $translator->getTranslate(1055); ?>

        <?php
        if (isset($_SESSION["account"])) {
            echo Controller::getMainUser()->getUsername();
        } else {
            echo " nouvel utilisateur  ! ";
        }
        ?>
    </h1> <br><br>

    <p>

        <?php echo $translator->getTranslate(1077); ?>
        <br><br>

        <?php echo $translator->getTranslate(1078); ?>
        <br><br>
        <?php echo $translator->getTranslate(1079); ?>
        <br>
        <?php echo $translator->getTranslate(1080); ?>
        <br><br>
        <?php echo $translator->getTranslate(1081); ?>
    </p>

    <?php
    Alerte::printAlert(Alerte::INFO, $translator->getTranslate(1118));
    ?>
</div>