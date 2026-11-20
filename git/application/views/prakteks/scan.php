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
      min-height: 280px;
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
      max-height: 340px;
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
      width: 220px;
      height: 220px;
      border: 3px solid #10b981;
      border-radius: 16px;
      box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.45);
      pointer-events: none;
      display: none;
    }
    .scanner-laser {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 2px;
      background: #34d399;
      box-shadow: 0 0 12px #34d399;
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
      padding: 18px;
      display: none;
      transition: all 0.3s ease;
    }
    .member-avatar-preview {
      width: 80px;
      height: 80px;
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
          <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold" style="color: #064e3b; font-size: 1.55rem;">
              <i class="fas fa-qrcode text-success mr-2"></i> Presensi Praktik & Evaluasi Instruktur
            </h1>
            <p class="text-muted small m-0 mt-1">Khusus Lokasi <strong>RPH TOW</strong> & <strong>RPH Kedurus</strong> Juleha Jawa Timur</p>
          </div>
          <div class="col-sm-6 mt-2 mt-sm-0">
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
                <i class="fas fa-stopwatch text-success mr-1"></i> Kapan Waktu Scan KTA yang Paling Tepat di RPH?
              </h6>
              <p class="small text-muted mb-2">
                <strong>Alur Lapangan Terbaik:</strong> Dilakukan <strong>tepat saat / sesaat setelah peserta selesai melakukan praktik penyembelihan</strong> di hadapan Instruktur di RPH TOW atau RPH Kedurus.
              </p>
              <div class="row">
                <div class="col-md-6 mb-1">
                  <div class="small text-dark font-weight-500">
                    <span class="badge badge-success mr-1">Langkah 1</span> <strong>Instruktur Buka Scanner:</strong> Instruktur mengarahkan kamera ke QR KTA Peserta (atau ketik ID Peserta).
                  </div>
                </div>
                <div class="col-md-6 mb-1">
                  <div class="small text-dark font-weight-500">
                    <span class="badge badge-primary mr-1">Langkah 2</span> <strong>Instruktur Beri Evaluasi:</strong> Instruktur memilih RPH (TOW/Kedurus), menentukan status lulus, dan mengisi catatan evaluasi yang langsung tertaut ke profil peserta.
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
                <span class="badge badge-light px-2 py-1" id="cameraStatusBadge">Kamera Siap</span>
              </div>
              <div class="card-body p-3 text-center">
                
                <!-- Video Scanner Viewport -->
                <div class="scanner-box" id="scannerViewport">
                  <div id="reader"></div>
                  <div class="scanner-overlay" id="scannerOverlay">
                    <div class="scanner-laser"></div>
                  </div>
                  <div id="cameraPlaceholder" class="p-4 text-center text-white">
                    <i class="fas fa-qrcode fa-3x mb-3 text-success"></i>
                    <p class="small text-white-50 mb-3">Arahkan kamera ke QR KTA fisik untuk scan langsung, atau ambil foto dengan kamera HP</p>
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

                <!-- Scanner Controls -->
                <div class="mt-3 d-flex flex-wrap justify-content-center align-items-center" style="gap: 8px;">
                  <select id="cameraSelect" class="form-control form-control-sm" style="display: none; max-width: 200px; border-radius: 8px; font-weight: 500;">
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

          <!-- RIGHT COLUMN: Attendance Form & Member Preview -->
          <div class="col-lg-7 col-md-6">
            <div class="card-modern">
              <div class="card-header-juleha d-flex align-items-center justify-content-between">
                <span class="font-weight-bold"><i class="fas fa-edit mr-2"></i> Form Presensi & Evaluasi Praktik</span>
                <?php if ($can_evaluate): ?>
                  <span class="badge badge-light px-2 py-1 font-weight-bold text-success"><i class="fas fa-user-shield mr-1"></i> Mode Instruktur</span>
                <?php else: ?>
                  <span class="badge badge-warning px-2 py-1 font-weight-bold text-dark"><i class="fas fa-user mr-1"></i> Mode Peserta</span>
                <?php endif; ?>
              </div>
              <div class="card-body p-4">

                <?php if (empty($is_logged_in)): ?>
                  <div class="alert alert-info border-0 shadow-sm py-2 px-3 mb-3 d-flex flex-wrap align-items-center justify-content-between" style="border-radius: 12px; background: #e0f2fe; color: #0369a1;">
                    <div class="d-flex align-items-center mb-1 mb-md-0">
                      <i class="fas fa-id-card fa-lg text-info mr-2"></i>
                      <span class="small font-weight-500">Mode Presensi Peserta Aktif. Anda dapat langsung menyimpan presensi praktik di RPH tanpa harus login.</span>
                    </div>
                    <a href="<?php echo base_url('members/login'); ?>" class="btn btn-sm btn-info font-weight-bold text-white shadow-sm" style="border-radius: 8px;">
                      <i class="fas fa-sign-in-alt mr-1"></i> Login Instruktur
                    </a>
                  </div>
                <?php endif; ?>

                <!-- Member Preview Card (Shows upon QR Detection / ID Input) -->
                <div class="member-preview-card mb-4" id="memberPreviewCard">
                  <div class="d-flex align-items-center">
                    <img src="/assets/adminlte/dist/img/avatar5.png" id="previewPhoto" class="member-avatar-preview mr-3" alt="Foto KTA">
                    <div class="flex-grow-1">
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
                          <i class="fas fa-briefcase mr-1"></i> Presensi Penugasan Instruktur
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Form Presensi -->
                <form id="formPresensi">
                  <input type="hidden" name="id" id="field_id" value="">

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
                             value="<?php echo htmlspecialchars($prefill_id ?? ($can_evaluate ? '' : $logged_id), ENT_QUOTES, 'UTF-8'); ?>" required>
                      <div class="input-group-append">
                        <button class="btn btn-outline-success font-weight-bold" type="button" id="btnCekAnggota">
                          <i class="fas fa-search mr-1"></i> Cek Anggota
                        </button>
                      </div>
                    </div>
                    <small class="text-muted" id="helpJulehaId">
                      <?php if ($can_evaluate): ?>
                        Scan KTA fisik peserta untuk otomatis men-tag peserta yang akan dievaluasi.
                      <?php else: ?>
                        ID Anda terisi otomatis untuk presensi kehadiran praktik di RPH.
                      <?php endif; ?>
                    </small>
                  </div>

                  <!-- 3. Instruktur Pembimbing -->
                  <div class="form-group mb-3" id="groupInstructor">
                    <label class="font-weight-bold text-dark small text-uppercase">
                      <i class="fas fa-user-tie text-success mr-1"></i> Instruktur Pembimbing / Penguji <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control font-weight-bold text-dark" id="instructor_id" name="instructor_id" 
                           placeholder="Ketik ID Instruktur (misal: SBY220006)"
                           value="<?php echo htmlspecialchars($can_evaluate ? $logged_id : '', ENT_QUOTES, 'UTF-8'); ?>">
                    <small class="text-muted">
                      <?php if ($can_evaluate): ?>
                        Tercatat sebagai Instruktur Penguji: <strong><?php echo htmlspecialchars($logged_name); ?> (<?php echo htmlspecialchars($logged_id); ?>)</strong>.
                      <?php else: ?>
                        Ketik ID Instruktur yang mendampingi dan menguji praktik Anda di RPH.
                      <?php endif; ?>
                    </small>
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
                      <?php if (!$can_evaluate): ?>
                        <span class="badge badge-warning text-dark font-weight-bold"><i class="fas fa-lock mr-1"></i> Khusus Diisi Instruktur</span>
                      <?php endif; ?>
                    </div>

                    <?php if ($can_evaluate): ?>
                      <!-- Instruktur / Admin Input -->
                      <div class="mb-2">
                        <label class="small text-muted font-weight-bold text-uppercase d-block mb-1">Hasil Evaluasi / Kelulusan:</label>
                        <label>
                          <input type="radio" name="evaluation_status" value="Lulus Praktik" checked class="d-none">
                          <span class="radio-pill-badge text-success"><i class="fas fa-check mr-1"></i> Lulus Praktik</span>
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
                      <small class="text-muted">Catatan evaluasi ini akan langsung tampil di halaman profil dan riwayat peserta yang di-tag.</small>
                    <?php else: ?>
                      <!-- Peserta Biasa (Read-Only) -->
                      <div class="alert alert-light border small text-muted mb-2">
                        <i class="fas fa-info-circle text-success mr-1"></i> <strong>Informasi untuk Peserta:</strong> Catatan evaluasi hanya dapat diisi oleh Instruktur Penguji. Setelah Anda menyembelih di RPH, Instruktur akan memberikan penilaian dan evaluasi yang akan tampil di profil Anda.
                      </div>
                      <textarea class="form-control bg-light" rows="2" readonly 
                                placeholder="Menunggu penilaian dan catatan evaluasi dari Instruktur Pembimbing..."></textarea>
                    <?php endif; ?>
                  </div>

                  <!-- Submit Action Button -->
                  <button type="submit" class="btn btn-submit-presensi btn-block" id="btnSubmitPresensi">
                    <i class="fas fa-save mr-2"></i> <?php echo $can_evaluate ? 'Simpan Evaluasi & Presensi Peserta' : 'Kirim Presensi Kehadiran'; ?>
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
  } catch (e) {
    console.log("Audio beep unavailable", e);
  }
}

function initCameras() {
  if (typeof Html5Qrcode === 'undefined') {
    return;
  }
  Html5Qrcode.getCameras().then(devices => {
    if (devices && devices.length > 0) {
      availableCameras = devices;
      const $select = $('#cameraSelect');
      $select.empty();
      devices.forEach((camera, i) => {
        let label = camera.label || ('Kamera ' + (i + 1));
        $select.append(`<option value="${camera.id}">${label}</option>`);
      });

      // Cari kamera belakang / environment sebagai default
      let backIndex = devices.findIndex(c => {
        const l = (c.label || '').toLowerCase();
        return l.includes('back') || l.includes('rear') || l.includes('belakang') || l.includes('environment');
      });
      if (backIndex === -1 && devices.length > 1) {
        backIndex = devices.length - 1;
      }
      if (backIndex !== -1) {
        currentCameraIndex = backIndex;
        $select.val(devices[backIndex].id);
      }
      if (devices.length > 1) {
        $select.show();
        $('#btnSwitchCamera').show();
      }
    }
  }).catch(err => {
    console.warn("Camera enumeration check:", err);
  });
}

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
    html5QrCode = new Html5Qrcode("reader");
  }

  const config = {
    fps: 15,
    qrbox: { width: 240, height: 240 },
    aspectRatio: 1.0
  };

  let cameraSource = null;
  const selectedDevId = $('#cameraSelect').val();
  if (selectedDevId) {
    cameraSource = selectedDevId;
  } else if (availableCameras.length > 0) {
    cameraSource = availableCameras[currentCameraIndex].id;
  } else {
    cameraSource = { facingMode: "environment" };
  }

  html5QrCode.start(
    cameraSource,
    config,
    onScanSuccess,
    onScanFailure
  ).then(() => {
    isScanning = true;
  }).catch(err => {
    console.warn("Camera start primary failed, trying fallback:", err);
    // Fallback: coba start dengan { facingMode: "environment" }
    html5QrCode.start({ facingMode: "environment" }, config, onScanSuccess, onScanFailure)
      .then(() => {
        isScanning = true;
      })
      .catch(fallbackErr => {
        console.error("Camera fallback failed:", fallbackErr);
        $('#cameraStatusBadge').text('Streaming Terkendala').removeClass('badge-success').addClass('badge-warning');
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
      });
  });
}

function stopCamera() {
  if (html5QrCode && isScanning) {
    html5QrCode.stop().then(() => {
      isScanning = false;
      $('#scannerOverlay').hide();
      $('#cameraPlaceholder').show();
      $('#cameraStatusBadge').text('Kamera Dimatikan').removeClass('badge-success badge-warning badge-danger').addClass('badge-light');
      $('#btnStopCamera').hide();
      $('#btnSwitchCamera').hide();
      $('#cameraSelect').hide();
    }).catch(err => {
      console.error("Camera stop error:", err);
    });
  }
}

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
        html5QrCode.start({ facingMode: "user" }, { fps: 15, qrbox: { width: 240, height: 240 } }, onScanSuccess, onScanFailure)
          .then(() => { isScanning = true; })
          .catch(() => { startCamera(); });
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

// Trigger Kamera HP Asli (100% Berfungsi di semua smartphone)
$('#btnSnapNativeCamera, #btnSnapNativeCameraUnder').on('click', function() {
  $('#nativeCameraInput').click();
});

$('#nativeCameraInput').on('change', function(e) {
  if (!e.target.files || e.target.files.length === 0) return;
  const file = e.target.files[0];
  if (!html5QrCode) {
    html5QrCode = new Html5Qrcode("reader");
  }
  $('#cameraStatusBadge').text('Memproses Foto...').removeClass('badge-light').addClass('badge-warning');
  html5QrCode.scanFile(file, true)
    .then(decodedText => {
      $('#cameraStatusBadge').text('Kamera Siap').removeClass('badge-warning').addClass('badge-light');
      onScanSuccess(decodedText);
    })
    .catch(err => {
      $('#cameraStatusBadge').text('Kamera Siap').removeClass('badge-warning').addClass('badge-light');
      alert("QR Code tidak terbaca dari foto tersebut. Silakan ambil foto ulang dengan jarak lebih dekat dan pastikan kotak QR Code KTA terlihat jelas dan tegak.");
    });
});

$('#qrFileInput').on('change', function(e) {
  if (!e.target.files || e.target.files.length === 0) return;
  const imageFile = e.target.files[0];

  if (!html5QrCode) {
    html5QrCode = new Html5Qrcode("reader");
  }

  $('#cameraStatusBadge').text('Memproses Gambar...').removeClass('badge-light').addClass('badge-warning');
  html5QrCode.scanFile(imageFile, true)
    .then(decodedText => {
      $('#cameraStatusBadge').text('Kamera Siap').removeClass('badge-warning').addClass('badge-light');
      onScanSuccess(decodedText);
    })
    .catch(err => {
      $('#cameraStatusBadge').text('Kamera Siap').removeClass('badge-warning').addClass('badge-light');
      alert("Tidak ditemukan QR Code yang valid pada gambar tersebut.");
    });
});

function onScanSuccess(decodedText) {
  playBeep();
  let cleanId = decodedText.trim();
  // Tangani scan dari URL https://members.julehajatim.com/members/show/SBY220006 atau ID langsung
  const match = cleanId.match(/([A-Za-z]{3}\d{6})/i);
  if (match) {
    cleanId = match[1].toUpperCase();
  }

  $('#juleha_id').val(cleanId);
  $('#scanFeedback').html(`
    <div class="alert alert-success py-2 px-3 small font-weight-bold mb-0">
      <i class="fas fa-check-circle mr-1"></i> Berhasil Scan QR KTA: <strong>${cleanId}</strong>
    </div>
  `).show();

  fetchMemberInfo(cleanId);
}

function onScanFailure(error) {}

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

        // Cek pengakuan Instruktur
        if (resp.is_instructor) {
          $('#badgeKtaInstructor').show();
          $('#quickInstructorActions').show();
          $('#scanFeedback').html(`
            <div class="alert alert-warning py-2 px-3 small font-weight-bold mb-0 text-dark">
              <i class="fas fa-award text-warning mr-1"></i> Terdeteksi KTA Instruktur Resmi: <strong>${resp.name} (${resp.juleha_id})</strong>
            </div>
          `).show();
        } else {
          $('#badgeKtaInstructor').hide();
          $('#quickInstructorActions').hide();
          setRole('praktikan');
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
      // Hindari alert pop up yang mengganggu saat auto prefill di background
    }
  });
}

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

function setRole(role) {
  $('#role').val(role);
  if (role === 'instruktur') {
    $('#btnRoleInstruktur').addClass('active btn-primary').removeClass('btn-outline-primary');
    $('#btnRolePraktikan').removeClass('active btn-success').addClass('btn-outline-success');
    $('#groupInstructor').slideUp(200);
    $('#labelJulehaId').html('<i class="fas fa-id-card text-success mr-1"></i> ID Instruktur yang Bertugas <span class="text-danger">*</span>');
  } else {
    $('#btnRolePraktikan').addClass('active btn-success').removeClass('btn-outline-success');
    $('#btnRoleInstruktur').removeClass('active btn-primary').addClass('btn-outline-primary');
    $('#groupInstructor').slideDown(200);
    $('#labelJulehaId').html('<i class="fas fa-id-card text-success mr-1"></i> ID Juleha Peserta yang Diuji <span class="text-danger">*</span>');
  }
}

$('#formPresensi').on('submit', function(e) {
  e.preventDefault();

  const julehaId = $('#juleha_id').val().trim();
  if (!julehaId) {
    alert('ID Juleha anggota wajib diisi atau di-scan!');
    return;
  }

  const $btn = $('#btnSubmitPresensi');
  $btn.html('<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...').prop('disabled', true);

  $.ajax({
    url: '<?php echo base_url("prakteks/save_attendance_ajax"); ?>',
    type: 'POST',
    data: $(this).serialize(),
    dataType: 'json',
    success: function(resp) {
      $btn.html('<i class="fas fa-save mr-2"></i> Simpan Presensi').prop('disabled', false);
      if (resp.status) {
        alert(resp.message);
        $('#description').val('');
        $('#memberPreviewCard').slideUp(200);
        $('#scanFeedback').html(`
          <div class="alert alert-success py-2 px-3 small font-weight-bold mb-0">
            <i class="fas fa-check-double mr-1"></i> Presensi berhasil disimpan! Siap scan kartu berikutnya.
          </div>
        `).show();
      } else {
        alert(resp.message || 'Gagal menyimpan data.');
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

  const prefill = $('#juleha_id').val().trim();
  if (prefill) {
    fetchMemberInfo(prefill);
  }
});
</script>

</body>
</html>
