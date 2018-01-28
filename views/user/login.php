<form action="/?controller=user&action=connectionTry" method="post">


    <div class="form-group">
        <label for="mail"><?php echo $translator->getTranslate(6); ?></label>
        <input type="text" class="form-control" name="mail"
               placeholder="Adresse mail">
    </div>
    <div class="form-group">
        <label for="password"><?php echo $translator->getTranslate(7); ?></label>
        <input type="password" name="pass" class="form-control" placeholder="Mot de passe">
    </div>
    <button type="submit" class="btn btn-primary"><?php echo $translator->getTranslate(3); ?></button>

    <a href="?controller=user&action=forgot"><?php echo $translator->getTranslate(8); ?></a>

    <?php


    $informationMsg = filter_input(INPUT_GET, 'info');
    if ($informationMsg == '0') {
        Alerte::printAlert(Alerte::WARNING, 'Les identifiants rentrés sont éronnés.');
    }
    if ($informationMsg == '3') {
        Alerte::printAlert(Alerte::INFO, 'Le compte n\'a pas encore été validé');
    }
    if ($informationMsg == '5') {
        Alerte::printAlert(Alerte::DANGER, "Une erreure liée à la base de donnée est survenue ! ");
    }


    ?>
</form>