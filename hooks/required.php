<?php

function required()
{
    $CI = &get_instance();
    $CI->load->library('Ion_auth');
    $CI->load->library('session');
    $CI->load->helper('cookie');
    $CI->load->library('form_validation');
    $CI->load->library('upload');
    $CI->load->library('parser');
    $CI->load->helper('security');
    $CI->load->helper('toastr_helper');


    $RTR = &load_class('Router');
    if ($RTR->class != "frontend" && $RTR->class != "payu" && $RTR->class != "status" && $RTR->class != "cronjobs" && $RTR->class != "request" && $RTR->class != "auth" && $RTR->class != "site" && $RTR->class != "api") {
        if (!$CI->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }

    $CI->load->model('settings/settings_model');
    $CI->load->model('logs/logs_model');
    $CI->load->model('ion_auth_model');
    $CI->load->model('hospital/hospital_model');



    // if ($CI->ion_auth->logged_in()) {
    //     if (!$CI->ion_auth->in_group(array('superadmin'))) {
    //         if ($CI->router->fetch_class() != 'settings' && $CI->router->fetch_class() != 'auth') {
    //             try {
    //                 $verify = $CI->settings_model->verify();
    //                 if ($verify['verified'] == 1) {
    //                 } else {
    //                     redirect('settings/verifyYourPruchase776cbvcfytfytfvvn');
    //                 }
    //             } catch (Exception $e) {
    //                 redirect('settings/verifyYourPruchase776cbvcfytfytfvvn');
    //             }
    //         }
    //     }
    // }



    if ($CI->router->fetch_class() == 'site' && $CI->router->fetch_method() == 'index') {
        $modules = $CI->db->get_where('hospital', array('id' => $CI->hospital_id))->row()->module;
        $CI->modules = explode(',', $modules);
        $hospital_username = $CI->uri->segment(2);
        $CI->hospital_id = $CI->db->get_where('hospital', array('username' => $hospital_username))->row()->id;
        if (!empty($CI->hospital_id)) {
            $newdata = array(
                'site_id' => $CI->hospital_id,
                'site_name' => $hospital_username,
                'hospital_id' => $CI->hospital_id
            );
            $CI->session->set_userdata($newdata);
        } else {
            redirect('home/permission');
        }
        $CI->db->where('hospital_id', $CI->session->userdata('site_id'));
        $language = $CI->db->get('site_settings')->row()->language;


        if (!empty($CI->session->userdata('language_site'))) {
            $language = $CI->session->userdata('language_site');
        }

        if (empty($language)) {
            $language = 'english';
        }


        $CI->language = $language;
        $CI->lang->load('system_syntax', $language);
    } elseif ($CI->router->fetch_class() == 'site' && ($CI->router->fetch_method() == 'getAvailableSlotByDoctorByDateByJason' || $CI->router->fetch_method() == 'getDoctorVisit' || $CI->router->fetch_method() == 'getDoctorVisitCharges')) {
        $CI->hospital_id = $CI->session->userdata('site_id');
    } else {
        if ($CI->ion_auth->logged_in()) {
            $user = $CI->ion_auth->get_user_id();
            $users_details = $CI->db->get_where('users', array('id' => $user))->row();

            if (!$CI->ion_auth->in_group(array('superadmin'))) {
                if (empty($users_details->hospital_ion_id)) {
                    $hospital = $CI->db->get_where('hospital', array('ion_user_id' => $users_details->id))->row();
                    $hospital_payment = $CI->db->get_where('hospital_payment', array('hospital_user_id' => $hospital->id))->row();
                    if (!empty($hospital_payment)) {
                        if ($hospital_payment->next_due_date_stamp < time()) {
                            $data_de = array();
                            $data_de = array('active' => 0);
                            $CI->db->where('id', $user);
                            $CI->db->update('users', $data_de);
                            $status = array('status' => 'expired');
                            $CI->db->where('id', $hospital_payment->id)->update('hospital_payment', $status);
                        }
                    }
                } else {
                    $hospital = $CI->db->get_where('hospital', array('ion_user_id' => $users_details->hospital_ion_id))->row();
                    $hospital_payment = $CI->db->get_where('hospital_payment', array('hospital_user_id' => $hospital->id))->row();
                    if (!empty($hospital_payment)) {
                        if ($hospital_payment->next_due_date_stamp < time()) {
                            $data_de = array();
                            $data_de = array('active' => 0);
                            $CI->db->where('id', $user);
                            $CI->db->update('users', $data_de);

                            $status = array('status' => 'expired');
                            $CI->db->where('id', $hospital_payment->id)->update('hospital_payment', $status);
                        }
                    }
                }
            }
        }

        if ($RTR->class != "cronjobs" && $RTR->class != "frontend" && $RTR->class != "payu" && $RTR->class != "status" && $RTR->class != "request" && $RTR->class != "auth" && $RTR->class != "api") {
            if (!$CI->ion_auth->in_group(array('superadmin'))) {
                if ($CI->ion_auth->in_group(array('admin'))) {
                    $current_user_id = $CI->ion_auth->user()->row()->id;
                    $CI->hospital_id = $CI->db->get_where('hospital', array('ion_user_id' => $current_user_id))->row()->id;
                    if (!empty($CI->hospital_id)) {
                        $newdata = array(
                            'hospital_id' => $CI->hospital_id,
                        );
                        $CI->session->set_userdata($newdata);
                    }
                } else {
                    $current_user_id = $CI->ion_auth->user()->row()->id;
                    $group_id = $CI->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                    $group_name = $CI->db->get_where('groups', array('id' => $group_id))->row()->name;
                    $group_name = strtolower($group_name);
                    $CI->hospital_id = $CI->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->hospital_id;
                    if (!empty($CI->hospital_id)) {
                        $newdata = array(
                            'hospital_id' => $CI->hospital_id,
                        );
                        $CI->session->set_userdata($newdata);
                    }
                }
            } else {
                $CI->hospital_id = 'superadmin';
                if (!empty($CI->hospital_id)) {
                    $newdata = array(
                        'hospital_id' => $CI->hospital_id,
                    );
                    $CI->session->set_userdata($newdata);
                }
            }
        }




        // Language
        if ($RTR->class != "cronjobs" && $RTR->class != "frontend" && $RTR->class != "payu" && $RTR->class != "status"  && $RTR->class != "request" && $RTR->class != "api") {
            if (!$CI->ion_auth->in_group(array('superadmin'))) {
                $CI->db->where('hospital_id', $CI->hospital_id);
                $CI->language = $CI->db->get('settings')->row()->language;
                $CI->hospital_language = $CI->language;
                $CI->lang->load('system_syntax', $CI->language);
                if ($CI->ion_auth->in_group(array('Patient'))) {
                    $CI->language = $CI->db->get_where('patient', array('ion_user_id' => $current_user_id))->row()->language;
                    if (empty($CI->language)) {
                        $CI->language = $CI->hospital_language;
                    }
                    if (!empty($CI->language)) {
                        $CI->lang->load('system_syntax', $CI->language);
                    }
                }
                if ($CI->ion_auth->in_group(array('Doctor'))) {
                    $CI->language = $CI->db->get_where('doctor', array('ion_user_id' => $current_user_id))->row()->language;
                    if (empty($CI->language)) {
                        $CI->language = $CI->hospital_language;
                    }
                    if (!empty($CI->language)) {
                        $CI->lang->load('system_syntax', $CI->language);
                    }
                }
            } else {
                $CI->db->where('hospital_id', 'superadmin');
                $CI->language = $CI->db->get('settings')->row()->language;
                $CI->lang->load('system_syntax', $CI->language);
            }
        }
        if ($RTR->class == "frontend" || $RTR->class == "request") {
            $CI->db->where('hospital_id', 'superadmin');
            $CI->language = $CI->db->get('settings')->row()->language;
            $CI->lang->load('system_syntax', $CI->language);
        }


        if ($CI->router->fetch_class() == 'frontend' && $CI->router->fetch_method() == 'index') {
            $language = $CI->session->userdata('language');
            if (empty($language)) {
                $language = 'english';
            }
            $CI->language = $language;
            $CI->lang->load('system_syntax', $language);
        }




        if ($RTR->class == "auth" && $CI->router->fetch_method() == 'login') {
            $CI->db->where('hospital_id', 'superadmin');
            $CI->language = $CI->db->get('settings')->row()->language;
            $CI->lang->load('system_syntax', $CI->language);
        }
        // Language



        // Currency
        if ($RTR->class != "cronjobs" && $RTR->class != "payu" && $RTR->class != "status" &&   $RTR->class != "auth" && $RTR->class != "frontend" && $RTR->class != "site") {
            if (!$CI->ion_auth->in_group(array('superadmin'))) {
                $CI->db->where('hospital_id', $CI->hospital_id);
                $CI->currency = $CI->db->get('settings')->row()->currency;
            } else {
                $CI->db->where('hospital_id', 'superadmin');
                $CI->currency = $CI->db->get('settings')->row()->currency;
            }
        }
        // Currency

        if ($RTR->class != "cronjobs" && $RTR->class != "payu" && $RTR->class != "status"  && $CI->ion_auth->in_group(array('admin', 'superadmin')) && $RTR->class != "auth" && $RTR->class != "site") {
            if (!$CI->ion_auth->in_group(array('superadmin')) && $RTR->class != "frontend") {
                $CI->db->where('hospital_id', $CI->hospital_id);
                $CI->settings = $CI->db->get('settings')->row();
            } else {
                $CI->db->where('hospital_id', 'superadmin');
                $CI->settings = $CI->db->get('settings')->row();
            }
            if ($CI->settings->emailtype == 'Domain Email') {

                $CI->load->library('email');
            }
            if ($CI->settings->emailtype == 'Smtp') {


                $email_Settings = $CI->db->get_where('email_settings', array('type' => $CI->settings->emailtype, 'hospital_id' => $CI->hospital_id))->row();

                $config['protocol'] = 'smtp';
                $config['mailpath'] = '/usr/sbin/sendmail';
                $config['smtp_host'] = $email_Settings->smtp_host;
                $config['smtp_port'] = $email_Settings->smtp_port;
                $config['smtp_user'] = $email_Settings->user;
                $config['smtp_pass'] = base64_decode($email_Settings->password);
                $config['smtp_crypto'] = 'tls';
                $config['mailtype'] = 'html';
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = TRUE;
                $config['send_multipart'] = TRUE;
                $config['newline'] = "\r\n";

                $CI->load->library('email');
                $CI->email->initialize($config);
                $CI->load->library('email');
            }
        }
        if ($RTR->class != "cronjobs" && $RTR->class != "payu" && $RTR->class != "status"  && $RTR->class != "frontend" && $RTR->class != "request" && $RTR->class != "auth" && $RTR->class != "api") {
            if (!$CI->ion_auth->in_group(array('superadmin'))) {
                if ($CI->ion_auth->in_group(array('admin'))) {
                    $current_user_id = $CI->ion_auth->user()->row()->id;
                    $modules = $CI->db->get_where('hospital', array('ion_user_id' => $current_user_id))->row()->module;
                    $CI->modules = explode(',', $modules);
                } else {
                    $current_user_id = $CI->ion_auth->user()->row()->id;

                    $group_id = $CI->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                    $group_name = $CI->db->get_where('groups', array('id' => $group_id))->row()->name;

                    $group_name = strtolower($group_name);

                    $hospital_id = $CI->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->hospital_id;

                    $modules = $CI->db->get_where('hospital', array('id' => $hospital_id))->row()->module;

                    $CI->modules = explode(',', $modules);
                }
            }
        }
        if ($RTR->class != "cronjobs" && $RTR->class != "payu" && $RTR->class != "status" &&  $RTR->class != "" && $RTR->class != "" && $RTR->class != "auth") {
            if ($CI->ion_auth->in_group(array('superadmin'))) {
                $current_user_id = $CI->ion_auth->user()->row()->id;
                $super_modules = $CI->db->get_where('superadmin', array('ion_user_id' => $current_user_id))->row()->module;
                $CI->super_modules = explode(',', $super_modules);
            }
        }

        $common = array('payu', 'status', 'macro', 'auth', 'pservice', 'frontend', 'settings', 'import', 'home', 'profile', 'request', 'api', 'cronjobs', 'logs', 'doctorvisit', 'site', 'testpkz', 'insurance', 'facilitie', 'faq', 'diagnosis', 'treatment', 'symptom', 'advice');

        if (!in_array($RTR->class, $common)) {
            if (!$CI->ion_auth->in_group(array('superadmin'))) {
                if ($RTR->class != "schedule" && $RTR->class != "meeting" && $RTR->class != "featured" && $RTR->class != "gallery" && $RTR->class != "review" && $RTR->class != "gridsection" && $RTR->class != "service" && $RTR->class != "slide" && $RTR->class != "facilitie" && $RTR->class != "faq") {
                    if ($RTR->class != "pgateway") {
                        if (!in_array($RTR->class, $CI->modules)) {
                            redirect('home');
                        }
                    } elseif (!in_array('finance', $CI->modules)) {
                        redirect('home');
                    }
                } elseif (!in_array('appointment', $CI->modules)) {
                    redirect('home');
                }
            } else {
                if (!in_array($RTR->class, $CI->super_modules)) {
                    redirect('home');
                }
            }
        }
    }



    if (!empty($CI->input->cookie('language_site'))) {
        $CI->language = $CI->input->cookie('language_site');
        $CI->lang->load('system_syntax', $CI->language);
    }


    // if ($RTR->class == "site") {
    //     if ($CI->router->fetch_method() == 'index') {

    //     }
    //     // $settings = $CI->db->get_where('settings', array('hospital_id' => $CI->session->userdata('hospital_id')))->row();
    //     // $CI->lang->load('system_syntax', $settings->language);
    // }
}
