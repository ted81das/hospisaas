<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-comment-medical mr-2"></i>
                        <?php echo lang('advice_list') ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item"><a href="advice"><?php echo lang('advice_list') ?></a></li>
                        <!-- <li class="breadcrumb-item active"><?php echo lang('doctor_visit') ?></li> -->
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
                            <h3 class="card-title"><?php echo lang('Comprehensive List of Advice'); ?></h3>

                            <div class="float-right">
                                <a data-toggle="modal" href="#myModal">
                                    <button id="" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_advice'); ?>
                                    </button>
                                </a>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> <?php echo lang('name'); ?></th>
                                        <th><?php echo lang('description'); ?></th>
                                        <th class="no-print"><?php echo lang('options'); ?></th>

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
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_advice'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="advice/addNew" method="post" enctype="multipart/form-data">

                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('name'); ?> </label>
                        <input type="text" class="form-control col-sm-9" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                    if (!empty($setval)) {
                                                                                                                        echo set_value('name');
                                                                                                                    }
                                                                                                                    if (!empty($advice->name)) {
                                                                                                                        echo $advice->name;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" required>
                    </div>

                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('description'); ?> </label>
                        <textarea class="form-control col-sm-9 ckeditor" id="editor1" name="description" value="<?php
                                                                                                                if (!empty($setval)) {
                                                                                                                    echo set_value('description');
                                                                                                                }
                                                                                                                if (!empty($advice->description)) {
                                                                                                                    echo $advice->description;
                                                                                                                }
                                                                                                                ?>" rows="10" cols="20"></textarea>


                    </div>

                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
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
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_advice'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editAdviceForm" class="clearfix" action="advice/addNew" method="post" enctype="multipart/form-data">



                    <input type="hidden" name="id" value=''>

                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('name'); ?> </label>
                        <input type="text" class="form-control col-sm-9" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                    if (!empty($setval)) {
                                                                                                                        echo set_value('name');
                                                                                                                    }
                                                                                                                    if (!empty($advice->name)) {
                                                                                                                        echo $advice->name;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" required>
                    </div>

                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('description'); ?> </label>
                        <textarea class="form-control col-sm-9" id="editor3" name="description" value="" rows="30" cols="20"></textarea>


                    </div>

                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
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
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script src="common/extranal/js/advice.js"></script>