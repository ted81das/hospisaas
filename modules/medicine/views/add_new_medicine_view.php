<!--sidebar end-->
<!--main content start-->

<!-- <link href="common/extranal/css/medicine/add_new_medicine_view.css" rel="stylesheet"> -->

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-pills mr-2"></i><?php
                                                                                    if (!empty($medicine->id))
                                                                                        echo lang('edit_medicine');
                                                                                    else
                                                                                        echo lang('add_medicine');
                                                                                    ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php
                                                            if (!empty($medicine->id))
                                                                echo lang('edit_medicine');
                                                            else
                                                                echo lang('add_medicine');
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
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add medicine form</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <?php echo validation_errors(); ?>
                                <form role="form" action="medicine/addNewMedicine" class="clearfix" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-md-6 d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-6"> <?php echo lang('name'); ?> &ast;</label>
                                            <input type="text" class="form-control col-sm-6" name="name" value='<?php
                                                                                                                if (!empty($medicine->name)) {
                                                                                                                    echo $medicine->name;
                                                                                                                }
                                                                                                                ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group col-md-6 d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-6"> <?php echo lang('category'); ?> &ast;</label>
                                            <select class="form-control col-sm-6 m-bot15" name="category" value='' required="">
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?php echo $category->category; ?>" <?php
                                                                                                        if (!empty($medicine->category)) {
                                                                                                            if ($category->category == $medicine->category) {
                                                                                                                echo 'selected';
                                                                                                            }
                                                                                                        }
                                                                                                        ?>> <?php echo $category->category; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-6"> <?php echo lang('p_price'); ?> &ast;</label>
                                            <input type="number" step="0.01" class="form-control col-sm-6" name="price" value='<?php
                                                                                                                                if (!empty($medicine->price)) {
                                                                                                                                    echo $medicine->price;
                                                                                                                                }
                                                                                                                                ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group col-md-6 d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-6"> <?php echo lang('s_price'); ?> &ast;</label>
                                            <input type="number" step="0.01" class="form-control col-sm-6" name="s_price" value='<?php
                                                                                                                                    if (!empty($medicine->s_price)) {
                                                                                                                                        echo $medicine->s_price;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group col-md-6 d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-6"> <?php echo lang('store_box'); ?></label>
                                            <input type="text" class="form-control col-sm-6" name="box" value='<?php
                                                                                                                if (!empty($medicine->box)) {
                                                                                                                    echo $medicine->box;
                                                                                                                }
                                                                                                                ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-6 d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-6"> <?php echo lang('quantity'); ?> &ast;</label>
                                            <input type="number" step="0.01" class="form-control col-sm-6" name="quantity" value='<?php
                                                                                                                                    if (!empty($medicine->quantity)) {
                                                                                                                                        echo $medicine->quantity;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group col-md-6 d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-6"> <?php echo lang('generic_name'); ?> &ast;</label>
                                            <input type="text" class="form-control col-sm-6" name="generic" value='<?php
                                                                                                                    if (!empty($medicine->generic)) {
                                                                                                                        echo $medicine->generic;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" required="">
                                        </div>
                                        <div class="form-group col-md-6 d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-6"> <?php echo lang('company'); ?></label>
                                            <input type="text" class="form-control col-sm-6" name="company" value='<?php
                                                                                                                    if (!empty($medicine->company)) {
                                                                                                                        echo $medicine->company;
                                                                                                                    }
                                                                                                                    ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-6 d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-6"> <?php echo lang('effects'); ?></label>
                                            <input type="text" class="form-control col-sm-6" name="effects" value='<?php
                                                                                                                    if (!empty($medicine->effects)) {
                                                                                                                        echo $medicine->effects;
                                                                                                                    }
                                                                                                                    ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-6 d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-6"> <?php echo lang('expiry_date'); ?> &ast;</label>
                                            <input type="text" class="form-control col-sm-6 default-date-picker readonly" name="e_date" value='<?php
                                                                                                                                                if (!empty($medicine->e_date)) {
                                                                                                                                                    echo $medicine->e_date;
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="" required="">
                                        </div>

                                        <input type="hidden" name="id" value='<?php
                                                                                if (!empty($medicine->id)) {
                                                                                    echo $medicine->id;
                                                                                }
                                                                                ?>'>
                                        <div class="form-group col-md-12">
                                            <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                                        </div>
                                    </div>
                                </form>
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