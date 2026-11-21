<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title ?? 'Rekapitulasi Presensi & Praktik - Juleha Jawa Timur'; ?></title>

  <!-- Google Font: Poppins & Font Awesome -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" href="/assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
    .stat-card {
      background: #ffffff;
      border-radius: 16px;
      border: 1px solid #e2e8f0;
      padding: 20px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      transition: all 0.2s ease;
    }
    .stat-card:hover {
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
      transform: translateY(-2px);
    }
    .stat-icon {
      width: 56px;
      height: 56px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      margin-right: 18px;
      flex-shrink: 0;
    }
    .stat-icon-green { background: #ecfdf5; color: #059669; }
    .stat-icon-blue { background: #eff6ff; color: #2563eb; }
    .stat-icon-amber { background: #fffbeb; color: #d97706; }
    .stat-icon-purple { background: #faf5ff; color: #9333ea; }
    
    .stat-val {
      font-size: 1.6rem;
      font-weight: 700;
      color: #0f172a;
      line-height: 1.1;
      margin-bottom: 2px;
    }
    .stat-lbl {
      font-size: 0.85rem;
      color: #64748b;
      font-weight: 500;
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
    .badge-eval-pass {
      background-color: #dcfce7;
      color: #166534;
      border: 1px solid #86efac;
      padding: 4px 10px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.78rem;
    }
    .badge-eval-wait {
      background-color: #fef9c3;
      color: #854d0e;
      border: 1px solid #fde047;
      padding: 4px 10px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.78rem;
    }
    .badge-eval-guidance {
      background-color: #ffedd5;
      color: #9a3412;
      border: 1px solid #fed7aa;
      padding: 4px 10px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.78rem;
    }
    .member-thumb {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 10px;
      border: 2px solid #e2e8f0;
    }

    /* Floating Selection Action Bar */
    .selection-action-bar {
      position: fixed;
      bottom: 25px;
      left: 50%;
      transform: translateX(-50%);
      background: #0f172a;
      color: #ffffff;
      padding: 12px 24px;
      border-radius: 50px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
      z-index: 1050;
      display: none;
      align-items: center;
      gap: 12px;
      transition: all 0.3s ease;
      border: 2px solid #10b981;
    }

    /* Checkbox Styling */
    .table-checkbox {
      width: 18px;
      height: 18px;
      cursor: pointer;
      accent-color: #059669;
    }

    /* Preset Buttons */
    .preset-btn {
      transition: all 0.2s ease;
      font-size: 0.82rem;
    }

    /* Export Sheet Container (Hidden on screen, rendered by html2canvas) */
    #rekapExportSheet {
      position: absolute;
      left: -9999px;
      top: -9999px;
      width: 1100px;
      background: #ffffff;
      color: #0f172a;
      padding: 40px;
      font-family: 'Poppins', Arial, sans-serif;
    }
    .kop-surat-box {
      border-bottom: 3px double #064e3b;
      padding-bottom: 15px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .kop-logo {
      width: 80px;
      height: auto;
    }
    .kop-text {
      text-align: center;
      flex-grow: 1;
      padding: 0 20px;
    }
    .kop-text h2 {
      font-size: 18px;
      font-weight: 700;
      color: #064e3b;
      margin: 0;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .kop-text h3 {
      font-size: 15px;
      font-weight: 600;
      color: #0f172a;
      margin: 3px 0;
    }
    .kop-text p {
      font-size: 11px;
      color: #64748b;
      margin: 0;
    }
    .export-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
      font-size: 11.5px;
    }
    .export-table th {
      background-color: #064e3b;
      color: #ffffff;
      padding: 9px 8px;
      text-align: left;
      font-weight: 600;
      border: 1px solid #064e3b;
    }
    .export-table td {
      padding: 8px;
      border: 1px solid #cbd5e1;
      color: #1e293b;
      vertical-align: middle;
    }
    .export-table tr:nth-child(even) td {
      background-color: #f8fafc;
    }
    .export-footer {
      margin-top: 35px;
      display: flex;
      justify-content: space-between;
      font-size: 12px;
    }
    .ttd-box {
      text-align: center;
      width: 260px;
    }
    .ttd-space {
      height: 70px;
    }

    /* Print styles */
    @media print {
      body * {
        visibility: hidden;
      }
      #printArea, #printArea * {
        visibility: visible;
      }
      #printArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
      }
      .no-print {
        display: none !important;
      }
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
        <a href="<?php echo base_url('members/index'); ?>" class="nav-link font-weight-500">Daftar Anggota</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('prakteks/index'); ?>" class="nav-link font-weight-500 active text-success font-weight-bold">Rekap Praktik</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="<?php echo base_url('prakteks/scan'); ?>" class="btn btn-success btn-sm rounded shadow-sm font-weight-bold px-3 mr-2">
          <i class="fas fa-qrcode mr-1"></i> Scan Presensi KTA
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('prakteks/rekap_anggota'); ?>" class="btn btn-outline-secondary btn-sm rounded shadow-sm font-weight-bold px-3 mr-2">
          <i class="fas fa-users mr-1"></i> Rekap per Anggota
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
              <i class="fas fa-clipboard-check text-success mr-2"></i> Rekapitulasi Presensi & Praktik Sembelih
            </h1>
            <p class="text-muted small m-0 mt-1">Khusus Lokasi Resmi: <strong>RPH TOW</strong> & <strong>RPH Kedurus</strong> Juleha Jawa Timur</p>
          </div>
          <div class="col-sm-6 mt-2 mt-sm-0">
            <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>" class="text-success">Home</a></li>
              <li class="breadcrumb-item active text-muted">Presensi Praktik</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <section class="content mt-3">
      <div class="container-fluid">

        <!-- Stat Cards -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="stat-card">
              <div class="stat-icon stat-icon-green"><i class="fas fa-cut"></i></div>
              <div>
                <div class="stat-val"><?php echo number_format($stats['total_records'] ?? 0); ?></div>
                <div class="stat-lbl">Total Catatan Praktik</div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="stat-card">
              <div class="stat-icon stat-icon-blue"><i class="fas fa-user-check"></i></div>
              <div>
                <div class="stat-val"><?php echo number_format($stats['total_praktikan'] ?? 0); ?></div>
                <div class="stat-lbl">Sesi Praktikan</div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="stat-card">
              <div class="stat-icon stat-icon-amber"><i class="fas fa-chalkboard-teacher"></i></div>
              <div>
                <div class="stat-val"><?php echo number_format($stats['total_instruktur'] ?? 0); ?></div>
                <div class="stat-lbl">Sesi Instruktur</div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="stat-card">
              <div class="stat-icon stat-icon-purple"><i class="fas fa-users"></i></div>
              <div>
                <div class="stat-val"><?php echo number_format($stats['unique_members'] ?? 0); ?></div>
                <div class="stat-lbl">Anggota Telah Praktik</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Filter Card: RPH, Waktu, Anggota, Status -->
        <div class="card-modern p-3 mb-4">
          <!-- Preset Waktu Cepat (Hari Ini, Bulan Ini, Tahun Ini, Semua Waktu) -->
          <div class="mb-3 d-flex flex-wrap align-items-center" style="gap: 8px;">
            <span class="small font-weight-bold text-muted mr-1"><i class="fas fa-bolt text-warning mr-1"></i> Rekap Cepat:</span>
            <?php 
              $is_today = (($filters['period'] ?? '') === 'today' || ($filters['date'] ?? '') === date('Y-m-d'));
              $is_this_month = (($filters['period'] ?? '') === 'this_month' || (($filters['month'] ?? '') == date('n') && ($filters['year'] ?? '') == date('Y') && empty($filters['date'])));
              $is_this_year = (($filters['period'] ?? '') === 'this_year' || (($filters['year'] ?? '') == date('Y') && empty($filters['month']) && empty($filters['date']) && empty($filters['period'])));
              $is_all_time = (empty($filters['period']) && empty($filters['date']) && empty($filters['month']) && empty($filters['year']));
            ?>
            <a href="<?php echo base_url('prakteks/index'); ?>" 
               class="btn btn-sm <?php echo $is_all_time ? 'btn-success font-weight-bold shadow-sm' : 'btn-outline-secondary'; ?> rounded-pill px-3 preset-btn">
              <i class="fas fa-globe mr-1"></i> Semua Waktu
            </a>
            <a href="<?php echo base_url('prakteks/index?period=today'); ?>" 
               class="btn btn-sm <?php echo $is_today ? 'btn-success font-weight-bold shadow-sm' : 'btn-outline-secondary'; ?> rounded-pill px-3 preset-btn">
              <i class="far fa-calendar-check mr-1"></i> 📅 Hari Ini (<?php echo date('d M Y'); ?>)
            </a>
            <a href="<?php echo base_url('prakteks/index?period=this_month'); ?>" 
               class="btn btn-sm <?php echo $is_this_month ? 'btn-success font-weight-bold shadow-sm' : 'btn-outline-secondary'; ?> rounded-pill px-3 preset-btn">
              <i class="far fa-calendar-alt mr-1"></i> 🗓️ Bulan Ini (<?php echo date('M Y'); ?>)
            </a>
            <a href="<?php echo base_url('prakteks/index?period=this_year'); ?>" 
               class="btn btn-sm <?php echo $is_this_year ? 'btn-success font-weight-bold shadow-sm' : 'btn-outline-secondary'; ?> rounded-pill px-3 preset-btn">
              <i class="fas fa-calendar mr-1"></i> 📋 Tahun Ini (<?php echo date('Y'); ?>)
            </a>
          </div>

          <form method="GET" action="<?php echo base_url('prakteks/index'); ?>" id="formFilterPraktek" class="row align-items-end">
            <!-- Tanggal Spesifik (Datepicker) -->
            <div class="col-lg-2 col-md-3 col-sm-6 mb-2">
              <label class="small text-muted font-weight-bold text-uppercase mb-1">
                <i class="far fa-calendar text-success mr-1"></i> Tanggal
              </label>
              <input type="date" name="date" class="form-control form-control-sm font-weight-bold" 
                     value="<?php echo htmlspecialchars($filters['date'] ?? ''); ?>"
                     title="Pilih tanggal spesifik untuk rekap harian">
            </div>

            <!-- Bulan -->
            <div class="col-lg-2 col-md-3 col-sm-6 mb-2">
              <label class="small text-muted font-weight-bold text-uppercase mb-1">
                <i class="far fa-calendar-alt text-success mr-1"></i> Bulan
              </label>
              <select name="month" class="form-control form-control-sm">
                <option value="">-- Semua Bulan --</option>
                <?php 
                  $nama_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                  for($m = 1; $m <= 12; $m++):
                ?>
                  <option value="<?php echo $m; ?>" <?php echo (($filters['month'] ?? '') == $m) ? 'selected' : ''; ?>>
                    <?php echo $nama_bulan[$m]; ?>
                  </option>
                <?php endfor; ?>
              </select>
            </div>

            <!-- Tahun -->
            <div class="col-lg-2 col-md-3 col-sm-6 mb-2">
              <label class="small text-muted font-weight-bold text-uppercase mb-1">
                <i class="fas fa-calendar-check text-success mr-1"></i> Tahun
              </label>
              <select name="year" class="form-control form-control-sm">
                <option value="">-- Semua Tahun --</option>
                <?php for($y = (int)date('Y'); $y >= 2020; $y--): ?>
                  <option value="<?php echo $y; ?>" <?php echo (($filters['year'] ?? '') == $y) ? 'selected' : ''; ?>><?php echo $y; ?></option>
                <?php endfor; ?>
              </select>
            </div>

            <!-- Filter Anggota Tertentu (Dropdown Anggota yang Praktik) -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
              <label class="small text-muted font-weight-bold text-uppercase mb-1">
                <i class="fas fa-user-check text-success mr-1"></i> Pilih Anggota
              </label>
              <select name="juleha_id" class="form-control form-control-sm">
                <option value="">-- Semua Anggota --</option>
                <?php if (!empty($practiced_members)): ?>
                  <?php foreach ($practiced_members as $pm): 
                    $p_name = trim(($pm->firstname ?? '') . ' ' . ($pm->lastname ?? ''));
                    if (empty($p_name)) $p_name = $pm->nickname ?? $pm->juleha_id;
                  ?>
                    <option value="<?php echo htmlspecialchars($pm->juleha_id); ?>" <?php echo (($filters['juleha_id'] ?? '') === $pm->juleha_id) ? 'selected' : ''; ?>>
                      <?php echo htmlspecialchars($pm->juleha_id . ' - ' . $p_name . (!empty($pm->region) ? ' (' . $pm->region . ')' : '')); ?>
                    </option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>

            <!-- Lokasi RPH -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
              <label class="small text-muted font-weight-bold text-uppercase mb-1">
                <i class="fas fa-map-marker-alt text-danger mr-1"></i> Lokasi RPH
              </label>
              <select name="rph_id" class="form-control form-control-sm font-weight-bold">
                <option value="">-- Semua RPH (TOW & Kedurus) --</option>
                <option value="1" <?php echo (($filters['rph_id'] ?? '') == '1') ? 'selected' : ''; ?>>RPH TOW (Tambak Osowilangun)</option>
                <option value="2" <?php echo (($filters['rph_id'] ?? '') == '2') ? 'selected' : ''; ?>>RPH Kedurus</option>
              </select>
            </div>

            <!-- Peran -->
            <div class="col-lg-2 col-md-3 col-sm-6 mb-2">
              <label class="small text-muted font-weight-bold text-uppercase mb-1">Peran</label>
              <select name="role" class="form-control form-control-sm">
                <option value="">-- Semua Peran --</option>
                <option value="praktikan" <?php echo (($filters['role'] ?? '') === 'praktikan') ? 'selected' : ''; ?>>Praktikan</option>
                <option value="instruktur" <?php echo (($filters['role'] ?? '') === 'instruktur') ? 'selected' : ''; ?>>Instruktur</option>
              </select>
            </div>

            <!-- Status Evaluasi -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
              <label class="small text-muted font-weight-bold text-uppercase mb-1">Status Evaluasi</label>
              <select name="evaluation_status" class="form-control form-control-sm">
                <option value="">-- Semua Status --</option>
                <option value="Lulus Praktik" <?php echo (($filters['evaluation_status'] ?? '') === 'Lulus Praktik') ? 'selected' : ''; ?>>Lulus Praktik</option>
                <option value="Dalam Pembimbingan" <?php echo (($filters['evaluation_status'] ?? '') === 'Dalam Pembimbingan') ? 'selected' : ''; ?>>Dalam Pembimbingan</option>
                <option value="Perlu Pengulangan" <?php echo (($filters['evaluation_status'] ?? '') === 'Perlu Pengulangan') ? 'selected' : ''; ?>>Perlu Pengulangan</option>
                <option value="Menunggu Evaluasi" <?php echo (($filters['evaluation_status'] ?? '') === 'Menunggu Evaluasi') ? 'selected' : ''; ?>>Menunggu Evaluasi</option>
              </select>
            </div>

            <!-- Tombol Filter -->
            <div class="col-lg-4 col-md-5 col-sm-12 mb-2 d-flex" style="gap: 6px;">
              <button type="submit" class="btn btn-success btn-sm flex-fill font-weight-bold shadow-sm">
                <i class="fas fa-filter mr-1"></i> Terapkan Filter
              </button>
              <a href="<?php echo base_url('prakteks/index'); ?>" class="btn btn-outline-secondary btn-sm px-3" title="Reset Semua Filter">
                <i class="fas fa-redo mr-1"></i> Reset
              </a>
            </div>
          </form>
        </div>

        <!-- Main Table Card with Checkbox Column -->
        <div class="card-modern">
          <div class="card-header-juleha d-flex flex-wrap align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold"><i class="fas fa-list mr-2"></i> Riwayat & Evaluasi Praktik di RPH</h5>
            <div class="mt-2 mt-sm-0">
              <a href="<?php echo base_url('prakteks/scan'); ?>" class="btn btn-light btn-sm font-weight-bold text-success mr-2">
                <i class="fas fa-plus-circle mr-1"></i> Scan Presensi KTA
              </a>
              <a href="<?php echo base_url('prakteks/rekap_anggota'); ?>" class="btn btn-outline-light btn-sm font-weight-bold">
                <i class="fas fa-chart-bar mr-1"></i> Rekap Tiap Anggota
              </a>
            </div>
          </div>
          <div class="card-body p-3">

            <!-- Checkbox notice helper -->
            <div class="d-flex align-items-center justify-content-between mb-2">
              <small class="text-muted">
                <i class="fas fa-info-circle text-info mr-1"></i> Centang kotak di sebelah kiri baris untuk memilih data yang ingin direkap (Gambar, PDF, Excel, Cetak, Copy).
              </small>
              <span id="labelCheckedCount" class="badge badge-light border text-dark font-weight-bold" style="display:none;">
                0 data terpilih
              </span>
            </div>

            <div class="table-responsive">
              <table id="tablePraktik" class="table table-hover table-striped align-middle mb-0" style="width:100%">
                <thead class="bg-light">
                  <tr>
                    <th style="width: 38px;" class="text-center">
                      <input type="checkbox" id="checkAllPraktik" class="table-checkbox" title="Centang Semua Baris">
                    </th>
                    <th style="width: 40px;" class="text-center">No</th>
                    <th>Waktu / Tanggal</th>
                    <th>Peserta / Praktikan</th>
                    <th>Peran</th>
                    <th>Lokasi RPH</th>
                    <th>Instruktur Pembimbing</th>
                    <th>Status Evaluasi</th>
                    <th>Catatan Evaluasi Instruktur</th>
                    <th style="width: 90px;" class="text-center no-export">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $hari_id = array('Sunday'=>'Minggu','Monday'=>'Senin','Tuesday'=>'Selasa','Wednesday'=>'Rabu','Thursday'=>'Kamis','Friday'=>'Jumat','Saturday'=>'Sabtu');
                  $bulan_id = array(1=>'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
                  
                  if (!empty($records)): 
                    $no = 1;
                    foreach ($records as $r): 
                      $ts = strtotime($r->praktekdate ?? 0);
                      $day_str = ($ts > 0) ? ($hari_id[date('l', $ts)] ?? '') : '-';
                      $date_str = ($ts > 0) ? (date('d', $ts) . ' ' . ($bulan_id[(int)date('m', $ts)] ?? '') . ' ' . date('Y', $ts)) : '-';
                      $time_str = ($ts > 0 && date('H:i', $ts) !== '00:00') ? (date('H:i', $ts) . ' WIB') : '';
                      
                      $member_name = trim(($r->member_firstname ?? '') . ' ' . ($r->member_lastname ?? ''));
                      if (empty($member_name)) {
                        $member_name = $r->member_nickname ?? $r->juleha_id;
                      }

                      $inst_name = trim(($r->instructor_firstname ?? '') . ' ' . ($r->instructor_lastname ?? ''));
                      if (empty($inst_name)) {
                        $inst_name = $r->instructor_nickname ?? $r->instructor_id ?? '-';
                      }

                      $eval_by_name = trim(($r->evaluator_firstname ?? '') . ' ' . ($r->evaluator_lastname ?? ''));
                      if (empty($eval_by_name)) {
                        $eval_by_name = $r->evaluator_nickname ?? $r->evaluated_by ?? '';
                      }
                      
                      $eval_status = $r->evaluation_status ?? 'Lulus Praktik';
                      $rph_display = ((int)$r->rph_id === 2) ? 'RPH Kedurus' : 'RPH TOW';
                      $role_str = (($r->role ?? '') === 'instruktur') ? 'Instruktur' : 'Praktikan';

                      $row_payload = array(
                        'no'            => $no,
                        'id'            => (int)$r->id,
                        'date_full'     => $day_str . ', ' . $date_str . ($time_str ? ' ' . $time_str : ''),
                        'member_id'     => $r->juleha_id,
                        'member_name'   => $member_name,
                        'member_region' => $r->member_region ?? '',
                        'role'          => $role_str,
                        'rph'           => $rph_display,
                        'instructor'    => $inst_name,
                        'status'        => $eval_status,
                        'description'   => $r->description ?: 'Belum ada catatan evaluasi',
                        'evaluator'     => $eval_by_name
                      );
                  ?>
                    <tr data-row-json="<?php echo htmlspecialchars(json_encode($row_payload), ENT_QUOTES, 'UTF-8'); ?>">
                      <td class="text-center">
                        <input type="checkbox" class="row-checkbox table-checkbox" value="<?php echo (int)$r->id; ?>">
                      </td>
                      <td class="text-center font-weight-bold"><?php echo $no++; ?></td>
                      <td>
                        <div class="font-weight-600 text-dark"><?php echo $day_str . ', ' . $date_str; ?></div>
                        <?php if ($time_str): ?>
                          <small class="text-muted"><i class="far fa-clock mr-1"></i><?php echo $time_str; ?></small>
                        <?php endif; ?>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <img src="/images/<?php echo htmlspecialchars($r->juleha_id); ?>.jpg" 
                               onerror="this.onerror=null;this.src='/assets/adminlte/dist/img/avatar5.png';"
                               class="member-thumb" alt="Foto">
                          <div>
                            <a href="<?php echo base_url('members/profile/' . rawurlencode($r->juleha_id)); ?>" 
                               class="font-weight-bold text-success d-block" target="_blank">
                              <?php echo htmlspecialchars($member_name); ?>
                            </a>
                            <small class="badge badge-light border font-weight-bold"><?php echo htmlspecialchars($r->juleha_id); ?></small>
                            <?php if (!empty($r->member_region)): ?>
                              <small class="text-muted ml-1">(<?php echo htmlspecialchars($r->member_region); ?>)</small>
                            <?php endif; ?>
                          </div>
                        </div>
                      </td>
                      <td>
                        <?php if ($role_str === 'Instruktur'): ?>
                          <span class="badge-role-instruktur"><i class="fas fa-chalkboard-teacher mr-1"></i> Instruktur</span>
                        <?php else: ?>
                          <span class="badge-role-praktikan"><i class="fas fa-cut mr-1"></i> Praktikan</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <span class="badge badge-light border font-weight-bold text-dark">
                          <i class="fas fa-map-marker-alt text-danger mr-1"></i> <?php echo $rph_display; ?>
                        </span>
                      </td>
                      <td>
                        <?php if (!empty($r->instructor_id) || $inst_name !== '-'): ?>
                          <span class="font-weight-600 text-dark"><?php echo htmlspecialchars($inst_name); ?></span>
                          <?php if (!empty($r->instructor_id)): ?>
                            <small class="text-muted d-block"><?php echo htmlspecialchars($r->instructor_id); ?></small>
                          <?php endif; ?>
                        <?php else: ?>
                          <span class="text-muted">-</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php if ($eval_status === 'Lulus Praktik'): ?>
                          <span class="badge-eval-pass"><i class="fas fa-check-circle mr-1"></i> Lulus Praktik</span>
                        <?php elseif ($eval_status === 'Menunggu Evaluasi'): ?>
                          <span class="badge-eval-wait"><i class="fas fa-clock mr-1"></i> Menunggu Evaluasi</span>
                        <?php else: ?>
                          <span class="badge-eval-guidance"><i class="fas fa-info-circle mr-1"></i> <?php echo htmlspecialchars($eval_status); ?></span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <div class="small text-dark font-weight-500">
                          <?php echo htmlspecialchars($r->description ?: 'Belum ada catatan evaluasi'); ?>
                        </div>
                        <?php if (!empty($eval_by_name)): ?>
                          <small class="text-muted d-block mt-1">
                            <i class="fas fa-user-edit mr-1"></i> Oleh: <strong><?php echo htmlspecialchars($eval_by_name); ?></strong>
                          </small>
                        <?php endif; ?>
                      </td>
                      <td class="text-center no-export">
                        <!-- Button Beri/Edit Catatan Evaluasi -->
                        <button type="button" class="btn btn-outline-success btn-sm rounded-circle p-1 mr-1" style="width:32px;height:32px;"
                                onclick="openModalEvaluasi(<?php echo (int)$r->id; ?>, '<?php echo htmlspecialchars($r->juleha_id); ?>', '<?php echo htmlspecialchars(addslashes($member_name)); ?>', '<?php echo htmlspecialchars(addslashes($eval_status)); ?>', '<?php echo htmlspecialchars(addslashes($r->description ?? '')); ?>')"
                                title="Beri / Edit Catatan Evaluasi Instruktur">
                          <i class="fas fa-comment-medical"></i>
                        </button>
                        <!-- Button Hapus (Admin) -->
                        <button type="button" class="btn btn-outline-danger btn-sm rounded-circle p-1" style="width:32px;height:32px;"
                                onclick="deletePraktik(<?php echo (int)$r->id; ?>, '<?php echo htmlspecialchars($r->juleha_id); ?>')" 
                                title="Hapus Data">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </section>

  </div>

  <!-- Floating Selection Action Bar -->
  <div id="selectionActionBar" class="selection-action-bar">
    <div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
      <span class="badge badge-warning py-2 px-3 font-weight-bold text-dark" style="font-size: 0.88rem; border-radius: 20px;">
        <i class="fas fa-check-square mr-1"></i> <span id="selectedCount">0</span> Baris Terpilih
      </span>
      <div class="btn-group btn-group-sm">
        <button type="button" class="btn btn-primary font-weight-bold px-3" onclick="triggerCustomExport('png')">
          <i class="fas fa-image mr-1"></i> Gambar (.PNG)
        </button>
        <button type="button" class="btn btn-danger font-weight-bold px-3" onclick="triggerCustomExport('pdf')">
          <i class="fas fa-file-pdf mr-1"></i> PDF
        </button>
        <button type="button" class="btn btn-success font-weight-bold px-3" onclick="triggerCustomExport('excel')">
          <i class="fas fa-file-excel mr-1"></i> Excel
        </button>
        <button type="button" class="btn btn-info font-weight-bold px-3" onclick="triggerCustomExport('print')">
          <i class="fas fa-print mr-1"></i> Cetak
        </button>
        <button type="button" class="btn btn-secondary font-weight-bold px-3" onclick="triggerCustomExport('copy')">
          <i class="fas fa-copy mr-1"></i> Copy
        </button>
      </div>
      <button type="button" class="btn btn-outline-light btn-sm font-weight-bold ml-2 rounded-circle" style="width:30px;height:30px;padding:0;" onclick="deselectAll()" title="Batal Centang">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>

  <!-- Hidden Container for High-Res Gambar (.PNG) Generation -->
  <div id="rekapExportSheet">
    <div class="kop-surat-box">
      <img src="/assets/juleha/logo.png" onerror="this.onerror=null;this.src='/assets/juleha.jpg';" class="kop-logo" alt="Logo Juleha">
      <div class="kop-text">
        <h2>Dewan Pengurus Wilayah Juru Sembelih Halal (JULEHA) Jawa Timur</h2>
        <h3>Rekapitulasi Presensi & Riwayat Praktik Lapangan Sembelih</h3>
        <p>Sekretariat: Surabaya, Jawa Timur | Website: members.julehajatim.com | Lokasi Resmi: RPH TOW & RPH Kedurus Surabaya</p>
      </div>
      <img src="/assets/juleha/julehajatim72.png" onerror="this.onerror=null;this.style.display='none';" class="kop-logo" alt="Logo Jatim">
    </div>

    <!-- Metadata Block -->
    <div style="background: #f1f5f9; padding: 12px 18px; border-radius: 8px; margin-bottom: 18px; border-left: 4px solid #059669; font-size: 11.5px; display: flex; justify-content: space-between; align-items: center;">
      <div>
        <strong>Waktu Cetak / Ekspor:</strong> <?php echo date('d F Y - H:i'); ?> WIB &bull; 
        <strong>Kategori / Periode:</strong> <span id="exportSheetFilterText">Semua Data</span>
      </div>
      <div>
        <strong>Total Baris Rekap:</strong> <span id="exportSheetTotalRows" class="badge badge-success px-2 py-1" style="font-size:12px;">0 Baris</span>
      </div>
    </div>

    <!-- Export Table -->
    <table class="export-table">
      <thead>
        <tr>
          <th style="width: 35px; text-align: center;">No</th>
          <th style="width: 140px;">Waktu / Tanggal</th>
          <th style="width: 180px;">Nama Anggota / ID</th>
          <th style="width: 85px;">Peran</th>
          <th style="width: 100px;">Lokasi RPH</th>
          <th style="width: 150px;">Instruktur Penguji</th>
          <th style="width: 110px;">Status Evaluasi</th>
          <th>Catatan Evaluasi Lapangan</th>
        </tr>
      </thead>
      <tbody id="exportSheetTbody">
        <!-- Injected via JavaScript -->
      </tbody>
    </table>

    <!-- Signature / Legal Footer -->
    <div class="export-footer">
      <div class="ttd-box">
        <div>Mengetahui,</div>
        <div style="font-weight: 600;">Koordinator Praktik & RPH</div>
        <div class="ttd-space"></div>
        <div style="font-weight: 700; text-decoration: underline;">MOCH. MAFTUCHIN</div>
        <div style="color: #64748b; font-size: 11px;">DPW Juleha Jawa Timur</div>
      </div>
      <div class="ttd-box">
        <div>Surabaya, <?php echo date('d F Y'); ?></div>
        <div style="font-weight: 600;">DPW Juru Sembelih Halal Jawa Timur</div>
        <div class="ttd-space"></div>
        <div style="font-weight: 700; text-decoration: underline;">PENGURUS DPW JULEHA JATIM</div>
        <div style="color: #64748b; font-size: 11px;">Sistem Absensi & Sertifikasi Terpadu</div>
      </div>
    </div>
  </div>

  <!-- Modal Khusus Instruktur: Beri / Edit Catatan Evaluasi Peserta -->
  <div class="modal fade" id="modalEvaluasi" tabindex="-1" role="dialog" aria-labelledby="modalEvaluasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; overflow: hidden; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
        <div class="modal-header text-white" style="background: linear-gradient(135deg, #064e3b 0%, #059669 100%);">
          <h5 class="modal-title font-weight-bold" id="modalEvaluasiLabel">
            <i class="fas fa-comment-dots mr-2"></i> Catatan Evaluasi Instruktur
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formEvaluasiInstruktur">
          <div class="modal-body p-4">
            <input type="hidden" name="id" id="eval_id" value="">

            <div class="p-3 bg-light rounded border mb-3">
              <div class="small text-muted font-weight-bold text-uppercase">Peserta yang Dievaluasi:</div>
              <h5 class="font-weight-bold text-success mb-1" id="eval_member_name">-</h5>
              <div class="small text-muted">ID: <strong id="eval_juleha_id">-</strong></div>
            </div>

            <div class="form-group mb-3">
              <label class="font-weight-bold text-dark small text-uppercase">Hasil Penilaian / Kelulusan <span class="text-danger">*</span></label>
              <select name="evaluation_status" id="eval_status_select" class="form-control font-weight-bold" required>
                <option value="Lulus Praktik">Lulus Praktik</option>
                <option value="Dalam Pembimbingan">Dalam Pembimbingan</option>
                <option value="Perlu Pengulangan">Perlu Pengulangan</option>
              </select>
            </div>

            <div class="form-group mb-3">
              <label class="font-weight-bold text-dark small text-uppercase">Catatan Evaluasi Sembelih <span class="text-danger">*</span></label>
              <textarea name="description" id="eval_notes" class="form-control" rows="4" 
                        placeholder="Tuliskan catatan teknis penyembelihan peserta ini (misal: teknik rebah, penarikan bilah, 3 saluran trakea/esofagus/jugular putus sempurna)..." required></textarea>
              <small class="text-muted">Catatan ini akan tersimpan permanen dan dapat dilihat oleh peserta di profilnya.</small>
            </div>

          </div>
          <div class="modal-footer bg-light border-top p-3 d-flex justify-content-between">
            <button type="button" class="btn btn-secondary btn-sm font-weight-bold px-3" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success btn-sm font-weight-bold px-4" id="btnSaveEvaluasi">
              <i class="fas fa-save mr-1"></i> Simpan Catatan Evaluasi
            </button>
          </div>
        </form>
      </div>
    </div>
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
<!-- DataTables & Plugins -->
<script src="/assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/assets/adminlte/plugins/jszip/jszip.min.js"></script>
<script src="/assets/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/assets/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="/assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- html2canvas for High-Res PNG Rekap Image Generation -->
<script src="/assets/juleha/html2canvas.min.js"></script>

<script>
let dataTableInstance = null;

$(document).ready(function() {
  dataTableInstance = $('#tablePraktik').DataTable({
    "responsive": true,
    "lengthChange": true,
    "autoWidth": false,
    "ordering": false,
    "pageLength": 25,
    "columnDefs": [
      { "targets": [0, 9], "orderable": false, "searchable": false }
    ],
    "buttons": [
      {
        text: '<i class="fas fa-image mr-1"></i> Gambar (.PNG)',
        className: 'btn-primary font-weight-bold',
        action: function (e, dt, node, config) {
          triggerCustomExport('png');
        }
      },
      {
        extend: "excel",
        text: "<i class='fas fa-file-excel mr-1'></i> Excel",
        className: 'btn-success font-weight-bold',
        title: "Rekapitulasi_Praktik_Sembelih_Juleha_Jatim",
        exportOptions: {
          columns: [1, 2, 3, 4, 5, 6, 7, 8],
          rows: function(idx, data, node) {
            const checked = $('.row-checkbox:checked');
            return checked.length > 0 ? $(node).find('.row-checkbox').is(':checked') : true;
          },
          format: {
            body: function(data, row, column, node) {
              return $(node).clone().find('button, img, script, style').remove().end().text().replace(/\s+/g, ' ').trim();
            }
          }
        }
      },
      {
        extend: "pdf",
        text: "<i class='fas fa-file-pdf mr-1'></i> PDF",
        className: 'btn-danger font-weight-bold',
        orientation: 'landscape',
        pageSize: 'A4',
        title: "DPW JULEHA JAWA TIMUR - REKAPITULASI PRAKTIK LAPANGAN SEMBELIH",
        exportOptions: {
          columns: [1, 2, 3, 4, 5, 6, 7, 8],
          rows: function(idx, data, node) {
            const checked = $('.row-checkbox:checked');
            return checked.length > 0 ? $(node).find('.row-checkbox').is(':checked') : true;
          },
          format: {
            body: function(data, row, column, node) {
              return $(node).clone().find('button, img, script, style').remove().end().text().replace(/\s+/g, ' ').trim();
            }
          }
        },
        customize: function(doc) {
          doc.defaultStyle.fontSize = 8.5;
          doc.styles.tableHeader.fontSize = 9;
          doc.styles.tableHeader.fillColor = '#064e3b';
          doc.styles.tableHeader.color = '#ffffff';
          doc.styles.tableHeader.alignment = 'center';
          doc.content[1].table.widths = ['4%', '15%', '18%', '10%', '11%', '15%', '12%', '15%'];
          doc.content.unshift({
            text: 'DEWAN PENGURUS WILAYAH JURU SEMBELIH HALAL (JULEHA) JAWA TIMUR\nRekapitulasi Presensi & Praktik Sembelih Resmi RPH TOW & RPH Kedurus\nWebsite: members.julehajatim.com\n',
            alignment: 'center',
            fontSize: 11,
            bold: true,
            color: '#064e3b',
            margin: [0, 0, 0, 10]
          });
        }
      },
      {
        extend: "print",
        text: "<i class='fas fa-print mr-1'></i> Cetak",
        className: 'btn-info font-weight-bold',
        title: "Rekapitulasi Presensi & Praktik Sembelih - Juleha Jawa Timur",
        exportOptions: {
          columns: [1, 2, 3, 4, 5, 6, 7, 8],
          rows: function(idx, data, node) {
            const checked = $('.row-checkbox:checked');
            return checked.length > 0 ? $(node).find('.row-checkbox').is(':checked') : true;
          },
          format: {
            body: function(data, row, column, node) {
              return $(node).clone().find('button, img, script, style').remove().end().text().replace(/\s+/g, ' ').trim();
            }
          }
        }
      },
      {
        extend: "copy",
        text: "<i class='fas fa-copy mr-1'></i> Copy",
        className: 'btn-secondary font-weight-bold',
        exportOptions: {
          columns: [1, 2, 3, 4, 5, 6, 7, 8],
          rows: function(idx, data, node) {
            const checked = $('.row-checkbox:checked');
            return checked.length > 0 ? $(node).find('.row-checkbox').is(':checked') : true;
          },
          format: {
            body: function(data, row, column, node) {
              return $(node).clone().find('button, img, script, style').remove().end().text().replace(/\s+/g, ' ').trim();
            }
          }
        }
      }
    ]
  });

  dataTableInstance.buttons().container().appendTo('#tablePraktik_wrapper .col-md-6:eq(0)');

  // Handle Check All checkbox
  $('#checkAllPraktik').on('change', function() {
    const isChecked = $(this).is(':checked');
    $('.row-checkbox').prop('checked', isChecked);
    updateSelectionBar();
  });

  // Handle Individual Row Checkbox
  $(document).on('change', '.row-checkbox', function() {
    const totalRows = $('.row-checkbox').length;
    const checkedRows = $('.row-checkbox:checked').length;
    $('#checkAllPraktik').prop('checked', totalRows > 0 && totalRows === checkedRows);
    updateSelectionBar();
  });
});

function updateSelectionBar() {
  const count = $('.row-checkbox:checked').length;
  $('#selectedCount').text(count);
  if (count > 0) {
    $('#selectionActionBar').css('display', 'flex').hide().fadeIn(200);
    $('#labelCheckedCount').text(count + ' baris dicentang').show();
  } else {
    $('#selectionActionBar').fadeOut(200);
    $('#labelCheckedCount').hide();
  }
}

function deselectAll() {
  $('.row-checkbox, #checkAllPraktik').prop('checked', false);
  updateSelectionBar();
}

/**
 * Ambil data baris yang terpilih (jika ada centang), atau seluruh baris di tabel (jika tidak ada centang)
 */
function getSelectedOrAllRowsData() {
  const selectedChecked = $('.row-checkbox:checked');
  const rows = [];

  if (selectedChecked.length > 0) {
    selectedChecked.each(function() {
      const tr = $(this).closest('tr');
      const jsonStr = tr.attr('data-row-json');
      if (jsonStr) {
        try {
          rows.push(JSON.parse(jsonStr));
        } catch(e) {}
      }
    });
  } else {
    // Ambil semua baris yang terlihat di tabel
    $('#tablePraktik tbody tr').each(function() {
      const tr = $(this);
      const jsonStr = tr.attr('data-row-json');
      if (jsonStr) {
        try {
          rows.push(JSON.parse(jsonStr));
        } catch(e) {}
      }
    });
  }
  return rows;
}

/**
 * Universal Trigger untuk Export (Gambar .PNG, PDF, Excel, Print, Copy)
 */
function triggerCustomExport(format) {
  const rows = getSelectedOrAllRowsData();
  if (!rows || rows.length === 0) {
    alert('Tidak ada data praktik yang dapat direkap.');
    return;
  }

  if (format === 'png') {
    exportToPng(rows);
  } else if (format === 'excel') {
    exportToExcelCsv(rows);
  } else if (format === 'copy') {
    exportToCopy(rows);
  } else if (format === 'print') {
    exportToPrint(rows);
  } else if (format === 'pdf') {
    // Trigger DataTables PDF button yang sudah terkonfigurasi landscape
    dataTableInstance.button('.buttons-pdf').trigger();
  }
}

/**
 * Export ke Gambar (.PNG) Berkualitas Tinggi menggunakan html2canvas
 */
function exportToPng(rows) {
  const $tbody = $('#exportSheetTbody');
  $tbody.empty();

  // Susun baris HTML
  rows.forEach(function(item, index) {
    const tr = `
      <tr>
        <td style="text-align: center; font-weight: bold;">${index + 1}</td>
        <td>
          <div style="font-weight: 600;">${item.date_full}</div>
        </td>
        <td>
          <div style="font-weight: 700; color: #064e3b;">${item.member_name}</div>
          <small style="color: #64748b; font-weight: 600;">ID: ${item.member_id} ${item.member_region ? '(' + item.member_region + ')' : ''}</small>
        </td>
        <td>
          <span style="font-weight: 600; color: ${item.role === 'Instruktur' ? '#1d4ed8' : '#15803d'};">
            ${item.role}
          </span>
        </td>
        <td>
          <strong>${item.rph}</strong>
        </td>
        <td>
          <div style="font-weight: 600;">${item.instructor || '-'}</div>
        </td>
        <td>
          <span style="font-weight: 600; color: ${item.status === 'Lulus Praktik' ? '#166534' : '#854d0e'};">
            ${item.status}
          </span>
        </td>
        <td>
          <div style="font-size: 11px;">${item.description}</div>
          ${item.evaluator ? `<small style="color: #64748b; display: block; margin-top: 3px;">Oleh: <strong>${item.evaluator}</strong></small>` : ''}
        </td>
      </tr>
    `;
    $tbody.append(tr);
  });

  $('#exportSheetTotalRows').text(rows.length + ' Sesi Praktik');
  
  // Set keterangan filter
  const urlParams = new URLSearchParams(window.location.search);
  let filterDesc = 'Semua Sesi Praktik';
  if (urlParams.get('period') === 'today') filterDesc = 'Hari Ini (' + new Date().toLocaleDateString('id-ID') + ')';
  else if (urlParams.get('period') === 'this_month') filterDesc = 'Bulan Ini (' + new Date().toLocaleDateString('id-ID', { month: 'long', year: 'numeric' }) + ')';
  else if (urlParams.get('period') === 'this_year') filterDesc = 'Tahun Ini (' + new Date().getFullYear() + ')';
  else if (urlParams.get('date')) filterDesc = 'Tanggal ' + urlParams.get('date');
  
  const checked = $('.row-checkbox:checked').length;
  if (checked > 0) {
    filterDesc += ' (' + checked + ' Baris Pilihan Admin)';
  }
  $('#exportSheetFilterText').text(filterDesc);

  const element = document.getElementById('rekapExportSheet');

  // Loading indicator on floating bar if open
  const origBtnText = $('#selectionActionBar .btn-primary').html();
  $('#selectionActionBar .btn-primary').html('<i class="fas fa-spinner fa-spin mr-1"></i> Merender...');

  html2canvas(element, {
    scale: 2,
    useCORS: true,
    backgroundColor: '#ffffff'
  }).then(function(canvas) {
    $('#selectionActionBar .btn-primary').html(origBtnText);
    const link = document.createElement('a');
    link.download = 'Rekap_Praktik_Juleha_Jatim_' + Date.now() + '.png';
    link.href = canvas.toDataURL('image/png');
    link.click();
  }).catch(function(err) {
    $('#selectionActionBar .btn-primary').html(origBtnText);
    alert('Terjadi kesalahan saat membuat gambar: ' + err);
  });
}

/**
 * Export ke Excel (.CSV dengan BOM UTF-8 yang otomatis rapi di Excel)
 */
function exportToExcelCsv(rows) {
  let csvContent = '\uFEFF'; // UTF-8 BOM
  csvContent += '"No","Waktu / Tanggal","ID Anggota","Nama Anggota","Wilayah","Peran","Lokasi RPH","Instruktur Pembimbing","Status Kelulusan","Catatan Evaluasi Instruktur","Dinilai Oleh"\r\n';

  rows.forEach(function(r, idx) {
    const rowData = [
      idx + 1,
      r.date_full,
      r.member_id,
      r.member_name,
      r.member_region || '',
      r.role,
      r.rph,
      r.instructor,
      r.status,
      r.description.replace(/"/g, '""'),
      r.evaluator
    ];
    csvContent += rowData.map(val => `"${val}"`).join(',') + '\r\n';
  });

  const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
  const url = URL.createObjectURL(blob);
  const link = document.createElement('a');
  link.setAttribute('href', url);
  link.setAttribute('download', 'Rekap_Praktik_Juleha_Jatim_' + Date.now() + '.csv');
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

/**
 * Salin Rangkuman Teks Format WhatsApp
 */
function exportToCopy(rows) {
  let text = '*REKAPITULASI PRESENSI & PRAKTIK LAPANGAN JULEHA JATIM*\n';
  text += 'Lokasi: RPH TOW & RPH Kedurus Jawa Timur\n';
  text += 'Waktu Rekap: ' + new Date().toLocaleString('id-ID') + '\n';
  text += 'Total Data: ' + rows.length + ' Sesi Praktik\n\n';

  rows.forEach(function(r, idx) {
    text += (idx + 1) + '. *' + r.member_name + '* (' + r.member_id + ')\n';
    text += '   • Waktu: ' + r.date_full + '\n';
    text += '   • Lokasi: ' + r.rph + ' | Peran: ' + r.role + '\n';
    text += '   • Instruktur: ' + r.instructor + '\n';
    text += '   • Status: ' + r.status + '\n';
    text += '   • Catatan: ' + r.description + '\n\n';
  });

  text += 'DPW Juru Sembelih Halal (Juleha) Jawa Timur\nhttps://members.julehajatim.com';

  if (navigator.clipboard) {
    navigator.clipboard.writeText(text).then(function() {
      alert('Berhasil menyalin ' + rows.length + ' data rekap praktik ke clipboard (siap kirim WhatsApp)!');
    });
  } else {
    const tempInput = $('<textarea>');
    $('body').append(tempInput);
    tempInput.val(text).select();
    document.execCommand('copy');
    tempInput.remove();
    alert('Berhasil menyalin data rekap praktik ke clipboard!');
  }
}

/**
 * Print / Cetak Langsung
 */
function exportToPrint(rows) {
  // Buka jendela baru dengan template cetak kop resmi
  const printWindow = window.open('', '', 'width=950,height=700');
  let tableRowsHtml = '';
  rows.forEach(function(r, idx) {
    tableRowsHtml += `
      <tr>
        <td style="text-align: center;">${idx + 1}</td>
        <td>${r.date_full}</td>
        <td><strong>${r.member_name}</strong><br><small style="color: #64748b;">${r.member_id} ${r.member_region ? '('+r.member_region+')' : ''}</small></td>
        <td>${r.role}</td>
        <td>${r.rph}</td>
        <td>${r.instructor}</td>
        <td><strong>${r.status}</strong></td>
        <td>${r.description}</td>
      </tr>
    `;
  });

  const printHtml = `
    <!DOCTYPE html>
    <html>
    <head>
      <title>Cetak Rekapitulasi Praktik Juleha Jatim</title>
      <style>
        body { font-family: 'Poppins', Arial, sans-serif; padding: 25px; color: #1e293b; }
        .kop { border-bottom: 2px solid #064e3b; padding-bottom: 12px; margin-bottom: 20px; text-align: center; }
        .kop h2 { margin: 0; color: #064e3b; font-size: 16px; text-transform: uppercase; }
        .kop h3 { margin: 4px 0; font-size: 14px; }
        .kop p { margin: 0; font-size: 11px; color: #64748b; }
        table { width: 100%; border-collapse: collapse; font-size: 11px; margin-top: 15px; }
        th { background: #064e3b; color: white; padding: 8px 6px; border: 1px solid #064e3b; }
        td { padding: 6px 8px; border: 1px solid #cbd5e1; }
        tr:nth-child(even) td { background: #f8fafc; }
        .ttd-box { margin-top: 40px; display: flex; justify-content: space-between; font-size: 12px; }
        @media print {
          button { display: none; }
        }
      </style>
    </head>
    <body>
      <div class="kop">
        <h2>Dewan Pengurus Wilayah Juru Sembelih Halal (Juleha) Jawa Timur</h2>
        <h3>Rekapitulasi Presensi & Praktik Sembelih Resmi di RPH TOW & RPH Kedurus</h3>
        <p>Sekretariat: Surabaya, Jawa Timur | Website: members.julehajatim.com</p>
      </div>
      <div style="font-size: 11px; margin-bottom: 10px;">
        <strong>Total Baris:</strong> ${rows.length} Sesi &bull; <strong>Dicetak Pada:</strong> ${new Date().toLocaleString('id-ID')}
      </div>
      <table>
        <thead>
          <tr>
            <th style="width: 30px;">No</th>
            <th>Waktu/Tanggal</th>
            <th>Anggota/ID</th>
            <th>Peran</th>
            <th>RPH</th>
            <th>Instruktur</th>
            <th>Status</th>
            <th>Catatan Evaluasi</th>
          </tr>
        </thead>
        <tbody>
          ${tableRowsHtml}
        </tbody>
      </table>
      <div class="ttd-box">
        <div style="text-align: center;">
          <div>Mengetahui,</div>
          <div>Koordinator RPH</div>
          <div style="height: 60px;"></div>
          <div><strong>Moch. Maftuchin</strong></div>
        </div>
        <div style="text-align: center;">
          <div>Surabaya, ${new Date().toLocaleDateString('id-ID')}</div>
          <div>DPW Juleha Jawa Timur</div>
          <div style="height: 60px;"></div>
          <div><strong>Pengurus DPW</strong></div>
        </div>
      </div>
      <script>
        window.onload = function() {
          window.print();
        };
      <\/script>
    </body>
    </html>
  `;

  printWindow.document.open();
  printWindow.document.write(printHtml);
  printWindow.document.close();
}

function openModalEvaluasi(id, julehaId, memberName, status, notes) {
  $('#eval_id').val(id);
  $('#eval_juleha_id').text(julehaId);
  $('#eval_member_name').text(memberName);
  $('#eval_status_select').val(status || 'Lulus Praktik');
  $('#eval_notes').val(notes || '');
  $('#modalEvaluasi').modal('show');
}

$('#formEvaluasiInstruktur').on('submit', function(e) {
  e.preventDefault();
  const $btn = $('#btnSaveEvaluasi');
  $btn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...').prop('disabled', true);

  $.ajax({
    url: '/prakteks/save_evaluation_ajax',
    type: 'POST',
    data: $(this).serialize(),
    dataType: 'json',
    success: function(resp) {
      $btn.html('<i class="fas fa-save mr-1"></i> Simpan Catatan Evaluasi').prop('disabled', false);
      if (resp.status) {
        alert(resp.message);
        $('#modalEvaluasi').modal('hide');
        window.location.reload();
      } else {
        alert(resp.message || 'Gagal menyimpan evaluasi.');
      }
    },
    error: function() {
      $btn.html('<i class="fas fa-save mr-1"></i> Simpan Catatan Evaluasi').prop('disabled', false);
      alert('Terjadi kesalahan jaringan.');
    }
  });
});

function deletePraktik(id, julehaId) {
  if (confirm('Yakin ingin menghapus data presensi praktik untuk anggota ID ' + julehaId + '?')) {
    $.ajax({
      url: '/prakteks/delete_ajax',
      type: 'POST',
      data: { id: id },
      dataType: 'json',
      success: function(resp) {
        if (resp.status) {
          alert(resp.message);
          window.location.reload();
        } else {
          alert(resp.message || 'Gagal menghapus data.');
        }
      },
      error: function() {
        alert('Terjadi kesalahan jaringan.');
      }
    });
  }
}
</script>

</body>
</html>
