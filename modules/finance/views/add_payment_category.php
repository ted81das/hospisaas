<!--sidebar end-->
<!--main content start-->




<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-money-bill-wave mr-2"></i><strong><?php
                                                                                                    if (!empty($category->id))
                                                                                                        echo lang('edit_invoice_items_lab_tests');
                                                                                                    else
                                                                                                        echo lang('create_invoice_items_lab_tests');
                                                                                                    ?></strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php
                                                            if (!empty($category->id))
                                                                echo lang('edit_invoice_items_lab_tests');
                                                            else
                                                                echo lang('create_invoice_items_lab_tests');
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
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('items_created_here_will_be_appeared_at_the_time_of_creating_invoice'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="finance/addPaymentCategory" class="clearfix" method="post" enctype="multipart/form-data">


                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-md-4"><?php echo lang('item_lab_test'); ?> <?php echo lang('name'); ?> &ast;</label>
                                    <input type="text" class="form-control col-md-8" id="category_name" name="category" value='<?php
                                                                                                                                if (!empty($setval)) {
                                                                                                                                    echo set_value('category');
                                                                                                                                }
                                                                                                                                if (!empty($category->category)) {
                                                                                                                                    echo $category->category;
                                                                                                                                }
                                                                                                                                ?>' placeholder="" required="">
                                </div>



                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-md-4"><?php echo lang('item'); ?> <?php echo lang('code'); ?> &ast;</label>
                                    <input type="text" class="form-control col-md-8" name="code" value='<?php
                                                                                                        if (!empty($setval)) {
                                                                                                            echo set_value('code');
                                                                                                        }
                                                                                                        if (!empty($category->code)) {
                                                                                                            echo $category->code;
                                                                                                        }
                                                                                                        ?>' placeholder="" required="">
                                </div>


                                <span id="notification" class="text-danger"></span>
                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-md-4"><?php echo lang('service_point'); ?> <span class="text-muted text-xs">(<?php echo lang('if_applicable'); ?>)</span></label>
                                    <input type="text" class="form-control col-md-8" name="description" value='<?php
                                                                                                                if (!empty($setval)) {
                                                                                                                    echo set_value('description');
                                                                                                                }
                                                                                                                if (!empty($category->description)) {
                                                                                                                    echo $category->description;
                                                                                                                }
                                                                                                                ?>' placeholder="">
                                </div>

                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-md-4"><?php echo lang('price'); ?> &ast;</label>
                                    <input type="text" class="form-control col-md-8" name="c_price" value='<?php
                                                                                                            if (!empty($setval)) {
                                                                                                                echo set_value('c_price');
                                                                                                            }
                                                                                                            if (!empty($category->c_price)) {
                                                                                                                echo $category->c_price;
                                                                                                            }
                                                                                                            ?>' placeholder="" required="">
                                </div>
                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-md-4"><?php echo lang('doctors_commission'); ?> <?php echo lang('rate'); ?> (%) <span class="text-muted text-xs">(<?php echo lang('if_applicable'); ?>)</span></label>
                                    <input type="text" class="form-control col-md-8" name="d_commission" value='<?php
                                                                                                                if (!empty($setval)) {
                                                                                                                    echo set_value('d_commission');
                                                                                                                }
                                                                                                                if (!empty($category->d_commission)) {
                                                                                                                    echo $category->d_commission;
                                                                                                                }
                                                                                                                ?>' placeholder="">
                                </div>

                                <div class="form-group d-flex">
                                    <label for="exampleInputEmail1" class="col-md-4"><?php echo lang('type'); ?> <span title="For lab tests that require reporting, choose 'Lab Test'. For all others, select 'Other'" style="cursor: pointer; text-decoration: underline;">
                                            <i class="fa fa-question-circle"></i>
                                        </span></label>


                                    <!-- Instruction Below the Label -->


                                    <select class="form-control col-md-8 m-bot15" name="type" value=''>
                                        <option value="diagnostic" <?php
                                                                    if (!empty($setval)) {
                                                                        if (set_value('type') == 'diagnostic') {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                    if (!empty($category->type)) {
                                                                        if ($category->type == 'diagnostic') {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                    ?>> <?php echo lang('lab_test'); ?> </option>
                                        <option value="others" <?php
                                                                if (!empty($setval)) {
                                                                    if (set_value('type') == 'others') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                if (!empty($category->type)) {
                                                                    if ($category->type == 'others') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>> <?php echo lang('others'); ?> </option>
                                    </select>

                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($category->id)) {
                                                                            echo $category->id;
                                                                        }
                                                                        ?>'>

                                <div class="form-group col-md-12">
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
<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/finance/payment_category.js"></script>