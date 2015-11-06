<?php defined('BASEPATH') OR exit('No direct script access allowed');

class About extends Auth_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->render('dashboard/about/index_view');
	}
}