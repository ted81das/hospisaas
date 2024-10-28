<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-plus-circle"></i> <?php
                                                                                    if (!empty($doctor->id))
                                                                                        echo lang('edit_doctor');
                                                                                    else
                                                                                        echo lang('add_doctor');
                                                                                    ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php
                                                            if (!empty($doctor->id))
                                                                echo lang('edit_doctor');
                                                            else
                                                                echo lang('add_doctor');
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
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                    <?php echo validation_errors(); ?>
                                    <?php echo $this->session->flashdata('feedback'); ?>
                                </div>
                                <div class="col-lg-3"></div>
                            </div>
                            <form role="form" action="doctor/addNew" class="row" method="post" enctype="multipart/form-data">
                                <div class="form-group  d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('name'); ?> &ast; </label>
                                    <input type="text" class="form-control col-sm-9" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                                if (!empty($setval)) {
                                                                                                                                    echo set_value('name');
                                                                                                                                }
                                                                                                                                if (!empty($doctor->name)) {
                                                                                                                                    echo $doctor->name;
                                                                                                                                }
                                                                                                                                ?>' placeholder="" required="">
                                </div>
                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('email'); ?> &ast; </label>
                                    <input type="email" class="form-control col-sm-9" name="email" id="exampleInputEmail1" value='<?php
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('email');
                                                                                                                                    }
                                                                                                                                    if (!empty($doctor->email)) {
                                                                                                                                        echo $doctor->email;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="" required="">
                                </div>
                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('password'); ?></label>
                                    <input type="password" class="form-control col-sm-9" name="password" id="exampleInputEmail1" placeholder="********">
                                </div>

                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('address'); ?> &ast; </label>
                                    <input type="text" class="form-control col-sm-9" name="address" id="exampleInputEmail1" value='<?php
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('address');
                                                                                                                                    }
                                                                                                                                    if (!empty($doctor->address)) {
                                                                                                                                        echo $doctor->address;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="" required>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('phone'); ?> &ast; </label>
                                    <input type="text" class="form-control col-sm-9" name="phone" id="exampleInputEmail1" value='<?php
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('phone');
                                                                                                                                    }
                                                                                                                                    if (!empty($doctor->phone)) {
                                                                                                                                        echo $doctor->phone;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="" required>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('department'); ?></label>
                                    <select class="form-control col-sm-9 m-bot15" name="department" value=''>
                                        <?php foreach ($departments as $department) { ?>
                                            <option value="<?php echo $department->id; ?>" <?php
                                                                                            if (!empty($setval)) {
                                                                                                if ($department->id == set_value('department')) {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                            }
                                                                                            if (!empty($doctor->department)) {
                                                                                                if ($department->id == $doctor->department) {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                            }
                                                                                            ?>> <?php echo $department->name; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('profile'); ?> &ast; </label>
                                    <textarea class="form-control col-sm-9 ckeditor" id="editor1" name="profile" value="<?php
                                                                                                                        if (!empty($setval)) {
                                                                                                                            echo set_value('profile');
                                                                                                                        }
                                                                                                                        if (!empty($doctor->profile)) {
                                                                                                                            echo $doctor->profile;
                                                                                                                        }
                                                                                                                        ?>" rows="10" cols="20"></textarea>


                                </div>

                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang(''); ?> <?php echo lang('image'); ?> </label>
                                    <div class="col-sm-9">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                                <img src="<?php

                                                            if (!empty($doctor->img_url)) {
                                                                echo $doctor->img_url;
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

                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('signature'); ?> &ast; </label>
                                    <div class="col-sm-9">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                                <img src="<?php

                                                            if (!empty($doctor->signature)) {
                                                                echo $doctor->signature;
                                                            }
                                                            ?>" height="100px" alt="" />
                                            </div>
                                            <div>
                                                <span class="btn btn-white btn-file">
                                                    <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                    <!-- <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span> -->
                                                    <input type="file" class="default" name="signature" />
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                </div>











                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($doctor->id)) {
                                                                            echo $doctor->id;
                                                                        }
                                                                        ?>'>
                                <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
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
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script src="common/extranal/js/doctor/doctor.js"></script>