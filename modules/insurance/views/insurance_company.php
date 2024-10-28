<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-building mr-2"></i><?php echo lang('list_of_insurance_companys') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('list_of_insurance_companys') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the insurance companies names and related informations'); ?></h3>
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








<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_insurance_company'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="insurance/addNew" class="clearfix form-row" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('company') ?> <?php echo lang('name') ?> &#42;</label>
                        <input type="text" class="form-control col-sm-9" name="name" value='' required="">
                    </div>


                    <div class="form-group col-md-12 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('description'); ?> &ast; </label>
                        <textarea class="form-control col-sm-9 ckeditor" id="editor" name="description" value="" rows="50" cols="20"></textarea>
                        <!-- <input type="hidden" name="profile" id="profile" value=""> -->

                    </div>




                    <div class="form-group col-md-12 d-flex">
                        <button type="submit" name="submit" class="btn btn-info float-right row"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_insurance_company'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="insuranceEditForm" class="clearfix form-row" action="insurance/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('company') ?> <?php echo lang('name'); ?> &#42;</label>
                        <input type="text" class="form-control col-sm-9" name="name" value='' placeholder="" required="">
                    </div>


                    <div class="form-group col-md-12 d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('description'); ?></label>
                        <textarea class="form-control col-sm-9 ckeditor" id="editor1" name="description" value="" rows="10" cols="20"></textarea>
                        <!-- <input type="hidden" name="profile" id="profile1" value=""> -->
                    </div>




                    <input type="hidden" name="id" value=''>

                    <div class="form-group col-md-12 d-flex">
                        <button type="submit" name="submit" class="btn btn-info float-right row"><?php echo lang('submit'); ?></button>
                    </div>

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
<script src="common/extranal/js/insurance_company.js"></script>