    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
      </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="main.php?dir=dashboard&page=dashboard" class="brand-link">
        <span class="brand-text font-weight-light"> نظام الحضور والغياب </span>
        <!--<img src="uploads/logo.png" alt="AdminLTE Logo" class="brand-image elevation-3" style="box-shadow: none;">-->
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <!-- <img src="uploads/logo.png" class="img-circle elevation-2" alt="User Image"> -->
          </div>
          <div class="info">
            <a href="#" class="d-block"> <?php echo $_SESSION['admin_username']; ?> </a>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="main.php?dir=dashboard&page=dashboard" class="nav-link">
                <p>
                  الرئيسية
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  الجهات الرئيسية
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=main_university&page=report" class="nav-link">
                    <p> مشاهدة الكل </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  الجهات الفرعية
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=university_branches&page=report" class="nav-link">
                    <p> مشاهدة الكل </p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="logout" class="nav-link" style="color: #e74c3c;">
                <p>
                  تسجيل خروج
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>