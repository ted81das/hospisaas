<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">

 <link href="common/extranal/css/prescription/prescription_view_1.css" rel="stylesheet">
        <div class="col-md-8 panel bg_container margin_top" id="prescription">
            <div class="bg_prescription">
                <div class="panel-body">
                    <div class="col-md-8 float-left top_title">
                        <h2 class='doctor'><?php
                            if (!empty($doctor)) {
                                echo $doctor->name;
                            } else {
                                ?>
                                <?php echo $settings->title; ?>
                                <h5><?php echo $settings->address; ?></h5>
                                <h5><?php echo $settings->phone; ?></h5>
                            <?php }
                            ?>
                        </h2>
                        <h4>
                            <?php
                            if (!empty($doctor)) {
                                echo $doctor->profile;
                            }
                            ?>
                        </h4>
                    </div>
                    <div class="col-md-4 float-right text-right top_logo"> <img src="<?php echo $settings->logo; ?>" height="150"></div>
                </div>
                <hr>
                <div class="panel-body">
                    <div class="">
                        <h5 class="col-md-4 prescription"><?php echo lang('date'); ?> : <?php echo date('d-m-Y', $prescription->date); ?></h5>
                        <h5 class="col-md-3 prescription"><?php echo lang('prescription'); ?> <?php echo lang('id'); ?> : <?php echo $prescription->id; ?></h5>
                    </div>
                </div>

                <hr>
                <div class="panel-body">
                    <div class="">
                        <h5 class="col-md-4 patient_name"><?php echo lang('patient'); ?>: <?php
                            if (!empty($patient)) {
                                echo $patient->name;
                            }
                            ?>
                        </h5>
                        <h5 class="col-md-3 patient"><?php echo lang('patient_id'); ?>: <?php
                            if (!empty($patient)) {
                                echo $patient->id;
                            }
                            ?></h5>
                        <h5 class="col-md-3 patient"><?php echo lang('age'); ?>: 
                        <?php
                            if (!empty($patient)) {
                                if (!empty($patient->birthdate)) {
                                    $birthDate = strtotime($patient->birthdate);
                                    $birthDate = date('m/d/Y', $birthDate);
                                    $birthDate = explode("/", $birthDate);
                                    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
                                    echo $age . ' ' . lang('years');
                                } elseif (!empty($patient->age)) {
                                    $age = explode('-', $patient->age);
                                    echo $age[0] . 'Y ' . $age[1] . 'M ' . $age[2].'D';
                                }
                            }
                            ?>
                        </h5>
                        <h5 class="col-md-2 patient text-right"><?php echo lang('gender'); ?>: <?php echo $patient->sex; ?></h5>
                    </div>
                </div>

                <hr>

                <div class="col-md-12 clearfix prescription_history">



                    <div class="col-md-5 left_panel">

                        <div class="panel-body">
                            <div class="float-left">
                                <h5><strong><?php echo lang('history'); ?>: </strong> <br> <br> <?php echo $prescription->symptom; ?></h5>
                            </div>
                        </div>

                        <hr>

                        <div class="panel-body">
                            <div class="float-left">
                                <h5><strong><?php echo lang('note'); ?>:</strong> <br> <br> <?php echo $prescription->note; ?></h5>
                            </div>
                        </div>




                        <hr>

                        <div class="panel-body">
                            <div class="float-left">
                                <h5><strong><?php echo lang('advice'); ?>: </strong> <br> <br> <?php echo $prescription->advice; ?></h5>
                            </div>
                        </div>




                    </div>

                    <div class="col-md-7">

                        <div class="panel-body">
                            <div class="medicine_pres">
                                <strong class="medicine_pres1"> Rx </strong>
                            </div>
                            <?php
                            if (!empty($prescription->medicine)) {
                                ?>
                                <table class="table table-striped table-hover">                      
                                    <thead>       
                                    <th><?php echo lang('medicine'); ?></th>
                                    <th><?php echo lang('instruction'); ?></th>
                                    <th class="text-right"><?php echo lang('frequency'); ?></th>    
                                    </thead>
                                    <tbody>
                                        <?php
                                        $medicine = $prescription->medicine;
                                        $medicine = explode('###', $medicine);
                                        foreach ($medicine as $key => $value) {
                                            ?>
                                            <tr>
                                                <?php $single_medicine = explode('***', $value); ?>

                                                <td class=""><?php echo $this->medicine_model->getMedicineById($single_medicine[0])->name . ' - ' . $single_medicine[1]; ?> </td>
                                                <td class=""><?php echo $single_medicine[3] . ' - ' . $single_medicine[4]; ?> </td>
                                                <td class="text-right"><?php echo $single_medicine[2] ?> </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>


                    </div>

                </div>


            </div>









            <div class="panel-body prescription_footer">
                <div class="col-md-4 float-left"> <hr> <?php echo lang('signature'); ?></div>
                <div class="col-md-8 float-right text-right">
                    <h3 class='hospital'><?php echo $settings->title; ?></h3>
                    <h5><?php echo $settings->address; ?></h5>
                    <h5><?php echo $settings->phone; ?></h5>
                </div>
            </div>


        </div>



        <!-- invoice start-->
        <section class="col-md-4 margin_top">
            <div class="panel-primary clearfix">
                
                <div class="panel_button clearfix">
                    <div class="text-center invoice-btn no-print float-left">
                        <a class="btn btn-info btn-lg invoice_button" onclick="javascript:window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?> </a>
                    </div>
                </div>

                <div class="panel_button clearfix">
                    <div class="text-center invoice-btn no-print float-left download_button">
                        <a class="btn btn-info btn-sm detailsbutton float-left download" id="download"><i class="fa fa-download"></i> <?php echo lang('download'); ?> </a>
                    </div>
                </div>
                <div class="panel_button clearfix">
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <div class="text-center invoice-btn no-print float-left">
                            <a class="btn btn-info btn-lg info" href='prescription/all'><i class="fa fa-medkit"></i> <?php echo lang('all'); ?> <?php echo lang('prescription'); ?> </a>
                        </div>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                        <div class="text-center invoice-btn no-print float-left">
                            <a class="btn btn-info btn-lg info" href='prescription'><i class="fa fa-medkit"></i> <?php echo lang('all'); ?> <?php echo lang('prescriptions'); ?> </a>
                        </div>
                    <?php } ?>
                </div>
                <div class="panel_button">
                    <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>
                        <div class="text-center invoice-btn no-print float-left">
                            <a class="btn btn-info btn-lg green" href="prescription/addPrescriptionView"><i class="fa fa-plus-circle"></i> <?php echo lang('add_prescription'); ?> </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <!-- invoice end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->




<script src="common/js/codearistos.min.js"></script>