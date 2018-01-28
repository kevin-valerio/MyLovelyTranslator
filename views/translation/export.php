<div id="export-text">
    <h2><?php echo $translator->getTranslate(1085); ?></h2>
    <p><?php echo $translator->getTranslate(1086); ?></p>
    <form action="/?controller=gestion&action=export" method="post">
        <div class="form-group">
            <br>
            <label for="sel1"><?php echo $translator->getTranslate(1087); ?></label>
            <select name="lang-dest" class="form-control" id="sel1">
                <?php
                $languages = $translator->getLanguages();
                foreach ($languages as $key => $value)
                    echo "<option>" . $value . "</option>";
                ?>
            </select>
            <br>
            <br>
            <input type="submit" class="btn btn-primary btn-lg" value="Export en .csv"/>

        </div>
    </form>
</div>