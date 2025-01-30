<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model');
    }

    public function index() {
        $this->load->model('Dashboard_model');
    
        $data['total_patients'] = $this->Dashboard_model->get_total_patients();
        $data['recent_patients'] = $this->Dashboard_model->get_recent_patients();
        $data['top_icd_codes'] = $this->Dashboard_model->get_top_icd_codes();
    
        $this->load->view('admin/dashboard', $data);
    }
    
}
