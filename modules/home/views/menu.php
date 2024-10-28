<!-- Start of Selection -->
<!-- <li class="nav-header text-orange text-md fw-bold mb-1" style="text-transform: capitalize;"><?php echo lang('main_navigation'); ?></li> -->
<li class="nav-item mt-3">
    <a class="nav-link text-white" href="home">
        <i class="text-secondary nav-icon fas fa-th"></i>
        <p><?php echo lang('dashboard'); ?></p>
    </a>
</li>
<?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Doctor'))) { ?>
    <li class="nav-item">
        <a class="nav-link text-white" href="#">
            <i class="text-secondary nav-icon fas fa-bolt"></i>
            <p><?php echo lang('quick_access'); ?><i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a class="nav-link text-white" href="appointment/addNewViewQuick">
                    <i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('add_appointment'); ?></p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="patient/addNewViewQuick">
                    <i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('add_patient'); ?></p>
                </a>
            </li>
            <?php if ($this->ion_auth->in_group('Doctor')) { ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="prescription/addNewPrescriptionQuick">
                        <i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_prescription'); ?></p>
                    </a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="patient/caseListQuick">
                    <i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('add_case'); ?></p>
                </a>
            </li>
            <?php if ($this->ion_auth->in_group('admin')) { ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="finance/addPaymentViewQuick">
                        <i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_payment'); ?></p>
                    </a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="bed/addAllotmentViewQuick">
                    <i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('new_admission'); ?></p>
                </a>
            </li>
        </ul>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link text-white" href="emergency">
            <i class="text-secondary nav-icon fas fa-ambulance"></i>
            <p><?php echo lang('emergency'); ?></p>
        </a>
    </li> -->
<?php } ?>

<?php if ($this->ion_auth->in_group('admin')) { ?>
    <?php if (in_array('department', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="department">
                <i class="text-secondary nav-icon fas fa-sitemap"></i>
                <p><?php echo lang('departments'); ?></p>
            </a>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('doctor', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon fa fa-user-md"></i>
                <p><?php echo lang('doctors'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link text-white" href="doctor"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p> <?php echo lang('list_of_doctors'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="doctor/addnewview"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p> <?php echo lang('add_new'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="appointment/treatmentReport"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p> <?php echo lang('treatment_history'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="doctorvisit"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p> <?php echo lang('doctor_visit'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if (!$this->ion_auth->in_group('superadmin')) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('patient_management'); ?></li>
<?php } ?>





<?php if ($this->ion_auth->in_group(array('Patient'))) { ?>
    <?php if (in_array('patient', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="patient/myCaseList">
                <i class="text-secondary nav-icon fas fa-file-medical"></i>
                <p> <?php echo lang('cases'); ?> </p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('prescription', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="patient/myPrescription">
                <i class="text-secondary nav-icon fas fa-prescription"></i>
                <p> <?php echo lang('prescription'); ?> </p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('patient', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="patient/myDocuments">
                <i class="text-secondary nav-icon fas fa-file-upload"></i>
                <p> <?php echo lang('documents'); ?> </p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('finance', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="patient/myPaymentHistory">
                <i class="text-secondary nav-icon far fa-money-bill-alt"></i>
                <p> <?php echo lang('payment'); ?> </p>
            </a>
        </li>
    <?php } ?>
<?php } ?>

<?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Nurse', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
    <?php if (in_array('patient', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon far fa-user"></i>
                <p><?php echo lang('patient'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link text-white" href="patient"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('patient_list'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="patient/addnewview"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p> <?php echo lang('add_new'); ?></p>
                    </a></li>
                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Doctor', 'Receptionist'))) { ?>
                    <li class="nav-item"><a class="nav-link text-white" href="patient/patientPayments"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('payments'); ?></p>
                        </a></li>
                <?php } ?>

            </ul>
        </li>
    <?php } ?>
<?php } ?>

<?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Doctor', 'Laboratorist'))) { ?>
    <?php if (in_array('patient', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon far fa-user"></i>
                <p><?php echo lang('All The Cases'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <?php if (!$this->ion_auth->in_group(array('Accountant', 'Receptionist'))) { ?>
                    <li class="nav-item"><a class="nav-link text-white" href="patient/caseList"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('All The Cases'); ?> </p>
                        </a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="symptom"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('Symptoms'); ?></p>
                        </a></li>

                    <li class="nav-item"><a class="nav-link text-white" href="diagnosis"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('diagnosis'); ?></p>
                        </a></li>

                    <li class="nav-item"><a class="nav-link text-white" href="treatment"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('treatment'); ?></p>
                        </a></li>

                    <li class="nav-item"><a class="nav-link text-white" href="advice"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('advice'); ?></p>
                        </a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="patient/documents"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('documents'); ?></p>
                        </a></li>
                <?php } ?>

            </ul>
        </li>
    <?php } ?>
<?php } ?>





<?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) { ?>
    <?php if (in_array('prescription', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="prescription/all">
                <i class="text-secondary nav-icon fas fa-prescription"></i>
                <p>
                    <?php echo lang('prescription'); ?>
                </p>
            </a>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
    <?php if (in_array('prescription', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="prescription">
                <i class="text-secondary nav-icon fas fa-prescription"></i>
                <p><?php echo lang('prescription'); ?></p>
            </a>
        </li>
    <?php } ?>
<?php } ?>


<?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Receptionist'))) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('appointments-h'); ?></li>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon far fa-clock"></i>
                <p><?php echo lang('schedule'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link text-white" href="schedule"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('all'); ?> <?php echo lang('schedule'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="schedule/allHolidays"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('holidays'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>

<?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('appointments-h'); ?></li>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon far fa-clock"></i>
                <p><?php echo lang('schedule'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link text-white" href="schedule/timeSchedule"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('all'); ?> <?php echo lang('schedule'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="schedule/holidays"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('holidays'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>

<?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse', 'Receptionist'))) { ?>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon far fa-calendar-check"></i>
                <p><?php echo lang('appointment'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link text-white" href="appointment"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('all'); ?> <?php echo lang('appointments'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="appointment/addNewView"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('add'); ?> <?php echo lang('appointment'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="appointment/todays"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('todays'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="appointment/upcoming"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('upcoming'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="appointment/calendar"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('calendar'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="appointment/request"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('request'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>

<?php if ($this->ion_auth->in_group(array(''))) { ?>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon fas fa-headphones"></i>
                <p><?php echo lang('live'); ?> <?php echo lang('meetings'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                    <li class="nav-item"><a class="nav-link text-white" href="meeting/addNewView"><i class="text-secondary nav-icon fas fa-plus-circle"></i>
                            <p><?php echo lang('create'); ?> <?php echo lang('meeting'); ?></p>
                        </a></li>
                <?php } ?>
                <li class="nav-item"><a class="nav-link text-white" href="meeting"><i class="text-secondary nav-icon far fa-video"></i>
                        <p><?php echo lang('live'); ?> <?php echo lang('now'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="meeting/upcoming"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('upcoming'); ?> <?php echo lang('meetings'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="meeting/previous"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('previous'); ?> <?php echo lang('meetings'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>



<?php if ($this->ion_auth->in_group(array(''))) { ?>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li class="nav-item"><a class="nav-link text-white" href="meeting"><i class="text-secondary nav-icon fas fa-headphones"></i>
                <p><?php echo lang('join_live'); ?></p>
            </a></li>
    <?php } ?>
<?php } ?>

<?php if ($this->ion_auth->in_group(array('Patient'))) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('appointments-h'); ?></li>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li class="nav-item"><a class="nav-link text-white" href="appointment/myAppointments"><i class="text-secondary nav-icon fas fa-calendar"></i>
                <p><?php echo lang('all'); ?> <?php echo lang('appointments'); ?></p>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link text-white" href="appointment/myTodays"><i class="text-secondary nav-icon fas fa-headphones"></i>
                <p><?php echo lang('todays'); ?> <?php echo lang('appointment'); ?></p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="patient/calendar">
                <i class="text-secondary nav-icon far fa-calendar"></i>
                <p> <?php echo lang('appointment'); ?> <?php echo lang('calendar'); ?> </p>
            </a>
        </li>
    <?php } ?>

    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('reports-h'); ?></li>
    <?php if (in_array('lab', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="lab/myLab">
                <i class="text-secondary nav-icon fas fa-file-medical-alt"></i>
                <p> <?php echo lang('diagnosis'); ?> <?php echo lang('reports'); ?> </p>
            </a>
        </li>
    <?php } ?>


    <?php if (in_array('report', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="report/myreports">
                <i class="text-secondary nav-icon fas fa-file-medical-alt"></i>
                <p> <?php echo lang('other'); ?> <?php echo lang('reports'); ?> </p>
            </a>
        </li>
    <?php } ?>
<?php } ?>






<!-- NEW ADDITIONS -->
<?php if ($this->ion_auth->in_group(array('Accountant', 'Receptionist', 'Nurse', 'Laboratorist', 'Pharmacist', 'Doctor'))) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('human_resources'); ?></li>
    <?php if (in_array('attendance', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="attendance">
                <i class="text-secondary nav-icon far fa-bell-slash"></i>
                <p><?php echo lang('attendance'); ?></p>
            </a>
        </li>

    <?php } ?>
    <?php if (in_array('leave', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon far fa-bell-slash"></i>
                <p><?php echo lang('leave'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <?php if (in_array('leave', $this->modules)) { ?>
                    <li class="nav-item"><a class="nav-link text-white" href="leave"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('leave'); ?></p>
                        </a></li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
    <?php if (in_array('payroll', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon fas fa-money-check"></i>
                <p><?php echo lang('payroll'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <?php if (in_array('payroll', $this->modules)) { ?>
                    <li class="nav-item"><a class="nav-link text-white" href="payroll/employeePayroll"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('payroll'); ?></p>
                        </a></li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>

<?php } ?>



<?php if ($this->ion_auth->in_group('admin')) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('finance-h'); ?></li>
    <?php if (in_array('finance', $this->modules)) { ?>

        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon fas fa-money-check"></i>
                <p>
                    <?php echo lang('financial_activities'); ?>
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link text-white" href="finance/addPaymentView"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('new_invoice'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="finance/payment"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('all_invoices'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="finance/draftPayment"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('draft_invoices'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="finance/dueCollection"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('due_collection'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="finance/paymentCategory"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('invoice_items_lab_tests'); ?></p>
                    </a></li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="finance/addPaymentCategoryView">
                        <i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('new_items_lab_tests'); ?></p>
                    </a>
                </li>
                <!-- <li class="nav-item"><a class="nav-link text-white" href="finance/category"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('payment_categories'); ?></p>
                    </a></li> -->
                <li class="nav-item"><a class="nav-link text-white" href="finance/expense"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('expense'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="finance/addExpenseView"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_expense'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="finance/expenseCategory"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('expense_categories'); ?></p>
                    </a></li>


            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon fas fa-file"></i>
                <p><?php echo lang('insurance'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link text-white" href="insurance"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('insurance'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="finance/insuranceReport"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('insurance_report'); ?></p>
                    </a></li>

            </ul>
        </li>


    <?php } ?>
<?php } ?>

<?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Laboratorist', 'Doctor'))) { ?>
    <li class="nav-item">
        <a class="nav-link text-white" href="#">
            <i class="text-secondary nav-icon fas fa-file-medical-alt"></i>
            <p><?php echo lang('report'); ?><i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                <?php if (in_array('finance', $this->modules)) { ?>
                    <li class="nav-item"><a class="nav-link text-white" href="finance/financialReport"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('financial_report'); ?></p>
                        </a></li>
                    <li class="nav-item"> <a class="nav-link text-white" href="finance/AllUserActivityReport"> <i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('user_activity_report'); ?></p>
                        </a></li>
                <?php } ?>
            <?php } ?>
            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                <?php if (in_array('finance', $this->modules)) { ?>
                    <li class="nav-item"><a class="nav-link text-white" href="finance/doctorsCommission"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('doctors_commission'); ?></p>
                        </a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="finance/monthly"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('monthly_sales'); ?></p>
                        </a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="finance/daily"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('daily_sales'); ?></p>
                        </a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="finance/monthlyExpense"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('monthly_expense'); ?></p>
                        </a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="finance/dailyExpense"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('daily_expense'); ?></p>
                        </a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="finance/expenseVsIncome"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('expense_vs_income'); ?></p>
                        </a></li>
                <?php } ?>
            <?php } ?>
            <?php if (in_array('report', $this->modules)) { ?>
                <li class="nav-item"><a class="nav-link text-white" href="report/birth"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('birth_report'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="report/operation"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('operation_report'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="report/expire"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('expire_report'); ?></p>
                    </a></li>
            <?php } ?>
        </ul>
    </li>
<?php } ?>

<?php if ($this->ion_auth->in_group('Receptionist')) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('finance-h'); ?></li>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="appointment/calendar">
                <i class="text-secondary nav-icon far fa-calendar"></i>
                <p> <?php echo lang('calendar'); ?> </p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('finance', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon fas fa-money-check"></i>
                <p><?php echo lang('financial_activities'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link text-white" href="finance/payment"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('payments'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="finance/addPaymentView"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_payment'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="finance/dueCollection"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('due_collection'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>

<?php
if ($this->ion_auth->in_group(array('Accountant', 'Receptionist'))) {
?>
    <?php if (in_array('finance', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="finance/UserActivityReport">
                <i class="text-secondary nav-icon fas fa-file"></i>
                <p><?php echo lang('user_activity_report'); ?></p>
            </a>
        </li>
    <?php } ?>
<?php
}
?>


<?php
if ($this->ion_auth->in_group(array('Receptionist'))) {
?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('lab_reports'); ?></li>
    <?php if (in_array('lab', $this->modules)) { ?>
        <li class="nav-item">
            <!-- <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon fa fa-flask"></i>
                <p>
                    <?php echo lang('labs'); ?>
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a> -->
            <!-- <ul class="nav nav-treeview"> -->
        <li class="nav-item"><a class="nav-link text-white" href="lab/testStatus"><i class="text-secondary nav-icon fas fa-vial"></i>
                <p><?php echo lang('lab_tests'); ?></p>
            </a></li>
        <li class="nav-item"><a class="nav-link text-white" href="lab"><i class="text-secondary nav-icon fas fa-file-medical-alt"></i>
                <p><?php echo lang('lab_reports'); ?></p>
            </a></li>
        <li class="nav-item"><a class="nav-link text-white" href="lab/reportDelivery"><i class="text-secondary nav-icon fas fa-truck"></i>
                <p><?php echo lang('report') . " " . lang('delivery'); ?></p>
            </a></li>
        <!-- </ul> -->
        </li>
    <?php } ?>
<?php
}
?>







<?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('lab_reports-h'); ?></li>
    <?php if (in_array('lab', $this->modules)) { ?>
        <!-- <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon fa fa-flask"></i>
                <p><?php echo lang('labs'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
           
        </li> -->
        <!-- <ul class="nav nav-treeview"> -->
        <li class="nav-item"><a class="nav-link text-white" href="lab/testStatus"><i class="text-secondary nav-icon fas fa-vial"></i>
                <p><?php echo lang('lab_tests'); ?></p>
            </a></li>
        <li class="nav-item"><a class="nav-link text-white" href="lab"><i class="text-secondary nav-icon fas fa-file-medical-alt"></i>
                <p><?php echo lang('lab_reports'); ?></p>
            </a></li>
        <li class="nav-item"><a class="nav-link text-white" href="lab/reportDelivery"><i class="text-secondary nav-icon fas fa-truck"></i>
                <p><?php echo lang('report') . " " . lang('delivery'); ?></p>
            </a></li>
        <li class="nav-item"><a class="nav-link text-white" href="lab/template"><i class="text-secondary nav-icon fas fa-file-invoice"></i>
                <p><?php echo lang('template'); ?></p>
            </a></li>
        <!-- <li class="nav-item"><a class="nav-link text-white" href="macro"><i class="text-secondary nav-icon fas fa-microscope"></i>
                <p><?php echo lang('macro'); ?></p>
            </a></li> -->
        <!-- </ul> -->
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('bed_management'); ?></li>

    <?php if (in_array('bed', $this->modules)) { ?>
        <li class="nav-item"><a class="nav-link text-white" href="bed/bedAllotment"><i class="text-secondary nav-icon fas fa-bed"></i>
                <p><?php echo lang('all_admissions'); ?></p>
            </a></li>
        <li class="nav-item"><a class="nav-link text-white" href="bed/addAllotmentView"><i class="text-secondary nav-icon fas fa-plus-circle"></i>
                <p><?php echo lang('add_admission'); ?></p>
            </a></li>
        <li class="nav-item"><a class="nav-link text-white" href="bed"><i class="text-secondary nav-icon fas fa-list"></i>
                <p><?php echo lang('bed_list'); ?></p>
            </a></li>
        <li class="nav-item"><a class="nav-link text-white" href="bed/addBedView"><i class="text-secondary nav-icon fas fa-plus"></i>
                <p><?php echo lang('add_bed'); ?></p>
            </a></li>
        <li class="nav-item"><a class="nav-link text-white" href="bed/bedCategory"><i class="text-secondary nav-icon fas fa-th-list"></i>
                <p><?php echo lang('bed_category'); ?></p>
            </a></li>
        <li class="nav-item"><a class="nav-link text-white" href="pservice"><i class="text-secondary nav-icon fas fa-paw"></i>
                <p><?php echo lang('patient'); ?> <?php echo lang('service'); ?></p>
            </a></li>
        <!-- <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon fas fa-procedures"></i>
                <p><?php echo lang('bed'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
               
            </ul>
        </li> -->
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('pharmacy-h'); ?></li>
    <?php if (in_array('pharmacy', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon fas fa-capsules"></i>
                <p><?php echo lang('pharmacy'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <?php if (!$this->ion_auth->in_group(array('Pharmacist'))) { ?>
                    <li class="nav-item"><a class="nav-link text-white" href="finance/pharmacy/home"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('dashboard'); ?></p>
                        </a></li>
                <?php } ?>
                <li class="nav-item"><a class="nav-link text-white" href="finance/pharmacy/payment"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('sales'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="finance/pharmacy/addPaymentView"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_new_sale'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="finance/pharmacy/expense"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('expense'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="finance/pharmacy/addExpenseView"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_expense'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="finance/pharmacy/expenseCategory"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('expense_categories'); ?></p>
                    </a></li>
                <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) { ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang(''); ?> <?php echo lang('report'); ?><i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link text-white" href="finance/pharmacy/financialReport"><i class="text-secondary nav-icon far fa-circle"></i>
                                    <p><?php echo lang('pharmacy'); ?> <?php echo lang('report'); ?></p>
                                </a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="finance/pharmacy/monthly"><i class="text-secondary nav-icon far fa-circle"></i>
                                    <p><?php echo lang('monthly_sales'); ?></p>
                                </a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="finance/pharmacy/daily"><i class="text-secondary nav-icon far fa-circle"></i>
                                    <p><?php echo lang('daily_sales'); ?></p>
                                </a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="finance/pharmacy/monthlyExpense"><i class="text-secondary nav-icon far fa-circle"></i>
                                    <p><?php echo lang('monthly_expense'); ?></p>
                                </a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="finance/pharmacy/dailyExpense"><i class="text-secondary nav-icon far fa-circle"></i>
                                    <p><?php echo lang('daily_expense'); ?></p>
                                </a></li>

                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('medicine', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon fas  fa-medkit"></i>
                <p><?php echo lang('medicine'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link text-white" href="medicine"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('medicine_list'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="medicine/addMedicineView"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_medicine'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="medicine/medicineCategory"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('medicine_category'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="medicine/addCategoryView"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_medicine_category'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="medicine/medicineStockAlert"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('medicine_stock_alert'); ?></p>
                    </a></li>

            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group('Pharmacist')) { ?>
    <?php if (in_array('medicine', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="medicine">
                <i class="text-secondary nav-icon fas fa-medkit"></i>
                <p> <?php echo lang('medicine_list'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="medicine/addMedicineView">
                <i class="text-secondary nav-icon fas fa-plus-circle"></i>
                <p> <?php echo lang('add_medicine'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="medicine/medicineCategory">
                <i class="text-secondary nav-icon fas fa-medkit"></i>
                <p> <?php echo lang('medicine_category'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="medicine/addCategoryView">
                <i class="text-secondary nav-icon fas fa-plus-circle"></i>
                <p> <?php echo lang('add_medicine_category'); ?> </p>
            </a>
        </li>
    <?php } ?>
<?php } ?>

<?php if ($this->ion_auth->in_group('admin')) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('human_resources-h'); ?></li>
    <li class="nav-item">
        <a class="nav-link text-white" href="#">
            <i class="text-secondary nav-icon fas fa-users"></i>
            <p><?php echo lang('human_resources'); ?><i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <?php if (in_array('nurse', $this->modules)) { ?>
                <li class="nav-item"><a class="nav-link text-white" href="nurse"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('nurse'); ?></p>
                    </a></li>
            <?php } ?>
            <?php if (in_array('pharmacist', $this->modules)) { ?>
                <li class="nav-item"><a class="nav-link text-white" href="pharmacist"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('pharmacist'); ?></p>
                    </a></li>
            <?php } ?>
            <?php if (in_array('laboratorist', $this->modules)) { ?>
                <li class="nav-item"><a class="nav-link text-white" href="laboratorist"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('laboratorist'); ?></p>
                    </a></li>
            <?php } ?>
            <?php if (in_array('accountant', $this->modules)) { ?>
                <li class="nav-item"><a class="nav-link text-white" href="accountant"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('accountant'); ?></p>
                    </a></li>
            <?php } ?>
            <?php if (in_array('receptionist', $this->modules)) { ?>
                <li class="nav-item"><a class="nav-link text-white" href="receptionist"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('receptionist'); ?></p>
                    </a></li>
            <?php } ?>
        </ul>
    </li>
<?php } ?>




<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('payroll', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon fas fa-money-check"></i>
                <p><?php echo lang('payroll'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <?php if (in_array('payroll', $this->modules)) { ?>
                    <li class="nav-item"><a class="nav-link text-white" href="payroll"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('payroll'); ?></p>
                        </a></li>
                <?php } ?>
                <?php if (in_array('payroll', $this->modules)) { ?>
                    <li class="nav-item"><a class="nav-link text-white" href="payroll/salary"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('salary'); ?></p>
                        </a></li>
                <?php } ?>
            </ul>
        </li>
<?php
    }
}
?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('attendance', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon far fa-bell-slash"></i>
                <p><?php echo lang('attendance'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item"><a class="nav-link text-white" href="attendance"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('attendance'); ?></p>
                    </a></li>


                <li class="nav-item"><a class="nav-link text-white" href="attendance/report"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('attendance'); ?> <?php echo lang('report'); ?></p>
                    </a></li>


            </ul>
        </li>
<?php
    }
}
?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('leave', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon far fa-bell-slash"></i>
                <p><?php echo lang('leave'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <?php if (in_array('leave', $this->modules)) { ?>
                    <li class="nav-item"><a class="nav-link text-white" href="leave"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('leave'); ?></p>
                        </a></li>
                <?php } ?>
                <?php if (in_array('leave', $this->modules)) { ?>
                    <li class="nav-item"><a class="nav-link text-white" href="leave/leaveType"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('leave_type'); ?></p>
                        </a></li>
                <?php } ?>
            </ul>
        </li>
<?php
    }
}
?>
<?php if (!$this->ion_auth->in_group('superadmin')) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('communication'); ?></li>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('Accountant', 'Receptionist', 'Nurse', 'Laboratorist', 'Pharmacist', 'Doctor'))) { ?>
    <?php if (in_array('notice', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="notice">
                <i class="text-secondary nav-icon fas fa-bell"></i>
                <p><?php echo lang('notice'); ?></p>
            </a>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('notice', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon fas fa-bell"></i>
                <p><?php echo lang('notice'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link text-white" href="notice"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('notice'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="notice/addNewView"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_new'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('email', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon far fa-envelope"></i>
                <p>
                    <?php echo lang('email'); ?>
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link text-white" href="email/autoEmailTemplate"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('autoemailtemplate'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="email/sendView"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('new'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="email/sent"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('sent'); ?></p>
                    </a></li>
                <?php
                if ($this->ion_auth->in_group(array('admin'))) {
                    $mail_setting = $this->email_model->getHospitalEmailSettings();
                    foreach ($mail_setting as $email_set) {
                        if ($email_set->type == 'Smtp') {
                            $email_id = $email_set->id;
                        }
                    }
                ?>
                    <li class="nav-item"><a class="nav-link text-white" href="email/settings?id=<?php echo $email_id; ?>"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('settings'); ?></p>
                        </a></li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('sms', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon fas fa-sms"></i>
                <p><?php echo lang('sms'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link text-white" href="sms/autoSMSTemplate"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('autosmstemplate'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="sms/sendView"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('write_message'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="sms/sent"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('sent_messages'); ?></p>
                    </a></li>
                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                    <li class="nav-item"><a class="nav-link text-white" href="sms"><i class="text-secondary nav-icon far fa-circle"></i>
                            <p><?php echo lang('sms_settings'); ?></p>
                        </a></li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
<?php } ?>



<?php if (!$this->ion_auth->in_group(array('admin', 'Patient', 'superadmin'))) { ?>
    <li class="nav-item">
        <a class="nav-link text-white" href="#">
            <i class="text-secondary nav-icon far fa-envelope"></i>
            <p>
                <?php echo lang('email'); ?>
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link text-white" href="email/sendView"><i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('new'); ?></p>
                </a></li>
        </ul>
    </li>
<?php } ?>


<?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Pharmacist', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
    <?php if (in_array('chat', $this->modules)) { ?>
        <li class="nav-item">
        <li class="nav-item"><a class="nav-link text-white" href="chat"><i class="text-secondary nav-icon far fa-comment"></i>
                <p><?php echo lang('chat'); ?></p>
                <p id="chatCount">0</p>
            </a></li>
        </li>
        <script src="common/js/jquery.js"></script>
        <script src="common/extranal/js/chat.js"></script>
    <?php } ?>
<?php } ?>

<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('configuration'); ?></li>
    <li class="nav-item">
        <a class="nav-link text-white" href="#">
            <i class="text-secondary nav-icon fas fa-cog"></i>
            <p><?php echo lang('settings'); ?><i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link text-white" href="settings"><i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('system_settings'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link text-white" href="pgateway"><i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('payment_gateway'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link text-white" href="settings/chatgpt"><i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('chatgpt_settings'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link text-white" href="settings/language"><i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('language'); ?></p>
                </a></li>
            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                <li class="nav-item"><a class="nav-link text-white" href="import"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('bulk'); ?> <?php echo lang('import'); ?></p>
                    </a></li>
            <?php } ?>
            <!-- <li class="nav-item"><a class="nav-link text-white" href="logs"><i class="text-secondary nav-icon far fa-history"></i><p></p><?php echo lang('login_logs'); ?></a></li> -->
        </ul>
    </li>



<?php } ?>

<?php if ($this->ion_auth->in_group('Accountant')) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('finance-h'); ?></li>

<?php } ?>

<?php if ($this->ion_auth->in_group('Nurse')) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('bed_management'); ?></li>
    <?php if (in_array('bed', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="bed">
                <i class="text-secondary nav-icon fas fa-procedures"></i>
                <p> <?php echo lang('bed_list'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="bed/bedCategory">
                <i class="text-secondary nav-icon far fa-edit"></i>
                <p> <?php echo lang('bed_category'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="bed/bedAllotment">
                <i class="text-secondary nav-icon fas fa-plus-circle"></i>
                <p> <?php echo lang('bed_allotments'); ?> </p>
            </a>
        </li>
    <?php } ?>

<?php } ?>



<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <li class="nav-item">
        <a class="nav-link text-white" href="#">
            <i class="text-secondary nav-icon fas fa-globe"></i>
            <p><?php echo lang('website'); ?><i class="right fas fa-angle-left"></i></p>
        </a>
        <?php

        $hospital_username = $this->db->get_where('hospital', array('id' => $this->session->userdata('hospital_id')))->row()->username;
        if (empty($hospital_username)) {
            $hospital_username = '';
        }

        ?>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link text-white" href='site/<?php echo $hospital_username ?>' target="_blank"><i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('visit_site'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link text-white" href="site/settings"><i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('website_settings'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link text-white" href="site/review"><i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('reviews'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link text-white" href="site/gridsection"><i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('gridsections'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link text-white" href="site/gallery"><i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('gallery'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link text-white" href="site/slide"><i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('slides'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link text-white" href="site/service"><i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('services'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link text-white" href="site/featured"><i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('featured_doctors'); ?></p>
                </a></li>
        </ul>
    </li>


<?php } ?>
<?php if ($this->ion_auth->in_group('Accountant')) { ?>
    <?php if (in_array('finance', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon far fa-money-bill-alt"></i>
                <p><?php echo lang('payments'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a class="nav-link text-white" href="finance/payment">
                        <i class="text-secondary nav-icon far fa-circle"></i>
                        <p> <?php echo lang('payments'); ?> </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="finance/addPaymentView">
                        <i class="text-secondary nav-icon far fa-circle"></i>
                        <p> <?php echo lang('add_payment'); ?> </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="finance/dueCollection"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p> <?php echo lang('due_collection'); ?> </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="finance/paymentCategory">
                        <i class="text-secondary nav-icon far fa-circle"></i>
                        <p> <?php echo lang('payment_procedures'); ?> </p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="finance/expense">
                <i class="text-secondary nav-icon fas fa-money-check"></i>
                <p> <?php echo lang('expense'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="finance/addExpenseView">
                <i class="text-secondary nav-icon fas fa-plus-circle"></i>
                <p> <?php echo lang('add_expense'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="finance/expenseCategory">
                <i class="text-secondary nav-icon far fa-edit"></i>
                <p> <?php echo lang('expense_categories'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="finance/doctorsCommission">
                <i class="text-secondary nav-icon far fa-edit"></i>
                <p> <?php echo lang('doctors_commission'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="finance/financialReport">
                <i class="text-secondary nav-icon fas fa-book"></i>
                <p> <?php echo lang('financial_report'); ?> </p>
            </a>
        </li>
    <?php } ?>
<?php } ?>

<?php if ($this->ion_auth->in_group('Nurse')) { ?>
    <?php if (in_array('bed', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="bed">
                <i class="text-secondary nav-icon fas fa-procedures"></i>
                <p> <?php echo lang('bed_list'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="bed/bedCategory">
                <i class="text-secondary nav-icon far fa-edit"></i>
                <p> <?php echo lang('bed_category'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="bed/bedAllotment">
                <i class="text-secondary nav-icon fas fa-plus-circle"></i>
                <p> <?php echo lang('bed_allotments'); ?> </p>
            </a>
        </li>
    <?php } ?>

<?php } ?>
<?php if ($this->ion_auth->in_group('Patient')) { ?>

    <?php if (in_array('donor', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="donor">
                <i class="text-secondary nav-icon far fa-user"></i>
                <p><?php echo lang('donor'); ?></p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('notice', $this->modules)) { ?>
        <li class="nav-item"><a class="nav-link text-white" href="notice"><i class="text-secondary nav-icon fas fa-bell"></i>
                <p><?php echo lang('notice'); ?></p>
            </a></li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group('im')) { ?>
    <li class="nav-item">
        <a class="nav-link text-white" href="patient/addNewView">
            <i class="text-secondary nav-icon far fa-user"></i>
            <p> <?php echo lang('add_patient'); ?> </p>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white" href="finance/addPaymentView">
            <i class="text-secondary nav-icon far fa-user"></i>
            <p> <?php echo lang('add_payment'); ?> </p>
        </a>
    </li>
<?php } ?>


<?php if (!$this->ion_auth->in_group(array('admin', 'Patient', 'superadmin'))) { ?>
    <!-- <li class="nav-item">
        <a class="nav-link text-white" href="#">
            <i class="text-secondary nav-icon far fa-envelope"></i>
            <p>
                <?php echo lang('email'); ?>
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link text-white" href="email/sendView"><i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('new'); ?></p>
                </a></li>
        </ul>
    </li> -->
<?php } ?>

<?php if ($this->ion_auth->in_group('Doctor')) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('configuration'); ?></li>
    <li class=" nav-item">
        <a class="nav-link text-white" href="meeting/settings">
            <i class="text-secondary nav-icon fas fa-cog"></i>
            <p>Zoom <?php echo lang('settings'); ?></p>
        </a>
    </li>

<?php } ?>

<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('donor', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon fas fa-hand-holding-water"></i>
                <p><?php echo lang('donor') ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link text-white" href="donor"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('donor_list'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="donor/addDonorView"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_donor'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="donor/bloodBank"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('blood_bank'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('Nurse', 'Accountant', 'Pharmacist', 'Laboratorist', 'Receptionist'))) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('configuration'); ?></li>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Pharmacist', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>

    <?php if (in_array('file', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon far fa-clock"></i>
                <p><?php echo lang('file_manager'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link text-white" href="file"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('all'); ?> <?php echo lang('file'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="file/addNewView"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_file'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>

<?php if ($this->ion_auth->in_group(array('Laboratorist'))) { ?>
    <?php if (in_array('donor', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon fas fa-hand-holding-water"></i>
                <p><?php echo lang('donor') ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link text-white" href="donor"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('donor_list'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="donor/addDonorView"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_donor'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="donor/bloodBank"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('blood_bank'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>


<?php if ($this->ion_auth->in_group('superadmin')) { ?>
    <?php if (in_array('superadmin', $this->super_modules)) { ?>
        <li class=" nav-item">
            <a class="nav-link text-white" href="superadmin">
                <i class="text-secondary nav-icon fas fa-users"></i>
                <p><?php echo lang('superadmin'); ?></p>
            </a>
        </li>
    <?php } ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('subscription_management'); ?></li>
    <?php if (in_array('hospital', $this->super_modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="hospital">
                <i class="text-secondary nav-icon fas fa-sitemap"></i>
                <p><?php echo lang('all_hospitals'); ?></p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="hospital/addNewView">
                <i class="text-secondary nav-icon fas fa-plus-circle"></i>
                <p><?php echo lang('create_new_hospital'); ?></p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('package', $this->super_modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="hospital/package">
                <i class="text-secondary nav-icon fas fa-sitemap"></i>
                <p><?php echo lang('packages'); ?></p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="hospital/package/addNewView">
                <i class="text-secondary nav-icon fas fa-plus-circle"></i>
                <p><?php echo lang('add_new_package'); ?></p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('request', $this->super_modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="request">
                <i class="text-secondary nav-icon fas fa-sitemap"></i>
                <p><?php echo lang('subscription'); ?> <?php echo lang('requests'); ?></p>
            </a>
        </li>
    <?php } ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('report-h'); ?></li>
    <?php if (in_array('systems', $this->super_modules)) { ?>
        <li class="nav-item"><a class="nav-link text-white" href="systems/activeHospitals"><i class="text-secondary nav-icon fas fa-hospital"></i>
                <p><?php echo lang('active_hospitals'); ?></p>
            </a></li>
        <li class="nav-item"><a class="nav-link text-white" href="systems/inactiveHospitals"><i class="text-secondary nav-icon fas fa-hospital-alt"></i>
                <p><?php echo lang('inactive_hospitals'); ?></p>
            </a></li>
        <li class="nav-item"><a class="nav-link text-white" href="systems/expiredHospitals"><i class="text-secondary nav-icon fas fa-calendar-times"></i>
                <p><?php echo lang('expired'); ?></p>
            </a></li>
        <li class="nav-item"><a class="nav-link text-white" href="systems/registeredPatient"><i class="text-secondary nav-icon fas fa-user-injured"></i>
                <p><?php echo lang('registered_patient'); ?></p>
            </a></li>
        <li class="nav-item"><a class="nav-link text-white" href="systems/registeredDoctor"><i class="text-secondary nav-icon fas fa-user-md"></i>
                <p><?php echo lang('registered_doctor'); ?></p>
            </a></li>
        <li class="nav-item"><a class="nav-link text-white" href="hospital/reportSubscription"><i class="text-secondary nav-icon fas fa-file-invoice-dollar"></i>
                <p><?php echo lang('subscription_report'); ?></p>
            </a></li>
        <!-- <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon far fa-file-excel"></i>
                <p><?php echo lang('report'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
               
            </ul>
        </li> -->
    <?php } ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('website_management'); ?></li>
    <li class="nav-item"><a class="nav-link text-white" href="frontend" target="_blank"><i class="text-secondary nav-icon fas fa-external-link-alt"></i>
            <p><?php echo lang('visit_site'); ?></p>
        </a></li>
    <li class="nav-item"><a class="nav-link text-white" href="frontend/settings"><i class="text-secondary nav-icon fas fa-cog"></i>
            <p><?php echo lang('website_settings'); ?></p>
        </a></li>
    <?php if (in_array('slide', $this->super_modules)) { ?>
        <li class="nav-item"><a class="nav-link text-white" href="slide"><i class="text-secondary nav-icon fas fa-images"></i>
                <p><?php echo lang('slides'); ?></p>
            </a></li>
    <?php } ?>
    <?php if (in_array('service', $this->super_modules)) { ?>
        <li class="nav-item"><a class="nav-link text-white" href="service"><i class="text-secondary nav-icon fas fa-star"></i>
                <p><?php echo lang('reviews'); ?></p>
            </a></li>
    <?php } ?>
    <!-- <li class="nav-item"><a class="nav-link text-white" href="facilitie"><i class="text-secondary nav-icon fas fa-building"></i>
                    <p><?php echo lang('facilities'); ?></p>
                </a></li> -->
    <li class="nav-item"><a class="nav-link text-white" href="faq"><i class="text-secondary nav-icon fas fa-question-circle"></i>
            <p><?php echo lang('faqs'); ?></p>
        </a></li>
    <!-- <li class="nav-item">
        <a class="nav-link text-white" href="#">
            <i class="text-secondary nav-icon fas fa-cogs"></i>
            <p><?php echo lang('website'); ?><i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
           
        </ul>
    </li> -->
<?php } ?>
<?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('communication'); ?></li>
    <?php if (in_array('email', $this->super_modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="text-secondary nav-icon far fa-envelope"></i>
                <p><?php echo lang('email'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link text-white" href="email/superadminSendView"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('new'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="email/sent"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('sent'); ?></p>
                    </a></li>

                <li class="nav-item"><a class="nav-link text-white" href="email/emailSettings"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('settings'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="email/contactEmailSettings"><i class="text-secondary nav-icon far fa-circle"></i>
                        <p><?php echo lang('contact'); ?> <?php echo lang('email'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('configuration'); ?></li>
    <li class="nav-item"><a class="nav-link text-white" href="settings"><i class="text-secondary nav-icon fas fa-cog"></i>
            <p><?php echo lang('system_settings'); ?></p>
        </a></li>
    <li class="nav-item"><a class="nav-link text-white" href="settings/googleReCaptcha"><i class="text-secondary nav-icon fas fa-cog"></i>Google reCAPTCHA</a></li>
    <?php if (in_array('pgateway', $this->super_modules)) { ?>
        <li class="nav-item"><a class="nav-link text-white" href="pgateway"><i class="text-secondary nav-icon far fa-credit-card"></i>
                <p><?php echo lang('payment_gateway'); ?></p>
            </a></li>
    <?php } ?>
    <li class="nav-item"><a class="nav-link text-white" href="settings/language"><i class="text-secondary nav-icon fas fa-language"></i>
            <p><?php echo lang('language'); ?></p>
        </a></li>
    <!-- <li class="nav-item"><a class="nav-link text-white" href="settings/verifyPurchase"><i class="text-secondary nav-icon far fa-arrow-right"></i> <p></p> <?php echo lang('purchase_code'); ?></a></li> -->
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <li class="nav-item">
        <a class="nav-link text-white" href="#">
            <i class="text-secondary nav-icon fas fa-history"></i>
            <p><?php echo lang('logs'); ?><i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link text-white" href="transactionLogs"><i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('transaction_logs'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link text-white" href="logs"><i class="text-secondary nav-icon far fa-circle"></i>
                    <p><?php echo lang('user'); ?> <?php echo lang('login_logs'); ?></p>
                </a></li>
        </ul>
    </li>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('Nurse'))) { ?>
    <?php if (in_array('donor', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="donor">
                <i class="text-secondary nav-icon fas fa-medkit"></i>
                <p> <?php echo lang('donor'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="donor/bloodBank">
                <i class="text-secondary nav-icon fas fa-tint"></i>
                <p> <?php echo lang('blood_bank'); ?> </p>
            </a>
        </li>
    <?php } ?>
<?php } ?>
<li class="nav-item">
    <a class="nav-link text-white" href="profile">
        <i class="text-secondary nav-icon fas fa-user"></i>
        <p> <?php echo lang('profile'); ?> </p>
    </a>
</li>
<?php if ($this->ion_auth->in_group('admin')) { ?>
    <li class="nav-item">
        <a class="nav-link text-white" href="settings/subscription">
            <i class="text-secondary nav-icon far fa-user"></i>
            <p> <?php echo lang('subscription'); ?> </p>
        </a>
    </li>
<?php } ?>

<li class="nav-item">
    <a class="nav-link text-white" href="auth/logout">
        <i class="text-secondary nav-icon fas fa-sign-out-alt"></i>
        <p> <?php echo lang('log_out'); ?> </p>
    </a>
</li>




<?php if ($this->ion_auth->in_group(array('admin', 'superadmin'))) { ?>
    <li class="nav-header text-orange text-md fw-bold"><?php echo lang('help_support'); ?></li>
    <li class="nav-item">
        <a class="nav-link text-white" target="_blank" href="http://support.codearistos.net/help-center/articles/10/11/27/introduction">
            <i class="text-secondary nav-icon fas fa-question-circle"></i>
            <p><?php echo lang('help_center'); ?></p>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link text-white" href="mailto:rizvi.mahmud.plabon@gmail.com">
            <i class="text-secondary nav-icon fas fa-envelope"></i>
            <p><?php echo lang('contact_us'); ?></p>
        </a>
    </li>
<?php } ?>



<li class="nav-item mt-5 mb-5">
    <div class="text-center">
        <i class="fas fa-hospital fa-3x text-secondary"></i>
        <p class="text-muted mt-2">
        </p>
        <small class="text-muted">© <?php echo date('Y'); ?> <?php echo lang('all_rights_reserved'); ?></small>
    </div>
</li>