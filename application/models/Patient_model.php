<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_Model {
    
    public function get_all_patients() {
        $this->db->select('patients.*, patients.medical_record_number, patients.name AS full_name');
        $this->db->from('patients');
        return $this->db->get()->result();
    }
    
    

    public function get_patient_by_id($id) {
        return $this->db->get_where('patients', ['id' => $id])->row();
    }
    

    public function insert_patient($data) {
        return $this->db->insert('patients', $data);
    }    

    public function update_patient($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('patients', $data);
    }    

    public function delete_patient($id) {
        $this->db->where('id', $id);
        $this->db->delete('patients');
    }
    

    public function get_last_nrm() {
        $this->db->select('medical_record_number');
        $this->db->from('patients');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row()->medical_record_number;
        } else {
            return null;
        }
    }
    
    public function get_next_rm() {
        $this->db->select('MAX(CAST(SUBSTRING(medical_record_number, 3, LENGTH(medical_record_number)) AS UNSIGNED)) AS last_rm');
        $query = $this->db->get('patients')->row();
    
        if ($query->last_rm) {
            return 'RM' . str_pad($query->last_rm + 1, 4, '0', STR_PAD_LEFT);
        } else {
            return 'RM0001'; // Jika belum ada pasien, mulai dari RM0001
        }
    }

    public function get_patient_by_rm($medical_record_number) {
        return $this->db->get_where('patients', ['medical_record_number' => $medical_record_number])->row();
    }

    public function get_recent_patients() {
        $this->db->select('*');
        $this->db->from('patients');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(5);
        return $this->db->get()->result();
    }
    
    public function search_patient($keyword) {
        $this->db->select('*');
        $this->db->from('patients');
        $this->db->like('medical_record_number', $keyword);
        $this->db->or_like('name', $keyword);
        return $this->db->get()->result();
    }
    
    
    
    
    
    

    
}
