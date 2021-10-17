<?php

defined('BASEPATH') or exit('No direct script access allowed');

class user_model extends CI_Model
{

    public function getAllUser()
    {
        return $this->db->get('login')->result_array();
    }
    
    public function getUserById($username)
    {
        return $this->db->get_where('login', ['username' => $username])->row_array();
    }

    public function showUser($id)
    {
        return $this->db->get_where('login', array('username' => $id))->result();
    }

    public function registerUser()
    {
        $data = array(
            'nama' => $this->input->post('nama', true),
            'email' => $this->input->post('email', true),
            'username' => $this->input->post('username', true),
            'password' => md5($this->input->post('password', true)),
            'level' => 'customer',
        );
        $this->db->insert('login', $data);
    }

    public function getcustomer()
    {
        $this->db->select('count(level) cust');
        $this->db->where('level', 'customer');
        return $this->db->get('login')->result();

    }

    public function addUser() 
    {
        $data = array(
            'nama' => $this->input->post('nama', true),
            'email' => $this->input->post('email', true),
            'username' => $this->input->post('username', true),
            'password' => md5($this->input->post('password', true)),
            'level' => 'admin',
        );
        $this->db->insert('login', $data);
    }

    public function delete($id_user) {
        $this->db->where('username', $id_user);
        $this->db->delete('login');
    }
    
    public function update($id_user)
    {
        $data = [
            "username" => $this->input->post('username',true),
        ];
        // var_dump($data);
        // die();
        $this->db->where('username', $id_user);
        $this->db->update('login', $data);
    }
}

/* End of file user_model.php */
