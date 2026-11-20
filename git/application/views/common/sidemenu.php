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
          <?php if (isset($_SESSION['juleha_id'])): ?>
            <a href="#" class="d-block"><?php echo (isset($_SESSION['memberlevel']) && $_SESSION['memberlevel']==='2')?'Member':'Admin';?></a>
          <?php else: ?>
            <a href="/members/login" class="d-block text-white font-weight-bold">Tamu / Belum Login</a>
          <?php endif; ?>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <?php if(isset($_SESSION['memberlevel']) && (int)$_SESSION['memberlevel'] < 2){ ?>
          <!-- ADMIN MENUS -->
          <li class="nav-item">
            <a href="/members/index" class="nav-link <?php echo ($active['list'] ?? '');?>">
              <i class="nav-icon fas fa-table"></i>
              <p>Daftar Anggota</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/members/analisis" class="nav-link <?php echo ($active['analisis'] ?? '');?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>Analisis Keanggotaan</p>
            </a>
          </li>
          <li class="nav-item <?php echo !empty($active['praktek']) ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo ($active['praktek'] ?? ''); ?>">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>
                Presensi & Praktik
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/prakteks/scan" class="nav-link <?php echo ($active['praktek_scan'] ?? ''); ?>">
                  <i class="fas fa-qrcode nav-icon"></i>
                  <p>Scan Presensi KTA</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/prakteks/index" class="nav-link <?php echo ($active['praktek_index'] ?? ''); ?>">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Riwayat & Data Praktik</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/prakteks/rekap_anggota" class="nav-link <?php echo ($active['praktek_rekap'] ?? ''); ?>">
                  <i class="fas fa-users-cog nav-icon"></i>
                  <p>Rekap per Anggota</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/prakteks/instruktur" class="nav-link <?php echo ($active['praktek_instruktur'] ?? ''); ?>">
                  <i class="fas fa-chalkboard-teacher nav-icon"></i>
                  <p>Daftar Instruktur</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else { ?>
          <!-- MEMBER MENUS -->
          <li class="nav-item">
            <a href="/prakteks/my_history" class="nav-link <?php echo ($active['praktek_my'] ?? ''); ?>">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>Riwayat Praktik Saya</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/prakteks/scan" class="nav-link <?php echo ($active['praktek_scan'] ?? ''); ?>">
              <i class="nav-icon fas fa-qrcode"></i>
              <p>Scan Presensi Praktik</p>
            </a>
          </li>
          <?php } ?>

          <?php if (isset($_SESSION['juleha_id'])): ?>
          <li class="nav-item">
            <a href="/members/profile" class="nav-link <?php echo ($active['profile'] ?? '');?>">
              <i class="nav-icon fas fa-id-card"></i> 
              <p>Profil Anggota</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/members/showqr/<?php echo $_SESSION['juleha_id'] ?? ''; ?>" class="nav-link">
              <i class="nav-icon fas fa-qrcode"></i> 
              <p>QRCode keanggotaan saya</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/members/logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i> 
              <p>Keluar</p>
            </a>
          </li>
          <?php else: ?>
          <li class="nav-item">
            <a href="/prakteks/scan" class="nav-link <?php echo ($active['praktek_scan'] ?? ''); ?>">
              <i class="nav-icon fas fa-qrcode"></i> 
              <p>Scan Presensi Praktik</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/members/login" class="nav-link text-success">
              <i class="nav-icon fas fa-sign-in-alt"></i> 
              <p>Login Sistem</p>
            </a>
          </li>
          <?php endif; ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
