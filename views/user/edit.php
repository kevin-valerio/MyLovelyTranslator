<div class="container">
    <h1><?php echo $translator->getTranslate(34); ?></h1>
    <hr>

    <?php
    $informationMsg = filter_input(INPUT_GET, 'info');      // A CHANGER !
    if ($informationMsg == '1') {
        Alerte::printAlert(Alerte::SUCCESS, 'Vos informations ont bien été mises à jour !');
    }
    $user = $_SESSION['user-edit'];
    $action = $_SESSION['user-action'];
    ?>


    <h3><?php echo $translator->getTranslate(35); ?></h3>

    <form action="/?controller=user&action=editAccount<?= $action ?>" method="post">
        <input type="hidden" name="id" value="<?= $user->getMail() ?>"
        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $translator->getTranslate(10); ?></label>
            <div class="col-lg-8">
                <input name="pseudo" class="form-control" type="text" value="<?php echo $user->getUsername(); ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $translator->getTranslate(6); ?></label>
            <div class="col-lg-8">
                <input name="mail" disabled="disabled" class="form-control" type="text"
                       value="<?php echo $user->getMail(); ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label"><?php echo $translator->getTranslate(7); ?></label>
            <div class="col-md-8">
                <input name="password" class="form-control" type="password"
                       placeholder="<?php echo $translator->getTranslate(1090); ?>">
            </div>
        </div>


        <div class="form-group">
            <label class="col-lg-3 control-label"> <?php echo $translator->getTranslate(29); ?></label>
            <div id="choose-language">
                <input type="hidden" name="lang" id="hidden_language" value="English">
                <?php
                $languages = $translator->getLanguages();
                foreach ($languages as $key => $value)
                    echo '  <input type="button" class="btn btn-secondary btn-m" onclick="document.getElementById(\'hidden_language\').value = \'' . $key . '\';"  value="' . $value . '"></input> '
                ?>
            </div>
        </div>


        <div class="form-group">
            <label class="col-lg-3 control-label"> <?php echo $translator->getTranslate(30); ?></label>
            <div id="choose-language">

                <div class="form-check">
                    <label>
                        <input type="radio" name="grade" checked value="1"> <span
                                class="label-text"><?php echo $translator->getTranslate(12); ?></span>
                    </label>
                </div>
                <div class="form-check">
                    <label>
                        <input type="radio" name="grade" value="2"> <span
                                class="label-text"><?php echo $translator->getTranslate(13); ?></span>
                    </label>
                </div>
                <div class="form-check">
                    <label>
                        <input type="radio" name="grade" value="3"> <span
                                class="label-text"><?php echo $translator->getTranslate(14); ?></span>
                    </label>
                </div>
                <div class="form-check">
                    <label>
                        <input type="radio" name="grade" value="4"> <span class="label-text">Administrateur</span>
                    </label>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
                <input type="submit" class="btn btn-primary" value="<?php echo $translator->getTranslate(31); ?>">
                <span></span>
                <input type="reset" class="btn btn-default" value="<?php echo $translator->getTranslate(32); ?>">
            </div>
        </div>
    </form>
</div>
<hr>
 