<script type="text/javascript" src="common/js/google-loader.js"></script>
<div class="content-wrapper bg-light">

    <section class="content-header">
        <div class="container-fluid mt-5">
            <div class="row my-2 pl-1">
                <div class="col-sm-6 pl-4">
                    <div class="welcome-text-container">
                        <?php
                        $user_id = $this->ion_auth->user()->row()->id;
                        $user_image = $this->db->get_where('users', array('id' => $user_id))->row()->img_url;
                        $default_image = 'uploads/default.png';
                        ?>
                        <div class="d-flex align-items-center">
                            <div class="user-image-container mr-3">
                                <img src="<?php echo $user_image ? base_url() . $user_image : base_url() . $default_image; ?>"
                                    alt="User Image"
                                    class="img-circle elevation-2"
                                    style="width: 70px; height: 70px; object-fit: cover; margin-top: -20px;">
                            </div>
                            <div>
                                <h1 class="font-weight-bold welcome-text title-spacing mb-0">
                                    <?php echo lang('welcome') ?>,
                                    <?php
                                    $username = $this->ion_auth->user()->row()->username;
                                    if (!empty($username)) {
                                        echo $username;
                                    }
                                    ?>!
                                </h1>
                                <p class="welcome-text mt-2">Welcome to the dashboard of <?php echo $settings->title ?? ''; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 address-text">
                    <div class="d-flex justify-content-end">
                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <a href="finance/addPaymentView" class="btn btn-primary mr-2 px-4 py-3 text-sm">
                                <i class="fa fa-plus mr-1"></i> <?php echo lang('new_invoice'); ?>
                            </a>
                            <a href="patient/addNewView" class="btn btn-success mr-2 px-4 py-3 text-sm">
                                <i class="fa fa-plus mr-1"></i> <?php echo lang('add_patient'); ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="<?php if ($this->ion_auth->in_group(array('admin'))) {
                                echo 'col-md-6 col-lg-6 col-12';
                            } else {
                                echo 'col-12';
                            } ?>">
                    <div class="">
                        <div class="modal fade" role="dialog" id="cmodal">
                            <div class="modal-dialog modal-xl header_modal" role="document">
                                <div class="modal-content">
                                    <div id='medical_history' class="row">
                                        <div class="col-md-12">

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                            <?php if (in_array('appointment', $this->modules)) { ?>
                                <div class="row state-overview col-md-5 state_overview_design">
                                    <header class="card-header">
                                        <i class="fa fa-user"></i> <?php echo lang('todays_appointments'); ?>
                                    </header>
                                    <div class="card-body">
                                        <div class="adv-table editable-table ">
                                            <div class="space15"></div>
                                            <table class="table table-striped table-hover table-bordered" id="editable-samplee">
                                                <thead>
                                                    <tr>
                                                        <th> <?php echo lang('patient_id'); ?></th>
                                                        <th> <?php echo lang('name'); ?></th>
                                                        <th> <?php echo lang('date-time'); ?></th>
                                                        <th> <?php echo lang('status'); ?></th>
                                                        <th> <?php echo lang('options'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($appointments as $appointment) {
                                                        if ($appointment->date == strtotime(date('Y-m-d'))) {
                                                    ?>
                                                            <tr class="">
                                                                <td> <?php echo $this->db->get_where('patient', array('id' => $appointment->patient))->row()->id; ?></td>
                                                                <td> <?php echo $this->db->get_where('patient', array('id' => $appointment->patient))->row()->name; ?></td>

                                                                <td class="center"> <strong> <?php echo $appointment->s_time; ?> </strong></td>
                                                                <td>
                                                                    <?php echo $appointment->status; ?>
                                                                </td>
                                                                <td>
                                                                    <a class="btn detailsbutton" title="<?php lang('history') ?>" href="patient/medicalHistory?id=<?php echo $appointment->patient ?>"><i class="fa fa-stethoscope"></i> <?php echo lang('history'); ?></a>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        <?php } ?>
                        <?php if (!$this->ion_auth->in_group('superadmin')) { ?>
                            <?php if (!$this->ion_auth->in_group('Doctor')) { ?>


                                <style>
                                    .card-custom {
                                        border: none;
                                        border-radius: 0.5rem;
                                        transition: transform 0.2s ease-in-out;
                                    }

                                    .card-custom:hover {
                                        /* transform: scale(1.05); */
                                    }

                                    .card-body-custom {
                                        /* padding: 0 rem; */
                                    }

                                    .icon-custom {
                                        font-size: 3rem;
                                        color: rgba(0, 0, 0, 0.1);
                                        font-size: 2rem;
                                    }

                                    .inner-custom {
                                        display: flex;
                                        justify-content: space-between;
                                        align-items: center;
                                    }

                                    .text-custom {
                                        font-size: 1.25rem;
                                        font-weight: bold;
                                    }

                                    .stat-number {
                                        font-size: 2rem;
                                        font-weight: bold;
                                    }

                                    .stat-text {
                                        font-size: 1rem;
                                    }



                                    .analytics {
                                        background: #f8f9fa !important;
                                    }
                                </style>

                                <div class="container-fluid pr-0" style="margin-top: -1rem;">
                                    <div class="row g-3 mt-2 mb-2">
                                        <style>
                                            .stat-card {
                                                background-color: hsl(00, 0%, 100%);
                                                border-radius: 5px;
                                                transition: all 0.3s ease;
                                                overflow: hidden;
                                            }



                                            .stat-card a {
                                                text-decoration: none;
                                            }

                                            .stat-card-body {
                                                padding: 1rem;
                                                position: relative;
                                            }

                                            .stat-number {
                                                font-size: clamp(1rem, 2vw, 2.75rem);
                                                font-weight: 700;
                                                color: #555;
                                                margin-bottom: 0.75rem;
                                                word-break: break-word;
                                            }

                                            .stat-text {
                                                color: #555;
                                                word-wrap: break-word;
                                            }

                                            @media screen and (min-width: 1600px) and (max-width: 1920px) {
                                                .stat-number {
                                                    font-size: clamp(1.5rem, 2.5vw, 2.5rem);
                                                }

                                                .stat-text {
                                                    font-size: clamp(0.8rem, 1vw, 1.1rem);
                                                }
                                            }

                                            @media screen and (min-width: 1300px) and (max-width: 1599px) {
                                                .stat-number {
                                                    font-size: clamp(1.5rem, 4vw, 2.5rem);
                                                }

                                                .stat-text {
                                                    font-size: 13px;
                                                }

                                                .card-custom {
                                                    font-size: 1rem;
                                                }
                                            }

                                            @media screen and (min-width: 1200px) and (max-width: 1299px) {
                                                .stat-number {
                                                    font-size: clamp(1.5rem, 4vw, 2.5rem);
                                                }

                                                .stat-text {
                                                    font-size: 10px;
                                                }

                                                .card-custom {
                                                    font-size: 1rem;
                                                }
                                            }


                                            @media screen and (min-width: 768px) and (max-width: 1199px) {
                                                .stat-number {
                                                    font-size: clamp(1.5rem, 4vw, 2.5rem);
                                                }

                                                .stat-text {
                                                    font-size: 8px;
                                                }
                                            }




                                            @media screen and (max-width: 767px) {
                                                .stat-number {
                                                    font-size: 3rem;
                                                }

                                                .stat-text {
                                                    font-size: 1rem;
                                                }
                                            }

                                            .stat-icon {
                                                font-size: clamp(2rem, 4vw, 3.5rem);
                                                color: rgba(255, 255, 255, 0.2);
                                                position: absolute;
                                                bottom: 1rem;
                                                right: 1rem;
                                                opacity: 0.2;



                                            }

                                            @media (max-width: 768px) {
                                                .stat-card-body {
                                                    padding: 1.25rem;
                                                }

                                                .stat-icon {
                                                    font-size: 2rem;
                                                    bottom: 0.5rem;
                                                    right: 0.5rem;
                                                }

                                                .welcome-text {
                                                    font-size: 1.5rem !important;
                                                }

                                                .address-text {
                                                    text-align: center;
                                                    display: flex;
                                                    justify-content: center;
                                                    align-items: center;
                                                    margin-top: 1rem;

                                                }

                                                .logs-row {
                                                    display: none;
                                                }



                                            }
                                        </style>



                                        <?php if (in_array('doctor', $this->modules)) { ?>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="stat-card h-100 shadow-lg custom-rounded ml-2 text-center">
                                                    <a href="finance/payment">
                                                        <div class="stat-card-body">

                                                            <p class="badge badge-primary text-sm mb-0 bg-transparent"><?php echo lang('total'); ?> <?php echo lang('bill'); ?></p> <br>
                                                            <span class="sub-text fw-bold"><?php echo lang('this_month'); ?> </span>
                                                            <h2 class="dashboard-title text-primary"><?php echo $settings->currency ?? ''; ?><?php echo format_number_short($this_month['payment'] ?? 0); ?></h2>
                                                            <div class="percentage-change text-xs">
                                                                <?php
                                                                $percentage_change_bill = isset($percentage_change_bill) ? $percentage_change_bill : 0;
                                                                if ($percentage_change_bill > 0): ?>
                                                                    <span class="text-success"><i class="fas fa-arrow-up"></i> <?php echo $percentage_change_bill; ?>%</span>
                                                                <?php elseif ($percentage_change_bill < 0): ?>
                                                                    <span class="text-danger"><i class="fas fa-arrow-down"></i> <?php echo $percentage_change_bill; ?>%</span>
                                                                <?php else: ?>
                                                                    <span><?php echo $percentage_change_bill; ?>%</span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>



                                        <?php if (in_array('patient', $this->modules)) { ?>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="stat-card h-100 shadow-lg custom-rounded mr-2 text-center">
                                                    <a href="finance/payment">
                                                        <div class="stat-card-body">
                                                            <p class="badge badge-primary text-sm mb-0 bg-transparent"><?php echo lang('total'); ?> <?php echo lang('deposit'); ?></p><br>
                                                            <span class="sub-text fw-bold"><?php echo lang('this_month'); ?> </span>
                                                            <h2 class="dashboard-title text-success"><?php echo $settings->currency ?? ''; ?><?php echo format_number_short($this_month['deposit'] ?? 0, 2, '.', ','); ?></h2>
                                                            <div class="percentage-change text-xs">
                                                                <?php
                                                                $percentage_change_deposit = isset($percentage_change_deposit) ? $percentage_change_deposit : 0;
                                                                if ($percentage_change_deposit > 0): ?>
                                                                    <span class="text-success"><i class="fas fa-arrow-up"></i> <?php echo $percentage_change_deposit; ?>%</span>
                                                                <?php elseif ($percentage_change_deposit < 0): ?>
                                                                    <span class="text-danger"><i class="fas fa-arrow-down"></i> <?php echo $percentage_change_deposit; ?>%</span>
                                                                <?php else: ?>
                                                                    <span><?php echo $percentage_change_deposit; ?>%</span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if (in_array('appointment', $this->modules)) { ?>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="stat-card h-100 shadow-lg custom-rounded ml-2 text-center">
                                                    <a href="finance/dueCollection">
                                                        <div class="stat-card-body">
                                                            <p class="badge badge-primary text-sm mb-0 bg-transparent"><?php echo lang('pending'); ?></p><br>
                                                            <span class="sub-text fw-bold"><?php echo lang('this_month'); ?> </span>
                                                            <h2 class="dashboard-title text-orange"><?php echo $settings->currency ?? ''; ?><?php echo format_number_short($this_month['due'] ?? 0, 2, '.', ','); ?></h2>
                                                            <div class="percentage-change text-xs">

                                                                <?php
                                                                if ($percentage_change_due > 0): ?>
                                                                    <span class="text-success"><i class="fas fa-arrow-up"></i> <?php echo $percentage_change_due; ?>%</span>
                                                                <?php elseif ($percentage_change_due < 0): ?>
                                                                    <span class="text-danger"><i class="fas fa-arrow-down"></i> <?php echo $percentage_change_due; ?>%</span>
                                                                <?php else: ?>
                                                                    <span><?php echo $percentage_change_due; ?>%</span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if (in_array('prescription', $this->modules)) { ?>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="stat-card h-100 shadow-lg custom-rounded mr-2 text-center">
                                                    <a href="finance/expense">
                                                        <div class="stat-card-body">
                                                            <p class="badge badge-primary text-sm mb-0 bg-transparent"><?php echo lang('total'); ?> <?php echo lang('expense'); ?></p><br>
                                                            <span class="sub-text fw-bold"><?php echo lang('this_month'); ?> </span>
                                                            <h2 class="dashboard-title text-info"><?php echo $settings->currency ?? ''; ?><?php echo format_number_short($this_month['expense'] ?? 0, 2, '.', ','); ?></h2>
                                                            <div class="percentage-change text-xs">

                                                                <?php
                                                                $percentage_change_expense = isset($percentage_change_expense) ? $percentage_change_expense : 0;
                                                                if ($percentage_change_expense > 0): ?>
                                                                    <span class="text-success"><i class="fas fa-arrow-up"></i> <?php echo $percentage_change_expense; ?>%</span>
                                                                <?php elseif ($percentage_change_expense < 0): ?>
                                                                    <span class="text-danger"><i class="fas fa-arrow-down"></i> <?php echo $percentage_change_expense; ?>%</span>
                                                                <?php else: ?>
                                                                    <span><?php echo $percentage_change_expense; ?>%</span>
                                                                <?php endif; ?>

                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                        <?php if (in_array('finance', $this->modules)) { ?>
                                            <div class="row g-2">
                                                <div class="col-lg-12 col-sm-12">
                                                    <div class="card card-custom shadow-lg custom-rounded mx-1 m-2">
                                                        <div class="card-body">
                                                            <h5 class="border-bottom pb-4 py-2 text-sm fw-bold"><?php echo lang('sales_vs_expenses') ?> <span class="text-xs badge badge-secondary ml-2 p-2"><?php echo lang('this_year') ?></span></h5>
                                                            <div id="sales_expense_chart" style="width: 100%; height: 300px;"></div>
                                                            <script type="text/javascript">
                                                                google.charts.load('current', {
                                                                    packages: ['corechart']
                                                                });
                                                                google.charts.setOnLoadCallback(drawSalesExpenseChart);

                                                                function drawSalesExpenseChart() {
                                                                    var data = google.visualization.arrayToDataTable([
                                                                        ['Month', '<?php echo lang('sales'); ?>', '<?php echo lang('expense'); ?>'],
                                                                        ['Jan', <?php echo $this_year['payment_per_month']['january'] ?? 0; ?>, <?php echo $this_year['expense_per_month']['january'] ?? 0; ?>],
                                                                        ['Feb', <?php echo $this_year['payment_per_month']['february'] ?? 0; ?>, <?php echo $this_year['expense_per_month']['february'] ?? 0; ?>],
                                                                        ['Mar', <?php echo $this_year['payment_per_month']['march'] ?? 0; ?>, <?php echo $this_year['expense_per_month']['march'] ?? 0; ?>],
                                                                        ['Apr', <?php echo $this_year['payment_per_month']['april'] ?? 0; ?>, <?php echo $this_year['expense_per_month']['april'] ?? 0; ?>],
                                                                        ['May', <?php echo $this_year['payment_per_month']['may'] ?? 0; ?>, <?php echo $this_year['expense_per_month']['may'] ?? 0; ?>],
                                                                        ['June', <?php echo $this_year['payment_per_month']['june'] ?? 0; ?>, <?php echo $this_year['expense_per_month']['june'] ?? 0; ?>],
                                                                        ['July', <?php echo $this_year['payment_per_month']['july'] ?? 0; ?>, <?php echo $this_year['expense_per_month']['july'] ?? 0; ?>],
                                                                        ['Aug', <?php echo $this_year['payment_per_month']['august'] ?? 0; ?>, <?php echo $this_year['expense_per_month']['august'] ?? 0; ?>],
                                                                        ['Sep', <?php echo $this_year['payment_per_month']['september'] ?? 0; ?>, <?php echo $this_year['expense_per_month']['september'] ?? 0; ?>],
                                                                        ['Oct', <?php echo $this_year['payment_per_month']['october'] ?? 0; ?>, <?php echo $this_year['expense_per_month']['october'] ?? 0; ?>],
                                                                        ['Nov', <?php echo $this_year['payment_per_month']['november'] ?? 0; ?>, <?php echo $this_year['expense_per_month']['november'] ?? 0; ?>],
                                                                        ['Dec', <?php echo $this_year['payment_per_month']['december'] ?? 0; ?>, <?php echo $this_year['expense_per_month']['december'] ?? 0; ?>]
                                                                    ]);

                                                                    var options = {
                                                                        hAxis: {
                                                                            margin: 0,
                                                                            padding: 0
                                                                        },
                                                                        vAxis: {
                                                                            margin: 0,
                                                                            padding: 0
                                                                        },
                                                                        chartArea: { // Reduce chartArea margins
                                                                            left: 50, // Adjust values to minimize white space
                                                                            right: 50,
                                                                            top: 50,
                                                                            bottom: 20,
                                                                            width: '100%',
                                                                            height: '80%' // Use more space for the chart itself
                                                                        },
                                                                        seriesType: 'area',
                                                                        series: {
                                                                            0: {
                                                                                type: 'area'
                                                                            },
                                                                            1: {
                                                                                type: 'area'
                                                                            }
                                                                        },
                                                                        colors: ['#FAD380', '#FD6B01']
                                                                    };

                                                                    var chart = new google.visualization.ComboChart(document.getElementById('sales_expense_chart'));
                                                                    chart.draw(data, options);
                                                                }
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>

                                    <?php if ($this->ion_auth->in_group(array('Nurse'))) { ?>
                                        <?php if (in_array('notice', $this->modules)) { ?>
                                            <div class="row g-2 mt-4">
                                                <div class="col-md-7 col-sm-12">
                                                    <div class="card card-custom shadow-lg custom-rounded m-2">
                                                        <div class="card-header badge-secondary text-white">
                                                            <h5 class="mb-0"><?php echo lang('notice'); ?></h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <table class="table table-bordered table-hover" id="editable-sample">
                                                                <thead>
                                                                    <tr>
                                                                        <th><?php echo lang('title'); ?></th>
                                                                        <th><?php echo lang('description'); ?></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($notices as $notice) { ?>
                                                                        <tr>
                                                                            <td><?php echo $notice->title; ?></td>
                                                                            <td><?php echo $notice->description; ?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                            <div class="d-flex justify-content-between">
                                                                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                                    <a class="btn btn-success btn-sm" href="notice/addNewView"><?php echo lang('add'); ?> <?php echo lang('notice'); ?></a>
                                                                <?php } ?>
                                                                <a class="btn btn-success btn-sm my-3" href="notice"><?php echo lang('all'); ?> <?php echo lang('notice'); ?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>


                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                        <div class="row logs-row">
                                            <div class="col-md-12">
                                                <div class="card card-custom shadow-lg custom-rounded m-2">
                                                    <div class="card-header py-4">
                                                        <h5 class="mb-0 font-weight-bold text-sm"><?php echo lang('latest_logs'); ?></h5>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="list-group">
                                                            <?php
                                                            $this->load->model('logs/logs_model');
                                                            $latest_logs = $this->logs_model->getLogsByLimit(5, 0, 'id', 'desc');
                                                            foreach ($latest_logs as $log) { ?>
                                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                        <h6 class="mb-1 fw-bold"><?php echo $log->name; ?></h6>
                                                                        <small class="text-muted"><?php echo $log->role; ?></small>
                                                                    </div>
                                                                    <div class="text-end">
                                                                        <small class="text-muted"><?php echo date('M d, Y H:i', strtotime($log->date_time)); ?></small>
                                                                        <div><?php echo $log->email; ?></div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer badge-white">
                                                        <div class="d-flex justify-content-end">
                                                            <a class="btn btn-info btn-sm" href="logs"><?php echo lang('all'); ?> <?php echo lang('logs'); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-2 logs-row">
                                            <div class="col-md-12">
                                                <div class="card card-custom shadow-lg custom-rounded m-2">
                                                    <div class="card-header py-4">
                                                        <h5 class="mb-0 font-weight-bold text-sm"><?php echo lang('latest_transaction_logs'); ?></h5>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover mb-0">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th class="border-top-0"><?php echo lang('time'); ?></th>
                                                                        <th class="border-top-0 text-right"><?php echo lang('invoice'); ?></th>
                                                                        <th class="border-top-0 text-right"><?php echo lang('patient'); ?></th>
                                                                        <th class="border-top-0 text-right"><?php echo lang('amount'); ?></th>
                                                                        <th class="border-top-0 text-right"><?php echo lang('action'); ?></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $this->load->model('logs/logs_model');
                                                                    $latest_transaction_logs = $this->logs_model->getTransactionLogsByLimit(5, 0, 'id', 'desc');
                                                                    foreach ($latest_transaction_logs as $log) {
                                                                        $action = '';
                                                                        switch ($log->action) {
                                                                            case 'Added':
                                                                                $action = '<span class="badge badge-success">' . lang('added') . '</span>';
                                                                                break;
                                                                            case 'Added/Deposited':
                                                                                $action = '<span class="badge badge-success">' . lang('added') . ' ' . lang('deposited') . '</span>';
                                                                                break;
                                                                            case 'Updated':
                                                                                $action = '<span class="badge badge-success">' . lang('updated') . '</span>';
                                                                                break;
                                                                            case 'deleted_deposit':
                                                                                $action = '<span class="badge badge-danger">' . lang('deleted') . ' ' . 'Deposit' . '</span>';
                                                                                break;
                                                                            case 'deleted':
                                                                                $action = '<span class="badge badge-danger">' . lang('deleted') . '</span>';
                                                                                break;
                                                                            default:
                                                                                $action = '<span class="badge badge-info">' . lang('updated') . ' ' . lang('deposited') . '</span>';
                                                                        }
                                                                    ?>
                                                                        <tr>
                                                                            <td class="border-0">
                                                                                <strong><?php echo date('M d, Y', strtotime($log->date_time)); ?></strong> <br>
                                                                                <span class="text-muted text-sm"><?php echo date('H:i', strtotime($log->date_time)); ?></span>
                                                                            </td>
                                                                            <td class="text-right border-0"><a target="_blank" <?php if ($log->action != 'deleted') {
                                                                                                                                    echo 'href="' . site_url('finance/invoice?id=' . $log->invoice_id) . '"';
                                                                                                                                } ?>><?php echo $log->invoice_id; ?></a></td>
                                                                            <td class="text-right border-0"><?php echo $log->patientname; ?></td>
                                                                            <td class="text-right border-0"><?php echo number_format($log->amount, 2); ?></td>
                                                                            <td class="text-right border-0"><?php echo $action; ?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer badge-white">
                                                        <div class="d-flex justify-content-end">
                                                            <a class="btn btn-success btn-sm" href="logs/transactionLogs"><?php echo lang('all'); ?> <?php echo lang('transaction_logs'); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>






                                    <div class="row g-2">
                                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                            <?php if (in_array('appointment', $this->modules)) { ?>
                                                <div class="col-md-12">
                                                    <div class="card card-custom shadow-lg custom-rounded m-2">
                                                        <div class="card-header badge-transparent text-left pt-4 pb-3">
                                                            <h5 class="fw-bold text-sm"><?php echo lang('appointment'); ?> <?php echo lang('calendar'); ?></h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div id="calendar"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>

                                </div>





                            <?php } ?>

                        <?php } else { ?>
                            <?php if (in_array('home', $this->super_modules)) { ?>

                                <div class="row state-overview col-md-12 state_overview_design">

                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <a href="hospital" class="small-box-footer">
                                            <div class="small-box badge-info">
                                                <div class="inner">
                                                    <h3>
                                                        <?php
                                                        $count = 0;
                                                        $hospitalList = $this->db->get('hospital')->result();
                                                        foreach ($hospitalList as $hospitalList) {
                                                            $count = $count + 1;
                                                        }

                                                        echo $count;
                                                        ?>
                                                    </h3>

                                                    <p class="text-lg"><?php echo lang('total'); ?> <?php echo lang('hospitals'); ?></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-hospital"></i>
                                                </div>
                                                <?php if ($this->ion_auth->in_group('superadmin')) { ?>
                                                    <!-- <a href="hospital" class="small-box-footer"><?php echo lang("more_infoo"); ?> <i class="fas fa-arrow-circle-right"></i></a> -->
                                                <?php } ?>
                                            </div>
                                        </a>
                                    </div>
                                    </a>

                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <a href=" hospital/active" class="small-box-footer">
                                            <div class="small-box badge-success">
                                                <div class="inner">
                                                    <h3>
                                                        <?php
                                                        $count = 0;
                                                        $hospitalList = $this->db->get('hospital')->result();
                                                        foreach ($hospitalList as $hospitalList) {
                                                            $this->db->where('id', $hospitalList->ion_user_id);
                                                            $status = $this->db->get('users')->row();
                                                            if ($status->active == "1") {
                                                                $count = $count + 1;
                                                            }
                                                        }

                                                        echo $count;
                                                        ?>
                                                    </h3>

                                                    <p class="text-lg"><?php echo lang('active'); ?> <?php echo lang('hospitals'); ?></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <?php if ($this->ion_auth->in_group('superadmin')) { ?>
                                                    <!-- <a href=" hospital/active" class="small-box-footer"><?php echo lang("more_infoo"); ?> <i class="fas fa-arrow-circle-right"></i></a> -->
                                                <?php } ?>
                                            </div>
                                        </a>
                                    </div>
                                    </a>

                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <a href="hospital/disable" class="small-box-footer">
                                            <div class="small-box badge-secondary">
                                                <div class="inner">
                                                    <h3>
                                                        <?php
                                                        $count = 0;
                                                        $hospitalList = $this->db->get('hospital')->result();
                                                        foreach ($hospitalList as $hospitalList) {
                                                            $this->db->where('id', $hospitalList->ion_user_id);
                                                            $status = $this->db->get('users')->row();
                                                            if ($status->active == "0") {
                                                                $count = $count + 1;
                                                            }
                                                        }

                                                        echo $count;
                                                        ?>
                                                    </h3>

                                                    <p class="text-lg"><?php echo lang('inactive'); ?> <?php echo lang('hospitals'); ?></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-pause"></i>
                                                </div>
                                                <?php if ($this->ion_auth->in_group('superadmin')) { ?>
                                                    <!-- <a href="hospital/disable" class="small-box-footer"><?php echo lang("more_infoo"); ?> <i class="fas fa-arrow-circle-right"></i></a> -->
                                                <?php } ?>
                                            </div>
                                        </a>
                                    </div>
                                    </a>

                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <a href="systems/expiredHospitals" class="small-box-footer">
                                            <div class="small-box badge-danger">
                                                <div class="inner">
                                                    <h3>
                                                        <?php
                                                        $count = 0;
                                                        $hospitalRequestList = $this->db->get('hospital_payment')->result();

                                                        foreach ($hospitalRequestList as $hospitalRequestList) {

                                                            if ($hospitalRequestList->next_due_date_stamp < time()) {
                                                                $hospital_details = $this->db->get_where('hospital', array('id' => $hospitalRequestList->hospital_user_id))->row();
                                                                if (!empty($hospital_details)) {
                                                                    $count = $count + 1;
                                                                }
                                                            }
                                                        }


                                                        echo $count;

                                                        ?>
                                                    </h3>

                                                    <p class="text-lg"><?php echo lang('licence_expired'); ?></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-ban"></i>
                                                </div>
                                                <?php if ($this->ion_auth->in_group('superadmin')) { ?>
                                                    <!-- <a href="systems/expiredHospitals" class="small-box-footer"><?php echo lang("more_infoo"); ?> <i class="fas fa-arrow-circle-right"></i></a> -->
                                                <?php } ?>
                                            </div>
                                        </a>
                                    </div>
                                    </a>


                                </div>
                                <div class="row">
                                    <div class="col-lg-8 col-sm-12">
                                        <div id="chart_div_superadmin" class="card"></div>

                                    </div>
                                    <div class="col-lg-4 col-sm-6">

                                        <div id="piechart_3d_superadmin" class="card"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <section class="card">
                                            <header class="card-header">
                                                <?php echo date('D d F, Y'); ?>
                                            </header>
                                            <div class="card-body">

                                                <div class="home_section">
                                                    <?php echo lang('monthly'); ?> <?php echo lang('subscription'); ?>: <?php echo $settings->currency; ?> <?php echo format_number_short($this_day['payment'], 2, '.', ','); ?>
                                                    <hr>
                                                </div>
                                                <div class="home_section">
                                                    <?php echo lang('yearly'); ?> <?php echo lang('subscription'); ?>: <?php echo $settings->currency; ?> <?php echo format_number_short($this_day['payment_yearly'], 2, '.', ','); ?>
                                                    <hr>
                                                </div>
                                                <div class="home_section">
                                                    <?php echo lang('total'); ?> <?php echo lang('income'); ?> : <?php echo $settings->currency; ?> <?php echo format_number_short($this_day['payment'] + $this_day['payment_yearly'], 2, '.', ','); ?>
                                                    <hr>
                                                </div>



                                            </div>
                                        </section>
                                    </div>
                                    <div class="col-md-4">
                                        <section class="card">
                                            <header class="card-header">
                                                <?php echo date('F, Y'); ?>
                                            </header>
                                            <div class="card-body">

                                                <div class="home_section">
                                                    <?php echo lang('monthly'); ?> <?php echo lang('subscription'); ?>: <?php echo $settings->currency; ?> <?php echo format_number_short($this_monthly['payment'], 2, '.', ','); ?>
                                                    <hr>
                                                </div>
                                                <div class="home_section">
                                                    <?php echo lang('yearly'); ?> <?php echo lang('subscription'); ?> : <?php echo $settings->currency; ?> <?php echo format_number_short($this_year['payment'], 2, '.', ','); ?>
                                                    <hr>
                                                </div>
                                                <div class="home_section">
                                                    <?php echo lang('total'); ?> <?php echo lang('income'); ?> : <?php echo $settings->currency; ?> <?php echo format_number_short($this_year['payment'] + $this_monthly['payment'], 2, '.', ','); ?>
                                                    <hr>
                                                </div>



                                            </div>
                                        </section>

                                    </div>
                                    <div class="col-md-4">
                                        <section class="card">
                                            <header class="card-header">
                                                <?php echo date('Y'); ?>
                                            </header>
                                            <div class="card-body">

                                                <div class="home_section">
                                                    <?php echo lang('monthly'); ?> <?php echo lang('subscription'); ?> : <?php echo $settings->currency; ?> <?php echo format_number_short($this_month_payment['payment'], 2, '.', ','); ?>
                                                    <hr>
                                                </div>
                                                <div class="home_section">
                                                    <?php echo lang('yearly'); ?> <?php echo lang('subscription'); ?> : <?php echo $settings->currency; ?> <?php echo format_number_short($this_year_payment['payment'], 2, '.', ','); ?>
                                                    <hr>
                                                </div>
                                                <div class="home_section">
                                                    <?php echo lang('total'); ?> <?php echo lang('income'); ?> : <?php echo $settings->currency; ?> <?php echo format_number_short($this_year_payment['payment'] + $this_month_payment['payment'], 2, '.', ','); ?>
                                                    <hr>
                                                </div>


                                            </div>
                                        </section>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <!-- /.card -->
                </div>

                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                    <div class="col-md-3 col-lg-3 col-12">

                        <div class="card shadow-lg custom-rounded m-2 mb-3">
                            <div class="p-3">
                                <h5 class="border-bottom pb-3 pt-2 text-sm fw-bold">
                                    <?php echo lang('top_services') ?>
                                    <span class="text-xs badge badge-secondary ml-2 p-2">
                                        <?php echo lang('last_30_days') ?>
                                    </span>
                                </h5>

                                <div id="topServicesChart" style="height: 200px;"></div>
                                <script type="text/javascript">
                                    google.charts.load('current', {
                                        'packages': ['corechart']
                                    });
                                    google.charts.setOnLoadCallback(drawChart);

                                    function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                            ['Service', 'Revenue'],
                                            <?php
                                            // Check if $topRevenueGeneratingServices is an array and has values
                                            if (is_array($topRevenueGeneratingServices) && !empty($topRevenueGeneratingServices)) {
                                                $topServices = array_slice($topRevenueGeneratingServices, 0, 4, true);
                                                foreach ($topServices as $key => $value) {
                                                    // Check if the category name exists and value is set
                                                    $categoryName = $this->home_model->getPaymentCategoryName($key);
                                                    if (!is_null($categoryName) && isset($value)) {
                                                        echo "['" . htmlspecialchars($categoryName) . "', " . floatval($value) . "],";
                                                    }
                                                }
                                                // Calculate 'Others' only if there are more than 4 items
                                                if (count($topRevenueGeneratingServices) > 4) {
                                                    $othersRevenue = array_sum(array_slice($topRevenueGeneratingServices, 4));
                                                    echo "['Others', " . floatval($othersRevenue) . "]";
                                                }
                                            } else {
                                                // Default message or empty chart data in case of null/empty array
                                                echo "['No data available', 0]";
                                            }
                                            ?>
                                        ]);

                                        var options = {
                                            title: "<?php echo lang('top_services'); ?>",
                                            pieHole: 0.3,
                                            colors: ['#ff9999', '#66b3ff', '#99ff99', '#ffcc99', '#c2c2f0', '#ffb3e6'],
                                            legend: {
                                                position: 'bottom'
                                            }
                                        };

                                        var chart = new google.visualization.PieChart(document.getElementById('topServicesChart'));
                                        chart.draw(data, options);
                                    }
                                </script>
                            </div>

                        </div>








                        <div class="card shadow-lg custom-rounded m-2 mb-3">
                            <div class="p-3">
                                <div class="">
                                    <h5 class="border-bottom pb-3 pt-2 text-sm fw-bold">
                                        <?php echo lang('top_diagnoses') ?>
                                        <span class="text-xs badge badge-secondary ml-2 p-2"><?php echo lang('last_30_days') ?></span>
                                    </h5>
                                </div>

                                <div id="topDiagnosesChart"></div>
                                <script type="text/javascript">
                                    google.charts.load('current', {
                                        'packages': ['corechart']
                                    });
                                    google.charts.setOnLoadCallback(drawChart);

                                    function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                            ['Diagnosis', 'Patients'],
                                            <?php
                                            // Check if $topDiagnoses is an array and not empty
                                            if (is_array($topDiagnoses) && !empty($topDiagnoses)) {
                                                $topDiagnosesData = array_slice($topDiagnoses, 0, 4, true);
                                                $otherCount = array_sum(array_slice($topDiagnoses, 4));

                                                foreach ($topDiagnosesData as $key => $value) {
                                                    // Ensure the diagnosis name and value are valid
                                                    $diagnosisName = $this->home_model->getDiagnosisName($key);
                                                    if (!is_null($diagnosisName) && isset($value)) {
                                                        echo "['" . htmlspecialchars($diagnosisName) . "', " . floatval($value) . "],";
                                                    }
                                                }

                                                // Handle the 'Others' category only if there are more than 4 diagnoses
                                                if ($otherCount > 0) {
                                                    echo "['Other', " . floatval($otherCount) . "]";
                                                }
                                            } else {
                                                // Fallback data if $topDiagnoses is null or empty
                                                echo "['No data available', 0]";
                                            }
                                            ?>
                                        ]);

                                        var options = {
                                            // Optional: remove title if not needed
                                            legend: {
                                                position: 'top'
                                            },
                                            chartArea: { // Reduce chartArea margins
                                                left: 10,
                                                right: 10,
                                                top: 50,
                                                bottom: 20,
                                                width: '100%',
                                                height: '100%' // Use more space for the chart itself
                                            },
                                            colors: ['#66b3ff', '#ff9999', '#99ff99', '#ffcc99', '#c2c2f0', '#ffb3e6']
                                        };

                                        var chart = new google.visualization.ColumnChart(document.getElementById('topDiagnosesChart'));
                                        chart.draw(data, options);
                                    }
                                </script>
                            </div>
                        </div>







                        <div class="card shadow-lg custom-rounded m-2 mb-3">
                            <div class="p-3">
                                <h5 class="border-bottom pb-3 pt-2 text-sm fw-bold"><?php echo lang('disease_outbreak_alerts') ?></h5>
                                <p class="text-muted mb-3"><?php echo lang('last_7_days') ?></p>

                                <?php
                                // Check if $cases is an array and contains data
                                if (is_array($cases) && !empty($cases)) {
                                    foreach ($cases as $case_key => $ratio) {
                                        // Ensure that $case_key and $ratio are valid and not null
                                        $diagnosisName = $this->home_model->getDiagnosisName($case_key);
                                        if (!is_null($diagnosisName) && isset($ratio)) {
                                ?>
                                            <div class="disease-alert mb-3">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <h6 class="fw-bold mb-0"><?php echo htmlspecialchars($diagnosisName); ?></h6>
                                                    <?php
                                                    // Initialize alert class and text with null safety
                                                    $alertClass = 'alert-success';
                                                    $alertText = lang('under_control');

                                                    if ($ratio > 0.8 && $ratio < 1) {
                                                        $alertClass = 'alert-warning';
                                                        $alertText = lang('moderately_spreading');
                                                    } elseif ($ratio >= 1 && $ratio < 2) {
                                                        $alertClass = 'alert-danger';
                                                        $alertText = lang('alert');
                                                    } elseif ($ratio >= 2) {
                                                        $alertClass = 'alert-danger';
                                                        $alertText = lang('red_alert');
                                                    }
                                                    ?>
                                                    <span class="badge <?php echo $alertClass; ?> px-3 py-2"><?php echo $alertText; ?></span>
                                                </div>
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar <?php echo $alertClass; ?>" role="progressbar" style="width: <?php echo min(floatval($ratio) * 100, 100); ?>%" aria-valuenow="<?php echo floatval($ratio); ?>" aria-valuemin="0" aria-valuemax="1"></div>
                                                </div>
                                            </div>
                                <?php
                                        }
                                    }
                                } else {
                                    // Fallback message if there are no cases or cases is null
                                    echo "<p>" . lang('no_disease_alerts') . "</p>";
                                }
                                ?>
                            </div>
                        </div>

                        <div class="card shadow-lg custom-rounded m-2 mb-3">
                            <div class="p-3">
                                <h5 class="border-bottom pb-3 pt-2 text-sm fw-bold"><?php echo lang('hospital') ?> <?php echo lang('analytics') ?></h5>
                                <ul class="list-group list-group-flush">
                                    <?php
                                    // Define hospital ID
                                    $hospital_id = $this->session->userdata('hospital_id');

                                    // Check if hospital_id is set
                                    if (isset($hospital_id)) {
                                        // Fetch and count data for each section using the hospital_id 
                                        $this->db->where('hospital_id', $hospital_id);
                                        $totalPatients = $this->db->count_all_results('patient');

                                        $this->db->where('hospital_id', $hospital_id);
                                        $totalDoctors = $this->db->count_all_results('doctor');

                                        $this->db->where('hospital_id', $hospital_id);
                                        $totalAppointments = $this->db->count_all_results('appointment');

                                        $this->db->where('hospital_id', $hospital_id);
                                        $totalPrescriptions = $this->db->count_all_results('prescription');

                                        $this->db->where('hospital_id', $hospital_id);
                                        $totalNurses = $this->db->count_all_results('nurse');
                                    } else {
                                        // Fallback values if hospital_id is not set
                                        $totalPatients = $totalDoctors = $totalAppointments = $totalPrescriptions = $totalNurses = 0;
                                    }
                                    ?>

                                    <li class="list-group-item d-flex justify-content-between align-items-center pl-0">
                                        <span><?php echo lang('total') ?> <?php echo lang('patients') ?></span>
                                        <span class="badge badge-primary badge-pill"><?php echo $totalPatients; ?></span>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center pl-0">
                                        <span><?php echo lang('total') ?> <?php echo lang('doctors') ?></span>
                                        <span class="badge badge-primary badge-pill"><?php echo $totalDoctors; ?></span>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center pl-0">
                                        <span><?php echo lang('total') ?> <?php echo lang('appointments') ?></span>
                                        <span class="badge badge-primary badge-pill"><?php echo $totalAppointments; ?></span>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center pl-0">
                                        <span><?php echo lang('total') ?> <?php echo lang('prescriptions') ?></span>
                                        <span class="badge badge-primary badge-pill"><?php echo $totalPrescriptions; ?></span>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center pl-0">
                                        <span><?php echo lang('total') ?> <?php echo lang('nurses') ?></span>
                                        <span class="badge badge-primary badge-pill"><?php echo $totalNurses; ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <div class="card shadow-lg custom-rounded m-2 mb-3">
                            <div class="p-3">
                                <h5 class="border-bottom pb-3 pt-2 text-sm fw-bold"><?php echo lang('staff_on_duty') ?></h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center pl-0">
                                        <span> <?php echo lang('doctors_on_duty') ?></span>
                                        <span class="badge badge-primary badge-pill"><?php echo $doctorsOnDuty; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center pl-0">
                                        <span><?php echo lang('nurses_on_duty') ?></span>
                                        <span class="badge badge-primary badge-pill"><?php echo $nursesOnDuty; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center pl-0">
                                        <span><?php echo lang('pharmacists_on_duty') ?></span>
                                        <span class="badge badge-primary badge-pill"><?php echo $pharmacistsOnDuty; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center pl-0">
                                        <span><?php echo lang('laboratorists_on_duty') ?></span>
                                        <span class="badge badge-primary badge-pill"><?php echo $laboratoristsOnDuty; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center pl-0">
                                        <span><?php echo lang('receptionists_on_duty') ?></span>
                                        <span class="badge badge-primary badge-pill"><?php echo $receptionistsOnDuty; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center pl-0">
                                        <span><?php echo lang('accountants_on_duty') ?></span>
                                        <span class="badge badge-primary badge-pill"><?php echo $accountantsOnDuty; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center pl-0">
                                        <span><?php echo lang('patients') ?> <?php echo lang('admitted') ?></span>
                                        <span class="badge badge-primary badge-pill"><?php echo $patientAdmitted; ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>



                    </div>



                    <div class="col-md-3 col-lg-3 col-12">



                        <div class="card shadow-lg custom-rounded m-2 mb-3">
                            <div class="p-3">
                                <h5 class="border-bottom pb-3 pt-2 text-sm fw-bold"><?php echo lang('bed_occupancy') ?></h5>
                                <div id="bedOccupancyChart"></div>
                                <script type="text/javascript">
                                    google.charts.load('current', {
                                        'packages': ['corechart']
                                    });
                                    google.charts.setOnLoadCallback(drawChart);

                                    function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                            ['Status', 'Count'],
                                            ['<?php echo lang('bed_occupied') ?>', <?php echo array_sum(array_column($bedCategoryWiseOccupancy ?? [], 'occupied')) ?? 0; ?>],
                                            ['<?php echo lang('bed_available') ?>', <?php echo array_sum(array_column($bedCategoryWiseOccupancy ?? [], 'available')) ?? 0; ?>]
                                        ]);

                                        var options = {
                                            title: '<?php echo lang('bed_occupancy') ?>',
                                            pieHole: 0.4,
                                            colors: ['#ff9999', '#66b3ff'],
                                            legend: {
                                                position: 'bottom'
                                            }
                                        };

                                        var chart = new google.visualization.PieChart(document.getElementById('bedOccupancyChart'));
                                        chart.draw(data, options);
                                    }
                                </script>
                            </div>
                        </div>


                        <div class="card shadow-lg custom-rounded m-2 mb-3">
                            <div class="p-3">
                                <h5 class="border-bottom pb-4 py-2 text-sm fw-bold"><?php echo lang('top_treatments') ?> <span class="text-xs badge badge-secondary ml-2 p-2"><?php echo lang('last_30_days') ?></span></h5>

                                <div id="topTreatmentsChart"></div>
                                <script type="text/javascript">
                                    google.charts.load('current', {
                                        'packages': ['corechart']
                                    });
                                    google.charts.setOnLoadCallback(drawChart);

                                    function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                            ['Treatment', 'Patients'],
                                            <?php
                                            if (is_array($topTreatments) && !empty($topTreatments)) {
                                                $topTreatmentsData = array_slice($topTreatments, 0, 5, true);
                                                $otherCount = array_sum(array_slice($topTreatments, 5));
                                                foreach ($topTreatmentsData as $key => $value) {
                                                    echo "['" . $this->home_model->getTreatmentName($key) . "', " . $value . "],";
                                                }
                                                if ($otherCount > 0) {
                                                    echo "['Other', " . $otherCount .
                                                        "]";
                                                }
                                            } else {
                                                // Fallback data if $topDiagnoses is null or empty
                                                echo "['No data available', 0]";
                                            }
                                            ?>
                                        ]);

                                        var options = {
                                            // title: '<?php echo lang('top_treatments') ?>',
                                            legend: {
                                                position: 'top'
                                            },
                                            chartArea: { // Reduce chartArea margins
                                                left: 70, // Adjust values to minimize white space
                                                right: 10,
                                                top: 50,
                                                bottom: 20,
                                                width: '100%',
                                                height: '80%' // Use more space for the chart itself
                                            },
                                            colors: ['#ff9999', '#66b3ff', '#99ff99', '#ffcc99', '#c2c2f0', '#ffb3e6'], // Adjust colors as needed

                                        };

                                        var chart = new google.visualization.BarChart(document.getElementById('topTreatmentsChart'));
                                        chart.draw(data, options);
                                    }
                                </script>
                            </div>
                        </div>


                        <div class="card shadow-lg custom-rounded m-2 mb-3 bg-transparent">
                            <div class="">
                                <h5 class="my-4 fw-bold text-center text-sm"><?php echo lang('today'); ?> - <?php echo lang('overview'); ?></h5>
                                <div class="row text-center">
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 ml-3 border rounded">
                                            <i class="fas fa-user-plus bg-success fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"><?php echo lang('admitted'); ?></h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $admittedToday ?? 0; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 mr-3 border rounded">
                                            <i class="fas fa-user-times bg-danger fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"><?php echo lang('discharged'); ?></h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $dischargedToday ?? 0; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 ml-3 border rounded">
                                            <i class="fas fa-user-check bg-info fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"><?php echo lang('registered'); ?> </h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $registeredToday ?? 0; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 mr-3 border rounded">
                                            <i class="fas fa-dollar-sign bg-primary fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"><?php echo lang('income'); ?> </h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $settings->currency; ?><?php echo format_number_short($this_day['payment'] ?? 0, 2, '.', ','); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 ml-3 border rounded">
                                            <i class="fas fa-money-bill-wave bg-warning fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"><?php echo lang('expense'); ?></h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $settings->currency; ?><?php echo format_number_short($this_day['expense'] ?? 0, 2, '.', ','); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 mr-3 border rounded">
                                            <i class="fas fa-calendar-check bg-secondary fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"><?php echo lang('appointments'); ?> </h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $this_day['appointment'] ?? 0; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card shadow-lg custom-rounded m-2 mb-3 bg-transparent">
                            <div class="">
                                <h5 class="my-4 fw-bold text-center text-sm"><?php echo lang('this_month'); ?> - <?php echo lang('overview'); ?></h5>
                                <div class="row text-center">
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 ml-3 border rounded">
                                            <i class="fas fa-user-plus bg-success fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"> <?php echo lang('admitted'); ?></h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $admittedThisMonth ?? 0; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 mr-3 border rounded">
                                            <i class="fas fa-user-times bg-danger fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"> <?php echo lang('discharged'); ?></h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $dischargedThisMonth ?? 0; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 ml-3 border rounded">
                                            <i class="fas fa-user-check bg-info fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"> <?php echo lang('registered'); ?></h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $registeredThisMonth ?? 0; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 mr-3 border rounded">
                                            <i class="fas fa-dollar-sign bg-primary fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"><?php echo lang('income'); ?></h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $settings->currency; ?><?php echo format_number_short($this_month['payment'] ?? 0, 2, '.', ','); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 ml-3 border rounded">
                                            <i class="fas fa-money-bill-wave bg-warning fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"><?php echo lang('expense'); ?></h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $settings->currency; ?><?php echo format_number_short($this_month['expense'] ?? 0, 2, '.', ','); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 mr-3 border rounded">
                                            <i class="fas fa-calendar-check bg-secondary fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"><?php echo lang('appointment'); ?></h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $this_month['appointment'] ?? 0; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card shadow-lg custom-rounded m-2 bg-transparent">
                            <div class="">
                                <h5 class="my-4 fw-bold text-center text-sm"><?php echo lang('this_year'); ?> - <?php echo lang('overview'); ?></h5>
                                <div class="row text-center">
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 ml-3 border rounded">
                                            <i class="fas fa-user-plus bg-success fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"><?php echo lang('admitted'); ?></h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $admittedThisYear ?? 0; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 mr-3 border rounded">
                                            <i class="fas fa-user-times bg-danger fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"><?php echo lang('discharged'); ?></h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $dischargedThisYear ?? 0; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 ml-3 border rounded">
                                            <i class="fas fa-user-check bg-info fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"><?php echo lang('registered'); ?></h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $registeredThisYear ?? 0; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 mr-3 border rounded">
                                            <i class="fas fa-dollar-sign bg-primary fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"><?php echo lang('income'); ?></h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $settings->currency; ?><?php echo format_number_short($this_year['payment'] ?? 0, 2, '.', ','); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 ml-3 border rounded">
                                            <i class="fas fa-money-bill-wave bg-warning fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"><?php echo lang('expense'); ?></h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $settings->currency; ?><?php echo format_number_short($this_year['expense'] ?? 0, 2, '.', ','); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="stat-card bg-light p-3 mr-3 border rounded">
                                            <i class="fas fa-calendar-check bg-secondary fa-lg p-2 rounded-circle"></i>
                                            <h6 class="fw-bold mt-2 text-dark title-spacing text-sm text-muted"><?php echo lang('appointment'); ?></h6>
                                            <p class="fw-bold text-dark mb-0" style="font-size: 1.1rem;"><?php echo $this_year['appointment'] ?? 0; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>






                <?php } ?>


                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>















</section>

<?php
if (!$this->ion_auth->in_group(array('superadmin'))) {
    if (!empty($this_month['payment'])) {
        $payment_this = $this_month['payment'];
    } else {
        $payment_this = 0;
    }
    if (!empty($this_month['expense'])) {
        $expense_this = $this_month['expense'];
    } else {
        $expense_this = 0;
    }
    if (!empty($this_month['appointment_treated'])) {
        $appointment_treated = $this_month['appointment_treated'];
    } else {
        $appointment_treated = 0;
    }


    if (!empty($this_month['appointment_cancelled'])) {
        $appointment_cancelled = $this_month['appointment_cancelled'];
    } else {
        $appointment_cancelled = 0;
    }
    $superadmin_login = 'no';
} else {
    if (!empty($this_month['payment'])) {
        $superadmin_month_payment = $this_month['payment'];
    } else {
        $superadmin_month_payment = '0';
    }
    if (!empty($this_yearly['payment'])) {
        $superadmin_year_payment = $this_yearly['payment'];
    } else {
        $superadmin_year_payment = '0';
    }
    $superadmin_login = 'yes';
}
?>


<script type="text/javascript">
    var per_month_income_expense = "<?php echo lang('per_month_income_expense') ?>";
    var income = "<?php echo lang('income') ?>";
    var expense = "<?php echo lang('expense') ?>";
</script>
<script type="text/javascript">
    var currency = "<?php echo $settings->currency ?>";
</script>
<script type="text/javascript">
    var months_lang = "<?php echo lang('months') ?>";
</script>
<script type="text/javascript">
    var superadmin_login = "<?php echo $superadmin_login; ?>";
</script>
<?php if (!$this->ion_auth->in_group(array('superadmin'))) { ?>
    <script type="text/javascript">
        var payment_this = <?php echo $payment_this ?>;
    </script>
    <script type="text/javascript">
        var expense_this = <?php echo $expense_this ?>;
    </script>
    <script type="text/javascript">
        var appointment_treated = <?php echo $appointment_treated ?>;
    </script>
    <script type="text/javascript">
        var appointment_cancelled = <?php echo $appointment_cancelled ?>;
    </script>
    <script type="text/javascript">
        var this_year_expenses = <?php echo json_encode($this_year['expense_per_month']); ?>;
    </script>
<?php } else { ?>
    <script type="text/javascript">
        var superadmin_month_payment = <?php echo $superadmin_month_payment ?>;
    </script>
    <script type="text/javascript">
        var superadmin_year_payment = <?php echo $superadmin_year_payment ?>;
    </script>
<?php } ?>

<script type="text/javascript">
    var this_year = <?php echo json_encode($this_year['payment_per_month']); ?>;
    var monthly_subscription_lang = '<?php echo lang('monthly'); ?> <?php echo lang('subscription'); ?>';
    var yearly_subscription_lang = '<?php echo lang('yearly'); ?> <?php echo lang('subscription'); ?>';
    var income_lang = '<?php echo lang('income'); ?>';
    var expense_lang = '<?php echo lang('expense'); ?>';
    var treated_lang = '<?php echo lang('treated'); ?>';
    var cancelled_lang = '<?php echo lang('cancelled'); ?>';
    var jan = '<?php echo lang('jan'); ?>';
    var feb = '<?php echo lang('feb'); ?>';
    var mar = '<?php echo lang('mar'); ?>';
    var apr = '<?php echo lang('apr'); ?>';
    var may = '<?php echo lang('may'); ?>';
    var june = '<?php echo lang('june'); ?>';
    var july = '<?php echo lang('july'); ?>';
    var aug = '<?php echo lang('aug'); ?>';
    var sep = '<?php echo lang('sep'); ?>';
    var oct = '<?php echo lang('oct'); ?>';
    var nov = '<?php echo lang('nov'); ?>';
    var dec = '<?php echo lang('dec'); ?>';

    var January = '<?php echo lang('January'); ?>';
    var February = '<?php echo lang('February'); ?>';
    var March = '<?php echo lang('March'); ?>';
    var April = '<?php echo lang('April'); ?>';
    var May = '<?php echo lang('May'); ?>';
    var June = '<?php echo lang('June'); ?>';
    var July = '<?php echo lang('July'); ?>';
    var August = '<?php echo lang('August'); ?>';
    var September = '<?php echo lang('September'); ?>';
    var October = '<?php echo lang('October'); ?>';
    var November = '<?php echo lang('November'); ?>';
    var December = '<?php echo lang('December'); ?>';
</script>

<script src="common/extranal/js/home.js"></script>

<?php
function format_number_short($n)
{
    if ($n >= 1000000000) {
        return number_format($n / 1000000000, 2) . 'B';
    } elseif ($n >= 1000000) {
        return number_format($n / 1000000, 2) . 'M';
    } elseif ($n >= 1000) {
        return number_format($n / 1000, 2) . 'K';
    }
    return number_format($n, 2);
}
?>