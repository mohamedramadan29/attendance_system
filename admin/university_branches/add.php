<?php
if (isset($_POST['add_cat'])) {
    $name = $_POST['name'];
    $main_university = $_POST['main_university'];
    $email = $_POST['email'];
    $location = $_POST['location'];

    $formerror = [];
    if (empty($name)) {
        $formerror[] = '  من فضلك ادخل اسم الجهه الفرعية  ';
    }


    $stmt = $connect->prepare("SELECT * FROM university_branches WHERE name = ?");
    $stmt->execute(array($name));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $formerror[] = ' اسم الجهه موجود من قبل من فضلك ادخل اسم اخر  ';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("INSERT INTO university_branches (main_university,name, email,location)
        VALUES (:zmain_university,:zname,:zemail,:zlocation)");
        $stmt->execute(array(
            //"zparent" => $parent,
            "zmain_university" => $main_university,
            "zname" => $name,
            "zemail" => $email,
            "zlocation" => $location
        ));
        if ($stmt) {
            $_SESSION['success_message'] = " تمت الأضافة بنجاح  ";
            header('Location:main?dir=university_branches&page=report');
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=university_branches&page=report');
        exit();
    }
}
