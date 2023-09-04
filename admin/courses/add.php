<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> الكورسات </h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="main.php?dir=dashboard&page=dashboard">الرئيسية</a></li>
                    <li class="breadcrumb-item active"> اضافة كورس جديد </li>
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
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">

                <div class="col-lg-6">
                    <div class="card">
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
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="Company-2" class="block"> اسم الكورس </label>
                                    <input required id="Company-2" name="name" type="text" class="form-control required" value="<?php if (isset($_REQUEST['name'])) echo $_REQUEST['name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Company-2" class="block"> بداية الكورس </label>
                                    <input required id="Company-2" name="from_date" type="date" class="form-control required" value="<?php if (isset($_REQUEST['id_number'])) echo $_REQUEST['id_number']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Company-2" class="block"> نهاية الكورس </label>
                                    <input required id="Company-2" name="to_date" type="date" class="form-control required" value="<?php if (isset($_REQUEST['employe_name'])) echo $_REQUEST['employe_name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Company-2" class="block"> اسم المحاضر </label>
                                    <input required id="Company-2" name="teacher_name" type="text" class="form-control required" value="<?php if (isset($_REQUEST['name'])) echo $_REQUEST['name']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Company-2" class="block"> العدد المتاح </label>
                                <input id="Company-2" name="student_num" type="number" class="form-control required" value="<?php if (isset($_REQUEST['email'])) echo $_REQUEST['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="Company-2" class="block"> وصف الكورس </label>
                                <textarea id="Company-2" name="course_desc" type="text" class="form-control required"><?php if (isset($_REQUEST['course_desc'])) echo $_REQUEST['course_desc']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="Company-2" class="block"> صورة الكورس </label>
                                <input id="Company-2" id="dropify" name="main_image" type="file" class="form-control required">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="add_cat" class="btn btn-primary waves-effect waves-light "> حفظ </button>
                                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal"> رجوع </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?php
if (isset($_POST['add_cat'])) {
    $name = $_POST['name'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $teacher_name = $_POST['teacher_name'];
    $student_num = $_POST['student_num'];
    $course_desc = $_POST['course_desc'];

    $formerror = [];
    // main image
    if (empty($formerror)) {
        if (!empty($_FILES['main_image']['name'])) {
            $main_image_name = $_FILES['main_image']['name'];
            $main_image_name = str_replace(' ', '-', $main_image_name);
            $main_image_temp = $_FILES['main_image']['tmp_name'];
            $main_image_type = $_FILES['main_image']['type'];
            $main_image_size = $_FILES['main_image']['size'];
            // حصل على امتداد الصورة من اسم الملف المرفوع
            $image_extension = pathinfo($main_image_name, PATHINFO_EXTENSION);
            $main_image_uploaded = $main_image_name . '.' . $image_extension;
            move_uploaded_file(
                $main_image_temp,
                'courses/images/' . $main_image_uploaded
            );
        } else {
            $formerror[] = ' من فضلك ادخل صورة  الكورس   ';
        }
    }
    if (
        empty($name) || empty($from_date) || empty($to_date) || empty($teacher_name) || empty($student_num) || empty($course_desc)
    ) {
        $formerror[] = ' من فضلك ادخل جميع المعلومات ';
    }
    $stmt = $connect->prepare("SELECT * FROM courses WHERE name = ?");
    $stmt->execute(array($name));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $formerror[] = ' الكورس متواجد من قبل من فضلك ادخل اسم جديد  ';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("INSERT INTO courses (name,from_date,to_date,teacher_name,student_num,course_desc,course_image)
        VALUES (:zname,:zfrom_date,:zto_date,:zteacher_name,:zstudent_num,:zcourse_desc,:zcourse_image)");
        $stmt->execute(array(
            //"zparent" => $parent,
            "zname" => $name,
            "zfrom_date" => $from_date,
            "zto_date" => $to_date,
            "zteacher_name" => $teacher_name,
            "zstudent_num" => $student_num,
            "zcourse_desc" => $course_desc,
            "zcourse_image" => $main_image_uploaded,
        ));
        if ($stmt) {
            $_SESSION['success_message'] = " تمت الأضافة بنجاح  ";
            header('Location:main?dir=courses&page=report');
        }
    } else {
        foreach ($formerror as $error) {
?>
            <li class="alert alert-danger"> <?php echo $error ?> </li>
<?php
        }
        //header('Location:main?dir=supervisor&page=add');

    }
}
