<?php
$pagetitle = 'جامعه الباحة - تسجيل دخول ';
ob_start();
session_start();
$Nonavbar = '';
include 'connect.php';
if (isset($_POST['login']) == 'POST' && $_POST['permission'] == 'admin') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $stmt = $connect->prepare(
    'SELECT * FROM admins WHERE username=? AND password=?'
  );
  $stmt->execute([$username, $password]);
  $data = $stmt->fetch();
  $count = $stmt->rowCount();
  if ($count > 0) {
    $_SESSION['admin_username'] = $data['username'];
    $_SESSION['admin_id'] = $data['id'];
    header('Location:main.php?dir=dashboard&page=dashboard');
    exit();
  }
} elseif (isset($_POST['login']) == 'POST' && $_POST['permission'] == 'supervisor') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $stmt = $connect->prepare(
    'SELECT * FROM supervisor WHERE user_name=? AND password=?'
  );
  $stmt->execute([$username, $password]);
  $data = $stmt->fetch();
  $count = $stmt->rowCount();
  if ($count > 0) {
    $_SESSION['supervisor_username'] = $data['user_name'];
    $_SESSION['supervisor_id'] = $data['id'];
    header('Location:main.php?dir=dashboard&page=supervisor_dashboard');
    exit();
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="login_form/fonts/icomoon/style.css">

  <link rel="stylesheet" href="login_form/css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="login_form/css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="login_form/css/style.css">

  <title> جامعه الباحة - تسجيل دخول </title>
</head>

<body>
  <div class="d-md-flex half text-right">
    <div class="bg" style="background-image: url('uploads/header.jpg');"></div>
    <div class="contents">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block mx-auto">
              <div class="text-center mb-5">
                <h3 class="text-uppercase"> تسجيل دخول <strong> </strong></h3>
              </div>
              <form action="" method="POST">
                <div class="form-group first">
                  <label for="username"> اسم المستخدم </label>
                  <input name="username" type="text" class="form-control" placeholder=" اسم المستخدم  " id="username">
                </div>
                <div class="form-group last mb-3">
                  <label for="password">كلمة المرور</label>
                  <input name="password" type="password" class="form-control" placeholder=" كلمة المرور " id="password">
                </div>
                <div class="form-group last mb-3">
                  <label for="password"> اختر الصلاحية </label>
                  <select name="permission" id="" class="form-control select2">
                    <option value=""> -- اختر الصلاحية -- </option>
                    <option value="admin"> الادمن </option>
                    <option value="public_super"> مشرف عام </option>
                    <option value="supervisor"> مشرف </option>
                  </select>
                </div>
                <input style="background-color: #2ecc71; border-color:#2ecc71" name="login" type="submit" value=" تسجيل دخول " class="btn btn-block py-2 btn-primary">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="login_form/js/jquery-3.3.1.min.js"></script>
  <script src="login_form/js/popper.min.js"></script>
  <script src="login_form/js/bootstrap.min.js"></script>
  <script src="login_form/js/main.js"></script>
</body>

</html>