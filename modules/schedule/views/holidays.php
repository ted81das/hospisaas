<!--sidebar end-->
<!--main content start-->



<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-calendar-alt mr-2"></i><?php echo lang('holiday'); ?> (<?php echo $this->db->get_where('doctor', array('id' => $doctorr))->row()->name; ?>)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item"><a href="schedule/timeSchedule"><?php echo lang('schedule') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('holiday') ?></li>
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
                            <h3 class="card-title"><?php echo lang('List of all the holidays for'); ?> <?php echo $this->db->get_where('doctor', array('id' => $doctorr))->row()->name; ?></h3>
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
                                        <th> # </th>
                                        <th> <?php echo lang('date'); ?></th>
                                        <th> <?php echo lang('options'); ?></th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 0;
                                    foreach ($holidays as $holiday) {
                                        $i = $i + 1;
                                    ?>
                                        <tr class="">
                                            <td> <?php echo $i; ?></td>
                                            <td> <?php echo date('d-m-Y', $holiday->date); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm btn_width editbutton" data-toggle="modal" data-id="<?php echo $holiday->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>
                                                <a class="btn btn-danger btn-sm btn_width delete_button" href="schedule/deleteHoliday?id=<?php echo $holiday->id; ?>&doctor=<?php echo $doctorr; ?>&redirect=schedule/holidays?doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
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




<!-- Add Holiday Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add'); ?> <?php echo lang('holiday'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="schedule/addHoliday" class='clearfix' method="post" enctype="multipart/form-data">
                    <div class="">
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('date'); ?> &ast;</label>
                            <div class="input-group bootstrap-timepicker col-sm-9">
                                <input type="text" class="form-control default-date-picker" name="date" autocomplete="off" value='' required="">
                            </div>

                        </div>
                        <input type="hidden" name="doctor" value='<?php echo $doctorr; ?>'>
                        <input type="hidden" name="redirect" value='schedule/holidays?doctor=<?php echo $doctorr; ?>'>
                        <input type="hidden" name="id" value=''>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Holiday Modal-->





<!-- Edit Holiday Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit'); ?> <?php echo lang('holiday'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editHolidayForm" action="schedule/addHoliday" class='clearfix' method="post" enctype="multipart/form-data">
                    <div class="">
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('date'); ?> &ast;</label>
                            <div class="input-group bootstrap-timepicker col-sm-9">
                                <input type="text" class="form-control default-date-picker" name="date" autocomplete="off" value='' required="">
                            </div>

                        </div>
                        <input type="hidden" name="doctor" value='<?php echo $doctorr; ?>'>
                        <input type="hidden" name="redirect" value='schedule/holidays?doctor=<?php echo $doctorr; ?>'>
                        <input type="hidden" name="id" value=''>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Holiday Modal-->



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/schedule/holidays.js"></script>