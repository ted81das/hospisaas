<!--sidebar end-->
<!--main content start-->




<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-hospital-alt mr-2"></i>
                        <?php echo lang('departments') ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('department') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the department names and related informations'); ?></h3>
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
                                        <th> <?php echo lang('name') ?></th>
                                        <th> <?php echo lang('description') ?></th>
                                        <th class="no-print"> <?php echo lang('options') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($departments as $department) { ?>
                                        <tr>
                                            <td><?php echo $department->name; ?></td>
                                            <td><?php echo $department->description; ?></td>
                                            <td class="no-print d-flex gap-1">
                                                <a type="button" class="btn btn-primary btn-sm editbutton" data-toggle="modal" title="<?php echo lang('edit'); ?>" data-id="<?php echo $department->id; ?>"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-success btn-sm" title="<?php echo lang('doctor_directory'); ?>" href="department/doctorDirectory?id=<?php echo $department->id; ?>"><i class="fa fa-users"></i></a>
                                                <a class="btn btn-danger btn-sm" title="<?php echo lang('delete'); ?>" href="department/delete?id=<?php echo $department->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
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











<!-- page end-->

<!--main content end-->
<!--footer start-->









<!-- Add Department Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold" id="exampleModalLabel"><?php echo lang('add_department') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="department/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('department') ?> <?php echo lang('name') ?> *</label>
                        <input type="text" class="form-control col-sm-9" name="name" value="" placeholder="" required>
                    </div>
                    <div class="form-group d-flex">
                        <label class="col-sm-3"><?php echo lang('description') ?> *</label>
                        <textarea class="form-control col-sm-9" name="description" id="editor" rows="10"></textarea>
                    </div>
                    <input type="hidden" name="id" value="">
                    <div class="d-flex justify-content-end">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Add Department Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel2"><?php echo lang('edit_department') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="departmentEditForm" action="department/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group d-flex">
                        <label class="col-sm-3"><?php echo lang('department') ?> <?php echo lang('name') ?></label>
                        <input type="text" class="form-control col-sm-9" name="name" value="" required>
                    </div>
                    <div class="form-group d-flex">
                        <label class="col-sm-3"><?php echo lang('description') ?></label>
                        <textarea class="form-control col-sm-9" id="editor1" name="description" rows="10"></textarea>
                    </div>
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="p_id" value="">
                    <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit') ?></button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script src="common/extranal/js/department.js"></script>