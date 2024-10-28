<!--sidebar end-->
<!--main content start-->


<link href="common/extranal/css/appointment/appointment.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-calendar-check mr-2"></i>
                        <?php echo lang('all_appointments'); ?>: <?php echo lang('doctor'); ?>
                        (<?php if (!empty($mmrdoctor)) {
                                echo $mmrdoctor->name;
                            } ?>)
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item"><a href="doctor"><?php echo lang('doctor') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('appointment') ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <!-- <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div> -->
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="">

                                            <!-- Tab Navigation -->
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#calendardetails"><?php echo lang('appointments'); ?> <?php echo lang('calendar'); ?></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#list"><?php echo lang('appointments'); ?></a>
                                                </li>
                                            </ul>

                                            <!-- Custom buttons on the right side -->
                                            <div class="float-right custom_buttonss"></div>

                                            <!-- Tab Content -->
                                            <div class="tab-content mt-3">
                                                <div id="calendardetails" class="tab-pane active">
                                                    <div id="calendarview" class="has-toolbar calendar_view"></div>
                                                </div>
                                                <div id="list" class="tab-pane">
                                                    <div class="adv-table editable-table">
                                                        <!-- <div class="clearfix">
                                                            <button class="export btn btn-primary" onclick="javascript:window.print();">Print</button>
                                                        </div> -->
                                                        <div class="space15 mt-2"></div>
                                                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                                            <thead>
                                                                <tr>
                                                                    <th><?php echo lang('id'); ?></th>
                                                                    <th><?php echo lang('patient'); ?></th>
                                                                    <th><?php echo lang('date-time'); ?></th>
                                                                    <th><?php echo lang('remarks'); ?></th>
                                                                    <th><?php echo lang('options'); ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                foreach ($appointments as $appointment) {
                                                                    if ($appointment->doctor == $doctor_id) {
                                                                ?>
                                                                        <tr>
                                                                            <td><?php echo $appointment->id; ?></td>
                                                                            <td><?php echo $this->db->get_where('patient', array('id' => $appointment->patient))->row()->name; ?></td>
                                                                            <td><?php echo date('d-m-Y', $appointment->date); ?> => <?php echo $appointment->time_slot; ?></td>
                                                                            <td><?php echo $appointment->remarks; ?></td>
                                                                            <td>
                                                                                <a class="btn btn-danger btn-sm" href="appointment/delete?id=<?php echo $appointment->id; ?>&doctor_id=<?php echo $appointment->doctor; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-4">
                    <div class="">
                        <!-- /.card-header -->
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <?php echo lang('doctor'); ?>
                                        </div>
                                        <div class="card-body profile">
                                            <a href="#" class="task-thumb d-inline-block mr-3">
                                                <img src="<?php echo !empty($mmrdoctor->img_url) ? $mmrdoctor->img_url : 'uploads/favicon.png'; ?>" height="100" width="100" class="rounded-circle">
                                            </a>
                                            <div class="task-thumb-details">
                                                <h5 class="card-title"><a href="#"><?php echo $mmrdoctor->name; ?></a></h5>
                                                <p class="card-text"><?php echo $mmrdoctor->profile; ?></p>
                                            </div>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <i class="fa fa-envelope mr-2"></i>
                                                <?php echo $mmrdoctor->email; ?>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <i class="fa fa-phone mr-2"></i>
                                                <?php echo $mmrdoctor->phone; ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
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

<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                <h4 class="modal-title font-weight-bold"><i class="fa fa-edit"></i> <?php echo lang('edit_appointment'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editAppointmentForm" action="appointment/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1"> <?php echo lang('paient'); ?></label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control m-bot15" id="patientchoose1" name="patient" value=''>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?></label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control m-bot15" id="doctorchoose1" name="doctor" value=''>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('date-time'); ?></label>
                        <div data-date="" class="input-group date form_datetime-meridian">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></button>
                                <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
                            </div>
                            <input type="text" class="form-control" readonly="" name="date" value='' placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <input type="text" class="form-control" name="remarks" value='' placeholder="">
                    </div>



                    <input type="hidden" name="id" value=''>


                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->
<div class="modal fade" role="dialog" id="cmodal">
    <div class="modal-dialog modal-lg med_his" role="document">
        <div class="modal-content">

            <div id='medical_history'>
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

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var doctor_id = "<?php echo $doctor_id; ?>";
</script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script type="text/javascript">
    var no_available_timeslots = "<?php echo lang('no_available_timeslots'); ?>";
</script>
<script src="common/extranal/js/appointment/appointment_by_doctor.js"></script>