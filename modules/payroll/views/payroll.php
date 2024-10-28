<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-money-check-alt mr-2"></i><?php echo lang('payroll') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('payroll') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the payroll informations'); ?></h3>
                        </div>
                        <div class="col-md-12">
                            <div class="row employee_div" style="margin: 5px;">
                                <div class="col-md-6">
                                    <label><?php echo lang('month'); ?></label>
                                    <select class="form-control js-example-basic-single" id="payroll_month">
                                        <?php
                                        foreach ($months as $month) {
                                            if ($month == date('F')) {
                                        ?>
                                                <option value="<?php echo $month; ?>" selected><?php echo $month; ?></option>
                                            <?php
                                                break;
                                            } else {
                                            ?>
                                                <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label><?php echo lang('year'); ?></label>
                                    <select class="form-control js-example-basic-single" id="payroll_year">
                                        <?php foreach ($years as $year) {
                                        ?>
                                            <option value="<?php echo $year; ?>" <?php if ($year == date('Y')) { ?>selected<?php } ?>><?php echo $year; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-success generatePayroll" style="margin:12px;"><i class="fas fa-paper-plane"></i> <?php echo lang('generate'); ?></button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="salary-sample">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('staff'); ?></th>
                                        <th><?php echo lang('salary'); ?></th>
                                        <th><?php echo lang('paid_on'); ?></th>
                                        <th><?php echo lang('status'); ?></th>
                                        <th class="no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php if (!empty($employees)) {
                                        for ($i = 0; $i < count($employees); $i++) {
                                    ?>
                                            <tr>
                                                <td><?php echo $employees[$i][0]; ?></td>
                                                <td><?php echo $employees[$i][1]; ?></td>
                                                <td><?php echo $employees[$i][2]; ?></td>
                                                <td><?php echo $employees[$i][3]; ?></td>
                                                <td><?php echo $employees[$i][4]; ?></td>
                                            </tr>
                                    <?php }
                                    }
                                    ?>
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
























<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/payroll/payroll.js"></script>