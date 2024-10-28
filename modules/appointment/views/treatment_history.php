<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-history mr-2"></i>
                        <?php echo lang('treatment_history') ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item"><a href="doctor"><?php echo lang('doctor') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('treatment_history') ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('Total number of appointments each doctor has handled, both overall and within a specified date range'); ?></h3>
                        </div>


                        <div class="container no-print">
                            <div class="row mt-4"> <!-- Added container and row classes; mt-4 is for top margin -->
                                <div class="col-md-12">
                                    <div class="row"> <!-- Added row to properly nest columns -->
                                        <div class="col-md-7">
                                            <div class="card-body"> <!-- Used card-body instead of panel-body -->
                                                <section>
                                                    <form role="form" class="f_report" action="appointment/treatmentReport" method="post" enctype="multipart/form-data">
                                                        <div class="form-group row"> <!-- Added row for proper alignment -->

                                                            <div class="col-md-6">
                                                                <div class="input-group"> <!-- Removed input-large and data-date attributes -->
                                                                    <input type="text" class="form-control dpd1" name="date_from" autocomplete="off" placeholder="Date From">
                                                                    <div class="input-group-append"> <!-- Added input-group-append -->
                                                                        <span class="input-group-text">To</span>
                                                                    </div>
                                                                    <input type="text" class="form-control dpd2" name="date_to" autocomplete="off" placeholder="Date To">
                                                                </div>
                                                                <small class="form-text text-muted"></small> <!-- Used form-text instead of help-block -->
                                                            </div>

                                                            <div class="col-md-6 d-none d-md-block"> <!-- Used d-none and d-md-block for 'no-print' -->
                                                                <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                                            </div>

                                                        </div>
                                                    </form>
                                                </section>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <!-- Empty -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>





                        <!-- /.card-header -->
                        <div class="card-body">



                            <div class="d-flex justify-content-between align-items-center no-print">
                                <button class="btn btn-primary" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>
                            </div>
                            <div class="mt-3">
                            </div>





                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th> <?php echo lang('doctor_id'); ?></th>
                                        <th> <?php echo lang('doctor'); ?></th>
                                        <th> <?php echo lang('number_of_patient_treated'); ?></th>
                                        <th class="no-print"> <?php echo lang('actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php foreach ($doctors as $doctor) { ?>

                                        <tr class="">
                                            <td><?php echo $doctor->id; ?></td>
                                            <td><?php echo $doctor->name; ?></td>
                                            <td>
                                                <?php
                                                foreach ($appointments as $appointment) {
                                                    if ($appointment->doctor == $doctor->id) {

                                                        $appointment_number[] = 1;
                                                    }
                                                }
                                                if (!empty($appointment_number)) {
                                                    $appointment_total = array_sum($appointment_number);
                                                    echo $appointment_total;
                                                } else {
                                                    $appointment_total = 0;
                                                    echo $appointment_total;
                                                }
                                                ?>
                                            </td>
                                            <td class="no-print d-flex gap-1"> <a class="btn btn-info btn-xs btn_width add_payment_button" style="width: 100px;" href="appointment/getAppointmentByDoctorId?id=<?php echo $doctor->id; ?>"><i class="fa fa-money"></i> <?php echo lang('details'); ?></a></td>


                                        </tr>
                                        <?php $appointment_number = NULL; ?>
                                        <?php $appointment_total = NULL; ?>
                                    <?php } ?>



                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>













<!--main content end-->
<!--footer start-->