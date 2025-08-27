<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Patient_model');
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }

    public function dashboard() {
        $this->load->view('admin/dashboard');
    }

    // Manajemen User
    public function users() {
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('admin/users', $data);
    }

    public function add_user() {
        $this->load->view('admin/add_user');
    }

    public function save_user() {
        $data = [
            'name' => $this->input->post('name'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'role' => $this->input->post('role')
        ];
        $this->User_model->insert_user($data);
        redirect('admin/users');
    }
    

    public function edit_user($id) {
        $data['user'] = $this->User_model->get_user_by_id($id);
        $this->load->view('admin/edit_user', $data);
    }

    public function update_user($id) {
        $data = [
            'name' => $this->input->post('name'),
            'username' => $this->input->post('username'),
            'role' => $this->input->post('role')
        ];
    
        if (!empty($this->input->post('password'))) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        }
    
        $this->User_model->update_user($id, $data);
        redirect('admin/users');
    }
    

    public function delete_user($id) {
        $this->User_model->delete_user($id);
        redirect('admin/users');
    }

    // Manajemen Pasien
    public function patients() {
        $this->load->model('Patient_model');
    
        $keyword = $this->input->get('search');
        if ($keyword) {
            $data['patients'] = $this->Patient_model->search_patient($keyword);
        } else {
            $data['patients'] = $this->Patient_model->get_recent_patients();
        }
    
        $this->load->view('admin/patients', $data);
    }
    
    
    public function add_patient() {
        // 1. Memuat library dan model yang dibutuhkan
        $this->load->library('form_validation');
        $this->load->model('Patient_model');

        // 2. Menetapkan aturan validasi untuk setiap input form
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric|is_unique[patients.nik]');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('birth', 'Date of Birth', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim|numeric');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('blood_type', 'Blood Type', 'required');
        $this->form_validation->set_rules('weight', 'Weight', 'required|numeric');
        $this->form_validation->set_rules('height', 'Height', 'required|numeric');
        
        // 3. Menjalankan validasi
        if ($this->form_validation->run() == FALSE) {
            // JIKA VALIDASI GAGAL (atau halaman baru pertama kali dibuka)
            // Tampilkan halaman form tambah pasien
            $data['next_rm'] = $this->Patient_model->generate_medical_record_number(); // Menggunakan fungsi generate dari model
            $this->load->view('admin/add_patient', $data);
        } else {
            // JIKA VALIDASI SUKSES (form telah disubmit dan semua data valid)
            // Lanjutkan proses penyimpanan data

            // Hitung umur secara otomatis dari tanggal lahir
            $birthDate = $this->input->post('birth');
            $birthDateObj = new DateTime($birthDate);
            $currentDateObj = new DateTime('today');
            $age = $birthDateObj->diff($currentDateObj)->y;

            // Siapkan array data untuk dimasukkan ke database
            $data = [
                'medical_record_number' => $this->input->post('medical_record_number'),
                'name'      => $this->input->post('name', true),
                'age'       => $age, // Gunakan umur yang sudah dihitung
                'gender'    => $this->input->post('gender', true),
                'birth'     => $this->input->post('birth', true),
                'nik'       => $this->input->post('nik', true),
                'phone'     => $this->input->post('phone', true),
                'address'   => $this->input->post('address', true),
                'blood_type'=> $this->input->post('blood_type', true),
                'weight'    => $this->input->post('weight', true),
                'height'    => $this->input->post('height', true),
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ];

            // Panggil model untuk menyimpan data
            $this->Patient_model->insert_patient($data);
            
            // Buat pesan sukses untuk ditampilkan di halaman berikutnya
            $this->session->set_flashdata('message', 'Pasien baru berhasil ditambahkan.');
            
            // Arahkan pengguna kembali ke halaman daftar pasien
            redirect('admin/patients');
        }
    }

    // HAPUS METHOD save_patient() DARI KODE ANDA
    // public function save_patient() { ... }
     
    // public function save_patient() {
    //     $this->load->model('Patient_model');
    
    //     $data = [
    //         'medical_record_number' => $this->input->post('medical_record_number'),
    //         'name' => $this->input->post('name'),
    //         'age' => $this->input->post('age'),
    //         'gender' => $this->input->post('gender'),
    //         'birth' => $this->input->post('birth'),
    //         'nik' => $this->input->post('nik'),
    //         'phone' => $this->input->post('phone'),
    //         'address' => $this->input->post('address'),
    //         'blood_type' => $this->input->post('blood_type'),
    //         'weight' => $this->input->post('weight'),
    //         'height' => $this->input->post('height'),
    //         'created_at' => date('Y-m-d H:i:s'), // Pastikan created_at terisi
    //         'updated_at' => date('Y-m-d H:i:s')
    //     ];
    
    //     $this->Patient_model->insert_patient($data);
    //     redirect('admin/dashboard'); // Arahkan kembali ke dashboard setelah registrasi
    // }
    
    
    public function edit_patient($id) {
        $this->load->model('Patient_model');
        $data['patient'] = $this->Patient_model->get_patient_by_id($id);
        $data['patient'] = $this->Patient_model->get_patient_by_id($id);
        $this->load->view('admin/edit_patient', $data);
    
        if (!$data['patient']) {
            show_404();
        }
    
        $this->load->view('admin/edit_patient', $data);
    }

    public function register_patient() {
        $this->load->model('Patient_model');
        $data['next_rm'] = $this->Patient_model->get_next_rm();
        $this->load->view('admin/register_patient', $data);
    }
    
    public function update_patient($id) {
        $this->load->model('Patient_model');
    
        $data = [
            'name' => $this->input->post('name'),
            'nik' => $this->input->post('nik'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'blood_type' => $this->input->post('blood_type'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
    
        $this->Patient_model->update_patient($id, $data);
        redirect('admin/patients');
    }
    public function search_patient() {
        $this->load->view('admin/search_patient');
    }
    
    public function find_patient() {
        $medical_record_number = $this->input->post('medical_record_number');
        $this->load->model('Patient_model');
        
        $patient = $this->Patient_model->get_patient_by_rm($medical_record_number);
        
        if ($patient) {
            $data['patient'] = $patient;
            $this->load->view('admin/confirm_patient', $data);
        } else {
            $this->session->set_flashdata('error', 'Pasien tidak ditemukan.');
            redirect('admin/search_patient');
        }
    }

    public function register_existing_patient() {
        $patient_id = $this->input->post('patient_id');
    
        $data = [
            'patient_id' => $patient_id,
            'doctor_id' => $this->session->userdata('user_id'),
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ];
    
        $this->db->insert('medical_records', $data);
        redirect('doctor/records');
    }
    

    public function get_patients_by_status($status) {
        $this->db->select('medical_records.*, patients.name AS patient_name, patients.medical_record_number');
        $this->db->from('medical_records');
        $this->db->join('patients', 'medical_records.patient_id = patients.id', 'left');
        $this->db->where('medical_records.status', $status);
        return $this->db->get()->result();
    }

    public function search_patient_by_rm() {
        $medical_record_number = $this->input->post('medical_record_number');
        $this->load->model('Patient_model');
        
        $patient = $this->Patient_model->get_patient_by_rm($medical_record_number);
        
        if ($patient) {
            echo json_encode($patient);
        } else {
            echo json_encode(['error' => 'Pasien tidak ditemukan.']);
        }
    }
    

    public function delete_patient($id) {
        $this->load->model('Patient_model');
    
        // Cek apakah pasien dengan ID tersebut ada
        $patient = $this->Patient_model->get_patient_by_id($id);
        if (!$patient) {
            $this->session->set_flashdata('error', 'Pasien tidak ditemukan.');
            redirect('admin/patients');
        }
    
        // Hapus pasien
        $this->Patient_model->delete_patient($id);
        $this->session->set_flashdata('success', 'Pasien berhasil dihapus.');
        redirect('admin/patients');
    }
    

    public function change_password() {
        $user_id = $this->session->userdata('user_id');
        $new_password = $this->input->post('new_password');
        
        $this->load->model('User_model');
        $this->User_model->update_password($user_id, $new_password);
    
        $this->session->set_flashdata('success', 'Password berhasil diperbarui!');
        redirect('admin/dashboard');
    }
   
}
