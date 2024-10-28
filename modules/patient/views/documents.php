<!--sidebar end-->
<!--main content start-->






<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-file-alt mr-2"></i><strong><?php echo lang('documents') ?></strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item"><a href="patient"><?php echo lang('patient') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('documents') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the documents'); ?></h3>
                            <div class="float-right">
                                <a data-toggle="modal" href="#myModal1">
                                    <button id="" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-striped" id="editable-sample">
                                <thead class="">
                                    <tr>
                                        <th scope="col"><?php echo lang('date'); ?></th>
                                        <th scope="col"><?php echo lang('patient'); ?></th>
                                        <th scope="col"><?php echo lang('description'); ?></th>
                                        <th scope="col" class="document_table"><?php echo lang('document'); ?></th>
                                        <th scope="col" class="no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Table data will go here -->
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




















<div class="modal fade" id="myModal1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add'); ?> <?php echo lang('files'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientMaterial" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('patient'); ?> &ast; </label>
                        <select class="form-control col-sm-9 m-bot15" id="patientchoose" name="patient" value='' required="">

                        </select>
                    </div>
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('title'); ?> &ast;</label>
                        <input type="text" class="form-control col-sm-9" name="title" placeholder="" required="">
                    </div>
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('file'); ?> &ast;</label>
                        <input type="file" class="form-control col-sm-9" name="img_url" required="">
                    </div>
                    <span class="help-block"><?php echo lang('recommended_size'); ?> : 3000 x 2024</span>
                    <input type="hidden" name="redirect" value='patient/documents'>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/patient/documents.js"></script>