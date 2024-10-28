<!--sidebar end-->
<!--main content start-->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
<style>
    @media print {
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin-top: -1300px;
            padding: 0;
        }

        .no-print {
            display: none;
        }

        .modal {
            position: relative;
            top: 0;
            left: 0;
            display: block;
            overflow: visible;
        }

        .modal-dialog {
            max-width: 100%;
            width: auto;
            margin: 0;
            padding: 0;
        }

        .modal-content {
            border: none;
            box-shadow: none;
            margin: 0;
            padding: 0;
        }

        .modal-body {
            padding: 10px;
        }

        .modal-header,
        .modal-footer {
            display: none;
        }

        body.modal-open {
            overflow: visible;
        }
    }
</style>

<!-- <link href="common/extranal/css/patient/case_list.css" rel="stylesheet"> -->
<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> <?php echo lang('cases'); ?> / <?php echo lang('add'); ?> <?php echo lang('case'); ?> </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item"><a href="patient"><?php echo lang('patient') ?></a></li>
                        <li class="breadcrumb-item active"> <?php echo lang('add'); ?> <?php echo lang('case'); ?> </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <style>

    </style>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('Add a new case'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row"> <!-- Added row class here -->
                                <form role="form" action="patient/addMedicalHistory" class="clearfix w-100" method="post" enctype="multipart/form-data">
                                    <div class="">
                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('date'); ?> &ast;</label>
                                            <input type="text" class="form-control default-date-picker" name="date" placeholder="" autocomplete="off" required="">
                                        </div>
                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('patient'); ?> &ast;</label>
                                            <select class="form-control m-bot15" id="patientchoose" name="patient_id" required="">
                                            </select>
                                        </div>

                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('title'); ?> &ast;</label>
                                            <input type="text" class="form-control" name="title" placeholder="" required="">
                                        </div>

                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-4 col-4"><?php echo lang('symptom'); ?> </label>
                                            <select class="form-control m-bot15 col-sm-9" multiple id="symptomchoose" name="symptom_id[]">
                                            </select>
                                            <a data-toggle="modal" href="#mySymptomModal" class="btn btn-success ml-3"> <i class="fa fa-plus"></i> </a>
                                        </div>

                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-4 col-4"><?php echo lang('lab_test'); ?> </label>
                                            <select class="form-control m-bot15 col-sm-7" multiple id="testchoose" name="test_id[]">
                                            </select>
                                            <!-- <a data-toggle="modal" href="#myTestModal" class="btn btn-success col-sm-1" style="margin-left: 10px;"> + </a> -->
                                        </div>

                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-4 col-4"><?php echo lang('diagnosis'); ?> </label>
                                            <select class="form-control m-bot15 col-sm-9" multiple id="diagnosischoose" name="diagnosis_id[]">
                                            </select>
                                            <a data-toggle="modal" href="#myDiagnosisModal" class="btn btn-warning ml-3"> <i class="fa fa-plus"></i> </a>
                                        </div>
                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-4 col-4"><?php echo lang('treatment'); ?> </label>
                                            <select class="form-control m-bot15 col-sm-9" multiple id="treatmentchoose" name="treatment_id[]">
                                            </select>
                                            <a data-toggle="modal" href="#myTreatmentModal" class="btn btn-success ml-3"> <i class="fa fa-plus"></i> </a>
                                        </div>

                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-4 col-4"><?php echo lang('advice'); ?> </label>
                                            <select class="form-control m-bot15 col-sm-9" multiple id="advicechoose" name="advice_id[]">
                                            </select>
                                            <a data-toggle="modal" href="#myAdviceModal" class="btn btn-success ml-3"> <i class="fa fa-plus"></i> </a>
                                        </div>

                                        <div class="form-group no-print">
                                            <label class="col-sm-4"><?php echo lang('history'); ?> &ast;</label>
                                            <textarea class="form-control ckeditor description" name="description" id="editor1" rows="10"></textarea>
                                        </div>
                                        <input type="hidden" name="redirect" value='patient/caseList'>
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
                <div class="col-12 col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('cases'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover text-sm" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th class="table_head"><?php echo lang('date'); ?></th>
                                        <th class="table_head1"><?php echo lang('patient'); ?></th>
                                        <th class="table_head1"><?php echo lang('case'); ?> <?php echo lang('title'); ?></th>
                                        <th class="table_head no-print"><?php echo lang('options'); ?></th>
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













<!--main content end-->
<!--footer start-->






<!-- Add Case Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('add_medical_history'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="patient/addMedicalHistory" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('date'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" value='' placeholder="" readonly="" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('patient'); ?> &ast;</label>
                            <select class="form-control m-bot15 js-example-basic-single" name="patient_id" value='' required="">
                                <?php foreach ($patients as $patient) { ?>
                                    <option value="<?php echo $patient->id; ?>"> <?php echo $patient->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('title'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-inline input-medium" name="title" value='' placeholder="" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label class=""><?php echo lang('description'); ?> &ast;</label>
                            <textarea class="ckeditor form-control" name="description" value="" rows="10" required></textarea>
                        </div>
                        <input type="hidden" name="id" value=''>
                        <input type="hidden" name="redirect" value='patient/caseList'>
                        <section class="col-md-12">
                            <button type="submit" name="submit" class="btn btn-info submit_button float-right"> <?php echo lang('submit'); ?></button>
                        </section>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Case Modal-->

<!-- Edit Case Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('edit_medical_history'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="medical_historyEditForm" class="clearfix" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="">
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('date'); ?> &ast;</label>
                            <input type="text" class="form-control col-sm-8 form-control-inline input-medium default-date-picker" name="date" value='' placeholder="" required="">
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('patient'); ?> &ast;</label>
                            <select class="form-control col-sm-8 m-bot15 patient" id="patientchoose1" name="patient_id" value='' required="">

                            </select>
                        </div>
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('title'); ?> &ast;</label>
                            <input type="text" class="form-control col-sm-8 form-control-inline input-medium" name="title" value='' placeholder="" required="">
                        </div>

                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('symptom'); ?> &ast;</label>
                            <select class="form-control col-sm-8 m-bot15 patient" multiple id="symptomchoose1" name="symptom_id[]" value=''>

                            </select>
                        </div>

                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('lab_test'); ?> &ast;</label>
                            <select class="form-control col-sm-8 m-bot15 patient" multiple id="testchoose1" name="test_id[]" value=''>

                            </select>
                        </div>

                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('diagnosis'); ?> &ast;</label>
                            <select class="form-control col-sm-8 m-bot15 patient" multiple id="diagnosischoose1" name="diagnosis_id[]" value=''>

                            </select>
                        </div>

                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('treatment'); ?> &ast;</label>
                            <select class="form-control col-sm-8 m-bot15 patient" multiple id="treatmentchoose1" name="treatment_id[]" value=''>

                            </select>
                        </div>

                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('advice'); ?> &ast;</label>
                            <select class="form-control col-sm-8 m-bot15 patient" multiple id="advicechoose1" name="advice_id[]" value=''>

                            </select>
                        </div>
                        <div class="form-group d-flex">
                            <label class="col-sm-4"><?php echo lang('history'); ?> &ast;</label>
                            <textarea class="ckeditor col-sm-8 form-control editor" id="editor" name="description" value="" rows="10"></textarea>
                        </div>
                        <input type="hidden" name="id" value=''>
                        <input type="hidden" name="redirect" value='patient/caseList'>
                        <div class="col-md-12 no-print">
                            <button type="submit" name="submit" class="btn btn-info submit_button float-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="caseModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('case'); ?> <?php echo lang('details'); ?></h4>
                <button type="button" class="close no-print" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="medical_historyEditForm" class="clearfix form-row" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12 row">
                        <div class="form-group col-md-6 case_date_block">
                            <label for="exampleInputEmail1"><?php echo lang('case'); ?> <?php echo lang('creation'); ?> <?php echo lang('date'); ?></label>
                            <div class="case_date"></div>
                        </div>
                        <div class="form-group col-md-6 case_patient_block">
                            <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                            <div class="case_patient"></div>
                            <div class="case_patient_id"></div>
                        </div>
                        <div>
                            <hr>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?> </label>
                        <div class="case_title"></div>
                        <hr>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('symptom'); ?></label>
                        <div class="case_symptom"></div>
                        <hr>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('lab_test'); ?></label>
                        <div class="case_test"></div>
                        <hr>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('diagnosis'); ?></label>
                        <div class="case_diagnosis"></div>
                        <hr>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('treatment'); ?></label>
                        <div class="case_treatment"></div>
                        <hr>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('advice'); ?></label>
                        <div class="case_advice"></div>
                        <hr>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('history'); ?></label>
                        <div class="case_details"></div>
                        <hr>
                    </div>

                    <div class="col-md-9">
                        <h5 class="float-right">
                            <?php echo $settings->title . '<br>' . $settings->address; ?>
                        </h5>
                    </div>

                    <div class="col-md-3 no-print">
                        <a class="btn btn-info invoice_button float-right" onclick="printModal()"><i class="fa fa-print"></i> <?php echo lang('print'); ?> </a>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<!-- Chat with GPT-->
<div class="modal fade" id="gptModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('gpt_button'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="patient/addMedicalHistory" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-row">


                        <div class="form-group col-md-12" id="answer">


                        </div>
                        <div class="form-group col-md-12">
                            <!-- <label class=""><?php echo lang('chat'); ?> &ast;</label> -->
                            <textarea class="ckeditor form-control" name="description" value="" rows="10" required></textarea>
                        </div>
                        <input type="hidden" name="id" value=''>
                        <input type="hidden" name="redirect" value='patient/caseList'>
                        <section class="col-md-12">
                            <button type="submit" name="submit" class="btn btn-info submit_button float-right"> <?php echo lang('send'); ?> <?php echo lang('chat'); ?></button>
                        </section>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Chat with GPT-->



<div class="modal fade" id="mySymptomModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('add_new_symptom'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">

                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control form-control-inline input-medium" id="name" name="name" value='' placeholder="" required>
                    </div>
                    <section class="col-md-12">
                        <div id="addSymptom" class="btn btn-info submit_button float-right">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                            <span id="button-text"><?php echo lang('submit'); ?></span>
                        </div>
                    </section>

                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myTestModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('add_new_test'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">

                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control form-control-inline input-medium" id="category" name="category" value='' placeholder="" required>
                    </div>
                    <input type="hidden" name="type" id="type" value="diagnostic">
                    <section class="col-md-12">
                        <div id="addTest" class="btn btn-info submit_button float-right">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                            <span id="button-text"><?php echo lang('submit'); ?></span>
                        </div>
                    </section>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade" id="myDiagnosisModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('add_new_diagnosis'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="form-group d-flex">
                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('disease'); ?> <?php echo lang('name'); ?> </label>
                    <input type="text" class="form-control col-sm-9" name="name" id="name2" value='' placeholder="" required>
                </div>
                <div class="form-group d-flex">
                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('icd 10'); ?> <?php echo lang('code'); ?></label>
                    <input type="text" class="form-control col-sm-9" name="code" id="code" value='' placeholder="" required>
                </div>
                <div class="form-group d-flex">
                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('description'); ?> </label>
                    <textarea class="form-control col-sm-9 ckeditor" id="editor2" name="description" value="" rows="10" cols="20"></textarea>


                </div>
                <div class="form-group d-flex disease_div">
                    <input type="checkbox" name="disease_with_outbreak_potential" value="1" id="disease_with_outbreak_potential" class="disease_with_outbreak_potential">
                    <label for="exampleInputEmail1" class=""> <?php echo lang('Disease With Outbreak Potential'); ?> </label>
                </div>
                <div id="maximum">
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('Maximum Expected Number Of Patient In A Week'); ?></label>
                        <input type="number" class="form-control col-sm-9" name="maximum_expected_number_of_patient_in_a_week" id="maximum_expected_number_of_patient_in_a_week" value='' placeholder="">
                    </div>
                </div>
                <section class="col-md-12">
                    <div id="addDiagnosis" class="btn btn-info submit_button float-right">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                        <span id="button-text"><?php echo lang('submit'); ?></span>
                    </div>
                </section>


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade" id="myTreatmentModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('add_new_treatment'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">

                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control form-control-inline input-medium" id="name3" name="name" value='' placeholder="" required>
                    </div>
                    <section class="col-md-12">
                        <div id="addTreatment" class="btn btn-info submit_button float-right">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                            <span id="button-text"><?php echo lang('submit'); ?></span>
                        </div>
                    </section>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade" id="myAdviceModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('add_new_advice'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">

                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control form-control-inline input-medium" id="name1" name="name" value='' placeholder="" required>
                    </div>
                    <section class="col-md-12">
                        <div id="addAdvice" class="btn btn-info submit_button float-right">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                            <span id="button-text"><?php echo lang('submit'); ?></span>
                        </div>
                    </section>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>




<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
}
?>

<script src="common/js/codearistos.min.js"></script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
    var select_diagnosis = "<?php echo lang('select_diagnosis'); ?>";
    var select_treatment = "<?php echo lang('select_treatment'); ?>";

    var select_advice = "<?php echo lang('select_advice'); ?>";
    var select_symptom = "<?php echo lang('select_symptom'); ?>";
    var select_test = "<?php echo lang('select_test'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/patient/case_list.js"></script>




<script>
    $(document).ready(function() {
        $(".table").on("click", ".gptButton", function() {
            var id = $(this).attr('data-id');
            var des = $(this).attr('data-description');
            var description = des.replace(/<[^>]*>/g, ''); // Remove HTML tags


            $.ajax({
                type: "POST",
                url: "patient/getConversationHistoryAjax", // The new endpoint
                data: {
                    id: id
                },
                success: function(response) {
                    var history = JSON.parse(response).history; // Assuming the endpoint returns { history: [message1, message2, ...] }
                    var formattedHistory = '';
                    var toRemove = "You are a doctor. Advice according to the case described here. This is the case: ";
                    for (var i = 0; i < history.length; i++) {
                        // Assuming you have a role in each message to distinguish between user and GPT
                        var role = history[i].role === 'user' ? 'You' : 'GPT';
                        var content = history[i].content.replace(toRemove, '').trim();
                        formattedHistory += '</br><div><strong>' + role + ':</strong> ' + content + '</div>';
                    }
                    $('#answer').html(formattedHistory); // Display conversation history
                },
                error: function() {
                    $('#answer').html('<div class="alert alert-danger">Error fetching conversation history. Please try again later.</div>');
                }
            });



            $('#gptModal textarea[name="description"]').val(description);
            $('#gptModal input[name="id"]').val(id);
            $('#gptModal').modal('show');
            $('#answer').html(''); // Clear previous conversation
        });

        $('#gptModal form').on('submit', function(event) {
            event.preventDefault();
            var message = $(this).find('textarea[name="description"]').val();
            var id = $(this).find('input[name="id"]').val();
            $('#answer').append('<div><strong>You:</strong> ' + message + '</div>'); // Display user message

            $.ajax({
                type: "POST",
                url: "patient/chatWithGpt",
                data: {
                    id: id,
                    description: message
                },
                success: function(response) {
                    var parsedResponse = JSON.parse(response);
                    $('#answer').append('<div><strong>GPT:</strong> ' + parsedResponse.message + '</div>');
                },
                error: function() {
                    $('#answer').append('<div class="alert alert-danger">Error occurred. Please try again later.</div>');
                }
            });

            $(this).find('textarea[name="description"]').val(''); // Clear input after sending
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
<script>
    function printModal() {
        $('#caseModal').modal('show');
        setTimeout(function() {
            window.print();
        }, 500);
    }
</script>