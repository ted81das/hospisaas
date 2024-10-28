<!--sidebar end-->
<!--main content start-->
<link href="common/extranal/css/patient/add_new.css" rel="stylesheet">


<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-2">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-user-edit mr-2"></i>
                        <?php
                        if (!empty($patient->id)) {
                            echo lang('edit_patient');
                        } else {
                            echo lang('add_new_patient');
                        }
                        ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item"><a href="patient"><?php echo lang('patient') ?></a></li>
                        <li class="breadcrumb-item active"> <?php
                                                            if (!empty($patient->id)) {
                                                                echo lang('edit_patient');
                                                            } else {
                                                                echo lang('add_new_patient');
                                                            }
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
                <div class="col-md-7">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body py-5">
                            <div class="col-lg-12">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                    <?php echo validation_errors(); ?>
                                </div>
                                <div class="col-lg-3"></div>
                            </div>
                            <form role="form" action="patient/addNew" method="post" class="row" enctype="multipart/form-data">

                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('name'); ?> &ast;</label>
                                    <input type="text" class="form-control" name="name" value='<?php
                                                                                                if (!empty($setval)) {
                                                                                                    echo set_value('name');
                                                                                                }
                                                                                                if (!empty($patient->name)) {
                                                                                                    echo $patient->name;
                                                                                                }
                                                                                                ?>' placeholder="" required="">
                                </div>


                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('email'); ?> &ast;</label>
                                    <input type="email" autocomplete="off" class="form-control" name="email" value='<?php
                                                                                                                    if (!empty($patient->email)) {
                                                                                                                        echo $patient->email;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" required="">
                                </div>

                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('password'); ?> &ast;</label>
                                    <input type="password" autocomplete="new-password" class="form-control" name="password" placeholder="">

                                </div>

                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('address'); ?> &ast;</label>
                                    <input type="text" class="form-control" name="address" value='<?php
                                                                                                    if (!empty($setval)) {
                                                                                                        echo set_value('address');
                                                                                                    }
                                                                                                    if (!empty($patient->address)) {
                                                                                                        echo $patient->address;
                                                                                                    }
                                                                                                    ?>' placeholder="" required="">
                                </div>
                                <!--   onKeyPress="if(this.value.length==11) return false;" -->
                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('phone'); ?> &ast;</label>
                                    <input type="text" class="form-control" name="phone" value='<?php
                                                                                                if (!empty($setval)) {
                                                                                                    echo set_value('phone');
                                                                                                }
                                                                                                if (!empty($patient->phone)) {
                                                                                                    echo $patient->phone;
                                                                                                }
                                                                                                ?>' placeholder="" required>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('sex'); ?></label>
                                    <select class="form-control m-bot15 col-sm-9" name="sex" value=''>
                                        <option value="Male" <?php
                                                                if (!empty($setval)) {
                                                                    if (set_value('sex') == 'Male') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                if (!empty($patient->sex)) {
                                                                    if ($patient->sex == 'Male') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>> <?php echo lang('male'); ?> </option>
                                        <option value="Female" <?php
                                                                if (!empty($setval)) {
                                                                    if (set_value('sex') == 'Female') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                if (!empty($patient->sex)) {
                                                                    if ($patient->sex == 'Female') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>> <?php echo lang('female'); ?> </option>
                                    </select>
                                </div>

                                <div class="form-group d-flex">
                                    <label class="col-sm-3"><?php echo lang('birth_date'); ?></label>
                                    <input class="col-sm-9 form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="<?php
                                                                                                                                                                    if (!empty($setval)) {
                                                                                                                                                                        echo set_value('birthdate');
                                                                                                                                                                    }
                                                                                                                                                                    if (!empty($patient->birthdate)) {
                                                                                                                                                                        echo $patient->birthdate;
                                                                                                                                                                    }
                                                                                                                                                                    ?>" placeholder="">
                                </div>
                                <div class="form-group d-flex">
                                    <label class="col-sm-3"><?php echo lang('age'); ?></label>
                                    <div class="col-sm-9">

                                        <?php
                                        if (!empty($patient->age)) {
                                            $age = explode('-', $patient->age);
                                        } ?>
                                        <div class="input-group m-bot15">

                                            <input type="number" min="0" max="150" class="form-control" name="years" value='<?php
                                                                                                                            if (!empty($setval)) {
                                                                                                                                echo set_value('years');
                                                                                                                            }
                                                                                                                            if (!empty($patient->age)) {
                                                                                                                                echo $age[0];
                                                                                                                            }
                                                                                                                            ?>' placeholder="<?php echo lang('years'); ?>">
                                            <!-- <span class="input-group-addon"><?php echo lang('years'); ?></span> -->
                                            <input type="number" class="form-control input-group-addon" min="0" max="12" name="months" value='<?php
                                                                                                                                                if (!empty($setval)) {
                                                                                                                                                    echo set_value('months');
                                                                                                                                                }
                                                                                                                                                if (!empty($patient->age)) {
                                                                                                                                                    echo $age[1];
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="<?php echo lang('months'); ?>">
                                            <!-- <span class="input-group-addon"><?php echo lang('months'); ?></span> -->
                                            <input type="number" class="form-control input-group-addon" name="days" min="0" max="29" value='<?php
                                                                                                                                            if (!empty($setval)) {
                                                                                                                                                echo set_value('days');
                                                                                                                                            }
                                                                                                                                            if (!empty($patient->age)) {
                                                                                                                                                echo $age[2];
                                                                                                                                            }
                                                                                                                                            ?>' placeholder="<?php echo lang('days'); ?>">
                                            <!-- <span class="input-group-addon"><?php echo lang('days'); ?></span> -->
                                        </div>


                                    </div>



                                </div>

                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('blood_group'); ?></label>
                                    <select class="form-control m-bot15" name="bloodgroup" value=''>
                                        <option><?php echo lang('select'); ?></option>
                                        <?php foreach ($groups as $group) { ?>
                                            <option value="<?php echo $group->group; ?>" <?php
                                                                                            if (!empty($setval)) {
                                                                                                if ($group->group == set_value('bloodgroup')) {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                            }
                                                                                            if (!empty($patient->bloodgroup)) {
                                                                                                if ($group->group == $patient->bloodgroup) {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                            }
                                                                                            ?>> <?php echo $group->group; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('doctor'); ?></label>
                                    <select class="form-control m-bot15 js-example-basic-single" name="doctor" value=''>
                                        <?php foreach ($doctors as $doctor) { ?>
                                            <option value="<?php echo $doctor->id; ?>" <?php
                                                                                        if (!empty($patient->doctor)) {
                                                                                            if ($patient->doctor == $doctor->id) {
                                                                                                echo 'selected';
                                                                                            }
                                                                                        }
                                                                                        ?>><?php echo $doctor->name; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <?php if (empty($id)) { ?>

                                    <div class="form-group d-flex sms_send">

                                        <label for="sms" class="col-sm-3"><?php echo lang('send_sms'); ?></label>
                                        <input type="checkbox" name="sms" value="sms"> <br>

                                    </div>

                                <?php } ?>


                                <div class="form-group d-flex">
                                    <label class="control-label col-sm-3"><?php echo lang('profile'); ?> <?php echo lang('image'); ?></label>
                                    <div class="col-sm-9">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                                <img src="<?php

                                                            if (!empty($patient->img_url)) {
                                                                echo $patient->img_url;
                                                            }
                                                            ?>" height="100px" alt="" />
                                            </div>
                                            <div>
                                                <span class="btn btn-white btn-file">
                                                    <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                    <!-- <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span> -->
                                                    <input type="file" class="default" name="img_url" />
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>







                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($patient->id)) {
                                                                            echo $patient->id;
                                                                        }
                                                                        ?>'>
                                <input type="hidden" name="p_id" value='<?php
                                                                        if (!empty($patient->patient_id)) {
                                                                            echo $patient->patient_id;
                                                                        }
                                                                        ?>'>
                                <section class="">
                                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                </section>
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