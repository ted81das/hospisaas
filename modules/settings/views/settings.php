<!-- <link href="common/extranal/css/settings/settings.css" rel="stylesheet"> -->





<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-cog mr-2"></i><?php echo lang('settings'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('settings') ?></li>
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
                    <div class="">
                        <!-- /.card-header -->
                        <div class="card-body p-4">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="settings/update" method="post" enctype="multipart/form-data">
                                <div class="" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <a class="collapsed" data-toggle="collapse" href="#collapseOne">
                                                    <?php echo lang('general_settings'); ?>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">

                                            <div class="card-body row">
                                                <div class="form-group col-md-6 d-flex">
                                                    <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('system_name'); ?> &ast;</label>
                                                    <input type="text" class="form-control col-sm-7" name="name" value='<?php
                                                                                                                        if (!empty($settings->system_vendor)) {
                                                                                                                            echo $settings->system_vendor;
                                                                                                                        }
                                                                                                                        ?>' placeholder="system name" required="">
                                                </div>
                                                <div class="form-group col-md-6 d-flex">
                                                    <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('title'); ?> &ast;</label>
                                                    <input type="text" class="form-control col-sm-7" name="title" value='<?php
                                                                                                                            if (!empty($settings->title)) {
                                                                                                                                echo $settings->title;
                                                                                                                            }
                                                                                                                            ?>' placeholder="title" required="">
                                                </div>
                                                <div class="form-group col-md-6 d-flex">
                                                    <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('address'); ?> &ast;</label>
                                                    <input type="text" class="form-control col-sm-7" name="address" value='<?php
                                                                                                                            if (!empty($settings->address)) {
                                                                                                                                echo $settings->address;
                                                                                                                            }
                                                                                                                            ?>' placeholder="address" required="">
                                                </div>
                                                <div class="form-group col-md-6 d-flex">
                                                    <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('phone'); ?> &ast;</label>
                                                    <input type="text" class="form-control col-sm-7" name="phone" value='<?php
                                                                                                                            if (!empty($settings->phone)) {
                                                                                                                                echo $settings->phone;
                                                                                                                            }
                                                                                                                            ?>' placeholder="phone" required="">
                                                </div>
                                                <div class="form-group col-md-6 d-flex">
                                                    <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('hospital_email'); ?> &ast;</label>
                                                    <input type="text" class="form-control col-sm-7" name="email" value='<?php
                                                                                                                            if (!empty($settings->email)) {
                                                                                                                                echo $settings->email;
                                                                                                                            }
                                                                                                                            ?>' placeholder="email" required="">
                                                </div>
                                                <div class="form-group col-md-6 d-flex">
                                                    <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('currency'); ?> &ast;</label>
                                                    <input type="text" class="form-control col-sm-7" name="currency" value='<?php
                                                                                                                            if (!empty($settings->currency)) {
                                                                                                                                echo $settings->currency;
                                                                                                                            }
                                                                                                                            ?>' placeholder="currency" required="">
                                                </div>

                                                <div class="form-group col-md-6 d-flex">
                                                    <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('footer_message'); ?> &ast;</label>
                                                    <input type="text" class="form-control col-sm-7" name="footer_message" value='<?php
                                                                                                                                    if (!empty($settings->footer_message)) {
                                                                                                                                        echo $settings->footer_message;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="ByCodearistos" required="">
                                                </div>
                                                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>

                                                    <style>
                                                        .img_height {
                                                            width: 100px;
                                                            height: 100px;

                                                        }
                                                    </style>
                                                    <div class="form-group col-md-6 d-flex">
                                                        <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('default'); ?> <?php echo lang('vat'); ?> (%) &ast;</label>
                                                        <input type="number" min="0" max="100" class="form-control col-sm-7" name="vat" value='<?php
                                                                                                                                                if (!empty($settings->vat)) {
                                                                                                                                                    echo $settings->vat;
                                                                                                                                                } else {
                                                                                                                                                    echo 0;
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="vat" required="">
                                                    </div>
                                                    <div class="form-group col-md-6 d-flex">
                                                        <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('default'); ?> <?php echo lang('discount'); ?> (%) &ast;</label>
                                                        <input type="number" min="0" max="100" class="form-control col-sm-7" name="discount_percent" value='<?php
                                                                                                                                                            if (!empty($settings->discount_percent)) {
                                                                                                                                                                echo $settings->discount_percent;
                                                                                                                                                            } else {
                                                                                                                                                                echo 0;
                                                                                                                                                            }
                                                                                                                                                            ?>' placeholder="discount" required="">
                                                    </div>
                                                    <div class="form-group col-md-6 d-flex">
                                                        <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('time_format'); ?> &ast;</label>
                                                        <select name="time_format" class="form-control col-sm-7" id="" required>
                                                            <option value="12" <?php if ($settings->time_format == '12') {
                                                                                    echo 'selected';
                                                                                } ?>><?php echo lang('12_hours_am_pm'); ?></option>
                                                            <option value="24" <?php if ($settings->time_format == '24') {
                                                                                    echo 'selected';
                                                                                } ?>><?php echo lang('24_hours'); ?></option>
                                                        </select>

                                                    </div>

                                                    <div class="form-group col-md-6 d-flex">
                                                        <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('show_odontogram_in_history'); ?> &ast;</label>
                                                        <select name="show_odontogram_in_history" class="form-control col-sm-7" id="" required>
                                                            <option value="yes" <?php if ($settings->show_odontogram_in_history == 'yes') {
                                                                                    echo 'selected';
                                                                                } ?>><?php echo lang('yes'); ?></option>
                                                            <option value="no" <?php if ($settings->show_odontogram_in_history == 'no') {
                                                                                    echo 'selected';
                                                                                } ?>><?php echo lang('no'); ?></option>
                                                        </select>

                                                    </div>


                                                    <div class="form-group col-md-6 d-flex">
                                                        <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('footer_invoice_message'); ?></label><br>
                                                        <textarea name="footer_invoice_message" class="form-control col-sm-7" rows="2" value='' style="height: 4em !important;"><?php
                                                                                                                                                                                if (!empty($settings->footer_invoice_message)) {
                                                                                                                                                                                    echo $settings->footer_invoice_message;
                                                                                                                                                                                }
                                                                                                                                                                                ?></textarea>


                                                    </div>


                                                <?php } ?>





                                                <div class="form-group col-md-6 d-flex">
                                                    <label class="control-label col-sm-5">
                                                        <?php
                                                        echo lang('title') . ' ';
                                                        echo lang('logo');
                                                        ?>
                                                    </label>
                                                    <div class="col-sm-7">
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb <?php if (!empty($settings->title_logo)) { ?> img_url <?php } else { ?> img_url1 <?php } ?>">
                                                                <img src="<?php
                                                                            if (empty($settings->logo_title)) {
                                                                                echo '';
                                                                            } else {
                                                                                echo $settings->logo_title;
                                                                            }
                                                                            ?>" id="img" height="100px" alt="" />
                                                            </div>
                                                            <div>
                                                                <span class="btn btn-white btn-file">
                                                                    <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                                    <!-- <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span> -->
                                                                    <input type="file" class="default" name="img_url_title" />
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <span class="help-block"><?php echo lang('recommended_size'); ?> : 200x100</span>
                                                    </div>
                                                </div>



                                                <div class="form-group col-md-6 d-flex">
                                                    <label class="control-label col-sm-5"><?php
                                                                                            if (!$this->ion_auth->in_group(array('superadmin'))) {
                                                                                            ?><?php echo lang('invoice_logo'); ?><?php
                                                                                                                                }
                                                                                                                                    ?>
                                                        <?php
                                                        if ($this->ion_auth->in_group(array('superadmin'))) {
                                                        ?><?php echo lang('website_logo'); ?><?php
                                                                                            }
                                                                                                ?></label>
                                                    <div class="col-sm-7">
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb <?php if (!empty($settings->logo)) { ?> img_url <?php } else { ?> img_url1 <?php } ?>">
                                                                <img src="<?php
                                                                            if (empty($settings->logo)) {
                                                                                echo '';
                                                                            } else {
                                                                                echo $settings->logo;
                                                                            }
                                                                            ?>" id="img" alt="" height="100px" />
                                                            </div>
                                                            <div>
                                                                <span class="btn btn-white btn-file">
                                                                    <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                                    <!-- <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span> -->
                                                                    <input type="file" class="default" name="img_url" />
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <span class="help-block"><?php echo lang('recommended_size'); ?> : 200x100</span>
                                                    </div>
                                                </div>















                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>


                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">
                                                    <a class="collapsed" data-toggle="collapse" href="#collapseTwo">
                                                        <?php echo lang('cron_jobs_settings'); ?>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="collapse">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6 d-flex">
                                                            <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('cron_job'); ?></label>
                                                            <?php
                                                            $base_url = base_url();
                                                            $base_url_explode = explode("//", $base_url);
                                                            ?>
                                                            <input type="text" class="form-control col-sm-7" name="" value='<?php
                                                                                                                            echo 'wget ' . $base_url_explode[1] . 'cronjobs/appointmentRemainder -O /dev/null 2>&1';
                                                                                                                            ?>' placeholder="" readonly>
                                                            <span class="text-success"><?php echo lang('please_paste_this_code_in_ccard_cronjob_add_command_field'); ?></span>
                                                        </div>
                                                        <div class="form-group col-md-6 d-flex">
                                                            <label for="exampleInputEmail1" class="col-sm-5"><?php echo lang('remainder_before_appointment'); ?></label>
                                                            <div class="input-group">
                                                                <input type="number" min="1" class="form-control col-sm-7" name="remainder_appointment" value='<?php
                                                                                                                                                                if (!empty($settings->remainder_appointment)) {
                                                                                                                                                                    echo $settings->remainder_appointment;
                                                                                                                                                                }
                                                                                                                                                                ?>' placeholder="">
                                                                <span class="input-group-addon"><?php echo lang('hours'); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    <?php } ?>






                                    <?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>


                                        <!-- <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">
                                                    <a class="collapsed" data-toggle="collapse" href="#collapseThree">
                                                        <?php echo lang('purchase_code_verification'); ?>
                                                        <span>
                                                            <?php if ($verified) {
                                                                echo '<span class="badge badge-success">Verified</span>';
                                                                $verify_data = $this->settings_model->verify();
                                                            } else {
                                                                echo '<span class="badge badge-danger">Not Verified</span>';
                                                            } ?>
                                                        </span>
                                                        <span>
                                                            <?php
                                                            if ($verified) {
                                                                $verify_data = $this->settings_model->verify();
                                                                if ($verify_data->supported_until < time()) {
                                                                    echo '<span class="badge badge-primary">Supported </span>';
                                                                } else {
                                                                    echo '<span class="badge badge-danger">Support Expired</span> <a class="text-xs" target="_blank" href="https://codecanyon.net/item/multi-hms-hospital-management-system-saas-app/13972431">Renew your support</a>';
                                                                }
                                                            }
                                                            ?>
                                                        </span>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="collapse">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1" class="">Envato Username</label>
                                                            <input type="text" class="form-control" name="codec_username" value='<?php
                                                                                                                                    if (!empty($settings->codec_username)) {
                                                                                                                                        echo $settings->codec_username;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="Envato Username">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1" class="">Envato Purchase Code</label>
                                                            <input type="text" class="form-control" name="codec_purchase_code" value='<?php
                                                                                                                                        if (!empty($settings->codec_purchase_code)) {
                                                                                                                                            echo $settings->codec_purchase_code;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="Envato Purchase Code">
                                                            <span>
                                                                <?php if ($verified) {
                                                                    echo '<span class="badge badge-success">Verified</span>';
                                                                } else {
                                                                    echo '<span class="badge badge-danger">Not Verified</span>';
                                                                    echo '</br></br><span ><a class="text-info" href="https://codecanyon.net/item/multi-hms-hospital-management-system-saas-app/13972431">Purchase a licence from envato</a></span>';
                                                                } ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->


                                    <?php } ?>



                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($settings->id)) {
                                                                            echo $settings->id;
                                                                        }
                                                                        ?>'>
                                <div class="form-group col-md-12">
                                    <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                                </div>
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
<script src="common/extranal/js/settings/settings.js"></script>