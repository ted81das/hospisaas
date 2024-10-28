<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-tint mr-2"></i><?php echo lang('donor') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('donor') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the donor names and related informations'); ?></h3>
                            <div class="float-right">
                                <a data-toggle="modal" href="#myModal">
                                    <button id="" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('name'); ?></th>
                                        <th><?php echo lang('blood_group'); ?></th>
                                        <th><?php echo lang('age'); ?></th>
                                        <th><?php echo lang('sex'); ?></th>
                                        <th><?php echo lang('last_donation_date'); ?></th>
                                        <th><?php echo lang('phone'); ?></th>
                                        <th><?php echo lang('email'); ?></th>
                                        <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Laboratorist', 'Doctor'))) { ?>
                                            <th class="no-print"><?php echo lang('options'); ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php foreach ($donors as $donor) { ?>
                                        <tr class="">
                                            <td><?php echo $donor->name; ?></td>
                                            <td> <?php echo $donor->group; ?></td>
                                            <td><?php echo $donor->age; ?></td>
                                            <td class="center"><?php echo $donor->sex; ?></td>
                                            <td><?php echo $donor->ldd; ?></td>
                                            <td><?php echo $donor->phone; ?></td>
                                            <td><?php echo $donor->email; ?></td>
                                            <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Laboratorist', 'Doctor'))) { ?>
                                                <td class="no-print d-flex gap-1">
                                                    <a type="button" class="btn btn-info btn-sm editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $donor->id; ?>"><i class="fa fa-edit"> </i></a>
                                                    <a class="btn btn-danger btn-sm" title="<?php echo lang('delete'); ?>" href="donor/delete?id=<?php echo $donor->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>

                                                </td>
                                            <?php } ?>
                                        </tr>
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







<!-- Add Donor Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_donor'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="donor/addDonor" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="">
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('name'); ?> &ast; </label>
                            <input type="text" class="form-control col-sm-9" name="name" value='' placeholder="" required="">
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('blood_group'); ?></label>
                            <select class="form-control col-sm-9 m-bot15" name="group" value=''>
                                <?php foreach ($groups as $group) { ?>
                                    <option value="<?php echo $group->group; ?>" <?php
                                                                                    if (!empty($donor->group)) {
                                                                                        if ($group->group == $donor->group) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                    }
                                                                                    ?>> <?php echo $group->group; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('age'); ?></label>
                            <input type="text" class="form-control col-sm-9" name="age" value='' placeholder="" required>
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('last_donation_date'); ?> &ast; </label>
                            <input class="form-control col-sm-9 form-control col-sm-9-inline input-medium default-date-picker readonly" autocomplete="off" type="text" name="ldd" value="" placeholder="" required="">
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('phone'); ?> &ast; </label>
                            <input type="number" class="form-control col-sm-9" name="phone" value='' placeholder="" required="">
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('sex'); ?></label>
                            <select class="form-control col-sm-9 m-bot15" name="sex" value=''>
                                <option value="Male" <?php
                                                        if (!empty($donor->sex)) {
                                                            if ($donor->sex == 'Male') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>> Male </option>
                                <option value="Female" <?php
                                                        if (!empty($donor->sex)) {
                                                            if ($donor->sex == 'Female') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>> Female </option>

                            </select>
                        </div>


                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('email'); ?> &ast; </label>
                            <input type="email" class="form-control col-sm-9" name="email" value='' placeholder="" required="">
                        </div>

                        <div class="form-group d-flex col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Donor Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_donor'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="editDonorForm" class="clearfix" action="donor/addDonor" method="post" enctype="multipart/form-data">
                    <div class="">
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('name'); ?></label>
                            <input type="text" class="form-control col-sm-9" name="name" value='' placeholder="">
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('blood_group'); ?></label>
                            <select class="form-control col-sm-9 m-bot15" name="group" value=''>
                                <?php foreach ($groups as $group) { ?>
                                    <option value="<?php echo $group->group; ?>" <?php
                                                                                    if (!empty($donor->group)) {
                                                                                        if ($group->group == $donor->group) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                    }
                                                                                    ?>> <?php echo $group->group; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('age'); ?></label>
                            <input type="text" class="form-control col-sm-9" name="age" value='' placeholder="" required>
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('last_donation_date'); ?></label>
                            <input class="form-control col-sm-9 form-control col-sm-9-inline input-medium default-date-picker" type="text" name="ldd" value="" placeholder="">
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('phone'); ?></label>
                            <input type="text" class="form-control col-sm-9" name="phone" value='' placeholder="">
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('sex'); ?></label>
                            <select class="form-control col-sm-9 m-bot15" name="sex" value=''>
                                <option value="Male" <?php
                                                        if (!empty($donor->sex)) {
                                                            if ($donor->sex == 'Male') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>> Male </option>
                                <option value="Female" <?php
                                                        if (!empty($donor->sex)) {
                                                            if ($donor->sex == 'Female') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>> Female </option>

                            </select>
                        </div>


                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('email'); ?></label>
                            <input type="text" class="form-control col-sm-9" name="email" value='' placeholder="">
                        </div>

                        <input type="hidden" name="id" value=''>

                        <div class="form-group d-flex col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                        </div>
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

<script src="common/extranal/js/donor/donor.js"></script>