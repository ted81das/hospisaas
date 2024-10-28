<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php';

use Dompdf\Dompdf;
use \Mpdf\Mpdf;
//require_once 'dompdf/autoload.inc.php';
class Lab extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('lab_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('finance/finance_model');
        $this->load->model('patient/patient_model');
        $this->load->model('accountant/accountant_model');
        $this->load->model('receptionist/receptionist_model');
        $this->load->model('macro/macro_model');
        if (!$this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Nurse', 'Laboratorist', 'Doctor', 'Patient'))) {
            redirect('home/permission');
        }
    }

    public function load_view($view, $data = array())
    {
        $html = $this->ci()->load->view($view, $data, TRUE);

        $this->load_html($html);
    }

    protected function ci()
    {
        return get_instance();
    }

    function testPdf2()
    {

        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['lab'] = $this->lab_model->getLabById($id);

        if ($data['lab']->hospital_id != $this->session->userdata('hospital_id')) {
            $this->load->view('home/permission');
        }

        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('downloadInvoice', $data, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output('INV' . $id . '_' . date('dmYHis') . '.pdf', 'D');
        die();


        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['lab'] = $this->lab_model->getLabById($id);

        if ($data['lab']->hospital_id != $this->session->userdata('hospital_id')) {
            $this->load->view('home/permission');
        }

        //$this->load->view('home/dashboard');
        $this->load->view('downloadInvoice', $data);
        //$this->load->view('home/footer'); // just the footer fi
        //$html = file_get_contents($this->load->view('downloadInvoice', $data)); 
        $html = $this->load->view('downloadInvoice', $data, TRUE);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();

        //        	$this->load->library('pdf');
        //
        //
        //  	$this->pdf->load_view('mypdf');
        //  	$this->pdf->render();
        //
        //
        //  	$this->pdf->stream("welcome.pdf");
    }

    // function testPdf()
    // {
    //     $data = array();
    //     $id = $this->input->get('id');
    //     $data['settings'] = $this->settings_model->getSettings();
    //     $data['lab'] = $this->lab_model->getLabById($id);
    //     //$data['lab'] = $this->lab_model->getLabById($id);
    //     if ($data['lab']->hospital_id != $this->session->userdata('hospital_id')) {
    //         $this->load->view('home/permission');
    //     }

    //     //$this->load->view('newLabReport', $data);

    //     $mpdf = new \Mpdf\Mpdf();
    //     $html = $this->load->view('labReportDownload', $data, true);
    //     $mpdf->WriteHTML($html);
    //     $mpdf->Output('INV' . $id . '_' . date('dmYHis') . '.pdf', 'D');
    // }


    function testPdf()
    {
        $data = array();
        $id = $this->input->get('id');
        $settings1 = $this->settings_model->getSettings();
        $data['settings'] = $this->settings_model->getSettings();
        $data['lab'] = $this->lab_model->getLabById($id);
        $lab = $this->lab_model->getLabById($id);
        $data['redirect'] = 'download1';
        //$data['lab'] = $this->lab_model->getLabById($id);
        $patient = $this->db->get_where('patient', array('id' => $lab->patient))->row();
        if ($data['lab']->hospital_id != $this->session->userdata('hospital_id')) {
            $this->load->view('home/permission');
        }
        if ($lab->updated_on) {
            $update_on = lang('updated') . ': ' . date('l d M Y h:s A', $lab->updated_on);
        } else {
            $update_on = '';
        }
        //$this->load->view('newLabReport', $data);

        $age = explode('-', $patient->age);
        if (count($age) == 3) {

            $age_as = '<td style="padding-right: 10px;"><label class="control_label">' . lang('age') . '</label> <span class="info_text">:' . $age[0] . " Y " . $age[1] . " M " . $age[2] . " D" . '</td></span>';
        } else {
            $age_as = '<td style="padding-right: 10px;"><label class="control_label">' . lang('age') . '</label> <span class="info_text">: </span></td>';
        }

        $doctor_details = "";
        $invoice_details = "";
        $invoice_details = $this->db->get_where('payment', array('id' => $lab->invoice_id))->row();
        if ($invoice_details) {
            if ($invoice_details->doctor) {
                $doctor_details = $this->db->get_where('doctor', array('id' => $invoice_details->doctor))->row();
            }
        }

        if ($invoice_details) {
            $datess = date('d/m/Y h:i A', $invoice_details->date);
        } else {
            $datess = '';
        }
        if ($doctor_details) {
            $doc_name = '<span class="info_text">: ' . $doctor_details->name . '</span>';
            $profile = '<span class="info_text">' . $doctor_details->profile . '</span>';
        } else {
            $doc_name = '';
            $profile = '';
        }




        $signature = "";
        if ($lab->signed_by) {
            $laboratorist = $this->db->get_where('laboratorist', array('ion_user_id' => $lab->signed_by))->row();

            if ($laboratorist) {
                $signature = $laboratorist->signature;
            }
        }






        $header = '       <div id="invoice_header">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 25%">
                                    <img alt="" src="' . site_url($this->settings_model->getSettings()->logo) . '" width="150" height="auto" style="margin-top:-45px; margin-left: 5px;">
                                </td>
                                <td>
                                    <h4 style="margin-bottom: 10px; font-weight: 800; margin-top: -20px;">' . $settings1->title . '</h4>
                                    <h6 style="margin-bottom: 10px;">' . $settings1->address . '</h6>
                                    <h4 style="line-height: 20px">' . lang('phone') . ': <br>' . $settings1->phone . '</h4>
                                </td>
                                <td>
                                    <table style="margin-top: 10px;">
                                        <tr>
                                            <td colspan="2">
                                                <label class="control_label">' . lang('name') . '</label> <span class="info_text">:' . $patient->name . '</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            ' . $age_as . '
                                            <td>
                                                <label class="control_label">' . lang('done_by') . '</label> <span class="info_text">: ' . $patient->sex . '</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding-right: 10px;"><label class="control_label">HN</label> <span class="info_text">: 0000000' . $patient->id . '</span></td>
                                            <td><label class="control_label">' . lang('phone') . '</label> <span class="info_text">: ' . $patient->phone . '</span></td>
                                        </tr>
                                       
                                        <tr>
                                            <td style="padding-right: 10px;"><label class="control_label">VN</label> <span class="info_text">: 0000000' . $lab->invoice_id . '</span></td>
                                            <td><label class="control_label">VN ' . lang('date') . '</label> <span class="info_text">:
                                                                                                                        ' . $datess . '</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label class="control_label">' . lang('doctor') . '</label>
                                                ' . $doc_name . '
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                ' . $profile . '
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        
                        <hr class="table-qr-hr">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 50%; padding-left: 20px; display: inline-flex">
                                    <label style="margin-bottom: 10px;">HN:</label>
                                    <img class="image_bar" alt="testing" src="' . site_url("lab/barcode") . '?text=000000000' . $patient->id . '&print=true" />
                                </td>
                                
                                <td style="width: 50%; text-align: right; padding-right: 20px; display: inline-flex; justify-content: end;">
                                    <label style="margin-bottom: 10px;">VN:</label>
                                    <img class="image_bar" alt="testing" src="' . site_url("lab/barcode") . '?text=000000000' . $lab->invoice_id . '&print=true" />
                                </td>
                            </tr>
                        </table>
                    </div>';

        $footer = '<div class="invoice_footer" style="margin-top:50px;">

                                <table style="width: 100%">
                                
                                    <tr>
                                        <td  id="footer_done" style="padding-right: 20px;"><span class="info_text">' . lang('done_by') . ': ' . $lab->done_by . '</span>
                                          
</td>
                                        <td id="footer_second">
                                           |{PAGENO} of {nbpg}| 
                                        </td>
                                        <td id="footer_third" style="text-align: right;">
                                            <p style="font-weight: bold">
                                                ' . $update_on . '
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </div>';
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'stretch';
        $mpdf->SetHTMLHeader($header);
        $mpdf->SetHTMLFooter($footer);
        $mpdf->setAutoBottomMargin = 'stretch';
        $html = $this->load->view('labReportDownload', $data, true);


        $mpdf->WriteHTML($html);
        $mpdf->Output('LAB-REPORT-' . $id . '_' . date('d-m-Y-h-iA') . '.pdf', 'D');
    }

    function pdfLabel()
    {
        $id = $this->input->get('id');
        $data['lab'] = $this->lab_model->getLabById($id);
        $data['labels'] = array();
        $label = $this->lab_model->getAllLabels($data['lab']->invoice_id, $data['lab']->category_id);

        if ($label->category_id) {
            $category_id = $this->db->get_where('payment_category', array('id' =>  $label->category_id))->row();
            $category_id = $category_id->payment_category;
        }

        $alllabs = $this->db->get_where('lab', array('invoice_id' => $data['lab']->invoice_id))->result();
        foreach ($alllabs as $lab) {
            if ($lab->category_id) {
                $category_id2 = $this->db->get_where('payment_category', array('id' =>  $lab->category_id))->row();
                $category_id2 = $category_id2->payment_category;
                if ($category_id == $category_id2) {
                    array_push($data['labels'], $lab);
                }
            }
        }

        $data['patient'] = $this->patient_model->getPatientById($data['lab']->patient);

        //        $this->load->view('labLabel', $data);
        //        
        //        
        //        $data = array();
        //        $id = $this->input->get('id');
        //        $data['settings'] = $this->settings_model->getSettings();
        //        $data['lab'] = $this->lab_model->getLabById($id);
        //        //$data['lab'] = $this->lab_model->getLabById($id);
        //        if ($data['lab']->hospital_id != $this->session->userdata('hospital_id')) {
        //            $this->load->view('home/permission');
        //        }
        //
        //        //$this->load->view('newLabReport', $data);

        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('labLabelPdf', $data, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output('LABEL_' . $id . '_' . date('dmYHis') . '.pdf', 'D');
    }

    function viewReport()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['lab'] = $this->lab_model->getLabById($id);
        //$data['lab'] = $this->lab_model->getLabById($id);
        if ($data['lab']->hospital_id != $this->session->userdata('hospital_id')) {
            $this->load->view('home/permission');
        }

        $this->load->view('home/dashboard');
        $this->load->view('newLabReport', $data);
        $this->load->view('home/footer');
    }


    function testReport()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['lab'] = $this->lab_model->getLabById($id);
        //$data['lab'] = $this->lab_model->getLabById($id);
        if ($data['lab']->hospital_id != $this->session->userdata('hospital_id')) {
            $this->load->view('home/permission');
        }

        //$this->load->view('newLabReport', $data);

        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('labReportDownload', $data, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output('INV' . $id . '_' . date('dmYHis') . '.pdf', 'D');
    }

    function testStatus()
    {
        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        //$data['categories'] = $this->lab_model->getLabCategory();
        $data['categories'] = $this->finance_model->getCategory();
        $data['payment_categories'] = $this->finance_model->getPaymentCategory();
        $this->load->view('home/dashboard');
        $this->load->view('test_status', $data);
        $this->load->view('home/footer');
    }

    function getTestStatusLab2()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $status = $_GET['status'];
        $category = $_GET['category'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "2" => "date",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getTestStatusLabBysearch($search, $order, $dir, $status, $category);
            } else {
                $data['labs'] = $this->lab_model->getTestStatusLabWithoutSearch($order, $dir, $status, $category);
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getTestStatusLabByLimitBySearch($limit, $start, $search, $order, $dir, $status, $category);
            } else {
                $data['labs'] = $this->lab_model->getTestStatusLabByLimit($limit, $start, $order, $dir, $status, $category);
            }
        }

        $i = 0;
        foreach ($data['labs'] as $lab) {
            $i = $i + 1;
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) {
                $options1 = ' <a class="btn btn-info btn-sm editbutton mb-1 mr-1" title="' . lang('edit') . '" href="lab?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';
            } else {
                $options1 = '';
            }

            $options2 = '<a class="btn btn-sm invoicebutton mb-1 mr-1" title="' . lang('lab') . '" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('') . '</a>';
            $options2 = '<a class="btn btn-sm invoicebutton mb-1 mr-1" title="Download PDF" target="_blank" style="color: #fff;" href="lab/viewReport?id=' . $lab->id . '"><i class="fas fa-eye"></i></a>'
                . '<a class="btn btn-sm invoicebutton" title="Download PDF" style="color: #fff;" href="lab/testPdf?id=' . $lab->id . '"> PDF</a>';
            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-info btn-sm delete_button mb-1 mr-1" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }

            $doctor_info = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }

            if ($lab->status == 'sample_taken') {
                $status = '<span class="badge badge-primary">' . lang('sample_collected') . '</span>';
            } elseif ($lab->status == 'complete') {
                $status = '<span class="badge badge-info">' . lang('report') . " " . lang('completed') . '</span>';
            } elseif ($lab->status == 'waiting') {
                $status = '<span class="badge badge-danger">' . lang('sample_not_collected') . '</span>';
            } elseif ($lab->status == 'pending') {
                $status = '<span class="badge badge-warning">' . lang('report') . " " . lang('pending') . '</span>';
            } elseif ($lab->status == 'delivery_pending') {
                $status = '<span class="badge badge-danger">' . lang('delivery') . " " . lang('pending') . '</span>';
            } else {
                $status = '<span class="badge badge-success">' . lang('delivered') . '</span>';
            }
            $patient_info = $this->patient_model->getPatientById($lab->patient);
            if (!empty($patient_info)) {
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
            } else {
                $patient_details = ' ';
            }
            $info[] = array(
                $lab->id,
                $patient_details,
                $date,
                $status,
                $options1 . ' ' . $options2 . ' ' . $options3,
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->lab_model->getTestStatusLab($status, $category)),
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    function getTestStatusLab()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $status = $_GET['status'];
        $category = $_GET['category'];
        $from = $_GET['from'];
        $to = $_GET['to'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "2" => "date",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getTestStatusLabBysearch($search, $order, $dir, $status, $category, $from, $to);
            } else {
                $data['labs'] = $this->lab_model->getTestStatusLabWithoutSearch($order, $dir, $status, $category, $from, $to);
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getTestStatusLabByLimitBySearch($limit, $start, $search, $order, $dir, $status, $category, $from, $to);
            } else {
                $data['labs'] = $this->lab_model->getTestStatusLabByLimit($limit, $start, $order, $dir, $status, $category, $from, $to);
            }
        }


        $i = 0;
        foreach ($data['labs'] as $lab) {
            $i = $i + 1;
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) {
                $options1 = ' <a class="btn btn-success btn-sm editbutton mb-1 mr-1" title="' . lang('edit') . '" href="lab?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';
            } else {
                $options1 = '';
            }

            $options2 = '<a class="btn btn-sm btn-success mb-1 mr-1" title="' . lang('lab') . '" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('') . '</a>';
            $options2 = '<a class="btn btn-sm btn-success mb-1 mr-1" title="Download PDF" href="lab/testPdf?id=' . $lab->id . '">PDF</a>';
            $option_list_1 = '<a class="btn btn-sm btn-success invoicebutton mb-1 mr-1" target="_blank" href="lab/printLabel?id=' . $lab->id . '">' . lang('label_print') . '</a>';
            $option_list_2 = '<a class="btn btn-sm btn-warning mb-1 mr-1" href="lab/pdfLabel?id=' . $lab->id . '"><i class="fas fa-file-pdf"></i></a>';

            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-info btn-sm delete_button mb-1 mr-1" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }
            $options3 = '';

            $doctor_info = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }

            $patient_info = $this->patient_model->getPatientById($lab->patient);
            if (!empty($patient_info)) {
                $age = explode('-', $patient_info->age);
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>' . $age[0] . '</br>';
            } else {
                $patient_details = ' ';
            }

            $invoice_details = "";
            if ($lab->invoice_id != null) {
                $invoice_details = $this->db->get_where('payment', array('id' => $lab->invoice_id))->row();
                $invoice_deposit = $this->db->get_where('patient_deposit', array('payment_id' => $lab->invoice_id))->result();
                if (empty($invoice_deposit)) {
                    $total_deposit = '0';
                } else {
                    foreach ($invoice_deposit as $deposit_amount) {
                        $deposit[] = $deposit_amount->deposited_amount;
                    }
                    $total_deposit = array_sum($deposit);
                }
                if ($invoice_details) {
                    if ($this->settings->time_format == 24) {
                        $invoice_date_time = date('d-m-y H:i', $invoice_details->date);
                    } else {
                        $invoice_date_time = date('d-m-y h:i A', $invoice_details->date);
                    }
                } else {
                    $invoice_date_time = "";
                }
            } else {
                $invoice_date_time = "";
            }

            $bill_status = "";
            if (!empty($invoice_details)) {
                if (($invoice_details->gross_total - $total_deposit) > 0) {
                    $bill_status =  '<span class="badge badge-danger">' . lang('due_have') . '</span>';
                } else {
                    $bill_status = '<span class="badge badge-primary">' . lang('paid') . '</span>';
                }
            }


            if ($lab->category_id != null) {
                $test_name = $this->finance_model->getPaymentCategoryById($lab->category_id);
                $test_name = $test_name->category;
            } else {
                $test_name = "";
            }

            $status = "<select class='form-control test_status' data-id='" . $lab->id . "'>";
            if ($lab->test_status == "done") {
                $status .= "<option value='done' selected>" . lang('done') . "</option><option value='not_done'>" . lang('not_done') . "</option>";
            } else {
                $status .= "<option value='done'>" . lang('done') . "</option><option value='not_done' selected>" . lang('not_done') . "</option>";
            }
            $status .= "<select>";

            $payment = $this->finance_model->getPaymentById($lab->invoice_id);
            if ($payment->payment_from == 'payment' || empty($payment->payment_from)) {
                $from = '<span class="badge badge-primary">' . lang('opd') . '</span>';
            } elseif ($payment->payment_from == 'admitted_patient_bed_medicine') {
                $from = '<span class="badge badge-warning">' . lang('ipd_medicine') . '</span>';
            } elseif ($payment->payment_from == 'admitted_patient_bed_service') {
                $from = '<span class="badge badge-success">' . lang('ipd_service') . '</span>';
            } elseif ($payment->payment_from == 'admitted_patient_bed_diagnostic') {
                $from = '<span class="badge badge-info">' . lang('ipd_diagnostic') . '</span>';
            }

            $dropdownOptions = '';
            $dropdownOptions = '
            <div class="btn-group">
            <button type="button" class="btn btn-info btn-sm label-primary dropdown-toggle action_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="">
            <i class="fas fa-bars"></i> ' . lang('actions') . ' <span class="caret"></span>
        </button>
                <ul class="dropdown-menu">
                    ' . ($option_list_1 ? '<li><a  style="margin-right: 10px" target="_blank" href="lab/printLabel?id=' . $lab->id . '">  <i class="fa fa-print"></i> ' . lang('label_print') . ' ' . lang('') . '</a></li>' : '') . '
                    ' . ($option_list_2 ? '<li><a href="lab/pdfLabel?id=' . $lab->id . '"> <i class="fa fa-file-pdf"></i> ' . lang('download') . ' </a></li>' : '') . '
                </ul>
            </div>';

            if( $lab->test_status_date != null){
                if ($this->settings->time_format == 24) {
                    $test_status_date = date('d-m-y H:i', $lab->test_status_date);
                }else{
                    $test_status_date = date('d-m-y h:i A', $lab->test_status_date);
                }
            }else{
                $test_status_date = '';
            }


            $info[] = array(
                isset($patient_info->id) ? $patient_info->id : "",
                $patient_details,
                $lab->invoice_id,
                $invoice_date_time,
                $from,
                $test_name,
                $status,
                $test_status_date,
                $bill_status,
                $lab->done_by,
                // $dropdownOptions
                $option_list_1 . ' ' . $option_list_2,
                //$options1 . ' ' . $options2 . ' ' . $options3,
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->lab_model->getLab()),
                "recordsFiltered" => count($this->lab_model->getLab()),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    function getLab()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $status = $_GET['status'];
        $category = $_GET['category'];
        $from = $_GET['from'];
        $to = $_GET['to'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "patient",
            "3" => "invoice_id",
            "4" => 'date',
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getLabReportBysearch($search, $order, $dir, $status, $category, $from, $to);
            } else {
                $data['labs'] = $this->lab_model->getLabReportWithoutSearch($order, $dir, $status, $category, $from, $to);
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getLabReportByLimitBySearch($limit, $start, $search, $order, $dir, $status, $category, $from, $to);
            } else {
                $data['labs'] = $this->lab_model->getLabReportByLimit($limit, $start, $order, $dir, $status, $category, $from, $to);
            }
        }

        $i = 0;
        foreach ($data['labs'] as $lab) {
            $i = $i + 1;
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) {
                $options1 = ' <a class="btn btn-primary btn-sm mr-1 mb-2" title="' . lang('report') . '" href="lab?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('report') . '</a>';
            } else {
                $options1 = '';
            }

            $options2 = '<a class="btn btn-success btn-sm invoicebutton mr-1 mb-2" title="' . lang('lab') . '" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('report') . '</a>';
            $options2 = '<a class="btn btn-sm btn-success invoicebutton mr-1 mb-2" title="Download PDF" target="_blank" style="color: #fff; margin-right: 5px" href="lab/viewReport?id=' . $lab->id . '"><i class="fas fa-eye"></i> ' . lang('view') . '</a>';
            $options4  = '<a class="btn btn-sm btn-warning invoicebutton mr-1 mb-2" title="Download PDF" style="color: #fff; margin-right: 5px" href="lab/testPdf?id=' . $lab->id . '"> <i class="fas fa-file-pdf"></i> PDF</a>';


            // $options2 = '<a class="btn btn-sm invoicebutton" title="Download PDF" target="_blank" style="color: #fff; margin-right: 5px" href="lab/viewReport?id=' . $lab->id . '"><i class="fas fa-eye"></i> ' . lang('view') . '</a>'
            // . '<a class="btn btn-sm invoicebutton" title="Download PDF" style="color: #fff; margin-right: 5px" href="lab/testPdf?id=' . $lab->id . '"> <i class="fas fa-file-pdf"></i> PDF</a>'
            // . '<a class="btn btn-sm invoicebutton" title="Download Word" style="color: #fff; margin-right: 5px" href="lab/makeWord?id=' . $lab->id . '">  <i class="fas fa-file-word"></i> Word</a>';


            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-info btn-sm delete_button mr-1 mb-2" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }

            $options3 = "";
            if ($this->ion_auth->in_group(array('Laboratorist'))) {
                $options3 = '<a class="btn btn-success btn-sm signBtn mr-2 mb-2" href="lab/signLab?id=' . $lab->id . '">Sign</a>';
            }

            $doctor_info = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }

            $patient_info = $this->patient_model->getPatientById($lab->patient);
            if (!empty($patient_info)) {
                $age = explode('-', $patient_info->age);
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>' . $age[0] . '</br>';
                $patient_name = $patient_info->name;
                $patient_phone = $patient_info->phone;
            } else {
                $patient_details = ' ';
                $patient_name = ' ';
                $patient_phone = ' ';
            }

            $invoice_details = "";
            if ($lab->invoice_id != null) {
                $invoice_details = $this->db->get_where('payment', array('id' => $lab->invoice_id))->row();
                if ($invoice_details) {
                    $invoice_deposit = $this->db->get_where('patient_deposit', array('payment_id' => $lab->invoice_id))->result();
                    if (empty($invoice_deposit)) {
                        $total_deposit = '0';
                    } else {
                        foreach ($invoice_deposit as $deposit_amount) {
                            $deposit[] = $deposit_amount->deposited_amount;
                        }
                        $total_deposit = array_sum($deposit);
                    }
                    $invoice_date_time = date('d-m-y h:i A', $invoice_details->date);
                } else {
                    $invoice_details = "";
                    $invoice_date_time = "";
                }
            } else {
                $invoice_date_time = "";
            }



            $bill_status = "";
            if (!empty($invoice_details)) {
                if (($invoice_details->gross_total - $total_deposit) > 0) {
                    $bill_status =  '<span class="badge badge-danger">' . lang('due_have') . '</span>';
                } else {
                    $bill_status = '<span class="badge badge-success">' . lang('paid') . '</span>';
                }
            }


            if ($lab->category_id != null) {
                $test_name = $this->finance_model->getPaymentCategoryById($lab->category_id);
                $test_name = $test_name->category;
            } else {
                $test_name = "";
            }



            $status = "";
            if ($lab->status == "pending") {
                $status = '<span class="badge badge-danger">' . lang('pending') . '</span>';
            } else if ($lab->status == "drafted") {
                $status = '<span class="badge badge-warning">' . lang('drafted') . '</span>';
            } else {
                $status = '<span class="badge badge-success">' . lang('completed') . '</span>';
            }

            $reported_by = "";
            if ($lab->reported_by != null) {
                $reported_by = $this->db->get_where('users', array('id' => $lab->reported_by))->row();
                if (isset($reported_by->id)) {
                    $reported_by = $reported_by->username;
                }
            }


            $dropdownOptions = '';
            $dropdownOptions = '
            <div class="btn-group">
            <button type="button" class="btn btn-info btn-sm label-primary dropdown-toggle action_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="">
            <i class="fas fa-bars"></i> ' . lang('actions') . ' <span class="caret"></span>
        </button>
                <ul class="dropdown-menu">
                    ' . ($options1 ? '<li><a  style="margin-right: 10px" title="' . lang('report') . '" href="lab?id=' . $lab->id . '">  <i class="fa fa-edit"></i> ' . lang('report') . ' ' . lang('') . '</a></li>' : '') . '
                    ' . ($options2 ? '<li><a title="' . lang('view') . ' ' . lang('report') . '" target="_blank" href="lab/viewReport?id=' . $lab->id . '"> <i class="fa fa-eye"></i> ' . lang('view') . ' </a></li>' : '') . '
                    ' . ($options4 ? '<li><a href="lab/pdfLabel?id=' . $lab->id . '".> <i class="fa fa-file-pdf"></i> ' . lang('download') . ' </a></li>' : '') . '
                </ul>
            </div>';



            if( $lab->updated_on != null){
                if ($this->settings->time_format == 24) {
                    $lab_updated_on = date('d-m-y H:i', $lab->updated_on);
                }else{
                    $lab_updated_on = date('d-m-y h:i A', $lab->updated_on);
                }
            }else{
                $lab_updated_on = '';
            }




            $info[] = array(
                isset($patient_info->id) ? $patient_info->id : "",
                //$patient_details,
                $patient_name,
                $patient_phone,
                $lab->invoice_id,
                $invoice_date_time,
                $test_name,
                $bill_status,
                $status,
                //$lab->test_status_date != null ? date('d-m-y h:i A', $lab->test_status_date) : "",
                $lab_updated_on,
                $reported_by,
                // $dropdownOptions
                 $options1 . ' ' . $options2 . ' ' . $options4
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->lab_model->getLabByTestStatus('done')),
                "recordsFiltered" => count($this->lab_model->getLabByTestStatus('done')),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    function signLab()
    {
        $id = $this->input->get("id");
        $data = array(
            'signed_by' => $this->ion_auth->get_user_id()
        );
        $this->db->where('id', $id);
        $this->db->update('lab', $data);
       show_swal(lang('updated'), 'success', lang('updated'));
        redirect('lab');
    }

    function getTemplate()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $user_id = $_GET['user_id'];
        $category = $_GET['category'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "name",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['templates'] = $this->lab_model->getTemplateBysearch($search, $order, $dir, $user_id, $category);
            } else {
                $data['templates'] = $this->lab_model->getTemplateWithoutSearch($order, $dir, $user_id, $category);
            }
        } else {
            if (!empty($search)) {
                $data['templates'] = $this->lab_model->getTemplateByLimitBySearch($limit, $start, $search, $order, $dir, $user_id, $category);
            } else {
                $data['templates'] = $this->lab_model->getTemplateByLimit($limit, $start, $order, $dir, $user_id, $category);
            }
        }

        $i = 0;
        foreach ($data['templates'] as $template) {
            $i = $i + 1;
            $option1 = '<a href="lab/editTemplate?id=' . $template->id . '" class="btn btn-primary btn-sm btn_width editbutton" title="' . lang('edit') . '" data-id="' . $template->id . '"><i class="fa fa-edit"> </i></a>';
            $option2 = '<a class="btn btn-danger btn-sm btn_width delete_button" title="' . lang('delete') . '" href="lab/deleteTemplate?id=' . $template->id . '" onclick="return confirm("Are you sure you want to delete this item?");"><i class="fa fa-trash"> </i></a>';

            $user = $this->db->get_where('users', array('id' => $template->user))->row();
            if (isset($user->id)) {
                $user = $user->username;
            }

            $category_name = "";
            if ($template->category_id > 0) {
                $category_name = $this->finance_model->getCategoryById($template->category_id);
                $category_name = $category_name->category;
            }


            $dropdownOptions = '';
            $dropdownOptions = '
            <div class="btn-group">
            <button type="button" class="btn btn-info btn-sm label-primary dropdown-toggle action_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="">
            <i class="fas fa-bars"></i> ' . lang('actions') . ' <span class="caret"></span>
        </button>
                <ul class="dropdown-menu">
                    ' . ($option1 ? '<li><a  style="margin-right: 10px" href="lab/editTemplate?id=' . $template->id . '">  <i class="fa fa-edit"></i> ' . lang('edit') . ' ' . lang('') . '</a></li>' : '') . '
                    ' . ($option2 ? '<li><a href="lab/deleteTemplate?id=' . $template->id . '"> <i class="fa fa-trash"></i> ' . lang('delete') . ' </a></li>' : '') . '
                </ul>
            </div>';

            $info[] = array(
                $template->name,
                $category_name,
                $user,
                // $dropdownOptions
                $option1 . ' ' . $option2
            );
        }


        if (!empty($data['templates'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->lab_model->getTemplateCount($user_id, $category)),
                "recordsFiltered" => count($this->lab_model->getTemplate()),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    function getDeliveryReport()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $status = $_GET['status'];
        $category = $_GET['category'];
        $from = $_GET['from'];
        $to = $_GET['to'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "2" => "date",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getDeliveryReportBysearch($search, $order, $dir, $status, $category, $from, $to);
            } else {
                $data['labs'] = $this->lab_model->getDeliveryReportWithoutSearch($order, $dir, $status, $category, $from, $to);
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getDeliveryReportByLimitBySearch($limit, $start, $search, $order, $dir, $status, $category, $from, $to);
            } else {
                $data['labs'] = $this->lab_model->getDeliveryReportByLimit($limit, $start, $order, $dir, $status, $category, $from, $to);
            }
        }

        $i = 0;
        foreach ($data['labs'] as $lab) {
            $i = $i + 1;
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) {
                $options1 = ' <a class="btn btn-primary btn-sm editbutton" title="' . lang('edit') . '" href="lab?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('report') . '</a>';
            } else {
                $options1 = '';
            }

            $options2 = '<a class="btn btn-secondary btn-sm" title="' . lang('lab') . '" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('view') . '</a>';
            $options2 = '<a class="btn btn-warning btn-sm mr-1" title="Download PDF" href="lab/viewReport?id=' . $lab->id . '"><i class="fa fa-eye"></i> ' . lang('view') . '</a>';
            $options4 = '<a class="btn btn-secondary btn-sm invoicebutton" title="Download PDF" href="lab/testPdf?id=' . $lab->id . '"> <i class="fa fa-file-pdf"></i> PDF</a>';;

            // $options2 = '<a class="btn btn-sm invoicebutton" title="Download PDF" style="color: #fff;" href="lab/viewReport?id=' . $lab->id . '"><i class="fas fa-eye"></i></a>'
            //     . '<a class="btn btn-sm invoicebutton" title="Download PDF" style="color: #fff;" href="lab/testPdf?id=' . $lab->id . '"> PDF</a>'
            //     . '<a class="btn btn-sm invoicebutton" title="Download Word" style="color: #fff; margin-right: 5px" href="lab/makeWord?id=' . $lab->id . '"> Word</a>';

            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-danger btn-sm delete_button" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }

            $options3 = "";

            if ($lab->delivery_status == 'pending' || ($lab->delivery_status == 'delivered' && $lab->receiver_name == null)) {
                $options3 .= ' <a class="btn btn-success btn-sm changeDeliveryStatus" data-id="' . $lab->id . '"><i class="fas fa-check"></i> ' . lang('deliver') . '</a>';
            } else {
                $options3 .= ' <a class="btn btn-success btn-sm changeDeliveryStatus" data-id="' . $lab->id . '"><i class="fas fa-check"></i> ' . lang('deliver') . '</a>';
            }


            $doctor_info = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }

            $patient_info = $this->patient_model->getPatientById($lab->patient);
            if (!empty($patient_info)) {
                $age = explode('-', $patient_info->age);
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>' . $age[0] . '</br>';
            } else {
                $patient_details = ' ';
            }

            $invoice_details = "";
            if ($lab->invoice_id != null) {
                $invoice_details = $this->db->get_where('payment', array('id' => $lab->invoice_id))->row();
                $invoice_deposit = $this->db->get_where('patient_deposit', array('payment_id' => $lab->invoice_id))->result();
                if (empty($invoice_deposit)) {
                    $total_deposit = '0';
                } else {
                    foreach ($invoice_deposit as $deposit_amount) {
                        $deposit[] = $deposit_amount->deposited_amount;
                    }
                    $total_deposit = array_sum($deposit);
                }
                $invoice_date_time = date('d-m-y h:i A', $invoice_details->date);
            } else {
                $invoice_date_time = "";
            }

            $bill_status = "";
            if (!empty($invoice_details)) {
                if (($invoice_details->gross_total - $total_deposit) > 0) {
                    $bill_status =  '<span class="badge badge-danger">' . lang('due_have') . '</span>';
                } else {
                    $bill_status = '<span class="badge badge-success">' . lang('paid') . '</span>';
                }
            }


            if ($lab->category_id != null) {
                $test_name = $this->finance_model->getPaymentCategoryById($lab->category_id);
                $test_name = $test_name->category;
            } else {
                $test_name = "";
            }


            $status = "";
            if ($lab->delivery_status == "pending") {
                $status = '<select class="form-control delivery_status" data-id="' . $lab->id . '"><option value="pending" selected>' . lang('pending') . '</option><option value="delivered">' . lang('delivered') . '</option></select>';
            } else if ($lab->delivery_status == "delivered") {
                $status = '<select class="form-control delivery_status" data-id="' . $lab->id . '"><option value="pending">' . lang('pending') . '</option><option value="delivered" selected>' . lang('delivered') . '</option></select>';
                //$status .= '<span class="label label-success">' . lang('delivered') . '</span>';
            }



            $dropdownOptions = '';
            $dropdownOptions = '
            <div class="btn-group">
            <button type="button" class="btn btn-info btn-sm label-primary dropdown-toggle action_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="">
            <i class="fas fa-bars"></i> ' . lang('actions') . ' <span class="caret"></span>
        </button>
                <ul class="dropdown-menu">
                    ' . ($options1 ? '<li><a href="lab?id=' . $lab->id . '">  <i class="fa fa-edit"></i> ' . lang('edit') . ' ' . lang('report') . '</a></li>' : '') . '
                    ' . ($options2 ? '<li><a href="lab/viewReport?id=' . $lab->id . '"> <i class="fa fa-eye"></i> ' . lang('view') . ' </a></li>' : '') . '
                    ' . ($options4 ? '<li><a href="lab/testPdf?id=' . $lab->id . '"> <i class="fa fa-file-pdf"></i> ' . lang('download') . ' </a></li>' : '') . '
                    ' . ($options3 ? '<li><a class="changeDeliveryStatus" data-id="' . $lab->id . '" title="' . lang('deliver') . '"><i class="fas fa-handshake"></i> ' . lang('deliver') . ' ' . lang('report') . ' </a></li>' : '') . '
                </ul>
            </div>';

            if($lab->delivery_status_date != null){
                if ($this->settings->time_format == 24) {
                    $lab_delivery_status_date = date('d-m-y H:i', $lab->delivery_status_date);
                }else{
                    $lab_delivery_status_date = date('d-m-y h:i A', $lab->delivery_status_date);
                }
            }else{
                $lab_delivery_status_date = '';
            }


            $info[] = array(  
                isset($patient_info->id) ? $patient_info->id : "",
                $patient_details,
                $lab->invoice_id,
                $invoice_date_time,
                $test_name,
                $bill_status,
                '<span class="badge badge-success">' . lang('completed') . '</span>',
                $status,
                $lab_delivery_status_date,
                $lab->receiver_name,
                $options1 . ' ' . $options2 . '' . $options4 . ' ' . $options3,
                // $dropdownOptions
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->lab_model->getDeliveryReport($status, $category, $from, $to)),
                "recordsFiltered" => count($this->lab_model->getLabByReportStatus('completed')),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    function reportDelivery()
    {
        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        //$data['categories'] = $this->lab_model->getLabCategory();
        $data['categories'] = $this->finance_model->getCategory();
        $data['payment_categories'] = $this->finance_model->getPaymentCategory();
        $this->load->view('home/dashboard');
        $this->load->view('report_delivery', $data);
        $this->load->view('home/footer');
    }

    function changeTestStatus()
    {
        $id = $this->input->post("id");
        $status = $this->input->post('status');
        $done_by = $this->input->post('done_by');

        $this->lab_model->changeTestStatus($id, $status, $done_by);

        echo json_encode('success');
    }

    function changeReportStatus()
    {
        $id = $this->input->post("id");
        $status = $this->input->post('status');

        $this->lab_model->changeReportStatus($id, $status);

        echo json_encode('success');
    }

    function changeDeliveryStatus()
    {
        $name = $this->input->post('receiver_name');
        $id = $this->input->post('id');
        $lab = $this->lab_model->getLabById($id);
        $check = $this->input->post("check");

        if ($check == 1) {
            $status = $this->input->post('status');
            if ($status == 'delivered') {
                $data = array(
                    'delivery_status_date' => strtotime(date('Y-m-d H:i:s')),
                    'delivery_status' => "delivered"
                );
                $this->lab_model->changeDeliveryStatus($id, $data);
            } else {
                $data = array(
                    'receiver_name' => null,
                    'delivery_status_date' => null,
                    'delivery_status' => "pending"
                );

                $this->lab_model->changeDeliveryStatus($id, $data);
            }

            echo json_encode("success");
        } else {
            if (trim($name)) {
                if ($lab->delivery_status == 'delivered') {
                    $data = array(
                        'receiver_name' => $name,
                        'delivery_status' => "delivered"
                    );
                } else {
                    $data = array(
                        'receiver_name' => $name,
                        'delivery_status_date' => strtotime(date('Y-m-d H:i:s')),
                        'delivery_status' => "delivered"
                    );
                }


                $this->lab_model->changeDeliveryStatus($id, $data);
            } else {
                $data = array(
                    'receiver_name' => null,
                    'delivery_status_date' => null,
                    'delivery_status' => "pending"
                );

                $this->lab_model->changeDeliveryStatus($id, $data);
            }

            redirect('lab/reportDelivery');
        }
    }

    public function index()
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        // if ($this->ion_auth->in_group(array('Receptionist'))) {
        //     redirect('lab/lab1');
        // }

        $id = $this->input->get('id');

        if (!empty($id)) {
            $lab_details = $this->lab_model->getLabById($id);
            if ($lab_details->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            }
        }

        $data['settings'] = $this->settings_model->getSettings();
        $data['labs'] = $this->lab_model->getLab();

        if (!empty($id)) {
            $data['lab_single'] = $this->lab_model->getLabById($id);
            $data['lab'] = $this->lab_model->getLabById($id);
            $data['patients'] = $this->patient_model->getPatientById($data['lab_single']->patient);
            $data['doctors'] = $this->doctor_model->getDoctorById($data['lab_single']->doctor);
        }

        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        $data['categories'] = $this->finance_model->getCategory();
        $data['payment_categories'] = $this->finance_model->getPaymentCategory();
        $data['macros'] = $this->macro_model->getMacro();

        if (!empty($id)) {
            $this->load->view('home/dashboard');
            $this->load->view('add_lab_view', $data);
            $this->load->view('home/footer');
        } else {
            $this->load->view('home/dashboard');
            $this->load->view('lab', $data);
            $this->load->view('home/footer');
        }
    }

    public function pendingLab()
    {
        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        $this->load->view('home/dashboard');
        $this->load->view('pending_lab', $data);
        $this->load->view('home/footer');
    }

    public function waitingLab()
    {
        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        $this->load->view('home/dashboard');
        $this->load->view('waiting_lab', $data);
        $this->load->view('home/footer');
    }

    public function completedLab()
    {
        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        $this->load->view('home/dashboard');
        $this->load->view('completed_lab', $data);
        $this->load->view('home/footer');
    }

    public function sampleCollectedLab()
    {
        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        $this->load->view('home/dashboard');
        $this->load->view('sample_collected_lab', $data);
        $this->load->view('home/footer');
    }

    public function deliveredLab()
    {
        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        $this->load->view('home/dashboard');
        $this->load->view('delivered_lab', $data);
        $this->load->view('home/footer');
    }

    public function deliveryPendingLab()
    {
        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        $this->load->view('home/dashboard');
        $this->load->view('delivery_pending_lab', $data);
        $this->load->view('home/footer');
    }

    public function lab()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        $id = $this->input->get('id');

        if (!empty($id)) {
            $lab_details = $this->lab_model->getLabById($id);
            if ($lab_details->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            }
        }

        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();

        $data['settings'] = $this->settings_model->getSettings();
        $data['labs'] = $this->lab_model->getLab();

        if (!empty($id)) {
            $this->load->view('home/dashboard');
            $this->load->view('add_lab_view', $data);
            $this->load->view('home/footer');
        } else {
            $this->load->view('home/dashboard');
            $this->load->view('lab', $data);
            $this->load->view('home/footer');
        }
    }

    public function lab1()
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $id = $this->input->get('id');

        $data['settings'] = $this->settings_model->getSettings();
        $data['labs'] = $this->lab_model->getLab();

        if (!empty($id)) {
            $data['lab_single'] = $this->lab_model->getLabById($id);
        }

        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();

        $this->load->view('home/dashboard');
        $this->load->view('lab_1', $data);
        $this->load->view('home/footer');
    }

    public function addLabView()
    {
        $data = array();

        $id = $this->input->get('id');

        if (!empty($id)) {
            $data['lab'] = $this->lab_model->getLabById($id);
            $data['patients'] = $this->patient_model->getPatientById($data['lab_single']->patient);
            $data['doctors'] = $this->doctor_model->getDoctorById($data['lab_single']->doctor);
        }

        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        // $data['patients'] = $this->patient_model->getPatient();
        // $data['doctors'] = $this->doctor_model->getDoctor();
        $this->load->view('home/dashboard');
        $this->load->view('add_lab_view', $data);
        $this->load->view('home/footer');
    }

    public function labReportById()
    {
        $id = $this->input->get('id');
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['lab'] = $this->lab_model->getLabById($id);
        return $this->load->view('reportForLoad', $data);
    }

    public function addLab()
    {
        $id = $this->input->post('id');

        $report = $this->input->post('report');
        $status = $this->input->post('status');

        $patient = $this->input->post('patient');

        $redirect = $this->input->post('redirect');

        $p_name = $this->input->post('p_name');
        $birthdate = $this->input->post('birthdate');
        if (empty($birthdate)) {
            $years = $this->input->post('years');
            $months = $this->input->post('months');
            $days = $this->input->post('days');
            if (empty($years)) {
                $years = '0';
            }
            if (empty($months)) {
                $months = '0';
            }
            if (empty($days)) {
                $days = '0';
            }
        } else {
            $dateOfBirth = $birthdate;
            $today = date("Y-m-d");
            $diff = date_diff(date_create($dateOfBirth), date_create($today));
            $years = $diff->format('%y');
            $months = $diff->format('%m');
            $days = $diff->format('%d');
        }
        $age = $years . '-' . $months . '-' . $days;
        $p_email = $this->input->post('p_email');
        if (empty($p_email)) {
            $p_email = $p_name . '-' . rand(1, 1000) . '-' . $p_name . '-' . rand(1, 1000) . '@example.com';
        }
        if (!empty($p_name)) {
            $password = $p_name . '-' . rand(1, 100000000);
        }
        $p_phone = $this->input->post('p_phone');
        $p_age = $this->input->post('p_age');
        $p_gender = $this->input->post('p_gender');
        $add_date = date('m/d/y');

        $patient_id = rand(10000, 1000000);

        $d_name = $this->input->post('d_name');
        $d_email = $this->input->post('d_email');
        if (empty($d_email)) {
            $d_email = $d_name . '-' . rand(1, 1000) . '-' . $d_name . '-' . rand(1, 1000) . '@example.com';
        }
        if (!empty($d_name)) {
            $password = $d_name . '-' . rand(1, 100000000);
        }
        $d_phone = $this->input->post('d_phone');

        $doctor = $this->input->post('doctor');
        $date = $this->input->post('date');
        if (!empty($date)) {
            $date = strtotime($date);
        } else {
            $date = time();
        }
        $date_string = date('d-m-y', $date);
        $discount = $this->input->post('discount');
        $amount_received = $this->input->post('amount_received');
        $user = $this->ion_auth->get_user_id();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->form_validation->set_rules('patient', 'Patient', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Price Field
        $this->form_validation->set_rules('discount', 'Discount', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            redirect('lab/addLabView');
        } else {
            if ($patient == 'add_new') {

                $data_p = array(
                    'patient_id' => $patient_id,
                    'name' => $p_name,
                    'email' => $p_email,
                    'phone' => $p_phone,
                    'sex' => $p_gender,
                    'age' => $p_age,
                    'add_date' => $add_date,
                    'birthdate' => $birthdate,
                    'how_added' => 'from_pos',
                    'payment_confirmation' => 'Active',
                    'appointment_confirmation' => 'Active',
                    'appointment_creation' => 'Active',
                    'meeting_schedule' => 'Active',
                    'age' => $age
                );
                $username = $this->input->post('p_name');

                if ($this->ion_auth->email_check($p_email)) {
                    show_swal(lang('this_email_address_is_already_registered'), 'error', lang('error'));
                } else {
                    $dfg = 5;
                    $this->ion_auth->register($username, $password, $p_email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $p_email))->row()->id;
                    $this->patient_model->insertPatient($data_p);
                    $patient_user_id = $this->db->get_where('patient', array('email' => $p_email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->patient_model->updatePatient($patient_user_id, $id_info);
                    $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                }
                //    }
            }

            if (!empty($d_name)) {

                $limit = $this->doctor_model->getLimit();
                if ($limit <= 0) {
                   show_swal(lang('doctor_limit_exceed'), 'error', lang('error'));
                    redirect('doctor');
                }

                $data_d = array(
                    'name' => $d_name,
                    'email' => $d_email,
                    'phone' => $d_phone,
                    'appointment_confirmation' => 'Active',
                );
                $username = $this->input->post('d_name');

                if ($this->ion_auth->email_check($d_email)) {
                    show_swal(lang('this_email_address_is_already_registered'), 'error', lang('error'));
                } else {
                    $dfgg = 4;
                    $this->ion_auth->register($username, $password, $d_email, $dfgg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $d_email))->row()->id;
                    $this->doctor_model->insertDoctor($data_d);
                    $doctor_user_id = $this->db->get_where('doctor', array('email' => $d_email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->doctor_model->updateDoctor($doctor_user_id, $id_info);
                    $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                }
            }


            if ($patient == 'add_new') {
                $patient = $patient_user_id;
            }

            if ($doctor == 'add_new') {
                $doctor = $doctor_user_id;
            }

            if (!empty($patient)) {
                $patient_details = $this->patient_model->getPatientById($patient);
                $patient_name = $patient_details->name;
                $patient_phone = $patient_details->phone;
                $patient_address = $patient_details->address;
            } else {
                $patient_name = 0;
                $patient_phone = 0;
                $patient_address = 0;
            }

            if (!empty($doctor)) {
                $doctor_details = $this->doctor_model->getDoctorById($doctor);
                $doctor_name = $doctor_details->name;
            } else {
                $doctor_name = 0;
            }

            $data = array();

            if (empty($id)) {
                $data = array(
                    'report' => $report,
                    'patient' => $patient,
                    'date' => $date,
                    'doctor' => $doctor,
                    'user' => $user,
                    'patient_name' => $patient_name,
                    'patient_phone' => $patient_phone,
                    'patient_address' => $patient_address,
                    'doctor_name' => $doctor_name,
                    'date_string' => $date_string,
                    'status' => $status
                );

                $this->lab_model->insertLab($data);
                $inserted_id = $this->db->insert_id();

                show_swal(lang('added'), 'success', lang('added'));
                redirect($redirect);
            } else {
                $currentLab = $this->lab_model->getLabById($id);
                $status = "pending";
                $updated_on = $currentLab->updated_on;
                $reported_by = $currentLab->reported_by;
                if ($this->input->post('submission_type') == 'draft') {
                    $status = 'drafted';
                    $updated_on = strtotime(date('Y-m-d H:i:s'));
                    $reported_by = $this->ion_auth->get_user_id();
                } else if ($this->input->post('submission_type') == 'submit') {
                    $status = 'completed';
                    $updated_on = strtotime(date('Y-m-d H:i:s'));
                    $reported_by = $this->ion_auth->get_user_id();
                } else if ($this->input->post('submission_type') == 'template') {
                    $test_name = $this->db->get_where('payment_category', array('id' => $currentLab->category_id))->row();
                    if (isset($test_name->category)) {
                        $test_name = $test_name->category;
                    } else {
                        $test_name = "";
                    }
                    $template_data = array(
                        'name' => $this->input->post('template_name'),
                        'category_id' => $this->input->post('template_category'),
                        'template' => $report,
                        'user' => $this->ion_auth->get_user_id()
                    );
                    $this->lab_model->insertTemplate($template_data);
                }

                $delivery_status = '';
                if ($status == 'completed') {
                    $delivery_status = 'pending';
                } else {
                    $delivery_status = null;
                }

                $data = array(
                    //   'category_name' => $category_name,
                    'report' => $report,
                    'patient' => $patient,
                    'doctor' => $doctor,
                    'user' => $user,
                    'patient_name' => $patient_details->name,
                    'patient_phone' => $patient_details->phone,
                    'patient_address' => $patient_details->address,
                    'doctor_name' => $doctor_details->name,
                    'status' => $status,
                    'delivery_status' => $delivery_status,
                    'updated_on' => $updated_on,
                    'reported_by' => $reported_by
                );
                $this->lab_model->updateLab($id, $data);
               show_swal(lang('updated'), 'success', lang('updated'));
                redirect($redirect);
            }
        }
    }

    function editLab()
    {
        if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist', 'Nurse', 'Patient'))) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $data['categories'] = $this->lab_model->getLabCategory();
            $data['patients'] = $this->patient_model->getPatient();
            $data['doctors'] = $this->doctor_model->getDoctor();
            $id = $this->input->get('id');
            $data['lab'] = $this->lab_model->getLabById($id);
            $this->load->view('home/dashboard');
            $this->load->view('add_lab_view', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function delete()
    {
        if ($this->ion_auth->in_group(array('admin', 'Laboratorist'))) {
            $id = $this->input->get('id');

            $lab_details = $this->lab_model->getLabById($id);
            if ($lab_details->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            }

            $this->lab_model->deleteLab($id);
           show_swal(lang('deleted'), 'warning', lang('deleted'));
            redirect('lab/lab');
        } else {
            redirect('home/permission');
        }
    }

    public function template()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['templates'] = $this->lab_model->getTemplate();

        $arr = [4, 8, 11];
        $this->db->where_in('group_id', $arr);
        $user_ids = $this->db->get('users_groups')->result();

        //        print_r($user_ids);
        //        die();

        $data['users'] = array();
        $hospital_ion_id = $this->db->get_where('hospital', array('id' => $this->session->userdata('hospital_id')))->row();

        foreach ($user_ids as $user_id) {
            if ($user_id->user_id == $hospital_ion_id->ion_user_id) {
                $this->db->where('id', $user_id->user_id);
                $user = $this->db->get('users')->row();
                if (isset($user->id)) {
                    array_push($data['users'], $user);
                }
            } else {
                $this->db->where('hospital_ion_id', $hospital_ion_id->ion_user_id);
                $this->db->where('id', $user_id->user_id);
                $user = $this->db->get('users')->row();
                if (isset($user->id)) {
                    array_push($data['users'], $user);
                }
            }
        }

        $data['categories'] = $this->finance_model->getCategory();
        $data['payment_categories'] = $this->finance_model->getPaymentCategory();

        $this->load->view('home/dashboard');
        $this->load->view('template', $data);
        $this->load->view('home/footer');
    }

    public function addTemplateView()
    {
        $data = array();
        $id = $this->input->get('id');
        if (!empty($id)) {
            $data['template'] = $this->lab_model->getTemplateById($id);
        }

        $data['categories'] = $this->finance_model->getCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard');
        $this->load->view('add_template', $data);
        $this->load->view('home/footer');
    }

    function getTemplateByIdByJason()
    {
        $id = $this->input->get('id');
        $data['template'] = $this->lab_model->getTemplateById($id);
        echo json_encode($data);
    }

    public function addTemplate()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $template = $this->input->post('template');
        $category_id = $this->input->post('category_id');
        $user = $this->ion_auth->get_user_id();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('report', 'Report', 'trim|min_length[1]|max_length[10000]|xss_clean');

        $this->form_validation->set_rules('user', 'User', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            redirect('lab/addTemplate');
        } else {
            $data = array();
            if (empty($id)) {
                $data = array(
                    'name' => $name,
                    'template' => $template,
                    'user' => $user,
                    'category_id' => $category_id
                );
                $this->lab_model->insertTemplate($data);
                $inserted_id = $this->db->insert_id();
                show_swal(lang('added'), 'success', lang('added'));
                //redirect("lab/addTemplateView?id=" . "$inserted_id");
                redirect("lab/template");
            } else {
                $data = array(
                    'name' => $name,
                    'template' => $template,
                    'user' => $user,
                    'category_id' => $category_id
                );
                $this->lab_model->updateTemplate($id, $data);
               show_swal(lang('updated'), 'success', lang('updated'));
                //redirect("lab/addTemplateView?id=" . "$id");
                redirect("lab/template");
            }
        }
    }

    function editTemplate()
    {
        if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist', 'Nurse', 'Patient'))) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $id = $this->input->get('id');
            $data['template'] = $this->lab_model->getTemplateById($id);
            $data['categories'] = $this->finance_model->getCategory();
            $this->load->view('home/dashboard');
            $this->load->view('add_template', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function deleteTemplate()
    {
        $id = $this->input->get('id');
        $this->lab_model->deleteTemplate($id);
       show_swal(lang('deleted'), 'warning', lang('deleted'));
        redirect('lab/template');
    }

    public function labCategory()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['categories'] = $this->lab_model->getLabCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard');
        $this->load->view('lab_category', $data);
        $this->load->view('home/footer');
    }

    public function addLabCategoryView()
    {
        $this->load->view('home/dashboard');
        $this->load->view('add_lab_category');
        $this->load->view('home/footer');
    }

    public function addLabCategory()
    {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');
        $reference = $this->input->post('reference_value');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('reference_value', 'Reference Value', 'trim|required|min_length[1]|max_length[1000]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('type', 'Type', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                show_swal('feedback', lang('vaidation_error'));
                redirect('lab/editLabCategory?id=' . $id);
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard');
                $this->load->view('add_lab_category', $data);
                $this->load->view('home/footer');
            }
        } else {
            $data = array();
            $data = array(
                'category' => $category,
                'description' => $description,
                'reference_value' => $reference,
            );
            if (empty($id)) {
                $this->lab_model->insertLabCategory($data);
                show_swal(lang('added'), 'success', lang('added'));
            } else {
                $this->lab_model->updateLabCategory($id, $data);
               show_swal(lang('updated'), 'success', lang('updated'));
            }
            redirect('lab/labCategory');
        }
    }

    function editLabCategory()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['category'] = $this->lab_model->getLabCategoryById($id);

        if (!empty($data['category']->hospital_id)) {
            if ($data['category']->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            } else {
                $this->load->view('home/dashboard');
                $this->load->view('add_lab_category', $data);
                $this->load->view('home/footer'); // just the footer file
            }
        } else {
            redirect('home/permission');
        }
    }

    function deleteLabCategory()
    {
        $id = $this->input->get('id');
        $data['category'] = $this->lab_model->getLabCategoryById($id);
        if ($data['category']->hospital_id != $this->session->userdata('hospital_id')) {
            redirect('home/permission');
        }
        $this->lab_model->deleteLabCategory($id);
        redirect('lab/labCategory');
    }

    function invoice()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['lab'] = $this->lab_model->getLabById($id);

        if ($data['lab']->hospital_id != $this->session->userdata('hospital_id')) {
            $this->load->view('home/permission');
        }

        $this->load->view('home/dashboard');
        $this->load->view('invoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function patientLabHistory()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $patient = $this->input->get('patient');
        if (empty($patient)) {
            $patient = $this->input->post('patient');
        }

        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 86399;
        }

        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;

        if (!empty($date_from)) {
            $data['labs'] = $this->lab_model->getLabByPatientIdByDate($patient, $date_from, $date_to);
            $data['deposits'] = $this->lab_model->getDepositByPatientIdByDate($patient, $date_from, $date_to);
        } else {
            $data['labs'] = $this->lab_model->getLabByPatientId($patient);
            $data['pharmacy_labs'] = $this->pharmacy_model->getLabByPatientId($patient);
            $data['ot_labs'] = $this->lab_model->getOtLabByPatientId($patient);
            $data['deposits'] = $this->lab_model->getDepositByPatientId($patient);
        }



        $data['patient'] = $this->patient_model->getPatientByid($patient);
        $data['settings'] = $this->settings_model->getSettings();

        $this->load->view('home/dashboard');
        $this->load->view('patient_deposit', $data);
        $this->load->view('home/footer');
    }

    function financialReport()
    {
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 86399;
        }
        $data = array();
        $data['lab_categories'] = $this->lab_model->getLabCategory();
        $data['expense_categories'] = $this->lab_model->getExpenseCategory();

        $data['labs'] = $this->lab_model->getLabByDate($date_from, $date_to);
        $data['ot_labs'] = $this->lab_model->getOtLabByDate($date_from, $date_to);
        $data['deposits'] = $this->lab_model->getDepositsByDate($date_from, $date_to);
        $data['expenses'] = $this->lab_model->getExpenseByDate($date_from, $date_to);

        $data['from'] = $this->input->post('date_from');
        $data['to'] = $this->input->post('date_to');
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard');
        $this->load->view('financial_report', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function getLab2()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "2" => "date",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getLabBysearch($search, $order, $dir);
            } else {
                $data['labs'] = $this->lab_model->getLabWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getLabByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['labs'] = $this->lab_model->getLabByLimit($limit, $start, $order, $dir);
            }
        }

        $i = 0;
        foreach ($data['labs'] as $lab) {
            $i = $i + 1;
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) {
                $options1 = ' <a class="btn btn-info btn-sm editbutton" title="' . lang('edit') . '" href="lab?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';
            } else {
                $options1 = '';
            }

            $options2 = '<a class="btn btn-sm invoicebutton" title="' . lang('lab') . '" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('') . '</a>';
            $options2 = '<a class="btn btn-sm invoicebutton" title="Download PDF" style="color: #fff;" href="lab/testPdf?id=' . $lab->id . '"><i class="fas fa-eye"></i> PDF</a>';

            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-info btn-sm delete_button" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }

            $doctor_info = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }

            if ($lab->status == 'sample_taken') {
                $status = '<span class="badge badge-primary">' . lang('sample_collected') . '</span>';
            } elseif ($lab->status == 'complete') {
                $status = '<span class="badge badge-info">' . lang('report') . " " . lang('completed') . '</span>';
            } elseif ($lab->status == 'waiting') {
                $status = '<span class="badge badge-danger">' . lang('sample_not_collected') . '</span>';
            } elseif ($lab->status == 'pending') {
                $status = '<span class="badge badge-warning">' . lang('report') . " " . lang('pending') . '</span>';
            } elseif ($lab->status == 'delivery_pending') {
                $status = '<span class="badge badge-danger">' . lang('delivery') . " " . lang('pending') . '</span>';
            } else {
                $status = '<span class="badge badge-success">' . lang('delivered') . '</span>';
            }
            $patient_info = $this->patient_model->getPatientById($lab->patient);
            if (!empty($patient_info)) {
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
            } else {
                $patient_details = ' ';
            }
            $info[] = array(
                $lab->id,
                $patient_details,
                $date,
                $status,
                $options1 . ' ' . $options2 . ' ' . $options3,
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->lab_model->getLab()),
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    function getPendingLab()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "2" => "date",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getPendingLabBysearch($search, $order, $dir);
            } else {
                $data['labs'] = $this->lab_model->getPendingLabWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getPendingLabByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['labs'] = $this->lab_model->getPendingLabByLimit($limit, $start, $order, $dir);
            }
        }

        $i = 0;
        foreach ($data['labs'] as $lab) {
            $i = $i + 1;
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) {
                $options1 = ' <a class="btn btn-info btn-sm editbutton" title="' . lang('edit') . '" href="lab?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';
            } else {
                $options1 = '';
            }

            $options2 = '<a class="btn btn-sm invoicebutton" title="' . lang('lab') . '" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('') . '</a>';
            $options2 = '<a class="btn btn-sm invoicebutton" title="Download PDF" style="color: #fff;" href="lab/testPdf?id=' . $lab->id . '"><i class="fas fa-eye"></i>  PDF</a>';

            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-info btn-sm delete_button" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }

            $doctor_info = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }

            if ($lab->status == 'sample_taken') {
                $status = '<span class="badge badge-primary">' . lang('sample_collected') . '</span>';
            } elseif ($lab->status == 'complete') {
                $status = '<span class="badge badge-info">' . lang('report') . " " . lang('completed') . '</span>';
            } elseif ($lab->status == 'waiting') {
                $status = '<span class="badge badge-danger">' . lang('sample_not_collected') . '</span>';
            } elseif ($lab->status == 'pending') {
                $status = '<span class="badge badge-warning">' . lang('report') . " " . lang('pending') . '</span>';
            } elseif ($lab->status == 'delivery_pending') {
                $status = '<span class="badge badge-danger">' . lang('delivery') . " " . lang('pending') . '</span>';
            } else {
                $status = '<span class="badge badge-success">' . lang('delivered') . '</span>';
            }
            $patient_info = $this->patient_model->getPatientById($lab->patient);
            if (!empty($patient_info)) {
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
            } else {
                $patient_details = ' ';
            }
            $info[] = array(
                $lab->id,
                $patient_details,
                $date,
                $status,
                $options1 . ' ' . $options2 . ' ' . $options3,
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->lab_model->getPendingLab()),
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    function getWaitingLab()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "2" => "date",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getWaitingLabBysearch($search, $order, $dir);
            } else {
                $data['labs'] = $this->lab_model->getWaitingLabWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getWaitingLabByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['labs'] = $this->lab_model->getWaitingLabByLimit($limit, $start, $order, $dir);
            }
        }

        $i = 0;
        foreach ($data['labs'] as $lab) {
            $i = $i + 1;
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) {
                $options1 = ' <a class="btn btn-info btn-sm editbutton" title="' . lang('edit') . '" href="lab?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';
            } else {
                $options1 = '';
            }

            $options2 = '<a class="btn btn-sm invoicebutton" title="' . lang('lab') . '" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('') . '</a>';
            $options2 = '<a class="btn btn-sm invoicebutton" title="Download PDF" style="color: #fff;" href="lab/testPdf?id=' . $lab->id . '"><i class="fas fa-eye"></i>  PDF</a>';

            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-info btn-sm delete_button" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }

            $doctor_info = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }

            if ($lab->status == 'sample_taken') {
                $status = '<span class="badge badge-primary">' . lang('sample_collected') . '</span>';
            } elseif ($lab->status == 'complete') {
                $status = '<span class="badge badge-info">' . lang('report') . " " . lang('completed') . '</span>';
            } elseif ($lab->status == 'waiting') {
                $status = '<span class="badge badge-danger">' . lang('sample_not_collected') . '</span>';
            } elseif ($lab->status == 'pending') {
                $status = '<span class="badge badge-warning">' . lang('report') . " " . lang('pending') . '</span>';
            } elseif ($lab->status == 'delivery_pending') {
                $status = '<span class="badge badge-danger">' . lang('delivery') . " " . lang('pending') . '</span>';
            } else {
                $status = '<span class="badge badge-success">' . lang('delivered') . '</span>';
            }
            $patient_info = $this->patient_model->getPatientById($lab->patient);
            if (!empty($patient_info)) {
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
            } else {
                $patient_details = ' ';
            }
            $info[] = array(
                $lab->id,
                $patient_details,
                $date,
                $status,
                $options1 . ' ' . $options2 . ' ' . $options3,
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->lab_model->getWaitingLab()),
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    function getCompletedLab()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "2" => "date",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getCompletedLabBysearch($search, $order, $dir);
            } else {
                $data['labs'] = $this->lab_model->getCompletedLabWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getCompletedLabByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['labs'] = $this->lab_model->getCompletedLabByLimit($limit, $start, $order, $dir);
            }
        }

        $i = 0;
        foreach ($data['labs'] as $lab) {
            $i = $i + 1;
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) {
                $options1 = ' <a class="btn btn-info btn-sm editbutton" title="' . lang('edit') . '" href="lab?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';
            } else {
                $options1 = '';
            }

            $options2 = '<a class="btn btn-sm invoicebutton" title="' . lang('lab') . '" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('') . '</a>';
            $options2 = '<a class="btn btn-sm invoicebutton" title="Download PDF" style="color: #fff;" href="lab/testPdf?id=' . $lab->id . '"><i class="fas fa-eye"></i>  PDF</a>';

            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-info btn-sm delete_button" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }

            $doctor_info = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }

            if ($lab->status == 'sample_taken') {
                $status = '<span class="badge badge-primary">' . lang('sample_collected') . '</span>';
            } elseif ($lab->status == 'complete') {
                $status = '<span class="badge badge-info">' . lang('report') . " " . lang('completed') . '</span>';
            } elseif ($lab->status == 'waiting') {
                $status = '<span class="badge badge-danger">' . lang('sample_not_collected') . '</span>';
            } elseif ($lab->status == 'pending') {
                $status = '<span class="badge badge-warning">' . lang('report') . " " . lang('pending') . '</span>';
            } elseif ($lab->status == 'delivery_pending') {
                $status = '<span class="badge badge-danger">' . lang('delivery') . " " . lang('pending') . '</span>';
            } else {
                $status = '<span class="badge badge-success">' . lang('delivered') . '</span>';
            }
            $patient_info = $this->patient_model->getPatientById($lab->patient);
            if (!empty($patient_info)) {
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
            } else {
                $patient_details = ' ';
            }
            $info[] = array(
                $lab->id,
                $patient_details,
                $date,
                $status,
                $options1 . ' ' . $options2 . ' ' . $options3,
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->lab_model->getCompletedLab()),
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    function getSampleCollectedLab()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "2" => "date",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getSampleCollectedLabBysearch($search, $order, $dir);
            } else {
                $data['labs'] = $this->lab_model->getSampleCollectedLabWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getSampleCollectedLabByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['labs'] = $this->lab_model->getSampleCollectedLabByLimit($limit, $start, $order, $dir);
            }
        }

        $i = 0;
        foreach ($data['labs'] as $lab) {
            $i = $i + 1;
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) {
                $options1 = ' <a class="btn btn-info btn-sm editbutton" title="' . lang('edit') . '" href="lab?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';
            } else {
                $options1 = '';
            }

            $options2 = '<a class="btn btn-sm invoicebutton" title="' . lang('lab') . '" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('') . '</a>';
            $options2 = '<a class="btn btn-sm invoicebutton" title="Download PDF" style="color: #fff;" href="lab/testPdf?id=' . $lab->id . '"><i class="fas fa-eye"></i>  PDF</a>';

            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-info btn-sm delete_button" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }

            $doctor_info = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }

            if ($lab->status == 'sample_taken') {
                $status = '<span class="badge badge-primary">' . lang('sample_collected') . '</span>';
            } elseif ($lab->status == 'complete') {
                $status = '<span class="badge badge-info">' . lang('report') . " " . lang('completed') . '</span>';
            } elseif ($lab->status == 'waiting') {
                $status = '<span class="badge badge-danger">' . lang('sample_not_collected') . '</span>';
            } elseif ($lab->status == 'pending') {
                $status = '<span class="badge badge-warning">' . lang('report') . " " . lang('pending') . '</span>';
            } elseif ($lab->status == 'delivery_pending') {
                $status = '<span class="badge badge-danger">' . lang('delivery') . " " . lang('pending') . '</span>';
            } else {
                $status = '<span class="badge badge-success">' . lang('delivered') . '</span>';
            }
            $patient_info = $this->patient_model->getPatientById($lab->patient);
            if (!empty($patient_info)) {
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
            } else {
                $patient_details = ' ';
            }
            $info[] = array(
                $lab->id,
                $patient_details,
                $date,
                $status,
                $options1 . ' ' . $options2 . ' ' . $options3,
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->lab_model->getSampleCollectedLab()),
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    function getDeliveredLab()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "2" => "date",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getDeliveredLabBysearch($search, $order, $dir);
            } else {
                $data['labs'] = $this->lab_model->getDeliveredLabWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getDeliveredLabByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['labs'] = $this->lab_model->getDeliveredLabByLimit($limit, $start, $order, $dir);
            }
        }

        $i = 0;
        foreach ($data['labs'] as $lab) {
            $i = $i + 1;
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) {
                $options1 = ' <a class="btn btn-info btn-sm editbutton" title="' . lang('edit') . '" href="lab?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';
            } else {
                $options1 = '';
            }

            $options2 = '<a class="btn btn-sm invoicebutton" title="' . lang('lab') . '" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('') . '</a>';
            $options2 = '<a class="btn btn-sm invoicebutton" title="Download PDF" style="color: #fff;" href="lab/testPdf?id=' . $lab->id . '"><i class="fas fa-eye"></i> PDF</a>';

            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-info btn-sm delete_button" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }

            $doctor_info = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }

            if ($lab->status == 'sample_taken') {
                $status = '<span class="badge badge-primary">' . lang('sample_collected') . '</span>';
            } elseif ($lab->status == 'complete') {
                $status = '<span class="badge badge-info">' . lang('report') . " " . lang('completed') . '</span>';
            } elseif ($lab->status == 'waiting') {
                $status = '<span class="badge badge-danger">' . lang('sample_not_collected') . '</span>';
            } elseif ($lab->status == 'pending') {
                $status = '<span class="badge badge-warning">' . lang('report') . " " . lang('pending') . '</span>';
            } elseif ($lab->status == 'delivery_pending') {
                $status = '<span class="badge badge-danger">' . lang('delivery') . " " . lang('pending') . '</span>';
            } else {
                $status = '<span class="badge badge-success">' . lang('delivered') . '</span>';
            }
            $patient_info = $this->patient_model->getPatientById($lab->patient);
            if (!empty($patient_info)) {
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
            } else {
                $patient_details = ' ';
            }
            $info[] = array(
                $lab->id,
                $patient_details,
                $date,
                $status,
                $options1 . ' ' . $options2 . ' ' . $options3,
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->lab_model->getDeliveredLab()),
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    function getDeliveryPendingLab()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "2" => "date",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getDeliveryPendingLabBysearch($search, $order, $dir);
            } else {
                $data['labs'] = $this->lab_model->getDeliveryPendingLabWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getDeliveryPendingLabByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['labs'] = $this->lab_model->getDeliveryPendingLabByLimit($limit, $start, $order, $dir);
            }
        }

        $i = 0;
        foreach ($data['labs'] as $lab) {
            $i = $i + 1;
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) {
                $options1 = ' <a class="btn btn-info btn-sm editbutton" title="' . lang('edit') . '" href="lab?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';
            } else {
                $options1 = '';
            }

            $options2 = '<a class="btn btn-sm invoicebutton" title="' . lang('lab') . '" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('') . '</a>';
            $options2 = '<a class="btn btn-sm invoicebutton" title="Download PDF" style="color: #fff;" href="lab/testPdf?id=' . $lab->id . '"><i class="fas fa-eye"></i> PDF</a>';

            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-info btn-sm delete_button" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }

            $doctor_info = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }

            if ($lab->status == 'sample_taken') {
                $status = '<span class="badge badge-primary">' . lang('sample_collected') . '</span>';
            } elseif ($lab->status == 'complete') {
                $status = '<span class="badge badge-info">' . lang('report') . " " . lang('completed') . '</span>';
            } elseif ($lab->status == 'waiting') {
                $status = '<span class="badge badge-danger">' . lang('sample_not_collected') . '</span>';
            } elseif ($lab->status == 'pending') {
                $status = '<span class="badge badge-warning">' . lang('report') . " " . lang('pending') . '</span>';
            } elseif ($lab->status == 'delivery_pending') {
                $status = '<span class="badge badge-danger">' . lang('delivery') . " " . lang('pending') . '</span>';
            } else {
                $status = '<span class="badge badge-success">' . lang('delivered') . '</span>';
            }
            $patient_info = $this->patient_model->getPatientById($lab->patient);
            if (!empty($patient_info)) {
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
            } else {
                $patient_details = ' ';
            }
            $info[] = array(
                $lab->id,
                $patient_details,
                $date,
                $status,
                $options1 . ' ' . $options2 . ' ' . $options3,
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->lab_model->getDeliveryPendingLab()),
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    public function myLab()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();

        $data['settings'] = $this->settings_model->getSettings();

        $this->load->view('home/dashboard');
        $this->load->view('my_lab', $data);
        $this->load->view('home/footer');
    }

    function getMyLab()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $status = $_GET['status'];
        $category = $_GET['category'];
        $from = $_GET['from'];
        $to = $_GET['to'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "patient",
            "3" => "invoice_id",
            "4" => 'date',
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getLabReportBysearch($search, $order, $dir, $status, $category, $from, $to);
            } else {
                $data['labs'] = $this->lab_model->getLabReportWithoutSearch($order, $dir, $status, $category, $from, $to);
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getLabReportByLimitBySearch($limit, $start, $search, $order, $dir, $status, $category, $from, $to);
            } else {
                $data['labs'] = $this->lab_model->getLabReportByLimit($limit, $start, $order, $dir, $status, $category, $from, $to);
            }
        }

        $i = 0;
        foreach ($data['labs'] as $lab) {
           
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) {
                $options1 = ' <a class="btn btn-info btn-sm editbutton" title="' . lang('edit') . '" href="lab?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';
            } else {
                $options1 = '';
            }

            $options2 = '<a class="btn btn-sm invoicebutton" title="' . lang('lab') . '" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('') . '</a>';
            $options2 = '<a class="btn btn-sm invoicebutton" title="Download PDF" style="color: #fff; margin-right: 5px" href="lab/testPdf?id=' . $lab->id . '"> PDF</a>';

            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-info btn-sm delete_button" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }

            $options3 = "";
            if ($this->ion_auth->in_group(array('Laboratorist'))) {
                $options3 = '<a class="btn btn-success btn-sm signBtn" href="lab/signLab?id=' . $lab->id . '">Sign</a>';
            }

            $doctor_info = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }

            $patient_info = $this->patient_model->getPatientById($lab->patient);
            if (!empty($patient_info)) {
                $age = explode('-', $patient_info->age);
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>' . $age[0] . '</br>';
                $patient_name = $patient_info->name;
                $patient_phone = $patient_info->phone;
            } else {
                $patient_details = ' ';
                $patient_name = ' ';
                $patient_phone = ' ';
            }



            if ($patient_info->ion_user_id != $this->ion_auth->get_user_id()) {
                continue;
            }

            $i = $i + 1;


            $invoice_details = "";
            if ($lab->invoice_id != null) {
                $invoice_details = $this->db->get_where('payment', array('id' => $lab->invoice_id))->row();
                if ($invoice_details) {
                    $invoice_deposit = $this->db->get_where('patient_deposit', array('payment_id' => $lab->invoice_id))->result();
                    if (empty($invoice_deposit)) {
                        $total_deposit = '0';
                    } else {
                        foreach ($invoice_deposit as $deposit_amount) {
                            $deposit[] = $deposit_amount->deposited_amount;
                        }
                        $total_deposit = array_sum($deposit);
                    }
                    $invoice_date_time = date('d-m-y h:i A', $invoice_details->date);
                } else {
                    $invoice_details = "";
                    $invoice_date_time = "";
                }
            } else {
                $invoice_date_time = "";
            }

            $bill_status = "";
            if ($invoice_details) {
                if ($invoice_details && $invoice_details->amount_received == null || $total_deposit < $invoice_details->gross_total) {
                    $bill_status = '<span class="badge badge-danger">' . lang('due_have') . '</span>';
                } else {
                    $bill_status = '<span class="badge badge-success">' . lang('paid') . '</span>';
                }
            }

            if ($lab->category_id != null) {
                $test_name = $this->finance_model->getPaymentCategoryById($lab->category_id);
                $test_name = $test_name->category;
            } else {
                $test_name = "";
            }

            //            $status = "<select class='form-control test_status' data-id='" . $lab->id . "'>";
            //            if ($lab->status == "pending") {
            //                $status .= "<option value='pending' selected>" . lang('pending') . "</option><option value='drafted'>" . lang('drafted') . "</option><option value='completed'>" . lang('completed') . "</option>";
            //            } else if ($lab->status == "drafted") {
            //                $status .= "<option value='pending'>" . lang('pending') . "</option><option value='drafted' selected>" . lang('drafted') . "</option><option value='completed'>" . lang('completed') . "</option>";
            //            } else {
            //                $status .= "<option value='pending'>" . lang('pending') . "</option><option value='drafted'>" . lang('drafted') . "</option><option value='completed' selected>" . lang('completed') . "</option>";
            //            }
            //            $status .= "<select>";

            $status = "";
            if ($lab->status == "pending") {
                $status = '<span class="badge badge-danger">' . lang('pending') . '</span>';
            } else if ($lab->status == "drafted") {
                $status = '<span class="badge badge-warning">' . lang('drafted') . '</span>';
            } else {
                $status = '<span class="badge badge-success">' . lang('completed') . '</span>';
            }

            $reported_by = "";
            if ($lab->reported_by != null) {
                $reported_by = $this->db->get_where('users', array('id' => $lab->reported_by))->row();
                if (isset($reported_by->id)) {
                    $reported_by = $reported_by->username;
                }
            }

            $info[] = array(
                isset($patient_info->id) ? $patient_info->id : "",
                //$patient_details,
                $patient_name,
                $patient_phone,
                $lab->invoice_id,
                $invoice_date_time,
                $test_name,
                $status,
                //$lab->test_status_date != null ? date('d-m-y h:i A', $lab->test_status_date) : "",
                $bill_status,
                $lab->updated_on != null ? date('d-m-y h:i A', $lab->updated_on) : "",
                $reported_by,
                $options1 . ' ' . $options2 . ' ' . $options3,
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->lab_model->getMyLab()),
                "recordsFiltered" => count($this->lab_model->getMyLab()),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    function getTemplateByCategory()
    {
        $category_id = $this->input->get("category_id");
        $user_id = $this->input->get('user_id');

        if ($category_id == 'all' && $user_id == 'all') {
            $templates = $this->db->get('template')->result();
        } else if ($category_id == 'all' && $user_id != 'all') {
            $user_id = $this->ion_auth->get_user_id();
            $templates = $this->db->get_where('template', array("user" => $user_id))->result();
        } else if ($category_id != 'all' && $user_id == 'all') {
            $templates = $this->db->get_where('template', array("category_id" => $category_id))->result();
        } else {
            $user_id = $this->ion_auth->get_user_id();
            $templates = $this->db->get_where('template', array("category_id" => $category_id, "user" => $user_id))->result();
        }

        $data = "<option value=''>Select...</option>";
        foreach ($templates as $template) {
            $data .= "<option value=" . $template->id . ">" . $template->name . "(" . $this->db->get_where('users', array("id" => $template->user))->row()->username . ")" . "</option>";
        }
        echo json_encode($data);
    }

    function getTemplateByUser()
    {
        $user_id = $this->input->get("user_id");
        $category_id = $this->input->get('category_id');

        if ($category_id == 'all' && $user_id == 'all') {
            $templates = $this->db->get('template')->result();
        } else if ($category_id == 'all' && $user_id != 'all') {
            $user_id = $this->ion_auth->get_user_id();
            $templates = $this->db->get_where('template', array("user" => $user_id))->result();
        } else if ($category_id != 'all' && $user_id == 'all') {
            $templates = $this->db->get_where('template', array("category_id" => $category_id))->result();
        } else {
            $user_id = $this->ion_auth->get_user_id();
            $templates = $this->db->get_where('template', array("category_id" => $category_id, "user" => $user_id))->result();
        }

        $data = "<option value=''>Select...</option>";
        foreach ($templates as $template) {
            $data .= "<option value=" . $template->id . ">" . $template->name . "(" . $this->db->get_where('users', array("id" => $template->user))->row()->username . ")" . "</option>";
        }
        echo json_encode($data);
    }

    function printLabel2()
    {
        $id = $this->input->get('id');
        $data['lab'] = $this->lab_model->getLabById($id);
        $data['labels'] = array();
        $label = $this->lab_model->getAllLabels($data['lab']->invoice_id, $data['lab']->category_id);

        if ($label->category_id) {
            $category_id = $this->db->get_where('payment_category', array('id' =>  $label->category_id))->row();
            $category_id = $category_id->payment_category;
        }

        $alllabs = $this->db->get_where('lab', array('invoice_id' => $data['lab']->invoice_id))->result();
        foreach ($alllabs as $lab) {
            if ($lab->category_id) {
                $category_id2 = $this->db->get_where('payment_category', array('id' =>  $lab->category_id))->row();
                $category_id2 = $category_id2->payment_category;
                if ($category_id == $category_id2) {
                    array_push($data['labels'], $lab);
                }
            }
        }

        $data['patient'] = $this->patient_model->getPatientById($data['lab']->patient);

        $this->load->view('labLabel', $data);
        //        // Load library
        //		$this->load->library('zend');
        //		// Load in folder Zend
        //		$this->zend->load('Zend/Barcode');
        //		// Generate barcode
        //		Zend_Barcode::render('code128', 'image', array('text'=>"PRASUN NANDY PRITAM"), array());
    }

    function printLabel()
    {
        $id = $this->input->get('id');
        $data['lab'] = $this->lab_model->getLabById($id);
        $data['labels'] = array();
        $label = $this->lab_model->getAllLabels($data['lab']->invoice_id, $data['lab']->category_id);

        if ($label->category_id) {
            $category_id = $this->db->get_where('payment_category', array('id' =>  $label->category_id))->row();
            $category_id = $category_id->payment_category;
        }

        $alllabs = $this->db->get_where('lab', array('invoice_id' => $data['lab']->invoice_id))->result();
        foreach ($alllabs as $lab) {
            if ($lab->category_id) {
                $category_id2 = $this->db->get_where('payment_category', array('id' =>  $lab->category_id))->row();
                $category_id2 = $category_id2->payment_category;
                if ($category_id == $category_id2) {
                    array_push($data['labels'], $lab);
                }
            }
        }

        $data['patient'] = $this->patient_model->getPatientById($data['lab']->patient);

        $this->load->view('home/dashboard');
        $this->load->view('labLabel2', $data);
        $this->load->view('home/footer');
    }

    function labLabel90()
    {
        $id = $this->input->get('id');
        $data['lab'] = $this->lab_model->getLabById($id);
        $data['labels'] = array();
        $label = $this->lab_model->getAllLabels($data['lab']->invoice_id, $data['lab']->category_id);

        if ($label->category_id) {
            $category_id = $this->db->get_where('payment_category', array('id' =>  $label->category_id))->row();
            $category_id = $category_id->payment_category;
        }

        $alllabs = $this->db->get_where('lab', array('invoice_id' => $data['lab']->invoice_id))->result();
        foreach ($alllabs as $lab) {
            if ($lab->category_id) {
                $category_id2 = $this->db->get_where('payment_category', array('id' =>  $lab->category_id))->row();
                $category_id2 = $category_id2->payment_category;
                if ($category_id == $category_id2) {
                    array_push($data['labels'], $lab);
                }
            }
        }

        $data['patient'] = $this->patient_model->getPatientById($data['lab']->patient);

        $this->load->view('home/dashboard');
        $this->load->view('labLabel90', $data);
        $this->load->view('home/footer');
    }

    function getReportReceiver()
    {
        $id = $this->input->get('id');
        $data = $this->lab_model->getLabById($id);
        echo json_encode($data);
    }

    function makeWord()
    {


        $this->load->library('HtmltoDoc');
        $htd = new HtmltoDoc();

        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['lab'] = $this->lab_model->getLabById($id);

        if ($data['lab']->hospital_id != $this->session->userdata('hospital_id')) {
            $this->load->view('home/permission');
        }

        //$this->load->view('home/dashboard');
        $this->load->view('downloadInvoice', $data);
        //$this->load->view('home/footer'); // just the footer fi
        //$html = file_get_contents($this->load->view('downloadInvoice', $data)); 
        $htmlContent = $this->load->view('downloadInvoice', $data, TRUE);
        $htd->createDoc($htmlContent, $lab->id . "_" . date('YmdHis') . "_Word", 1);
    }

    function sendLabReport()
    {
        $id = $this->input->post('id');
        $is_v_v = $this->input->post('radio');





        $settings1 = $this->settings_model->getSettings();
        $data['settings'] = $this->settings_model->getSettings();
        $data['lab'] = $this->lab_model->getLabById($id);
        $lab = $this->lab_model->getLabById($id);
        $data['redirect'] = 'download1';
        //$data['lab'] = $this->lab_model->getLabById($id);
        $patient = $this->db->get_where('patient', array('id' => $lab->patient))->row();
        if ($data['lab']->hospital_id != $this->session->userdata('hospital_id')) {
            $this->load->view('home/permission');
        }
        if ($lab->updated_on) {
            $update_on = date('l d M Y h:s A', $lab->updated_on) . " Updated on Time";
        } else {
            $update_on = '';
        }
        //$this->load->view('newLabReport', $data);

        $age = explode('-', $patient->age);
        if (count($age) == 3) {

            $age_as = '<td style="padding-right: 10px;"><label class="control_label">' . lang('age') . '</label> <span class="info_text">: ' . $age[0] . " Y " . $age[1] . " M " . $age[2] . " D" . '</td></span>';
        } else {
            $age_as = '<td style="padding-right: 10px;"><label class="control_label">' . lang('age') . '</label> <span class="info_text">: </span></td>';
        }

        $doctor_details = "";
        $invoice_details = "";
        $invoice_details = $this->db->get_where('payment', array('id' => $lab->invoice_id))->row();
        if ($invoice_details) {
            if ($invoice_details->doctor) {
                $doctor_details = $this->db->get_where('doctor', array('id' => $invoice_details->doctor))->row();
            }
        }

        if ($invoice_details) {
            $datess = date('d/m/Y h:i A', $invoice_details->date);
        } else {
            $datess = '';
        }
        if ($doctor_details) {
            $doc_name = '<span class="info_text">: ' . $doctor_details->name . '</span>';
            $profile = '<span class="info_text">' . $doctor_details->profile . '</span>';
        } else {
            $doc_name = '';
            $profile = '';
        }




        $signature = "";
        if ($lab->signed_by) {
            $laboratorist = $this->db->get_where('laboratorist', array('ion_user_id' => $lab->signed_by))->row();

            if ($laboratorist) {
                $signature = $laboratorist->signature;
            }
        }






        $header = '       <div id="invoice_header">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 25%">
                                    <img alt="" src="' . site_url($this->settings_model->getSettings()->logo) . '" width="150" height="auto" style="margin-top:-45px; margin-left: 5px;">
                                </td>
                                <td>
                                    <h4 style="margin-bottom: 10px; font-weight: 800; margin-top: -20px;">' . $settings1->title . '</h4>
                                    <h6 style="margin-bottom: 10px;">' . $settings1->address . '</h6>
                                    <h4 style="line-height: 20px">Phone: <br>' . $settings1->phone . '</h4>
                                </td>
                                <td>
                                    <table style="margin-top: 10px;">
                                        <tr>
                                            <td colspan="2">
                                                <label class="control_label">' . lang('name') . '</label> <span class="info_text">: ' . $patient->name . '</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            ' . $age_as . '
                                            <td>
                                                <label class="control_label">' . lang('gender') . '</label> <span class="info_text">: ' . $patient->sex . '</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding-right: 10px;"><label class="control_label">HN</label> <span class="info_text">: 0000000' . $patient->id . '</span></td>
                                            <td><label class="control_label">' . lang('phone') . '</label> <span class="info_text">: ' . $patient->phone . '</span></td>
                                        </tr>
                                       
                                        <tr>
                                            <td style="padding-right: 10px;"><label class="control_label">VN</label> <span class="info_text">: 0000000' . $lab->invoice_id . '</span></td>
                                            <td><label class="control_label">VN ' . lang('date') . '</label> <span class="info_text">:
                                                                                                                        ' . $datess . '</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label class="control_label">' . lang('doctor') . '</label>
                                                ' . $doc_name . '
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                ' . $profile . '
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        
                        <hr class="table-qr-hr">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 50%; padding-left: 20px; display: inline-flex">
                                    <label style="margin-bottom: 10px;">HN:</label>
                                    <img class="image_bar" alt="testing" src="' . site_url("lab/barcode") . '?text=000000000' . $patient->id . '&print=true" />
                                </td>
                                
                                <td style="width: 50%; text-align: right; padding-right: 20px; display: inline-flex; justify-content: end;">
                                    <label style="margin-bottom: 10px;">VN:</label>
                                    <img class="image_bar" alt="testing" src="' . site_url("lab/barcode") . '?text=000000000' . $lab->invoice_id . '&print=true" />
                                </td>
                            </tr>
                        </table>
                    </div>';

        $footer = '<div class="invoice_footer" style="margin-top:50px;">

                                <table style="width: 100%">
                                
                                    <tr>
                                        <td  id="footer_done" style="padding-right: 20px;"><span class="info_text">Done By:' . $lab->done_by . '</span>
                                          
</td>
                                        <td id="footer_second">
                                           |{PAGENO} of {nbpg}| 
                                        </td>
                                        <td id="footer_third" style="text-align: right;">
                                            <p style="font-weight: bold">
                                                ' . $update_on . '
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </div>';
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'stretch';
        $mpdf->SetHTMLHeader($header);
        $mpdf->SetHTMLFooter($footer);
        $mpdf->setAutoBottomMargin = 'stretch';
        $html = $this->load->view('labReportDownload', $data, true);


        $mpdf->WriteHTML($html);

        $filename = "report--00" . $id . ".pdf";
        $mpdf->Output(APPPATH . '../invoicefile/' . $filename, 'F');

        if ($is_v_v == 'patient') {
            $patientemail = $this->patient_model->getPatientById($data['lab']->patient)->email;
        }
        if ($is_v_v == 'other') {
            $patientemail = $this->input->post('other_email');
        }


        $subject = lang('report');
        $mail_provider = $this->settings_model->getSettings()->emailtype;
        $settngs_name = $this->settings_model->getSettings()->system_vendor;
        $email_Settings = $this->email_model->getEmailSettingsByType($mail_provider);

        $this->load->library('encryption');
        if ($mail_provider == 'Domain Email') {
            $this->email->from($email_Settings->admin_email);
        }
        if ($mail_provider == 'Smtp') {
            $this->email->from($email_Settings->user, $settngs_name);
        }

        $this->email->to($patientemail);
        $this->email->subject($subject);

        $this->email->attach('invoicefile/' . $filename);


        if ($this->email->send()) {

            unlink(APPPATH . '../invoicefile/' . $filename);
            show_swal('feedback', lang('send_invoice'));
            redirect("lab/viewReport?id=" . $id);
        } else {
            unlink(APPPATH . '../invoicefile/' . $filename);
            show_swal('feedback', lang('not') . ' ' . lang('send_invoice'));
            redirect("lab/viewReport?id=" . "$id");
        }
    }
}

/* End of file lab.php */
/* Location: ./application/modules/lab/controllers/lab.php */