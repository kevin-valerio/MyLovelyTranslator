<?php

require_once 'controllers/LanguageController.php';
require_once "utils/util.php";

function showAllWithView($requestedView)
{
    Controller::defineDefaultLanguage();

    $account = Controller::getMainUser();
    $langue = Controller::getLangueInAnyContext();

    $translator = new Translator($langue);
    session_start(); 
?>

    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8"/>
        <title>My Lovely Translator</title>

        <meta name="description" content="My Lovely Translator, spécialiste de la traduction, basé à Aix-en-Provence, France">
        <meta name="keywords" content="my lovely translator, traducteur, projet, groupe3, php, iut, aix">

        <link rel="icon" type="image/png" href="views/images/favicon.ico"/>

        <link rel="stylesheet" href="views/style/alert.css">
        <link rel="stylesheet" href="views/style/bootstrap.css">

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>

    </head>

    <body>
     <div class="container">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/">My Lovely Translator</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                </ul>

                <span class="navbar-text">
            <?php
            if (is_null($account)) {
                ?>

                <a href="/?controller=user&action=login" class="btn btn-primary btn-lg " role="button"
                   aria-pressed="true"><?php echo $translator->getTranslate(3); ?></a>
                <a href="/?controller=user&action=register" class="btn btn-primary btn-lg" role="button"
                   aria-pressed="true"><?php echo $translator->getTranslate(4); ?></a>

            <?php } else { ?>

                    <div class="btn-group">
                         <a href="/?controller=user&action=disconnect" class="btn btn-primary btn-lg" role="button"
                            aria-pressed="true"><?php echo $translator->getTranslate(1051); ?></a>

                    </div>
            </div>
            <?php } ?>
        </nav>
    </div>

    <div class="main-content">
        <?php
        require $requestedView;
        ?>
    </div>
    </body>


    <div style="text-align: center;">
        <footer>
            <p id="copyright"><?php echo $translator->getTranslate(1050); ?></p>
            <a id="mentions" href="/?controller=mentions&action=mentions">Mentions légales</a>

            <p class="w3">
                <a target="_blank"
                   href="https://validator.w3.org/nu/?doc=<?php echo getFullURL(); ?>">
                    <img src="/views/images/valid-html5.png" alt="Valid XHTML5">
                </a>
                <a target="_blank"
                   href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3&amp;usermedium=all&amp;warning=no&amp;vextwarning=true">
                    <img src="/views/images/valid-css3.png" alt="Valid CSS3">
                </a>
            </p>

            <form id="form-lang" action="/?controller=language&action=changeLanguage" method="post">
                <div id="choose-language">
                    <select name="lang" class="selectpicker"  onchange="this.form.submit()" onclick="this.form.submit()" >

                    <?php

                    
                    $languages = $translator->getLanguages();

                    foreach ($languages as $key => $value)
                         echo '<option  value="' . $key . '">' . $value . '</option>'

                    ?> 
                    </select>
                </div>
            </form>
        </footer>
    </html>
    <?php
}

?>