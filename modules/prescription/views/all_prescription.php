<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-prescription mr-2"></i><?php echo lang('prescription'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('prescription'); ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the prescriptions names and related informations'); ?></h3>
                            <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                                <div class="float-right">
                                    <a href="prescription/addPrescriptionView">
                                        <button id="" class="btn btn-success btn-sm">
                                            <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                        </button>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                                <thead>
                                    <tr>
                                        <th> <?php echo lang('id'); ?></th>
                                        <th> <?php echo lang('date'); ?></th>
                                        <th> <?php echo lang('doctor'); ?></th>
                                        <th> <?php echo lang('patient'); ?></th>
                                        <th> <?php echo lang('medicine'); ?></th>
                                        <th> <?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>



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



<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
}
?>

<!-- Add Prescription Modal-->
<div class="modal fade" id="myModa3" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_prescription'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="prescription/addNewPrescription" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" name="doctor" value=''>
                            <option value="">Select .....</option>
                            <?php foreach ($doctors as $doctor) { ?>
                                <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" name="patient" value=''>
                            <option value="">Select .....</option>
                            <?php foreach ($patients as $patientss) { ?>
                                <option value="<?php echo $patientss->id; ?>"><?php echo $patientss->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('history'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" name="symptom" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('medication'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" name="medicine" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('note'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" name="note" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="patient_id" value=''>
                    <input type="hidden" name="admin" value='admin'>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myModal5" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_prescription'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="prescriptionEditForm" class="clearfix" action="prescription/addNewPrescription" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single doctor" name="doctor" value=''>
                            <option value="">Select .....</option>
                            <?php foreach ($doctors as $doctor) { ?>
                                <option value="<?php echo $doctor->id; ?>" <?php
                                                                            if (!empty($prescription->doctor)) {
                                                                                if ($prescription->doctor == $doctor->id) {
                                                                                    echo 'selected';
                                                                                }
                                                                            }
                                                                            ?>><?php echo $doctor->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single patient" name="patient" value=''>
                            <option value="">Select .....</option>
                            <?php foreach ($patients as $patientss) { ?>
                                <option value="<?php echo $patientss->id; ?>" <?php
                                                                                if (!empty($prescription->patient)) {
                                                                                    if ($prescription->patient == $patientss->id) {
                                                                                        echo 'selected';
                                                                                    }
                                                                                }
                                                                                ?>><?php echo $patientss->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('history'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" id="editor1" name="symptom" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('medication'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" id="editor2" name="medicine" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('note'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" id="editor3" name="note" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="admin" value='admin'>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Prescription Modal-->


<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/prescription/all_prescription.js"></script>