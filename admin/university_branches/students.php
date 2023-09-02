<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> الطلاب </h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="main.php?dir=dashboard&page=dashboard">الرئيسية</a></li>
                    <li class="breadcrumb-item active"> طلاب الجهه الفرعية </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content-header -->
<!-- DOM/Jquery table start -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <!--  <button type="button" class="btn btn-primary waves-effect btn-sm"> حضور المحدد </button> -->
                        <form action="" method="post">
                            <button name="absent_all" type="submit" class="btn btn-danger waves-effect btn-sm"> غياب باقي الطلاب </button>
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

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="my_table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> جهه الأشراف </th>
                                        <th> الاسم </th>
                                        <th> رقم الهوية </th>
                                        <th> الفرقة التدريبية </th>
                                        <th> البريد الألكتروني </th>
                                        <th> رقم الهاتف </th>
                                        <th> العمليات </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $brach_id = $_GET['branch'];
                                    $stmt = $connect->prepare("SELECT * FROM students WHERE university_branch = ? ORDER BY id DESC");
                                    $stmt->execute(array($brach_id));
                                    $allcat = $stmt->fetchAll();
                                    $i = 0;
                                    foreach ($allcat as $cat) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td> <?php
                                                    $stmt = $connect->prepare("SELECT * FROM university_branches WHERE id = ?");
                                                    $stmt->execute(array($cat['university_branch']));
                                                    $uni_branch_data = $stmt->fetch();
                                                    // get the branch name
                                                    echo  $uni_branch_data['name'];
                                                    // get the main branch 
                                                    $stmt = $connect->prepare("SELECT * FROM main_university WHERE id = ?");
                                                    $stmt->execute(array($uni_branch_data['main_university']));
                                                    $uni_main_data = $stmt->fetch();
                                                    ?> <span class="badge badge-info"> <?php echo  $uni_main_data['name']; ?> </span>
                                            </td>
                                            <td> <?php echo  $cat['name']; ?> </td>
                                            <td> <?php echo  $cat['id_number']; ?> </td>
                                            <td> <?php echo  $cat['employe_name']; ?> </td>
                                            <td> <?php echo  $cat['email']; ?> </td>
                                            <td> <?php echo  $cat['phone']; ?> </td>
                                            <td>
                                                <?php
                                                $date = date("Y-m-d");
                                                $student_id = $cat['id'];
                                                // check user if attend in this date or not
                                                $stmt = $connect->prepare("SELECT * FROM attendance WHERE student_id = ? AND attend_date = ?");
                                                $stmt->execute(array($student_id, $date));
                                                $student_data = $stmt->fetch();
                                                $count_row = $stmt->rowCount();
                                                // check user in absent table
                                                $stmt = $connect->prepare("SELECT * FROM absent_student WHERE student_id=? AND absent_date=?");
                                                $stmt->execute(array($student_id, $date));
                                                $student_absent_data = $stmt->fetch();
                                                $count_absent = $stmt->rowCount();
                                                if ($count_row > 0) {
                                                ?>
                                                    <span class="badge badge-success"> تم الحضور </span>
                                                <?php

                                                } elseif ($count_absent > 0) {
                                                ?>
                                                    <span class="badge badge-danger"> غياب </span>
                                                <?php
                                                } else {
                                                ?>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="student_id" value="<?php echo $cat['id'] ?>">
                                                        <button class="btn btn-primary btn-sm" type="submit" name="attend_student"> حضور </button>
                                                    </form>
                                                <?php
                                                }
                                                ?>
                                                <!-- Update Attendance Table -->
                                                <?php
                                                if (isset($_POST['attend_student'])) {
                                                    $student_id = $_POST['student_id'];
                                                    $attend_time = date("n/j/Y g:i A");
                                                    $brach_id = $cat['university_branch'];
                                                    $stmt = $connect->prepare("INSERT INTO attendance (student_id ,attend_date,attend_time,branch_id)
                                                    VALUES (:zstudent_id,:zattend_date,:zattend_time,:zbranch_id)");
                                                    $stmt->execute(array(
                                                        "zstudent_id" => $student_id,
                                                        "zattend_date" => $date,
                                                        "zattend_time" => $attend_time,
                                                        "zbranch_id" => $brach_id,
                                                    ));
                                                    if ($stmt) {
                                                        header("location:main.php?dir=university_branches&page=students&branch=" . $brach_id);
                                                        exit();
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Absent All Another Students -->
<?php
if (isset($_POST['absent_all'])) {
    // get all student in the branch 
    $stmt = $connect->prepare("SELECT * FROM students WHERE university_branch =?");
    $stmt->execute(array($brach_id));
    $allstudents = $stmt->fetchAll();
    foreach ($allstudents as $student) {
        $student_id = $student['id'];
        // check if student is attendace table or not
        $stmt = $connect->prepare("SELECT * FROM attendance WHERE student_id = ?");
        $stmt->execute(array($student_id));
        $student_attend_data = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) {
        } else {
            // insert this student in absent table
            $stmt = $connect->prepare("INSERT INTO absent_student (student_id ,absent_date,branch_id)
            VALUES (:zstudent_id,:zattend_date,:zbranch_id)");
            $stmt->execute(array(
                "zstudent_id" => $student_id,
                "zattend_date" => $date,
                "zbranch_id" => $brach_id,
            ));
        }
    }
    if ($stmt) {
        header("location:main.php?dir=university_branches&page=students&branch=" . $brach_id);
        exit();
    }
}
?>