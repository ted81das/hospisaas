<!--sidebar end-->
<!--main content start-->



<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-pills mr-2"></i><?php
                                                                                    if (!empty($medicine->id))
                                                                                        echo lang('edit_medicine_category');
                                                                                    else
                                                                                        echo lang('add_medicine_category');
                                                                                    ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php
                                                            if (!empty($medicine->id))
                                                                echo lang('edit_medicine_category');
                                                            else
                                                                echo lang('add_medicine_category');
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
                            <?php echo validation_errors(); ?>
                            <form role="form" action="medicine/addNewCategory" class="clearfix" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('category'); ?> <?php echo lang('name'); ?> &ast; </label>
                                    <input type="text" class="form-control" name="category" value='<?php
                                                                                                    if (!empty($medicine->category)) {
                                                                                                        echo $medicine->category;
                                                                                                    }
                                                                                                    ?>' placeholder="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('description'); ?> &ast;</label>
                                    <input type="text" class="form-control" name="description" value='<?php
                                                                                                        if (!empty($medicine->description)) {
                                                                                                            echo $medicine->description;
                                                                                                        }
                                                                                                        ?>' placeholder="" required="">
                                </div>
                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($medicine->id)) {
                                                                            echo $medicine->id;
                                                                        }
                                                                        ?>'>
                                <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
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