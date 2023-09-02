<?php
if (isset($_POST['add_cat'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $location = $_POST['location'];

    $formerror = [];
    if (empty($name)) {
        $formerror[] = '  من فضلك ادخل اسم الجهه الرئيسية ';
    }


    $stmt = $connect->prepare("SELECT * FROM main_university WHERE name = ?");
    $stmt->execute(array($name));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $formerror[] = ' اسم الجهه موجود من قبل من فضلك ادخل اسم اخر  ';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("INSERT INTO main_university (name, email,location)
        VALUES (:zname,:zemail,:zlocation)");
        $stmt->execute(array(
            //"zparent" => $parent,
            "zname" => $name,
            "zemail" => $email,
            "zlocation" => $location
        ));
        if ($stmt) {
            $_SESSION['success_message'] = " تمت الأضافة بنجاح  ";
            header('Location:main?dir=main_university&page=report');
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=main_university&page=report');
        exit();
    }
}
