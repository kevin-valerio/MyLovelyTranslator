<!-- Formulaire inscription -->

<?php
        $passwordDontMatch = filter_input(INPUT_GET, 'match');
        if($passwordDontMatch == '1') Alerte::printAlert(Alerte::WARNING, ' Les mots de passes ne sont pas identiques');
 

?>
<br><br>
    <div id="main-content">
    <form action="?controller=user&action=addAccount" method="post">

        <!-- Email -->
        <div class="form-group">
            <input type="email" class="form-control" name="mail" aria-describedby="emailHelp"
                   placeholder="Mail">
        </div>

        <!-- Pseudo -->
        <div class="form-group">
            <input type="text" class="form-control" name="pseudo"  placeholder="Pseudo">
        </div>

        <!-- Mot de passe -->
        <div class="form-group">
            <input type="password" name="pass" class="form-control" placeholder="Mot de passe">
        </div>

        <!-- Mot de passe (vérification) -->
        <div class="form-group">
            <input type="password" name="confirmPassword" class="form-control" placeholder="Répéter le mot de passe">
        </div>


        <!-- Langue -->

        <?php

             
            $languages = Translator::getLanguages();
            foreach ( $languages as $key => $value ) echo '
                <div class="form-check">
                    <label>
                        <input type="radio" name="langue" checked value="' . $key . '"> <span class="label-text">' . $value . '</span>
                    </label>
                 </div>
            ';


        ?>


        <br><br>

        <!-- Privilege/Grade -->
        <div class="form-check">
            <label>
                <input type="radio" name="grade" checked value="1"> <span class="label-text">Standard</span>
            </label>
        </div>
        <div class="form-check">
            <label>
                <input type="radio" name="grade" value="2"> <span class="label-text">Premium</span>
            </label>
        </div>
        <div class="form-check">
            <label>
                <input type="radio" name="grade" value="3"> <span class="label-text">Traducteur</span>
            </label>
        </div>
        <div class="form-check">
            <label>
                <input type="radio" name="grade" value="4"> <span class="label-text">Administrateur</span>
            </label>
        </div>

        <!-- S'inscrire -->
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>

    </div>