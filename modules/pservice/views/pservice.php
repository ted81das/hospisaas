<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-concierge-bell mr-2"></i><?php echo lang('pservice') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('pservice') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the Patient service names and pricing for the In-Patient Department (IPD)'); ?> </h3>
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
                            <table class="table table-bordered table-hover" id="editable-sample1">
                                <thead>
                                    <tr>
                                        <th> <?php echo lang('no'); ?></th>
                                        <th> <?php echo lang('service'); ?> <?php echo lang('code'); ?></th>
                                        <th> <?php echo lang('alpha_code'); ?> </th>
                                        <th> <?php echo lang('service'); ?> <?php echo lang('name'); ?></th>
                                        <th> <?php echo lang('price'); ?></th>

                                        <th> <?php echo lang('active'); ?></th>
                                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                            <th> <?php echo lang('options'); ?></th>
                                        <?php } ?>
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





<!-- Add Pservice Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_pservice'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="pservice/addNew" class="clearfix row" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-4"> <?php echo lang('service'); ?> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control col-sm-8" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                    if (!empty($pservice->name)) {
                                                                                                                        echo $pservice->name;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" required="">
                    </div>

                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-4"> <?php echo lang('service'); ?> <?php echo lang('code'); ?></label>
                        <input type="text" class="form-control col-sm-8" name="code" id="exampleInputEmail1" value='<?php
                                                                                                                    if (!empty($pservice->code)) {
                                                                                                                        echo $pservice->code;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-4"> <?php echo lang('alpha_code'); ?></label>
                        <input type="text" class="form-control col-sm-8" name="alpha_code" id="exampleInputEmail1" value='<?php
                                                                                                                            if (!empty($pservice->alpha_code)) {
                                                                                                                                echo $pservice->alpha_code;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">
                    </div>
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-4"> <?php echo lang('price'); ?></label>
                        <input type="text" class="form-control col-sm-8" min="0" name="price" id="exampleInputEmail1" value='<?php
                                                                                                                                if (!empty($pservice->price)) {
                                                                                                                                    echo $pservice->price;
                                                                                                                                }
                                                                                                                                ?>' placeholder="" required="">
                    </div>


                    <div class="form-group col-md-6 d-flex">

                        <input type="checkbox" class="" name="active" id="exampleInputEmail1" value='1' <?php
                                                                                                        if (!empty($pservice->id)) {
                                                                                                            if ($pservice->active == "1") {
                                                                                                                echo "checked";
                                                                                                            }
                                                                                                        }
                                                                                                        ?>>
                        <label for="exampleInputEmail1" class="col-sm-4"> <?php echo lang('active'); ?></label>
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Pservice Modal-->







<!-- Edit Pservice Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_pservice'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editPserviceForm" class="clearfix row" action="pservice/addNew" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-4"> <?php echo lang('service'); ?> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control col-sm-8" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                    if (!empty($pservice->name)) {
                                                                                                                        echo $pservice->name;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" required="">
                    </div>

                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-4"> <?php echo lang('service'); ?> <?php echo lang('code'); ?></label>
                        <input type="text" class="form-control col-sm-8" name="code" id="exampleInputEmail1" value='<?php
                                                                                                                    if (!empty($pservice->code)) {
                                                                                                                        echo $pservice->code;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-4"> <?php echo lang('alpha_code'); ?></label>
                        <input type="text" class="form-control col-sm-8" name="alpha_code" id="exampleInputEmail1" value='<?php
                                                                                                                            if (!empty($pservice->alpha_code)) {
                                                                                                                                echo $pservice->alpha_code;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">
                    </div>
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-4"> <?php echo lang('price'); ?></label>
                        <input type="text" class="form-control col-sm-8" min="0" name="price" id="exampleInputEmail1" value='<?php
                                                                                                                                if (!empty($pservice->price)) {
                                                                                                                                    echo $pservice->price;
                                                                                                                                }
                                                                                                                                ?>' placeholder="" required="">
                    </div>


                    <div class="form-group col-md-6 d-flex">

                        <input type="checkbox" class="" name="active" id="exampleInputEmail1" value='1' <?php
                                                                                                        if (!empty($pservice->id)) {
                                                                                                            if ($pservice->active == "1") {
                                                                                                                echo "checked";
                                                                                                            }
                                                                                                        }
                                                                                                        ?>>
                        <label for="exampleInputEmail1" class="col-sm-4"> <?php echo lang('active'); ?></label>
                    </div>



                    <input type="hidden" name="id" value='<?php
                                                            if (!empty($pservice->id)) {
                                                                echo $pservice->id;
                                                            }
                                                            ?>'>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
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

<script src="common/extranal/js/bed/patient_service.js"></script>