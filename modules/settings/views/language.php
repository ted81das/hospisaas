<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="text-primary fw-bold"><i class="fas fa-language mr-2"></i><strong class="text-primary"><?php echo lang('select'); ?> <?php echo lang('default'); ?> <?php echo lang('language'); ?></strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php echo lang('select'); ?> <?php echo lang('language'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <?php echo lang('select'); ?> <?php echo lang('language'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" class="clearfix pos form1" id="editSaleForm" action="settings/changeLanguage" method="post" enctype="multipart/form-data">
                                <div class="form-group col-md-8">
                                    <select class="form-control js-example-basic-single" name="language" value=''>

                                        <?php
                                        $d_languages = $this->db->get('language')->result();
                                        foreach ($d_languages as $d_language) {
                                        ?>

                                            <option value="<?php echo $d_language->language; ?>" <?php
                                                                                                    if (!empty($settings->language)) {
                                                                                                        if ($settings->language == $d_language->language) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    }
                                                                                                    ?>><?php echo $d_language->language; ?>
                                            </option>

                                        <?php } ?>




                                        <!-- <option value="english" <?php
                                                                        if (!empty($settings->language)) {
                                                                            if ($settings->language == 'english') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        ?>><?php echo lang('english'); ?>
                                        </option>

                                        <option value="spanish" <?php
                                                                if (!empty($settings->language)) {
                                                                    if ($settings->language == 'spanish') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>><?php echo lang('spanish'); ?>
                                        </option>
                                        <option value="french" <?php
                                                                if (!empty($settings->language)) {
                                                                    if ($settings->language == 'french') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>><?php echo lang('french'); ?>
                                        </option>
                                        <option value="italian" <?php
                                                                if (!empty($settings->language)) {
                                                                    if ($settings->language == 'italian') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>><?php echo lang('italian'); ?>
                                        </option>
                                        <option value="portuguese" <?php
                                                                    if (!empty($settings->language)) {
                                                                        if ($settings->language == 'portuguese') {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                    ?>><?php echo lang('portuguese'); ?>
                                        </option>

                                        <option value="turkish" <?php
                                                                if (!empty($settings->language)) {
                                                                    if ($settings->language == 'turkish') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>><?php echo lang('turkish'); ?>
                                        </option> -->




                                    </select>
                                </div>

                                <input type="hidden" name="language_settings" value='language_settings'>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($settings->id)) {
                                                                            echo $settings->id;
                                                                        }
                                                                        ?>'>

                                <div class="form-group col-md-12">
                                    <button type="submit" name="submit" class="btn btn-sm btn-info"> <?php echo lang('submit'); ?></button>
                                </div>

                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> <?php echo lang('edit'); ?> <?php echo lang('language'); ?> </h3>
                                <button class="btn btn-md btn-success float-right" data-toggle="modal" href="#myModal"><?php echo lang('add_new'); ?></button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="">
                                    <div class="">
                                        <div class="panel-body table_div">
                                            <div class="adv-table editable-table ">
                                                <div class=" panel clearfix">
                                                </div>
                                                <div class="space15"></div>
                                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th><?php echo lang('name'); ?></th>
                                                            <th><?php echo lang('options'); ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                        <?php foreach ($languages as $language) { ?>
                                                            <tr class="">
                                                                <td><?php echo '1'; ?></td>
                                                                <td><?php echo $language->language; ?> </td>
                                                                <td>
                                                                    <a class="btn btn-success  editbutton" data-id="<?php echo $language->id; ?>"> <?php echo lang('edit'); ?></a>
                                                                    <a class="btn btn-info" href="settings/languageEdit?id=<?php echo $language->language; ?>"> <?php echo lang('manage'); ?></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>



                                                    </tbody>
                                            </div>

                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                <?php } ?>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>





<!-- Add Language Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add'); ?> <?php echo lang('language'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="settings/addLanguage" class="clearfix form-row" method="post" enctype="multipart/form-data">

                    <div class="col-md-12">
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('language'); ?> </label>
                            <input type="text" class="form-control col-sm-8" name="language" value='' required="">
                        </div>



                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('flag_icon'); ?> </label>

                            <select name="flag_icon" class="form-control">
                                <option value="sa"><i class="flag-icon flag-icon-sa mr-2"></i> Arabic</option> <!-- Saudi Arabian flag -->
                                <option value="bd"><i class="flag-icon flag-icon-bd mr-2"></i> Bengali</option> <!-- Bangladeshi flag -->
                                <option value="cs"><i class="flag-icon flag-icon-cz mr-2"></i> Czech</option> <!-- Czech Republic flag -->
                                <option value="da"><i class="flag-icon flag-icon-dk mr-2"></i> Danish</option> <!-- Danish flag -->
                                <option value="de"><i class="flag-icon flag-icon-de mr-2"></i> German</option> <!-- German flag -->
                                <option value="el"><i class="flag-icon flag-icon-gr mr-2"></i> Greek</option> <!-- Greek flag -->
                                <option value="us"><i class="flag-icon flag-icon-gb mr-2"></i> English</option> <!-- British flag -->
                                <option value="es"><i class="flag-icon flag-icon-es mr-2"></i> Spanish</option> <!-- Spanish flag -->
                                <option value="fi"><i class="flag-icon flag-icon-fi mr-2"></i> Finnish</option> <!-- Finnish flag -->
                                <option value="fr"><i class="flag-icon flag-icon-fr mr-2"></i> French</option> <!-- French flag -->
                                <option value="he"><i class="flag-icon flag-icon-il mr-2"></i> Hebrew</option> <!-- Israeli flag -->
                                <option value="in"><i class="flag-icon flag-icon-in mr-2"></i> Hindi</option> <!-- Indian flag -->
                                <option value="hu"><i class="flag-icon flag-icon-hu mr-2"></i> Hungarian</option> <!-- Hungarian flag -->
                                <option value="id"><i class="flag-icon flag-icon-id mr-2"></i> Indonesian</option> <!-- Indonesian flag -->
                                <option value="it"><i class="flag-icon flag-icon-it mr-2"></i> Italian</option> <!-- Italian flag -->
                                <option value="ja"><i class="flag-icon flag-icon-jp mr-2"></i> Japanese</option> <!-- Japanese flag -->
                                <option value="ko"><i class="flag-icon flag-icon-kr mr-2"></i> Korean</option> <!-- South Korean flag -->
                                <option value="ms"><i class="flag-icon flag-icon-my mr-2"></i> Malay</option> <!-- Malaysian flag -->
                                <option value="nl"><i class="flag-icon flag-icon-nl mr-2"></i> Dutch</option> <!-- Dutch flag -->
                                <option value="no"><i class="flag-icon flag-icon-no mr-2"></i> Norwegian</option> <!-- Norwegian flag -->
                                <option value="pl"><i class="flag-icon flag-icon-pl mr-2"></i> Polish</option> <!-- Polish flag -->
                                <option value="pt"><i class="flag-icon flag-icon-pt mr-2"></i> Portuguese</option> <!-- Portuguese flag -->
                                <option value="ro"><i class="flag-icon flag-icon-ro mr-2"></i> Romanian</option> <!-- Romanian flag -->
                                <option value="ru"><i class="flag-icon flag-icon-ru mr-2"></i> Russian</option> <!-- Russian flag -->
                                <option value="sv"><i class="flag-icon flag-icon-se mr-2"></i> Swedish</option> <!-- Swedish flag -->
                                <option value="th"><i class="flag-icon flag-icon-th mr-2"></i> Thai</option> <!-- Thai flag -->
                                <option value="tr"><i class="flag-icon flag-icon-tr mr-2"></i> Turkish</option> <!-- Turkish flag -->
                                <option value="vi"><i class="flag-icon flag-icon-vn mr-2"></i> Vietnamese</option> <!-- Vietnamese flag -->
                                <option value="zh"><i class="flag-icon flag-icon-cn mr-2"></i> Chinese</option> <!-- Chinese flag -->
                            </select>

                        </div>


                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('description'); ?> </label>
                            <input type="text" class="form-control col-sm-8" name="description" value='' placeholder="" required="">
                        </div>

                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('status'); ?> </label>
                            <select class="form-control col-sm-8" name="status" value='' required="">
                                <option value="1"><?php echo lang('active'); ?></option>
                                <option value="0"><?php echo lang('inactive'); ?></option>
                            </select>
                        </div>


                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right row"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->


<!-- Edit Language Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add'); ?> <?php echo lang('language'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="settings/addLanguage" id="editLanguageForm" class="clearfix form-row" method="post" enctype="multipart/form-data">

                    <div class="col-md-12">
                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('language'); ?> </label>
                            <input type="text" class="form-control col-sm-8" name="language" value='' required="" readonly>
                        </div>


                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('flag_icon'); ?> </label>

                            <select name="flag_icon" class="form-control">
                                <option value="sa"><i class="flag-icon flag-icon-sa mr-2"></i> Arabic</option> <!-- Saudi Arabian flag -->
                                <option value="bd"><i class="flag-icon flag-icon-bd mr-2"></i> Bengali</option> <!-- Bangladeshi flag -->
                                <option value="cs"><i class="flag-icon flag-icon-cz mr-2"></i> Czech</option> <!-- Czech Republic flag -->
                                <option value="da"><i class="flag-icon flag-icon-dk mr-2"></i> Danish</option> <!-- Danish flag -->
                                <option value="de"><i class="flag-icon flag-icon-de mr-2"></i> German</option> <!-- German flag -->
                                <option value="el"><i class="flag-icon flag-icon-gr mr-2"></i> Greek</option> <!-- Greek flag -->
                                <option value="us"><i class="flag-icon flag-icon-gb mr-2"></i> English</option> <!-- British flag -->
                                <option value="es"><i class="flag-icon flag-icon-es mr-2"></i> Spanish</option> <!-- Spanish flag -->
                                <option value="fi"><i class="flag-icon flag-icon-fi mr-2"></i> Finnish</option> <!-- Finnish flag -->
                                <option value="fr"><i class="flag-icon flag-icon-fr mr-2"></i> French</option> <!-- French flag -->
                                <option value="he"><i class="flag-icon flag-icon-il mr-2"></i> Hebrew</option> <!-- Israeli flag -->
                                <option value="in"><i class="flag-icon flag-icon-in mr-2"></i> Hindi</option> <!-- Indian flag -->
                                <option value="hu"><i class="flag-icon flag-icon-hu mr-2"></i> Hungarian</option> <!-- Hungarian flag -->
                                <option value="id"><i class="flag-icon flag-icon-id mr-2"></i> Indonesian</option> <!-- Indonesian flag -->
                                <option value="it"><i class="flag-icon flag-icon-it mr-2"></i> Italian</option> <!-- Italian flag -->
                                <option value="ja"><i class="flag-icon flag-icon-jp mr-2"></i> Japanese</option> <!-- Japanese flag -->
                                <option value="ko"><i class="flag-icon flag-icon-kr mr-2"></i> Korean</option> <!-- South Korean flag -->
                                <option value="ms"><i class="flag-icon flag-icon-my mr-2"></i> Malay</option> <!-- Malaysian flag -->
                                <option value="nl"><i class="flag-icon flag-icon-nl mr-2"></i> Dutch</option> <!-- Dutch flag -->
                                <option value="no"><i class="flag-icon flag-icon-no mr-2"></i> Norwegian</option> <!-- Norwegian flag -->
                                <option value="pl"><i class="flag-icon flag-icon-pl mr-2"></i> Polish</option> <!-- Polish flag -->
                                <option value="pt"><i class="flag-icon flag-icon-pt mr-2"></i> Portuguese</option> <!-- Portuguese flag -->
                                <option value="ro"><i class="flag-icon flag-icon-ro mr-2"></i> Romanian</option> <!-- Romanian flag -->
                                <option value="ru"><i class="flag-icon flag-icon-ru mr-2"></i> Russian</option> <!-- Russian flag -->
                                <option value="sv"><i class="flag-icon flag-icon-se mr-2"></i> Swedish</option> <!-- Swedish flag -->
                                <option value="th"><i class="flag-icon flag-icon-th mr-2"></i> Thai</option> <!-- Thai flag -->
                                <option value="tr"><i class="flag-icon flag-icon-tr mr-2"></i> Turkish</option> <!-- Turkish flag -->
                                <option value="vi"><i class="flag-icon flag-icon-vn mr-2"></i> Vietnamese</option> <!-- Vietnamese flag -->
                                <option value="zh"><i class="flag-icon flag-icon-cn mr-2"></i> Chinese</option> <!-- Chinese flag -->
                            </select>

                        </div>






                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('description'); ?> </label>
                            <input type="text" class="form-control col-sm-8" name="description" value='' placeholder="" required="">
                        </div>

                        <div class="form-group d-flex">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('status'); ?> </label>
                            <select class="form-control col-sm-8" name="status" value='' required="">
                                <option value="1"><?php echo lang('active'); ?></option>
                                <option value="0"><?php echo lang('inactive'); ?></option>
                            </select>
                        </div>

                        <input type="hidden" name="id" value="">


                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right row"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->





<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/settings/language.js"></script>

<script>
    $(document).ready(function() {
        $(".table").on("click", ".editbutton", function() {
            $("#loader").show();
            "use strict";
            var iid = $(this).attr("data-id");
            $("#editLanguageForm").trigger("reset");

            $.ajax({
                url: "settings/editLanguageJason?id=" + iid,
                method: "GET",
                data: "",
                dataType: "json",
                success: function(response) {
                    "use strict";
                    $("#editLanguageForm")
                        .find('[name="id"]')
                        .val(response.language.id)
                        .end();
                    $("#editLanguageForm")
                        .find('[name="language"]')
                        .val(response.language.language)
                        .end();
                    $("#editLanguageForm")
                        .find('[name="flag_icon"]')
                        .val(response.language.flag_icon)
                        .end();
                    $("#editLanguageForm")
                        .find('[name="description"]')
                        .val(response.language.description)
                        .end();
                    $("#editLanguageForm")
                        .find('[name="status"]')
                        .val(response.language.status)
                        .end();

                    $("#loader").hide();

                    $("#myModal2").modal("show");


                },
            });
        });
    });
</script>