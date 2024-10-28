<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nurse_model extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insertNurse($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('nurse', $data2);
    }

    function getNurse()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('nurse');
        return $query->result();
    }

    function getNurseById($id)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('nurse');
        return $query->row();
    }

    function getNurseByIonUserId($ion_user_id)
    {
        $this->db->where('ion_user_id', $ion_user_id);
        $query = $this->db->get('nurse');
        return $query->row();
    }

    function updateNurse($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('nurse', $data);
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('nurse');
    }

    function updateIonUser($username, $email, $password, $ion_user_id)
    {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }
    function getNurseInfo($searchTerm)
    {
        if (!empty($searchTerm)) {
            $query = $this->db->select('*')
                ->from('nurse')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $searchTerm . "%' OR name LIKE '%" . $searchTerm . "%')", NULL, FALSE)
                ->get();
            $users = $query->result_array();
        } else {
            $this->db->select('*');

            $this->db->where('hospital_id', $this->session->userdata('hospital_id'))->limit(10);
            $fetched_records = $this->db->get('nurse');
            $users = $fetched_records->result_array();
        }


        if ($this->ion_auth->in_group(array('nurse'))) {
            $nurse_ion_id = $this->ion_auth->get_user_id();
            $this->db->select('*');

            $this->db->where('ion_user_id', $nurse_ion_id)->where('hospital_id', $this->session->userdata('hospital_id'));
            $fetched_records = $this->db->get('nurse');
            $users = $fetched_records->result_array();
        }


        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ')');
        }
        return $data;
    }


    public function updateAvailability($nurse_id, $available)
    {
        $this->db->set('available', $available);
        $this->db->where('id', $nurse_id);
        return $this->db->update('nurse');
    }
}
