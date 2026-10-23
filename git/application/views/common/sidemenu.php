<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/images/logo.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo ($_SESSION['memberlevel']==='2')?'Member':'Admin';?></a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php if($_SESSION['memberlevel']<2){?>
            <li class="nav-item menu-open">
            <a href="/members/index" class="nav-link  <?php echo $active['list'];?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Daftar Anggota
              </p>
            </a>
          </li>
          <?php }?>
          <li class="nav-item menu-open">
            <a href="/members/profile" class="nav-link <?php echo $active['profile'];?>">
            <i class="nav-icon fas fa-id-card"></i> 
              <p>
                Profil Anggota
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="/members/showqr/<?php echo $_SESSION['juleha_id']?>" class="nav-link ">
            <i class="nav-icon fas fa-id-card"></i> 
              <p>
                QRCode keanggotaan saya
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="/members/logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i> 
              <p>
                Keluar
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
