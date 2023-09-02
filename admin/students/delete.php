<?php
if (isset($_GET['cat_id']) && is_numeric($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];
    $stmt = $connect->prepare('SELECT * FROM students WHERE id= ?');
    $stmt->execute([$cat_id]);
    $cat_data = $stmt->fetch();

    $stmt = $connect->prepare('DELETE FROM students WHERE id=?');
    $stmt->execute([$cat_id]);
    if ($stmt) {
        $_SESSION['success_message'] = "تم الحذف بنجاح";
        header('Location: main?dir=students&page=report');
        exit(); // Terminate the script after redirecting
    }
}
