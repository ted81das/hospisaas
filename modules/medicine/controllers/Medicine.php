<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medicine extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('medicine_model');
        if (!$this->ion_auth->in_group(array('admin', 'Pharmacist', 'Doctor'))) {
            redirect('home/permission');
        }
    }

    public function index()
    {

        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['settings'] = $this->settings_model->getSettings();

        $this->load->view('home/dashboard', $data);
        $this->load->view('medicine', $data);
        $this->load->view('home/footer');
    }

    public function medicineByPageNumber()
    {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['medicines'] = $this->medicine_model->getMedicineByPageNumber($page_number);
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['pagee_number'] = $page_number;
        $data['p_n'] = $page_number;
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('medicine', $data);
        $this->load->view('home/footer');
    }

    public function medicineStockAlert()
    {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['p_n'] = '0';
        $data['medicines'] = $this->medicine_model->getMedicineByStockAlert($page_number);

        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['pagee_number'] = $page_number;
        $data['settings'] = $this->settings_model->getSettings();
        $data['alert'] = 'Alert Stock';
        $this->load->view('home/dashboard', $data);
        $this->load->view('medicine_stock_alert', $data);
        $this->load->view('home/footer');
    }

    public function medicineStockAlertByPageNumber()
    {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['p_n'] = $page_number;
        $data['medicines'] = $this->medicine_model->getMedicineByStockAlert($page_number);
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['pagee_number'] = $page_number;
        $data['alert'] = 'Alert Stock';
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('medicine_stock_alert', $data);
        $this->load->view('home/footer');
    }

    function searchMedicine()
    {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['p_n'] = $page_number;
        $key = $this->input->get('key');
        $data['medicines'] = $this->medicine_model->getMedicineByKey($page_number, $key);
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $data['pagee_number'] = $page_number;
        $data['key'] = $key;
        $this->load->view('home/dashboard', $data);
        $this->load->view('medicine', $data);
        $this->load->view('home/footer');
    }

    function searchMedicineInAlertStock()
    {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['p_n'] = $page_number;
        $key = $this->input->get('key');
        $data['medicines'] = $this->medicine_model->getMedicineByKeyByStockAlert($page_number, $key);
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $data['pagee_number'] = $page_number;
        $data['key'] = $key;
        $this->load->view('home/dashboard', $data);
        $this->load->view('medicine_stock_alert', $data);
        $this->load->view('home/footer');
    }

    public function addMedicineView()
    {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $this->load->view('home/dashboard', $data);
        $this->load->view('add_new_medicine_view', $data);
        $this->load->view('home/footer');
    }

    public function addNewMedicine()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $category = $this->input->post('category');
        $price = $this->input->post('price');
        $box = $this->input->post('box');
        $s_price = $this->input->post('s_price');
        $quantity = $this->input->post('quantity');
        $generic = $this->input->post('generic');
        $company = $this->input->post('company');
        $effects = $this->input->post('effects');
        $e_date = $this->input->post('e_date');
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('medicine', array('id' => $id))->row()->add_date;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Category Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Purchase Price Field
        $this->form_validation->set_rules('price', 'Purchase Price', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Store Box Field
        $this->form_validation->set_rules('box', 'Store Box', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Selling Price Field
        $this->form_validation->set_rules('s_price', 'Selling Price', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Quantity Field
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Generic Name Field
        $this->form_validation->set_rules('generic', 'Generic Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Company Name Field
        $this->form_validation->set_rules('company', 'Company', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Effects Field
        $this->form_validation->set_rules('effects', 'Effects', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Expire Date Field
        $this->form_validation->set_rules('e_date', 'Expire Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect('medicine/editMedicine?id=' . $id);
            } else {
                $data = array();
                $data['categories'] = $this->medicine_model->getMedicineCategory();
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data);
                $this->load->view('add_new_medicine_view', $data);
                $this->load->view('home/footer');
            }
        } else {
            $data = array();
            $data = array(
                'name' => $name,
                'category' => $category,
                'price' => $price,
                'box' => $box,
                's_price' => $s_price,
                'quantity' => $quantity,
                'generic' => $generic,
                'company' => $company,
                'effects' => $effects,
                'add_date' => $add_date,
                'e_date' => $e_date,
            );
            if (empty($id)) {
                $this->medicine_model->insertMedicine($data);
                show_swal(lang('added'), 'success', lang('added'));
            } else {
                $this->medicine_model->updateMedicine($id, $data);
                show_swal(lang('updated'), 'success', lang('updated'));
            }
            redirect('medicine');
        }
    }

    function editMedicine()
    {
        $data = array();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $id = $this->input->get('id');
        $data['medicine'] = $this->medicine_model->getMedicineById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('add_new_medicine_view', $data);
        $this->load->view('home/footer');
    }

    function load()
    {
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $previous_qty = $this->db->get_where('medicine', array('id' => $id))->row()->quantity;
        $new_qty = $previous_qty + $qty;
        $data = array();
        $data = array('quantity' => $new_qty);
        $this->medicine_model->updateMedicine($id, $data);
        show_swal('feedback', lang('medicine_loaded'));
        redirect('medicine');
    }

    function editMedicineByJason()
    {
        $id = $this->input->get('id');
        $data['medicine'] = $this->medicine_model->getMedicineById($id);
        echo json_encode($data);
    }

    function delete()
    {
        $id = $this->input->get('id');
        $this->medicine_model->deleteMedicine($id);
        show_swal(lang('deleted'), 'warning', lang('deleted'));
        redirect('medicine');
    }

    public function medicineCategory()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('medicine_category', $data);
        $this->load->view('home/footer');
    }

    public function addCategoryView()
    {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('add_new_category_view');
        $this->load->view('home/footer');
    }

    public function addNewCategory()
    {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect('medicine/edit_category?id=' . $id);
            } else {
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data);
                $this->load->view('add_new_category_view');
                $this->load->view('home/footer');
            }
        } else {
            $data = array();
            $data = array(
                'category' => $category,
                'description' => $description
            );
            if (empty($id)) {
                $this->medicine_model->insertMedicineCategory($data);
                show_swal(lang('added'), 'success', lang('added'));
            } else {
                $this->medicine_model->updateMedicineCategory($id, $data);
                show_swal(lang('updated'), 'success', lang('updated'));
            }
            redirect('medicine/medicineCategory');
        }
    }

    function edit_category()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['medicine'] = $this->medicine_model->getMedicineCategoryById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('add_new_category_view', $data);
        $this->load->view('home/footer');
    }

    function editMedicineCategoryByJason()
    {
        $id = $this->input->get('id');
        $data['medicinecategory'] = $this->medicine_model->getMedicineCategoryById($id);
        echo json_encode($data);
    }

    function deleteMedicineCategory()
    {
        $id = $this->input->get('id');
        $this->medicine_model->deleteMedicineCategory($id);
        show_swal(lang('deleted'), 'warning', lang('deleted'));
        redirect('medicine/medicineCategory');
    }

    function getMedicineList()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "namee",
            "2" => "category",
            "3" => "box",
            "4" => "price",
            "5" => "s_price",
            "6" => "quantity",
            "7" => "generic",
            "8" => "company",
            "9" => "effects",
            "10" => "e_date",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['medicines'] = $this->medicine_model->getMedicineBysearch($search, $order, $dir);
            } else {
                $data['medicines'] = $this->medicine_model->getMedicineWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['medicines'] = $this->medicine_model->getMedicineByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['medicines'] = $this->medicine_model->getMedicineByLimit($limit, $start, $order, $dir);
            }
        }

        $i = 0;
        foreach ($data['medicines'] as $medicine) {
            $i = $i + 1;
            $settings = $this->settings_model->getSettings();
            if ($medicine->quantity <= 0) {
                $quan = '<p class="os">Stock Out</p>';
            } else {
                $quan = $medicine->quantity;
            }
            $load = '<button type="button" class="btn btn-success btn-sm btn_width load" data-toggle="modal" data-id="' . $medicine->id . '">' . lang('load') . '</button>';
            $option1 = '<a type="button" class="btn btn-primary btn-sm btn_width editbutton" data-toggle="modal" data-id="' . $medicine->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';

            $option2 = '<a class="btn btn-danger btn-sm btn_width delete_button" href="medicine/delete?id=' . $medicine->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('') . '</a>';




            $dropdownOptions = '';
            $dropdownOptions = '
            <div class="btn-group">
            <button type="button" class="btn btn-info btn-sm label-primary dropdown-toggle action_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="">
            <i class="fas fa-bars"></i> ' . lang('actions') . ' <span class="caret"></span>
        </button>
                <ul class="dropdown-menu">
                    ' . ($option1 ? '<li><a class="editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $medicine->id . '">  <i class="fa fa-edit"></i> ' . lang('') . '</a></li>' : '') . '
                    ' . ($option2 ? '<li><a href="' . site_url("medicine/delete?id=" . $medicine->id) . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"> <i class="fa fa-trash"></i> ' . lang('') . ' </a></li>' : '') . '
                </ul>
            </div>';





            $info[] = array(
                $i,
                $medicine->name,
                $medicine->category,
                $medicine->box,
                $settings->currency . $medicine->price,
                $settings->currency . $medicine->s_price,
                $quan . '<br>' . $load,
                $medicine->generic,
                $medicine->company,
                $medicine->effects,
                $medicine->e_date,
                // $dropdownOptions
                '<span class="d-flex gap-2">' . $option1 . ' ' . $option2 . '</span>'
                //  $options2
            );
        }

        if (!empty($data['medicines'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->medicine_model->getMedicine()),
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

    public function getMedicinenamelist()
    {
        $searchTerm = $this->input->post('searchTerm');

        $response = $this->medicine_model->getMedicineNameByAvailablity($searchTerm);
        $data = array();
        foreach ($response as $responses) {
            $data[] = array("id" => $responses->id, "data-id" => $responses->id, "data-med_name" => $responses->name, "text" => $responses->name);
        }

        echo json_encode($data);
    }

    public function getMedicineListForSelect2()
    {
        // Search term
        $searchTerm = $this->input->post('searchTerm');

        // Get users
        $response = $this->medicine_model->getMedicineInfo($searchTerm);

        echo json_encode($response);
    }

    public function getMedicineForPharmacyMedicine()
    {
        // Search term
        $searchTerm = $this->input->post('searchTerm');

        // Get users
        $response = $this->medicine_model->getMedicineInfoForPharmacySale($searchTerm);

        echo json_encode($response);
    }
    function getGenericNameInfoByAll()
    {
        $searchTerm = $this->input->post('searchTerm');

        // Get users
        $response = $this->medicine_model->getGenericInfoByAll($searchTerm);

        echo json_encode($response);
    }
    function getMedicineByGeneric()
    {
        $id = $this->input->get('id');
        $medicines = $this->medicine_model->getMedicineByGeneric($id);
        $option = '<option  value="select">' . lang('select') . '</option>';
        foreach ($medicines as $medicine) {
            $option .= '<option value="' . $medicine->id . '">' . $medicine->name . '</option>';
        }
        $data['response'] = $option;
        echo json_encode($data);
    }
}

/* End of file medicine.php */
/* Location: ./application/modules/medicine/controllers/medicine.php */
