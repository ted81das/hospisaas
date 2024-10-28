<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-money-bill-wave mr-2"></i>
                        <?php echo lang('invoices') ?>
                    </h1>
                </div>
                <div class="col-sm-6 d-flex gap-3 justify-content-end">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('invoices') ?></li>
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
                            <h3 class="card-title"><?php echo lang('list_of_invoices_from_opd_ipd_and_appointments'); ?></h3>
                            <div class="float-right">
                                <a href="finance/addPaymentView" class="btn btn-primary btn-sm px-4 py-3">
                                    <i class="fa fa-plus"></i> <?php echo lang('add_new'); ?> <?php echo lang('invoice'); ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 date_field ml-2 mt-4">
                            <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                <input type="text" class="form-control default-date-picker" name="date_from" id="date_from" value="" placeholder="<?php echo lang('date_from'); ?>" readonly="">
                                <span class="input-group-addon" style="margin:5px;"></span>
                                <input type="text" class="form-control default-date-picker" name="date_to" id="date_to" value="" placeholder="<?php echo lang('date_to'); ?>" readonly="">
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample3">
                                <thead class="text-xs">
                                    <tr>
                                        <th><?php echo lang(''); ?> #</th>
                                        <th><?php echo lang('patient'); ?></th>
                                        <th><?php echo lang('doctor'); ?></th>
                                        <th><?php echo lang('date'); ?></th>
                                        <th><?php echo lang('sub_total'); ?></t>
                                        <th><?php echo lang('vat'); ?></th>
                                        <th><?php echo lang('discount'); ?></th>
                                        <th><?php echo lang('grand_total'); ?></th>
                                        <th><?php echo lang('paid'); ?> <?php echo lang('amount'); ?></th>
                                        <th><?php echo lang('due'); ?></th>
                                        <th><?php echo lang('remarks'); ?></th>
                                        <th><?php echo lang('from'); ?></th>
                                        <th class="no-print"><?php echo lang('options'); ?></th>
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














<div class="modal fade" id="editPaymentModal" role="dialog" aria-labelledby="editPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="editPaymentModalLabel">Edit Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- The edit payment form will be loaded here via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>





<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<!-- <script defer type="text/javascript" src="common/assets/DataTables/datatables.min.js"></script> -->
<script src="common/extranal/js/finance/payments.js"></script>
<script>
    $(document).ready(function() {

        $('#date_from').on('change', function() {
            var date_from = $(this).val();
            var date_to = $('#date_to').val();
            var date_from_split = date_from.split('-');
            var date_from_new = date_from_split[1] + '/' + date_from_split[0] + '/' + date_from_split[2]
            if (date_to != '' || date_to != null) {
                var date_to_split = date_to.split('-');
                var date_to_new = date_to_split[1] + '/' + date_to_split[0] + '/' + date_to_split[2];
            }
            if (date_to != '' || date_to != null) {
                if (Date.parse(date_to_new) <= Date.parse(date_from_new)) {

                    alert('Select a Valid Date. End Date should be Greater than Start Date');
                    $(this).val("");
                } else {
                    $('#editable-sample3').DataTable().destroy().clear();
                    "use strict";
                    var table = $('#editable-sample3').DataTable({
                        responsive: true,
                        //   dom: 'lfrBtip',

                        "processing": true,
                        "serverSide": true,
                        "searchable": true,
                        "ajax": {
                            url: "finance/getPayment?start_date=" + date_from + "&end_date=" + date_to,
                            type: 'POST',
                        },
                        scroller: {
                            loadingIndicator: true
                        },
                        dom: "<'row mb-1'<'col-md-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

                        buttons: [{
                                extend: 'copyHtml5',
                                className: 'btn-primary',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                            {
                                extend: 'csvHtml5',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                        ],
                        aLengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                        ],
                        iDisplayLength: 100,

                        "order": [
                            [0, "desc"]
                        ],

                        "language": {
                            "lengthMenu": "_MENU_",
                            search: "_INPUT_",
                            "url": "common/assets/DataTables/languages/" + language + ".json"
                        }
                    });
                    table.buttons().container().appendTo('.custom_buttons');
                }
            }
        })
        $('#date_to').on('change', function() {
            var date_to = $(this).val();
            var date_from = $('#date_from').val();

            var date_to_split = date_to.split('-');
            var date_to_new = date_to_split[1] + '/' + date_to_split[0] + '/' + date_to_split[2];
            if (date_from != '' || date_from != null) {
                var date_from_split = date_from.split('-');
                var date_from_new = date_from_split[1] + '/' + date_from_split[0] + '/' + date_from_split[2];

            }
            if (date_from != '' || date_from != null) {
                if (Date.parse(date_to_new) <= Date.parse(date_from_new)) {

                    alert('Select a Valid Date. End Date should be Greater than Start Date');
                    $(this).val("");
                } else {
                    $('#editable-sample3').DataTable().destroy().clear();
                    "use strict";
                    var table = $('#editable-sample3').DataTable({
                        responsive: true,
                        //   dom: 'lfrBtip',

                        "processing": true,
                        "serverSide": true,
                        "searchable": true,
                        "ajax": {
                            url: "finance/getPayment?start_date=" + date_from + "&end_date=" + date_to,
                            type: 'POST',
                        },
                        scroller: {
                            loadingIndicator: true
                        },
                        dom: "<'row mb-1'<'col-md-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

                        buttons: [{
                                extend: 'copyHtml5',
                                className: 'btn-primary btn-sm',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                            {
                                extend: 'csvHtml5',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                        ],
                        aLengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                        ],
                        iDisplayLength: 100,

                        "order": [
                            [0, "desc"]
                        ],

                        "language": {
                            "lengthMenu": "_MENU_",
                            search: "_INPUT_",
                            "url": "common/assets/DataTables/languages/" + language + ".json"
                        }
                    });
                    table.buttons().container().appendTo('.custom_buttons');
                }
            }
        })
    })
</script>