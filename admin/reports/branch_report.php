<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> تقرير عن جهه تدريب فرعية </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="main.php?dir=dashboard&page=dashboard">الرئيسية</a></li>
                    <li class="breadcrumb-item active"> تقرير عن جهه تدريب فرعية </li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <form action="" method="post">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-group">
                                    <label for="Company-2" class="block"> اختر الجهه الفرعية </label>
                                    <select style="min-width: 280px;" required name="branch_id" class="form-control select2">
                                        <option value=""> -- اختر الجهه الفرعية -- </option>
                                        <?php
                                        $stmt = $connect->prepare("SELECT * FROM university_branches");
                                        $stmt->execute();
                                        $allbranches = $stmt->fetchAll();
                                        foreach ($allbranches as $branch) {
                                        ?>
                                            <option <?php if (isset($_REQUEST['branch_id']) && $_REQUEST['branch_id'] == $branch["id"]) echo 'selected' ?> value="<?php echo $branch['id']; ?>"> <?php echo $branch['name']; ?> </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Company-2" class="block"> من تاريخ </label>
                                    <input required style="min-width: 280px;" id="Company-2" name="from_date" type="date" class="form-control required" value="<?php if (isset($_REQUEST['from_date'])) echo $_REQUEST['from_date']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Company-2" class="block"> الي تاريخ </label>
                                    <input required style="min-width: 280px;" id="Company-2" name="to_date" type="date" class="form-control required" value="<?php if (isset($_REQUEST['to_date'])) echo $_REQUEST['to_date']; ?>">
                                </div>
                                <div class="form-group">
                                    <button style="margin-top: 30px;" class="btn btn-primary" name="show_report" type="submit"> عرض تقرير </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                    if (isset($_SESSION['success_message'])) {
                        $message = $_SESSION['success_message'];
                        unset($_SESSION['success_message']);
                    ?>
                        <?php
                        ?>
                        <script src="plugins/jquery/jquery.min.js"></script>
                        <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
                        <script>
                            $(function() {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: '<?php echo $message; ?>',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            })
                        </script>
                        <?php
                    } elseif (isset($_SESSION['error_messages'])) {
                        $formerror = $_SESSION['error_messages'];
                        foreach ($formerror as $error) {
                        ?>
                            <div class="alert alert-danger alert-dismissible" style="max-width: 800px; margin:20px">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <?php echo $error; ?>
                            </div>
                    <?php
                        }
                        unset($_SESSION['error_messages']);
                    }
                    ?>
                    <?php
                    if (isset($_POST['show_report'])) {
                        $branch_id = $_POST['branch_id'];
                        $from_date = $_POST['from_date'];
                        $to_date = $_POST['to_date'];
                        $from_date = date("Y-m-d", strtotime($from_date));
                        $to_date = date("Y-m-d", strtotime($to_date));
                        // get the branch name
                        $stmt = $connect->prepare("SELECT * FROM university_branches WHERE id = ?");
                        $stmt->execute(array($branch_id));
                        $branch_data = $stmt->fetch();
                    ?>
                        <div class="card-body print">
                            <div class="d-flex justify-content-between">
                                <div class="form-group">
                                    <label for=""> الجهه الفرعية :: </label>
                                    <input disabled style="min-width: 280px;" id="Company-2" name="to_date" type="text" class="form-control required" value="<?php echo $branch_data['name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for=""> من تاريخ :: </label>
                                    <input disabled style="min-width: 280px;" id="Company-2" name="to_date" type="text" class="form-control required" value="<?php if (isset($_REQUEST['from_date'])) echo $_REQUEST['from_date']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for=""> الي تاريخ :: </label>
                                    <input disabled style="min-width: 280px;" id="Company-2" name="to_date" type="text" class="form-control required" value="<?php if (isset($_REQUEST['to_date'])) echo $_REQUEST['to_date']; ?>">
                                </div>
                            </div>
                            <div class="table-responsive ">
                                <table id="report_table" class="table table-striped table-bordered">
                                    <?php
                                    $stmt = $connect->prepare("SELECT * FROM students WHERE university_branch  =? ");
                                    $stmt->execute(array($branch_id));
                                    $allcat = $stmt->fetchAll();
                                    $count_student = $stmt->rowCount();
                                    $i = 0;
                                    if ($count_student > 0) {
                                    ?>
                                        <thead>
                                            <tr>
                                                <th> # </th>
                                                <th> جهه الأشراف </th>
                                                <th> الاسم </th>
                                                <th> رقم الهوية </th>
                                                <th> الفرقة التدريبية </th>
                                                <th> البريد الألكتروني </th>
                                                <th> رقم الهاتف </th>
                                                <th> مرات الحضور </th>
                                                <th> مرات الغياب </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($allcat as $cat) {
                                                $i++;
                                            ?>
                                                <tr>
                                                    <td> <?php echo $i; ?> </td>
                                                    <td> <?php echo $branch_data['name'];
                                                            ?>
                                                    </td>
                                                    <td> <?php echo  $cat['name']; ?> </td>
                                                    <td> <?php echo  $cat['id_number']; ?> </td>
                                                    <td> <?php echo  $cat['employe_name']; ?> </td>
                                                    <td> <?php echo  $cat['email']; ?> </td>
                                                    <td> <?php echo  $cat['phone']; ?> </td>
                                                    <td>
                                                        <?php
                                                        // قم بتنفيذ الاستعلام استنادًا إلى تواريخ البداية والنهاية
                                                        if ($from_date !== null && $to_date !== null) {
                                                            $stmt = $connect->prepare("SELECT * FROM attendance WHERE student_id = ? AND attend_date BETWEEN ? AND ?");
                                                            $stmt->execute(array($cat['id'], $from_date, $to_date));
                                                        } elseif ($from_date !== null) {
                                                            $stmt = $connect->prepare("SELECT * FROM attendance WHERE student_id = ? AND attend_date >= ?");
                                                            $stmt->execute(array($cat['id'], $from_date));
                                                        } elseif ($to_date !== null) {
                                                            $stmt = $connect->prepare("SELECT * FROM attendance WHERE student_id = ? AND attend_date <= ?");
                                                            $stmt->execute(array($cat['id'], $to_date));
                                                        }

                                                        // استخدم $stmt->rowCount() بدلاً من count($stmt->fetchAll()) للحصول على عدد النتائج
                                                        $count_num = $stmt->rowCount();

                                                        ?>
                                                        <span class="badge badge-success"> <?php echo $count_num; ?> </span>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $stmt = $connect->prepare("SELECT * FROM absent_student WHERE student_id = ? AND absent_date BETWEEN ? AND ?");
                                                        $stmt->execute(array($cat['id'], $from_date, $to_date));
                                                        $count_num_absent = count($stmt->fetchAll());
                                                        ?>
                                                        <span class="badge badge-danger"> <?php echo $count_num_absent; ?> </span>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr aria-colspan="10">
                                                <td class="text-center"> لا يوجد بيانات </td>
                                            </tr>
                                        <?php
                                        }

                                        ?>
                                </table>
                            </div>
                            <button id="print_Button" onclick="window.print(); return false;" class="btn btn-primary">طباعه التقرير <i class="fa fa-print"></i> </button>
                        </div>
                    <?php
                    }

                    ?>

                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<style>
    @media print {

        .footer,
        .bottom_footer,
        .main_navbar,
        .instagrame_footer {
            display: none !important;
        }

        .print_order {
            max-width: 100% !important;
            padding: 10px !important;
        }

        body {
            background-color: #fff;
        }

        #print_Button {
            display: none !important;
        }

        .card-header {
            display: none !important;
        }

        .table-bordered thead td,
        .table-bordered thead th {
            font-size: 13px;
            font-weight: normal;
        }

        .print-link {
            display: none !important;
        }

        @page {
            margin: 0;
        }

        body {
            margin: 1.6cm;
        }
    }
</style>