<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    // 1. Ambil jumlah total pasien
    public function get_total_patients() {
        return $this->db->count_all('patients');
    }

    // 2. Ambil 5 pasien terbaru berdasarkan tanggal pendaftaran
    public function get_recent_patients() {
        $this->db->select('name, medical_record_number, created_at');
        $this->db->from('patients');
        $this->db->order_by('created_at', 'DESC'); // Ambil data terbaru terlebih dahulu
        $this->db->limit(5);
        return $this->db->get()->result();
    }
    

    // 3. Ambil 5 kode ICD-10 yang paling banyak digunakan
    public function get_top_icd_codes() {
        $this->db->select('icd_code, MAX(icd_description) AS icd_description, COUNT(icd_code) as count');
        $this->db->from('medical_records');
        $this->db->where('icd_code IS NOT NULL');
        $this->db->group_by('icd_code');  // Gabungkan berdasarkan kode ICD
        $this->db->order_by('count', 'DESC');
        $this->db->limit(5);
        return $this->db->get()->result();
    }
    public function get_top_icd_codes_by_doctor($doctor_id) {
        $this->db->select('icd_code, MAX(icd_description) AS icd_description, COUNT(icd_code) as count');
        $this->db->from('medical_records');
        $this->db->where('doctor_id', $doctor_id);
        $this->db->where('icd_code IS NOT NULL');
        $this->db->group_by('icd_code');  // Gabungkan berdasarkan kode ICD
        $this->db->order_by('count', 'DESC');
        $this->db->limit(5);
        return $this->db->get()->result();
    }
    
    
    
    
}
