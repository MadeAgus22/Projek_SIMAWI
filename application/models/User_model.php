<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    public function get_all_users() {
        return $this->db->get('users')->result();
    }

    public function get_user_by_id($id) {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function check_login($username, $password) {
        $this->db->where('username', $username);
        $user = $this->db->get('users')->row();
    
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }

    public function get_users_not_in_patients() {
        $this->db->select('users.id, users.username, users.name');
        $this->db->from('users');
        $this->db->join('patients', 'users.id = patients.user_id', 'left');
        $this->db->where('patients.user_id IS NULL'); // Cari user yang belum menjadi pasien
        return $this->db->get()->result();
    }
    
    
    

    public function insert_user($data) {
        return $this->db->insert('users', [
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
            'role' => $data['role'],
        ]);
    }
    

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete_user($id) {
        return $this->db->delete('users', ['id' => $id]);
    }
}
