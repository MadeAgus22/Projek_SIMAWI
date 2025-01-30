<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ICD_API extends CI_Controller {

    public function get_access_token() {
        $token_url = "https://icdaccessmanagement.who.int/connect/token";
        $client_id = "5a501539-f14b-4a43-9b93-d74cd45c0257_7812e92f-4eda-4965-bd19-44eaa810c07d";
        $client_secret = "0anj06XSSqxoYvdNyzg5S5ba0S/QhUeEgft0UG/qzcE=";
        $scope = "icdapi_access";
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $token_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'grant_type' => 'client_credentials',
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'scope' => $scope
        ]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/x-www-form-urlencoded"]);
        
        $response = curl_exec($ch);
        curl_close($ch);
    
        $token_data = json_decode($response, true);
        if (!isset($token_data['access_token'])) {
            echo json_encode(['error' => 'Gagal mendapatkan Access Token']);
            return;
        }
    
        // Simpan token dalam session
        $this->session->set_userdata('icd_access_token', $token_data['access_token']);
        $this->session->set_userdata('icd_token_expiry', time() + $token_data['expires_in']);
    
        echo json_encode(['success' => 'Access Token berhasil disimpan']);
    }
    

    public function search_icd() {
        $query = $this->input->get('query');
    
        if (strlen($query) < 2) {
            echo json_encode(['error' => 'Minimal 2 huruf untuk pencarian ICD-10.']);
            return;
        }
    
        // Pastikan Access Token tersedia dan belum kadaluwarsa
        if (!$this->session->userdata('icd_access_token') || time() > $this->session->userdata('icd_token_expiry')) {
            $this->get_access_token(); // Ambil token baru jika tidak ada atau kedaluwarsa
        }
    
        $access_token = $this->session->userdata('icd_access_token');
    
        // Gunakan endpoint pencarian ICD-10 yang benar
        $search_url = "https://id.who.int/icd/entity/{id}" . urlencode($query);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $search_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $access_token",
            "API-Version: v2",
            "Accept: application/json",
            "Accept-Language: en"
        ]);
        $search_response = curl_exec($ch);
        curl_close($ch);
    
        $search_data = json_decode($search_response, true);
        $results = [];
    
        if (isset($search_data['destinationEntities'])) {
            foreach ($search_data['destinationEntities'] as $entity) {
                $entity_id = $entity['id']; // ID entitas yang perlu kita akses untuk mendapatkan kode ICD
    
                // Ambil detail ICD-10 untuk mendapatkan kode ICD
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $entity_id);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Authorization: Bearer $access_token",
                    "API-Version: v2",
                    "Accept: application/json"
                ]);
                $entity_response = curl_exec($ch);
                curl_close($ch);
    
                $entity_data = json_decode($entity_response, true);
                $icd_code = isset($entity_data['theCode']) ? $entity_data['theCode'] : "No Code Available";
    
                // Simpan hasil pencarian ICD-10
                $results[] = [
                    'code' => $icd_code,
                    'description' => strip_tags($entity['title'])
                ];
            }
        }
    
        // Debugging: Tampilkan response dari WHO API
        header('Content-Type: application/json');
        echo json_encode($results);
    }
    
    
    
    
    
    
    
}
