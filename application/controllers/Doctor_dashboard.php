<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model');
        $this->load->model('MedicalRecord_model');
    }

    public function index() {
        $this->load->model('Dashboard_model');
        $this->load->model('MedicalRecord_model');
    
        // Ambil ID dokter dari sesi login
        $doctor_id = $this->session->userdata('user_id'); 
    
        $data['total_patients'] = $this->MedicalRecord_model->get_patient_count_by_doctor($doctor_id);
        $data['top_icd_codes'] = $this->Dashboard_model->get_top_icd_codes_by_doctor($doctor_id);
    
        $this->load->view('doctor/dashboard', $data);
    }
    
}
