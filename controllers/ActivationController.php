<?php
require_once 'models/User.php';
require_once 'utils/util.php';
require_once 'views/core.php';
require_once 'controllers/Controler.php';


class ActivationController extends Controller {


    public function __construct(){
        parent::checkIfValidURL();
    }
    
    public function unlock() {
        $key  = filter_input(INPUT_GET, 'key');
        User::unlockAccountWithKey($key);
        redirect('/?info=4');

    }
}