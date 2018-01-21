<form id="form-lang" action="/?controller=user&action=editAccount" method="post">

    <div class="container">
        <h1><?php echo $translator->getTranslate(34); ?></h1>
        <hr>
        <div class="row">
    
        <div class="col-md-9 personal-info">
        
            <h3>Personal info</h3>
            
            <form class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $translator->getTranslate(10); ?></label>
                <div class="col-lg-8">
                <input class="form-control" type="text" value="Random_Pseudo01">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $translator->getTranslate(6); ?></label>
                <div class="col-lg-8">
                <input class="form-control" type="text" value="mail@serveur.com">
                </div>
            </div>
        
            <div class="form-group">
                <label class="col-md-3 control-label"><?php echo $translator->getTranslate(7); ?></label>
                <div class="col-md-8">
                <input class="form-control" type="password" value="dontwatchthis,useless">
                </div>
            </div>

        
            <div class="form-group">
                <label class="col-lg-3 control-label"> <?php echo $translator->getTranslate(29); ?></label>            
                <div id="choose-language">
                        <input type="hidden" name="lang" id="hidden-language" value="English">
                        <?php
                        $languages = $translator->getLanguages();
                        foreach ($languages as $key => $value)
                            echo '  <input type="button" class="btn btn-secondary btn-m" onclick="document.getElementById(\'hidden-language\').value = \'' . $key . '\';"  value="' . $value . '"></input> '
                        ?>                  
                    </div>
            </div>

            
            <div class="form-group">
                <label class="col-lg-3 control-label"> <?php echo $translator->getTranslate(29); ?></label>            
                <div id="choose-language">
                        <input type="hidden" name="lang" id="hidden-grade" value="1">

                                <div class="form-check">
                                    <label>
                                        <input type="radio" name="grade" onclick="document.getElementById(\'hidden-grade\').value='1';"  name="grade" checked value="1"> <span class="label-text"><?php echo $translator->getTranslate(12); ?></span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label>
                                        <input type="radio" name="grade" onclick="document.getElementById(\'hidden-language\').value='2';"  name="grade" value="2"> <span class="label-text"><?php echo $translator->getTranslate(13); ?></span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label>
                                        <input type="radio" name="grade" onclick="document.getElementById(\'hidden-language\').value='3';"  value="3"> <span class="label-text"><?php echo $translator->getTranslate(14); ?></span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label>
                                        <input type="radio"  name="grade"  onclick="document.getElementById(\'hidden-language\').value='4';" name="grade" value="4"> <span class="label-text">Administrateur</span>
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
    </div>
    </div>
    <hr>
</form>