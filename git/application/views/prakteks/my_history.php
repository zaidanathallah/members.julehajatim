<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title ?? 'Riwayat Praktik Saya - Juleha Jawa Timur'; ?></title>

  <!-- Google Font: Poppins & Font Awesome -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" href="/assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/assets/adminlte/dist/css/adminlte.min.css">

  <style>
    * {
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    body {
      background-color: #f8fafc;
      color: #1e293b;
    }
    .content-wrapper {
      background-color: #f8fafc;
    }
    .card-modern {
      background: #ffffff;
      border-radius: 16px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
      overflow: hidden;
      margin-bottom: 24px;
    }
    .card-header-juleha {
      background: linear-gradient(135deg, #064e3b 0%, #059669 100%);
      color: #ffffff;
      padding: 16px 20px;
      border-bottom: none;
    }
    .profile-hero {
      background: linear-gradient(135deg, #064e3b 0%, #059669 100%);
      color: #ffffff;
      border-radius: 16px;
      padding: 24px;
      margin-bottom: 24px;
      box-shadow: 0 6px 20px rgba(5, 150, 105, 0.2);
    }
    .hero-avatar {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #ffffff;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .stat-pill {
      background: rgba(255, 255, 255, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.25);
      border-radius: 12px;
      padding: 10px 18px;
      text-align: center;
      min-width: 120px;
    }
    .stat-pill-val {
      font-size: 1.4rem;
      font-weight: 700;
      line-height: 1.1;
    }
    .stat-pill-lbl {
      font-size: 0.78rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      opacity: 0.9;
    }
    .entry-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 14px;
      padding: 18px 20px;
      margin-bottom: 16px;
      transition: all 0.2s ease;
      position: relative;
    }
    .entry-card:hover {
      border-color: #cbd5e1;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
      transform: translateY(-2px);
    }
    .badge-date-pill {
      background: #ecfdf5;
      color: #059669;
      padding: 5px 12px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 0.84rem;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .badge-role-praktikan {
      background-color: #dcfce7;
      color: #15803d;
      border: 1px solid #bbf7d0;
      padding: 4px 10px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.8rem;
    }
    .badge-role-instruktur {
      background-color: #dbeafe;
      color: #1d4ed8;
      border: 1px solid #bfdbfe;
      padding: 4px 10px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.8rem;
    }
    .empty-state {
      text-align: center;
      padding: 50px 20px;
      color: #94a3b8;
    }
    .empty-state i {
      font-size: 48px;
      color: #cbd5e1;
      margin-bottom: 14px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0 shadow-sm" style="background: #ffffff;">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('members/profile'); ?>" class="nav-link font-weight-500">Profil Anggota</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('prakteks/my_history'); ?>" class="nav-link font-weight-500 active text-success font-weight-bold">Riwayat Praktik</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item mr-2">
        <a href="<?php echo base_url('prakteks/scan'); ?>" class="btn btn-success btn-sm rounded shadow-sm font-weight-bold px-3">
          <i class="fas fa-qrcode mr-1"></i> Scan Presensi KTA
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('members/logout'); ?>" class="btn btn-outline-danger btn-sm rounded shadow-sm font-weight-bold px-3">
          <i class="fas fa-sign-out-alt mr-1"></i> Keluar
        </a>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <?php $this->load->view('common/sidemenu'); ?>

  <!-- Content Wrapper -->
  <div class="content-wrapper py-4 px-2 px-md-3">

    <!-- Content Header -->
    <section class="content-header pb-2">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold" style="color: #064e3b; font-size: 1.55rem;">
              <i class="fas fa-history text-success mr-2"></i> Riwayat Praktik Penyembelihan
            </h1>
            <p class="text-muted small m-0 mt-1">Catatan Kehadiran Praktik Sembelih & Penugasan Instruktur</p>
          </div>
          <div class="col-sm-6 mt-2 mt-sm-0">
            <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>" class="text-success">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('members/profile'); ?>" class="text-success">Profil</a></li>
              <li class="breadcrumb-item active text-muted">Riwayat Praktik</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <section class="content mt-3">
      <div class="container-fluid">

        <?php 
          $display_name = trim(($member->firstname ?? '') . ' ' . ($member->lastname ?? ''));
          if (empty($display_name)) {
            $display_name = $member->nickname ?? $juleha_id;
          }
        ?>

        <!-- Hero Member Banner with Practice Stats -->
        <div class="profile-hero">
          <div class="row align-items-center">
            <div class="col-md-7 d-flex align-items-center mb-3 mb-md-0">
              <img src="/images/<?php echo htmlspecialchars($juleha_id); ?>.jpg" 
                   onerror="this.onerror=null;this.src='/assets/adminlte/dist/img/avatar5.png';"
                   class="hero-avatar mr-3" alt="Foto Profil">
              <div>
                <h3 class="font-weight-bold mb-1" style="font-size: 1.35rem;"><?php echo htmlspecialchars($display_name); ?></h3>
                <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                  <span class="badge badge-light px-2 py-1 font-weight-bold text-dark">
                    ID: <?php echo htmlspecialchars($juleha_id); ?>
                  </span>
                  <span class="badge badge-success px-2 py-1">
                    <i class="fas fa-map-marker-alt mr-1"></i> <?php echo htmlspecialchars($member->region ?? 'Jatim'); ?>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-5 d-flex justify-content-md-end justify-content-start" style="gap: 12px;">
              <div class="stat-pill">
                <div class="stat-pill-val"><?php echo (int)($practice_info['count_praktikan'] ?? 0); ?></div>
                <div class="stat-pill-lbl">Praktikan</div>
              </div>
              <div class="stat-pill">
                <div class="stat-pill-val"><?php echo (int)($practice_info['count_instruktur'] ?? 0); ?></div>
                <div class="stat-pill-lbl">Instruktur</div>
              </div>
              <div class="stat-pill">
                <div class="stat-pill-val"><?php echo (int)($practice_info['total_count'] ?? 0); ?></div>
                <div class="stat-pill-lbl">Total Sesi</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Practice Logs Card -->
        <div class="card-modern">
          <div class="card-header-juleha d-flex flex-wrap align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold"><i class="fas fa-clipboard-list mr-2"></i> Daftar Riwayat Praktik Lengkap</h5>
            <div class="mt-2 mt-sm-0">
              <a href="<?php echo base_url('prakteks/scan'); ?>" class="btn btn-light btn-sm font-weight-bold text-success mr-2">
                <i class="fas fa-qrcode mr-1"></i> Scan Presensi KTA
              </a>
              <a href="<?php echo base_url('members/profile'); ?>" class="btn btn-outline-light btn-sm font-weight-bold">
                <i class="fas fa-id-card mr-1"></i> Kembali ke Profil
              </a>
            </div>
          </div>
          <div class="card-body p-4">

            <?php 
              $hari_id = array('Sunday'=>'Minggu','Monday'=>'Senin','Tuesday'=>'Selasa','Wednesday'=>'Rabu','Thursday'=>'Kamis','Friday'=>'Jumat','Saturday'=>'Sabtu');
              $bulan_id = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
              $sessions = $practice_info['all'] ?? array();
            ?>

            <?php if (!empty($sessions)): ?>
              <div class="timeline-container">
                <?php foreach($sessions as $s): 
                  $ts = strtotime($s->praktekdate ?? 0);
                  $day_str = ($ts > 0) ? ($hari_id[date('l', $ts)] ?? '') : '-';
                  $date_str = ($ts > 0) ? (date('d', $ts) . ' ' . ($bulan_id[(int)date('m', $ts)] ?? '') . ' ' . date('Y', $ts)) : '-';
                  $time_str = ($ts > 0 && date('H:i', $ts) !== '00:00') ? (date('H:i', $ts) . ' WIB') : '';
                  $is_inst = (($s->role ?? '') === 'instruktur' || ($s->instructor_id ?? '') === $juleha_id);
                ?>
                  <div class="entry-card">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
                      <div class="badge-date-pill">
                        <i class="far fa-calendar-check"></i>
                        <strong><?php echo $day_str . ', ' . $date_str; ?></strong>
                        <?php if ($time_str): ?>
                          <span class="text-muted ml-1">&bull; <?php echo $time_str; ?></span>
                        <?php endif; ?>
                      </div>
                      <div>
                        <?php if ($is_inst): ?>
                          <span class="badge-role-instruktur"><i class="fas fa-chalkboard-teacher mr-1"></i> Instruktur Pembimbing</span>
                        <?php else: ?>
                          <span class="badge-role-praktikan"><i class="fas fa-cut mr-1"></i> Praktikan (Peserta)</span>
                        <?php endif; ?>
                      </div>
                    </div>

                    <div class="row align-items-center mt-3">
                      <div class="col-md-4 mb-2 mb-md-0">
                        <div class="text-muted small text-uppercase font-weight-500 mb-1">Lokasi RPH</div>
                        <h6 class="font-weight-bold text-dark mb-0">
                          <i class="fas fa-map-marker-alt text-danger mr-1"></i> <?php echo ((int)$s->rph_id === 2) ? 'RPH Kedurus' : 'RPH TOW (Tambak Osowilangun)'; ?>
                        </h6>
                      </div>
                      <div class="col-md-3 col-6 mb-2 mb-md-0">
                        <div class="text-muted small text-uppercase font-weight-500 mb-1">Objek Sembelihan</div>
                        <span class="badge badge-light border text-dark font-weight-bold px-2 py-1">
                          <i class="fas fa-tag text-success mr-1"></i> <?php echo htmlspecialchars($s->animal_type ?? 'Sapi'); ?>
                        </span>
                      </div>
                      <div class="col-md-3 col-6 mb-2 mb-md-0">
                        <div class="text-muted small text-uppercase font-weight-500 mb-1">
                          <?php echo $is_inst ? 'Peserta / Praktikan' : 'Instruktur Pembimbing'; ?>
                        </div>
                        <span class="font-weight-600 text-dark">
                          <?php 
                            if ($is_inst) {
                              echo htmlspecialchars($s->member_firstname ?? $s->member_nickname ?? $s->juleha_id ?? 'Anggota Juleha');
                            } else {
                              $inst_full = trim(($s->instructor_firstname ?? '') . ' ' . ($s->instructor_lastname ?? ''));
                              echo htmlspecialchars(!empty($inst_full) ? $inst_full : ($s->instructor_nickname ?? $s->instructor_id ?? '-'));
                            }
                          ?>
                        </span>
                      </div>
                      <div class="col-md-2 mb-2 mb-md-0">
                        <div class="text-muted small text-uppercase font-weight-500 mb-1">Status Evaluasi</div>
                        <?php 
                          $ev_st = $s->evaluation_status ?? 'Lulus Praktik';
                          if ($ev_st === 'Lulus Praktik') {
                            echo '<span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> Lulus</span>';
                          } elseif ($ev_st === 'Menunggu Evaluasi') {
                            echo '<span class="badge badge-warning text-dark px-2 py-1"><i class="fas fa-clock mr-1"></i> Menunggu</span>';
                          } else {
                            echo '<span class="badge badge-info px-2 py-1">' . htmlspecialchars($ev_st) . '</span>';
                          }
                        ?>
                      </div>
                    </div>

                    <div class="mt-3 pt-2 border-top">
                      <div class="small text-muted font-weight-500">
                        <i class="fas fa-clipboard-check text-success mr-1"></i> Catatan Evaluasi Instruktur:
                      </div>
                      <div class="small text-dark mt-1 font-weight-500 p-2 bg-light rounded border">
                        <?php echo htmlspecialchars($s->description ?: 'Belum ada catatan evaluasi tertulis dari Instruktur.'); ?>
                      </div>
                      <?php if (!empty($s->evaluator_nickname) || !empty($s->evaluated_by)): ?>
                        <small class="text-muted d-block mt-1">
                          <i class="fas fa-user-check text-success mr-1"></i> Dinilai oleh Instruktur: <strong><?php echo htmlspecialchars(trim(($s->evaluator_firstname ?? '') . ' ' . ($s->evaluator_lastname ?? '')) ?: $s->evaluator_nickname ?: $s->evaluated_by); ?></strong>
                        </small>
                      <?php endif; ?>
                    </div>

                  </div>
                <?php endforeach; ?>
              </div>
            <?php else: ?>
              <div class="empty-state">
                <i class="fas fa-clipboard"></i>
                <h5 class="font-weight-bold text-dark">Belum Ada Riwayat Praktik</h5>
                <p class="text-muted small mb-3">
                  Anda belum memiliki catatan jam terbang praktik penyembelihan yang tercatat di sistem.
                </p>
                <a href="<?php echo base_url('prakteks/scan'); ?>" class="btn btn-success btn-sm px-4 py-2 font-weight-bold rounded-pill">
                  <i class="fas fa-qrcode mr-1"></i> Lakukan Presensi Praktik Sekarang
                </a>
              </div>
            <?php endif; ?>

          </div>
        </div>

      </div>
    </section>

  </div>

  <!-- Footer -->
  <footer class="main-footer text-sm text-center">
    <strong>Copyright &copy; 2021-2026 <a href="https://julehajatim.com" class="text-success">Juru Sembelih Halal (Juleha) Jawa Timur</a>.</strong>
    Sistem Manajemen Keanggotaan & Absensi Terpadu.
  </footer>

</div>

<!-- Scripts -->
<script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/adminlte/dist/js/adminlte.min.js"></script>

</body>
</html>
