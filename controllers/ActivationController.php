<?php
require_once 'models/User.php';
require_once 'utils/util.php';
require_once 'views/core.php';
require_once 'controllers/Controler.php';


class ActivationController extends Controller
{
    public function __construct()
    {
        parent::checkIfValidURL();
    }

    /*
     * Permet de débloquer le compte associé à la clée passée en parametre GET
     */
    public function unlock()
    {
        $key = filter_input(INPUT_GET, 'key');
        User::unlockAccountWithKey($key);
        redirect('/?info=4');
    }
}