<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function index()
	{
        $this->load->helper('form');
		$this->render('welcome/index_view');
	}
}
