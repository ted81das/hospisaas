<!DOCTYPE html>
<html lang="en">
<base href="<?php echo base_url(); ?>">
<?php
$settings = $this->site_model->getSettingsBySiteId($this->session->userdata('site_id'));
$title = explode(' ', $settings->title);

$this->db->where('hospital_id', $this->session->userdata('site_id'));
$site_name = $this->db->get('site_settings')->row()->title;
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="../../../../favicon.ico" />
    <title><?php echo $site_name; ?></title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo site_url('front/site_assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" />
    <!-- Font-awesome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- jQuery Plugins -->
    <link rel="stylesheet" href="<?php echo site_url('front/site_assets/vendor/owl-carousel/owl.carousel.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('front/site_assets/vendor/magnific-popup/magnific-popup.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('common/assets/bootstrap-datepicker/css/bootstrap-datepicker.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('common/assets/bootstrap-timepicker/compiled/timepicker.css'); ?>">

    <link rel="stylesheet" href="<?php echo site_url('front/css/responsive.css'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('front/assets/revolution_slider/css/rs-style.css'); ?>" media="screen">
    <link rel="stylesheet" href="<?php echo site_url('front/assets/revolution_slider/rs-plugin/css/settings.css'); ?>" media="screen">
    <!-- CSS Stylesheet -->
    <link href="<?php echo site_url('front/site_assets/css/style.css'); ?>" rel="stylesheet" />
    <link href="<?php echo site_url('front/site_assets/css/responsive.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo site_url('common/toastr/toastr.css'); ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <link href="common/extranal/css/site/site.css" rel="stylesheet">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- flag-icon-css -->
    <link rel="stylesheet" href="adminlte/plugins/flag-icon-css/css/flag-icon.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">








    <link href="common/assets/fontawesome5pro/css/all.min.css" rel="stylesheet" />
    <style>
        /* Add your custom styles here */
        #header_menu_top {
            background: linear-gradient(to right, #343a40, #212529);
            /* Dark gradient background */
            color: #fff;
            /* White text color */
            padding: 10px 0;
            /* Increase padding for better spacing */
        }

        .topbar-texts {
            margin-bottom: 0;
            font-size: 14px;
            /* Adjust font size */
        }

        .topbar-texts span {
            color: #ffc107;
            font-weight: bold;
            /* Make phone and login text bold */
        }

        .topbar-texts i {
            margin-right: 5px;
        }

        .topbar-link {
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
            /* Make link text bold */
        }

        .topbar-link:hover {
            text-decoration: underline;
            /* Add underline on hover */
        }

        .language-selector {
            margin-top: -20px;
        }
    </style>











</head>

<body>
    <!---------------- Start Main Navbar ---------------->


    <?php
    if ($this->language == 'arabic') {
        $flagIcon = 'sa';
    }
    if ($this->language == 'english') {
        $flagIcon = 'us';
    }
    if ($this->language == 'spanish') {
        $flagIcon = 'es';
    }
    if ($this->language == 'french') {
        $flagIcon = 'fr';
    }
    if ($this->language == 'italian') {
        $flagIcon = 'it';
    }
    if ($this->language == 'portuguese') {
        $flagIcon = 'pt';
    }
    if ($this->language == 'turkish') {
        $flagIcon = 'tr';
    }
    ?>


    <div id="header_menu_top" class="bg-dark text-white pt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <p class="topbar-texts">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <?php echo $settings->address; ?>
                    </p>
                </div>

                <div class="col-md-7 row">
                    <div class="col-md-5">
                        <p class="topbar-texts float-right">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span><?php echo $settings->phone; ?></span>
                        </p>

                    </div>

                    <div class="col-md-4">
                        <ul class="navbar-nav language-selector">
                            <li class="nav-item dropdown">
                                <a class="nav-link" data-toggle="dropdown">
                                    <button type="button" class="btn text-light btn-sm float-right">
                                        <i class="flag-icon flag-icon-<?php echo $flagIcon; ?>"></i>
                                        <span class="ml-2 text-lg" style="text-transform: capitalize;"><?php echo $this->language; ?> </span>
                                    </button>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right p-0">


                                    <?php
                                    $languages = $this->db->get('language')->result();
                                    foreach ($languages as $language) {
                                    ?>
                                        <a href="frontend/chooseLanguageForSite?lang=<?php echo $language->language; ?>" class="dropdown-item <?php if ($this->language ==  $language->language) echo 'active'; ?>">
                                            <i class="flag-icon flag-icon-<?php echo $language->flag_icon; ?> mr-2"></i> <?php echo $language->language; ?>
                                        </a>
                                    <?php } ?>

                                    <!-- <a href="frontend/chooseLanguageForSite?lang=english" class="dropdown-item <?php if ($this->language == 'english') echo 'active'; ?>">
                                        <i class="flag-icon flag-icon-us mr-2"></i> English
                                    </a>
                                    <a href="frontend/chooseLanguageForSite?lang=spanish" class="dropdown-item <?php if ($this->language == 'spanish') echo 'active'; ?>">
                                        <i class="flag-icon flag-icon-es mr-2"></i> Español
                                    </a>
                                    <a href="frontend/chooseLanguageForSite?lang=french" class="dropdown-item <?php if ($this->language == 'french') echo 'active'; ?>">
                                        <i class="flag-icon flag-icon-fr mr-2"></i> Français
                                    </a>
                                    <a href="frontend/chooseLanguageForSite?lang=italian" class="dropdown-item <?php if ($this->language == 'italian') echo 'active'; ?>">
                                        <i class="flag-icon flag-icon-it mr-2"></i> Italiano
                                    </a>
                                    <a href="frontend/chooseLanguageForSite?lang=portuguese" class="dropdown-item <?php if ($this->language == 'portuguese') echo 'active'; ?>">
                                        <i class="flag-icon flag-icon-pt mr-2"></i> Português
                                    </a>
                                    <a href="frontend/chooseLanguageForSite?lang=turkish" class="dropdown-item <?php if ($this->language == 'turkish') echo 'active'; ?>">
                                        <i class="flag-icon flag-icon-tr mr-2"></i> Türkçe
                                    </a> -->
                                </div>
                            </li>
                        </ul>

                    </div>

                    <div class="col-md-3">
                        <a href="<?php echo site_url('auth/login') ?>" target="_blank" class="topbar-link float-right">
                            <i class="nav-icon fas fa-sign-out-alt" aria-hidden="true"></i>
                            <span><?php echo lang('sign_in'); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <div id="header">
        <div class="navbar-wrap">
            <nav id="navbar_top" class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <a class="navbar-brand" href="site/<?php echo $this->session->userdata('site_name'); ?>#">
                        <?php
                        if (!empty($settings->logo)) {
                            if (file_exists($settings->logo)) {
                                echo '<img width="200" src=' . $settings->logo . '>';
                            } else {
                                echo $title[0] . '<span> ' . $title[1] . '</span>';
                            }
                        } else {
                            echo $title[0] . '<span> ' . $title[1] . '</span>';
                        }
                        ?>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>







                    <div class="collapse navbar-collapse navoption" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="site/<?php echo $this->session->userdata('site_name'); ?>#"><?php echo lang('home'); ?></a>
                            </li>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="site/<?php echo $this->session->userdata('site_name'); ?>#why_choose_us"><?php echo lang('book_an_appointment'); ?></a>
                            </li>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="site/<?php echo $this->session->userdata('site_name'); ?>#featured_services"><?php echo lang('services'); ?></a>
                            </li>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="site/<?php echo $this->session->userdata('site_name'); ?>#doctor"><?php echo lang('doctors'); ?></a>
                            </li>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="site/<?php echo $this->session->userdata('site_name'); ?>#portfolio"><?php echo lang('portfolio'); ?></a>
                            </li>
                            <!-- <li class="nav-item dropdown">
                                <a class="" data-toggle="dropdown">
                                    <button type="button" class="btn btn-sm">
                                        <i class="flag-icon flag-icon-<?php echo $flagIcon; ?>"></i>
                                        <span class="ml-2 text-lg" style="text-transform: capitalize;"><?php echo $this->language; ?> </span>
                                    </button>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right p-0">
                                    <a href="frontend/chooseLanguageForSite?lang=arabic" class="dropdown-item <?php if ($this->language == 'arabic') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <i class="flag-icon flag-icon-sa mr-2"></i> عربى
                                    </a>
                                    <a href="frontend/chooseLanguageForSite?lang=english" class="dropdown-item <?php if ($this->language == 'english') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <i class="flag-icon flag-icon-us mr-2"></i> English
                                    </a>
                                    <a href="frontend/chooseLanguageForSite?lang=spanish" class="dropdown-item <?php if ($this->language == 'spanish') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <i class="flag-icon flag-icon-es mr-2"></i> Español
                                    </a>
                                    <a href="frontend/chooseLanguageForSite?lang=french" class="dropdown-item <?php if ($this->language == 'french') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <i class="flag-icon flag-icon-fr mr-2"></i> Français
                                    </a>
                                    <a href="frontend/chooseLanguageForSite?lang=italian" class="dropdown-item <?php if ($this->language == 'italian') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <i class="flag-icon flag-icon-it mr-2"></i> Italiano
                                    </a>
                                    <a href="frontend/chooseLanguageForSite?lang=portuguese" class="dropdown-item <?php if ($this->language == 'portuguese') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <i class="flag-icon flag-icon-pt mr-2"></i> Português
                                    </a>
                                    <a href="frontend/chooseLanguageForSite?lang=turkish" class="dropdown-item <?php if ($this->language == 'turkish') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <i class="flag-icon flag-icon-tr mr-2"></i> Türkçe
                                    </a>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="owl-carousel headerSlider">
            <?php foreach ($slides as $slide) { ?>
                <div class="slide_class" style="background-image: url('<?php echo site_url($slide->img_url); ?>'); background-size: cover;
                         background-position: center;">
                    <div class="jumbotron jumbotron-fluid text-white">
                        <div class="container">
                            <h1><?php echo $slide->text1; ?></h1>
                            <h4><?php echo $slide->text2; ?></h4>
                            <p class="py-4"><?php echo $slide->text3; ?></p>
                            <a type="button" href="site#why_choose_us" class="btn btn-light"><?php echo lang('get_started_now'); ?></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
    <!---------------- End Main Navbar ---------------->

    <!---------------- Start Why Choose Us ---------------->
    <div id="why_choose_us" class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php
                    $message = $this->session->flashdata('feedback');
                    if (!empty($message)) {
                    ?>
                        <div class="flashmessage col-md-12 feedback_class"> <?php echo $message; ?></div>

                    <?php } ?>
                </div>
                <div class="col-md-6 d-flex align-items-center mb-4">
                    <div>
                        <h6><?php echo $settings->appointment_subtitle; ?></h6>
                        <h4><?php echo $settings->appointment_title; ?></h4>
                        <p>
                            <?php echo $settings->appointment_description; ?>
                        </p>
                        <a type="button" data-toggle="modal" data-target="#exampleModal" href="#" class="btn btn-light"><?php echo lang('book_an_appointment'); ?></a>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content bg-success text-custom">
                                    <div class="modal-header appointment_modal_header">
                                        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">
                                            <?php echo lang('book_an_appointment'); ?>
                                        </h5>
                                        <button type="button" class="close modal_close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body appointment_modal_body">
                                        <form action="<?php echo site_url('site/addNew'); ?>" method="post">
                                            <form action="site/addNew" method="post" id="addAppointmentForm">
                                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label>
                                                <select class="form-control m-bot15 js-example-basic-single pos_select" id="pos_select" name="patient" value=''>
                                                    <option value=" "><?php echo lang('select'); ?></option>
                                                    <option class="patient_add" value="patient_id"><?php echo lang('patient_id'); ?></option>
                                                    <option class="patient_add_new" value="add_new"><?php echo lang('add_new'); ?></option>
                                                </select>

                                                <div class="pos_client_id clearfix">

                                                    <div class="col-md-12 payment pad_bot float-right">
                                                        <div class="col-md-3 payment_label">
                                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('id'); ?></label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control pay_in" name="patient_id" placeholder="">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="pos_client clearfix">

                                                    <label for=""><?php echo lang('patient'); ?> <?php echo lang('name'); ?></label>
                                                    <input type="text" class="form-control" name="p_name">
                                                    <label for=""><?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                                                    <input type="email" class="form-control" name="p_email">
                                                    <label for=""><?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                                                    <input type="text" class="form-control" name="p_phone">

                                                    <label for=""><?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                                                    <select class="form-control" name="p_gender">
                                                        <option value="Male" <?php
                                                                                if (!empty($patient->sex)) {
                                                                                    if ($patient->sex == 'Male') {
                                                                                        echo 'selected';
                                                                                    }
                                                                                }
                                                                                ?>> <?php echo lang('male'); ?> </option>
                                                        <option value="Female" <?php
                                                                                if (!empty($patient->sex)) {
                                                                                    if ($patient->sex == 'Female') {
                                                                                        echo 'selected';
                                                                                    }
                                                                                }
                                                                                ?>> <?php echo lang('female'); ?> </option>

                                                    </select>
                                                </div>
                                                <div class="doctor_div">
                                                    <label for=""> <?php echo lang('doctor'); ?></label>
                                                    <select class="form-control" name="doctor" id="adoctors">
                                                        <option value=""><?php echo lang('select'); ?></option>
                                                        <?php foreach ($doctors as $doctor) { ?>
                                                            <option value="<?php echo $doctor->id; ?>" <?php
                                                                                                        if (!empty($payment->doctor)) {
                                                                                                            if ($payment->doctor == $doctor->id) {
                                                                                                                echo 'selected';
                                                                                                            }
                                                                                                        }
                                                                                                        ?>><?php echo $doctor->name; ?> </option>
                                                        <?php } ?>

                                                    </select>
                                                </div>


                                                <label for=""><?php echo lang('date'); ?></label>
                                                <input type="text" class="form-control default-date-picker" readonly="" id="date" name="date" id="" value='' placeholder="">
                                                <label for=""><?php echo lang('available_slots'); ?></label>
                                                <select class="form-control m-bot15" name="time_slot" id="aslots" value=''>

                                                </select>
                                                <label class=""><?php echo lang('visit'); ?> <?php echo lang('description'); ?></label>

                                                <select class="form-control m-bot15" name="visit_description" id="visit_description" value=''></select>
                                                <label for=""> <?php echo lang('remarks'); ?></label>
                                                <input type="text" class="form-control" name="remarks" id="" value='' placeholder="">
                                                <label for="exampleInputEmail1"><?php echo lang('visit'); ?> <?php echo lang('charges'); ?></label>
                                                <input type="number" class="form-control" name="visit_charges" id="visit_charges" value='' placeholder="" readonly="">
                                                <input type="hidden" name="discount" value='0'>
                                                <input type="hidden" name="grand_total" value='0'>
                                                <input type="hidden" name="redirectlink" value='site'>
                                                <input type="hidden" name="request" value=''>
                                                <div class="col-md-12">
                                                    <input type="checkbox" id="pay_now_appointment" name="pay_now_appointment" value="pay_now_appointment">
                                                    <label for=""> <?php echo lang('pay_now'); ?></label><br>

                                                </div>
                                                <div class="col-md-12">
                                                    <?php
                                                    $payment_gateway = $settings1->payment_gateway;

                                                    ?>



                                                    <div class="card1">

                                                        <hr>


                                                        <?php
                                                        if ($payment_gateway == 'PayPal') {
                                                        ?>
                                                            <div class="col-md-12 payment pad_bot">
                                                                <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('type'); ?></label>
                                                                <select class="form-control m-bot15" name="card_type" value=''>

                                                                    <option value="Mastercard"> <?php echo lang('mastercard'); ?> </option>
                                                                    <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                                                    <option value="American Express"> <?php echo lang('american_express'); ?> </option>
                                                                </select>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($payment_gateway == '2Checkout' || $payment_gateway == 'PayPal') {
                                                        ?>
                                                            <div class="col-md-12">
                                                                <label for="exampleInputEmail1"> <?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                                                                <input type="text" id="cardholder" class="form-control pay_in" name="cardholder" value='' placeholder="">
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack' && $payment_gateway != 'SSLCOMMERZ' && $payment_gateway != 'Paytm') { ?>
                                                            <div class="col-md-12">
                                                                <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                                                                <input type="text" id="card" class="form-control pay_in" name="card_number" value='' placeholder="">
                                                            </div>


                                                            <div class="col-md-12">
                                                                <div class="" style="">
                                                                    <label for="exampleInputEmail1"> <?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                                                                    <input type="text" class="form-control pay_in" id="expire" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="">
                                                                </div>
                                                                <div class="" style="">
                                                                    <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?> </label>
                                                                    <input type="text" class="form-control pay_in" id="cvv" maxlength="3" name="cvv" value='' placeholder="">
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>


                                                </div>
                                                <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
                                                <button type="submit" name="pay_now" id="submit-btn" class="btn btn-primary mt-3 float-right" <?php if ($settings1->payment_gateway == 'Stripe') {
                                                                                                                                                ?>onClick="stripePay(event);" <?php }
                                                                                                                                                                                ?> <?php if ($settings1->payment_gateway == '2Checkout' && $twocheckout->status == 'live') {
                                                                                                                                                                                    ?>onClick="twoCheckoutPay(event);" <?php }
                                                                                                                                                                                                                        ?>> <?php echo lang('submit'); ?></button>

                                            </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <img src="<?php echo $settings->appointment_img_url; ?>" class="img-fluid" alt="Doctor" />
                </div>
            </div>
        </div>
    </div>
    <!---------------- End Why Choose Us ---------------->

    <!---------------- Start Featured Area ---------------->
    <div id="featured" class="text-white">
        <?php
        $gridCount = 0;
        foreach ($gridsections as $gridsection) {
            $gridCount++;
            $remainder = $gridCount % 2;
            if ($remainder == 0) {
        ?>

                <div class="featured_bottom">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="text-center px-5">
                                <h6><?php echo $gridsection->category; ?></h6>
                                <h3><?php echo $gridsection->title; ?></h3>
                                <p>
                                    <?php echo $gridsection->description; ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 gridsection_img">
                            <img src="<?php echo $gridsection->img; ?>" class="img-fluid float-right" alt="" />
                        </div>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="featured_top">
                    <div class="row">
                        <div class="col-md-6 gridsection_img">
                            <img src="<?php echo $gridsection->img; ?>" class="img-fluid" alt="" />
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="text-center px-5">
                                <h6><?php echo $gridsection->category; ?></h6>
                                <h3><?php echo $gridsection->title; ?></h3>
                                <p>
                                    <?php echo $gridsection->description; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            <?php }
            ?>

        <?php } ?>

    </div>
    <!---------------- End Featured Area ---------------->

    <!---------------- Start Featured Services ---------------->
    <div id="featured_services" class="text-center my-5 featured_services">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-4 text-center">
                    <h1><?php echo lang('OUR_SERVICES'); ?></h1>
                    <h6 class="lead"><?php echo $settings->service_block__text_under_title; ?></h6>
                </div>
                <?php foreach ($services as $service) { ?>
                    <div class="col-md-4 mb-4">
                        <img src="<?php echo $service->img_url; ?>" class="img-fluid" alt="" />
                        <h3 class="mt-3"><?php echo $service->title; ?></h3>
                        <p><?php echo $service->description; ?></p>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
    <!---------------- End Featured Services ---------------->

    <!---------------- Start Featured Doctor ---------------->
    <div id="doctor" class="text-center my-5">
        <div class="container">
            <h3><?php echo lang('featured_doctors'); ?></h3>
            <h6>
                <?php echo $settings->doctor_block__text_under_title; ?>
            </h6>
            <div class="row mt-5">
                <?php
                $count = count($featureds);
                $i = 1;
                foreach ($featureds as $featured) {
                ?>
                    <div class="col-md-4 mb-4">
                        <img src="<?php echo $featured->img_url; ?>" height="200px" alt="" />
                        <h4 class="mt-3"><?php echo $featured->name; ?></h4>
                        <p>
                            <?php echo $featured->description; ?>
                        </p>
                    </div>
                <?php
                    $i = $i + 1;
                }
                ?>

            </div>
        </div>
    </div>
    <!---------------- End Featured Doctor ---------------->

    <!---------------- Start Gallery area ---------------->
    <div id="gallery" class="bg-light text-center my-4">
        <div class="container">
            <div class="row">
                <?php foreach ($images as $image) { ?>
                    <div class="col-md-4 mb-4">
                        <a href="<?php echo $image->img; ?>" class="gallery-item">
                            <img src="<?php echo $image->img; ?>" class="img-fluid" alt="" />
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!---------------- End Gallery area ---------------->

    <!---------------- Start Testimonials Slider Area ---------------->
    <div id="portfolio" class="my-5">
        <div class="portfolio-testimonials">
            <h2><?php echo lang('trusted_by_some_biggest_names'); ?></h2>
            <div class="owl-carousel owl-carousel1 owl-theme">
                <?php foreach ($reviews as $review) { ?>
                    <div>
                        <div class="card text-center">
                            <img class="card-img-top" src="<?php echo $review->img; ?>" alt="" />
                            <div class="card-body">
                                <h5>
                                    <?php echo $review->name; ?> <br />
                                    <span> <?php echo $review->designation; ?> </span>
                                </h5>
                                <p class="card-text">
                                    <?php echo $review->review; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!---------------- End Testimonials Slider Area ---------------->

    <!---------------- Start Footer Area ---------------->
    <div id="footer" class="text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <img src="<?php echo $settings->logo; ?>" class="img-fluid">

                </div>
                <div class="col-md-3 mb-3">
                    <h6 class="my-2"><?php echo lang('about_us'); ?></h6>
                    <p class="footer-description">
                        <?php echo $settings->description; ?>
                    </p>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="social-media text-center">
                        <h6 class="my-2"><?php echo lang('STAY_CONNECTED'); ?></h6>
                        <div class="social-icon">

                            <?php if (!empty($settings->facebook_id)) { ?>
                                <a href="<?php echo $settings->facebook_id; ?>">
                                    <div class=""><i class="fa fa-facebook"></i></div>
                                </a> <?php } ?>
                            <?php if (!empty($settings->google_id)) { ?>
                                <a href="<?php echo $settings->google_id; ?>">
                                    <div><i class="fa fa-google-plus"></i></div>
                                </a> <?php } ?>
                            <?php if (!empty($settings->twitter_id)) { ?>
                                <a href="<?php echo $settings->twitter_id; ?>">
                                    <div><i class="fa fa-twitter"></i></div>
                                </a> <?php } ?>
                            <?php if (!empty($settings->youtube_id)) { ?>
                                <a href="<?php echo $settings->youtube_id; ?>">
                                    <div><i class="fa fa-youtube"></i></div>
                                </a> <?php } ?>

                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <h6 class="my-2"><?php echo lang('CONTACT_INFO'); ?></h6>
                    <address>
                        <strong><?php echo lang('address'); ?>: <?php echo $settings->address; ?></strong><br />
                        <strong><?php echo lang('phone'); ?>: <?php echo $settings->phone; ?></strong><br />
                        <strong><?php echo lang('email'); ?>: <?php echo $settings->email; ?></strong>
                    </address>
                </div>
            </div>
        </div>
    </div>
    <!---------------- End Footer Area ---------------->

    <!-- Bootstrap core JavaScript  -->
    <script src="<?php echo site_url('front/site_assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/vendor/jquery/popper.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/vendor/owl-carousel/owl.carousel.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/vendor/magnific-popup/jquery.magnific-popup.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/js/main.js'); ?>"></script>
    <script src="<?php echo site_url('common/toastr/toastr.js'); ?>"></script>
    <script src="<?php echo site_url('front/js/wow/wow.min.js'); ?>"></script>
    <script src="front/js/smoothscroll/jquery.smoothscroll.min.js"></script>
    <script src="<?php echo site_url('front/js/script.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>"></script>


    <script>
        <?php if ($this->session->flashdata('success')) { ?>
            toastr.success("<?php echo $this->session->flashdata('success'); ?>");
        <?php } ?>
    </script>
    <script src="common/js/moment.min.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript" src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
    <script type="text/javascript">
        var publish = "<?php echo $gateway->publish; ?>";
    </script>
    <script type="text/javascript">
        var payment_gateway = "<?php echo $settings1->payment_gateway; ?>";
    </script>
    <?php if ($settings1->payment_gateway == '2Checkout') { ?>
        <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
        <script type="text/javascript">
            var publishable = "<?php echo $twocheckout->publishablekey; ?>";
        </script>
        <script type="text/javascript">
            var merchant = "<?php echo $twocheckout->merchantcode; ?>";
        </script>
    <?php } ?>
    <script type="text/javascript">
        var no_available_timeslots = "<?php echo lang('no_available_timeslots'); ?>";
    </script>




    <?php
    $language = $this->language;
    if ($language == 'english') {
        $lang = 'en-ca';
        $langdate = 'en-CA';
    } elseif ($language == 'spanish') {
        $lang = 'es';
        $langdate = 'es';
    } elseif ($language == 'french') {
        $lang = 'fr';
        $langdate = 'fr';
    } elseif ($language == 'portuguese') {
        $lang = 'pt';
        $langdate = 'pt';
    } elseif ($language == 'arabic') {
        $lang = 'ar';
        $langdate = 'ar';
    } elseif ($language == 'italian') {
        $lang = 'it';
        $langdate = 'it';
    } elseif ($language == 'zh_cn') {
        $lang = 'zh-cn';
        $langdate = 'zh-CN';
    } elseif ($language == 'japanese') {
        $lang = 'ja';
        $langdate = 'ja';
    } elseif ($language == 'russian') {
        $lang = 'ru';
        $langdate = 'ru';
    } elseif ($language == 'turkish') {
        $lang = 'tr';
        $langdate = 'tr';
    } elseif ($language == 'indonesian') {
        $lang = 'id';
        $langdate = 'id';
    }
    ?>

    <script type="text/javascript">
        var langdate = "<?php echo $langdate; ?>";
        $(document).ready(function() {
            $('.readonly').keydown(function(e) {
                e.preventDefault();
            });

        })
    </script>

    <style>
        .flag-icon {
            font-size: 17px;
        }
    </style>

    <script src="common/assets/bootstrap-datepicker/locales/bootstrap-datepicker.<?php echo $langdate; ?>.min.js"></script>
    <script src="common/extranal/js/site/site.js"></script>


</body>

</html>