<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
    }

    public function index()
    {
        if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('user/login');
        }
        redirect('dashboard');
    }

    public function login()
    {
        $this->data['title'] = "Login";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->helper('form');
            $this->render('user/login_view');
        }
        else
        {
            $this->ion_auth->set_hook('post_login_successful', 'get_gravatar_hash', $this, '_gravatar', array());
            $remember = (bool) $this->input->post('remember');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ($this->ion_auth->login($username, $password, $remember))
            {
                $this->load->library('rat');
                $this->rat->log('User logged in',1);
                redirect('dashboard');
            }
            else
            {
                $_SESSION['auth_message'] = $this->ion_auth->errors();
                $this->session->mark_as_flash('auth_message');
                redirect('user/login');
            }
        }
    }

    public function _gravatar()
    {
        if($this->form_validation->valid_email($_SESSION['email']))
        {
            $gravatar_url = md5(strtolower(trim($_SESSION['email'])));
            $_SESSION['gravatar'] = $gravatar_url;
        }
        return TRUE;
    }

    public function logout()
    {
        $this->load->library('rat');
        $this->rat->log('User logged out',1);
        $this->ion_auth->logout();
        redirect('user/login');
    }
}