<?php
/**
 * Created by PhpStorm.
 * User: Fallou
 * Date: 19/01/2018
 * Time: 12:01
 */ ?>

<form action="/?controller=traduction&action=add" method="post">

    <div class="form-group">
        <select class="form-group" name="expressionId"><?
    while($tuple = $_SESSION["phrases"]->fetch()) {?>
            <option value="<?php echo $tuple["id"]?>"> <?php echo $tuple["expression"] ?> </option>;
    <? } ?>
        </select>
    </div>
 <div class="form-group">
    <label for="mail">Traduction</label>
     <input type="text" class="form-control" name="translation" placeholder="La phrase à traduire">
  </div>
  <div class="form-group">
    <label for="password">Langue</label>
    <select class="form-group" name="language">
        <option value="FR">Francais</option>
        <option value="EN">Anglais</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Effectuer demande de traduction</button>

</form>

<?php


$informationMsg = filter_input(INPUT_GET, 'info');

if($informationMsg == '7'){
    Alerte::printAlert(Alerte::INFO, 'Les identifiants sont mal saisis, veuillez recommencer');
}
if($informationMsg == '9'){
    Alerte::printAlert(Alerte::DANGER, "Une erreure liée à la base de donnée est survenue ! ");
}


?>