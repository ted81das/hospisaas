<!DOCTYPE html>
<html lang="en">
<?php
$settings = $this->frontend_model->getSettings();
$title = explode(' ', $settings->title);
?>

<head>
  <base href="<?php echo base_url(); ?>" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $settings->title; ?></title>
  <link rel="stylesheet" href="new-fnt/index.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,800;1,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/country-select-js@2.1.0/build/css/countrySelect.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">

</head>

<body>
  <main class="h-full relative bg-gradient-to-b from-white to-gray-100">
    <div class="h-full banner relative p-3">
      <nav class="flex justify-between items-center h-16 w-full z-[50px] px-4 bg-transparent text-black z-10">
        <div class="container mx-auto px-4 lg:px-7 flex justify-between items-center">
          <div class="flex gap-10 items-center">
            <?php
            if (!empty($settings->logo)) {
              if (file_exists($settings->logo)) {
                echo '<img width="100" class="z-[10000]" src=' . $settings->logo . '>';
              } else {
                echo $title[0] . '<span> ' . $title[1] . '</span>';
              }
            } else {
              echo $title[0] . '<span> ' . $title[1] . '</span>';
            }
            ?>
            <div class="flex gap-10 hidden sm:flex">
              <a href="#features">
                <p class="py-2 menu-item"><?php echo lang('service'); ?></p>
              </a>
              <a href="#package">
                <p class="py-2 menu-item"><?php echo lang('package'); ?></p>
              </a>
              <a href="#review">
                <p class="py-2 menu-item"><?php echo lang('review'); ?></p>
              </a>
              <a href="#faq">
                <p class="py-2 menu-item"><?php echo lang('faq'); ?></p>
              </a>
              <a href="#contact">
                <p class="py-2 mr-28 menu-item"><?php echo lang('contact'); ?></p>
              </a>
            </div>
          </div>
          <div class="flex justify-end items-center space-x-4 lg:flex hidden">
            <div class="pt-5 menu-item">
              <?php
              if ($this->ion_auth->logged_in() == '1') {
                $current_user = $this->ion_auth->get_user_id();
                $username = $this->db->get_where('users', array('id' => $current_user))->row()->username;
                $username_explode = explode(' ', $username);
                if (count($username_explode) > 3) {
                  $username_update = $username_explode[0] . ' ' . $username_explode[1];
                } else {
                  $username_update = $username;
                }
                $link = "home";
                $link_lang = $username_update;
              } else {
                $link = "auth/login";
                $link_lang = lang('login');
              }
              ?>
              <a href="<?php echo $link; ?>" target="_blank" style="margin-right:85px;">
                <p class="py-2"><?php echo $link_lang; ?></p>
              </a>
              <?php
              if ($this->language == 'arabic') {
                $flagIcon = 'sa';
              } elseif ($this->language == 'english') {
                $flagIcon = 'us';
              } elseif ($this->language == 'spanish') {
                $flagIcon = 'es';
              } elseif ($this->language == 'french') {
                $flagIcon = 'fr';
              } elseif ($this->language == 'italian') {
                $flagIcon = 'it';
              } elseif ($this->language == 'portuguese') {
                $flagIcon = 'pt';
              } elseif ($this->language == 'turkish') {
                $flagIcon = 'tr';
              }
              ?>
              <style>
                .flag {
                  margin-top: 25px;
                  margin-right: 4% !important;
                  border: 1px solid gray;
                  padding: 5px;
                  position: absolute;
                }

                .dropdown-item {
                  text-align: left;
                }
              </style>
            </div>
            <ul class="navbar-nav ml-auto mr-3">
              <li class="nav-item relative">
                <button type="button" class="btn btn-default btn-sm flex items-center" id="dropdownButton">
                  <i class="flag-icon flag-icon-<?php echo $flagIcon; ?>"></i>
                  <span class="ml-2 text-lg capitalize menu-item"><?php echo $this->language; ?></span>
                  <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </button>
                <div id="dropdownMenu" class="dropdown-menu absolute hidden right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-50">
                  <?php
                  $languages = $this->db->get('language')->result();
                  foreach ($languages as $language) {
                  ?>
                    <a href="frontend/chooseLanguage?lang=<?php echo $language->language ?>" class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 <?php if ($this->language == $language->language) echo 'active'; ?>">
                      <i class="flag-icon flag-icon-<?php echo $language->flag_icon; ?> mr-2"></i> <?php echo $language->language; ?>
                    </a>
                  <?php } ?>
                </div>
              </li>
            </ul>
            <div class="border-[2px] flex_center p-2 brand_color register_button">
              <a href="#register">
                <p><?php echo lang('register_hospital'); ?></p>
              </a>
            </div>
          </div>
          <div id="menu" class="block lg:hidden z-[20000]">
            <icon class="fa fa-bars"></icon>
          </div>
        </div>
        <div class="hidden flex-col justify-start transition-all duration-300 items-start absolute top-0 left-0 menu_items bg-white w-full h-screen z-[1000] p-6 transition-opacity transition-transform duration-300 ease-in-out">
          <a href="#facilitie">
            <p class="py-2"><?php echo lang('Facilities'); ?></p>
          </a>
          <a href="#features">
            <p class="py-2"><?php echo lang('service'); ?></p>
          </a>
          <a href="#package">
            <p class="py-2"><?php echo lang('package'); ?></p>
          </a>
          <a href="#contact">
            <p class="py-2"><?php echo lang('contact'); ?></p>
          </a>
          <div class="border-[#00B838] border-[2px] flex_center p-2 brand_color">
            <a href="#register">
              <p><?php echo lang('register_hospital'); ?></p>
            </a>
            <i class="fa-solid fa-arrow-right-long"></i>
          </div>
          <a href="<?php echo $link; ?>">
            <p class="py-2"><?php echo $link_lang; ?></p>
          </a>
          <div class="flex_center space-x-2 border-[.5px] border-gray-300 p-1">
            <img src="new-fnt/assets/images/america.jpg" class="w-4 h-4" alt="" />
            <p>English</p>
          </div>
        </div>
      </nav>
      <!-- first section -->
      <?php
      foreach ($slides as $slide) {
      ?>
        <div class="hero_section py-16 lg:py-24">
          <div class="container mx-auto px-4 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between">
              <div class="w-full lg:w-1/2 mb-12 lg:mb-0">
                <div class="text-left max-w-xl">
                  <h1 class="text-4xl md:text-5xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                    <?php echo ucwords(strtolower($slide->text1)); ?>
                  </h1>
                  <p class="text-xl text-gray-300 mb-24">
                    <?php echo $slide->text2; ?>
                  </p>
                  <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="<?php echo $slide->text3; ?>" target="_blank" class="inline-block">
                      <button class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white rounded-lg text-lg font-semibold hover:bg-blue-700 transition duration-300 shadow-lg">
                        <?php echo lang('register'); ?>
                      </button>
                    </a>
                    <a href="<?php echo $slide->status; ?>" target="_blank" class="inline-block">
                      <button class="w-full sm:w-auto px-8 py-4 bg-green-500 text-white rounded-lg text-lg font-semibold hover:bg-green-600 transition duration-300 shadow-lg">
                        <?php echo lang('Buy Now'); ?>
                      </button>
                    </a>
                  </div>
                </div>
              </div>
              <div class="w-full lg:w-1/2 flex justify-center lg:justify-end">
                <img src="new-fnt/assets/images/home illus.svg" alt="" class="w-full max-w-lg xl:max-w-xl" />
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>



    <!-- third-section -->
    <section class="relative text-center p-8 xl:p-16 py-12 xl:py-24" id="features">
      <div class="w-full text-center pb-12 mx-auto z-40 container_area mx-auto mt-20">
        <p class="mb-4 text-blue-600 font-semibold text-lg uppercase tracking-wide">
          <?php echo lang('features'); ?>
        </p>
        <h2 class="mb-6 text-gray-800 text-4xl lg:text-5xl font-bold leading-tight">
          <?php echo $settings->partner_header_title; ?>
        </h2>
        <p class="mb-12 mx-auto max-w-2xl text-gray-600 text-xl leading-relaxed">
          <?php echo $settings->partner_header_description; ?>
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
          <div class="rounded-xl p-8 w-full text-left text-gray-800 bg-white shadow-lg transform hover:scale-105 transition-transform duration-300">
            <div class="p-4 bg-blue-100 rounded-full w-20 h-20 flex items-center justify-center mb-6">
              <img src="new-fnt/assets/images/1.svg" class="w-12 h-12" alt="" />
            </div>
            <h3 class="text-2xl font-bold mb-4 text-blue-800">
              <?php echo $settings->section_title_1; ?>
            </h3>
            <p class="text-gray-600 leading-relaxed">
              <?php echo $settings->section_description_1; ?>
            </p>
          </div>
          <div class="rounded-xl p-8 w-full text-left text-gray-800 bg-white shadow-lg transform hover:scale-105 transition-transform duration-300">
            <div class="p-4 bg-green-100 rounded-full w-20 h-20 flex items-center justify-center mb-6">
              <img src="new-fnt/assets/images/support.svg" class="w-12 h-12" alt="" />
            </div>
            <h3 class="text-2xl font-bold mb-4 text-green-800">
              <?php echo $settings->section_title_2; ?>
            </h3>
            <p class="text-gray-600 leading-relaxed">
              <?php echo $settings->section_description_2; ?>
            </p>
          </div>
          <div class="rounded-xl p-8 w-full text-left text-gray-800 bg-white shadow-lg transform hover:scale-105 transition-transform duration-300">
            <div class="p-4 bg-purple-100 rounded-full w-20 h-20 flex items-center justify-center mb-6">
              <img src="new-fnt/assets/images/health.svg" class="w-12 h-12" alt="" />
            </div>
            <h3 class="text-2xl font-bold mb-4 text-purple-800">
              <?php echo $settings->section_title_3; ?>
            </h3>
            <p class="text-gray-600 leading-relaxed">
              <?php echo $settings->section_description_3; ?>
            </p>
          </div>
        </div>
      </div>
    </section>


    <!-- Why choose our product section -->
    <section class="py-24 mx-auto px-4 xl:px-0 bg-gradient-to-b from-gray-900 to-gray-800 text-white">
      <div class="container_area mx-auto">
        <div class="text-center mb-20">
          <h3 class="text-yellow-400 font-bold text-2xl uppercase tracking-widest mb-4">
            <?php echo lang('main_factors'); ?>
          </h3>
          <h2 class="text-6xl font-extrabold text-white mb-6 leading-tight">
            <?php echo $settings->team_title; ?>
          </h2>
          <p class="text-gray-300 max-w-3xl mx-auto text-xl">
            <?php echo $settings->team_description; ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
          <div class="space-y-12">
            <div class="bg-white text-gray-900 p-8 rounded-xl shadow-2xl hover:shadow-3xl transition-shadow transform hover:-translate-y-1">
              <h4 class="text-3xl font-black text-gray-900 mb-4">
                <?php echo $settings->team_button_link; ?>
              </h4>
              <p class="text-gray-700 text-lg">
                <?php echo $settings->section_1_text_1; ?>
              </p>
            </div>

            <div class="bg-blue-900 p-8 rounded-xl shadow-2xl hover:shadow-3xl transition-shadow transform hover:-translate-y-1">
              <h4 class="text-3xl font-black text-blue-200 mb-4">
                <?php echo $settings->section_1_text_2; ?>
              </h4>
              <p class="text-blue-100 text-lg">
                <?php echo $settings->section_1_text_3; ?>
              </p>
            </div>

            <div class="bg-green-900 p-8 rounded-xl shadow-2xl hover:shadow-3xl transition-shadow transform hover:-translate-y-1">
              <h4 class="text-3xl font-black text-green-200 mb-4">
                <?php echo $settings->section_2_text_1; ?>
              </h4>
              <p class="text-green-100 text-lg">
                <?php echo $settings->section_2_text_2; ?>
              </p>
            </div>
          </div>

          <div class="space-y-12 mt-12 md:mt-24">
            <div class="bg-purple-900 p-8 rounded-xl shadow-2xl hover:shadow-3xl transition-shadow transform hover:-translate-y-1">
              <h4 class="text-3xl font-black text-purple-200 mb-4">
                <?php echo $settings->section_2_text_3; ?>
              </h4>
              <p class="text-purple-100 text-lg">
                <?php echo $settings->section_3_text_1; ?>
              </p>
            </div>

            <div class="bg-yellow-900 p-8 rounded-xl shadow-2xl hover:shadow-3xl transition-shadow transform hover:-translate-y-1">
              <h4 class="text-3xl font-black text-yellow-200 mb-4">
                <?php echo $settings->section_3_text_2; ?>
              </h4>
              <p class="text-yellow-100 text-lg">
                <?php echo $settings->section_3_text_3; ?>
              </p>
            </div>

            <div class="bg-gray-100 p-8 rounded-xl shadow-2xl hover:shadow-3xl transition-shadow transform hover:-translate-y-1">
              <h4 class="text-3xl font-black text-gray-900 mb-4">
                <?php echo $settings->team_commentator_name; ?>
              </h4>
              <p class="text-gray-700 text-xl italic font-light">
                <?php echo $settings->team_commentator_designation; ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Licence & Pricing -->
    <section class="py-24 px-4 md:px-0" id="package">
      <div class="container_area mx-auto">
        <div class="text-center mb-8">
          <p class="text-xl font-light mb-2 text-gray-800"><?php echo lang('pricing'); ?></p>
          <h2 class="text-4xl font-extrabold mb-4 text-gray-900">
            <?php echo lang('License & Pricing'); ?>
          </h2>
          <div class="toggle mx-auto rounded-[50px] border-[1px] border-black w-max mb-5">
            <button id="yearly" class="rounded-[50px] p-2 text-sm m-1 font-normal active"><?php echo lang('yearly'); ?></button>
            <button id="monthly" class="rounded-[50px] p-2 m-1 text-sm font-normal"><?php echo lang('monthly'); ?></button>
          </div>
        </div>

        <div class="flex flex-wrap justify-center gap-6">
          <?php
          foreach ($packages as $package) {
            $all_packages[] = $package;
          }
          $modules_list = ['accountant', 'appointment', 'lab', 'bed', 'department', 'donor', 'finance', 'pharmacy', 'laboratorist', 'medicine', 'nurse', 'patient', 'pharmacist', 'prescription', 'receptionist', 'report', 'notice', 'email', 'sms', 'file', 'payroll', 'attendance', 'leave', 'chat'];

          if (!empty($all_packages)) {
            $package_count = 0;
            foreach ($all_packages as $package1) {
              if ($package1->show_in_frontend == 'Yes') {
                $package_count++;
                if ($package_count > 3) {
                  echo '</div><div class="flex flex-wrap justify-center gap-6 mt-6">';
                  $package_count = 1;
                }
          ?>
                <div class="bg-white rounded-xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:scale-105 w-full sm:w-64 md:w-72 lg:w-80">
                  <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-4 text-white text-center">
                    <h3 class="text-2xl font-bold mb-1"><?php echo $package1->name; ?></h3>
                    <p class="text-3xl font-extrabold mb-1 text1"><?php echo $settings1->currency; ?> <?php echo $package1->monthly_price; ?></p>
                    <p class="text-xl font-semibold text2"><?php echo $settings1->currency; ?> <?php echo $package1->yearly_price; ?></p>
                  </div>
                  <div class="p-4">
                    <?php $modules = explode(',', $package1->module); ?>
                    <ul class="text-gray-700 mb-4 text-sm">
                      <?php
                      foreach ($modules_list as $module) {
                        $isIncluded = in_array($module, $modules);
                      ?>
                        <li class="flex items-center mb-1 <?php echo $isIncluded ? 'text-indigo-700' : 'text-gray-400'; ?>">
                          <span class="mr-2 inline-flex items-center justify-center w-5 h-5 rounded-full <?php echo $isIncluded ? 'bg-indigo-100 text-indigo-700' : 'bg-gray-100 text-gray-400'; ?> shadow">
                            <?php echo $isIncluded ? '✓' : '✗'; ?>
                          </span>
                          <?php echo ucfirst($module); ?>
                        </li>
                      <?php } ?>
                    </ul>
                    <a href="#register" class="block w-full bg-indigo-600 text-white text-center py-2 rounded-full text-base font-bold hover:bg-indigo-700 transition-colors duration-300">
                      <?php echo lang('buy_license'); ?>
                    </a>
                  </div>
                </div>
          <?php
              }
            }
          }
          ?>
        </div>
      </div>
    </section>

    <!-- Registration form -->
    <section class="py-24 bg-gradient-to-br from-indigo-900 via-purple-800 to-indigo-900 text-white" id="register">
      <div class="container mx-auto px-4">
        <div class="text-center mb-16">
          <p class="text-lg sm:text-xl font-semibold text-indigo-300 uppercase tracking-wider mb-4"><?php echo lang('join_us'); ?></p>
          <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-6xl font-black mb-6 leading-tight capitalize">
            <?php echo lang('subscribe_your_hospital'); ?>
          </h2>
          <div class="w-24 sm:w-32 h-1 sm:h-2 bg-gradient-to-r from-white to-purple-300 mx-auto rounded-full"></div>

          <p class="text-xl sm:text-2xl text-indigo-200 max-w-3xl mx-auto">
            <?php echo lang('enter_your_hospital_details_below'); ?>
          </p>
        </div>

        <div class="max-w-4xl mx-auto bg-white/90 backdrop-blur-lg rounded-xl shadow-2xl overflow-hidden">
          <div class="p-8 sm:p-10 bg-indigo-100">
            <h3 class="text-2xl sm:text-2xl font-extrabold text-indigo-900 mb-4">
              <?php echo lang('subscribe'); ?>
            </h3>
            <p class="text-lg sm:text-xl text-indigo-100">
              <?php echo lang('enter_your_hospital_details_below'); ?>
            </p>
          </div>

          <form action="frontend/addNewHospitalPayment" method="post" id="addNewHospital" enctype="multipart/form-data" class="p-6 sm:p-10 space-y-6 sm:space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
              <input placeholder="<?php echo lang('Hospital Name'); ?>*" type="text" name="name" class="w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl border-2 border-indigo-300 bg-white text-gray-800 placeholder-gray-500 focus:border-indigo-400 focus:ring focus:ring-indigo-300 transition duration-300 text-sm sm:text-base">
              <input placeholder="<?php echo lang('Hospital Address'); ?>*" type="text" name="address" class="w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl border-2 border-indigo-300 bg-white text-gray-800 placeholder-gray-500 focus:border-indigo-400 focus:ring focus:ring-indigo-300 transition duration-300 text-sm sm:text-base">
              <input placeholder="<?php echo lang('Hospital Email'); ?>*" type="email" name="email" class="w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl border-2 border-indigo-300 bg-white text-gray-800 placeholder-gray-500 focus:border-indigo-400 focus:ring focus:ring-indigo-300 transition duration-300 text-sm sm:text-base">
              <input placeholder="<?php echo lang('Hospital Phone'); ?>*" type="phone" name="phone" class="w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl border-2 border-indigo-300 bg-white text-gray-800 placeholder-gray-500 focus:border-indigo-400 focus:ring focus:ring-indigo-300 transition duration-300 text-sm sm:text-base">

              <div class="package_select_div">
                <select name="package" id="package_select" class="w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl border-2 border-indigo-300 bg-white text-gray-800 focus:border-indigo-400 focus:ring focus:ring-indigo-300 transition duration-300 text-sm sm:text-base">
                  <option><?php echo lang('select'); ?> <?php echo lang('package'); ?></option>
                  <?php foreach ($packages as $package) {
                    if ($package->show_in_frontend == 'Yes') { ?>
                      <option value="<?php echo $package->id; ?>"><?php echo $package->name; ?></option>
                  <?php }
                  } ?>
                </select>
              </div>

              <div class="package_duration_div">
                <select name="package_duration" id="package_duration" class="w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl border-2 border-indigo-300 bg-white text-gray-800 focus:border-indigo-400 focus:ring focus:ring-indigo-300 transition duration-300 text-sm sm:text-base">
                  <option value="monthly"><?php echo lang('monthly'); ?></option>
                  <option value="yearly"><?php echo lang('yearly'); ?></option>
                </select>
              </div>

              <select name="language" class="w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl border-2 border-indigo-300 bg-white text-gray-800 focus:border-indigo-400 focus:ring focus:ring-indigo-300 transition duration-300 text-sm sm:text-base">
                <option><?php echo lang('select'); ?> <?php echo lang('language'); ?></option>
                <option value="arabic"><?php echo lang('arabic'); ?></option>
                <option value="english"><?php echo lang('english'); ?></option>
                <option value="spanish"><?php echo lang('spanish'); ?></option>
                <option value="french"><?php echo lang('french'); ?></option>
                <option value="italian"><?php echo lang('italian'); ?></option>
                <option value="portuguese"><?php echo lang('portuguese'); ?></option>
                <option value="turkish"><?php echo lang('turkish'); ?></option>
              </select>

              <input placeholder="<?php echo lang('Price'); ?>*" type="text" name="price" class="price-input w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl border-2 border-indigo-300 bg-white text-gray-800 placeholder-gray-500 focus:border-indigo-400 focus:ring focus:ring-indigo-300 transition duration-300 text-sm sm:text-base">
              <input placeholder="<?php echo lang('Country'); ?>*" type="text" name="country" class="w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl border-2 border-indigo-300 bg-white text-gray-800 placeholder-gray-500 focus:border-indigo-400 focus:ring focus:ring-indigo-300 transition duration-300 text-sm sm:text-base">
            </div>

            <textarea placeholder="<?php echo lang('remarks'); ?>*" name="remarks" class="w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl border-2 border-indigo-300 bg-white text-gray-800 placeholder-gray-500 focus:border-indigo-400 focus:ring focus:ring-indigo-300 transition duration-300 text-sm sm:text-base" rows="4"></textarea>

            <div class="payment_div space-y-6 sm:space-y-8">
              <?php if ($settings1->payment_gateway == 'PayPal') { ?>
                <select name="card_type" class="w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl border-2 border-indigo-300 bg-white text-gray-800 focus:border-indigo-400 focus:ring focus:ring-indigo-300 transition duration-300 text-sm sm:text-base">
                  <option value="Mastercard"><?php echo lang('mastercard'); ?></option>
                  <option value="Visa"><?php echo lang('visa'); ?></option>
                  <option value="American Express"><?php echo lang('american_express'); ?></option>
                </select>
                <input placeholder="<?php echo lang('cardholder'); ?> <?php echo lang('name'); ?>" type="text" name="cardholder" class="w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl border-2 border-indigo-300 bg-white text-gray-800 placeholder-gray-500 focus:border-indigo-400 focus:ring focus:ring-indigo-300 transition duration-300 text-sm sm:text-base">
              <?php } ?>

              <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack') { ?>
                <input placeholder="<?php echo lang('Card Number'); ?>*" type="text" name="card_number" id="card" class="w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl border-2 border-indigo-300 bg-white text-gray-800 placeholder-gray-500 focus:border-indigo-400 focus:ring focus:ring-indigo-300 transition duration-300 text-sm sm:text-base">
                <div class="grid grid-cols-2 gap-4 sm:gap-6">
                  <input placeholder="<?php echo lang('Expire Date'); ?>" type="text" name="expire_date" id="expire" class="w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl border-2 border-indigo-300 bg-white text-gray-800 placeholder-gray-500 focus:border-indigo-400 focus:ring focus:ring-indigo-300 transition duration-300 text-sm sm:text-base" required>
                  <input placeholder="<?php echo lang('CVV'); ?>" type="text" name="cvv_number" id="cvv" class="w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl border-2 border-indigo-300 bg-white text-gray-800 placeholder-gray-500 focus:border-indigo-400 focus:ring focus:ring-indigo-300 transition duration-300 text-sm sm:text-base" maxlength="3" required>
                </div>
              <?php } ?>
            </div>

            <div class="flex items-center space-x-3">
              <input type="checkbox" name="trial_version" value="1" class="trial_version w-5 h-5 sm:w-6 sm:h-6 text-indigo-600 border-2 border-indigo-300 rounded-md focus:ring-indigo-500">
              <p class="text-base sm:text-xl text-gray-700"><?php echo lang('do_you_want_trial_version'); ?></p>
            </div>

            <input type="hidden" name="request" value=''>
            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

            <button type="submit" id="submit-btn" class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-4 sm:py-5 px-6 sm:px-8 rounded-xl text-xl sm:text-2xl font-extrabold hover:from-indigo-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
              <?php echo lang('register'); ?> <?php echo lang('hospital'); ?>
            </button>
          </form>
        </div>
      </div>
    </section>




    <!-- Customer Reviews -->
    <section class="mx-auto py-16 md:py-24 px-4 lg:px-10 review bg-gradient-to-b from-white to-gray-100" id="review">
      <div class="container_area">
        <div class="flex flex-col gap-6 text-center mb-16">
          <p class="uppercase tracking-widest text-sm font-bold text-indigo-600">
            <?php echo lang('review'); ?>
          </p>
          <h2 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight">
            <?php echo lang('What did our costomer say?'); ?>
          </h2>
          <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            <?php echo $settings->service_block__text_under_title ?>
          </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 mt-24">
          <?php foreach ($services as $service) { ?>
            <div class="relative bg-gradient-to-br from-indigo-100 to-purple-50 rounded-xl shadow-2xl overflow-hidden transform hover:scale-105 transition-transform duration-500 group">
              <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-indigo-500 to-purple-500"></div>
              <div class="p-12">
                <div class="absolute -top-12 left-12">
                  <img width="100" height="100" src="<?php echo $service->img_url ?>" class="rounded-full border-8 border-white shadow-xl transition-all duration-300 group-hover:scale-110" alt="">
                </div>
                <div class="pt-16 space-y-6">
                  <h3 class="text-3xl font-black text-indigo-900 mb-4 tracking-tight"><?php echo $service->title ?></h3>
                  <p class="text-indigo-700 text-lg leading-relaxed">
                    <?php echo $service->description ?>
                  </p>
                </div>
                <div class="mt-10 flex justify-start">
                  <div class="flex items-center space-x-1">
                    <?php for ($i = 0; $i < 5; $i++) { ?>
                      <svg class="w-8 h-8 text-yellow-400 fill-current transition-all duration-300 group-hover:text-yellow-300" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                      </svg>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>



    <!-- FAQ Section -->
    <section class="bg-gradient-to-br from-indigo-50 to-purple-100 px-4 py-16 sm:py-24 md:py-32" id="faq">
      <div class="container_area mx-auto">
        <div class="text-center mb-12 sm:mb-16 md:mb-24">
          <span class="text-xs sm:text-sm uppercase tracking-widest text-indigo-800 mb-2 sm:mb-4 block font-bold">
            <?php echo lang('unravel_your_queries'); ?>
          </span>
          <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-6xl font-black text-indigo-900 leading-none mb-4 sm:mb-6 md:mb-8">
            <?php echo lang('frequently_asked_questions'); ?>
          </h2>
          <div class="w-24 sm:w-32 h-1 sm:h-2 bg-gradient-to-r from-indigo-500 to-purple-500 mx-auto rounded-full"></div>
        </div>

        <div class="flex flex-col lg:flex-row items-start justify-between space-y-12 lg:space-y-0 lg:space-x-12 xl:space-x-24">
          <div class="w-full lg:w-2/3 space-y-6 sm:space-y-8">
            <?php foreach ($faqs as $index => $faq) { ?>
              <div class="bg-white rounded-xl sm:rounded-xl overflow-hidden transition-all duration-500 hover:shadow-xl sm:hover:shadow-2xl transform hover:-translate-y-1 sm:hover:-translate-y-2">
                <div class="parent cursor-pointer p-6 sm:p-8">
                  <div class="flex justify-between items-center text-indigo-900">
                    <h3 class="text-lg sm:text-xl md:text-2xl font-bold sm:font-extrabold"><?php echo $faq->title; ?></h3>
                    <svg class="toggle-icon w-6 h-6 sm:w-1 sm:h-8 transform transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                  </div>
                  <div class="child hidden mt-4 sm:mt-6">
                    <p class="text-indigo-700 leading-relaxed text-base sm:text-lg"><?php echo $faq->description; ?></p>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
          <div class="w-full lg:w-1/3 mt-8 lg:mt-0 lg:pl-6 xl:pl-12 relative">
            <div class="absolute -top-8 -left-8 sm:-top-16 sm:-left-16 w-24 h-24 sm:w-32 sm:h-32 bg-purple-300 rounded-full opacity-50"></div>
            <!-- <div class="absolute -bottom-8 -right-8 sm:-bottom-16 sm:-right-8 w-32 h-32 sm:w-48 sm:h-48 bg-indigo-300 rounded-full opacity-50"></div> -->
            <img src="new-fnt/assets/images/Vector (1).svg" alt="FAQ Illustration" class="w-full max-w-xs sm:max-w-sm mx-auto relative z-10 transform -rotate-6 hover:rotate-0 transition-transform duration-500">
            <div class="mt-8 sm:mt-16 text-center relative z-20">
              <p class="text-indigo-800 mb-4 sm:mb-6 text-lg sm:text-xl font-semibold"><?php echo lang('still_puzzled'); ?></p>
              <a href="#contact" class="inline-block bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-6 sm:py-4 sm:px-8 rounded-full text-base sm:text-lg font-bold hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg"><?php echo lang('reach_out_to_us'); ?></a>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Contact Us Section -->
    <section id="contact" class="bg-gradient-to-br from-indigo-950 to-purple-900 py-24 sm:py-24 md:py-32">
      <div class="container mx-auto px-4 sm:px-6 md:px-8">
        <div class="text-center mb-12 sm:mb-16 md:mb-20">
          <span class="text-xs sm:text-sm uppercase tracking-widest text-indigo-300 mb-2 sm:mb-3 block font-bold">
            <?php echo lang('get_in_touch'); ?>
          </span>
          <h2 class="text-3xl sm:text-5xl md:text-6xl font-black text-white mb-4 sm:mb-6 leading-tight">
            <?php echo lang('Contact Us'); ?>
          </h2>
          <div class="w-24 sm:w-32 h-1 sm:h-2 bg-gradient-to-r from-white to-purple-300 mx-auto rounded-full"></div>
          <p class="text-lg sm:text-xl md:text-2xl text-indigo-200 max-w-2xl mx-auto mt-4 sm:mt-6 leading-relaxed">
            <?php echo lang('We\'re here to address your inquiries and provide professional assistance'); ?>
          </p>
        </div>

        <div class="flex flex-col lg:flex-row items-stretch justify-between space-y-8 lg:space-y-0 lg:space-x-8 xl:space-x-12">
          <div class="w-full lg:w-1/2 bg-white rounded-2xl shadow-xl p-6 sm:p-8 md:p-10">
            <h3 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-indigo-900 mb-4 sm:mb-6 md:mb-8">
              <?php echo lang('Contact Information'); ?>
            </h3>

            <p class="text-base sm:text-lg md:text-xl text-gray-700 mb-6 sm:mb-8 md:mb-10 leading-relaxed">
              <?php echo lang('For inquiries regarding:'); ?>
              <span class="font-bold text-indigo-600 block mt-2 text-lg sm:text-xl md:text-2xl">
                <?php echo lang('Extended licenses or custom projects'); ?>
              </span>
            </p>

            <div class="space-y-4 sm:space-y-6">
              <div class="flex items-center bg-indigo-100 p-4 rounded-xl">
                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-indigo-600 mr-4 sm:mr-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <span class="text-base sm:text-lg md:text-xl font-bold text-indigo-800"><?php echo $settings->email; ?></span>
              </div>
              <div class="flex items-center bg-purple-100 p-4 rounded-xl">
                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-purple-600 mr-4 sm:mr-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                <span class="text-base sm:text-lg md:text-xl font-bold text-purple-800"><?php echo $settings->phone; ?></span>
              </div>
              <div class="flex items-center bg-blue-100 p-4 rounded-xl">
                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-blue-600 mr-4 sm:mr-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                </svg>
                <span class="text-base sm:text-lg md:text-xl font-bold text-blue-800"><?php echo lang('Telegram'); ?>: <?php echo $settings->phone; ?></span>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-1/2 flex flex-col justify-center">
            <div class="bg-indigo-800 rounded-2xl p-6 sm:p-8 md:p-10 shadow-xl">
              <h4 class="text-2xl sm:text-3xl font-black text-white mb-4 sm:mb-6"><?php echo lang('ready_to_proceed'); ?></h4>
              <p class="text-base sm:text-lg md:text-xl text-indigo-200 mb-6 sm:mb-8"><?php echo lang('let_s_discuss_your_project_requirements_and_explore_how_we_can_assist_you_in_achieving_your_objectives'); ?></p>
              <a href="mailto:<?php echo $settings->email; ?>" class="inline-block bg-white text-indigo-900 py-3 px-6 rounded-full text-base sm:text-lg md:text-xl font-bold hover:bg-indigo-100 transition-all duration-300">
                <?php echo lang('request_a_consultation'); ?>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>



    <footer class="footer py-16 bg-gradient-to-br from-indigo-900 to-purple-900 text-white">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
          <div class="space-y-6">
            <?php
            if (!empty($settings->logo)) {
              if (file_exists($settings->logo)) {
                echo '<img class="w-48 mb-4"  style="margin-left: -16px;" src="' . $settings->logo . '" alt="Logo">';
              } else {
                echo '<h2 class="text-3xl font-extrabold">' . $title[0] . '<span class="text-purple-400"> ' . $title[1] . '</span></h2>';
              }
            } else {
              echo '<h2 class="text-3xl font-extrabold">' . $title[0] . '<span class="text-purple-400"> ' . $title[1] . '</span></h2>';
            }
            ?>
            <p class="text-gray-300 text-sm leading-relaxed">
              <?php echo lang('footer_text'); ?>
            </p>
            <div class="flex space-x-4">
              <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                <span class="sr-only">Facebook</span>
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                <span class="sr-only">Instagram</span>
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                <span class="sr-only">Twitter</span>
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                </svg>
              </a>
            </div>
          </div>

          <div>
            <h3 class="text-lg font-bold mb-4 text-purple-300"><?php echo lang('Quick Links'); ?></h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300"><?php echo lang('Home'); ?></a></li>
              <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300"><?php echo lang('Service'); ?></a></li>
              <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300"><?php echo lang('About Us'); ?></a></li>
              <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300"><?php echo lang('Testimonials'); ?></a></li>
              <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300"><?php echo lang('News'); ?></a></li>
            </ul>
          </div>

          <div>
            <h3 class="text-lg font-bold mb-4 text-purple-300"><?php echo lang('Our Services'); ?></h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300"><?php echo lang('Team'); ?></a></li>
              <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300"><?php echo lang('FAQ'); ?></a></li>
              <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300"><?php echo lang('Gallery'); ?></a></li>
              <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300"><?php echo lang('Contact'); ?></a></li>
              <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300"><?php echo lang('Portfolio'); ?></a></li>
            </ul>
          </div>

          <div>
            <h3 class="text-lg font-bold mb-4 text-purple-300"><?php echo lang('Contact Us'); ?></h3>
            <ul class="space-y-4">
              <li class="flex items-start">
                <svg class="h-6 w-6 text-purple-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <span><?php echo $settings->phone; ?></span>
              </li>
              <li class="flex items-start">
                <svg class="h-6 w-6 text-purple-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span><?php echo $settings->email; ?></span>
              </li>
              <li class="flex items-start">
                <svg class="h-6 w-6 text-purple-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span><?php echo $settings->address; ?></span>
              </li>
            </ul>
          </div>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-800 text-center">
          <p class="text-sm text-gray-400">&copy; <?php echo date('Y'); ?> <?php echo $settings->system_vendor; ?>. <?php echo lang('all_rights_reserved'); ?>.</p>
        </div>
      </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollToTopBtn" class="fixed top-1/3 right-5 bg-indigo-600 text-white p-3 rounded-full shadow-lg transition-opacity duration-300 opacity-0 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
      </svg>
    </button>

    <script>
      // Scroll to Top functionality
      const scrollToTopBtn = document.getElementById('scrollToTopBtn');

      window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
          scrollToTopBtn.style.opacity = '1';
        } else {
          scrollToTopBtn.style.opacity = '0';
        }
      });

      scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });
    </script>
  </main>
</body>
<!-- font awesome -->
<script src="https://kit.fontawesome.com/0257e3c208.js" crossorigin="anonymous"></script>
<!-- tailwind css -->
<script type="text/javascript" src="new-fnt/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/country-select-js@2.1.0/build/js/countrySelect.min.js"></script>

<script type="text/javascript" src="common/assets/ckeditor/ckeditor.js"></script>
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
  var payment_gateway = "<?php echo $settings1->payment_gateway; ?>";
</script>
<script type="text/javascript">
  var publish = "<?php echo $gateway->publish; ?>";
</script>
<script src="common/extranal/js/frontend/front_end.js"></script>
<?php if (!empty($settings->chat_js)) { ?>
  <script type="text/javascript">
    var chat_js = '<?php echo trim($settings->chat_js); ?>';
  </script>
  <script src="common/extranal/js/frontend/chat_js.js"></script>
  <!--End of Tawk.to Script-->
<?php } ?>

</html>
<script>
  $(document).ready(function() {
    $(".text1").hide();
    $("#yearly").click(function() {
      $(".text1").hide();
      $(".text2").show();
    });
    $("#monthly").click(function() {
      $(".text1").show();
      $(".text2").hide();
    });
  });
</script>
<script>
  document.getElementById('dropdownButton').addEventListener('click', function() {
    var dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.classList.toggle('hidden');
  });

  document.addEventListener('click', function(event) {
    var isClickInside = document.getElementById('dropdownButton').contains(event.target);
    if (!isClickInside) {
      var dropdownMenu = document.getElementById('dropdownMenu');
      if (!dropdownMenu.classList.contains('hidden')) {
        dropdownMenu.classList.add('hidden');
      }
    }
  });
</script>

<script>
  $("#country").countrySelect();
</script>



<link rel="stylesheet" href="new-fnt/index.css" />