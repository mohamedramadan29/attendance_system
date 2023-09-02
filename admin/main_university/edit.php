<?php
if (isset($_POST['edit_cat'])) {
    $uni_id = $_POST['uni_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $formerror = [];
    if (empty($name)) {
        $formerror[] = 'من فضلك ادخل اسم الجهه ';
    }
    $stmt = $connect->prepare("SELECT * FROM main_university WHERE name = ? AND id !=?");
    $stmt->execute(array($name, $uni_id));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $formerror[] = ' اسم القسم موجود من قبل من فضلك ادخل اسم اخر  ';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE main_university SET name=?,email=?,location=? WHERE id = ? ");
        $stmt->execute(array($name, $email, $location, $uni_id));

        if ($stmt) {
            $_SESSION['success_message'] = "تم التعديل بنجاح ";
            header('Location:main?dir=main_university&page=report');
            exit();
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=main_university&page=report');
        exit();
    }
}
