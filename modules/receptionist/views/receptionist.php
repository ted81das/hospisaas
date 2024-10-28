<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-user-tie mr-2"></i><?php echo lang('receptionist') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('receptionist') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the receptionist names and related informations'); ?></h3>
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
                                        <th> <?php echo lang('image'); ?></th>
                                        <th> <?php echo lang('name'); ?></th>
                                        <th> <?php echo lang('email'); ?></th>
                                        <th> <?php echo lang('address'); ?></th>
                                        <th> <?php echo lang('phone'); ?></th>
                                        <th> <?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($receptionists as $receptionist) { ?>
                                        <tr class="">
                                            <td class="align-middle"><img class="img-fluid rounded-circle" style="width: 50px; height: 50px;" src="<?php echo $receptionist->img_url; ?>"></td>
                                            <td class="align-middle"> <?php echo $receptionist->name; ?></td>
                                            <td class="align-middle"><?php echo $receptionist->email; ?></td>
                                            <td class="align-middle"><?php echo $receptionist->address; ?></td>
                                            <td class="align-middle"><?php echo $receptionist->phone; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $receptionist->id; ?>"><i class="fa fa-edit"> </i></button>
                                                <a class="btn btn-danger btn-sm delete_button" href="receptionist/delete?id=<?php echo $receptionist->id; ?>" title="<?php echo lang('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                                            </td>

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









<!-- Add Receptionist Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_receptionist'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" class="clearfix form-row" action="receptionist/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control col-sm-9" name="name" value='' required="">
                    </div>
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('email'); ?> &ast;</label>
                        <input type="email" class="form-control col-sm-9" name="email" value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('password'); ?> &ast;</label>
                        <input type="password" class="form-control col-sm-9" name="password" placeholder="" required="">
                    </div>
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('address'); ?> &ast;</label>
                        <input type="text" class="form-control col-sm-9" name="address" value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('phone'); ?> &ast;</label>
                        <input type="number" class="form-control col-sm-9" name="phone" value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-12 profile">
                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('profile'); ?> &ast; </label>
                        <textarea class="form-control col-sm-9 ckeditor" id="editor1" name="profile" value="" rows="10" cols="20"></textarea>
                        <!-- <input type="hidden" name="profile" id="profile" value=""> -->
                    </div>

                    <div class="col-md-12 row">
                        <div class="form-group col-md-6 d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('signature'); ?> &ast; </label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                        <img src="" height="100px" alt="" />
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
                        <div class="form-group col-md-6 d-flex">
                            <label class="control-label col-sm-3"><?php echo lang('image'); ?> </label>
                            <div class="col-sm-9">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                        <img src="" height="100px" alt="" />
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
                    </div>


                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right row"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Receptionist Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_receptionist'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editReceptionistForm" class="clearfix form-row" action="receptionist/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control col-sm-9" name="name" value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('email'); ?> &ast;</label>
                        <input type="email" class="form-control col-sm-9" name="email" value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('password'); ?></label>
                        <input type="password" class="form-control col-sm-9" name="password" placeholder="********">
                    </div>
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('address'); ?> &ast;</label>
                        <input type="text" class="form-control col-sm-9" name="address" value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('phone'); ?> &ast;</label>
                        <input type="number" class="form-control col-sm-9" name="phone" value='' placeholder="" required="">
                    </div>

                    <div class="form-group col-md-12 profile1">
                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('profile'); ?></label>
                        <textarea class="form-control col-sm-9 ckeditor" id="editor3" name="profile" value="" rows="10" cols="20"></textarea>


                    </div>

                    <div class="col-md-12 row">
                        <div class="form-group col-md-6 d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('signature'); ?> &ast; </label>
                            <div class="col-sm-9">
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
                        <div class="form-group col-md-6 d-flex">
                            <label class="control-label col-sm-3"><?php echo lang('image'); ?> </label>
                            <div class="col-sm-9">
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
                    </div>



                    <!-- <input type="hidden" name="profile" id="profile1" value=""> -->
                    <input type="hidden" name="id" id="id_value" value=''>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right row"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/receptionist.js"></script>