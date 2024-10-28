<!--sidebar end-->
<link href="common/extranal/css/superadmin/superadmin.css" rel="stylesheet">



<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-user-shield mr-2"></i>
                        <?php
                        if (!empty($superadmin->id))
                            echo lang('edit_superadmin');
                        else
                            echo lang('add_superadmin');
                        ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php
                                                            if (!empty($superadmin->id))
                                                                echo lang('edit_superadmin');
                                                            else
                                                                echo lang('add_superadmin');
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
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                    <?php echo validation_errors(); ?>
                                    <?php echo $this->session->flashdata('feedback'); ?>
                                </div>
                                <div class="col-lg-3"></div>
                            </div>
                            <form role="form" action="superadmin/addNew" method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('name'); ?> &ast;</label>
                                            <input type="text" class="form-control col-sm-9" name="name" value='<?php
                                                                                                                if (!empty($setval)) {
                                                                                                                    echo set_value('name');
                                                                                                                }
                                                                                                                if (!empty($superadmin->name)) {
                                                                                                                    echo $superadmin->name;
                                                                                                                }
                                                                                                                ?>' required>
                                        </div>
                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('email'); ?> &ast;</label>
                                            <input type="email" class="form-control col-sm-9" name="email" value='<?php
                                                                                                                    if (!empty($setval)) {
                                                                                                                        echo set_value('email');
                                                                                                                    }
                                                                                                                    if (!empty($superadmin->email)) {
                                                                                                                        echo $superadmin->email;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" required>
                                        </div>
                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('password'); ?> &ast;</label>
                                            <input type="password" class="form-control col-sm-9" name="password" placeholder="********" <?php if (empty($superadmin->email)) {
                                                                                                                                            echo 'required';
                                                                                                                                        } ?>>
                                        </div>
                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('address'); ?> &ast;</label>
                                            <input type="text" class="form-control col-sm-9" name="address" value='<?php
                                                                                                                    if (!empty($setval)) {
                                                                                                                        echo set_value('address');
                                                                                                                    }
                                                                                                                    if (!empty($superadmin->address)) {
                                                                                                                        echo $superadmin->address;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" required>
                                        </div>
                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('phone'); ?> &ast;</label>
                                            <input type="number" class="form-control col-sm-9" name="phone" value='<?php
                                                                                                                    if (!empty($setval)) {
                                                                                                                        echo set_value('phone');
                                                                                                                    }
                                                                                                                    if (!empty($superadmin->phone)) {
                                                                                                                        echo $superadmin->phone;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" required>
                                        </div>

                                    </div>
                                    <div class="form-group col-md-6">



                                        <div class="form-group">
                                            <label class="control-label col-sm-3"><?php echo lang('profile'); ?> <?php echo lang('image'); ?> </label>
                                            <div class="col-sm-9">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                                        <img src="<?php
                                                                    if (!empty($superadmin->img_url)) {
                                                                        echo $superadmin->img_url;
                                                                    }
                                                                    ?>" height="100px" alt="" />
                                                    </div>
                                                    <div class="mt-3">
                                                        <span class="btn btn-white btn-file">
                                                            <span class=""><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                            <!-- <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span> -->
                                                            <input type="file" class="default" name="img_url" />
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>



                                        <div class="form-group pos_client">
                                            <label for="exampleInputEmail1" class=""> <?php echo lang('module_permission'); ?></label>
                                            <br>
                                            <input type='checkbox' value="home" name="module[]" <?php
                                                                                                if (!empty($superadmin->id)) {
                                                                                                    $modules = $this->superadmin_model->getSuperadminById($superadmin->id)->module;
                                                                                                    $modules1 = explode(',', $modules);
                                                                                                    if (in_array('home', $modules1)) {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                } else {
                                                                                                    echo 'checked';
                                                                                                }
                                                                                                ?>> <?php echo lang('dashboard'); ?>
                                            <br>
                                            <input type='checkbox' value="hospital" name="module[]" <?php
                                                                                                    if (!empty($superadmin->id)) {
                                                                                                        $modules = $this->superadmin_model->getSuperadminById($superadmin->id)->module;
                                                                                                        $modules1 = explode(',', $modules);
                                                                                                        if (in_array('hospital', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('hospital'); ?>

                                            <br>
                                            <input type='checkbox' value="package" name="module[]" <?php
                                                                                                    if (!empty($superadmin->id)) {
                                                                                                        if (in_array('package', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('package'); ?>


                                            <br>
                                            <input type='checkbox' value="request" name="module[]" <?php
                                                                                                    if (!empty($superadmin->id)) {
                                                                                                        if (in_array('request', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('request'); ?>
                                            <br>
                                            <input type='checkbox' value="superadmin" name="module[]" <?php
                                                                                                        if (!empty($superadmin->id)) {
                                                                                                            if (in_array('superadmin', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('superadmin'); ?>

                                            <br>
                                            <input type='checkbox' value="email" name="module[]" <?php
                                                                                                    if (!empty($superadmin->id)) {
                                                                                                        if (in_array('email', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('email'); ?>

                                            <br>
                                            <input type='checkbox' value="pgateway" name="module[]" <?php
                                                                                                    if (!empty($superadmin->id)) {
                                                                                                        if (in_array('pgateway', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('payment_gateway'); ?>
                                            <br>
                                            <input type='checkbox' value="slide" name="module[]" <?php
                                                                                                    if (!empty($superadmin->id)) {
                                                                                                        if (in_array('slide', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('slides'); ?>
                                            <br>
                                            <input type='checkbox' value="service" name="module[]" <?php
                                                                                                    if (!empty($superadmin->id)) {
                                                                                                        if (in_array('service', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('service'); ?>
                                            <br>
                                            <input type='checkbox' value="systems" name="module[]" <?php
                                                                                                    if (!empty($superadmin->id)) {
                                                                                                        if (in_array('systems', $modules1)) {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                    ?>> <?php echo lang('report'); ?>
                                        </div>


                                        <input type="hidden" name="id" value='<?php
                                                                                if (!empty($superadmin->id)) {
                                                                                    echo $superadmin->id;
                                                                                }
                                                                                ?>'>
                                        <button type="submit" name="submit" class="btn btn-info btn-group float-right"><?php echo lang('submit'); ?></button>
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