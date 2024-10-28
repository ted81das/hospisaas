<!--sidebar end-->
<!--main content start-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<link href="common/extranal/css/finance/daily.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-money-bill-wave mr-2"></i><?php echo lang('hospital') . ' ' . lang('expense_vs_income'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php echo lang('hospital') . ' ' . lang('expense_vs_income'); ?></li>
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
                            <h3 class="card-title"></h3>
                            <div class="float-right">
                                <a class="no-print float-right" onclick="javascript:window.print();">
                                    <button id="" class="btn btn-secondary btn-sm">
                                        <i class="fa fa-print"></i> <?php echo lang('print'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="space15"></div>


                                <section class="col-md-6">
                                    <table class="table table-bordered table-hover" id="editable-sample1">
                                        <thead>
                                            <tr>
                                                <th colspan="2"><?php echo lang('this_week'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> <?php echo lang('income'); ?> </td>
                                                <td> <?php echo $this->currency; ?><?php echo number_format($this_week_total_income, 2, '.', ','); ?> </td>
                                            </tr>
                                            <tr>
                                                <td> <?php echo lang('expense'); ?> </td>
                                                <td><?php echo $this->currency; ?><?php echo number_format($this_week_total_expense, 2, '.', ','); ?></td>
                                            </tr>
                                            <tr class="total_amount">
                                                <td><?php echo lang('net_profit'); ?></td>
                                                <td><?php echo $this->currency; ?><?php echo number_format(($this_week_total_income - $this_week_total_expense), 2, '.', ','); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </section>

                                <section class="col-md-6">
                                    <table class="table table-bordered table-hover" id="editable-sample1">
                                        <thead>
                                            <tr>
                                                <th colspan="2"><?php echo lang('this_month'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> <?php echo lang('income'); ?> </td>
                                                <td> <?php echo $this->currency; ?><?php echo number_format($this_month_total_income, 2, '.', ','); ?> </td>
                                            </tr>
                                            <tr>
                                                <td> <?php echo lang('expense'); ?> </td>
                                                <td><?php echo $this->currency; ?><?php echo number_format($this_month_total_expense, 2, '.', ','); ?></td>
                                            </tr>
                                            <tr class="total_amount">
                                                <td><?php echo lang('net_profit'); ?></td>
                                                <td><?php echo $this->currency; ?><?php echo number_format(($this_month_total_income - $this_month_total_expense), 2, '.', ','); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </section>

                                <section class="col-md-6">
                                    <table class="table table-bordered table-hover" id="editable-sample1">
                                        <thead>
                                            <tr>
                                                <th colspan="2"><?php echo lang('last_30_days'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> <?php echo lang('income'); ?> </td>
                                                <td> <?php echo $this->currency; ?><?php echo number_format($this_last_30_total_income, 2, '.', ','); ?> </td>
                                            </tr>
                                            <tr>
                                                <td> <?php echo lang('expense'); ?> </td>
                                                <td><?php echo $this->currency; ?><?php echo number_format($this_last_30_total_expense, 2, '.', ','); ?></td>
                                            </tr>
                                            <tr class="total_amount">
                                                <td><?php echo lang('net_profit'); ?></td>
                                                <td><?php echo $this->currency; ?><?php echo number_format(($this_last_30_total_income - $this_last_30_total_expense), 2, '.', ','); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </section>
                                <section class="col-md-6">
                                    <table class="table table-bordered table-hover" id="editable-sample1">
                                        <thead>
                                            <tr>
                                                <th colspan="2"><?php echo lang('total'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> <?php echo lang('income'); ?> </td>
                                                <td> <?php echo $this->currency; ?><?php echo number_format($total_income, 2, '.', ','); ?> </td>
                                            </tr>
                                            <tr>
                                                <td> <?php echo lang('expense'); ?> </td>
                                                <td><?php echo $this->currency; ?><?php echo number_format($total_expense, 2, '.', ','); ?></td>
                                            </tr>
                                            <tr class="total_amount">
                                                <td><?php echo lang('net_profit'); ?></td>
                                                <td><?php echo $this->currency; ?><?php echo number_format(($total_income - $total_expense), 2, '.', ','); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </section>


                            </div>
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

<style>
    .panel-heading {
        margin-bottom: 20px;
    }
</style>

<!-- js placed at the end of the document so the pages load faster -->

<script src="common/js/codearistos.min.js"></script>