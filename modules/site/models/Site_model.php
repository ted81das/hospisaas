<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site_model extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insertAppointment($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('site_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('appointment', $data2);
    }

    function getAppointment()
    {
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentBySearch($search)
    {
        $this->db->order_by('id', 'desc');
        $this->db->like('id', $search);
        $this->db->or_like('name', $search);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByLimit($limit, $start)
    {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByLimitBySearch($limit, $start, $search)
    {

        $this->db->like('id', $search);

        $this->db->order_by('id', 'desc');

        $this->db->or_like('name', $search);
        $this->db->or_like('phone', $search);
        $this->db->or_like('address', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentForCalendar()
    {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByDoctor($doctor)
    {
        $this->db->where('doctor', $doctor);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByPatient($patient)
    {
        $this->db->where('patient', $patient);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('appointment');
        return $query->row();
    }

    function getAppointmentByDate($date_from, $date_to)
    {
        $this->db->select('*');
        $this->db->from('appointment');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function updateAppointment($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('appointment', $data);
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('appointment');
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


    function addSettings($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('site_settings', $data2);
    }

    function getSettings()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('site_settings');
        return $query->row();
    }

    function getSettingsBySiteId($id)
    {
        $this->db->where('hospital_id', $id);
        $query = $this->db->get('site_settings');
        return $query->row();
    }
 
    function updateSettings($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('site_settings', $data);
    }

    function getAvailableSlotByDoctorByDate($date, $doctor)
    {

        $weekday = date("l", $date);

        $this->db->where('date', $date);
        $this->db->where('doctor', $doctor);
        $holiday = $this->db->get('holidays')->result();

        if (empty($holiday)) {
            $this->db->where('date', $date);
            $this->db->where('doctor', $doctor);
            $query = $this->db->get('appointment')->result();


            $this->db->where('doctor', $doctor);
            $this->db->where('weekday', $weekday);
            $this->db->order_by('s_time_key', 'asc');
            $query1 = $this->db->get('time_slot')->result();

            $availabletimeSlot = array();
            $bookedTimeSlot = array();

            foreach ($query1 as $timeslot) {
                $availabletimeSlot[] = $timeslot->s_time . ' To ' . $timeslot->e_time;
            }
            foreach ($query as $bookedTime) {
                if ($bookedTime->status != 'Cancelled') {
                    $bookedTimeSlot[] = $bookedTime->time_slot;
                }
            }

            $availableSlot = array_diff($availabletimeSlot, $bookedTimeSlot);
        } else {
            $availableSlot = array();
        }

        return $availableSlot;
    }


    function getDoctor()
    {
        $this->db->where('hospital_id', $this->session->userdata('site_id'));
        $query = $this->db->get('doctor');
        return $query->result();
    }

    function getDoctorVisitByDoctorId($id)
    {
        $this->db->where('doctor_id', $id);
        $this->db->where('hospital_id', $this->session->userdata('site_id'));
        $query = $this->db->get('doctor_visit');
        return $query->result();
    }

    function getDoctorvisitById($id)
    {
        $this->db->where('hospital_id', $this->session->userdata('site_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('doctor_visit');
        return $query->row();
    }

    function insertPatient($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('site_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('patient', $data2);
    }

    function updatePatient($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('patient', $data);
    }

    function getPatientById($id)
    {
        $this->db->where('hospital_id', $this->session->userdata('site_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('patient');
        return $query->row();
    }

    function getDoctorById($id)
    {
        $this->db->where('hospital_id', $this->session->userdata('site_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('doctor');
        return $query->row();
    }

    function insertPayment($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('site_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('payment', $data2);
    }

    function getEmailSettingsByType($type)
    {
        $this->db->where('hospital_id', $this->session->userdata('site_id'));
        $this->db->where('type', $type);
        $query = $this->db->get('email_settings');
        return $query->row();
    }

    function insertDeposit($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('patient_deposit', $data2);
    }

    function updatePayment($id, $data)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $this->db->update('payment', $data);
    }

    function getPaymentById($id)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('payment');
        return $query->row();
    }

    function getPaymentGatewaySettingsByName($name)
    {
        $this->db->where('hospital_id', $this->session->userdata('site_id'));
        $this->db->where('name', $name);
        $query = $this->db->get('paymentGateway');
        return $query->row();
    } 
}
