<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('MedicalRecord_model');
        if ($this->session->userdata('role') !== 'doctor') {
            redirect('auth/login');
        }
    }

    public function dashboard() {
        $this->load->view('doctor/dashboard');
    }

    public function records() {
        $data['records'] = $this->MedicalRecord_model->get_all_records();
        $this->load->view('doctor/records', $data);
    }

    public function add_record() {
        $this->load->model('Patient_model');
        $data['patients'] = $this->Patient_model->get_all_patients(); // Ambil semua pasien
    
        $this->load->view('doctor/add_record', $data);
    }
    

    public function save_record() {
        $data = [
            'patient_id' => $this->input->post('patient_id'),
            'doctor_id' => $this->session->userdata('user_id'),
            'symptoms' => $this->input->post('symptoms'),
            'initial_diagnosis' => $this->input->post('initial_diagnosis'),
            'icd_code' => $this->input->post('icd_code'),
            'icd_description' => $this->input->post('icd_description')
        ];
        $this->MedicalRecord_model->insert_record($data);
        redirect('doctor/records');
    }
    public function edit_record($id = null) {
        if ($id === null) {
            show_404(); // Jika ID tidak diberikan, tampilkan halaman 404
        }
    
        $this->load->model('MedicalRecord_model');
        $data['record'] = $this->MedicalRecord_model->get_record_by_id($id);
    
        if (!$data['record']) {
            show_404(); // Jika rekam medis tidak ditemukan, tampilkan 404
        }
    
        $this->load->view('doctor/edit_record', $data);
    }
    

        public function delete_record($id) {
            $this->load->model('MedicalRecord_model');
    
        // Cek apakah rekam medis ada
        $record = $this->MedicalRecord_model->get_record_by_id($id);
        if (!$record) {
            show_404(); // Tampilkan error jika tidak ditemukan
        }
    
        // Hapus rekam medis
        $this->MedicalRecord_model->delete_record($id);
        $this->session->set_flashdata('success', 'Rekam medis berhasil dihapus.');
        redirect('doctor/records');
    }

        public function update_record($id) {
            $this->load->model('MedicalRecord_model');
    
        // Cek apakah rekam medis ada
        $record = $this->MedicalRecord_model->get_record_by_id($id);
        if (!$record) {
            show_404(); // Tampilkan error jika ID tidak ditemukan
        }
    
        // Ambil data dari form
        $data = [
            'symptoms' => $this->input->post('symptoms'),
            'initial_diagnosis' => $this->input->post('initial_diagnosis'),
            'icd_code' => $this->input->post('icd_code'),
            'icd_description' => $this->input->post('icd_description'),
            'status' => 'completed', // Tandai rekam medis sebagai "Sudah Dilayani"
            'updated_at' => date('Y-m-d H:i:s')
        ];
    
        // Update rekam medis di database
        $this->MedicalRecord_model->update_record($id, $data);
    
        // Redirect ke halaman daftar rekam medis dokter
        $this->session->set_flashdata('success', 'Rekam medis berhasil diperbarui.');
        redirect('doctor/records');
    }
    
    
    
    
}
