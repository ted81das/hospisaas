<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
    $doctordetails = $this->db->get_where('doctor', array('id' => $doctor_id))->row();
}
?>

<link href="common/extranal/css/prescription/add_new_prescription_view.css" rel="stylesheet">




<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-2">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-prescription mr-2"></i>
                        <?php
                        if (!empty($prescription->id))
                            echo lang('edit_prescription');
                        else
                            echo lang('add_prescription');
                        ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item"><a href="prescription"><?php echo lang('prescription') ?></a></li>
                        <li class="breadcrumb-item active"><?php
                                                            if (!empty($prescription->id))
                                                                echo lang('edit_prescription');
                                                            else
                                                                echo lang('add_prescription');
                                                            ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <?php echo validation_errors(); ?>
                <form role="form" action="prescription/addNewPrescription" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="form-group d-flex col-md-12">
                                            <label for="exampleInputEmail1" class="col-sm-2"> <?php echo lang('date'); ?> &ast;</label>
                                            <input type="text" class="form-control col-sm-10 default-date-picker" autocomplete="off" name="date" value='<?php
                                                                                                                                                        if (!empty($setval)) {
                                                                                                                                                            echo set_value('date');
                                                                                                                                                        }
                                                                                                                                                        if (!empty($prescription->date)) {
                                                                                                                                                            echo date('d-m-Y', $prescription->date);
                                                                                                                                                        } else {
                                                                                                                                                            echo date('d-m-Y');
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder="" required="">
                                        </div>

                                        <?php if (!$this->ion_auth->in_group('Doctor')) { ?>
                                            <div class="form-group d-flex col-md-12">
                                                <label for="exampleInputEmail1" class="col-sm-2"> <?php echo lang('doctor'); ?> &ast; </label>
                                                <select class="form-control col-sm-10 m-bot15" id="doctorchoose" name="doctor" value='' required>
                                                    <?php if (!empty($prescription->doctor)) { ?>
                                                        <option value="<?php echo $doctors->id; ?>" selected="selected"><?php echo $doctors->name; ?> - (<?php echo lang('id'); ?> : <?php echo $doctors->id; ?>)</option>
                                                    <?php } ?>
                                                    <?php
                                                    if (!empty($setval)) {
                                                        $doctordetails1 = $this->db->get_where('doctor', array('id' => set_value('doctor')))->row();
                                                    ?>
                                                        <option value="<?php echo $doctordetails1->id; ?>" selected="selected"><?php echo $doctordetails1->name; ?> -(<?php echo lang('id'); ?> : <?php echo $doctordetails1->id; ?>)</option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        <?php } else { ?>
                                            <div class="form-group d-flex col-md-12">
                                                <label for="exampleInputEmail1" class="col-sm-2"> <?php echo lang('doctor'); ?></label>
                                                <?php if (!empty($prescription->doctor)) { ?>
                                                    <select class="form-control col-sm-10 m-bot15" name="doctor" value=''>
                                                        <option value="<?php echo $doctors->id; ?>" selected="selected"><?php echo $doctors->name; ?> - (<?php echo lang('id'); ?> : <?php echo $doctors->id; ?>)</option>
                                                    </select>
                                                <?php } else { ?>
                                                    <select class="form-control col-sm-10 m-bot15" id="doctorchoose1" name="doctor" value=''>
                                                        <?php if (!empty($prescription->doctor)) { ?>
                                                            <option value="<?php echo $doctors->id; ?>" selected="selected"><?php echo $doctors->name; ?> - (<?php echo lang('id'); ?> : <?php echo $doctors->id; ?>)</option>
                                                        <?php } ?>
                                                        <?php if (!empty($doctordetails)) { ?>
                                                            <option value="<?php echo $doctordetails->id; ?>" selected="selected"><?php echo $doctordetails->name; ?> - (<?php echo lang('id'); ?> : <?php echo $doctordetails->id; ?>)</option>
                                                        <?php } ?>
                                                        <?php
                                                        if (!empty($setval)) {
                                                            $doctordetails1 = $this->db->get_where('doctor', array('id' => set_value('doctor')))->row();
                                                        ?>
                                                            <option value="<?php echo $doctordetails1->id; ?>" selected="selected"><?php echo $doctordetails1->name; ?> - (<?php echo lang('id'); ?> : <?php echo $doctordetails->id; ?>)</option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>

                                        <div class="form-group d-flex col-md-12">
                                            <label for="exampleInputEmail1" class="col-sm-2"> <?php echo lang('patient'); ?> &ast;</label>
                                            <select class="form-control col-sm-10 m-bot15" id="patientchoose" name="patient" value='' required="">
                                                <?php if (!empty($prescription->patient)) {
                                                    if (empty($patients->age)) {
                                                        $dateOfBirth = $patients->birthdate;
                                                        if (empty($dateOfBirth)) {
                                                            $age[0] = '0';
                                                        } else {
                                                            $today = date("Y-m-d");
                                                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                                            $age[0] = $diff->format('%y');
                                                        }
                                                    } else {
                                                        $age = explode('-', $patients->age);
                                                    }
                                                ?>
                                                    <option value="<?php echo $patients->id; ?>" selected="selected"><?php echo $patients->name; ?> ( <?php echo lang('id'); ?>: <?php echo $patients->id; ?> - <?php echo lang('phone'); ?>: <?php echo $patients->phone; ?> - <?php echo lang('age'); ?>: <?php echo $age[0]; ?> ) </option>
                                                <?php } ?>
                                                <?php
                                                if (!empty($setval)) {

                                                    $patientdetails = $this->db->get_where('patient', array('id' => set_value('patient')))->row();

                                                    if (empty($patientdetails->age)) {
                                                        $dateOfBirth = $patientdetails->birthdate;
                                                        if (empty($dateOfBirth)) {
                                                            $age[0] = '0';
                                                        } else {
                                                            $today = date("Y-m-d");
                                                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                                            $age[0] = $diff->format('%y');
                                                        }
                                                    } else {
                                                        $age = explode('-', $patientdetails->age);
                                                    }
                                                ?>
                                                    <option value="<?php echo $patientdetails->id; ?>" selected="selected"><?php echo $patientdetails->name; ?> ( <?php echo lang('id'); ?>: <?php echo $patientdetails->id; ?> - <?php echo lang('phone'); ?>: <?php echo $patientdetails->phone; ?> - <?php echo lang('age'); ?>: <?php echo $age[0]; ?> ) </option>

                                                <?php }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group d-flex col-md-12">
                                            <label class="control-label col-sm-2"><?php echo lang('history'); ?></label>
                                            <textarea class="form-control col-sm-10" id="editor1" name="symptom" value="" rows="2" cols="20"><?php
                                                                                                                                                if (!empty($setval)) {
                                                                                                                                                    echo set_value('symptom');
                                                                                                                                                }
                                                                                                                                                if (!empty($prescription->symptom)) {
                                                                                                                                                    echo $prescription->symptom;
                                                                                                                                                }
                                                                                                                                                ?></textarea>
                                        </div>

                                        <div class="form-group d-flex col-md-12">
                                            <label class="control-label col-sm-2"><?php echo lang('note'); ?></label>
                                            <textarea class="form-control col-sm-10 ckeditor" id="editor2" name="note" value="" rows="2" cols="20"><?php
                                                                                                                                                    if (!empty($setval)) {
                                                                                                                                                        echo set_value('note');
                                                                                                                                                    }
                                                                                                                                                    if (!empty($prescription->note)) {
                                                                                                                                                        echo $prescription->note;
                                                                                                                                                    }
                                                                                                                                                    ?></textarea>
                                        </div>

                                        <div class="form-group d-flex col-md-12">
                                            <label class="control-label col-sm-2"><?php echo lang('advice'); ?></label>
                                            <textarea class="form-control col-sm-10 ckeditor" id="editor3" name="advice" value="" rows="2" cols="10"><?php
                                                                                                                                                        if (!empty($setval)) {
                                                                                                                                                            echo set_value('advice');
                                                                                                                                                        }
                                                                                                                                                        if (!empty($prescription->advice)) {
                                                                                                                                                            echo $prescription->advice;
                                                                                                                                                        }
                                                                                                                                                        ?>
                                            </textarea>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>


                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group d-flex col-md-12 medicine_block row">
                                        <label class="control-label col-sm-2"> <?php echo lang('medicine'); ?></label>
                                        <div class="medicine_div col-sm-10">
                                            <?php if (empty($prescription->medicine)) { ?>
                                                <select class="form-control col-sm-10 m-bot15 medicinee" id="my_select1_disabled" name="category" value=''>

                                                </select>
                                            <?php } else { ?>
                                                <select name="category" class="form-control col-sm-10 m-bot15 medicinee" multiple="multiple" id="my_select1_disabled">
                                                    <?php
                                                    if (!empty($prescription->medicine)) {


                                                        $prescription_medicine = explode('###', $prescription->medicine);
                                                        foreach ($prescription_medicine as $key => $value) {
                                                            $prescription_medicine_extended = explode('***', $value);
                                                            $medicine = $this->medicine_model->getMedicineById($prescription_medicine_extended[0]);
                                                    ?>
                                                            <option value="<?php echo $medicine->id . '*' . $medicine->name; ?>" <?php echo 'data-dosage="' . $prescription_medicine_extended[1] . '"' . 'data-frequency="' . $prescription_medicine_extended[2] . '"data-days="' . $prescription_medicine_extended[3] . '"data-instruction="' . $prescription_medicine_extended[4] . '"'; ?> selected="selected">
                                                                <?php echo $medicine->name; ?>
                                                            </option>

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-12 card-body medicine_block">
                                            <label class="control-label col-md-3"><?php echo lang('selected'); ?></label>
                                            <div class="medicine row">

                                            </div>

                                        </div>
                                    </div>

                                    <input type="hidden" name="admin" value='admin'>

                                    <input type="hidden" name="id" value='<?php
                                                                            if (!empty($prescription->id)) {
                                                                                echo $prescription->id;
                                                                            }
                                                                            ?>'>

                                    <div class="d-flex gap-1 float-right">
                                        <div class="form-group">
                                            <button type="submit" name="submit" class="btn btn-primary float-right"> <?php echo $prescription->id ? lang('update') : lang('submit'); ?></button>
                                        </div>

                                        <div class="form-group">
                                            <button type="button" class="btn btn-secondary float-right" id="print" onclick=""> <?php echo lang('print'); ?>
                                            </button>
                                        </div>
                                    </div>



                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </form>
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



<script src="common/js/codearistos.min.js"></script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var select_medicine = "<?php echo lang('medicine'); ?>";
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
<script src="common/extranal/js/prescription/add_new_prescription_view.js"></script>