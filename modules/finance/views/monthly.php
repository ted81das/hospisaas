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
                    <h1 class="font-weight-bold"><i class="fas fa-chart-line mr-2"></i><?php echo date('Y', $first_minute) . ' ' . lang('hospital') . ' ' . lang('sales_report'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php echo date('Y', $first_minute) . ' ' . lang('hospital') . ' ' . lang('sales_report'); ?></li>
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
                            <h3 class="card-title"> <?php echo date('Y', $first_minute) . ' ' . lang('hospital') . ' ' . lang('sales_report'); ?></h3>
                            <?php
                            $currently_processing_year = date('Y', $first_minute);
                            $next_year = $currently_processing_year + 1;
                            $previous_year = $currently_processing_year - 1;
                            ?>


                            <div class="float-right no-print mr-1">
                                <a class="btn btn-sm btn-secondary no-print float-right" title="<?php echo lang('print'); ?>" onclick="javascript:window.print();"> <i class="fa fa-print"></i> </a>
                            </div>


                            <div class="float-right no-print mr-1">
                                <a href="finance/monthly?year=<?php echo $next_year; ?>">
                                    <button id="" title="<?php echo lang('next'); ?>" class="btn btn-success btn-sm">
                                        <i class="fa fa-arrow-right"></i> <?php echo lang('next_year'); ?>
                                    </button>
                                </a>
                            </div>

                            <div class="float-right no-print mr-1">
                                <a href="finance/monthly?year=<?php echo $previous_year; ?>">
                                    <button id="" title="<?php echo lang('previous'); ?>" class="btn btn-warning btn-sm">
                                        <i class="fa fa-arrow-left"></i> <?php echo lang('previous_year'); ?>
                                    </button>
                                </a>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample1">
                                <thead>
                                    <tr>
                                        <th> <?php echo lang('date'); ?> </th>
                                        <th> <?php echo lang('amount'); ?> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        $time = mktime(12, 0, 0, $month, 1, $year);
                                        if (!empty($all_payments[date('m-Y', $time)])) {
                                            if (date('Y', $time) == $year) {
                                                $month_name = date('F', $time);
                                                $amount = $all_payments[date('m-Y', $time)];
                                            }
                                        } else {
                                            if (date('Y', $time) == $year) {
                                                $month_name = date('F', $time);
                                                $amount = 0;
                                            }
                                        }
                                    ?>

                                        <tr>
                                            <td><?php echo lang($month_name); ?></td>
                                            <td><?php echo $this->currency; ?><?php echo number_format($amount, 2, '.', ','); ?></td>
                                            <?php $total_amount[] = $amount; ?>
                                        </tr>

                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if (!empty($total_amount)) {
                                        $total_amount = array_sum($total_amount);
                                    } else {
                                        $total_amount = 0;
                                    }
                                    ?>

                                    <tr class="total_amount">
                                        <td><?php echo lang('total'); ?></td>
                                        <td><?php echo $this->currency; ?><?php echo number_format($total_amount, 2, '.', ','); ?></td>
                                    </tr>

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
<!--footer end-->

</section>

<!-- js placed at the end of the document so the pages load faster -->

<script src="common/js/codearistos.min.js"></script>




</body>

</html>