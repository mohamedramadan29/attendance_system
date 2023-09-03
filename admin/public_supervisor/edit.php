<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> المشرف العام  </h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="main.php?dir=dashboard&page=dashboard">الرئيسية</a></li>
                    <li class="breadcrumb-item active"> تعديل مشرف </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content-header -->
<!-- GET THE SUPERVISOR DATA -->
<?php
if (isset($_GET['super_id'])) {
    $super_id = $_GET['super_id'];
    $stmt = $connect->prepare("SELECT * FROM public_supervisor WHERE id = ?");
    $stmt->execute(array($super_id));
    $super_data = $stmt->fetch();
}

?>
<!-- GET THE SUPERVISOR DATA -->
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
                                    <label for="Company-2" class="block"> الأسم </label>
                                    <input required id="Company-2" name="name" type="text" class="form-control required" value="<?php echo $super_data['name']; ?>">
                                </div> 
                                <div class="form-group">
                                    <label for="Company-2" class="block"> النوع </label>
                                    <select required name="kind" id="" class="form-control select2">
                                        <option value=""> -- حدد النوع -- </option>
                                        <option <?php if ($super_data['kind'] == 'ذكر')   echo 'selected' ?> value="ذكر"> ذكر </option>
                                        <option <?php if ($super_data['kind'] == 'انثي') echo 'selected' ?> value="انثي"> انثي </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Company-2" class="block"> رقم الهوية </label>
                                    <input required id="Company-2" name="id_number" type="text" class="form-control required" value="<?php echo $super_data['id_number']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Company-2" class="block"> المسمي الوظيفي </label>
                                    <input required id="Company-2" name="employe_name" type="text" class="form-control required" value="<?php echo $super_data['employe_name']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Company-2" class="block"> البريد الألكتروني </label>
                                <input id="Company-2" name="email" type="email" class="form-control required" value="<?php echo $super_data['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="Company-2" class="block"> رقم الهاتف </label>
                                <input id="Company-2" name="phone" type="text" class="form-control required" value="<?php echo $super_data['phone']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="Company-2" class="block"> اسم المستخدم </label>
                                <input id="Company-2" name="user_name" type="text" class="form-control required" value="<?php echo $super_data['user_name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="Company-2" class="block"> كلمة المرور </label>
                                <input id="Company-2" name="password" type="text" class="form-control required" value="<?php echo $super_data['password']; ?>">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="edit_cat" class="btn btn-primary waves-effect waves-light "> تعديل المشرف </button>

                                <a class="btn btn-default waves-effect " href="main.php?dir=supervisor&page=report"> رجوع </a>
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
if (isset($_POST['edit_cat'])) { 
    $name = $_POST['name'];
    $kind = $_POST['kind'];
    $id_number = $_POST['id_number'];
    $employe_name = $_POST['employe_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    $formerror = [];
    if (
        empty($id_number)   || empty($name) || empty($kind) || empty($employe_name) || empty($email)
        || empty($phone) || empty($user_name) || empty($password)
    ) {
        $formerror[] = ' من فضلك ادخل جميع المعلومات ';
    }
    $stmt = $connect->prepare("SELECT * FROM public_supervisor WHERE id_number = ? AND id !=?");
    $stmt->execute(array($id_number, $super_id));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $formerror[] = ' رقم الهوية الوطنية موجود من قبل   ';
    }
    $stmt = $connect->prepare("SELECT * FROM public_supervisor WHERE user_name = ? AND id !=?");
    $stmt->execute(array($user_name,$super_id));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $formerror[] = ' اسم المستخدم موجود من قبل من فضلك ادخل اسم مستخدم اخر  ';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE public_supervisor SET user_name=?,name=?,kind=?,id_number=?,employe_name=?,email=?,phone=?,password=? WHERE id = ?");
        $stmt->execute(array(
            $user_name, $name,  $kind, $id_number, $employe_name,  $email,
            $phone, $password, $super_id
        ));
        if ($stmt) {
            $_SESSION['success_message'] = " تمت التعديل  بنجاح  ";
            header('Location:main?dir=public_supervisor&page=report');
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
