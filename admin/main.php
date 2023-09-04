<?php
ob_start();
$pagetitle = 'Home';
session_start();
include 'init.php';

if (isset($_SESSION['admin_username'])) {
    include 'include/navbar.php';
}
if (isset($_SESSION['supervisor_username'])) {
    include 'include/supervisor_navbar.php';
}
if (isset($_SESSION['public_super_username'])) {
    include 'include/public_super_navbar.php';
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php
    $page = '';
    if (isset($_GET['page']) && isset($_GET['dir'])) {
        $page = $_GET['page'];
        $dir = $_GET['dir'];
    } else {
        $page = 'manage';
    }
    // start Website Routes 
    // STRAT DASHBAORD
    if ($dir == 'dashboard' && $page == 'dashboard') {
        include 'dashboard.php';
    } elseif ($dir == 'dashboard' && $page == 'supervisor_dashboard') {
        include 'supervisor_dashboard.php';
    } elseif ($dir == 'dashboard' && $page == 'public_super_dashboard') {
        include 'public_super_dashboard.php';
    }
    // END DASHBAORD
    // START Main University 

    if ($dir == 'main_university' && $page == 'add') {
        include "main_university/add.php";
    } elseif ($dir == 'main_university' && $page == 'edit') {
        include "main_university/edit.php";
    } elseif ($dir == 'main_university' && $page == 'delete') {
        include 'main_university/delete.php';
    } elseif ($dir == 'main_university' && $page == 'report') {
        include "main_university/report.php";
    }
    // START University Branches 

    if ($dir == 'university_branches' && $page == 'add') {
        include "university_branches/add.php";
    } elseif ($dir == 'university_branches' && $page == 'edit') {
        include "university_branches/edit.php";
    } elseif ($dir == 'university_branches' && $page == 'delete') {
        include 'university_branches/delete.php';
    } elseif ($dir == 'university_branches' && $page == 'report') {
        include "university_branches/report.php";
    } elseif ($dir == 'university_branches' && $page == 'students') {
        include "university_branches/students.php";
    }

    // START SuperVisor
    if ($dir == 'supervisor' && $page == 'add') {
        include "supervisor/add.php";
    } elseif ($dir == 'supervisor' && $page == 'edit') {
        include "supervisor/edit.php";
    } elseif ($dir == 'supervisor' && $page == 'delete') {
        include 'supervisor/delete.php';
    } elseif ($dir == 'supervisor' && $page == 'report') {
        include "supervisor/report.php";
    }
    // START Public SuperVisor
    if ($dir == 'public_supervisor' && $page == 'add') {
        include "public_supervisor/add.php";
    } elseif ($dir == 'public_supervisor' && $page == 'edit') {
        include "public_supervisor/edit.php";
    } elseif ($dir == 'public_supervisor' && $page == 'delete') {
        include 'public_supervisor/delete.php';
    } elseif ($dir == 'public_supervisor' && $page == 'report') {
        include "public_supervisor/report.php";
    }
    // START Students
    if ($dir == 'students' && $page == 'add') {
        include "students/add.php";
    } elseif ($dir == 'students' && $page == 'edit') {
        include "students/edit.php";
    } elseif ($dir == 'students' && $page == 'delete') {
        include 'students/delete.php';
    } elseif ($dir == 'students' && $page == 'report') {
        include "students/report.php";
    }
    // START Reports 
    if ($dir == 'reports' && $page == 'branch_report') {
        include "reports/branch_report.php";
    } elseif ($dir == 'reports' && $page == 'main_university_report') {
        include "reports/main_university_report.php";
    } elseif ($dir == 'reports' && $page == 'student_report') {
        include 'reports/student_report.php';
    }
    ?>

</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>



<?php
include $tem . "footer.php";
?>