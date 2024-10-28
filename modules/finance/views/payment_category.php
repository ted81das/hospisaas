  <link href="common/extranal/css/finance/payment_category.css" rel="stylesheet">




  <div class="content-wrapper bg-light">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row my-2 pl-1">
                  <div class="col-sm-6">
                      <h1 class="font-weight-bold"><i class="fas fa-procedures mr-2"></i><?php echo lang('invoice_items_lab_tests') ?></h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                          <li class="breadcrumb-item active"><?php echo lang('payment_procedures') ?></li>
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
                              <h3 class="card-title"><?php echo lang('All the invoice items / lab tests name and related informations'); ?></h3>
                              <div class="float-right">
                                  <a href="finance/addPaymentCategoryView">
                                      <button id="" class="btn btn-success btn-sm">
                                          <i class="fa fa-plus-circle"></i> <?php echo lang('create_invoice_items_lab_tests'); ?>
                                      </button>
                                  </a>
                              </div>
                          </div>
                          <!-- /.card-header -->

                          <div class="row">
                              <div class="col-md-4 pl-4 pt-4">
                                  <select class="form-control category js-example-basic-single">
                                      <option value="all"><?php echo lang('select'); ?> <?php echo lang('category'); ?></option>
                                      <option value="all"><?php echo lang('all'); ?></option>
                                      <?php foreach ($paycategories as $paycategory) { ?>
                                          <option value="<?php echo $paycategory->id; ?>">
                                              <?php echo $paycategory->category; ?>
                                          </option>
                                      <?php } ?>
                                  </select>
                              </div>
                          </div>
                          <div class="card-body">


                              <table class="table table-bordered table-hover" id="editable-sample">
                                  <thead>
                                      <tr>
                                          <th><?php echo lang('name'); ?></th>
                                          <th><?php echo lang('code'); ?></th>
                                          <th><?php echo lang('service_point'); ?></th>
                                          <!-- <th><?php echo lang('category'); ?> -->
                                          <th><?php echo lang(''); ?> <?php echo lang('price'); ?> ( <?php echo $settings->currency; ?> )</th>
                                          <th><?php echo lang('doctors_commission'); ?></th>
                                          <th><?php echo lang('type'); ?></th>
                                          <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                              <th class="no-print"><?php echo lang('options'); ?></th>
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
















  <!--main content end-->
  <!--footer start-->
  <!-- Add Patient Modal-->
  <style>
      .ck-editor__editable:not(.ck-editor__nested-editable) {
          min-height: 400px !important;
      }
  </style>
  <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title font-weight-bold"> <?php echo lang('add_template'); ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body row">
                  <form role="form" id="addTemplate" action="finance/addPaymentProccedureTemplate" class="clearfix" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                          <label class="control-label"><?php echo lang('template'); ?></label>
                          <textarea class="form-control ckeditor" id="editor1" name="report" value="" rows="50" cols="20"></textarea>
                      </div>

                      <input type="hidden" name="id">

                      <section class="col-md-12">
                          <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                      </section>
                  </form>

              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div>
  <!-- Add Patient Modal-->

  <script src="common/js/codearistos.min.js"></script>
  <script type="text/javascript">
      var language = "<?php echo $this->language; ?>";
  </script>
  <script src="common/extranal/js/finance/payment_category.js"></script>