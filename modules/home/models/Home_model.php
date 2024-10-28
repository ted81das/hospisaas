<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getSum($field, $table)
    {
        $this->db->select_sum($field);
        $query = $this->db->get($table);
        return $query->result();
    }

    function updateUser($id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('users', $data);
    }


    public function countPatientsRegisteredToday()
    {
        $startOfDay = strtotime("today midnight");
        $endOfDay = strtotime("tomorrow midnight") - 1;

        $this->db->where('registration_time >=', $startOfDay);
        $this->db->where('registration_time <=', $endOfDay);
        $query = $this->db->get('patient');

        return $query->num_rows();
    }

    public function countPatientsAdmittedToday()
    {
        $startOfDay = strtotime("today midnight");
        $endOfDay = strtotime("tomorrow midnight") - 1;

        $this->db->where('a_timestamp >=', $startOfDay);
        $this->db->where('a_timestamp <=', $endOfDay);
        $query = $this->db->get('alloted_bed');

        return $query->num_rows();
    }

    public function countPatientsDischargedToday()
    {
        $startOfDay = strtotime("today midnight");
        $endOfDay = strtotime("tomorrow midnight") - 1;

        $this->db->where('d_timestamp >=', $startOfDay);
        $this->db->where('d_timestamp <=', $endOfDay);
        $query = $this->db->get('alloted_bed');

        return $query->num_rows();
    }


    public function countAppointmentsToday()
    {
        $startOfDay = strtotime("today midnight");
        $endOfDay = strtotime("tomorrow midnight") - 1;

        $this->db->where('appointment_time >=', $startOfDay);
        $this->db->where('appointment_time <=', $endOfDay);
        $query = $this->db->get('appointment');

        return $query->num_rows();
    }

    public function countNoticesToday()
    {
        $startOfDay = strtotime("today midnight");
        $endOfDay = strtotime("tomorrow midnight") - 1;

        $this->db->where('timestamp >=', $startOfDay);
        $this->db->where('timestamp <=', $endOfDay);
        $query = $this->db->get('notice');

        return $query->num_rows();
    }

    public function countPatientsRegisteredThisMonth()
    {
        $startOfMonth = strtotime("first day of this month midnight");
        $endOfMonth = strtotime("first day of next month midnight") - 1;

        $this->db->where('registration_time >=', $startOfMonth);
        $this->db->where('registration_time <=', $endOfMonth);
        $query = $this->db->get('patient');

        return $query->num_rows();
    }

    public function countPatientsAdmittedThisMonth()
    {
        $startOfMonth = strtotime("first day of this month midnight");
        $endOfMonth = strtotime("first day of next month midnight") - 1;

        $this->db->where('a_timestamp >=', $startOfMonth);
        $this->db->where('a_timestamp <=', $endOfMonth);
        $query = $this->db->get('alloted_bed');

        return $query->num_rows();
    }

    public function countPatientsDischargedThisMonth()
    {
        $startOfMonth = strtotime("first day of this month midnight");
        $endOfMonth = strtotime("first day of next month midnight") - 1;

        $this->db->where('d_timestamp >=', $startOfMonth);
        $this->db->where('d_timestamp <=', $endOfMonth);
        $query = $this->db->get('alloted_bed');

        return $query->num_rows();
    }

    public function countAppointmentsThisMonth()
    {
        $startOfMonth = strtotime("first day of this month midnight");
        $endOfMonth = strtotime("first day of next month midnight") - 1;

        $this->db->where('appointment_time >=', $startOfMonth);
        $this->db->where('appointment_time <=', $endOfMonth);
        $query = $this->db->get('appointment');

        return $query->num_rows();
    }

    public function countNoticesThisMonth()
    {
        $startOfMonth = strtotime("first day of this month midnight");
        $endOfMonth = strtotime("first day of next month midnight") - 1;

        $this->db->where('timestamp >=', $startOfMonth);
        $this->db->where('timestamp <=', $endOfMonth);
        $query = $this->db->get('notice');

        return $query->num_rows();
    }

    public function countPatientsRegisteredThisYear()
    {
        $startOfYear = strtotime("first day of January this year midnight");
        $endOfYear = strtotime("first day of January next year midnight") - 1;

        $this->db->where('registration_time >=', $startOfYear);
        $this->db->where('registration_time <=', $endOfYear);
        $query = $this->db->get('patient');

        return $query->num_rows();
    }

    public function countPatientsAdmittedThisYear()
    {
        $startOfYear = strtotime("first day of January this year midnight");
        $endOfYear = strtotime("first day of January next year midnight") - 1;

        $this->db->where('a_timestamp >=', $startOfYear);
        $this->db->where('a_timestamp <=', $endOfYear);
        $query = $this->db->get('alloted_bed');

        return $query->num_rows();
    }

    public function countPatientsDischargedThisYear()
    {
        $startOfYear = strtotime("first day of January this year midnight");
        $endOfYear = strtotime("first day of January next year midnight") - 1;

        $this->db->where('d_timestamp >=', $startOfYear);
        $this->db->where('d_timestamp <=', $endOfYear);
        $query = $this->db->get('alloted_bed');

        return $query->num_rows();
    }

    public function countAppointmentsThisYear()
    {
        $startOfYear = strtotime("first day of January this year midnight");
        $endOfYear = strtotime("first day of January next year midnight") - 1;

        $this->db->where('appointment_time >=', $startOfYear);
        $this->db->where('appointment_time <=', $endOfYear);
        $query = $this->db->get('appointment');

        return $query->num_rows();
    }

    public function countNoticesThisYear()
    {
        $startOfYear = strtotime("first day of January this year midnight");
        $endOfYear = strtotime("first day of January next year midnight") - 1;

        $this->db->where('timestamp >=', $startOfYear);
        $this->db->where('timestamp <=', $endOfYear);
        $query = $this->db->get('notice');

        return $query->num_rows();
    }


    public function countDoctorsOnDuty()
    {
        $this->db->where('available', '1');
        $query = $this->db->get('doctor');
        return $query->num_rows();
    }

    public function countNursesOnDuty()
    {
        $this->db->where('available', '1');
        $query = $this->db->get('nurse');
        return $query->num_rows();
    }

    public function countPharmacistsOnDuty()
    {
        $this->db->where('available', '1');
        $query = $this->db->get('pharmacist');
        return $query->num_rows();
    }

    public function countLaboratoristsOnDuty()
    {
        $this->db->where('available', '1');
        $query = $this->db->get('laboratorist');
        return $query->num_rows();
    }

    public function countReceptionistsOnDuty()
    {
        $this->db->where('available', '1');
        $query = $this->db->get('receptionist');
        return $query->num_rows();
    }

    public function countAccountantsOnDuty()
    {
        $this->db->where('available', '1');
        $query = $this->db->get('accountant');
        return $query->num_rows();
    }

    public function countPatientsAdmitted()
    {
        $this->db->where('d_timestamp', NULL);
        $query = $this->db->get('alloted_bed');
        return $query->num_rows();
    }



    public function getBedCategories()
    {
        $query = $this->db->get('bed_category');
        return $query->result();
    }

    public function getBeds()
    {
        $query = $this->db->get('bed');
        return $query->result();
    }

    public function getAllotedBeds()
    {
        $query = $this->db->get('alloted_bed');
        return $query->result();
    }

    function getDiagnosis()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('diagnosis');
        return $query->result();
    }

    function getDiagnosisById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('diagnosis');
        return $query->row();
    }

    function getDiagnosisName($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('diagnosis');
        return $query->row()->name;
    }

    function getTreatment()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('treatment');
        return $query->result();
    }

    function getTreatmentName($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('treatment');
        return $query->row()->name;
    }


    function getMedicineByStockAlert()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('quantity <=', 20);
        $this->db->order_by('quantity', 'asc');
        $this->db->limit(10);
        $query = $this->db->get('medicine');
        return $query->result();
    }

    function getDiseasesWithOutbreakPotential()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('disease_with_outbreak_potential', '1');
        $query = $this->db->get('diagnosis');
        return $query->result();
    }

    function getDisnosisById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('diagnosis');
        return $query->row();
    }

    function getCaseNumberByDiagnosisLastThirtyDays($diagnosis_id)
    {
        $this->db->where("FIND_IN_SET($diagnosis_id, diagnosis_id) !=", 0);
        $this->db->where('date >=', strtotime('-30 days'));
        $query = $this->db->get('medical_history');
        return $query->num_rows();
    }

    function getCaseNumberByTreatmentLastThirtyDeays($treatment_id)
    {
        $this->db->where("FIND_IN_SET($treatment_id, treatment_id) !=", 0);
        $this->db->where('date >=', strtotime('-30 days'));
        $query = $this->db->get('medical_history');
        return $query->num_rows();
    }


    function getCasesNumberForOutbreakDisease($disease_id)
    {
        $seven_days_ago = strtotime('-7 days');
        $this->db->where("FIND_IN_SET($disease_id, diagnosis_id) !=", 0);
        $this->db->where('date >=', $seven_days_ago);
        $query = $this->db->get('medical_history');
        return $query->num_rows();
    }

    function getPaymentCategories()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('payment_category');
        return $query->result();
    }

    function getPaymentCategoryName($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('payment_category');
        return $query->row()->category;
    }

    function getPaymentLastThirtyDays()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        // last 30 days
        $this->db->where('date >=', strtotime('-30 days'));
        $query = $this->db->get('payment');
        return $query->result();
    }

    function getTotalDepositToday()
    {
        $today_start = strtotime('today');
        $today_end = strtotime('tomorrow') - 1;

        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', $today_start);
        $this->db->where('date <=', $today_end);
        $query = $this->db->get('patient_deposit')->result();

        $total_deposit = 0;
        foreach ($query as $deposit) {
            $total_deposit += $deposit->deposited_amount; // Assuming 'amount' is the field for deposit amount
        }

        return $total_deposit;
    }


    function getTotalDepositThisMonth()
    {
        $startOfMonth = strtotime('first day of this month');
        $endOfMonth = strtotime('last day of this month 23:59:59');

        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', $startOfMonth);
        $this->db->where('date <=', $endOfMonth);
        $query = $this->db->get('patient_deposit')->result();

        $total_deposit = 0;
        foreach ($query as $deposit) {
            $total_deposit += $deposit->deposited_amount; // Assuming 'amount' is the field for deposit amount
        }

        return $total_deposit;
    }

    function getTotalDepositThisYear()
    {
        $startOfYear = strtotime('first day of January this year');
        $endOfYear = strtotime('last day of December this year 23:59:59');

        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', $startOfYear);
        $this->db->where('date <=', $endOfYear);
        $query = $this->db->get('patient_deposit')->result();

        $total_deposit = 0;
        foreach ($query as $deposit) {
            $total_deposit += $deposit->deposited_amount; // Assuming 'amount' is the field for deposit amount
        }

        return $total_deposit;
    }



    function billPercentageChangedFromLastMonth()
    {
        $currentDate = time();
        $lastMonthDate = strtotime('-1 month', $currentDate);

        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', strtotime(date('Y-m-01', $lastMonthDate)));
        $this->db->where('date <=', strtotime(date('Y-m-t', $lastMonthDate)));
        $queryLastMonth = $this->db->get('payment')->result();

        $totalLastMonth = 0;
        foreach ($queryLastMonth as $payment) {
            $totalLastMonth += $payment->gross_total ?? 0; // Using null coalescing operator
        }

        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', strtotime(date('Y-m-01', $currentDate)));
        $this->db->where('date <=', strtotime(date('Y-m-t', $currentDate)));
        $queryCurrentMonth = $this->db->get('payment')->result();

        $totalCurrentMonth = 0;
        foreach ($queryCurrentMonth as $payment) {
            $totalCurrentMonth += $payment->gross_total ?? 0; // Using null coalescing operator
        }

        // Calculate percentage change
        if ($totalLastMonth > 0) {
            $paymentChange = (($totalCurrentMonth - $totalLastMonth) / $totalLastMonth) * 100;
        } else {
            $paymentChange = $totalCurrentMonth > 0 ? 100 : 0; // If last month was 0 and current month is greater than 0, it's a 100% increase
        }

        $paymentChange = number_format($paymentChange ?? 0, 1, '.', ','); // Ensuring $paymentChange is not null
        return $paymentChange;
    }




    function depositPercentageChangedFromLastMonth()
    {
        $currentDate = time();
        $lastMonthDate = strtotime('-1 month', $currentDate);

        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', strtotime(date('Y-m-01', $lastMonthDate)));
        $this->db->where('date <=', strtotime(date('Y-m-t', $lastMonthDate)));
        $queryLastMonth = $this->db->get('patient_deposit')->result();

        $totalLastMonth = 0;
        foreach ($queryLastMonth as $deposit) {
            $totalLastMonth += $deposit->deposited_amount ?? 0; // Using null coalescing operator
        }

        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', strtotime(date('Y-m-01', $currentDate)));
        $this->db->where('date <=', strtotime(date('Y-m-t', $currentDate)));
        $queryCurrentMonth = $this->db->get('patient_deposit')->result();

        $totalCurrentMonth = 0;
        foreach ($queryCurrentMonth as $deposit) {
            $totalCurrentMonth += $deposit->deposited_amount ?? 0; // Using null coalescing operator
        }

        // Calculate percentage change
        if ($totalLastMonth > 0) {
            $depositChange = (($totalCurrentMonth - $totalLastMonth) / $totalLastMonth) * 100;
        } else {
            $depositChange = $totalCurrentMonth > 0 ? 100 : 0; // If last month was 0 and current month is greater than 0, it's a 100% increase
        }

        $depositChange = number_format($depositChange ?? 0, 1, '.', ','); // Ensuring $depositChange is not null

        return $depositChange;
    }

    function duePercentageChangedFromLastMonth()
    {
        $currentDate = time();
        $lastMonthDate = strtotime('-1 month', $currentDate);

        // last month due 
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', strtotime(date('Y-m-01', $lastMonthDate)));
        $this->db->where('date <=', strtotime(date('Y-m-t', $lastMonthDate)));
        $bill_queryLastMonth = $this->db->get('payment')->result();

        $bill_totalLastMonth = 0;
        foreach ($bill_queryLastMonth as $payment) {
            $bill_totalLastMonth += $payment->gross_total ?? 0;
        }

        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', strtotime(date('Y-m-01', $lastMonthDate)));
        $this->db->where('date <=', strtotime(date('Y-m-t', $lastMonthDate)));
        $deposit_queryLastMonth = $this->db->get('patient_deposit')->result();

        $deposit_totalLastMonth = 0;
        foreach ($deposit_queryLastMonth as $deposit) {
            $deposit_totalLastMonth += $deposit->deposited_amount ?? 0;
        }

        $last_month_due = $bill_totalLastMonth - $deposit_totalLastMonth;

        // current month due 
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', strtotime(date('Y-m-01', $currentDate)));
        $this->db->where('date <=', strtotime(date('Y-m-t', $currentDate)));
        $bill_queryCurrentMonth = $this->db->get('payment')->result();

        $bill_totalCurrentMonth = 0;
        foreach ($bill_queryCurrentMonth as $payment) {
            $bill_totalCurrentMonth += $payment->gross_total ?? 0;
        }

        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', strtotime(date('Y-m-01', $currentDate)));
        $this->db->where('date <=', strtotime(date('Y-m-t', $currentDate)));
        $deposit_queryCurrentMonth = $this->db->get('patient_deposit')->result();

        $deposit_totalCurrentMonth = 0;
        foreach ($deposit_queryCurrentMonth as $deposit) {
            $deposit_totalCurrentMonth += $deposit->deposited_amount ?? 0;
        }

        $current_month_due = $bill_totalCurrentMonth - $deposit_totalCurrentMonth;

        if ($last_month_due > 0) {
            $dueChange = (($current_month_due - $last_month_due) / $last_month_due) * 100;
        } else {
            $dueChange = $current_month_due > 0 ? 100 : 0;
        }
        $dueChange = number_format($dueChange, 1, '.', ',');

        return $dueChange;
    }


    function expensePercentageChangedFromLastMonth()
    {
        $currentDate = time();
        $lastMonthDate = strtotime('-1 month', $currentDate);

        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', strtotime(date('Y-m-01', $lastMonthDate)));
        $this->db->where('date <=', strtotime(date('Y-m-t', $lastMonthDate)));
        $queryLastMonth = $this->db->get('expense')->result();

        $totalLastMonth = 0;
        foreach ($queryLastMonth as $deposit) {
            $totalLastMonth += $deposit->amount ?? 0;
        }

        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', strtotime(date('Y-m-01', $currentDate)));
        $this->db->where('date <=', strtotime(date('Y-m-t', $currentDate)));
        $queryCurrentMonth = $this->db->get('expense')->result();

        $totalCurrentMonth = 0;
        foreach ($queryCurrentMonth as $deposit) {
            $totalCurrentMonth += $deposit->amount ?? 0;
        }

        // Calculate percentage change
        if ($totalLastMonth > 0) {
            $expenseChange = (($totalCurrentMonth - $totalLastMonth) / $totalLastMonth) * 100;
        } else {
            $expenseChange = $totalCurrentMonth > 0 ? 100 : 0;
        }
        $expenseChange = number_format($expenseChange ?? 0, 1, '.', ',');

        return $expenseChange;
    }



    function getTotalDueLastMonth()
    {
        $currentDate = time();
        $lastMonthDate = strtotime('-1 month', $currentDate);

        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', strtotime(date('Y-m-01', $lastMonthDate)));
        $this->db->where('date <=', strtotime(date('Y-m-t', $lastMonthDate)));
        $queryLastMonth = $this->db->get('payment')->result();

        $totalLastMonth = 0;
        foreach ($queryLastMonth as $payment) {
            $totalLastMonth += $payment->gross_total ?? 0;
        }

        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', strtotime(date('Y-m-01', $lastMonthDate)));
        $this->db->where('date <=', strtotime(date('Y-m-t', $lastMonthDate)));
        $queryLastMonthDeposit = $this->db->get('patient_deposit')->result();

        $totalLastMonthDeposit = 0;
        foreach ($queryLastMonthDeposit as $deposit) {
            $totalLastMonthDeposit += $deposit->deposited_amount ?? 0;
        }

        $lastMonthDue = $totalLastMonth - $totalLastMonthDeposit;

        return $lastMonthDue;
    }
}
