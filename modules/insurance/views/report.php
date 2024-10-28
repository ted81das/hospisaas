<link href="common/extranal/css/hospital/report_subscription.css" rel="stylesheet">
<?php
touch('common/js/countrypicker.js');
?>



<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1><i class="fas fa-file-medical-alt"></i> <strong><?php echo lang('insurance_report') ?></strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('insurance_report') ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('filter_by'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" class="form_style" action="finance/insuranceReport" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                        <input type="text" class="form-control dpd1" name="date_from" value="<?php
                                                                                                                if (!empty($from)) {
                                                                                                                    echo $from;
                                                                                                                }
                                                                                                                ?>" placeholder="<?php echo lang('date_from'); ?>" readonly="">
                                        <!-- <span class="input-group-addon"><?php echo lang('to'); ?></span> -->
                                        <input type="text" class="form-control dpd2" name="date_to" value="<?php
                                                                                                            if (!empty($to)) {
                                                                                                                echo $to;
                                                                                                            }
                                                                                                            ?>" placeholder="<?php echo lang('date_to'); ?>" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('insurance_company'); ?></label>
                                    <select class="form-control m-bot15 pos_select" id="company_select" name="company" value='' required="">
                                        <option value="all" <?php
                                                            if ($company_select == 'all') {
                                                                echo 'selected';
                                                            }
                                                            ?>><?php echo lang('all'); ?></option>

                                        <?php foreach ($insurance_companys as $company) { ?>
                                            <option value="<?php echo $company->id; ?>" <?php
                                                                                        if ($company->id == $company_select) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                        ?>> <?php echo $company->name; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>


                                <div class="form-group button_div">
                                    <button type="submit" name="submit" value="submit" class="btn btn-success submit_button"><?php echo lang('submit'); ?></button>

                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('insurance_report'); ?></h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample1">
                                <thead>
                                    <tr>
                                        <th> <?php echo lang('date'); ?></th>
                                        <th> <?php echo lang('invoice_id'); ?></th>
                                        <th> <?php echo lang('patient'); ?></th>
                                        <th> <?php echo lang('company'); ?></th>
                                        <th> <?php echo lang(''); ?> <?php echo lang('bill'); ?></th>
                                        <th> <?php echo lang('insurance'); ?> <?php echo lang('amount'); ?></th>
                                        <th> <?php echo lang('patient'); ?> <?php echo lang('amount'); ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($deposits as $deposit) {
                                        $total[] = $deposit->deposited_amount;
                                    ?>
                                        <tr>

                                            <td><?php echo date('d-m-Y', $deposit->date); ?></td>
                                            <td><?php echo $deposit->payment_id; ?></td>
                                            <td><?php echo $this->patient_model->getPatientById($deposit->patient)->name; ?></td>
                                            <td><?php
                                                $company_details = $this->db->get_where('insurance_company', array('id' => $deposit->insurance_company))->row();
                                                echo $company_details->name;
                                                ?></td>
                                            <td><?php echo $settings->currency . ' ' . $gross =  $this->finance_model->getPaymentById($deposit->payment_id)->gross_total; ?></td>
                                            <td><?php echo $settings->currency . ' ' . $deposit->deposited_amount; ?></td>
                                            <td><?php echo $settings->currency . ' ' . $gross - $deposit->deposited_amount; ?></td>
                                        </tr>
                                    <?php

                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="">
                        <div class="card-body">
                            <section class="card">
                                <div class="weather-bg section_middle_child">
                                    <div class="card-body section_middle_child_child">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <?php echo lang('total'); ?> <?php echo lang('insurance'); ?> <?php echo lang('amount'); ?>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="degree">
                                                    <?php echo $settings->currency; ?>
                                                    <?php
                                                    if (!empty($total)) {

                                                        echo number_format(array_sum($total), 2);
                                                    } else {
                                                        echo '0';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- /.content -->
</div>


<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/hospital/report_subscription.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.dpd1, .dpd2').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayBtn: true,
            showMeridian: true
        });
    });
</script>