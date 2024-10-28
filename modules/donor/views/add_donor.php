<!--sidebar end-->
<!--main content start-->





<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-user-plus mr-2"></i><?php
                                                                                        if (!empty($donor->id))
                                                                                            echo lang('add_donor');
                                                                                        else
                                                                                            echo lang('add_new_donor');
                                                                                        ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php
                                                            if (!empty($donor->id))
                                                                echo lang('add_donor');
                                                            else
                                                                echo lang('add_new_donor');
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
                <div class="col-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('donor') ?> <?php echo lang('registration') ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="donor/addDonor" class="clearfix" method="post" enctype="multipart/form-data">

                                <div class="">
                                    <div class="form-group d-flex">
                                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('name'); ?> &ast; </label>
                                        <input type="text" class="form-control col-sm-9" name="name" value='<?php
                                                                                                            if (!empty($setval)) {
                                                                                                                echo set_value('name');
                                                                                                            }
                                                                                                            if (!empty($donor->name)) {
                                                                                                                echo $donor->name;
                                                                                                            }
                                                                                                            ?>' placeholder="" required="">
                                    </div>
                                    <div class="form-group d-flex">
                                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('blood_group'); ?></label>
                                        <select class="form-control col-sm-9 m-bot15" name="group" value=''>
                                            <?php foreach ($groups as $group) { ?>
                                                <option value="<?php echo $group->group; ?>" <?php
                                                                                                if (!empty($setval)) {
                                                                                                    if ($group->group == set_value('group')) {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                }
                                                                                                if (!empty($donor->group)) {
                                                                                                    if ($group->group == $donor->group) {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                }
                                                                                                ?>> <?php echo $group->group; ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex ">
                                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('age'); ?> &ast; </label>
                                        <input type="text" class="form-control col-sm-9" name="age" value='<?php
                                                                                                            if (!empty($setval)) {
                                                                                                                echo set_value('age');
                                                                                                            }
                                                                                                            if (!empty($donor->age)) {
                                                                                                                echo $donor->age;
                                                                                                            }
                                                                                                            ?>' placeholder="" required>
                                    </div>
                                    <div class="form-group d-flex">
                                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('last_donation_date'); ?> &ast; </label>
                                        <input class="form-control col-sm-9 form-control col-sm-9-inline input-medium default-date-picker readonly" type="text" name="ldd" value="<?php
                                                                                                                                                                                    if (!empty($setval)) {
                                                                                                                                                                                        echo set_value('ldd');
                                                                                                                                                                                    }
                                                                                                                                                                                    if (!empty($donor->ldd)) {
                                                                                                                                                                                        echo $donor->ldd;
                                                                                                                                                                                    }
                                                                                                                                                                                    ?>" placeholder="" required="" autocomplete="off">
                                    </div>

                                    <div class="form-group d-flex">
                                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('phone'); ?> &ast; </label>
                                        <input type="text" class="form-control col-sm-9" name="phone" value='<?php
                                                                                                                if (!empty($setval)) {
                                                                                                                    echo set_value('phone');
                                                                                                                }
                                                                                                                if (!empty($donor->phone)) {
                                                                                                                    echo $donor->phone;
                                                                                                                }
                                                                                                                ?>' placeholder="" required="">
                                    </div>

                                    <div class="form-group d-flex">
                                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('sex'); ?></label>
                                        <select class="form-control col-sm-9 m-bot15" name="sex" value=''>
                                            <option value="Male" <?php
                                                                    if (!empty($setval)) {
                                                                        if (set_value('sex') == 'Male') {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                    if (!empty($donor->sex)) {
                                                                        if ($donor->sex == 'Male') {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                    ?>> Male </option>
                                            <option value="Female" <?php
                                                                    if (!empty($setval)) {
                                                                        if (set_value('sex') == 'Female') {
                                                                            echo 'selected';
                                                                        }
                                                                    }
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
                                        <input type="email" class="form-control col-sm-9" name="email" value='<?php
                                                                                                                if (!empty($setval)) {
                                                                                                                    echo set_value('email');
                                                                                                                }
                                                                                                                if (!empty($donor->email)) {
                                                                                                                    echo $donor->email;
                                                                                                                }
                                                                                                                ?>' placeholder="" required="">
                                    </div>

                                    <input type="hidden" name="id" value='<?php
                                                                            if (!empty($donor->id)) {
                                                                                echo $donor->id;
                                                                            }
                                                                            ?>'>

                                    <div class="form-group d-flex col-md-12">
                                        <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
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