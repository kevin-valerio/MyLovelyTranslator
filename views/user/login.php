<form action="/?controller=user&action=connectionTry" method="post">


 <div class="form-group">
    <label for="mail">Adresse mail</label>
    <input type="text" class="form-control" name="mail"
    placeholder="Adresse mail">
  </div>
  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" name="pass" class="form-control" placeholder="Mot de passe">
  </div>
  <button type="submit" class="btn btn-primary">S'identifier</button>

    <a href="?controller=user&action=forgot">Mot de passe oublié ?</a>

    <?php


    $informationMsg = filter_input(INPUT_GET, 'info');
    if($informationMsg == '0'){
        Alerte::printAlert(Alerte::WARNING, 'Les identifiants rentrés sont éronnés.');
    }
    if($informationMsg == '3'){
      Alerte::printAlert(Alerte::INFO, 'Le compte n\'a pas encore été validé');
     } 
    if($informationMsg == '5'){
      Alerte::printAlert(Alerte::DANGER, "Une erreure liée à la base de donnée est survenue ! ");
    } 
     

    ?>
</form>