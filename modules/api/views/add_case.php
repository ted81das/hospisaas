<!DOCTYPE html>
<html lang="en" <?php
                if (!$this->ion_auth->in_group(array('superadmin'))) {

                    $this->db->where('hospital_id', $this->hospital_id);
                    $settings_lang = $this->db->get('settings')->row()->language;
                    if ($this->language == 'arabic') {
                ?> dir="rtl" <?php } else { ?> dir="ltr" <?php
                                                        }
                                                    } else {
                                                        $this->db->where('hospital_id', 'superadmin');
                                                        $settings_lang = $this->db->get('settings')->row()->language;
                                                        if ($this->language == 'arabic') {
                                                            ?> dir="rtl" <?php } else { ?> dir="ltr" <?php
                                                                                                    }
                                                                                                }
                                                                                                        ?>>

<head>
    <base href="<?php echo base_url(); ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    $class_name = $this->router->fetch_class();
    $class_name_lang = lang($class_name);
    if (empty($class_name_lang)) {
        $class_name_lang = $class_name;
    }
    ?>

    <title> <?php echo $class_name_lang; ?> |
        <?php
        if ($this->ion_auth->in_group(array('superadmin'))) {
            $this->db->where('hospital_id', 'superadmin');
        } else {
            $this->db->where('hospital_id', $this->hospital_id);
        }
        ?>
        <?php
        $settings = $this->db->get('settings')->row();
        echo $settings->system_vendor;
        ?>
    </title>

    <!-- <link rel="stylesheet" href="common/css/bootstrap-select.min.css"> -->

    <!-- Google Fonts -->

    <!-- design the sidebar with more professional css  -->



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="adminlte/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="adminlte/plugins/summernote/summernote-bs4.min.css">


    <!-- <link rel="stylesheet" href="adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"> -->
    <link rel="stylesheet" href="adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


    <link rel="stylesheet" href="adminlte/dist/css/changes.css">

    <link rel="stylesheet" href="adminlte/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="adminlte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="adminlte/plugins/daterangepicker/daterangepicker.css">


    <link rel="stylesheet" href="adminlte/plugins/fullcalendar/main.css">
    <link rel="stylesheet" href="adminlte/plugins/flag-icon-css/css/flag-icon.min.css">

    <link rel="stylesheet" href="common/assets/bootstrap-datepicker/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
    <link rel="stylesheet" href="common/assets/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="common/assets/jquery-multi-select/css/multi-select.css" />
    <link rel="stylesheet" type="text/css" href="common/css/lightbox.css" />


    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="adminlte/plugins/toastr/toastr.min.css">

    <!-- dropzonejs -->
    <link rel="stylesheet" href="adminlte/plugins/dropzone/min/dropzone.min.css">



    <?php

    if ($this->language == 'arabic') { ?>
        <link rel="stylesheet" href="adminlte/dist/css/rtl.css">
    <?php } ?>

    <!-- <link rel="stylesheet" href="common/css/bootstrap-select-country.min.css"> -->



</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">




        <div class="">
            <div class="card">

                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row"> <!-- Added row class here -->
                        <form role="form" action="api/addCase" class="clearfix w-100" method="post" enctype="multipart/form-data">
                            <div class="row col-md-12">

                                <input type="hidden" name="patient_id" id="patient_id" value="<?php if ($case->patient_id) {
                                                                                                    echo $case->patient_id;
                                                                                                } elseif ($patient_id) {
                                                                                                    echo $patient_id;
                                                                                                } ?>">


                                <?php if (!empty($case->id)) { ?>
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?> <?php echo lang(''); ?> &ast;</label>
                                        <input type="text" class="form-control" name="" value="<?php echo $case->patient_name; ?>(ID: <?php echo $case->patient_id; ?>)" placeholder="" readonly>
                                    </div>
                                <?php } ?>
                                <div class="form-group col-md-12">
                                    <label for="exampleInputEmail1"><?php echo lang('case'); ?> <?php echo lang('title'); ?> &ast;</label>
                                    <input type="text" class="form-control" name="title" value="<?php echo $case->title; ?>" placeholder="" required="">
                                </div>
                                <div class="form-group col-md-12 no-print">
                                    <label><?php echo lang('case'); ?> &ast;</label>
                                    <textarea class="form-control ckeditor" name="description" id="editor1" rows="10"><?php echo $case->description ?? ''; ?></textarea>
                                </div>
                                <input type="hidden" name="redirect" value='patient/caseList'>
                                <input type="hidden" name="case_id" value='<?php if (!empty($case->id)) {
                                                                                echo $case->id;
                                                                            } ?>'>
                                <section class="col-md-12 no-print">
                                    <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                                </section>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>


    <script src="common/js/codearistos.min.js"></script>
    <script src="common/assets/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        var select_patient = "<?php echo lang('select_patient'); ?>";
    </script>
    <script type="text/javascript">
        var language = "<?php echo $this->language; ?>";
    </script>
    <script src="common/extranal/js/patient/case_list.js"></script>


    <script>
        tinymce.init({
            selector: '#editor1',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            branding: false,
            promotion: false
        });
    </script>


    <?php
    $language = $this->language;


    if ($language == 'english') {
        $lang = 'en-ca';
        $langdate = 'en-CA';
    } elseif ($language == 'spanish') {
        $lang = 'es';
        $langdate = 'es';
    } elseif ($language == 'french') {
        $lang = 'fr';
        $langdate = 'fr';
    } elseif ($language == 'portuguese') {
        $lang = 'pt';
        $langdate = 'pt';
    } elseif ($language == 'arabic') {
        $lang = 'ar';
        $langdate = 'ar';
    } elseif ($language == 'italian') {
        $lang = 'it';
        $langdate = 'it';
    } elseif ($language == 'zh_cn') {
        $lang = 'zh-cn';
        $langdate = 'zh-CN';
    } elseif ($language == 'japanese') {
        $lang = 'ja';
        $langdate = 'ja';
    } elseif ($language == 'russian') {
        $lang = 'ru';
        $langdate = 'ru';
    } elseif ($language == 'turkish') {
        $lang = 'tr';
        $langdate = 'tr';
    } elseif ($language == 'indonesian') {
        $lang = 'id';
        $langdate = 'id';
    }


    ?>

    <script type="text/javascript">
        var langdate = "<?php echo $langdate; ?>";
        $(document).ready(function() {
            $('.readonly').keydown(function(e) {
                e.preventDefault();
            });

        })
    </script>





    <!-- Load jQuery -->


    <!-- Load DataTables after jQuery -->



    <script src="common/js/respond.min.js"></script>
    <script type="text/javascript" src="common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="common/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>


    <script type="text/javascript" src="common/assets/ckeditor/build/ckeditor.js"></script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/decoupled-document/ckeditor.js"></script> 
<script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script>-->
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script> -->
    <script type="text/javascript" src="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

    <script type="text/javascript" src="common/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script src="common/js/advanced-form-components.js"></script>
    <script src="common/js/jquery.cookie.js"></script>
    <!--common script for all pages-->
    <!-- <script src="common/js/jquery.nicescroll.js" type="text/javascript"></script> -->
    <script src="common/js/common-scripts.js"></script>
    <script src="common/js/lightbox.js"></script>
    <script class="include" type="text/javascript" src="common/js/jquery.dcjqaccordion.2.7.js"></script>
    <!--script for this page only-->
    <script src="common/js/editable-table.js"></script>




    <!-- <script src="common/js/bootstrap-select.min.js"></script> -->
    <script src="common/js/bootstrap-select-country.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"></script>





    <script src="common/assets/bootstrap-datepicker/locales/bootstrap-datepicker.<?php echo $langdate; ?>.min.js"></script>
    <script src="common/assets/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.<?php echo $langdate; ?>.min.js"></script>









    <!-- jQuery -->
    <script src="adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="adminlte/dist/js/adminlte.min.js"></script>
    <!-- <script src="adminlte/dist/js/adminlte.js"></script> -->

    <script src="adminlte/plugins/moment/moment.min.js"></script>


    <script src="adminlte/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="adminlte/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <!-- <script src="adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
    <!-- jQuery Knob Chart -->
    <!-- <script src="adminlte/plugins/jquery-knob/jquery.knob.min.js"></script> -->
    <!-- daterangepicker -->
    <!-- Tempusdominus Bootstrap 4 -->
    <!-- <script src="adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
    <!-- Summernote -->
    <!-- <script src="adminlte/plugins/summernote/summernote-bs4.min.js"></script> -->
    <!-- overlayScrollbars -->
    <!-- <script src="adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
    <!-- AdminLTE App -->

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="adminlte/dist/js/pages/dashboard.js"></script>


    <!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->

    <script src="adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="adminlte/plugins/jszip/jszip.min.js"></script>
    <script src="adminlte/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="adminlte/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>



    <script src="adminlte/plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="adminlte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <!-- <script src="adminlte/plugins/daterangepicker/daterangepicker.js"></script> -->
    <!-- bootstrap color picker -->
    <script src="adminlte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

    <script type="text/javascript" src="common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="common/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script type="text/javascript" src="common/assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>

    <script type="text/javascript" src="common/assets/jquery-multi-select/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="common/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
    <script src="common/js/lightbox.js"></script>



    <script src="adminlte/plugins/fullcalendar/main.js"></script>
    <script src="adminlte/plugins/fullcalendar/locales/<?php echo $lang; ?>.js"></script>

    <!-- <script src="common/assets/fullcalendar/fullcalendar.js"></script>
<script src='common/assets/fullcalendar/locale/<?php echo $lang; ?>.js'></script> -->



    <!-- dropzonejs -->
    <script src="adminlte/plugins/dropzone/min/dropzone.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="adminlte/plugins/toastr/toastr.min.js"></script>


    <script>
        $(document).ready(function() {
            "use strict";

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: "en",
                themeSystem: 'bootstrap', // Enable Bootstrap theme
                events: "appointment/getAppointmentByJason",
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay"
                },
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: 'short'
                },
                eventContent: function(arg) {
                    var bgColor;
                    switch (arg.event.extendedProps.status) {
                        case 'Pending Confirmation':
                            bgColor = "linear-gradient(135deg, #5E35B1, #8E24AA)";
                            bgColor = '#6C5B7B';

                            bgColor = '#FFD54F'; // deeper shade of yellow blending into a lighter shade
                            // textColor = '#333333'; // using a darker text color for better readability on yellow


                            break;
                        case 'Confirmed':
                            bgColor = "linear-gradient(160deg, #6C5B7B, #C06C84)";
                            bgColor = "#5E35B1";
                            break;
                        case 'Cancelled':
                            bgColor = "linear-gradient(145deg, #83a4d4, #b6fbff)";
                            bgColor = "#8B0000";
                            break;
                        case 'Requested':
                            bgColor = "#36b9cc"; // I've kept one of the previous colors for 'Requested'. Adjust if needed.
                            break;
                        case 'Treated':
                            bgColor = "#858796"; // I've kept one of the previous colors for 'Treated'. Adjust if needed.
                            break;
                        default:
                            bgColor = "#4e73df"; // default color if no status matches. Adjust if needed.
                    }
                    return {
                        html: `<div style="background: ${bgColor}; padding: 10px; border-radius: 5px;">
                    <span style="color: white;">${arg.timeText}</span><br/>
                    <span style="color: white;">${arg.event.title}</span>
               </div>`
                    };
                },



                eventClick: function(info) {
                    $("#medical_history").html("");
                    if (info.event.id) {
                        $.ajax({
                            url: "patient/getMedicalHistoryByJason?id=" + info.event.id + "&from_where=calendar",
                            method: "GET",
                            dataType: "json",
                            success: function(response) {
                                "use strict";
                                $("#medical_history").html(response.view);
                            }
                        });
                    }

                    $("#cmodal").modal("show");
                },
                slotDuration: "00:05:00",
                businessHours: false,
                slotEventOverlap: false,
                editable: false,
                selectable: false,
                lazyFetching: true,
                initialView: "dayGridMonth", // default view
                timeZone: false
            });

            calendar.render();
        });
    </script>

    <script src="common/extranal/js/footer.js"></script>




    <!-- 
<script>
    $(document).ready(function() {
        var url = window.location;
        // Will only work if string in href matches with location
        $('.treeview-menu li a[href="' + url + '"]').parent().addClass('active');
        // Will also work for relative and absolute hrefs
        $('.treeview-menu li a').filter(function() {
            return this.href == url;
        }).parent().parent().parent().addClass('active');


    });
</script> -->

    <script>
        Dropzone.autoDiscover = false

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: "/target-url", // Set the url
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        })

        myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function() {
                myDropzone.enqueueFile(file)
            }
        })
    </script>


    <?php if ($this->session->flashdata('swal_message')) { ?>
        <script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });
                <?php
                if ($this->session->flashdata('swal_message')) { ?>
                    Toast.fire({
                        icon: '<?= $this->session->flashdata('swal_type') ?>',
                        title: '<?= $this->session->flashdata('swal_title') ?> ',
                        text: '<?= $this->session->flashdata('swal_message') ?> ',
                    });
                <?php } ?>
            });
        </script>
    <?php } ?>

    <?php
    $this->session->unset_userdata('swal_message');
    $this->session->unset_userdata('swal_type');
    $this->session->unset_userdata('swal_title');
    ?>




</body>

</html>