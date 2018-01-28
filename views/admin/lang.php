<center>
    <form action="/?controller=Gestion&action=addLanguage" method="post" class="form-horizontal">
        <fieldset>

            <legend><?php echo $translator->getTranslate(1108); ?></legend>
            <br>
            <br>
            <?php

            if ($_GET['info'] == '1') {
                Alerte::printAlert(Alerte::SUCCESS, 'La langue a bien été ajoutée, mais elle est néanmoins vide.');
            }

            ?>

            <br>
            <br>
            <div class="form-group">
                <label class="col-md-4 control-label"
                       for="textinput"><?php echo $translator->getTranslate(1126); ?></label>
                <div class="col-md-4">

                    <input id="textinput" name="langue" type="text"
                           placeholder="<?php echo $translator->getTranslate(1127); ?>" class="form-control input-md"
                           required="">
                </div>

                <label class="col-md-4 control-label" for="addLangue"></label>
                <div class="col-md-4">
                    <button id="addLangue" type="submit" name="addLangue"
                            class="btn btn-success"><?php echo $translator->getTranslate(1128); ?></button>
                </div>
            </div>


        </fieldset>
    </form>
</center>