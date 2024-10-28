<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-pills mr-2"></i><?php echo lang('medicine') ?> <?php echo lang('category') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('medicine') ?> <?php echo lang('category') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the medicine categories names and related informations'); ?></h3>
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
                                        <th> <?php echo lang('category'); ?></th>
                                        <th> <?php echo lang('description'); ?></th>
                                        <th> <?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php foreach ($categories as $category) { ?>
                                        <tr class="">
                                            <td><?php echo $category->category; ?></td>
                                            <td> <?php echo $category->description; ?></td>
                                            <td>
                                                <a type="button" class="btn btn-info btn-sm editbutton" data-toggle="modal" data-id="<?php echo $category->id; ?>"><i class="fa fa-edit"> <?php echo lang(''); ?></i></a>
                                                <a class="btn btn-danger btn-sm" href="medicine/deleteMedicineCategory?id=<?php echo $category->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> <?php echo lang(''); ?></i></a>

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








<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title font-weight-bold"> <?php echo lang('create_medicine_category'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="medicine/addNewCategory" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('category'); ?> <?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control col-sm-9" name="category" value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-12 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('description'); ?> &ast;</label>
                        <input type="text" class="form-control col-sm-9" name="description" value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-12 d-flex">
                        <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>








<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_medicine_category'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="editCategoryForm" action="medicine/addNewCategory" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('category'); ?> <?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control col-sm-9" name="category" value='' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-12 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('description'); ?></label>
                        <input type="text" class="form-control col-sm-9" name="description" value='' placeholder="" required="">
                    </div>
                    <input type="hidden" name="id" value=''>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
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
<script src="common/extranal/js/medicine/medicine_category.js"></script>