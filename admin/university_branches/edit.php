<?php
if (isset($_POST['edit_cat'])) {
    $uni_id = $_POST['uni_id'];
    $name = $_POST['name'];
    $main_university = $_POST['main_university'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $formerror = [];
    if (empty($name)) {
        $formerror[] = 'من فضلك ادخل اسم الجهه ';
    }
    $stmt = $connect->prepare("SELECT * FROM university_branches WHERE name = ? AND id !=?");
    $stmt->execute(array($name, $uni_id));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $formerror[] = ' اسم القسم موجود من قبل من فضلك ادخل اسم اخر  ';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE university_branches SET main_university=?,name=?,email=?,location=? WHERE id = ? ");
        $stmt->execute(array($main_university, $name, $email, $location, $uni_id));

        if ($stmt) {
            $_SESSION['success_message'] = "تم التعديل بنجاح ";
            header('Location:main?dir=university_branches&page=report');
            exit();
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=university_branches&page=report');
        exit();
    }
}
