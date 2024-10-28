<?php

class Import extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('Excel');
        $this->load->model('import_model');
        $this->load->helper('file');

        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }
    }

    function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } else {
            $this->load->view('home/dashboard');
            $this->load->view('import');
            $this->load->view('home/footer');
        }
    }

    function importPatientInfo()
    {
        if (isset($_FILES["filename"]["name"])) {
            $path = $_FILES["filename"]["tmp_name"];
            $tablename = $this->input->post('tablename');
            $this->importPatient($path, $tablename);
        }
    }

    function importDoctorInfo()
    {
        if (isset($_FILES["filename"]["name"])) {
            $path = $_FILES["filename"]["tmp_name"];
            $tablename = $this->input->post('tablename');

            $this->importDoctor($path, $tablename);
        }
    }

    function importMedicineInfo()
    {
        if (isset($_FILES["filename"]["name"])) {
            $path = $_FILES["filename"]["tmp_name"];
            $tablename = $this->input->post('tablename');

            $this->importMedicine($path, $tablename);
        }
    }

    function importPatient($file, $tablename)
    {
        $object = PHPExcel_IOFactory::load($file);
        foreach ($object->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();    //get Highest Row
            $highestColumnLetter = $worksheet->getHighestColumn(); //get column highest as  letter
            $highestColumn = PHPExcel_Cell::columnIndexFromString($highestColumnLetter); // convert letter to column index in number
            for ($column1 = 0; $column1 < $highestColumn; $column1++) {
                $rowData1[] = $worksheet->getCellByColumnAndRow($column1, 1)->getValue();
            }


            $headerexist = $this->import_model->headerExist($rowData1, $tablename); // get boolean header exist or not


            if ($headerexist) {
                for ($row = 2; $row <= $highestRow; $row++) {
                    $rowData = [];
                    $rowData2 = [];

                    for ($column = 0; $column < $highestColumn; $column++) {
                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'password') {
                            $rowData3[] = $worksheet->getCellByColumnAndRow($column, 1)->getValue();
                        } else {
                            $rowData2[] = $worksheet->getCellByColumnAndRow($column, 1)->getValue();
                        }

                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) != 'password') {
                            $rowData[] = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'name') {
                            $name = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'phone') {
                            $phone = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'password') {

                            $password = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'email') {

                            $email = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                    }



                    if ($this->ion_auth->email_check($email)) {
                        $exist_email[] = $row;
                        $exist_rows = implode(',', $exist_email);
                        $message = 'Rows number ' . $exist_rows . ' contain the emails which already exist!';
                    } else {
                        $dfg = 5;
                        $username = $name;

                        $this->ion_auth->register($username, $password, $email, $dfg);

                        $ionid = $this->db->get_where('users', array('email' => $email))->row()->id;

                        array_push($rowData, $ionid);
                        array_push($rowData2, 'ion_user_id');
                        array_push($rowData, date('d/m/y'));
                        array_push($rowData2, 'add_date');
                        array_push($rowData, time());
                        array_push($rowData2, 'registration_time');
                        array_push($rowData, rand(10000, 1000000));
                        array_push($rowData2, 'patient_id');
                        array_push($rowData, $this->session->userdata('hospital_id'));
                        array_push($rowData2, 'hospital_id');
                        $data = array_combine($rowData2, $rowData);
                        $this->import_model->dataEntry($data, $tablename);
                    }
                }
                show_swal(lang('successful_data_import'), 'success');
                if ($message != '') {
                    show_swal($message, 'warning');
                }
            } else {
                show_swal(lang('wrong_file_format'), 'error');
            }
        }


        redirect('import');
    }

    function importDoctor($file, $tablename)
    {
        $object = PHPExcel_IOFactory::load($file);
        foreach ($object->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();    //get Highest Row
            $highestColumnLetter = $worksheet->getHighestColumn(); //get column highest as  letter
            $highestColumn = PHPExcel_Cell::columnIndexFromString($highestColumnLetter); // convert letter to column index in number
            for ($column1 = 0; $column1 < $highestColumn; $column1++) {
                $rowData1[] = $worksheet->getCellByColumnAndRow($column1, 1)->getValue();
            }


            $headerexist = $this->import_model->headerExist($rowData1, $tablename); // get boolean header exist or not


            if ($headerexist) {
                for ($row = 2; $row <= $highestRow; $row++) {
                    $rowData = [];
                    $rowData2 = [];

                    for ($column = 0; $column < $highestColumn; $column++) {
                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'password') {
                            $rowData3[] = $worksheet->getCellByColumnAndRow($column, 1)->getValue();
                        } else {
                            $rowData2[] = $worksheet->getCellByColumnAndRow($column, 1)->getValue();
                        }

                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) != 'password') {
                            $rowData[] = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'name') {
                            $name = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'phone') {
                            $phone = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'password') {

                            $password = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'email') {

                            $email = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                    }



                    if ($this->ion_auth->email_check($email)) {
                        $exist_email[] = $row;
                        $exist_rows = implode(',', $exist_email);
                        $message1 = 'Rows number ' . $exist_rows . ' contain the emails which already exist!';
                    } else {
                        $dfg = 4;
                        $username = $name;

                        $this->ion_auth->register($username, $password, $email, $dfg);

                        $ionid = $this->db->get_where('users', array('email' => $email))->row()->id;

                        array_push($rowData, $ionid);
                        array_push($rowData2, 'ion_user_id');
                        array_push($rowData, $this->session->userdata('hospital_id'));
                        array_push($rowData2, 'hospital_id');
                        $data = array_combine($rowData2, $rowData);
                        $this->import_model->dataEntry($data, $tablename);
                    }
                }

                show_swal(lang('successful_data_import'), 'success');
                if ($message1 != '') {
                    show_swal($message1, 'warning');
                }
            } else {
                show_swal(lang('wrong_file_format'), 'error');
            }
        }


        redirect('import');
    }

    function importMedicine($file, $tablename)
    {
        $object = PHPExcel_IOFactory::load($file);
        $message2 = '';
        foreach ($object->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();    //get Highest Row
            $highestColumnLetter = $worksheet->getHighestColumn(); //get column highest as  letter
            $highestColumn = PHPExcel_Cell::columnIndexFromString($highestColumnLetter); // convert letter to column index in number
            for ($column1 = 0; $column1 < $highestColumn; $column1++) {
                $rowData1[] = $worksheet->getCellByColumnAndRow($column1, 1)->getValue();
            }


            $headerexist = $this->import_model->headerExist($rowData1, $tablename); // get boolean header exist or not


            if ($headerexist) {
                for ($row = 2; $row <= $highestRow; $row++) {
                    $rowData = [];
                    $rowData2 = [];

                    for ($column = 0; $column < $highestColumn; $column++) {

                        $rowData2[] = $worksheet->getCellByColumnAndRow($column, 1)->getValue();
                        $rowData[] = $worksheet->getCellByColumnAndRow($column, $row)->getValue();



                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'name') {
                            $name = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                    }

                    $medicinename =  $this->db->get_where('medicine', array('name =' => $name))->row();

                    if (!empty($medicinename)) {
                        $exist_name[] = $row;
                        $exist_rows = implode(',', $exist_name);
                        $message2 .= 'Rows number ' . $exist_rows . ' contain the medicine which already exist!';
                    } else {
                        array_push($rowData, date('d/m/y'));
                        array_push($rowData2, 'add_date');
                        array_push($rowData, $this->session->userdata('hospital_id'));
                        array_push($rowData2, 'hospital_id');
                        $data = array_combine($rowData2, $rowData);

                        $this->import_model->dataEntry($data, $tablename);
                    }
                }
                show_swal(lang('successful_data_import'), 'success');
                if ($message2 != '') {
                    show_swal($message2, 'warning');
                }
            } else {
                show_swal(lang('wrong_file_format'), 'error');
            }
        }


        redirect('import');
    }
}
