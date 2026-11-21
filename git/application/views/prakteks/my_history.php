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
      margin-bottom: 20px;
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
      min-width: 110px;
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
    .session-checkbox {
      width: 20px;
      height: 20px;
      cursor: pointer;
      accent-color: #059669;
    }

    /* Template Gambar / Sertifikat Rekap Mandiri Anggota (Hidden from normal screen view) */
    #memberCertificateSheet {
      position: absolute;
      left: -9999px;
      top: -9999px;
      width: 1050px;
      background: #ffffff;
      color: #0f172a;
      padding: 40px;
      font-family: 'Poppins', Arial, sans-serif;
      box-sizing: border-box;
    }
    .cert-header {
      border-bottom: 3px double #064e3b;
      padding-bottom: 15px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .cert-logo {
      width: 80px;
      height: auto;
    }
    .cert-title-box {
      text-align: center;
      flex-grow: 1;
      padding: 0 15px;
    }
    .cert-title-box h2 {
      font-size: 18px;
      font-weight: 700;
      color: #064e3b;
      margin: 0;
      text-transform: uppercase;
    }
    .cert-title-box h3 {
      font-size: 15px;
      font-weight: 600;
      color: #0f172a;
      margin: 4px 0;
    }
    .cert-title-box p {
      font-size: 11px;
      color: #64748b;
      margin: 0;
    }
    .member-info-card {
      background: linear-gradient(135deg, #f0fdf4 0%, #e6f7ef 100%);
      border: 1.5px solid #86efac;
      border-radius: 12px;
      padding: 16px 20px;
      margin-bottom: 22px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .member-info-left {
      display: flex;
      align-items: center;
      gap: 16px;
    }
    .cert-avatar {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      border: 3px solid #059669;
      object-fit: cover;
    }
    .cert-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 11.5px;
      margin-top: 15px;
    }
    .cert-table th {
      background: #064e3b;
      color: #ffffff;
      padding: 9px 8px;
      text-align: left;
      font-weight: 600;
      border: 1px solid #064e3b;
    }
    .cert-table td {
      padding: 8px;
      border: 1px solid #cbd5e1;
      vertical-align: middle;
    }
    .cert-table tr:nth-child(even) td {
      background-color: #f8fafc;
    }
    .cert-footer {
      margin-top: 35px;
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      font-size: 12px;
    }
    .cert-ttd {
      text-align: center;
      width: 250px;
    }
    .cert-ttd-space {
      height: 65px;
    }

    /* Mobile Responsive Rules (All Screen Sizes) */
    @media (max-width: 768px) {
      .main-header .navbar-nav.ml-auto {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 4px;
      }
      .main-header .navbar-nav.ml-auto .nav-item {
        margin: 0 !important;
      }
      .main-header .navbar-nav.ml-auto .btn {
        font-size: 0.74rem !important;
        padding: 5px 8px !important;
        border-radius: 8px !important;
        white-space: nowrap;
      }
      .content-header h1 {
        font-size: 1.25rem !important;
      }
      .content-header p {
        font-size: 0.78rem !important;
      }
      .card-header-juleha {
        padding: 12px 14px !important;
      }
      .card-header-juleha h5 {
        font-size: 0.98rem !important;
        width: 100%;
        margin-bottom: 8px !important;
      }
      .card-header-juleha .btn {
        font-size: 0.75rem !important;
        padding: 4px 8px !important;
      }
      .profile-hero {
        padding: 16px 14px !important;
        border-radius: 14px;
      }
      .hero-avatar {
        width: 60px !important;
        height: 60px !important;
        border-width: 2px !important;
      }
      .profile-hero h3 {
        font-size: 1.15rem !important;
      }
      .profile-hero .stat-pill-container {
        display: flex !important;
        width: 100% !important;
        gap: 6px !important;
        margin-top: 10px;
      }
      .stat-pill {
        flex: 1 1 0 !important;
        min-width: 0 !important;
        padding: 8px 4px !important;
        border-radius: 10px !important;
      }
      .stat-pill-val {
        font-size: 1.15rem !important;
      }
      .stat-pill-lbl {
        font-size: 0.65rem !important;
        letter-spacing: 0px !important;
      }
      .export-member-grid {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 6px !important;
        width: 100% !important;
        margin-top: 8px !important;
      }
      .export-member-grid .btn {
        width: 100% !important;
        font-size: 0.72rem !important;
        padding: 7px 4px !important;
      }
      .entry-card {
        padding: 14px 12px !important;
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
        <a href="<?php echo base_url('members/profile'); ?>" class="nav-link font-weight-500">Profil Anggota</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('prakteks/my_history'); ?>" class="nav-link font-weight-500 active text-success font-weight-bold">Riwayat Praktik</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="<?php echo base_url('prakteks/scan'); ?>" class="btn btn-success btn-sm rounded shadow-sm font-weight-bold px-2 px-sm-3 mr-1 mr-sm-2">
          <i class="fas fa-qrcode mr-1"></i> <span class="d-none d-sm-inline">Scan Presensi KTA</span><span class="d-inline d-sm-none">Scan</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('members/logout'); ?>" class="btn btn-outline-danger btn-sm rounded shadow-sm font-weight-bold px-2 px-sm-3">
          <i class="fas fa-sign-out-alt mr-1"></i> <span class="d-none d-sm-inline">Keluar</span><span class="d-inline d-sm-none">Keluar</span>
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
          $sessions = $practice_info['all'] ?? array();
          $total_session_count = count($sessions);
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
            <div class="col-md-5 d-flex justify-content-md-end justify-content-start stat-pill-container" style="gap: 12px;">
              <div class="stat-pill">
                <div class="stat-pill-val"><?php echo (int)($practice_info['count_praktikan'] ?? 0); ?></div>
                <div class="stat-lbl">Praktikan</div>
              </div>
              <div class="stat-pill">
                <div class="stat-pill-val"><?php echo (int)($practice_info['count_instruktur'] ?? 0); ?></div>
                <div class="stat-lbl">Instruktur</div>
              </div>
              <div class="stat-pill">
                <div class="stat-pill-val"><?php echo (int)($practice_info['total_count'] ?? 0); ?></div>
                <div class="stat-lbl">Total Sesi</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Download & Rekap Toolbar Mandiri -->
        <div class="card-modern p-3 mb-4 bg-white border">
          <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px;">
            <div>
              <h6 class="font-weight-bold text-success mb-1">
                <i class="fas fa-download mr-1"></i> Unduh & Rekap Riwayat Praktik Mandiri
              </h6>
              <small class="text-muted">Unduh rekap jam terbang resmi Anda dalam berbagai format (Gambar, PDF, Excel, Cetak, Copy)</small>
            </div>
            
            <div class="w-100 d-md-none mb-1"></div>

            <div class="d-flex flex-wrap align-items-center justify-content-between w-100-mobile" style="gap: 8px;">
              <div class="custom-control custom-checkbox mr-2">
                <input type="checkbox" class="custom-control-input" id="checkAllHistory" checked>
                <label class="custom-control-label font-weight-bold small text-dark" for="checkAllHistory">
                  Centang Semua (<span id="countSelectedBadge"><?php echo $total_session_count; ?></span>)
                </label>
              </div>

              <div class="export-member-grid d-flex flex-wrap align-items-center" style="gap: 6px;">
                <button type="button" class="btn btn-primary btn-sm rounded shadow-sm font-weight-bold px-2 px-sm-3" onclick="exportMemberRekap('png')" title="Unduh gambar kartu rekap resmi format PNG">
                  <i class="fas fa-image mr-1"></i> <span class="d-none d-sm-inline">Gambar (.PNG)</span><span class="d-inline d-sm-none">Gambar</span>
                </button>
                <button type="button" class="btn btn-danger btn-sm rounded shadow-sm font-weight-bold px-2 px-sm-3" onclick="exportMemberRekap('pdf')" title="Unduh dokumen resmi PDF">
                  <i class="fas fa-file-pdf mr-1"></i> PDF
                </button>
                <button type="button" class="btn btn-success btn-sm rounded shadow-sm font-weight-bold px-2 px-sm-3" onclick="exportMemberRekap('excel')" title="Unduh data tabel Excel/CSV">
                  <i class="fas fa-file-excel mr-1"></i> Excel
                </button>
                <button type="button" class="btn btn-info btn-sm rounded shadow-sm font-weight-bold px-2 px-sm-3" onclick="exportMemberRekap('print')" title="Cetak langsung lembar riwayat praktik">
                  <i class="fas fa-print mr-1"></i> Cetak
                </button>
                <button type="button" class="btn btn-secondary btn-sm rounded shadow-sm font-weight-bold px-2 px-sm-3" onclick="exportMemberRekap('copy')" title="Salin rangkuman teks rapi untuk WhatsApp">
                  <i class="fas fa-copy mr-1"></i> <span class="d-none d-sm-inline">Salin (WA)</span><span class="d-inline d-sm-none">Salin</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Practice Logs Card -->
        <div class="card-modern">
          <div class="card-header-juleha d-flex flex-wrap align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold"><i class="fas fa-clipboard-list mr-2"></i> Daftar Riwayat Praktik Lengkap</h5>
            <div class="mt-2 mt-sm-0">
              <a href="<?php echo base_url('prakteks/scan'); ?>" class="btn btn-light btn-sm font-weight-bold text-success mr-1 mr-sm-2">
                <i class="fas fa-qrcode mr-1"></i> <span class="d-none d-sm-inline">Scan Presensi KTA</span><span class="d-inline d-sm-none">Scan</span>
              </a>
              <a href="<?php echo base_url('members/profile'); ?>" class="btn btn-outline-light btn-sm font-weight-bold">
                <i class="fas fa-id-card mr-1"></i> <span class="d-none d-sm-inline">Kembali ke Profil</span><span class="d-inline d-sm-none">Profil</span>
              </a>
            </div>
          </div>
          <div class="card-body p-4">

            <?php 
              $hari_id = array('Sunday'=>'Minggu','Monday'=>'Senin','Tuesday'=>'Selasa','Wednesday'=>'Rabu','Thursday'=>'Kamis','Friday'=>'Jumat','Saturday'=>'Sabtu');
              $bulan_id = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
            ?>

            <?php if (!empty($sessions)): ?>
              <div class="timeline-container">
                <?php 
                $seq = 1;
                foreach($sessions as $s): 
                  $ts = strtotime($s->praktekdate ?? 0);
                  $day_str = ($ts > 0) ? ($hari_id[date('l', $ts)] ?? '') : '-';
                  $date_str = ($ts > 0) ? (date('d', $ts) . ' ' . ($bulan_id[(int)date('m', $ts)] ?? '') . ' ' . date('Y', $ts)) : '-';
                  $time_str = ($ts > 0 && date('H:i', $ts) !== '00:00') ? (date('H:i', $ts) . ' WIB') : '';
                  $is_inst = (($s->role ?? '') === 'instruktur' || ($s->instructor_id ?? '') === $juleha_id);

                  if ($is_inst) {
                    $partner_full = trim(($s->member_firstname ?? '') . ' ' . ($s->member_lastname ?? ''));
                    $partner_name = !empty($partner_full) ? $partner_full : ($s->member_nickname ?? $s->juleha_id ?? 'Anggota Juleha');
                    $partner_role_lbl = 'Peserta / Praktikan';
                  } else {
                    $partner_full = trim(($s->instructor_firstname ?? '') . ' ' . ($s->instructor_lastname ?? ''));
                    $partner_name = !empty($partner_full) ? $partner_full : ($s->instructor_nickname ?? $s->instructor_id ?? '-');
                    $partner_role_lbl = 'Instruktur Pembimbing';
                  }

                  $eval_by_name = trim(($s->evaluator_firstname ?? '') . ' ' . ($s->evaluator_lastname ?? ''));
                  if (empty($eval_by_name)) {
                    $eval_by_name = $s->evaluator_nickname ?? $s->evaluated_by ?? '';
                  }

                  $rph_label = ((int)($s->rph_id ?? 1) === 2) ? 'RPH Kedurus' : 'RPH TOW (Tambak Osowilangun)';
                  $ev_st = $s->evaluation_status ?? 'Lulus Praktik';
                  $animal = $s->animal_type ?? 'Sapi';
                  $notes = $s->description ?: 'Belum ada catatan evaluasi tertulis dari Instruktur.';

                  $card_payload = array(
                    'no'           => $seq++,
                    'id'           => (int)$s->id,
                    'date_full'    => $day_str . ', ' . $date_str . ($time_str ? ' ' . $time_str : ''),
                    'rph'          => $rph_label,
                    'animal'       => $animal,
                    'role'         => $is_inst ? 'Instruktur' : 'Praktikan',
                    'partner_lbl'  => $partner_role_lbl,
                    'partner_name' => $partner_name,
                    'status'       => $ev_st,
                    'notes'        => $notes,
                    'evaluator'    => $eval_by_name
                  );
                ?>
                  <div class="entry-card session-item" data-session-json="<?php echo htmlspecialchars(json_encode($card_payload), ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
                      <div class="d-flex align-items-center">
                        <input type="checkbox" class="session-checkbox mr-2" value="<?php echo (int)$s->id; ?>" checked title="Centang untuk menyertakan dalam rekap">
                        <div class="badge-date-pill">
                          <i class="far fa-calendar-check"></i>
                          <strong><?php echo $day_str . ', ' . $date_str; ?></strong>
                          <?php if ($time_str): ?>
                            <span class="text-muted ml-1">&bull; <?php echo $time_str; ?></span>
                          <?php endif; ?>
                        </div>
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
                          <i class="fas fa-map-marker-alt text-danger mr-1"></i> <?php echo $rph_label; ?>
                        </h6>
                      </div>
                      <div class="col-md-3 col-6 mb-2 mb-md-0">
                        <div class="text-muted small text-uppercase font-weight-500 mb-1">Objek Sembelihan</div>
                        <span class="badge badge-light border text-dark font-weight-bold px-2 py-1">
                          <i class="fas fa-tag text-success mr-1"></i> <?php echo htmlspecialchars($animal); ?>
                        </span>
                      </div>
                      <div class="col-md-3 col-6 mb-2 mb-md-0">
                        <div class="text-muted small text-uppercase font-weight-500 mb-1">
                          <?php echo $partner_role_lbl; ?>
                        </div>
                        <span class="font-weight-600 text-dark">
                          <?php echo htmlspecialchars($partner_name); ?>
                        </span>
                      </div>
                      <div class="col-md-2 mb-2 mb-md-0">
                        <div class="text-muted small text-uppercase font-weight-500 mb-1">Status Evaluasi</div>
                        <?php 
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
                      <?php if (!empty($eval_by_name)): ?>
                        <small class="text-muted d-block mt-1">
                          <i class="fas fa-user-check text-success mr-1"></i> Dinilai oleh Instruktur: <strong><?php echo htmlspecialchars($eval_by_name); ?></strong>
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

  <!-- Hidden Container for Member Official Practice Certificate / Log Graphic (.PNG) -->
  <div id="memberCertificateSheet">
    <!-- Kop Surat Resmi Juleha Jatim -->
    <div class="cert-header">
      <img src="/assets/juleha/logo.png" onerror="this.onerror=null;this.src='/assets/juleha.jpg';" class="cert-logo" alt="Logo Juleha">
      <div class="cert-title-box">
        <h2>Juru Sembelih Halal (Juleha) Jawa Timur</h2>
        <h3>Lembar Rekapitulasi Jam Terbang Praktik Sembelih Halal</h3>
        <p>Sekretariat: Surabaya, Jawa Timur | Website: members.julehajatim.com | Lokasi Resmi: RPH TOW & RPH Kedurus</p>
      </div>
      <img src="/assets/juleha/julehajatim72.png" onerror="this.onerror=null;this.style.display='none';" class="cert-logo" alt="Logo Jatim">
    </div>

    <!-- Member Identity Block -->
    <div class="member-info-card">
      <div class="member-info-left">
        <img src="/images/<?php echo htmlspecialchars($juleha_id); ?>.jpg" 
             onerror="this.onerror=null;this.src='/assets/adminlte/dist/img/avatar5.png';"
             class="cert-avatar" alt="Foto Profil">
        <div>
          <h4 style="font-size: 17px; font-weight: 700; color: #064e3b; margin: 0 0 3px 0;">
            <?php echo htmlspecialchars($display_name); ?>
          </h4>
          <div style="font-size: 12px; color: #1e293b; font-weight: 600;">
            Nomor KTA / ID: <span style="background: #ffffff; padding: 2px 8px; border-radius: 4px; border: 1px solid #86efac; color: #064e3b; font-weight: 700;"><?php echo htmlspecialchars($juleha_id); ?></span>
            &bull; Wilayah: <strong><?php echo htmlspecialchars($member->region ?? 'Jatim'); ?></strong>
          </div>
          <div style="font-size: 11px; color: #059669; margin-top: 3px; font-weight: 600;">
            <i class="fas fa-check-circle"></i> Anggota Resmi Terdaftar Juleha Jawa Timur
          </div>
        </div>
      </div>
      <div style="text-align: right;">
        <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase;">Total Jam Terbang</div>
        <div style="font-size: 22px; font-weight: 800; color: #064e3b;" id="certTotalSessions">
          <?php echo (int)($practice_info['total_count'] ?? 0); ?> Sesi
        </div>
        <div style="font-size: 11px; color: #64748b;">
          (<?php echo (int)($practice_info['count_praktikan'] ?? 0); ?> Praktikan &bull; <?php echo (int)($practice_info['count_instruktur'] ?? 0); ?> Instruktur)
        </div>
      </div>
    </div>

    <!-- Table of Sessions -->
    <table class="cert-table">
      <thead>
        <tr>
          <th style="width: 35px; text-align: center;">No</th>
          <th style="width: 140px;">Waktu & Tanggal</th>
          <th style="width: 130px;">Lokasi RPH</th>
          <th style="width: 80px;">Hewan</th>
          <th style="width: 85px;">Peran</th>
          <th style="width: 140px;">Instruktur / Penguji</th>
          <th style="width: 100px;">Hasil Evaluasi</th>
          <th>Catatan Evaluasi Instruktur</th>
        </tr>
      </thead>
      <tbody id="certTableTbody">
        <!-- Injected via JavaScript -->
      </tbody>
    </table>

    <!-- Signature and Legal Verification -->
    <div class="cert-footer">
      <div class="cert-ttd">
        <div style="font-size: 11px; color: #64748b;">Catatan Verifikasi:</div>
        <div style="font-size: 10.5px; color: #059669; font-weight: 600; border: 1px dashed #059669; padding: 6px; border-radius: 6px; margin-top: 4px;">
          Dokumen sah tercatat dalam basis data resmi Sistem Manajemen Keanggotaan & Absensi Terpadu Juleha Jatim.
        </div>
      </div>
      <div class="cert-ttd">
        <div>Surabaya, <?php echo date('d F Y'); ?></div>
        <div style="font-weight: 600; font-size: 12px;">Juru Sembelih Halal (Juleha) Jawa Timur</div>
        <div class="cert-ttd-space"></div>
        <div style="font-weight: 700; text-decoration: underline; font-size: 12.5px;">MOCH. MAFTUCHIN</div>
        <div style="color: #64748b; font-size: 11px;">Koordinator Pembimbingan & Praktik RPH</div>
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
<script src="/assets/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/assets/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- html2canvas for High-Res PNG Rekap Image Generation -->
<script src="/assets/juleha/html2canvas.min.js"></script>

<script>
const memberJulehaId = '<?php echo htmlspecialchars($juleha_id); ?>';
const memberDisplayName = '<?php echo htmlspecialchars(addslashes($display_name)); ?>';
const memberRegion = '<?php echo htmlspecialchars(addslashes($member->region ?? 'Jatim')); ?>';

$(document).ready(function() {
  // Check All Checkbox Handler
  $('#checkAllHistory').on('change', function() {
    const isChecked = $(this).is(':checked');
    $('.session-checkbox').prop('checked', isChecked);
    updateSelectedCount();
  });

  // Individual Session Checkbox Handler
  $(document).on('change', '.session-checkbox', function() {
    const total = $('.session-checkbox').length;
    const checked = $('.session-checkbox:checked').length;
    $('#checkAllHistory').prop('checked', total > 0 && total === checked);
    updateSelectedCount();
  });
});

function updateSelectedCount() {
  const checked = $('.session-checkbox:checked').length;
  $('#countSelectedBadge').text(checked);
}

/**
 * Mengambil daftar data sesi yang dicentang atau seluruh sesi jika tidak ada yang dicentang
 */
function getSelectedOrAllSessions() {
  const selectedBoxes = $('.session-checkbox:checked');
  const list = [];

  if (selectedBoxes.length > 0) {
    selectedBoxes.each(function() {
      const card = $(this).closest('.session-item');
      const jsonStr = card.attr('data-session-json');
      if (jsonStr) {
        try {
          list.push(JSON.parse(jsonStr));
        } catch(e) {}
      }
    });
  } else {
    // Ambil semua jika tidak ada yang dicentang
    $('.session-item').each(function() {
      const card = $(this);
      const jsonStr = card.attr('data-session-json');
      if (jsonStr) {
        try {
          list.push(JSON.parse(jsonStr));
        } catch(e) {}
      }
    });
  }
  return list;
}

/**
 * Universal Export Trigger untuk Anggota Mandiri
 */
function exportMemberRekap(format) {
  const sessions = getSelectedOrAllSessions();
  if (!sessions || sessions.length === 0) {
    alert('Tidak ada riwayat sesi praktik untuk direkap.');
    return;
  }

  if (format === 'png') {
    exportMemberPng(sessions);
  } else if (format === 'pdf') {
    exportMemberPdf(sessions);
  } else if (format === 'excel') {
    exportMemberExcelCsv(sessions);
  } else if (format === 'print') {
    exportMemberPrint(sessions);
  } else if (format === 'copy') {
    exportMemberCopy(sessions);
  }
}

/**
 * 1. Unduh Gambar (.PNG) Berkualitas Tinggi (Kartu Lembar Catatan Praktik Resmi)
 */
function exportMemberPng(sessions) {
  const $tbody = $('#certTableTbody');
  $tbody.empty();

  sessions.forEach(function(s, idx) {
    const tr = `
      <tr>
        <td style="text-align: center; font-weight: bold;">${idx + 1}</td>
        <td><strong>${s.date_full}</strong></td>
        <td><strong>${s.rph}</strong></td>
        <td><span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px; border: 1px solid #cbd5e1; font-weight: 600;">${s.animal}</span></td>
        <td><span style="font-weight: 600; color: ${s.role === 'Instruktur' ? '#1d4ed8' : '#15803d'};">${s.role}</span></td>
        <td>${s.partner_name}</td>
        <td><strong style="color: ${s.status === 'Lulus Praktik' ? '#166534' : '#854d0e'};">${s.status}</strong></td>
        <td>
          <div>${s.notes}</div>
          ${s.evaluator ? `<small style="color: #64748b; display: block; margin-top: 2px;">Penilai: <strong>${s.evaluator}</strong></small>` : ''}
        </td>
      </tr>
    `;
    $tbody.append(tr);
  });

  $('#certTotalSessions').text(sessions.length + ' Sesi');

  const element = document.getElementById('memberCertificateSheet');
  
  html2canvas(element, {
    scale: 2,
    useCORS: true,
    backgroundColor: '#ffffff'
  }).then(function(canvas) {
    const link = document.createElement('a');
    link.download = 'Rekap_Praktik_' + memberJulehaId + '_' + Date.now() + '.png';
    link.href = canvas.toDataURL('image/png');
    link.click();
  }).catch(function(err) {
    alert('Terjadi kesalahan saat memproses gambar: ' + err);
  });
}

/**
 * 2. Unduh Dokumen PDF Resmi
 */
function exportMemberPdf(sessions) {
  if (typeof pdfMake === 'undefined') {
    alert('Modul PDF belum selesai dimuat. Silakan muat ulang halaman.');
    return;
  }

  const tableBody = [
    [
      { text: 'No', style: 'tableHeader', alignment: 'center' },
      { text: 'Waktu & Tanggal', style: 'tableHeader' },
      { text: 'Lokasi RPH', style: 'tableHeader' },
      { text: 'Hewan', style: 'tableHeader' },
      { text: 'Peran', style: 'tableHeader' },
      { text: 'Instruktur / Penguji', style: 'tableHeader' },
      { text: 'Status Kelulusan', style: 'tableHeader' },
      { text: 'Catatan Evaluasi', style: 'tableHeader' }
    ]
  ];

  sessions.forEach(function(s, idx) {
    tableBody.push([
      { text: (idx + 1).toString(), alignment: 'center' },
      { text: s.date_full, bold: true },
      { text: s.rph },
      { text: s.animal },
      { text: s.role },
      { text: s.partner_name },
      { text: s.status, bold: true, color: s.status === 'Lulus Praktik' ? '#166534' : '#854d0e' },
      { text: s.notes + (s.evaluator ? '\n(Oleh: ' + s.evaluator + ')' : ''), fontSize: 7.5 }
    ]);
  });

  const docDefinition = {
    pageSize: 'A4',
    pageOrientation: 'landscape',
    pageMargins: [30, 30, 30, 30],
    content: [
      {
        text: 'JURU SEMBELIH HALAL (JULEHA) JAWA TIMUR',
        style: 'docHeader',
        alignment: 'center'
      },
      {
        text: 'Lembar Catatan Riwayat & Jam Terbang Praktik Lapangan Penyembelihan Halal\nWebsite: members.julehajatim.com | Lokasi Resmi: RPH TOW & RPH Kedurus\n',
        style: 'docSubHeader',
        alignment: 'center'
      },
      {
        canvas: [{ type: 'line', x1: 0, y1: 0, x2: 780, y2: 0, lineWidth: 2, lineColor: '#064e3b' }]
      },
      {
        margin: [0, 10, 0, 10],
        table: {
          widths: ['70%', '30%'],
          body: [
            [
              {
                text: 'Nama Anggota : ' + memberDisplayName + '\nID Juleha : ' + memberJulehaId + ' | Wilayah : ' + memberRegion,
                bold: true,
                fontSize: 9.5,
                color: '#064e3b'
              },
              {
                text: 'Total Sesi Rekap : ' + sessions.length + ' Sesi\nDicetak : ' + new Date().toLocaleDateString('id-ID'),
                alignment: 'right',
                fontSize: 9
              }
            ]
          ]
        },
        layout: 'noBorders'
      },
      {
        table: {
          headerRows: 1,
          widths: ['4%', '16%', '13%', '8%', '10%', '16%', '13%', '20%'],
          body: tableBody
        },
        layout: {
          fillColor: function (rowIndex) {
            return (rowIndex === 0) ? '#064e3b' : (rowIndex % 2 === 0 ? '#f8fafc' : null);
          }
        }
      },
      {
        margin: [0, 20, 0, 0],
        columns: [
          {
            width: '60%',
            text: 'Catatan:\nDokumen ini merupakan catatan digital resmi jam terbang penyembelihan halal anggota yang terverifikasi dalam basis data Juleha Jawa Timur.',
            fontSize: 8,
            color: '#64748b'
          },
          {
            width: '40%',
            alignment: 'center',
            text: 'Surabaya, ' + new Date().toLocaleDateString('id-ID') + '\nJuleha Jawa Timur\n\n\n\n( MOCH. MAFTUCHIN )\nKoordinator Praktik Lapangan RPH',
            fontSize: 8.5
          }
        ]
      }
    ],
    styles: {
      docHeader: {
        fontSize: 12,
        bold: true,
        color: '#064e3b'
      },
      docSubHeader: {
        fontSize: 9,
        color: '#475569',
        margin: [0, 2, 0, 8]
      },
      tableHeader: {
        fontSize: 8.5,
        bold: true,
        color: '#ffffff',
        fillColor: '#064e3b'
      }
    },
    defaultStyle: {
      fontSize: 8
    }
  };

  pdfMake.createPdf(docDefinition).download('Rekap_Praktik_' + memberJulehaId + '.pdf');
}

/**
 * 3. Unduh Excel / CSV dengan UTF-8 BOM
 */
function exportMemberExcelCsv(sessions) {
  let csvContent = '\uFEFF';
  csvContent += '"No","Waktu / Tanggal","Lokasi RPH","Objek Sembelihan","Peran","Instruktur / Pembimbing","Status Evaluasi","Catatan Evaluasi","Dinilai Oleh"\r\n';

  sessions.forEach(function(s, idx) {
    const row = [
      idx + 1,
      s.date_full,
      s.rph,
      s.animal,
      s.role,
      s.partner_name,
      s.status,
      s.notes.replace(/"/g, '""'),
      s.evaluator
    ];
    csvContent += row.map(v => `"${v}"`).join(',') + '\r\n';
  });

  const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
  const url = URL.createObjectURL(blob);
  const link = document.createElement('a');
  link.setAttribute('href', url);
  link.setAttribute('download', 'Rekap_Praktik_' + memberJulehaId + '_' + Date.now() + '.csv');
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

/**
 * 4. Cetak Langsung Lembar Resmi Praktik
 */
function exportMemberPrint(sessions) {
  const printWindow = window.open('', '', 'width=950,height=700');
  let tableRowsHtml = '';
  sessions.forEach(function(s, idx) {
    tableRowsHtml += `
      <tr>
        <td style="text-align: center;">${idx + 1}</td>
        <td><strong>${s.date_full}</strong></td>
        <td>${s.rph}</td>
        <td>${s.animal}</td>
        <td>${s.role}</td>
        <td>${s.partner_name}</td>
        <td><strong>${s.status}</strong></td>
        <td>${s.notes}</td>
      </tr>
    `;
  });

  const printHtml = `
    <!DOCTYPE html>
    <html>
    <head>
      <title>Lembar Riwayat Praktik - ${memberDisplayName} (${memberJulehaId})</title>
      <style>
        body { font-family: 'Poppins', Arial, sans-serif; padding: 30px; color: #1e293b; }
        .kop { border-bottom: 2px solid #064e3b; padding-bottom: 12px; margin-bottom: 15px; text-align: center; }
        .kop h2 { margin: 0; color: #064e3b; font-size: 16px; text-transform: uppercase; }
        .kop h3 { margin: 4px 0; font-size: 13.5px; }
        .kop p { margin: 0; font-size: 11px; color: #64748b; }
        .info-box { background: #f8fafc; border: 1px solid #cbd5e1; padding: 12px 16px; border-radius: 6px; margin-bottom: 15px; font-size: 12px; display: flex; justify-content: space-between; }
        table { width: 100%; border-collapse: collapse; font-size: 11px; margin-top: 10px; }
        th { background: #064e3b; color: white; padding: 8px 6px; border: 1px solid #064e3b; }
        td { padding: 6px 8px; border: 1px solid #cbd5e1; vertical-align: middle; }
        tr:nth-child(even) td { background: #f8fafc; }
        .ttd-box { margin-top: 40px; display: flex; justify-content: space-between; font-size: 12px; }
        @media print {
          button { display: none; }
        }
      </style>
    </head>
    <body>
      <div class="kop">
        <h2>Juru Sembelih Halal (Juleha) Jawa Timur</h2>
        <h3>Lembar Rekapitulasi Jam Terbang Praktik Lapangan Penyembelihan Halal</h3>
        <p>Sekretariat: Surabaya, Jawa Timur | Website: members.julehajatim.com</p>
      </div>
      <div class="info-box">
        <div>
          <strong>Nama:</strong> ${memberDisplayName}<br>
          <strong>ID Juleha:</strong> ${memberJulehaId} &bull; <strong>Wilayah:</strong> ${memberRegion}
        </div>
        <div style="text-align: right;">
          <strong>Total Sesi:</strong> ${sessions.length} Sesi<br>
          <strong>Dicetak Pada:</strong> ${new Date().toLocaleDateString('id-ID')}
        </div>
      </div>
      <table>
        <thead>
          <tr>
            <th style="width: 30px;">No</th>
            <th>Waktu & Tanggal</th>
            <th>Lokasi RPH</th>
            <th>Hewan</th>
            <th>Peran</th>
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
          <div style="font-size: 11px; color: #64748b;">Sistem Keanggotaan Terpadu</div>
          <div style="height: 55px;"></div>
          <div>Juleha Jawa Timur</div>
        </div>
        <div style="text-align: center;">
          <div>Surabaya, ${new Date().toLocaleDateString('id-ID')}</div>
          <div>Koordinator RPH</div>
          <div style="height: 55px;"></div>
          <div><strong>Moch. Maftuchin</strong></div>
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

/**
 * 5. Salin Ringkasan Teks Format WhatsApp
 */
function exportMemberCopy(sessions) {
  let text = '*REKAPITULASI PRAKTIK SEMBELIH HALAL - JULEHA JATIM*\n';
  text += '------------------------------------------\n';
  text += '👤 *Nama:* ' + memberDisplayName + '\n';
  text += '🆔 *ID Juleha:* ' + memberJulehaId + '\n';
  text += '📍 *Wilayah:* ' + memberRegion + '\n';
  text += '📊 *Total Jam Terbang:* ' + sessions.length + ' Sesi Praktik\n';
  text += '------------------------------------------\n\n';
  text += '*Detail Riwayat Praktik:*\n';

  sessions.forEach(function(s, idx) {
    text += (idx + 1) + '. 📅 *' + s.date_full + '*\n';
    text += '   • Lokasi: ' + s.rph + '\n';
    text += '   • Hewan: ' + s.animal + ' | Peran: ' + s.role + '\n';
    text += '   • ' + s.partner_lbl + ': ' + s.partner_name + '\n';
    text += '   • Status: ' + s.status + '\n';
    text += '   • Catatan: ' + s.notes + '\n\n';
  });

  text += 'Dokumen digital resmi diterbitkan oleh:\n';
  text += 'Juru Sembelih Halal (Juleha) Jawa Timur\n';
  text += '🌐 https://members.julehajatim.com';

  if (navigator.clipboard) {
    navigator.clipboard.writeText(text).then(function() {
      alert('Berhasil menyalin ringkasan riwayat praktik ke clipboard! Siap dikirim ke WhatsApp.');
    });
  } else {
    const tempInput = $('<textarea>');
    $('body').append(tempInput);
    tempInput.val(text).select();
    document.execCommand('copy');
    tempInput.remove();
    alert('Berhasil menyalin ringkasan riwayat praktik ke clipboard!');
  }
}
</script>

</body>
</html>
