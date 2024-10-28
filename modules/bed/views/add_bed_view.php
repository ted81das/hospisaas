<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-bed mr-2"></i>
                        <?php
                        if (!empty($bed->id))
                            echo lang('edit_bed');
                        else
                            echo lang('add_bed');
                        ?>
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
                <div class="col-8">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="bed/addBed" class="clearfix" method="post" enctype="multipart/form-data">
                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('bed_category'); ?> &#42;</label>
                                    <select class="form-control col-sm-9 m-bot15" name="category" value='' required="">
                                        <?php foreach ($categories as $category) { ?>
                                            <option value="<?php echo $category->category; ?>" <?php
                                                                                                if (!empty($setval)) {
                                                                                                    if ($category->category == set_value('category')) {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                }
                                                                                                if (!empty($bed->category)) {
                                                                                                    if ($category->category == $bed->category) {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                }
                                                                                                ?>> <?php echo $category->category; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('bed_number'); ?> &#42;</label>
                                    <input type="text" class="form-control col-sm-9" name="number" id="exampleInputEmail1" value='<?php
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('number');
                                                                                                                                    }
                                                                                                                                    if (!empty($bed->number)) {
                                                                                                                                        echo $bed->number;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="" required="">
                                </div>
                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('description'); ?> &#42;</label>
                                    <input type="text" class="form-control col-sm-9" name="description" id="exampleInputEmail1" value='<?php
                                                                                                                                        if (!empty($setval)) {
                                                                                                                                            echo set_value('description');
                                                                                                                                        }
                                                                                                                                        if (!empty($bed->description)) {
                                                                                                                                            echo $bed->description;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="" required="">
                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($bed->id)) {
                                                                            echo $bed->id;
                                                                        }
                                                                        ?>'>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
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