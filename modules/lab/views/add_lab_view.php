<style>
    .d-none {
        display: none;
    }

    .d-flex {
        display: flex;
    }

    .align-center {
        align-items: center
    }

    .d-flex label {
        width: 200px;
    }
</style>
<!--main content start-->
<link href="common/extranal/css/description.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-flask mr-2"></i><?php
                                                                                    if (!empty($lab->id))
                                                                                        echo lang('edit_lab_report');
                                                                                    else
                                                                                        echo lang('add_lab_report');
                                                                                    ?> (<?php echo lang('test') ?> <?php echo lang('name') ?>: <?php
                                                                                                                                                if (!empty($lab->id)) {
                                                                                                                                                    $test_name = $this->db->get_where('payment_category', array('id' => $lab->category_id))->row();
                                                                                                                                                    if (isset($test_name->category)) {
                                                                                                                                                        echo $test_name->category;
                                                                                                                                                    }
                                                                                                                                                }
                                                                                                                                                ?>)
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php
                                                            if (!empty($lab->id))
                                                                echo lang('edit_lab_report');
                                                            else
                                                                echo lang('add_lab_report');
                                                            ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <ul>
        <li class="description">If you click "Save and ready to deliver", it will appear on the delivery report section.
            <span class="close">&times;</span>
        </li>
    </ul>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form role="form" class="labForm" id="editLabForm" class="clearfix" action="lab/addLab" method="post" enctype="multipart/form-data" style="background: none">
                                <section class="col-md-12 no-print">
                                    <div class="no-print">
                                        <div class="adv-table editable-table ">
                                            <div class="clearfix">
                                                <div class="row">
                                                    <div class="col-md-6 lab pad_bot">
                                                        <div class="form-group d-flex align-center">
                                                            <label for="exampleInputEmail1"> <?php echo lang('type'); ?></label>
                                                            <select class="form-control m-bot15 js-example-basic-multiple type" id="type" name="type" value=''>
                                                                <option value="all"><?php echo lang('all'); ?></option>
                                                                <option value="<?php echo $this->ion_auth->get_user_id(); ?>">Only Mine</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group d-flex align-center">
                                                            <label for="exampleInputEmail1"> <?php echo lang('template'); ?></label>
                                                            <select class="form-control m-bot15 js-example-basic-multiple template" id="template1" name="template" value=''>
                                                                <option value=""><?php echo lang('select'); ?></option>
                                                                <?php foreach ($templates as $template) { ?>
                                                                    <option value="<?php echo $template->id; ?>"><?php echo $template->name . " (" . $this->db->get_where('users', array("id" => $template->user))->row()->username . ")"; ?> </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6 lab pad_bot">
                                                        <div class="form-group d-flex align-center">
                                                            <label for="exampleInputEmail1"><?php echo lang('date'); ?> &ast; </label>
                                                            <input type="text" class="form-control pay_in default-date-picker readonly" name="date" value='<?php
                                                                                                                                                            if (!empty($lab->date)) {
                                                                                                                                                                echo date('d-m-Y', $lab->date);
                                                                                                                                                            } else {
                                                                                                                                                                echo date('d-m-Y');
                                                                                                                                                            }
                                                                                                                                                            ?>' placeholder="" required="" style="pointer-events: none;">
                                                        </div>

                                                        <div class="form-group d-flex align-center">
                                                            <label for="exampleInputEmail1"><?php echo lang('patient'); ?> &ast; </label>
                                                            <select class="form-control <?php if (empty($lab->patient)) { ?> pos_select <?php } ?>" id="<?php if (empty($lab->patient)) { ?> pos_select <?php } ?>" name="patient" value='' required="" style="pointer-events: none;">
                                                                <?php
                                                                if (!empty($lab->patient)) {
                                                                    if (empty($patients->age)) {
                                                                        $dateOfBirth = $patients->birthdate;
                                                                        if (empty($dateOfBirth)) {
                                                                            $age[0] = '0';
                                                                        } else {
                                                                            $today = date("Y-m-d");
                                                                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                                                            $age[0] = $diff->format('%y');
                                                                        }
                                                                    } else {
                                                                        $age = explode('-', $patients->age);
                                                                    }
                                                                ?>
                                                                    <option value="<?php echo $patients->id; ?>" selected="selected"><?php echo $patients->name; ?> ( <?php echo lang('id'); ?>: <?php echo $patients->id; ?> - <?php echo lang('phone'); ?>: <?php echo $patients->phone; ?> - <?php echo lang('age'); ?>: <?php echo $age[0]; ?> ) </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                        <!-- <div class="form-group d-flex align-center">
                                                            <label for="exampleInputEmail1"> <?php echo lang('macro'); ?></label>
                                                            <select class="form-control js-example-basic-multiple macro" id="macro" name="macro" value=''>
                                                                <option value=""><?php echo lang('select'); ?></option>
                                                                <?php foreach ($macros as $macro) { ?>
                                                                    <option value="<?php echo $macro->id; ?>"><?php echo $macro->short_name; ?> </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div> -->
                                                    </div>



                                                    <div class="col-md-6 lab pad_bot" style="display: none">
                                                        <label for="exampleInputEmail1"> <?php echo lang('refd_by_doctor'); ?></label>
                                                        <select class="form-control m-bot15 add_doctor" id="add_doctor" name="doctor" value=''>
                                                            <?php if (!empty($lab->doctor)) { ?>
                                                                <option value="<?php echo $doctors->id; ?>" selected="selected"><?php echo $doctors->name; ?> - <?php echo $doctors->id; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>






                                                </div>


                                                <?php
                                                if (!empty($lab->id)) {
                                                    $report_template = $this->db->get_where('payment_category', array('id' => $lab->category_id))->row();
                                                    if (isset($report_template) && $report_template->report != null) {
                                                        $report_template = $report_template->report;
                                                    } else {
                                                        $report_template = "";
                                                    }
                                                }
                                                ?>


                                                <div class="d-flex align-center mt-3" style="justify-content: space-between">
                                                    <label for="exampleInputEmail1"> <?php echo lang('report'); ?></label>
                                                </div>

                                                <div class="my-2 lab pad_bot">

                                                    <textarea class="form-control" id="editor" name="report" value="" rows="10"><?php
                                                                                                                                if (!empty($setval)) {
                                                                                                                                    echo set_value('report');
                                                                                                                                }
                                                                                                                                if (!empty($lab->report)) {
                                                                                                                                    echo $lab->report;
                                                                                                                                } else {
                                                                                                                                    echo $report_template;
                                                                                                                                }
                                                                                                                                ?>
                                </textarea>
                                                </div>



                                                <div class="col-md-12 form-group text-right">
                                                    <button type="submit" name="submit" id="submit" onclick="document.querySelector('#submission_type').value = 'submit';" class="btn btn-info"><?php echo lang('save_and_ready_to_deliver'); ?></button>
                                                    <button type="submit" name="draft" id="draft" onclick="document.querySelector('#submission_type').value = 'draft';" class="btn btn-warning"><?php echo lang('save_as_draft'); ?></button>
                                                    <button type="" id="template2" onclick="document.querySelector('#submission_type').value = 'template';" class="btn btn-danger"><?php echo lang('save_as_template'); ?></button>
                                                </div>

                                                <input type="hidden" id="submission_type" name="submission_type" value="">


                                                <div class="modal fade" id="templateModal">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title font-weight-bold">Template Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" name="template_name" class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Category</label>
                                                                    <select class="form-control" name="template_category">
                                                                        <?php foreach ($categories as $category) { ?>
                                                                            <option value="<?php echo $category->id; ?>"><?php echo $category->category; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="template" id="template3" onclick=" document.querySelector('#submission_type').value = 'template';" class="btn btn-danger"><?php echo lang('save_as_template'); ?></button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="redirect" value="lab">

                                                <input type="hidden" name="id" value='<?php
                                                                                        if (!empty($lab->id)) {
                                                                                            echo $lab->id;
                                                                                        }
                                                                                        ?>'>
                                                <input type="hidden" name="draft" id="draft2" value="">


                                            </div>
                                        </div>
                                    </div>



                                </section>


                            </form>
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

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/description.js"></script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"></script>
<script src="common/extranal/js/lab/add_lab_view.js"></script>
<script>
    $('.draftSubmit').on("click", function(e) {
        e.preventDefault();
        $('.pay_in').prop('required', false)
        $('.pos_select').prop('required', false)
        $('#draft').val('1');
        return true;
        let form = document.getElementById("editLabForm");
        document.querySelected("#editLabForm").submit();
    })

    $(document).ready(function() {
        $('#template2').on('click', function(e) {
            e.preventDefault();
            $('#templateModal').modal();
        })
        "use strict";
        $(document.body).on('change', '#macro', function() {
            "use strict";
            var iid = $("select.macro option:selected").val();
            $.ajax({
                url: 'macro/getMacroByIdByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
                success: function(response) {
                    "use strict";
                    var data = myEditor.getData();
                    if (response.macro.description != null) {
                        //var data1 = data + response.macro.description;
                        //myEditor.insertText("Hi");
                        myEditor.model.change(writer => {
                            const insertPosition = myEditor.model.document.selection.getFirstPosition();
                            writer.insertText(response.macro.description, insertPosition);
                        });
                        data = myEditor.getData();
                        myEditor.setData(data);
                        //ClassicEditor.instances('#editor').insertText("Hi");
                    } else {
                        //var data1 = data;
                    }
                    //myEditor.setData(data1)

                }
            })
        });

        $("#editor").keypress(function() {
            console.log("Hello");
        });

        $('#category').on("change", function() {
            let id = $('#category').val();
            let user_id = $('#type').val();
            axios.get('lab/getTemplateByCategory?category_id=' + id + "&user_id=" + user_id)
                .then(response => {
                    $('#template1').empty();
                    $("#template1").append(response.data);
                    $('#template1').trigger('change');
                })
        })

        $('#type').on("change", function() {
            let id = $('#type').val();
            let category_id = $('#category').val();
            axios.get('lab/getTemplateByUser?user_id=' + id + "&category_id=" + category_id)
                .then(response => {
                    $('#template1').empty();
                    $("#template1").append(response.data);
                    $('#template1').trigger('change');
                })
        })
    });
</script>