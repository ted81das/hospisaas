<!-- Add your custom CSS -->
<link href="common/extranal/css/doctor/doctor.css" rel="stylesheet">



<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-2">
                <div class="col-sm-6 col-5">
                    <h1 class="font-weight-bold"><i class="fas fa-user-md mr-2"></i><strong><?php echo lang('doctors') ?></strong></h1>
                </div>
                <div class="col-sm-6 col-7 d-flex justify-content-end gap-3 pr-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('doctor') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the doctor names and related informations'); ?></h3>
                            <div class="float-right">
                                <a data-toggle="modal" href="#myModal" id="" class="btn btn-primary btn-sm px-4 py-3">
                                    <i class="fa fa-plus"></i> <?php echo lang('add_new'); ?> <?php echo lang('doctor'); ?>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover datatables text-md" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('id'); ?></th>
                                        <th><?php echo lang('name'); ?></th>
                                        <th><?php echo lang('email'); ?></th>
                                        <th><?php echo lang('phone'); ?></th>
                                        <th><?php echo lang('department'); ?></th>
                                        <th><?php echo lang('profile'); ?></th>
                                        <th class="d-none d-md-table-cell"><?php echo lang('options'); ?></th>
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





<!-- Add Doctor Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_new_doctor'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" action="doctor/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="">
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('name'); ?> &ast; </label>
                            <input type="text" class="form-control col-sm-9" name="name" value='' placeholder="" required="">
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('email'); ?> &ast; </label>
                            <input type="text" class="form-control col-sm-9" name="email" value='' placeholder="" required="">
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('password'); ?> &ast; </label>
                            <input type="password" class="form-control col-sm-9" name="password" placeholder="********" required="">
                        </div>

                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('address'); ?> &ast; </label>
                            <input type="text" class="form-control col-sm-9" name="address" value='' placeholder="" required>
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('phone'); ?> &ast; </label>
                            <input type="text" class="form-control col-sm-9" name="phone" value='' placeholder="" required>
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('department'); ?></label>
                            <select class="form-control col-sm-9 m-bot15 js-example-basic-single" name="department" value=''>
                                <?php foreach ($departments as $department) { ?>
                                    <option value="<?php echo $department->id; ?>"> <?php echo $department->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>


                        <div class="form-group profile d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('doctor'); ?> <?php echo lang('description'); ?></label>
                            <textarea class="form-control col-sm-9" id="editor1" name="profile" value="" rows="5" cols="20"></textarea>
                        </div>


                        <div class="form-group d-flex">
                            <div class="col-sm-3">
                                <label for="exampleInputEmail1"><?php echo lang('signature'); ?> &ast; </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                        <img src="" height="100px" alt="" />
                                    </div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                            <input type="file" class="default" name="signature" />
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group d-flex">
                            <div class="col-sm-3">
                                <label for="exampleInputEmail1"><?php echo lang('signature'); ?> &ast; </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                        <img src="" height="100px" alt="" />
                                    </div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                            <input type="file" class="default" name="signature" />
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Doctor Modal-->







<!-- Edit Doctor Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_doctor'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editDoctorForm" class="clearfix" action="doctor/addNew" method="post" enctype="multipart/form-data">
                    <div class="">
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('name'); ?> &ast;</label>
                            <input type="text" class="form-control col-sm-9" name="name" value='' placeholder="" required>
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('email'); ?> &ast;</label>
                            <input type="text" class="form-control col-sm-9" name="email" value='' placeholder="" required>
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('password'); ?></label>
                            <input type="password" class="form-control col-sm-9" name="password" placeholder="********">
                        </div>

                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('address'); ?> &ast;</label>
                            <input type="text" class="form-control col-sm-9" name="address" value='' placeholder="" required>
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('phone'); ?> &ast;</label>
                            <input type="text" class="form-control col-sm-9" name="phone" value='' placeholder="" required>
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('department'); ?></label>
                            <select class="form-control col-sm-9 m-bot15 js-example-basic-single department" name="department" value=''>
                                <?php foreach ($departments as $department) { ?>
                                    <option value="<?php echo $department->id; ?>" <?php
                                                                                    if (!empty($doctor->department)) {
                                                                                        if ($department->id == $doctor->department) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                    }
                                                                                    ?>> <?php echo $department->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group profile1 d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('doctor'); ?> <?php echo lang('description'); ?></label>
                            <textarea class="form-control col-sm-9" id="editor3" name="profile" value="" rows="30" cols="20"></textarea>
                        </div>

                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('signature'); ?> &ast; </label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                        <img src="" id="signature" height="100px" alt="" />
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
                        <div class="form-group d-flex">
                            <label class="col-sm-3"><?php echo lang(''); ?> <?php echo lang('image'); ?> </label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                        <img src="" id="img" height="100px" alt="" />
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



                        <input type="hidden" name="id" id="id_value" value=''>
                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Doctor Modal-->



<div class="modal fade" id="infoModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('doctor'); ?> <?php echo lang('info'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="form-group d-flex">
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_class">
                                    <img height="100px" src="" id="img1" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail img_url"></div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('name'); ?></label>
                        <div class="nameClass"></div>
                    </div>
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('email'); ?></label>
                        <div class="emailClass"></div>
                    </div>
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('address'); ?></label>
                        <div class="addressClass"></div>
                    </div>

                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('phone'); ?></label>
                        <div class="phoneClass"></div>
                    </div>
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('department'); ?></label>
                        <div class="departmentClass"></div>
                    </div>
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('profile'); ?></label>
                        <div class="profileClass"></div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<style>
    .mr-1 {
        margin-bottom: 5px;
    }
</style>



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/assets/tinymce/tinymce.min.js"></script>
<script src="common/extranal/js/doctor/doctor.js"></script>