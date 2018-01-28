<?php
?>
<ul class="navbar-nav mr-auto">
</ul>

<div class="navbar-text">
    <h2><?php echo $translator->getTranslate(16); ?></h2>
    <br>
    <p><?php echo $translator->getTranslate(1117); ?></p>

    <br>
    <a href="/?controller=gestion&action=translationRequestsHandler" class="btn btn-primary btn-lg " role="button"
       aria-pressed="true"><?php echo $translator->getTranslate(17); ?></a>

    <a href="/?controller=gestion&action=changes" class="btn btn-primary btn-dark btn-lg" role="button"
       aria-pressed="true"><?php echo $translator->getTranslate(18); ?></a>

    <a href="/?controller=gestion&action=newTranslate" class="btn btn-primary btn-lg " role="button"
       aria-pressed="true"><?php echo $translator->getTranslate(19); ?></a>

    <a href="/?controller=gestion&action=exportTranslation" class="btn btn-primary btn-dark btn-lg " role="button"
       aria-pressed="true"><?php echo $translator->getTranslate(20); ?></a>
    <?php
    $user = Controller::getMainUser();
    if ($user->getGrade() == '4') {
        echo ' <a href="/?controller=gestion&action=language" class="btn btn-primary btn-lg " role="button"  aria-pressed="true">' . $translator->getTranslate(1108) . '</a>';
    }
    ?>

</div>