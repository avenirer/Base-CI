<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $data = array();
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'CI App';
        $this->data['page_description'] = 'CI_App';
        $this->data['before_closing_head'] = '';
        $this->data['before_closing_body'] = '';
    }

    protected function render($the_view = NULL, $template = 'public_master')
    {
        if($template == 'json' || $this->input->is_ajax_request())
        {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        }
        elseif(is_null($template))
        {
            $this->load->view($the_view,$this->data);
        }
        else
        {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
            $this->load->view('templates/' . $template . '_view', $this->data);
        }
    }
}

class Auth_Controller extends MY_Controller {
    public $current_user;
    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('postal');
        if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('user/login');
        }
        $this->current_user = $this->ion_auth->user()->row();
    }
    protected function render($the_view = NULL, $template = 'auth_master')
    {
        parent::render($the_view, $template);
    }
}