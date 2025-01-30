<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    public function test_user_model() {
        $this->load->model('User_model');
        $users = $this->User_model->get_all_users();
        echo "<pre>";
        print_r($users);
        echo "</pre>";
    }
    public function test_patient_model() {
        $this->load->model('Patient_model');
        $patients = $this->Patient_model->get_all_patients();
        echo "<pre>";
        print_r($patients);
        echo "</pre>";
    }

    public function test_medical_record_model() {
        $this->load->model('MedicalRecord_model');
        $records = $this->MedicalRecord_model->get_all_records();
        echo "<pre>";
        print_r($records);
        echo "</pre>";
    }
}

