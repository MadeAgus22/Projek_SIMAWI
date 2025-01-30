<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MedicalRecord_model extends CI_Model {
    
    public function get_all_records($status = NULL) {
        $this->db->select('medical_records.*, patients.medical_record_number, patients.name AS patient_name, users.name AS doctor_name');
        $this->db->from('medical_records');
        $this->db->join('patients', 'medical_records.patient_id = patients.id', 'left');
        $this->db->join('users', 'medical_records.doctor_id = users.id', 'left'); // Ambil nama dokter
    
        if ($status !== NULL) {
            $this->db->where('medical_records.status', $status);
        }
    
        return $this->db->get()->result();
    }
    
    

    public function get_record_by_id($id) {
        return $this->db->get_where('medical_records', ['id' => $id])->row();
    }
    

    public function insert_record($data) {
        return $this->db->insert('medical_records', $data);
    }

    public function update_record($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('medical_records', $data);
    }
    

    public function delete_record($id) {
        $this->db->where('id', $id);
        return $this->db->delete('medical_records');
    }

    public function get_patient_count_by_doctor($doctor_id) {
        $this->db->where('doctor_id', $doctor_id);
        return $this->db->count_all_results('medical_records');
    }
    

    
    
    
}
