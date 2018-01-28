<?php
$requests = isset($_SESSION["comptes-user-list"]) ? $_SESSION["comptes-user-list"] : [];
?>
<br>

<!-- Cette page permet de lister tout les comptes du site afin de pouvoir les modifier-->
<center>
    <hr>
    <br>
    <form action="/?controller=Administration&action=editInfos" method="post">
        <h2><?php echo $translator->getTranslate(1061); ?></h2>
        <br>
        <label><?php echo $translator->getTranslate(1082); ?><?php echo $translator->getTranslate(1083); ?></label>
        <br>
        <select name="list-users">
            <?php
            foreach ($requests as $user) { ?>
                <option value="<?= $user["mail"] ?>"><?= $user["mail"]; ?> </option>
            <?php } ?>
        </select>
        <input type="submit" class="btn btn-primary" value="Valider"/>
    </form>
    <hr>
    <br>
</center>
