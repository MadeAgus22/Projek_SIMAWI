<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function login() {
        $this->load->view('auth/login');
    }

    public function process_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
    
        $user = $this->User_model->check_login($username, $password);
    
        if ($user) {
            $this->session->set_userdata(['user_id' => $user->id, 'role' => $user->role]);
            if ($user->role == 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('doctor/dashboard');
            }
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah');
            redirect('auth/login');
        }
    }
    

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
