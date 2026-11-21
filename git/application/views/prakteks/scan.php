<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title ?? 'Scan Presensi Praktik KTA - Juleha Jawa Timur'; ?></title>

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
    .grow {
      flex-grow: 1 !important;
    }
    @keyframes scanSuccessPulse {
      0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.9); }
      50% { box-shadow: 0 0 25px 8px rgba(16, 185, 129, 0.9); border-color: #10b981; }
      100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }
    .scanner-success-flash {
      animation: scanSuccessPulse 0.6s ease-out;
      border: 3px solid #10b981 !important;
    }
    .mode-tab-btn {
      transition: all 0.25s ease;
      cursor: pointer;
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
    .guide-box {
      background: #f0fdf4;
      border: 1px solid #bbf7d0;
      border-radius: 14px;
      padding: 16px 18px;
      margin-bottom: 20px;
    }
    .scanner-box {
      background: #0f172a;
      border-radius: 14px;
      overflow: hidden;
      position: relative;
      min-height: 290px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      box-shadow: inset 0 2px 8px rgba(0,0,0,0.4);
    }
    #reader {
      width: 100%;
      border: none !important;
    }
    #reader video {
      border-radius: 12px;
      max-height: 360px;
      width: 100%;
      object-fit: cover;
    }
    #reader__scan_region {
      background: transparent !important;
    }
    .scanner-overlay {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 250px;
      height: 250px;
      border: 1.5px solid rgba(16, 185, 129, 0.4);
      border-radius: 20px;
      box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.52);
      pointer-events: none;
      display: none;
    }
    .scanner-corner {
      position: absolute;
      width: 28px;
      height: 28px;
      border-color: #10b981;
      border-style: solid;
      pointer-events: none;
    }
    .scanner-corner.top-left { top: -2px; left: -2px; border-width: 4px 0 0 4px; border-top-left-radius: 18px; }
    .scanner-corner.top-right { top: -2px; right: -2px; border-width: 4px 4px 0 0; border-top-right-radius: 18px; }
    .scanner-corner.bottom-left { bottom: -2px; left: -2px; border-width: 0 0 4px 4px; border-bottom-left-radius: 18px; }
    .scanner-corner.bottom-right { bottom: -2px; right: -2px; border-width: 0 4px 4px 0; border-bottom-right-radius: 18px; }

    .scanner-laser {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 2px;
      background: #34d399;
      box-shadow: 0 0 14px #34d399;
      animation: scanLaser 2s infinite linear;
    }
    @keyframes scanLaser {
      0% { top: 0%; opacity: 0.8; }
      50% { top: 96%; opacity: 1; }
      100% { top: 0%; opacity: 0.8; }
    }
    .member-preview-card {
      background: #f0fdf4;
      border: 2px dashed #86efac;
      border-radius: 14px;
      padding: 16px;
      display: none;
      transition: all 0.3s ease;
    }
    .member-avatar-preview {
      width: 76px;
      height: 76px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #10b981;
      box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
    }
    .role-btn-group .btn {
      border-radius: 10px;
      font-weight: 600;
      padding: 10px 18px;
      transition: all 0.2s ease;
    }
    .role-btn-group .btn.active {
      background-color: #059669 !important;
      border-color: #059669 !important;
      color: #ffffff !important;
      box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
    }
    .radio-pill-badge {
      cursor: pointer;
      padding: 8px 16px;
      border-radius: 30px;
      border: 1px solid #cbd5e1;
      background: #ffffff;
      font-size: 0.88rem;
      font-weight: 500;
      color: #475569;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s;
      margin-right: 6px;
      margin-bottom: 8px;
    }
    .radio-pill-badge:hover {
      border-color: #059669;
      color: #059669;
    }
    input[type="radio"]:checked + .radio-pill-badge {
      background: #ecfdf5;
      border-color: #059669;
      color: #064e3b;
      font-weight: 600;
      box-shadow: 0 2px 8px rgba(5, 150, 105, 0.15);
    }
    .btn-submit-presensi {
      background: linear-gradient(135deg, #064e3b 0%, #059669 100%);
      color: #ffffff;
      font-weight: 600;
      font-size: 1.05rem;
      border-radius: 12px;
      padding: 12px 24px;
      border: none;
      box-shadow: 0 4px 14px rgba(5, 150, 105, 0.3);
      transition: all 0.2s;
    }
    .btn-submit-presensi:hover {
      background: linear-gradient(135deg, #043f30 0%, #047857 100%);
      color: #ffffff;
      transform: translateY(-1px);
      box-shadow: 0 6px 18px rgba(5, 150, 105, 0.4);
    }

    /* Dropdown live search instruktur */
    .dropdown-search-box {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      z-index: 1060;
      background: #ffffff;
      border: 1px solid #cbd5e1;
      border-radius: 12px;
      max-height: 280px;
      overflow-y: auto;
      margin-top: 4px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }
    .search-item {
      padding: 10px 14px;
      cursor: pointer;
      border-bottom: 1px solid #f1f5f9;
      transition: background 0.15s ease;
      display: flex;
      align-items: center;
    }
    .search-item:last-child {
      border-bottom: none;
    }
    .search-item:hover {
      background-color: #ecfdf5;
    }
    .search-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #10b981;
      margin-right: 12px;
      flex-shrink: 0;
    }

    /* Antrean Peserta Menunggu Evaluasi Card */
    .queue-card-item {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 12px 16px;
      transition: all 0.2s ease;
      box-shadow: 0 2px 6px rgba(0,0,0,0.03);
    }
    .queue-card-item:hover {
      border-color: #10b981;
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.12);
      transform: translateY(-1px);
    }
    .queue-avatar {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #10b981;
      flex-shrink: 0;
    }
    .btn-quick-instructor {
      transition: all 0.2s ease;
    }
    .btn-quick-instructor:hover, .btn-quick-instructor.active {
      background-color: #059669 !important;
      color: #ffffff !important;
      border-color: #059669 !important;
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
        <a href="<?php echo base_url('members/index'); ?>" class="nav-link font-weight-500">Beranda</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('prakteks/index'); ?>" class="nav-link font-weight-500">Rekap Praktik</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <?php if (!empty($is_logged_in)): ?>
        <?php if (!empty($is_admin)): ?>
          <li class="nav-item">
            <a href="<?php echo base_url('prakteks/index'); ?>" class="btn btn-outline-secondary btn-sm rounded shadow-sm font-weight-bold px-3 mr-2">
              <i class="fas fa-list mr-1"></i> Data Praktik
            </a>
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <a href="<?php echo base_url('members/logout'); ?>" class="btn btn-outline-danger btn-sm rounded shadow-sm font-weight-bold px-3">
            <i class="fas fa-sign-out-alt mr-1"></i> Keluar
          </a>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a href="<?php echo base_url('members/login'); ?>" class="btn btn-success btn-sm rounded shadow-sm font-weight-bold px-3">
            <i class="fas fa-sign-in-alt mr-1"></i> Login Instruktur
          </a>
        </li>
      <?php endif; ?>
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
          <div class="col-sm-7">
            <h1 class="m-0 font-weight-bold" style="color: #064e3b; font-size: 1.55rem;">
              <i class="fas fa-qrcode text-success mr-2"></i> Presensi Praktik & Evaluasi Instruktur
            </h1>
            <p class="text-muted small m-0 mt-1">Khusus Lokasi Resmi: <strong>RPH TOW</strong> & <strong>RPH Kedurus</strong> Juleha Jawa Timur</p>
          </div>
          <div class="col-sm-5 mt-2 mt-sm-0">
            <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>" class="text-success">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('prakteks/index'); ?>" class="text-success">Praktik</a></li>
              <li class="breadcrumb-item active text-muted">Scan Presensi</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <section class="content mt-3">
      <div class="container-fluid">

        <!-- Panduan Alur Scan & Waktu Scan yang Paling Tepat -->
        <div class="guide-box">
          <div class="d-flex align-items-start">
            <div class="mr-3 text-success" style="font-size: 2rem;">
              <i class="fas fa-info-circle"></i>
            </div>
            <div>
              <h6 class="font-weight-bold mb-1" style="color: #064e3b;">
                <i class="fas fa-stopwatch text-success mr-1"></i> Alur Lapangan Scan KTA & Evaluasi di RPH:
              </h6>
              <div class="row mt-2">
                <div class="col-md-6 mb-2">
                  <div class="small text-dark font-weight-500 p-2 bg-white rounded border">
                    <span class="badge badge-success mr-1">Langkah 1</span> <strong>Peserta Hadir:</strong> Scan KTA fisik & pilih nama Instruktur yang bertugas (pilih dari tombol instruktur atau cari nama).
                  </div>
                </div>
                <div class="col-md-6 mb-2">
                  <div class="small text-dark font-weight-500 p-2 bg-white rounded border">
                    <span class="badge badge-primary mr-1">Langkah 2</span> <strong>Instruktur Beri Evaluasi:</strong> Instruktur buka scanner atau scan KTA miliknya, antrean peserta otomatis muncul realtime untuk langsung dinilai.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          
          <!-- LEFT COLUMN: Live Camera Scanner -->
          <div class="col-lg-5 col-md-6 mb-4">
            <div class="card-modern">
              <div class="card-header-juleha d-flex align-items-center justify-content-between">
                <span class="font-weight-bold"><i class="fas fa-camera mr-2"></i> Scanner Kamera KTA</span>
                <span class="badge badge-light px-2 py-1 font-weight-bold" id="cameraStatusBadge">Kamera Siap</span>
              </div>
              <div class="card-body p-3 text-center">
                
                <!-- Video Scanner Viewport -->
                <div class="scanner-box" id="scannerViewport">
                  <div id="reader"></div>
                  <div class="scanner-overlay" id="scannerOverlay">
                    <div class="scanner-corner top-left"></div>
                    <div class="scanner-corner top-right"></div>
                    <div class="scanner-corner bottom-left"></div>
                    <div class="scanner-corner bottom-right"></div>
                    <div class="scanner-laser"></div>
                  </div>
                  <div id="cameraPlaceholder" class="p-4 text-center text-white">
                    <i class="fas fa-qrcode fa-3x mb-3 text-success"></i>
                    <p class="small text-white-50 mb-3">Arahkan kamera ke QR KTA fisik untuk scan cepat, atau ambil foto dengan kamera HP</p>
                    <div class="d-flex flex-column align-items-center" style="gap: 10px;">
                      <button type="button" class="btn btn-success btn-sm px-4 py-2 rounded-pill font-weight-bold shadow" id="btnStartCamera">
                        <i class="fas fa-video mr-1"></i> Buka Kamera Scanner Live
                      </button>
                      <button type="button" class="btn btn-light btn-sm px-4 py-2 rounded-pill font-weight-bold shadow-sm" id="btnSnapNativeCamera">
                        <i class="fas fa-camera mr-1 text-success"></i> Ambil Foto QR dengan Kamera HP
                      </button>
                    </div>
                  </div>
                </div>

                <!-- Scanner Controls & Flashlight -->
                <div class="mt-3 d-flex flex-wrap justify-content-center align-items-center" style="gap: 8px;">
                  <button type="button" class="btn btn-warning btn-sm font-weight-bold shadow-sm" id="btnToggleTorch" style="display: none;">
                    <i class="fas fa-bolt mr-1"></i> Flashlight (Lampu HP)
                  </button>
                  <select id="cameraSelect" class="form-control form-control-sm" style="display: none; max-width: 180px; border-radius: 8px; font-weight: 500;">
                  </select>
                  <button type="button" class="btn btn-outline-success btn-sm" id="btnSwitchCamera" style="display: none;">
                    <i class="fas fa-sync-alt mr-1"></i> Ganti Kamera
                  </button>
                  <button type="button" class="btn btn-outline-danger btn-sm" id="btnStopCamera" style="display: none;">
                    <i class="fas fa-stop mr-1"></i> Matikan Kamera
                  </button>
                  <button type="button" class="btn btn-success btn-sm" id="btnSnapNativeCameraUnder">
                    <i class="fas fa-camera mr-1"></i> Foto Kamera HP
                  </button>
                  <label class="btn btn-outline-secondary btn-sm mb-0 cursor-pointer" title="Scan gambar foto QR dari galeri">
                    <i class="fas fa-image mr-1"></i> Dari Galeri
                    <input type="file" id="qrFileInput" accept="image/*" style="display: none;">
                  </label>
                  <input type="file" id="nativeCameraInput" accept="image/*" capture="environment" style="display: none;">
                </div>

                <!-- Scanned Result Flash Alert -->
                <div id="scanFeedback" class="mt-3" style="display: none;"></div>

              </div>
            </div>

            <!-- Card Lokasi RPH Resmi -->
            <div class="card-modern p-3">
              <h6 class="font-weight-bold text-success mb-2"><i class="fas fa-map-marker-alt mr-1"></i> Lokasi RPH Resmi Juleha Jatim:</h6>
              <div class="small text-muted mb-2">Penyelenggaraan dan pencatatan praktik resmi hanya berlaku di:</div>
              <div class="d-flex flex-column" style="gap: 8px;">
                <div class="p-2 border rounded bg-light d-flex align-items-center">
                  <span class="badge badge-success px-2 py-1 mr-2 font-weight-bold">RPH 1</span>
                  <strong>RPH TOW (Tambak Osowilangun, Surabaya)</strong>
                </div>
                <div class="p-2 border rounded bg-light d-flex align-items-center">
                  <span class="badge badge-success px-2 py-1 mr-2 font-weight-bold">RPH 2</span>
                  <strong>RPH Kedurus (Surabaya)</strong>
                </div>
              </div>
            </div>

          </div>

          <!-- RIGHT COLUMN: Attendance Form, Instructor Queue & Member Preview -->
          <div class="col-lg-7 col-md-6">

            <!-- SECTION ANTREAN EVALUASI KHUSUS INSTRUKTUR (Tampil saat Mode Instruktur) -->
            <div class="card-modern mb-4" id="sectionQueueEvaluations" style="border: 2px solid #10b981; display: <?php echo $can_evaluate ? 'block' : 'none'; ?>;">
              <div class="card-header-juleha d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #064e3b 0%, #047857 100%);">
                <div>
                  <h6 class="font-weight-bold m-0 text-white">
                    <i class="fas fa-clipboard-list mr-2 text-warning"></i> Antrean Peserta Menunggu Evaluasi Anda
                  </h6>
                  <small class="text-white-50">
                    Instruktur: <strong id="queueInstructorName"><?php echo htmlspecialchars($active_instructor_name ?: ($logged_name ?: $active_instructor_id)); ?></strong> (<span id="queueInstructorId"><?php echo htmlspecialchars($active_instructor_id); ?></span>)
                  </small>
                </div>
                <div>
                  <span class="badge badge-warning px-2 py-1 font-weight-bold text-dark" id="badgePendingCount">0 Peserta</span>
                  <button type="button" class="btn btn-sm btn-light ml-2 font-weight-bold" id="btnRefreshQueue" title="Segarkan Antrean">
                    <i class="fas fa-sync-alt mr-1 text-success"></i> Refresh
                  </button>
                </div>
              </div>
              <div class="card-body p-3" id="queueContainer" style="max-height: 380px; overflow-y: auto;">
                <div id="queueLoading" class="text-center py-3 text-muted">
                  <i class="fas fa-spinner fa-spin fa-2x text-success mb-2"></i>
                  <p class="small mb-0">Memuat daftar peserta yang menunggu evaluasi...</p>
                </div>
                <div id="queueEmpty" class="text-center py-4" style="display: none;">
                  <i class="fas fa-check-circle fa-3x text-success mb-2"></i>
                  <h6 class="font-weight-bold text-dark mb-1">Tidak Ada Peserta yang Mengantre</h6>
                  <p class="small text-muted mb-0">Saat peserta di RPH mengirim presensi dan memilih nama Anda, data peserta langsung muncul otomatis di sini.</p>
                </div>
                <div id="queueList" class="d-flex flex-column" style="gap: 10px;"></div>
              </div>
            </div>

            <div class="card-modern">
              <div class="card-header-juleha d-flex align-items-center justify-content-between">
                <span class="font-weight-bold" id="formHeaderTitle">
                  <i class="fas <?php echo $can_evaluate ? 'fa-clipboard-check' : 'fa-edit'; ?> mr-2"></i> <?php echo $can_evaluate ? 'Form Evaluasi Peserta Praktik' : 'Form Presensi Peserta Praktik'; ?>
                </span>
                <span class="badge <?php echo $can_evaluate ? 'badge-success text-white' : 'badge-warning text-dark'; ?> px-2 py-1 font-weight-bold" id="formModeBadge">
                  <i class="fas <?php echo $can_evaluate ? 'fa-user-shield' : 'fa-user'; ?> mr-1"></i> <span id="formModeBadgeText"><?php echo $can_evaluate ? 'Mode Instruktur' : 'Mode Peserta'; ?></span>
                </span>
              </div>
              <div class="card-body p-4">

                <!-- Mode Switcher Tabs (2 Pilihan Mode: Peserta Praktik vs Instruktur Resmi) -->
                <div class="mb-3 p-1 bg-light rounded-pill border d-flex">
                  <button type="button" class="btn btn-sm rounded-pill font-weight-bold flex-fill mode-tab-btn <?php echo !$can_evaluate ? 'btn-success text-white shadow-sm' : 'btn-light text-muted'; ?>" id="btnTabPeserta">
                    <i class="fas fa-user mr-1"></i> Mode Peserta Praktik
                  </button>
                  <button type="button" class="btn btn-sm rounded-pill font-weight-bold flex-fill mode-tab-btn <?php echo $can_evaluate ? 'btn-success text-white shadow-sm' : 'btn-light text-muted'; ?>" id="btnTabInstruktur">
                    <i class="fas fa-user-shield mr-1"></i> Mode Instruktur Resmi
                  </button>
                </div>

                <!-- Alert Banner Status Mode -->
                <div class="alert border-0 shadow-sm py-2 px-3 mb-3 d-flex flex-wrap align-items-center justify-content-between" id="modeAlertBanner" style="border-radius: 12px; <?php echo $can_evaluate ? 'background: #ecfdf5; color: #065f46;' : 'background: #e0f2fe; color: #0369a1;'; ?>">
                  <div class="d-flex align-items-center mb-1 mb-md-0">
                    <i class="fas <?php echo $can_evaluate ? 'fa-user-shield text-success' : 'fa-id-card text-info'; ?> fa-lg mr-2" id="modeAlertIcon"></i>
                    <span class="small font-weight-500" id="modeAlertText">
                      <?php echo $can_evaluate ? 'Mode Instruktur Aktif. Pilih peserta dari antrean di atas atau scan KTA fisik peserta untuk mengisi evaluasi.' : 'Mode Peserta Aktif. Silakan pilih Instruktur Pembimbing Anda di bawah ini lalu klik Kirim Presensi.'; ?>
                    </span>
                  </div>
                  <?php if (empty($is_logged_in)): ?>
                    <a href="<?php echo base_url('members/login'); ?>" class="btn btn-sm btn-info font-weight-bold text-white shadow-sm" style="border-radius: 8px;">
                      <i class="fas fa-sign-in-alt mr-1"></i> Login Akun
                    </a>
                  <?php endif; ?>
                </div>

                <!-- Member Preview Card (Shows upon QR Detection / ID Input) -->
                <div class="member-preview-card mb-4" id="memberPreviewCard">
                  <div class="d-flex align-items-center">
                    <img src="/assets/adminlte/dist/img/avatar5.png" id="previewPhoto" class="member-avatar-preview mr-3" alt="Foto KTA">
                    <div class="grow">
                      <div class="d-flex align-items-center justify-content-between flex-wrap gap-1">
                        <span class="badge badge-success px-2 py-1 font-weight-bold" id="previewJulehaId">ID: -</span>
                        <span class="badge badge-light border text-muted" id="previewRegion">Daerah: -</span>
                      </div>
                      <h5 class="font-weight-bold mb-1 mt-1" style="color: #064e3b;" id="previewName">-</h5>
                      
                      <!-- Badge Khusus Jika KTA Instruktur Resmi -->
                      <div id="badgeKtaInstructor" class="my-1" style="display: none;">
                        <span class="badge badge-warning text-dark font-weight-bold px-2 py-1">
                          <i class="fas fa-award text-dark mr-1"></i> INSTRUKTUR RESMI JULEHA JATIM
                        </span>
                      </div>

                      <div class="small text-muted d-flex flex-wrap gap-2 mt-1">
                        <span class="mr-3"><i class="fas fa-user-check text-success mr-1"></i> <span id="previewStatus">Aktif</span></span>
                        <span class="mr-3"><i class="fas fa-cut text-primary mr-1"></i> Praktik: <strong id="previewPraktikCnt">0</strong> kali</span>
                        <span><i class="fas fa-chalkboard-teacher text-warning mr-1"></i> Instruktur: <strong id="previewInstrukturCnt">0</strong> kali</span>
                      </div>

                      <!-- Quick Action jika yang di-scan adalah Instruktur -->
                      <div id="quickInstructorActions" class="mt-2" style="display: none;">
                        <button type="button" class="btn btn-outline-primary btn-sm font-weight-bold" onclick="setRole('instruktur')">
                          <i class="fas fa-briefcase mr-1"></i> Presensi Penugasan Saya Sebagai Instruktur
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Form Presensi & Evaluasi -->
                <form id="formPresensi">
                  <input type="hidden" name="id" id="field_id" value="">
                  <input type="hidden" name="evaluator_id" id="evaluator_id" value="<?php echo htmlspecialchars($active_instructor_id ?? '', ENT_QUOTES, 'UTF-8'); ?>">

                  <!-- 1. Peran: Uji Peserta Praktik vs Penugasan Instruktur -->
                  <div class="form-group mb-3">
                    <label class="font-weight-bold text-dark small text-uppercase">
                      <i class="fas fa-user-tag text-success mr-1"></i> Jenis Presensi <span class="text-danger">*</span>
                    </label>
                    <div class="d-flex role-btn-group" style="gap: 12px;">
                      <button type="button" class="btn btn-outline-success flex-fill active" id="btnRolePraktikan" onclick="setRole('praktikan')">
                        <i class="fas fa-cut mr-1"></i> Uji Peserta Praktik
                      </button>
                      <button type="button" class="btn btn-outline-primary flex-fill" id="btnRoleInstruktur" onclick="setRole('instruktur')">
                        <i class="fas fa-chalkboard-teacher mr-1"></i> Penugasan Instruktur
                      </button>
                    </div>
                    <input type="hidden" name="role" id="role" value="praktikan">
                  </div>

                  <!-- 2. Juleha ID (Input & Scan Hook) -->
                  <div class="form-group mb-3">
                    <label class="font-weight-bold text-dark small text-uppercase" id="labelJulehaId">
                      <i class="fas fa-id-card text-success mr-1"></i> ID Juleha Peserta yang Diuji <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                      <input type="text" class="form-control font-weight-bold" id="juleha_id" name="juleha_id" 
                             placeholder="Arahkan kamera ke QR KTA atau ketik ID (misal: SDA220065)" 
                             value="<?php echo htmlspecialchars(($can_evaluate && $is_prefill_instructor) ? '' : ($prefill_id ?? ($can_evaluate ? '' : $logged_id)), ENT_QUOTES, 'UTF-8'); ?>" required>
                      <div class="input-group-append">
                        <button class="btn btn-outline-success font-weight-bold" type="button" id="btnCekAnggota">
                          <i class="fas fa-search mr-1"></i> Cek Anggota
                        </button>
                      </div>
                    </div>
                    <small class="text-muted" id="helpJulehaId">
                      <?php if ($can_evaluate): ?>
                        Pilih peserta dari Antrean di atas atau scan KTA fisik peserta untuk mengisi evaluasi.
                      <?php else: ?>
                        ID Anda terisi otomatis dari scan kartu KTA.
                      <?php endif; ?>
                    </small>
                  </div>

                  <!-- Info Instruktur Penguji Aktif (Khusus Mode Instruktur) -->
                  <div id="infoInstructorActive" class="alert alert-success py-2 px-3 mb-3 small font-weight-bold shadow-sm" style="display: <?php echo $can_evaluate ? 'block' : 'none'; ?>; border-radius: 10px; border-left: 4px solid #059669;">
                    <i class="fas fa-award text-warning mr-1"></i> Instruktur Penguji Aktif: <strong id="labelActiveInstructorName"><?php echo htmlspecialchars($active_instructor_name ?: ($logged_name ?: $active_instructor_id)); ?></strong> (<span id="labelActiveInstructorId"><?php echo htmlspecialchars($active_instructor_id); ?></span>)
                  </div>

                  <!-- 3. Instruktur Pembimbing (Pencarian Nama & Tombol Cepat - Khusus Mode Peserta) -->
                  <div class="form-group mb-3" id="groupInstructor" style="display: <?php echo $can_evaluate ? 'none' : 'block'; ?>;">
                    <label class="font-weight-bold text-dark small text-uppercase d-flex align-items-center justify-content-between">
                      <span><i class="fas fa-user-tie text-success mr-1"></i> Instruktur Pembimbing / Penguji <span class="text-danger">*</span></span>
                      <span class="badge badge-light border text-muted font-weight-normal">Cari Nama / Pilih Instruktur</span>
                    </label>

                    <!-- Tombol Cepat Pilihan Instruktur Resmi Aktif -->
                    <?php if (!empty($official_instructors)): ?>
                      <div class="mb-2">
                        <label class="small text-muted font-weight-bold text-uppercase d-block mb-1" style="font-size: 0.76rem;">
                          <i class="fas fa-bolt text-warning mr-1"></i> Pilih Cepat Instruktur yang Bertugas di RPH:
                        </label>
                        <div class="d-flex flex-wrap" style="gap: 6px;">
                          <?php foreach ($official_instructors as $inst): 
                            $instName = trim(($inst->firstname ?? '') . ' ' . ($inst->lastname ?? ''));
                            if (empty($instName)) $instName = $inst->nickname ?? $inst->juleha_id;
                          ?>
                            <button type="button" class="btn btn-outline-success btn-sm font-weight-bold rounded-pill btn-quick-instructor"
                                    data-id="<?php echo htmlspecialchars($inst->juleha_id); ?>"
                                    data-name="<?php echo htmlspecialchars($instName); ?>"
                                    data-nickname="<?php echo htmlspecialchars($inst->nickname ?? ''); ?>"
                                    data-region="<?php echo htmlspecialchars($inst->region ?? 'Jatim'); ?>"
                                    data-photo="/images/<?php echo htmlspecialchars($inst->juleha_id); ?>.jpg">
                              <i class="fas fa-user-check mr-1"></i> <?php echo htmlspecialchars($instName); ?> (<?php echo htmlspecialchars($inst->nickname ?? $inst->juleha_id); ?>)
                            </button>
                          <?php endforeach; ?>
                        </div>
                      </div>
                    <?php endif; ?>

                    <!-- Input Live Search Nama Instruktur (Panggilan / Depan / Belakang) -->
                    <div class="position-relative">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-white border-right-0"><i class="fas fa-search text-success" id="instSearchIcon"></i></span>
                        </div>
                        <input type="text" class="form-control border-left-0 font-weight-500" id="searchInstructorInput" 
                               placeholder="Atau ketik nama instruktur (misal: Maftuchin, Zaidan)..." autocomplete="off">
                      </div>
                      <div id="dropdownInstructorResults" class="dropdown-search-box" style="display: none;">
                        <div id="instructorSearchResultsList"></div>
                      </div>
                    </div>

                    <!-- Kartu Instruktur Terpilih -->
                    <div id="cardSelectedInstructor" class="selected-member-card p-3 my-2 shadow-sm" style="display: none; background: #ecfdf5; border: 1.5px solid #10b981; border-radius: 12px;">
                      <div class="d-flex align-items-center">
                        <img src="/assets/adminlte/dist/img/avatar5.png" id="selectedInstPhoto" class="rounded-circle mr-3 border" 
                             style="width: 50px; height: 50px; object-fit: cover; border-width: 2px !important; border-color: #10b981 !important;"
                             onerror="this.onerror=null;this.src='/assets/adminlte/dist/img/avatar5.png';">
                        <div class="grow">
                          <div class="d-flex align-items-center justify-content-between">
                            <h6 class="font-weight-bold mb-0 text-success" id="selectedInstName">-</h6>
                            <span class="badge badge-success px-2 py-1 font-weight-bold" id="selectedInstBadgeId">-</span>
                          </div>
                          <div class="small text-muted mt-1">
                            <span class="badge badge-warning text-dark font-weight-bold mr-1"><i class="fas fa-award mr-1"></i>Instruktur Resmi</span>
                            <span id="selectedInstRegion">Wilayah: SBY</span>
                          </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-danger ml-2 font-weight-bold" id="btnCancelSelectedInst" title="Ganti Instruktur">
                          <i class="fas fa-times mr-1"></i> Ganti
                        </button>
                      </div>
                    </div>

                    <input type="hidden" id="instructor_id" name="instructor_id" value="<?php echo htmlspecialchars($can_evaluate ? ($active_instructor_id ?? $logged_id) : '', ENT_QUOTES, 'UTF-8'); ?>">
                    <small class="text-muted d-block mt-1">Pilih nama instruktur pembimbing yang menguji Anda di RPH (bisa klik tombol cepat atau ketik nama).</small>
                  </div>

                  <div class="row">
                    <!-- 4. Pilihan RPH: HANYA TOW & KEDURUS -->
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark small text-uppercase">
                          <i class="fas fa-map-marker-alt text-success mr-1"></i> Lokasi RPH <span class="text-danger">*</span>
                        </label>
                        <select class="form-control font-weight-bold" id="rph_id" name="rph_id" required>
                          <option value="1">RPH TOW (Tambak Osowilangun)</option>
                          <option value="2">RPH Kedurus</option>
                        </select>
                      </div>
                    </div>

                    <!-- 5. Tanggal & Waktu Praktik -->
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark small text-uppercase">
                          <i class="far fa-calendar-alt text-success mr-1"></i> Waktu / Tanggal <span class="text-danger">*</span>
                        </label>
                        <input type="datetime-local" class="form-control" id="praktekdate" name="praktekdate" 
                               value="<?php echo date('Y-m-d\TH:i'); ?>" required>
                      </div>
                    </div>
                  </div>

                  <!-- 6. Jenis Hewan Sembelihan -->
                  <div class="form-group mb-3">
                    <label class="font-weight-bold text-dark small text-uppercase d-block">
                      <i class="fas fa-paw text-success mr-1"></i> Jenis Sembelihan <span class="text-danger">*</span>
                    </label>
                    <label>
                      <input type="radio" name="animal_type" value="Sapi" checked class="d-none">
                      <span class="radio-pill-badge"><i class="fas fa-check-circle mr-1"></i> Sapi</span>
                    </label>
                    <label>
                      <input type="radio" name="animal_type" value="Kambing / Domba" class="d-none">
                      <span class="radio-pill-badge"><i class="fas fa-check-circle mr-1"></i> Kambing / Domba</span>
                    </label>
                    <label>
                      <input type="radio" name="animal_type" value="Unggas" class="d-none">
                      <span class="radio-pill-badge"><i class="fas fa-check-circle mr-1"></i> Unggas</span>
                    </label>
                    <label>
                      <input type="radio" name="animal_type" value="Pelatihan Umum" class="d-none">
                      <span class="radio-pill-badge"><i class="fas fa-check-circle mr-1"></i> Pelatihan / Uji</span>
                    </label>
                  </div>

                  <!-- 7. Status Evaluasi & Catatan Evaluasi Instruktur -->
                  <div class="form-group mb-4" id="groupEvaluation">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                      <label class="font-weight-bold text-dark small text-uppercase m-0">
                        <i class="fas fa-clipboard-check text-success mr-1"></i> Catatan Evaluasi Instruktur
                      </label>
                      <span class="badge badge-warning text-dark font-weight-bold" id="badgeEvalLock" style="display: <?php echo $can_evaluate ? 'none' : 'inline-block'; ?>;">
                        <i class="fas fa-lock mr-1"></i> Khusus Diisi Instruktur
                      </span>
                    </div>

                    <!-- Sub-container 1: Kontrol Evaluasi Aktif (Mode Instruktur) -->
                    <div id="containerInstructorEvaluation" style="display: <?php echo $can_evaluate ? 'block' : 'none'; ?>;">
                      <div class="mb-2">
                        <label class="small text-muted font-weight-bold text-uppercase d-block mb-1">Hasil Evaluasi / Kelulusan Peserta:</label>
                        <label>
                          <input type="radio" name="evaluation_status" value="Lulus Praktik" checked class="d-none">
                          <span class="radio-pill-badge text-success"><i class="fas fa-check-circle mr-1"></i> Lulus Praktik</span>
                        </label>
                        <label>
                          <input type="radio" name="evaluation_status" value="Dalam Pembimbingan" class="d-none">
                          <span class="radio-pill-badge text-warning"><i class="fas fa-user-clock mr-1"></i> Dalam Pembimbingan</span>
                        </label>
                        <label>
                          <input type="radio" name="evaluation_status" value="Perlu Pengulangan" class="d-none">
                          <span class="radio-pill-badge text-danger"><i class="fas fa-redo mr-1"></i> Perlu Pengulangan</span>
                        </label>
                      </div>

                      <textarea class="form-control" id="description" name="description" rows="3" 
                                placeholder="Tuliskan catatan evaluasi penyembelihan untuk peserta ini (misal: teknik rebah baik, bilah tajam, 3 saluran trakea/esofagus/jugular putus sempurna)..."></textarea>
                      <small class="text-muted">Catatan evaluasi ini langsung tersimpan ke profil anggota dan riwayat kelulusan peserta.</small>
                    </div>

                    <!-- Sub-container 2: Read-Only Info untuk Peserta (Mode Peserta) -->
                    <div id="containerParticipantEvaluation" style="display: <?php echo $can_evaluate ? 'none' : 'block'; ?>;">
                      <div class="alert alert-light border small text-muted mb-2">
                        <i class="fas fa-info-circle text-success mr-1"></i> <strong>Informasi untuk Peserta:</strong> Catatan evaluasi hanya dapat diisi oleh Instruktur Penguji. Setelah Anda menyembelih di RPH, Instruktur akan memberikan penilaian dan evaluasi yang langsung tampil di profil Anda.
                      </div>
                      <textarea class="form-control bg-light" rows="2" readonly 
                                placeholder="Menunggu penilaian dan catatan evaluasi dari Instruktur Pembimbing..."></textarea>
                    </div>
                  </div>

                  <!-- Submit Action Button -->
                  <button type="submit" class="btn <?php echo $can_evaluate ? 'btn-success' : 'btn-submit-presensi'; ?> btn-block font-weight-bold" id="btnSubmitPresensi">
                    <i class="fas <?php echo $can_evaluate ? 'fa-save' : 'fa-paper-plane'; ?> mr-2"></i> <?php echo $can_evaluate ? 'Simpan & Sahkan Evaluasi Peserta' : 'Kirim Presensi Kehadiran'; ?>
                  </button>

                </form>

              </div>
            </div>
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
<script src="/assets/juleha/html5-qrcode.min.js"></script>

<script>
let html5QrCode = null;
let isScanning = false;
let availableCameras = [];
let currentCameraIndex = 0;
let isTorchOn = false;
let activeInstructorId = '<?php echo addslashes($active_instructor_id ?? ""); ?>';
let activeInstructorName = '<?php echo addslashes($active_instructor_name ?? ($is_instructor ? $logged_name : "")); ?>';
let canEvaluate = <?php echo $can_evaluate ? 'true' : 'false'; ?>;
let currentUIMode = '<?php echo $can_evaluate ? "instruktur" : "peserta"; ?>';
let isScanCooldown = false;

function playBeep() {
  try {
    const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    const osc = audioCtx.createOscillator();
    const gain = audioCtx.createGain();
    osc.type = "sine";
    osc.frequency.setValueAtTime(880, audioCtx.currentTime);
    gain.gain.setValueAtTime(0.2, audioCtx.currentTime);
    gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.15);
    osc.connect(gain);
    gain.connect(audioCtx.destination);
    osc.start();
    osc.stop(audioCtx.currentTime + 0.15);
    if (navigator.vibrate) {
      navigator.vibrate([100, 50, 100]);
    }
  } catch (e) {
    console.log("Audio beep unavailable", e);
  }
}

// Pengatur Dua Arah Mode: Peserta Praktik vs Instruktur Resmi
function setUIMode(mode, memberData) {
  currentUIMode = mode;
  
  if (mode === 'instruktur') {
    canEvaluate = true;
    
    // Update tombol tab atas
    $('#btnTabInstruktur').addClass('btn-success text-white shadow-sm').removeClass('btn-light text-muted');
    $('#btnTabPeserta').removeClass('btn-success text-white shadow-sm').addClass('btn-light text-muted');
    
    // Header badge
    $('#formModeBadge').removeClass('badge-warning text-dark').addClass('badge-success text-white');
    $('#formModeBadge').html('<i class="fas fa-user-shield mr-1"></i> <span id="formModeBadgeText">Mode Instruktur</span>');
    $('#formHeaderTitle').html('<i class="fas fa-clipboard-check mr-2"></i> Form Evaluasi Peserta Praktik');
    
    // Alert banner
    $('#modeAlertBanner').css({ background: '#ecfdf5', color: '#065f46' });
    $('#modeAlertIcon').removeClass('fa-id-card text-info').addClass('fa-user-shield text-success');
    $('#modeAlertText').text('Mode Instruktur Aktif. Pilih peserta dari antrean di atas atau scan KTA fisik peserta untuk mengisi evaluasi.');
    
    // Tampilkan panel antrean peserta
    $('#sectionQueueEvaluations').slideDown(250);
    
    // Sembunyikan pemilihan instruktur pembimbing (karena instruktur yang sedang aktif adalah penilainya)
    $('#groupInstructor').slideUp(200);
    $('#infoInstructorActive').slideDown(200);
    
    if (memberData && memberData.is_instructor) {
      activeInstructorId = memberData.juleha_id;
      activeInstructorName = memberData.name;
    }
    
    if (activeInstructorId) {
      $('#evaluator_id').val(activeInstructorId);
      $('#instructor_id').val(activeInstructorId);
      $('#queueInstructorName').text(activeInstructorName || activeInstructorId);
      $('#queueInstructorId').text(activeInstructorId);
      $('#labelActiveInstructorName').text(activeInstructorName || activeInstructorId);
      $('#labelActiveInstructorId').text(activeInstructorId);
      loadPendingQueue(activeInstructorId);
    } else {
      $('#queueInstructorName').text('Belum Terdeteksi');
      $('#queueInstructorId').text('Scan KTA');
      $('#badgePendingCount').text('Scan KTA');
      $('#queueLoading').hide();
      $('#queueEmpty').show().html(`
        <i class="fas fa-id-card fa-3x text-warning mb-2"></i>
        <h6 class="font-weight-bold text-dark mb-1">KTA Instruktur Belum Di-scan</h6>
        <p class="small text-muted mb-0">Silakan arahkan kamera ke QR KTA fisik Anda sebagai instruktur agar sistem mengenali penilai yang bertugas.</p>
      `);
    }
    
    // Buka kontrol evaluasi & catatan
    $('#containerInstructorEvaluation').slideDown(200);
    $('#containerParticipantEvaluation').slideUp(200);
    $('#badgeEvalLock').hide();
    
    $('#labelJulehaId').html('<i class="fas fa-user-check text-success mr-1"></i> ID Juleha Peserta yang Diuji <span class="text-danger">*</span>');
    $('#helpJulehaId').text('Pilih peserta dari Antrean di atas atau ketik ID peserta untuk mengisi evaluasi.');
    $('#btnSubmitPresensi').html('<i class="fas fa-save mr-2"></i> Simpan & Sahkan Evaluasi Peserta').removeClass('btn-submit-presensi').addClass('btn-success');
    
    // Jika baru saja beralih dari scan KTA instruktur, kosongkan kolom ID peserta agar siap diisi peserta yang diuji
    if (memberData && memberData.is_instructor) {
      $('#juleha_id').val('');
      $('#field_id').val('');
    }
    
  } else {
    // Mode Peserta
    canEvaluate = false;
    
    // Update tombol tab atas
    $('#btnTabPeserta').addClass('btn-success text-white shadow-sm').removeClass('btn-light text-muted');
    $('#btnTabInstruktur').removeClass('btn-success text-white shadow-sm').addClass('btn-light text-muted');
    
    // Header badge
    $('#formModeBadge').removeClass('badge-success text-white').addClass('badge-warning text-dark');
    $('#formModeBadge').html('<i class="fas fa-user mr-1"></i> <span id="formModeBadgeText">Mode Peserta</span>');
    $('#formHeaderTitle').html('<i class="fas fa-edit mr-2"></i> Form Presensi Peserta Praktik');
    
    // Alert banner
    $('#modeAlertBanner').css({ background: '#e0f2fe', color: '#0369a1' });
    $('#modeAlertIcon').removeClass('fa-user-shield text-success').addClass('fa-id-card text-info');
    $('#modeAlertText').text('Mode Peserta Aktif. Silakan pilih Instruktur Pembimbing Anda di bawah ini lalu klik Kirim Presensi Kehadiran.');
    
    // Sembunyikan panel antrean peserta
    $('#sectionQueueEvaluations').slideUp(200);
    
    // Tampilkan pilihan instruktur pembimbing
    $('#groupInstructor').slideDown(200);
    $('#infoInstructorActive').slideUp(200);
    $('#evaluator_id').val('');
    
    // Kunci evaluasi (hanya info readonly untuk peserta)
    $('#containerInstructorEvaluation').slideUp(200);
    $('#containerParticipantEvaluation').slideDown(200);
    $('#badgeEvalLock').show();
    
    $('#labelJulehaId').html('<i class="fas fa-id-card text-success mr-1"></i> ID Juleha Peserta yang Diuji <span class="text-danger">*</span>');
    $('#helpJulehaId').text('ID Anda terisi otomatis dari scan kartu KTA.');
    $('#btnSubmitPresensi').html('<i class="fas fa-paper-plane mr-2"></i> Kirim Presensi Kehadiran').removeClass('btn-success').addClass('btn-submit-presensi');
    
    if (memberData && !memberData.is_instructor) {
      $('#juleha_id').val(memberData.juleha_id);
    }
  }
}

// Inisialisasi Daftar Kamera HP dengan urutan kamera belakang terlebih dahulu
function initCameras() {
  if (typeof Html5Qrcode === 'undefined') {
    return;
  }
  Html5Qrcode.getCameras().then(devices => {
    const $select = $('#cameraSelect');
    $select.empty();
    $select.append('<option value="auto">📷 Kamera Belakang (Otomatis & Autofokus)</option>');

    if (devices && devices.length > 0) {
      availableCameras = devices.sort((a, b) => {
        const aL = (a.label || '').toLowerCase();
        const bL = (b.label || '').toLowerCase();
        const aIsBack = aL.includes('back') || aL.includes('rear') || aL.includes('belakang') || aL.includes('environment');
        const bIsBack = bL.includes('back') || bL.includes('rear') || bL.includes('belakang') || bL.includes('environment');
        if (aIsBack && !bIsBack) return -1;
        if (!aIsBack && bIsBack) return 1;
        return 0;
      });

      availableCameras.forEach((camera, i) => {
        let label = camera.label || ('Kamera ' + (i + 1));
        const l = label.toLowerCase();
        if (l.includes('back') || l.includes('rear') || l.includes('belakang')) {
          label = '📷 Kamera Belakang Lensa (' + (i + 1) + ')';
        } else if (l.includes('front') || l.includes('depan') || l.includes('selfie')) {
          label = '🤳 Kamera Depan';
        }
        $select.append(`<option value="${camera.id}">${label}</option>`);
      });

      if (devices.length > 1) {
        $select.show();
        $('#btnSwitchCamera').show();
      }
    }
    $select.val('auto');
  }).catch(err => {
    console.warn("Camera check:", err);
  });
}

// Start Camera dengan BarcodeDetector bawaan Android + Flashlight Support
function startCamera() {
  if (isScanning) return;

  $('#cameraPlaceholder').hide();
  $('#scannerOverlay').show();
  $('#cameraStatusBadge').text('Kamera Aktif').removeClass('badge-light badge-danger badge-warning').addClass('badge-success');
  $('#btnStopCamera').show();
  if (availableCameras.length > 1) {
    $('#btnSwitchCamera').show();
    $('#cameraSelect').show();
  }

  if (!html5QrCode) {
    html5QrCode = new Html5Qrcode("reader", {
      formatsToSupport: [ Html5QrcodeSupportedFormats.QR_CODE ],
      experimentalFeatures: {
        useBarCodeDetectorIfSupported: true // Deteksi QR Code secepat native app (hardware accelerated)
      },
      verbose: false
    });
  }

  // Konfigurasi scan ultra responsif scan full frame tanpa cropping (seperti aplikasi scanner native)
  const scanConfig = {
    fps: 15,
    disableFlip: true
  };

  let cameraSource = { facingMode: "environment" };
  const selectedDevId = $('#cameraSelect').val();
  if (selectedDevId && selectedDevId !== 'auto') {
    cameraSource = selectedDevId;
  }

  html5QrCode.start(
    cameraSource,
    scanConfig,
    onScanSuccess,
    onScanFailure
  ).then(() => {
    isScanning = true;
    checkTorchSupport();

    // Aktifkan continuous autofocus otomatis pada sensor kamera HP
    try {
      html5QrCode.applyVideoConstraints({
        focusMode: "continuous",
        advanced: [{ focusMode: "continuous" }]
      }).catch(function(e) {});
    } catch (e) {}
  }).catch(err => {
    console.warn("Camera primary start failed, trying environment fallback:", err);
    let fallbackSource = (availableCameras.length > 0 && availableCameras[0].id) ? availableCameras[0].id : { facingMode: "environment" };
    html5QrCode.start(fallbackSource, scanConfig, onScanSuccess, onScanFailure)
      .then(() => {
        isScanning = true;
        checkTorchSupport();
      })
      .catch(fallbackErr => {
        console.error("Camera fallback failed:", fallbackErr);
        $('#cameraStatusBadge').text('Terkendala').removeClass('badge-success').addClass('badge-warning');
        $('#cameraPlaceholder').show().html(`
          <i class="fas fa-camera fa-2x text-warning mb-2"></i>
          <p class="small text-white mb-2">Streaming kamera terkendala izin browser / HTTPS.<br>Gunakan tombol <strong>Foto Kamera HP</strong> di bawah untuk scan langsung.</p>
          <button class="btn btn-sm btn-light font-weight-bold" id="btnSnapNativeCameraFallback"><i class="fas fa-camera mr-1 text-success"></i> Ambil Foto QR dengan Kamera HP</button>
        `);
        $('#btnSnapNativeCameraFallback').on('click', function() {
          $('#nativeCameraInput').click();
        });
        $('#scannerOverlay').hide();
        $('#btnStopCamera').hide();
        $('#btnSwitchCamera').hide();
        $('#btnToggleTorch').hide();
      });
  });
}

function checkTorchSupport() {
  try {
    const capabilities = html5QrCode.getRunningTrackCapabilities();
    if (capabilities && capabilities.torch) {
      $('#btnToggleTorch').show();
    } else {
      $('#btnToggleTorch').hide();
    }
  } catch (e) {
    console.log("Torch capability check:", e);
  }
}

// Toggle Flashlight / Torch HP
$('#btnToggleTorch').on('click', function() {
  if (!html5QrCode || !isScanning) return;
  isTorchOn = !isTorchOn;

  html5QrCode.applyVideoConstraints({
    advanced: [{ torch: isTorchOn }]
  }).then(() => {
    if (isTorchOn) {
      $('#btnToggleTorch').removeClass('btn-warning').addClass('btn-danger').html('<i class="fas fa-lightbulb mr-1"></i> Matikan Lampu (Torch OFF)');
    } else {
      $('#btnToggleTorch').removeClass('btn-danger').addClass('btn-warning').html('<i class="fas fa-bolt mr-1"></i> Flashlight (Lampu HP)');
    }
  }).catch(err => {
    console.warn("Torch failed:", err);
    isTorchOn = !isTorchOn;
    alert("Flashlight/lampu tidak didukung oleh browser atau kamera perangkat ini.");
  });
});

function stopCamera() {
  if (html5QrCode && isScanning) {
    if (isTorchOn) {
      try { html5QrCode.applyVideoConstraints({ advanced: [{ torch: false }] }); } catch (e) {}
      isTorchOn = false;
      $('#btnToggleTorch').removeClass('btn-danger').addClass('btn-warning').html('<i class="fas fa-bolt mr-1"></i> Flashlight (Lampu HP)');
    }
    html5QrCode.stop().then(() => {
      isScanning = false;
      $('#scannerOverlay').hide();
      $('#cameraPlaceholder').show();
      $('#cameraStatusBadge').text('Kamera Dimatikan').removeClass('badge-success badge-warning badge-danger').addClass('badge-light');
      $('#btnStopCamera').hide();
      $('#btnSwitchCamera').hide();
      $('#cameraSelect').hide();
      $('#btnToggleTorch').hide();
    }).catch(err => {
      console.error("Camera stop error:", err);
    });
  }
}

// Ganti Kamera
$('#btnSwitchCamera').on('click', function() {
  if (availableCameras.length > 1) {
    currentCameraIndex = (currentCameraIndex + 1) % availableCameras.length;
    $('#cameraSelect').val(availableCameras[currentCameraIndex].id);
    if (isScanning && html5QrCode) {
      html5QrCode.stop().then(() => {
        isScanning = false;
        startCamera();
      });
    }
  } else {
    if (isScanning && html5QrCode) {
      html5QrCode.stop().then(() => {
        isScanning = false;
        startCamera();
      });
    }
  }
});

$('#cameraSelect').on('change', function() {
  if (isScanning && html5QrCode) {
    html5QrCode.stop().then(() => {
      isScanning = false;
      startCamera();
    });
  }
});

// Foto Kamera HP Asli & Scan Galeri
$('#btnSnapNativeCamera, #btnSnapNativeCameraUnder').on('click', function() {
  $('#nativeCameraInput').click();
});

$('#nativeCameraInput, #qrFileInput').on('change', function(e) {
  if (!e.target.files || e.target.files.length === 0) return;
  const file = e.target.files[0];
  if (!html5QrCode) {
    html5QrCode = new Html5Qrcode("reader", {
      formatsToSupport: [ Html5QrcodeSupportedFormats.QR_CODE ],
      experimentalFeatures: { useBarCodeDetectorIfSupported: true }
    });
  }

  $('#cameraStatusBadge').text('Memproses Foto...').removeClass('badge-light').addClass('badge-warning');
  html5QrCode.scanFile(file, true)
    .then(decodedText => {
      $('#cameraStatusBadge').text('Kamera Siap').removeClass('badge-warning').addClass('badge-light');
      onScanSuccess(decodedText);
    })
    .catch(err => {
      $('#cameraStatusBadge').text('Kamera Siap').removeClass('badge-warning').addClass('badge-light');
      alert("QR Code tidak terbaca dari foto/gambar tersebut. Pastikan kotak QR Code terlihat jelas dan tegak.");
    });
});

function onScanSuccess(decodedText) {
  if (isScanCooldown) return;
  isScanCooldown = true;

  playBeep();

  // Efek visual pulsa hijau sukses pada viewport scanner
  $('#scannerViewport').addClass('scanner-success-flash');
  setTimeout(function() {
    $('#scannerViewport').removeClass('scanner-success-flash');
  }, 600);

  let cleanId = decodedText.trim();
  const match = cleanId.match(/([A-Za-z]{3}\d{6})/i);
  if (match) {
    cleanId = match[1].toUpperCase();
  }

  $('#scanFeedback').html(`
    <div class="alert alert-success py-2 px-3 small font-weight-bold mb-0">
      <i class="fas fa-check-circle mr-1"></i> Berhasil Scan QR KTA: <strong>${cleanId}</strong>
    </div>
  `).show();

  fetchMemberInfo(cleanId);

  // Debounce 1.8 detik sebelum membaca QR berikutnya
  setTimeout(function() {
    isScanCooldown = false;
  }, 1800);
}

function onScanFailure(error) {}

// Ambil Informasi Anggota saat QR KTA terdeteksi & Otomatis Beralih Mode
function fetchMemberInfo(julehaId) {
  if (!julehaId) return;

  $('#btnCekAnggota').html('<i class="fas fa-spinner fa-spin mr-1"></i> Memuat...').prop('disabled', true);

  $.ajax({
    url: '<?php echo base_url("prakteks/get_member_ajax"); ?>',
    type: 'GET',
    data: { juleha_id: julehaId },
    dataType: 'json',
    success: function(resp) {
      $('#btnCekAnggota').html('<i class="fas fa-search mr-1"></i> Cek Anggota').prop('disabled', false);
      if (resp && resp.status) {
        $('#previewJulehaId').text('ID: ' + resp.juleha_id);
        $('#previewRegion').text(resp.region ? ('Wilayah: ' + resp.region) : 'Jawa Timur');
        $('#previewName').text(resp.name);
        $('#previewStatus').text(resp.mstatus ? resp.mstatus.toUpperCase() : 'AKTIF');
        $('#previewPraktikCnt').text(resp.total_praktikan || 0);
        $('#previewInstrukturCnt').text(resp.total_instruktur || 0);
        $('#previewPhoto').attr('src', resp.photo_url + '?t=' + new Date().getTime());

        // Logika Perpindahan Mode Dua Arah Otomatis
        if (resp.is_instructor) {
          // Kartu yang terdeteksi adalah INSTRUKTUR RESMI!
          $('#badgeKtaInstructor').show();
          $('#quickInstructorActions').show();
          $('#scanFeedback').html(`
            <div class="alert alert-warning py-2 px-3 small font-weight-bold mb-0 text-dark">
              <i class="fas fa-award text-warning mr-1"></i> Terdeteksi KTA Instruktur Resmi: <strong>${resp.name} (${resp.juleha_id})</strong>. Beralih ke Mode Instruktur.
            </div>
          `).show();

          // Otomatis beralih ke Mode Instruktur!
          setUIMode('instruktur', resp);

        } else {
          // Kartu yang terdeteksi adalah PESERTA PRAKTIK!
          $('#badgeKtaInstructor').hide();
          $('#quickInstructorActions').hide();

          $('#scanFeedback').html(`
            <div class="alert alert-success py-2 px-3 small font-weight-bold mb-0">
              <i class="fas fa-user mr-1"></i> Terdeteksi Peserta Praktik: <strong>${resp.name} (${resp.juleha_id})</strong>. Beralih ke Mode Peserta.
            </div>
          `).show();

          // Otomatis beralih ke Mode Peserta!
          setUIMode('peserta', resp);
        }

        $('#memberPreviewCard').slideDown(250);
      } else {
        $('#memberPreviewCard').slideUp(200);
        if (resp && resp.message) {
          $('#scanFeedback').html(`
            <div class="alert alert-danger py-2 px-3 small font-weight-bold mb-0">
              <i class="fas fa-exclamation-circle mr-1"></i> ${resp.message}
            </div>
          `).show();
        }
      }
    },
    error: function(xhr, status, error) {
      $('#btnCekAnggota').html('<i class="fas fa-search mr-1"></i> Cek Anggota').prop('disabled', false);
      console.warn("get_member_ajax error:", status, error);
    }
  });
}

// Handler tombol tab mode
$('#btnTabPeserta').on('click', function() {
  setUIMode('peserta');
});
$('#btnTabInstruktur').on('click', function() {
  setUIMode('instruktur');
});

$('#btnCekAnggota').on('click', function() {
  const id = $('#juleha_id').val().trim();
  if (!id) {
    alert('Silakan masukkan ID Juleha terlebih dahulu.');
    return;
  }
  fetchMemberInfo(id);
});

$('#juleha_id').on('keypress', function(e) {
  if (e.which === 13) {
    e.preventDefault();
    $('#btnCekAnggota').click();
  }
});

// Pilihan Tombol Cepat Instruktur Resmi
$('.btn-quick-instructor').on('click', function() {
  $('.btn-quick-instructor').removeClass('active');
  $(this).addClass('active');

  const inst = {
    id: $(this).data('id'),
    fullname: $(this).data('name'),
    nickname: $(this).data('nickname'),
    region: $(this).data('region'),
    photo_url: $(this).data('photo')
  };
  selectInstructor(inst);
});

// Live Search Instruktur by Name
let instSearchTimeout = null;
$('#searchInstructorInput').on('input', function() {
  const query = $(this).val().trim();
  clearTimeout(instSearchTimeout);

  if (query.length === 0) {
    $('#dropdownInstructorResults').hide();
    $('#instructorSearchResultsList').empty();
    return;
  }

  $('#instSearchIcon').removeClass('fa-search').addClass('fa-spinner fa-spin');

  instSearchTimeout = setTimeout(function() {
    $.ajax({
      url: '<?php echo base_url("prakteks/get_instructors_ajax"); ?>',
      type: 'GET',
      data: { q: query },
      dataType: 'json',
      success: function(instructors) {
        $('#instSearchIcon').removeClass('fa-spinner fa-spin').addClass('fa-search');
        renderInstructorSearchResults(instructors);
      },
      error: function() {
        $('#instSearchIcon').removeClass('fa-spinner fa-spin').addClass('fa-search');
      }
    });
  }, 200);
});

function renderInstructorSearchResults(instructors) {
  const $list = $('#instructorSearchResultsList');
  $list.empty();

  if (!instructors || instructors.length === 0) {
    $list.html(`
      <div class="p-3 text-center text-muted small">
        Tidak ditemukan instruktur dengan nama tersebut.
      </div>
    `);
    $('#dropdownInstructorResults').show();
    return;
  }

  instructors.forEach(function(inst) {
    const item = $(`
      <div class="search-item">
        <img src="${inst.photo_url}" class="search-avatar" onerror="this.onerror=null;this.src='/assets/adminlte/dist/img/avatar5.png';">
        <div class="grow pr-2">
          <strong class="text-dark d-block" style="font-size: 0.95rem;">${inst.fullname}</strong>
          <div class="small text-muted">
            <span class="badge badge-success px-2 py-0 mr-1">${inst.id}</span>
            <span class="mr-2">Panggilan: <strong>${inst.nickname || '-'}</strong></span>
            <span><i class="fas fa-map-marker-alt text-danger mr-1"></i>${inst.region}</span>
          </div>
        </div>
        <button type="button" class="btn btn-sm btn-outline-success font-weight-bold py-1 px-2">
          <i class="fas fa-check mr-1"></i> Pilih
        </button>
      </div>
    `);

    item.on('click', function() {
      selectInstructor(inst);
    });

    $list.append(item);
  });

  $('#dropdownInstructorResults').show();
}

function selectInstructor(inst) {
  $('#instructor_id').val(inst.id);
  $('#selectedInstName').text(inst.fullname + (inst.nickname ? ' (' + inst.nickname + ')' : ''));
  $('#selectedInstBadgeId').text(inst.id);
  $('#selectedInstRegion').text('Wilayah: ' + (inst.region || 'Jatim'));
  $('#selectedInstPhoto').attr('src', inst.photo_url + '?t=' + new Date().getTime());

  $('#cardSelectedInstructor').slideDown(200);
  $('#dropdownInstructorResults').hide();
  $('#searchInstructorInput').val(inst.fullname + ' (' + inst.id + ')');
}

function resetInstructorSelection() {
  $('#instructor_id').val('');
  $('#cardSelectedInstructor').slideUp(150);
  $('#searchInstructorInput').val('').focus();
  $('#dropdownInstructorResults').hide();
  $('.btn-quick-instructor').removeClass('active');
}

$('#btnCancelSelectedInst').on('click', function() {
  resetInstructorSelection();
});

// Tutup dropdown jika klik di luar
$(document).on('click', function(e) {
  if (!$(e.target).closest('#groupInstructor .position-relative').length) {
    $('#dropdownInstructorResults').hide();
  }
});

// Muat Antrean Peserta Realtime untuk Instruktur
function loadPendingQueue(instId) {
  if (!instId) instId = activeInstructorId;
  if (!instId) return;

  $('#queueLoading').show();
  $('#queueEmpty').hide();
  $('#queueList').empty();

  $.ajax({
    url: '<?php echo base_url("prakteks/get_pending_evaluations_ajax"); ?>',
    type: 'GET',
    data: { instructor_id: instId },
    dataType: 'json',
    success: function(resp) {
      $('#queueLoading').hide();
      if (resp && resp.status && resp.data && resp.data.length > 0) {
        $('#badgePendingCount').text(resp.count + ' Peserta Menunggu');
        renderQueueList(resp.data);
      } else {
        $('#badgePendingCount').text('0 Peserta');
        $('#queueEmpty').show();
      }
    },
    error: function() {
      $('#queueLoading').hide();
      $('#badgePendingCount').text('Error');
    }
  });
}

function renderQueueList(items) {
  const $list = $('#queueList');
  $list.empty();

  items.forEach(function(item) {
    const card = $(`
      <div class="queue-card-item">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
          <div class="d-flex align-items-center mr-2 mb-2 mb-sm-0">
            <img src="${item.photo_url}" class="queue-avatar mr-3" onerror="this.onerror=null;this.src='/assets/adminlte/dist/img/avatar5.png';">
            <div>
              <div class="d-flex align-items-center flex-wrap" style="gap: 6px;">
                <strong class="text-dark" style="font-size: 1rem;">${item.fullname}</strong>
                <span class="badge badge-success px-2 py-0">${item.juleha_id}</span>
                <span class="badge badge-warning text-dark px-2 py-0 font-weight-bold">${item.evaluation_status}</span>
              </div>
              <div class="small text-muted mt-1">
                <span class="mr-2"><i class="fas fa-paw text-success mr-1"></i>${item.animal_type}</span>
                <span class="mr-2"><i class="fas fa-map-marker-alt text-danger mr-1"></i>${item.location_name}</span>
                <span><i class="far fa-clock text-primary mr-1"></i>${item.formatted_time}</span>
              </div>
            </div>
          </div>
          <div>
            <button type="button" class="btn btn-success btn-sm font-weight-bold px-3 py-2 rounded-pill shadow-sm">
              <i class="fas fa-clipboard-check mr-1 text-warning"></i> Beri Nilai & Evaluasi
            </button>
          </div>
        </div>
      </div>
    `);

    card.find('button').on('click', function() {
      selectParticipantForEvaluation(item);
    });

    $list.append(card);
  });
}

// Saat Instruktur memilih peserta dari Antrean untuk diberi evaluasi
function selectParticipantForEvaluation(item) {
  // Pastikan form dalam Mode Instruktur
  setUIMode('instruktur');

  $('#field_id').val(item.praktek_id);
  $('#juleha_id').val(item.juleha_id);
  
  // Tampilkan kartu profil peserta yang dievaluasi
  $('#previewJulehaId').text('ID: ' + item.juleha_id);
  $('#previewRegion').text(item.region ? ('Wilayah: ' + item.region) : 'Jawa Timur');
  $('#previewName').text(item.fullname);
  $('#previewPhoto').attr('src', item.photo_url + '?t=' + new Date().getTime());
  $('#memberPreviewCard').slideDown(250);

  // Set jenis sembelihan & RPH sesuai inputan peserta
  $(`input[name="animal_type"][value="${item.animal_type}"]`).prop('checked', true);
  $('#rph_id').val(item.rph_id);

  $('#formHeaderTitle').html(`<i class="fas fa-clipboard-check text-warning mr-2"></i> Evaluasi Peserta: <strong>${item.fullname} (${item.juleha_id})</strong>`);
  $('#description').focus();

  // Scroll smooth ke form evaluasi
  $('html, body').animate({
    scrollTop: $("#formPresensi").offset().top - 80
  }, 400);
}

$('#btnRefreshQueue').on('click', function() {
  loadPendingQueue();
});

function setRole(role) {
  $('#role').val(role);
  if (role === 'instruktur') {
    $('#btnRoleInstruktur').addClass('active btn-primary').removeClass('btn-outline-primary');
    $('#btnRolePraktikan').removeClass('active btn-success').addClass('btn-outline-success');
    $('#groupInstructor').slideUp(200);
    $('#infoInstructorActive').slideUp(200);
    $('#groupEvaluation').slideUp(200);
    $('#labelJulehaId').html('<i class="fas fa-id-card text-success mr-1"></i> ID Instruktur yang Bertugas <span class="text-danger">*</span>');
    if (activeInstructorId) {
      $('#juleha_id').val(activeInstructorId);
    }
    $('#btnSubmitPresensi').html('<i class="fas fa-save mr-2"></i> Simpan Penugasan Instruktur di RPH');
  } else {
    $('#btnRolePraktikan').addClass('active btn-success').removeClass('btn-outline-success');
    $('#btnRoleInstruktur').removeClass('active btn-primary').addClass('btn-outline-primary');
    $('#groupEvaluation').slideDown(200);
    if (canEvaluate) {
      $('#groupInstructor').slideUp(200);
      $('#infoInstructorActive').slideDown(200);
      $('#labelJulehaId').html('<i class="fas fa-user-check text-success mr-1"></i> ID Juleha Peserta yang Diuji <span class="text-danger">*</span>');
      $('#btnSubmitPresensi').html('<i class="fas fa-save mr-2"></i> Simpan & Sahkan Evaluasi Peserta').removeClass('btn-submit-presensi').addClass('btn-success');
    } else {
      $('#groupInstructor').slideDown(200);
      $('#infoInstructorActive').slideUp(200);
      $('#labelJulehaId').html('<i class="fas fa-id-card text-success mr-1"></i> ID Juleha Peserta yang Diuji <span class="text-danger">*</span>');
      $('#btnSubmitPresensi').html('<i class="fas fa-paper-plane mr-2"></i> Kirim Presensi Kehadiran').removeClass('btn-success').addClass('btn-submit-presensi');
    }
  }
}

// Submit Form Presensi / Evaluasi
$('#formPresensi').on('submit', function(e) {
  e.preventDefault();

  const julehaId = $('#juleha_id').val().trim();
  if (!julehaId) {
    alert('ID Juleha anggota wajib diisi atau di-scan!');
    return;
  }

  const role = $('#role').val();
  if (role === 'praktikan' && !$('#instructor_id').val().trim() && !canEvaluate) {
    alert('Silakan pilih Instruktur Pembimbing yang bertugas terlebih dahulu.');
    $('#searchInstructorInput').focus();
    return;
  }

  const $btn = $('#btnSubmitPresensi');
  $btn.html('<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan ke Database...').prop('disabled', true);

  $.ajax({
    url: '<?php echo base_url("prakteks/save_attendance_ajax"); ?>',
    type: 'POST',
    data: $(this).serialize(),
    dataType: 'json',
    success: function(resp) {
      $btn.html('<i class="fas fa-save mr-2"></i> Simpan Presensi').prop('disabled', false);
      if (resp && resp.status) {
        alert(resp.message);
        $('#description').val('');
        $('#field_id').val('');
        $('#memberPreviewCard').slideUp(200);
        $('#scanFeedback').html(`
          <div class="alert alert-success py-2 px-3 small font-weight-bold mb-0">
            <i class="fas fa-check-double mr-1"></i> Data berhasil tersimpan di database secara realtime! Siap memproses data berikutnya.
          </div>
        `).show();

        // Refresh antrean jika instruktur
        if (canEvaluate || activeInstructorId) {
          loadPendingQueue();
        }
      } else {
        alert((resp && resp.message) ? resp.message : 'Gagal menyimpan data.');
      }
    },
    error: function() {
      $btn.html('<i class="fas fa-save mr-2"></i> Simpan Presensi').prop('disabled', false);
      alert('Terjadi kesalahan jaringan saat menyimpan data.');
    }
  });
});

$(document).ready(function() {
  initCameras();
  $('#btnStartCamera').on('click', startCamera);
  $('#btnStopCamera').on('click', stopCamera);

  // Set mode awal sesuai state pembukaan halaman
  setUIMode(currentUIMode);

  const prefill = $('#juleha_id').val().trim();
  if (prefill) {
    fetchMemberInfo(prefill);
  }

  // Jika instruktur aktif, muat antrean evaluasi secara otomatis
  if (canEvaluate && activeInstructorId) {
    loadPendingQueue(activeInstructorId);
  }

  // Coba jalankan kamera secara langsung saat membuka halaman agar responsif
  try {
    startCamera();
  } catch (e) {
    console.warn("Auto-start camera notice:", e);
  }
});
</script>

</body>
</html>
