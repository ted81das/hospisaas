<!--sidebar end-->
<!--main content start-->

<link href="common/extranal/css/bed/edit_alloted_bed.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-hospital-user mr-2"></i>
                        <?php
                        if (!empty($allotment->id))
                            echo lang('edit_admission');
                        else
                            echo lang('new_admission');
                        ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php
                                                            if (!empty($allotment->id))
                                                                echo lang('edit_admission');
                                                            else
                                                                echo lang('new_admission');
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
                <div class="col-8">
                    <div class="card">
                        <!-- <div class="card-header">
                            <h3 class="card-title">All the department names and related informations</h3>
                            <div class="float-right">
                                <a data-toggle="modal" href="#myModal">
                                    <button id="" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                    </button>
                                </a>
                            </div>
                        </div> -->
                        <!-- /.card-header -->
                        <div class="card-body py-5">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="bed/addAllotment" class="clearfix row" method="post" enctype="multipart/form-data">
                                <div class="form-group col-md-12 d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('admission_time'); ?></label>
                                    <div data-date="" class="input-group date form_datetime-meridian">
                                        <div class="input-group-btn">
                                            <div type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></div>
                                            <div type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></div>
                                        </div>
                                        <input type="text" class="form-control col-sm-9" readonly="" name="a_time" id="alloted_time" value='<?php
                                                                                                                                            if (!empty($allotment->a_time)) {
                                                                                                                                                echo $allotment->a_time;
                                                                                                                                            }
                                                                                                                                            ?>' placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('bed_category'); ?></label>
                                    <select class="form-control col-sm-9 m-bot15" id="room_no" name="category" value='' required>
                                        <option><?php echo lang('select'); ?></option>
                                        <?php foreach ($room_no as $room) { ?>
                                            <option value="<?php echo $room->category; ?>" <?php
                                                                                            if (!empty($allotment->category)) {
                                                                                                if ($allotment->category == $room->category) {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                            }
                                                                                            ?>> <?php echo $room->category; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('bed_id'); ?></label>
                                    <select class="form-control col-sm-9 m-bot15" id="bed_id" name="bed_id" value='' required>
                                        <option value="" disabled><?php echo lang('select'); ?></option>
                                        <?php if (!empty($allotment->bed_id)) {
                                            echo $bed;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('patient'); ?></label>
                                    <select class="form-control col-sm-9 m-bot15" id="patientchoose" name="patient" value=''>
                                        <?php if (!empty($allotment->patient)) { ?>
                                            <option value="<?php echo $allotment->patient; ?>" selected>
                                                <?php echo $this->db->get_where('patient', array('id' => $allotment->patient))->row()->name . '( Id: ' . $allotment->patient . ')'; ?>
                                            </option>
                                        <?php    } ?>
                                    </select>
                                </div>


                                <div class="form-group col-md-12 d-flex">

                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('category'); ?>:</label>
                                    <div class="col-sm-9">
                                        <?php
                                        if (!empty($allotment->category_status)) {
                                            $category_explode = explode(',', $allotment->category_status);
                                        }
                                        ?>
                                        <span></span>
                                        <input type="checkbox" name="category_status[]" value="urgent" <?php if (!empty($allotment->category_status)) {
                                                                                                            if (in_array('urgent', $category_explode)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } ?>>
                                        <label class="planned_class"><?php echo lang('urgent'); ?></label>
                                        <input type="checkbox" name="category_status[]" value="planned" <?php if (!empty($allotment->category_status)) {
                                                                                                            if (in_array('planned', $category_explode)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } ?>>
                                        <label><?php echo lang('planned'); ?></label>
                                    </div>

                                </div>
                                <div class="form-group col-md-12 d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('reaksione'); ?>:</label>
                                    <textarea name="reaksione" class='form-control col-sm-9'><?php
                                                                                                if (!empty($allotment->reaksione)) {
                                                                                                    echo $allotment->reaksione;
                                                                                                }
                                                                                                ?> </textarea>

                                </div>
                                <div class="form-group col-md-12 d-flex">

                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('transferred_from'); ?>:</label>
                                    <textarea name="transferred_from" class='form-control col-sm-9'><?php
                                                                                                    if (!empty($allotment->transferred_from)) {
                                                                                                        echo $allotment->transferred_from;
                                                                                                    }
                                                                                                    ?> </textarea>

                                </div>
                                <div class="form-group col-md-12 d-flex">

                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('diagnoza_a_shtrimit'); ?>:</label>
                                    <textarea name="diagnoza_a_shtrimit" class='form-control col-sm-9'><?php
                                                                                                        if (!empty($allotment->diagnoza_a_shtrimit)) {
                                                                                                            echo $allotment->diagnoza_a_shtrimit;
                                                                                                        }
                                                                                                        ?>  </textarea>

                                </div>
                                <div class="form-group col-md-12 d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('doctor'); ?></label>
                                    <select class="form-control col-sm-9 m-bot15" id="doctors" name="doctor" value=''>
                                        <?php if (!empty($allotment->doctor)) { ?>
                                            <option value="<?php echo $allotment->doctor; ?>" selected> <?php echo $this->db->get_where('doctor', array('id' => $allotment->doctor))->row()->name . '( Id: ' . $allotment->doctor . ')'; ?> </option>
                                        <?php    } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 d-flex">

                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('diagnosis'); ?>:</label>
                                    <textarea name="diagnosis" class='form-control col-sm-9'><?php
                                                                                                if (!empty($allotment->diagnosis)) {
                                                                                                    echo $allotment->diagnosis;
                                                                                                }
                                                                                                ?>  </textarea>

                                </div>
                                <div class="form-group col-md-12 d-flex">

                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('other_illnesses'); ?>:</label>
                                    <textarea name="other_illnesses" class='form-control col-sm-9'><?php
                                                                                                    if (!empty($allotment->other_illnesses)) {
                                                                                                        echo $allotment->other_illnesses;
                                                                                                    }
                                                                                                    ?>  </textarea>

                                </div>
                                <div class="form-group col-md-12 d-flex">

                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('anamneza'); ?>:</label>
                                    <textarea name="anamneza" class='form-control col-sm-9'> <?php
                                                                                                if (!empty($allotment->anamneza)) {
                                                                                                    echo $allotment->anamneza;
                                                                                                }
                                                                                                ?></textarea>

                                </div>
                                <div class="form-group col-md-12 d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('blood_group'); ?></label>
                                    <select class="form-control col-sm-9 m-bot15" id="blood_group" name="blood_group" value=''>
                                        <option value=""></option>
                                        <?php foreach ($blood_group as $blood_group) {
                                        ?>

                                            <option value="<?php echo $blood_group->id; ?>" <?php
                                                                                            if (!empty($allotment->blood_group)) {
                                                                                                if ($blood_group->id == $allotment->blood_group) {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                            }
                                                                                            ?>><?php echo $blood_group->bloodgroup; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('accepting_doctor'); ?></label>
                                    <select class="form-control col-sm-9 m-bot15" id="accepting_doctors" name="accepting_doctor" value=''>
                                        <?php if (!empty($allotment->accepting_doctor)) { ?>
                                            <option value="<?php echo $allotment->accepting_doctor; ?>" selected> <?php echo $this->db->get_where('doctor', array('id' => $allotment->accepting_doctor))->row()->name . '( Id: ' . $allotment->accepting_doctor . ')'; ?> </option>
                                        <?php    } ?>
                                    </select>
                                </div>


                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($allotment->id)) {
                                                                            echo $allotment->id;
                                                                        }
                                                                        ?>'>
                                <?php if (empty($allotment->d_time)) { ?>
                                    <div class="form-group col-md-12 d-flex">
                                        <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                                    </div>
                                <?php } ?>
                            </form>
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
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/bed/add_allotment.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.form_datetime-meridian').datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            autoclose: true,
            todayBtn: true,
            showMeridian: true
        });
    });
</script>