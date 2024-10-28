<!--sidebar end-->
<!--main content start-->


<link href="common/extranal/css/notice/add_new.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-clipboard-list mr-2"></i>
                        <?php
                        if (!empty($notice->id))
                            echo lang('edit_notice');
                        else
                            echo lang('add_notice');
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
                <div class="col-md-7 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add notice for patients / staffs</h3>
                        </div>
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
                            <form role="form" action="notice/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                                <div class="">
                                    <div class="form-group d-flex">
                                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('title'); ?> &ast;</label>
                                        <input type="text" class="form-control col-sm-9" name="title" value='<?php
                                                                                                                if (!empty($notice->name)) {
                                                                                                                    echo $notice->name;
                                                                                                                }
                                                                                                                ?>' placeholder="" required="">
                                    </div>


                                    <div class="form-group d-flex">
                                        <label for="exampleInputEmail1" class="col-sm-3">Notice For</label>
                                        <select class="form-control m-bot15 col-sm-9" name="type" value=''>
                                            <option value="patient" <?php
                                                                    if (!empty($notice->type)) {
                                                                        if ($notice->type == 'patient') {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                    ?>><?php echo lang('patient'); ?></option>
                                            <option value="staff" <?php
                                                                    if (!empty($notice->type)) {
                                                                        if ($notice->type == 'staff') {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                    ?>><?php echo lang('staff'); ?></option>

                                        </select>
                                    </div>


                                    <div class="form-group d-flex des">
                                        <label class="control-label col-sm-3"><?php echo lang('description'); ?> &ast;</label>
                                        <div class="col-sm-9 des">
                                            <textarea class="ckeditor form-control editor" id="editor" name="description" value="" rows="5" required=""> </textarea>
                                        </div>
                                    </div>



                                    <div class="form-group d-flex">
                                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('date'); ?> &ast;</label>
                                        <input type="text" class="form-control default-date-picker col-sm-9" name="date" onkeypress="return false;" value='' placeholder="" required="">
                                    </div>




                                    <input type="hidden" name="id" value='<?php
                                                                            if (!empty($notice->id)) {
                                                                                echo $notice->id;
                                                                            }
                                                                            ?>'>


                                    <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
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



<section id="main-content">
    <section class="wrapper site-min-height">
        <link href="common/extranal/css/notice/add_new.css" rel="stylesheet">
        <section class="col-md-6">
            <header class="panel-heading">
                <?php
                if (!empty($notice->id))
                    echo lang('edit_notice');
                else
                    echo lang('add_notice');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <?php echo validation_errors(); ?>
                                <?php echo $this->session->flashdata('feedback'); ?>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                        <form role="form" action="notice/addNew" class="clearfix" method="post" enctype="multipart/form-data">

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &ast;</label>
                                <input type="text" class="form-control" name="title" value='<?php
                                                                                            if (!empty($notice->name)) {
                                                                                                echo $notice->name;
                                                                                            }
                                                                                            ?>' placeholder="" required="">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Notice For</label>
                                <select class="form-control m-bot15" name="type" value=''>
                                    <option value="patient" <?php
                                                            if (!empty($notice->type)) {
                                                                if ($notice->type == 'patient') {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>><?php echo lang('patient'); ?></option>
                                    <option value="staff" <?php
                                                            if (!empty($notice->type)) {
                                                                if ($notice->type == 'staff') {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>><?php echo lang('staff'); ?></option>

                                </select>
                            </div>


                            <div class="form-group col-md-12 des">
                                <label class="control-label col-md-3"><?php echo lang('description'); ?> &ast;</label>
                                <div class="col-md-12 des">
                                    <textarea class="ckeditor form-control editor" id="editor" name="description" value="" rows="10" required=""> </textarea>
                                </div>
                            </div>



                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"> <?php echo lang('date'); ?> &ast;</label>
                                <input type="text" class="form-control default-date-picker" name="date" onkeypress="return false;" value='' placeholder="" required="">
                            </div>




                            <input type="hidden" name="id" value='<?php
                                                                    if (!empty($notice->id)) {
                                                                        echo $notice->id;
                                                                    }
                                                                    ?>'>


                            <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                        </form>

                    </div>
                </div>

            </div>
        </section>
    </section>
    <!-- page end-->
</section>
<script src="common/js/codearistos.min.js"></script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/notice.js"></script>