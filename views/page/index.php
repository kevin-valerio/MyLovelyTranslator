<?php
    $informationMsg = filter_input(INPUT_GET, 'info');
    if ($informationMsg == '2'){
        Alerte::printAlert(Alerte::SUCCESS, 'Votre compte a bien été crée ! <b>Un email vous sera envoyé afin de valider votre compte. </b>');
      }
      
      elseif($informationMsg == '1'){
        Alerte::printAlert(Alerte::SUCCESS, 'Vous avez été identifié ! Vous pouvez désormais naviguer dans le site entierement');
      }

      elseif($informationMsg == '3'){
        Alerte::printAlert(Alerte::WARNING, 'La clée entrée ne correspond à aucun compte existant !');
      }

      elseif($informationMsg == '4'){
        Alerte::printAlert(Alerte::SUCCESS, 'Le compte a été validé ! Vous pouvez vous connecter');
      }

    elseif($informationMsg == '5') {
        Alerte::printAlert(Alerte::SUCCESS, 'Votre demande a été soumise, un traducteur se chargera d\'accepter ou non votre demande');
    }



?>

<div class="body" id="corpsIndex"> <br><br>
    <h1>Bonjour

        <?php
            if(isset($_SESSION["account"])){
                 echo Controller::getMainUser()->getMail();
            }
            else echo " nouvel utilisateur  ! ";
        ?>
        </h1> <br><br>

        <p>

        Ac ne quis a nobis hoc ita dici forte miretur, quod alia quaedam in hoc facultas sit ingeni,
        neque haec dicendi ratio aut disciplina, ne nos quidem huic uni studio penitus umquam dediti fuimus.
        Etenim omnes artes, quae ad humanitatem pertinent, habent quoddam commune vinculum, et quasi cognatione quadam inter se continentur.
    <br><br>

        Exsistit autem hoc loco quaedam quaestio subdifficilis, num quando amici novi, digni amicitia, 
        veteribus sint anteponendi, ut equis vetulis teneros anteponere solemus. Indigna homine dubitatio!
        Non enim debent esse amicitiarum sicut aliarum rerum satietates; veterrima quaeque,
        ut ea vina, quae vetustatem ferunt, esse debet suavissima; verumque illud est, quod dicitur,
        multos modios salis simul edendos esse, ut amicitiae munus expletum sit.
        <br>
        <br>

        Post hoc impie perpetratum quod in aliis quoque iam timebatur,
        tamquam licentia crudelitati indulta per suspicionum nebulas aestimati
        quidam noxii damnabantur. quorum pars necati, alii puniti bonorum multatione actique laribus suis extorres nullo sibi relicto praeter querelas et lacrimas, stipe conlaticia victitabant, et civili iustoque imperio ad voluntatem converso cruentam, claudebantur opulentae domus et clarae.
        </p>
</div>