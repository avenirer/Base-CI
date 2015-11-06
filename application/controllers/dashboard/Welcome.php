<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Auth_Controller
{

    public function index()
    {
        /*
        echo '<pre>';
        print_r($_SESSION);
        echo '</pre>';*/
        $this->render('dashboard/welcome/index_view');
    }
}