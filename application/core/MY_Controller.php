<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $data = array();
    public $website;
    function __construct()
    {
        parent::__construct();
        $this->load->model('website_model');
        $this->website = $this->website_model->get();
        $this->data['website'] = $this->website;

        $this->data['page_title'] = $this->website->page_title;
        $this->data['page_description'] = 'CI_App';
        $this->data['before_closing_head'] = '';
        $this->data['before_closing_body'] = '';

        $this->load->model('banned_model');
        $ips = $this->banned_model->set_cache('banned_ips',3600)->get_all();
        $banned_ips = array();
        if(!empty($ips))
        {
            foreach($ips as $ip)
            {
                $banned_ips[] = $ip->ip;
            }
        }
        if(in_array($_SERVER['REMOTE_ADDR'],$banned_ips))
        {
            echo 'You are banned from this site.';
            exit;
        }
        if($this->website->status == '0') {
            if($this->router->class!=='user')
            {
                $this->load->library('ion_auth');
                if (!$this->ion_auth->is_admin()) {
                    redirect('offline', 'refresh', 503);
                }
            }
        }
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