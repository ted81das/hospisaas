<!-- <link href="common/css/style.css" rel="stylesheet"> -->
<link href="common/css/bootstrap-reset.css" rel="stylesheet">

<link href="common/extranal/css/finance/add_payment_view.css" rel="stylesheet">


<style>
    .percent_amount {
        font-size: 8px !important;
        padding: 6px 9px !important;
    }

    .percent_input {
        padding: 6px 4px !important;
    }
</style>

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1><i class="fas fa-money-bill-wave mr-2"></i><strong><?php
                                                                            if (!empty($payment->id)) {
                                                                                echo lang('edit_invoice') . ': (' . lang('invoice_id') . '# ' . $payment->id . ')';
                                                                            } elseif (!empty($draft->id)) {
                                                                                echo lang('edit_draft_invoice');
                                                                            } else {
                                                                                echo lang('add_new_invoice');
                                                                            }
                                                                            ?></strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php
                                                            if (!empty($payment->id)) {
                                                                echo lang('edit_invoice') . ': (' . lang('invoice_id') . ':' . $payment->id . ')';
                                                            } elseif (!empty($draft->id)) {
                                                                echo lang('edit_draft_invoice');
                                                            } else {
                                                                echo lang('add_new_invoice');
                                                            }
                                                            ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <style>
        .required-asterisk {
            color: red;
            font-weight: bold;
        }
    </style>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <form role="form" id="editPaymentForm" class="clearfix form-row" action="finance/addPayment" method="post" enctype="multipart/form-data">

                    <div class="col-12 col-md-4">
                        <div class="card p-4">
                            <div class="">
                                <div class="editform">
                                    <div class="form-row">
                                        <div class="col-md-12 row">
                                            <div class="col-md-12 payment pad_bot d-flex">
                                                <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('patient'); ?><span class="required-asterisk">&ast;</span></label>
                                                <select class="form-control col-sm-8 m-bot15  pos_select" id="pos_select" name="patient" value='' required="">
                                                    <?php if (!empty($payment)) {
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
                                                        <option value="<?php echo $patients->id; ?>" selected="selected">
                                                            <?php echo $patients->name; ?> ( <?php echo lang('id'); ?>:
                                                            <?php echo $patients->id; ?> - <?php echo lang('phone'); ?>:
                                                            <?php echo $patients->phone; ?> - <?php echo lang('age'); ?>:
                                                            <?php echo $age[0]; ?> ) </option>
                                                        <?php } elseif (!empty($draft->patient)) {
                                                        if ($draft->patient == 'add_new') {
                                                        ?>
                                                            <option value="<?php echo 'add_new'; ?>" selected="selected">
                                                                <?php echo lang('add_new'); ?></option>
                                                        <?php } else {
                                                            $patients = $this->patient_model->getPatientById($draft->patient);
                                                            $age = explode('-', $patients->age);
                                                        ?>
                                                            <option value="<?php echo $patients->id; ?>" selected="selected">
                                                                <?php echo $patients->name; ?> ( <?php echo lang('id'); ?>:
                                                                <?php echo $patients->id; ?> - <?php echo lang('phone'); ?>:
                                                                <?php echo $patients->phone; ?> - <?php echo lang('age'); ?>:
                                                                <?php echo $age[0]; ?> ) </option>
                                                        <?php  }
                                                    } else { ?>
                                                        <option value="" selected="selected"><?php echo lang('select'); ?>
                                                        </option>
                                                        <option style="color: red; font-size: 18px;" value="<?php echo 'add_new'; ?>"><?php echo lang('add_new'); ?>
                                                        </option>
                                                    <?php    } ?>
                                                </select>
                                            </div>


                                            <div class="pos_client row my-4 bg-light py-4" style="display: none;">
                                                <div class="col-md-6 mb-3">
                                                    <label for="p_name" class="form-label">
                                                        <?php echo lang('patient') . ' ' . lang('name'); ?> <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="p_name" id="p_name" value='<?php
                                                                                                                                if (!empty($payment)) {
                                                                                                                                    echo $patients->name;
                                                                                                                                } elseif (!empty($draft->patient_name)) {
                                                                                                                                    echo $draft->patient_name;
                                                                                                                                }
                                                                                                                                ?>'>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="p_email" class="form-label">
                                                        <?php echo lang('patient') . ' ' . lang('email'); ?> <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="email" class="form-control" name="p_email" id="p_email" value='<?php
                                                                                                                                if (!empty($payment)) {
                                                                                                                                    echo $patients->email;
                                                                                                                                } elseif (!empty($draft->patient_email)) {
                                                                                                                                    echo $draft->patient_email;
                                                                                                                                }
                                                                                                                                ?>'>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="p_phone" class="form-label">
                                                        <?php echo lang('patient') . ' ' . lang('phone'); ?> <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="p_phone" id="p_phone" value='<?php
                                                                                                                                if (!empty($payment)) {
                                                                                                                                    echo $patients->phone;
                                                                                                                                } elseif (!empty($draft->patient_phone)) {
                                                                                                                                    echo $draft->patient_phone;
                                                                                                                                }
                                                                                                                                ?>'>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="p_birth" class="form-label">
                                                        <?php echo lang('patient') . ' ' . lang('birth_date'); ?>
                                                    </label>
                                                    <input type="text" class="form-control datepicker" id="p_birth" name="p_birth" value='<?php
                                                                                                                                            if (!empty($payment)) {
                                                                                                                                                echo $patients->birthdate;
                                                                                                                                            } elseif (!empty($draft->birthdate)) {
                                                                                                                                                echo $draft->birthdate;
                                                                                                                                            }
                                                                                                                                            ?>' readonly>
                                                </div>
                                                <div class="col-md-8 mb-3">
                                                    <label class="form-label">
                                                        <?php echo lang('patient') . ' ' . lang('age'); ?>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="number" min="0" max="150" class="form-control" name="years" placeholder="<?php echo lang('years'); ?>" value='<?php
                                                                                                                                                                                    if (!empty($payment)) {
                                                                                                                                                                                        echo $age[0];
                                                                                                                                                                                    } elseif (!empty($draft->age)) {
                                                                                                                                                                                        echo $age[0];
                                                                                                                                                                                    }
                                                                                                                                                                                    ?>'>
                                                        <span class="input-group-text"><?php echo lang('y'); ?></span>
                                                        <input type="number" min="0" max="12" class="form-control" name="months" placeholder="<?php echo lang('months'); ?>" value='<?php
                                                                                                                                                                                    if (!empty($payment)) {
                                                                                                                                                                                        echo $age[1];
                                                                                                                                                                                    } elseif (!empty($draft->age)) {
                                                                                                                                                                                        echo $age[1];
                                                                                                                                                                                    }
                                                                                                                                                                                    ?>'>
                                                        <span class="input-group-text"><?php echo lang('m'); ?></span>
                                                        <input type="number" min="0" max="29" class="form-control" name="days" placeholder="<?php echo lang('days'); ?>" value='<?php
                                                                                                                                                                                if (!empty($payment)) {
                                                                                                                                                                                    echo $age[2];
                                                                                                                                                                                } elseif (!empty($draft->age)) {
                                                                                                                                                                                    echo $age[2];
                                                                                                                                                                                }
                                                                                                                                                                                ?>'>
                                                        <span class="input-group-text"><?php echo lang('d'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="p_gender" class="form-label">
                                                        <?php echo lang('gender'); ?>
                                                    </label>
                                                    <select class="form-select" id="p_gender" name="p_gender">
                                                        <option value="Male" <?php
                                                                                if (!empty($patients->sex) && $patients->sex == 'Male') {
                                                                                    echo 'selected';
                                                                                } elseif (!empty($patients->patient_gender) && $patients->patient_gender == 'Male') {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>><?php echo lang('male'); ?></option>
                                                        <option value="Female" <?php
                                                                                if (!empty($patients->sex) && $patients->sex == 'Female') {
                                                                                    echo 'selected';
                                                                                } elseif (!empty($patients->patient_gender) && $patients->patient_gender == 'Female') {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>><?php echo lang('female'); ?></option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 payment pad_bot d-flex">
                                                <label for="exampleInputEmail1" class="col-sm-4">
                                                    <?php echo lang('doctor'); ?><span class="required-asterisk">&ast;</span></label>
                                                <select class="form-control col-sm-8 m-bot15  add_doctor" id="add_doctor" name="doctor" value='' required>
                                                    <?php if (!empty($payment)) { ?>
                                                        <option value="<?php echo $doctors->id; ?>" selected="selected">
                                                            <?php echo $doctors->name; ?> - <?php echo $doctors->id; ?>
                                                        </option>
                                                        <?php } elseif (!empty($draft->doctor)) {
                                                        if ($draft->doctor == 'add_new') {
                                                        ?>
                                                            <option value="<?php echo 'add_new'; ?>" selected="selected">
                                                                <?php echo lang('add_new'); ?></option>
                                                        <?php    } else {
                                                            $doctor_name = $this->doctor_model->getDoctorById($draft->doctor)->name;
                                                        ?>
                                                            <option value="<?php echo $draft->doctor; ?>" selected="selected">
                                                                <?php echo $doctor_name . '(' . lang('id') . ': ' . $draft->id . ')'; ?>
                                                            </option>

                                                    <?php    }
                                                    } ?>
                                                </select>
                                            </div>

                                            <div class="pos_doctor row my-4 bg-light py-4" style="display: none;">
                                                <div class="col-md-6 mb-3">
                                                    <label for="d_name" class="form-label"><?php echo lang('doctor') . ' ' . lang('name'); ?></label>
                                                    <input type="text" class="form-control" name="d_name" id="d_name" value="<?php echo !empty($draft->doctor) && $draft->doctor == 'add_new' && !empty($draft->doctor_name) ? $draft->doctor_name : ''; ?>" placeholder="<?php echo lang('doctor') . ' ' . lang('name'); ?>">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="d_email" class="form-label"><?php echo lang('doctor') . ' ' . lang('email'); ?></label>
                                                    <input type="email" class="form-control" name="d_email" id="d_email" value="<?php echo !empty($draft->doctor) && $draft->doctor == 'add_new' && !empty($draft->doctor_email) ? $draft->doctor_email : ''; ?>" placeholder="<?php echo lang('doctor') . ' ' . lang('email'); ?>">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="d_phone" class="form-label"><?php echo lang('doctor') . ' ' . lang('phone'); ?></label>
                                                    <input type="tel" class="form-control" name="d_phone" id="d_phone" value="<?php echo !empty($draft->doctor) && $draft->doctor == 'add_new' && !empty($draft->doctor_phone) ? $draft->doctor_phone : ''; ?>" placeholder="<?php echo lang('doctor') . ' ' . lang('phone'); ?>">
                                                </div>
                                            </div>



                                            <div class="col-md-12 payment">
                                                <div class="form-group last d-flex">
                                                    <label for="exampleInputEmail1" class="col-sm-4"> <?php echo lang(''); ?>
                                                        <?php echo lang('item'); ?><span class="required-asterisk">&ast;</span> </label>
                                                    <select name="category_name[]" class="multi-select option_select" multiple="" id="my_multi_select3" required>
                                                        <?php foreach ($categories as $category) { ?>
                                                            <option class="ooppttiioonn" data-id="<?php echo $category->c_price; ?>" data-idd="<?php echo $category->id; ?>" data-cat_name="<?php echo $category->category; ?>" value="<?php echo $category->id; ?>" <?php
                                                                                                                                                                                                                                                                        if (!empty($payment->category_name)) {
                                                                                                                                                                                                                                                                            $category_name = $payment->category_name;
                                                                                                                                                                                                                                                                            $category_name1 = explode(',', $category_name);
                                                                                                                                                                                                                                                                            foreach ($category_name1 as $category_name2) {
                                                                                                                                                                                                                                                                                $category_name3 = explode('*', $category_name2);
                                                                                                                                                                                                                                                                                if ($category_name3[0] == $category->id) {
                                                                                                                                                                                                                                                                                    echo 'data-qtity=' . $category_name3[3];
                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                        } elseif (!empty($draft->category_name)) {
                                                                                                                                                                                                                                                                            $category_name = $draft->category_name;
                                                                                                                                                                                                                                                                            $category_name1 = explode(',', $category_name);
                                                                                                                                                                                                                                                                            foreach ($category_name1 as $category_name2) {
                                                                                                                                                                                                                                                                                $category_name3 = explode('*', $category_name2);
                                                                                                                                                                                                                                                                                if ($category_name3[0] == $category->id) {
                                                                                                                                                                                                                                                                                    echo 'data-qtity=' . $category_name3[3];
                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                        ?> <?php
                                                                                                                                                                                                                                                                            if (!empty($payment->category_name)) {
                                                                                                                                                                                                                                                                                $category_name = $payment->category_name;
                                                                                                                                                                                                                                                                                $category_name1 = explode(',', $category_name);
                                                                                                                                                                                                                                                                                foreach ($category_name1 as $category_name2) {
                                                                                                                                                                                                                                                                                    $category_name3 = explode('*', $category_name2);
                                                                                                                                                                                                                                                                                    if ($category_name3[0] == $category->id) {
                                                                                                                                                                                                                                                                                        echo 'selected';
                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                            } elseif (!empty($draft->category_name)) {
                                                                                                                                                                                                                                                                                $category_name = $draft->category_name;
                                                                                                                                                                                                                                                                                $category_name1 = explode(',', $category_name);
                                                                                                                                                                                                                                                                                foreach ($category_name1 as $category_name2) {
                                                                                                                                                                                                                                                                                    $category_name3 = explode('*', $category_name2);
                                                                                                                                                                                                                                                                                    if ($category_name3[0] == $category->id) {
                                                                                                                                                                                                                                                                                        echo 'selected';
                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                            ?>>
                                                                <?php echo $category->category . ' - ' . $settings->currency . '' . $category->c_price; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>

                                                </div>

                                                <a target="_blank" href="finance/addPaymentCategoryView"><?php echo lang('add_new') ?>
                                                    <?php echo lang('item') ?> ?</a>

                                            </div>

                                            <!-- <div class="col-md-10 mt-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="col-sm-4"> <?php echo lang('report_delivery_time'); ?> &ast;</label>

                                                    <div class="input-group m-bot15">

                                                        <input type="text" class="form-control col-sm-8 default-date-picker" id="date" name="date_delivery" readonly value='<?php if (empty($payment->date_delivery)) {
                                                                                                                                                                                echo date('d-m-Y');
                                                                                                                                                                            } elseif (!empty($draft->date_delivery)) {
                                                                                                                                                                                echo $draft->date_delivery;
                                                                                                                                                                            } else {
                                                                                                                                                                                echo $payment->date_delivery;
                                                                                                                                                                            }  ?>' placeholder="">
                                                        <span class="input-group-addon">:</span>
                                                        <input type="time" class="form-control col-sm-8 input-group-addon" id="myTime" name="time_delivery" value='<?php if (empty($payment->date_delivery)) {
                                                                                                                                                                        echo '19:00';
                                                                                                                                                                    } elseif (!empty($draft->time_delivery)) {
                                                                                                                                                                        echo $draft->time_delivery;
                                                                                                                                                                    } else {
                                                                                                                                                                        echo $payment->time_delivery;
                                                                                                                                                                    }  ?>' placeholder="">

                                                    </div>
                                                </div>
                                            </div> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="card p-3">
                            <div class="">
                                <div class="editform">
                                    <div class="form-row">
                                        <div class="col-md-12">


                                            <div class="col-md-12 qfloww">

                                                <label class=" col-md-10 float-left remove1"><?php echo lang('items') ?></label><label class="float-right col-md-2 remove"><?php echo lang('qty') ?></label>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="card">
                            <div class="p-3">
                                <div class="editform">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="col-md-12 payment d-flex">
                                                <div class="payment_label col-sm-5" style="margin-top: -3px;">
                                                    <label for="exampleInputEmail1" class=""><?php echo lang('sub_total'); ?>
                                                    </label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control pay_in" name="subtotal" id="subtotal" value='<?php
                                                                                                                                        if (!empty($payment->amount)) {
                                                                                                                                            echo $payment->amount;
                                                                                                                                        } elseif (!empty($draft->amount)) {
                                                                                                                                            echo $draft->amount;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder=" " disabled>
                                                </div>

                                            </div>


                                            <div class="col-md-12 payment d-flex">

                                                <div class="payment_label col-sm-5">
                                                    <label for="exampleInputEmail1" class=""><?php echo lang('discount'); ?> <?php
                                                                                                                                if ($discount_type == 'percentage') {
                                                                                                                                    echo ' (%)';
                                                                                                                                }
                                                                                                                                ?>
                                                    </label>
                                                </div>
                                                <div class="input-group m-bot15 col-sm-7">
                                                    <input type="number" class="form-control pay_in percent_input" min="0" max="100" step="0.01" name="percent_discount" id="dis_id_percent" value='<?php
                                                                                                                                                                                                    if (!empty($payment->percent_discount)) {
                                                                                                                                                                                                        $percent_discount = explode('*', $payment->percent_discount);
                                                                                                                                                                                                        echo $percent_discount[0];
                                                                                                                                                                                                    } elseif (!empty($draft->percent_discount)) {
                                                                                                                                                                                                        $percent_discount = explode('*', $draft->percent_discount);
                                                                                                                                                                                                        echo $percent_discount[0];
                                                                                                                                                                                                    } else {
                                                                                                                                                                                                        echo $settings->discount_percent;
                                                                                                                                                                                                    }
                                                                                                                                                                                                    ?>' placeholder="">
                                                    <span class="input-group-addon percent_amount" id="mailExtension">%
                                                    </span>

                                                    </span>
                                                    <input type="number" class="form-control col-sm-8 pay_in percent_input" step="0.01" name="discount" id="dis_id" value='<?php
                                                                                                                                                                            if (!empty($payment->discount)) {
                                                                                                                                                                                $discount = explode('*', $payment->discount);
                                                                                                                                                                                echo $discount[0];
                                                                                                                                                                            } elseif (!empty($draft->discount)) {
                                                                                                                                                                                $discount = explode('*', $draft->discount);
                                                                                                                                                                                echo $discount[0];
                                                                                                                                                                            } else {
                                                                                                                                                                                echo '0';
                                                                                                                                                                            }
                                                                                                                                                                            ?>' placeholder="">
                                                    <span class="input-group-addon percent_amount" id="mailExtension"><?php echo $settings->currency; ?>
                                                </div>


                                            </div>

                                            <div class="col-md-12 payment">
                                                <div class="d-flex">
                                                    <div class="payment_label col-sm-5">
                                                        <label for="exampleInputEmail1" class=""><?php echo lang('vat'); ?> </label>
                                                    </div>
                                                    <div class="input-group col-sm-7">
                                                        <input type="number" class="form-control pay_in percent_input" min="0" max="100" step="0.01" name="vat" id="vat" value='<?php
                                                                                                                                                                                if (!empty($payment->vat_amount_percent)) {
                                                                                                                                                                                    echo $payment->vat_amount_percent;
                                                                                                                                                                                } elseif (!empty($draft->vat_amount_percent)) {
                                                                                                                                                                                    echo $draft->vat_amount_percent;
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo $settings->vat;
                                                                                                                                                                                }
                                                                                                                                                                                ?>' placeholder="">
                                                        <span class="input-group-addon percent_amount" id="mailExtension">%
                                                        </span>

                                                        </span>
                                                        <input type="number" class="form-control col-sm-8 pay_in percent_input" step="0.01" name="vat_amount" id="vat_amount" value='<?php
                                                                                                                                                                                        if (!empty($payment->vat)) {
                                                                                                                                                                                            echo $payment->vat;
                                                                                                                                                                                        } elseif (!empty($draft->vat)) {
                                                                                                                                                                                            echo $draft->vat;
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo '0';
                                                                                                                                                                                        }
                                                                                                                                                                                        ?>' placeholder="">
                                                        <span class="input-group-addon percent_amount"><?php echo $settings->currency; ?>

                                                    </div>
                                                </div>
                                                <span style="font-style: italic; font-weight: 400; color: #F05;">
                                                    <?php echo $settings->vat; ?> % Value Added Tax
                                                </span>
                                            </div>

                                            <div class="col-md-12 payment d-flex">
                                                <div class="payment_label col-sm-5">
                                                    <label for="exampleInputEmail1" class=""><?php echo lang('gross_total'); ?>
                                                    </label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control pay_in" name="grsss" id="gross" value='<?php
                                                                                                                                    if (!empty($payment->gross_total)) {
                                                                                                                                        echo $payment->gross_total;
                                                                                                                                    } elseif (!empty($draft->gross_total)) {
                                                                                                                                        echo $draft->gross_total;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder=" " disabled>
                                                </div>

                                            </div>


                                            <div class="col-md-12 payment d-flex">
                                                <div class="payment_label col-sm-5">
                                                    <label for="exampleInputEmail1" class=""><?php echo lang('note'); ?> </label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <textarea class="form-control" name="remarks" rows="2" cols="20">
                                                    <?php
                                                    if (!empty($payment->remarks)) {
                                                        echo $payment->remarks;
                                                    } elseif (!empty($draft->remarks)) {
                                                        echo $draft->remarks;
                                                    }
                                                    ?> </textarea>
                                                </div>

                                            </div>

                                            <div class="col-md-12 payment d-flex">

                                                <div class="payment_label col-sm-5">
                                                    <label for="exampleInputEmail1" class=""><?php
                                                                                                if (empty($payment)) {
                                                                                                    echo lang('deposited_amount');
                                                                                                } else {
                                                                                                    echo lang('deposit') . ' 1 <br>';
                                                                                                    echo date('d/m/Y', $payment->date);
                                                                                                };
                                                                                                ?> </label>
                                                </div>

                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control pay_in" name="amount_received" id="amount_received" value='<?php
                                                                                                                                                        if (!empty($payment->amount_received)) {
                                                                                                                                                            echo $payment->amount_received;
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder=" " <?php
                                                                                                                                                                            if (!empty($payment->deposit_type)) {
                                                                                                                                                                                if ($payment->deposit_type == 'Card') {
                                                                                                                                                                                    echo 'readonly';
                                                                                                                                                                                }
                                                                                                                                                                            }
                                                                                                                                                                            ?>>
                                                </div>

                                            </div>


                                            <div class="col-md-12 payment d-flex">
                                                <div class="payment_label col-sm-5">
                                                    <label for="exampleInputEmail1" class=""><?php echo lang('due'); ?> </label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control pay_in" name="due" id="due" value='<?php

                                                                                                                                if (!empty($payment)) {
                                                                                                                                    $deposit = $this->finance_model->getDepositByInvoiceId($payment->id);
                                                                                                                                    if (!empty($deposit)) {
                                                                                                                                        foreach ($deposit as $depos) {
                                                                                                                                            $deposits[] = $depos->deposited_amount;
                                                                                                                                        }
                                                                                                                                        $depos_amount = array_sum($deposits);
                                                                                                                                    } else {
                                                                                                                                        $depos_amount = 0;
                                                                                                                                    }
                                                                                                                                    echo $depos_amount;
                                                                                                                                } elseif (!empty($draft->gross_total)) {
                                                                                                                                    if (!empty($draft->amount_received)) {
                                                                                                                                        echo ($draft->gross_total - $draft->amount_received);
                                                                                                                                    } else {
                                                                                                                                        echo $draft->gross_total;
                                                                                                                                    }
                                                                                                                                } else {
                                                                                                                                    echo '0';
                                                                                                                                }
                                                                                                                                ?>' placeholder=" " disabled>
                                                </div>

                                            </div>


                                            <?php if (empty($payment->id)) { ?>
                                                <div class="col-md-12 payment">
                                                    <div class="d-flex">
                                                        <div class="payment_label col-sm-5">
                                                            <label for="exampleInputEmail1" class=""><?php echo lang('type'); ?></label>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <select class="form-control m-bot15 js-example-basic-single selecttype" id="selecttype" name="deposit_type" value=''>
                                                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                                                    <option value="Cash"> <?php echo lang('cash'); ?> </option>
                                                                    <option value="Insurance"> <?php echo lang('insurance'); ?>
                                                                    </option>
                                                                    <option value="Card"> <?php echo lang('card'); ?> </option>
                                                                <?php } ?>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <?php
                                                    $payment_gateway = $settings->payment_gateway;
                                                    ?>

                                                    <div class="my-3 <?php if ($payment->deposit_type != 'Insurance') {
                                                                            echo 'hidden';
                                                                        } ?> insurance_div">
                                                        <div class="d-flex">
                                                            <div class="payment_label col-sm-5" style="">
                                                                <label for="exampleInputEmail1" class="">
                                                                    <?php echo lang('insurance'); ?>
                                                                </label>
                                                            </div>
                                                            <div class="company_div">
                                                                <select class="form-control col-sm-7 m-bot15 js-example-basic-single" name="insurance_company" id="insurance_company" value=''>
                                                                    <option value="">Company name</option>
                                                                    <?php foreach ($insurance_companys as $insurance_company) { ?>
                                                                        <option value="<?php echo $insurance_company->id; ?>" <?php
                                                                                                                                if (!empty($setval)) {
                                                                                                                                    if ($insurance_company->id == set_value('insurance_company')) {
                                                                                                                                        echo 'selected';
                                                                                                                                    }
                                                                                                                                }
                                                                                                                                if (!empty($payment->insurance_company)) {
                                                                                                                                    if ($insurance_company->id == $payment->insurance_company) {
                                                                                                                                        echo 'selected';
                                                                                                                                    }
                                                                                                                                }
                                                                                                                                ?>> <?php echo $insurance_company->name; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="">
                                                            <div class="payment_label col-sm-12" style="margin-top:10px;">
                                                                <label for="exampleInputEmail1" class=""><?php echo lang('insurance_details'); ?>
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <textarea class="form-control" name="insurance_details" rows="2" cols="20"><?php
                                                                                                                                            if (!empty($payment->insurance_details)) {
                                                                                                                                                echo $payment->insurance_details;
                                                                                                                                            } elseif (!empty($draft->insurance_details)) {
                                                                                                                                                echo $draft->insurance_details;
                                                                                                                                            }
                                                                                                                                            ?> 
                                                    </textarea>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="cardPayment" style="display: none;">

                                                        <hr>
                                                        <div class="col-md-12 payment pad_bot">
                                                            <label for="exampleInputEmail1" class=""> <?php echo lang('accepted'); ?>
                                                                <?php echo lang('cards'); ?></label>
                                                            <div class="payment pad_bot">
                                                                <img src="uploads/card.png" width="100%">
                                                            </div>
                                                        </div>

                                                        <?php
                                                        if ($payment_gateway == 'PayPal') {
                                                        ?>
                                                            <div class="col-md-12 payment pad_bot d-flex">
                                                                <label for="exampleInputEmail1" class="col-sm-5"> <?php echo lang('card'); ?>
                                                                    <?php echo lang('type'); ?></label>
                                                                <select class="form-control col-sm-7 m-bot15" name="card_type" value=''>

                                                                    <option value="Mastercard">
                                                                        <?php echo lang('mastercard'); ?> </option>
                                                                    <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                                                    <option value="American Express">
                                                                        <?php echo lang('american_express'); ?> </option>
                                                                </select>
                                                            </div>
                                                        <?php
                                                        } ?>
                                                        <?php if ($payment_gateway == 'PayPal') {
                                                        ?>
                                                            <div class="col-md-12 payment pad_bot d-flex">
                                                                <label for="exampleInputEmail1" class="col-sm-5">
                                                                    <?php echo lang(''); ?>
                                                                    <?php echo lang('name'); ?></label>
                                                                <input type="text" id="cardholder" class="form-control col-sm-7 pay_in" name="cardholder" value='' placeholder="">
                                                            </div>
                                                        <?php
                                                        } ?>
                                                        <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack' && $payment_gateway != 'SSLCOMMERZ' && $payment_gateway != 'Paytm') { ?>
                                                            <div class="col-md-12 payment pad_bot d-flex">
                                                                <label for="exampleInputEmail1" class="col-sm-5"> <?php echo lang('card'); ?>
                                                                    <?php echo lang('number'); ?></label>
                                                                <input type="text" id="card" class="form-control col-sm-7 pay_in" name="card_number" value='' placeholder="">
                                                            </div>



                                                            <div class="col-md-12 payment pad_bot d-flex">
                                                                <label for="exampleInputEmail1" class="col-sm-5"> <?php echo lang('expire'); ?>
                                                                    <?php echo lang('date'); ?></label>
                                                                <input type="text" class="form-control col-sm-7 pay_in" id="expire" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="">
                                                            </div>
                                                            <div class="col-md-12 payment pad_bot d-flex">
                                                                <label for="exampleInputEmail1" class="col-sm-5"> <?php echo lang('cvv'); ?>
                                                                </label>
                                                                <input type="text" class="form-control col-sm-7 pay_in" id="cvv" maxlength="3" name="cvv" value='' placeholder="">
                                                            </div>

                                                    </div>

                                                <?php
                                                        }
                                                ?>

                                                </div>
                                            <?php } ?>

                                            <?php
                                            if (!empty($payment)) {
                                                $deposits = $this->finance_model->getDepositByPaymentId($payment->id);
                                                $i = 1;
                                                foreach ($deposits as $deposit) {
                                                    if (empty($deposit->amount_received_id)) {
                                                        $i = $i + 1; ?>
                                                        <div class="col-md-12 payment">
                                                            <div class="payment_label">
                                                                <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('deposit'); ?>
                                                                    <?php
                                                                    echo $i . '<br>';
                                                                    echo date('d/m/Y', $deposit->date); ?>
                                                                </label>
                                                            </div>
                                                            <div class="">
                                                                <input type="text" class="form-control col-sm-8 pay_in" name="deposit_edit_amount[]" id="amount_received" value='<?php echo $deposit->deposited_amount; ?>' <?php
                                                                                                                                                                                                                            if ($deposit->deposit_type == 'Card') {
                                                                                                                                                                                                                                echo 'readonly';
                                                                                                                                                                                                                            } ?>>
                                                                <input type="hidden" class="form-control col-sm-8 pay_in" name="deposit_edit_id[]" id="amount_received" value='<?php echo $deposit->id; ?>' placeholder=" ">
                                                            </div>

                                                        </div>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            <input type="hidden" name="id" id="id_pay" value='<?php
                                                                                                if (!empty($payment->id)) {
                                                                                                    echo $payment->id;
                                                                                                }
                                                                                                ?>'>
                                            <input type="hidden" name="draft_id" id="draft_id" value='<?php
                                                                                                        if (!empty($draft->id)) {
                                                                                                            echo $draft->id;
                                                                                                        }
                                                                                                        ?>'>
                                            <div class="col-md-12">
                                                <div class="form-group cashsubmit">
                                                    <button type="submit" name="form_submit" value="save" id="submit1" class="btn btn-sm btn-primary btn-block float-left mb-1 mr-1">
                                                        <?php echo lang('save'); ?></button>
                                                </div>
                                                <div class="form-group cardsubmit d-none">
                                                    <button type="submit" name="form_submit" value="save" id="submit-btn" class="btn btn-sm btn-primary btn-block float-left mb-1 mr-1" <?php if ($settings->payment_gateway == 'Stripe') {
                                                                                                                                                                                        ?>onClick="stripePay(event);" <?php
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                        ?>>
                                                        <?php echo lang('save'); ?></button>
                                                </div>


                                                <div class="form-group cashsubmit2">
                                                    <button type="submit" name="form_submit" value="saveandprint" id="submit2" class="btn btn-sm btn-block btn-info float-left mb-1 mr-1">
                                                        <?php echo lang('save_and_print'); ?></button>
                                                </div>
                                                <div class="form-group cardsubmit3 d-none">
                                                    <button type="submit" name="form_submit" value="saveandprint" id="submit-btn2" class="btn btn-sm btn-block btn-secondary float-left mb-1 mr-1" <?php if ($settings->payment_gateway == 'Stripe') {
                                                                                                                                                                                                    ?>onClick="stripePay(event);" <?php
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                    ?>>
                                                        <?php echo lang('save_and_print'); ?></button>
                                                </div>
                                                <?php if (empty($payment)) { ?>
                                                    <div class="form-group">
                                                        <button type="submit" name="form_submit" value="save_as_draft" id="save_as_draft" class="btn btn-sm btn-block btn-warning float-left mb-1 mr-1">
                                                            <?php echo lang('save_as_draft'); ?></button>
                                                    </div>
                                                <?php   } ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                </form>
                <?php if (!empty($draft->doctor)) {
                    if ($draft->doctor == 'add_new') {
                        $add_doctor = 'yes';
                    } else {
                        $add_doctor = 'no';
                    }
                } else {
                    $add_doctor = 'no';
                } ?>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>




<style>
    #my_multi_select3 {
        display: none;
    }
</style>




<!--sidebar end-->
<!--main content start-->

<!--main content end-->
<!--footer start-->
<?php if (!empty($gateway->publish)) {
    $gateway_stripe = $gateway->publish;
} else {
    $gateway_stripe = '';
} ?>


<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var discount_type = "<?php echo $discount_type; ?>";
</script>
<script type="text/javascript">
    var add_doctor = "<?php echo $add_doctor; ?>";
</script>
<script type="text/javascript">
    var currency = "<?php echo $settings->currency; ?>";
</script>
<script type="text/javascript">
    var publish = "<?php echo $gateway_stripe; ?>";
</script>
<script src="common/js/moment.min.js"></script>
<script type="text/javascript">
    var payment_gateway = "<?php echo $settings->payment_gateway; ?>";
</script>
<script src="common/extranal/js/finance/add_payment_view.js"></script>