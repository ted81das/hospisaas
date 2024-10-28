<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-user-md mr-2"></i><?php echo lang('doctor_visit') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item"><a href="doctor"><?php echo lang('doctor') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('doctor_visit') ?></li>
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
                            <h3 class="card-title"><?php echo lang('Comprehensive List of Visit Types and Associated Charges for Each Doctor'); ?></h3>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                                <div class="float-right">
                                    <a data-toggle="modal" href="#myModal">
                                        <button id="" class="btn btn-success btn-sm">
                                            <i class="fa fa-plus-circle"></i> <?php echo lang('add_doctor_visit'); ?>
                                        </button>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo lang('doctor'); ?> <?php echo lang('name'); ?></th>
                                        <th><?php echo lang('visit'); ?> <?php echo lang('description'); ?></th>
                                        <th><?php echo lang('visit'); ?> <?php echo lang('charges'); ?></th>
                                        <th><?php echo lang('status'); ?></th>
                                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                                            <th class="no-print"><?php echo lang('options'); ?></th>
                                        <?php } ?>
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




<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_doctor_visit'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="doctorvisit/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-5"> <?php echo lang('doctor'); ?></label>
                        <select class="form-control col-sm-7 m-bot15 doctor" id="adoctors" name="doctor" value='' required="">

                        </select>
                    </div>
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('visit'); ?> <?php echo lang('description'); ?></label>
                        <input type="text" class="form-control col-sm-7" name="visit_description" id="exampleInputEmail1" value='' placeholder="" required="">
                    </div>
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('visit'); ?> <?php echo lang('charges'); ?></label>
                        <input type="number" min="1" class="form-control col-sm-7" name="visit_charges" id="exampleInputEmail1" placeholder="<?php echo $settings->currency; ?>" required="">
                    </div>
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('status'); ?></label>
                        <select class="js-example-basic-single" name="status">
                            <option value="active"><?php echo lang('active'); ?></option>
                            <option value="disable"><?php echo lang('in_active'); ?></option>
                        </select>

                    </div>


                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info float-right row"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_doctor_visit'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editDoctorvisitForm" class="clearfix" action="doctorvisit/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-5"> <?php echo lang('doctor'); ?></label>
                        <select class="form-control col-sm-7 m-bot15 doctor" id="adoctors1" name="doctor" value='' required="">

                        </select>
                    </div>
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('visit'); ?> <?php echo lang('description'); ?></label>
                        <input type="text" class="form-control col-sm-7" name="visit_description" id="exampleInputEmail1" value='' placeholder="" required="">
                    </div>
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('visit'); ?> <?php echo lang('charges'); ?></label>
                        <input type="number" min="1" class="form-control col-sm-7" name="visit_charges" id="exampleInputEmail1" placeholder="<?php echo $settings->currency; ?>" required="">
                    </div>
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('status'); ?></label>
                        <select class="js-example-basic-single" name="status">
                            <option value="active"><?php echo lang('active'); ?></option>
                            <option value="disable"><?php echo lang('in_active'); ?></option>
                        </select>

                    </div>


                    <input type="hidden" name="id" value=''>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info float-right row"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script src="common/extranal/js/doctor/doctor_visit.js"></script>