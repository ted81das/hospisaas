<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-money-bill-wave mr-2"></i><strong><?php echo lang('payment_gateways') ?></strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('payment_gateways') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the Payment gateway names and related informations'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo lang('name'); ?></th>
                                        <th><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($pgateways as $pgateway) {
                                        $i = $i + 1;
                                    ?>
                                        <tr class="">
                                            <td><?php echo $i; ?></td>
                                            <td><?php
                                                if (!empty($pgateway->name)) {
                                                    echo $pgateway->name;
                                                }
                                                ?></td>

                                            <td>
                                                <a class="btn btn-info btn-sm" href="pgateway/settings?id=<?php echo $pgateway->id; ?>"> <?php echo lang('manage'); ?></a>
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <?php echo lang('select'); ?> <?php echo lang('payment_gateway'); ?>
                        </div>
                        <div class="card-body">
                            <form role="form" id="editAppointmentForm" action="settings/selectPaymentGateway" class="clearfix" method="post" enctype="multipart/form-data">
                                <?php foreach ($pgateways as $pgateway) { ?>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" readonly="" name="payment_gateway" id="customRadio<?php echo $pgateway->id; ?>" value='<?php echo $pgateway->name; ?>' <?php
                                                                                                                                                                                                                    if (!empty($pgateway->name)) {
                                                                                                                                                                                                                        if ($settings->payment_gateway == $pgateway->name) {
                                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    ?>>
                                            <label class="custom-control-label" for="customRadio<?php echo $pgateway->id; ?>"><?php echo $pgateway->name; ?></label>
                                        </div>
                                    </div>
                                <?php } ?>
                                <input type="hidden" name="id" value="<?php echo $settings->id; ?>">
                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>







<script src="common/js/codearistos.min.js"></script>

<script src="common/extranal/js/pgateway.js"></script>