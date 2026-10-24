<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profil Anggota - <?php echo htmlspecialchars($obj->nickname ?? $juleha_id, ENT_QUOTES, 'UTF-8'); ?> - Juleha Jatim</title>

  <!-- Google Font: Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/adminlte/dist/css/adminlte.min.css">
  <!-- QRCode Library -->
  <script src="/assets/easy.qrcode.js" type="text/javascript" charset="utf-8"></script>

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

    /* CARD STYLES */
    .profile-card {
      background: #ffffff;
      border-radius: 16px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
      overflow: hidden;
      margin-bottom: 24px;
      transition: box-shadow 0.2s ease;
    }

    .profile-card:hover {
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07);
    }

    .profile-card-top-bar {
      height: 6px;
      background: linear-gradient(90deg, #064e3b 0%, #059669 100%);
    }

    /* AVATAR */
    .avatar-wrapper {
      position: relative;
      width: 130px;
      height: 130px;
      margin: 15px auto 12px;
    }

    .profile-avatar-img {
      width: 130px;
      height: 130px;
      object-fit: cover;
      border-radius: 50%;
      border: 4px solid #ffffff;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
      cursor: pointer;
      transition: transform 0.2s ease, filter 0.2s ease;
    }

    .profile-avatar-img:hover {
      transform: scale(1.02);
      filter: brightness(0.95);
    }

    .avatar-edit-badge {
      position: absolute;
      bottom: 4px;
      right: 4px;
      background: #059669;
      color: #ffffff;
      width: 34px;
      height: 34px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 2px solid #ffffff;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      font-size: 13px;
      transition: all 0.2s ease;
    }

    .avatar-edit-badge:hover {
      background: #047857;
      transform: scale(1.1);
    }

    /* BADGES */
    .badge-id {
      background-color: #f1f5f9;
      color: #475569;
      border: 1px solid #cbd5e1;
      padding: 5px 14px;
      border-radius: 30px;
      font-size: 0.88rem;
      font-weight: 600;
      letter-spacing: 0.5px;
      display: inline-block;
    }

    .badge-status-active {
      background-color: #dcfce7;
      color: #15803d;
      border: 1px solid #bbf7d0;
      padding: 5px 14px;
      border-radius: 30px;
      font-size: 0.85rem;
      font-weight: 600;
      display: inline-block;
    }

    .badge-status-inactive {
      background-color: #fee2e2;
      color: #b91c1c;
      border: 1px solid #fecaca;
      padding: 5px 14px;
      border-radius: 30px;
      font-size: 0.85rem;
      font-weight: 600;
      display: inline-block;
    }

    /* ACTION BUTTONS */
    .btn-action-kta {
      background: #059669;
      color: #ffffff;
      font-weight: 600;
      border: none;
      border-radius: 10px;
      padding: 10px 16px;
      transition: all 0.2s ease;
      box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
    }

    .btn-action-kta:hover {
      background: #047857;
      color: #ffffff;
      transform: translateY(-1px);
      box-shadow: 0 6px 16px rgba(5, 150, 105, 0.35);
    }

    .btn-outline-juleha {
      border: 1.5px solid #059669;
      color: #059669;
      font-weight: 600;
      border-radius: 10px;
      padding: 9px 16px;
      background: transparent;
      transition: all 0.2s ease;
    }

    .btn-outline-juleha:hover {
      background: #ecfdf5;
      color: #047857;
      border-color: #047857;
    }

    .btn-outline-neutral {
      border: 1.5px solid #cbd5e1;
      color: #475569;
      font-weight: 600;
      border-radius: 10px;
      padding: 9px 16px;
      background: transparent;
      transition: all 0.2s ease;
    }

    .btn-outline-neutral:hover {
      background: #f1f5f9;
      color: #1e293b;
      border-color: #94a3b8;
    }

    /* INFO ROWS */
    .info-item {
      display: flex;
      align-items: flex-start;
      padding: 12px 0;
      border-bottom: 1px dashed #e2e8f0;
    }

    .info-item:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }

    .info-icon {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background: #ecfdf5;
      color: #059669;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 14px;
      font-size: 15px;
      flex-shrink: 0;
    }

    .info-label {
      font-size: 0.8rem;
      color: #64748b;
      margin-bottom: 2px;
      text-transform: uppercase;
      font-weight: 500;
      letter-spacing: 0.5px;
    }

    .info-value {
      font-size: 0.95rem;
      font-weight: 600;
      color: #0f172a;
    }

    /* TABS */
    .nav-pills-custom .nav-link {
      color: #64748b;
      font-weight: 600;
      border-radius: 10px;
      padding: 9px 18px;
      transition: all 0.2s ease;
      margin-right: 6px;
      border: 1px solid transparent;
    }

    .nav-pills-custom .nav-link.active {
      background-color: #059669 !important;
      color: #ffffff !important;
      box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
    }

    .nav-pills-custom .nav-link:hover:not(.active) {
      background-color: #f1f5f9;
      color: #1e293b;
    }

    /* TIMELINE & ENTRY CARDS */
    .entry-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 16px 18px;
      margin-bottom: 14px;
      transition: all 0.2s ease;
      position: relative;
    }

    .entry-card:hover {
      border-color: #cbd5e1;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
      transform: translateY(-1px);
    }

    .entry-badge-date {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 0.82rem;
      font-weight: 600;
      color: #059669;
      background: #ecfdf5;
      padding: 4px 10px;
      border-radius: 6px;
      margin-bottom: 8px;
    }

    .entry-title {
      font-size: 1rem;
      font-weight: 600;
      color: #0f172a;
      margin: 0;
    }

    .empty-state {
      text-align: center;
      padding: 45px 20px;
      color: #94a3b8;
    }

    .empty-state i {
      font-size: 45px;
      color: #cbd5e1;
      margin-bottom: 12px;
    }

    .empty-state h5 {
      color: #475569;
      font-weight: 600;
      font-size: 1.05rem;
      margin-bottom: 4px;
    }

    .empty-state p {
      font-size: 0.88rem;
      margin: 0;
    }

    /* KTA CANVAS CONTAINER */
    .kta-preview-container {
      background: #f1f5f9;
      border-radius: 14px;
      padding: 24px 15px;
      text-align: center;
      border: 1px dashed #cbd5e1;
      margin-bottom: 20px;
    }

    #canvasKTA {
      max-width: 380px;
      width: 100%;
      height: auto;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.14);
      display: inline-block;
    }

    #mybarcode {
      display: none !important;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom" style="border-color: #e2e8f0 !important;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url(); ?>" class="nav-link font-weight-500">Beranda</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://julehajatim.com" target="_blank" class="nav-link font-weight-500">Portal Juleha</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto d-flex flex-row align-items-center">
      <li class="nav-item mr-2">
        <button id="btnChangePasswordNav" type="button" class="btn btn-outline-secondary btn-sm rounded shadow-sm font-weight-bold px-3">
          <i class="fas fa-key mr-1"></i> Ubah Password
        </button>
      </li>
      <li class="nav-item">
        <a href="/members/logout" class="btn btn-outline-danger btn-sm rounded shadow-sm font-weight-bold px-3">
          <i class="fas fa-sign-out-alt mr-1"></i> Keluar
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $this->load->view('common/sidemenu')?>

  <!-- Content Wrapper -->
  <div class="content-wrapper py-4 px-2 px-md-3">

    <!-- Content Header -->
    <section class="content-header pb-2">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold" style="color: #064e3b; font-size: 1.6rem;">
              <i class="fas fa-user-circle text-success mr-2"></i> Profil Anggota
            </h1>
            <p class="text-muted small m-0 mt-1">Sistem Informasi Manajemen Keanggotaan Terpadu Juleha Jawa Timur</p>
          </div>
          <div class="col-sm-6 mt-2 mt-sm-0">
            <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>" class="text-success">Home</a></li>
              <li class="breadcrumb-item active text-muted">Profil Anggota</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content mt-3">
      <div class="container-fluid">
        <div class="row">
          
          <!-- LEFT COLUMN: Profile Card & Member Details -->
          <div class="col-lg-4 col-md-5">

            <!-- Profile Summary Card -->
            <div class="profile-card text-center p-4">
              <div class="profile-card-top-bar" style="margin: -24px -24px 20px -24px;"></div>
              
              <div class="avatar-wrapper" title="Klik untuk mengganti foto profil / KTA">
                <img class="profile-avatar-img"
                     src="/images/<?php echo htmlspecialchars($juleha_id, ENT_QUOTES, 'UTF-8'); ?>.jpg?t=<?php echo time(); ?>"
                     alt="Foto Profil Anggota" id="btnImg"
                     onerror="this.onerror=null;this.src='/assets/adminlte/dist/img/avatar5.png';">
                <div class="avatar-edit-badge" id="btnChangePhotoBadge" title="Ubah Foto KTA">
                  <i class="fas fa-camera"></i>
                </div>
              </div>
              
              <h3 class="font-weight-bold mb-1" style="color: #0f172a; font-size: 1.25rem;">
                <?php echo htmlspecialchars($obj->nickname ?? $juleha_id, ENT_QUOTES, 'UTF-8'); ?>
              </h3>

              <div class="mb-2">
                <span class="badge-id">
                  <i class="fas fa-id-badge text-success mr-1"></i> ID: <?php echo htmlspecialchars($juleha_id, ENT_QUOTES, 'UTF-8'); ?>
                </span>
              </div>

              <div class="mb-4">
                <?php if (strtolower($obj->mstatus) === 'aktif'): ?>
                  <span class="badge-status-active">
                    <i class="fas fa-check-circle mr-1"></i> Anggota Aktif
                  </span>
                <?php else: ?>
                  <span class="badge-status-inactive">
                    <i class="fas fa-times-circle mr-1"></i> <?php echo htmlspecialchars($obj->mstatus, ENT_QUOTES, 'UTF-8'); ?>
                  </span>
                <?php endif; ?>
              </div>

              <!-- Quick Action Buttons -->
              <div class="d-flex flex-column" style="gap: 10px;">
                <!-- Main KTA Download Button (Triggers Modern KTA Generator) -->
                <button type="button" class="btn btn-action-kta btn-block" id="btnDownloadKTA">
                  <i class="fas fa-id-card mr-1"></i> Download KTA Resmi (.PNG)
                </button>

                <!-- Open Official KTA Page in New Tab -->
                <a href="<?php echo base_url('members/showcard/' . rawurlencode($juleha_id)); ?>" target="_blank" class="btn btn-outline-juleha btn-block">
                  <i class="fas fa-external-link-alt mr-1"></i> Buka Halaman KTA Penuh
                </a>

                <!-- Dedicated Upload Photo KTA Page -->
                <a href="<?php echo base_url('members/uploder/' . rawurlencode($juleha_id)); ?>" class="btn btn-outline-neutral btn-block">
                  <i class="fas fa-camera mr-1"></i> Ganti / Perbarui Foto KTA
                </a>

                <!-- Change Password -->
                <button type="button" class="btn btn-outline-neutral btn-block" id="btnChangePassword">
                  <i class="fas fa-key mr-1"></i> Ubah Password Akun
                </button>

                <!-- Download Android APK -->
                <a class="btn btn-outline-neutral btn-block" id="btnDownloadApp" href="/apps/JulehaJawaTimur-v1.2.apk">
                  <i class="fab fa-android text-success mr-1"></i> Download JulehaJatim App (APK)
                </a>
              </div>
            </div>

            <!-- About / Detail Informasi Box -->
            <div class="profile-card p-4">
              <h5 class="font-weight-bold mb-3" style="color: #064e3b; font-size: 1.05rem;">
                <i class="fas fa-info-circle text-success mr-2"></i> Informasi Keanggotaan
              </h5>

              <div class="info-item">
                <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div>
                  <div class="info-label">Kabupaten / Kota</div>
                  <div class="info-value"><?php echo htmlspecialchars($obj->region ?? '-', ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
              </div>

              <div class="info-item">
                <div class="info-icon"><i class="fas fa-home"></i></div>
                <div>
                  <div class="info-label">Alamat Domisili</div>
                  <div class="info-value"><?php echo htmlspecialchars($obj->address ?? '-', ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
              </div>

              <div class="info-item">
                <div class="info-icon"><i class="fas fa-shield-alt"></i></div>
                <div>
                  <div class="info-label">Organisasi</div>
                  <div class="info-value">Juru Sembelih Halal (Juleha) Jawa Timur</div>
                </div>
              </div>
            </div>

          </div>

          <!-- RIGHT COLUMN: Modern Tabs for Portfolio, Certificates, Trainings, KTA -->
          <div class="col-lg-8 col-md-7">
            <div class="profile-card p-3 p-md-4">
              
              <!-- Tab Navigation -->
              <ul class="nav nav-pills nav-pills-custom border-bottom pb-3 mb-4" id="profileTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="tab-portofolio-btn" data-toggle="pill" href="#portofolio" role="tab">
                    <i class="fas fa-briefcase mr-1"></i> Portofolio 
                    <span class="badge badge-light ml-1"><?php echo (int)($portofolio['cnt'] ?? 0); ?></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="tab-sertifikat-btn" data-toggle="pill" href="#sertifikat" role="tab">
                    <i class="fas fa-award mr-1"></i> Sertifikat 
                    <span class="badge badge-light ml-1"><?php echo (int)($certificate['cnt'] ?? 0); ?></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="tab-pelatihan-btn" data-toggle="pill" href="#pelatihan" role="tab">
                    <i class="fas fa-chalkboard-teacher mr-1"></i> Pelatihan 
                    <span class="badge badge-light ml-1"><?php echo (int)($training['cnt'] ?? 0); ?></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="tab-kta-btn" data-toggle="pill" href="#kta" role="tab">
                    <i class="fas fa-id-card mr-1"></i> Kartu KTA Resmi
                  </a>
                </li>
              </ul>

              <!-- Tab Content Panes -->
              <div class="tab-content" id="profileTabContent">

                <!-- 1. PORTOFOLIO TAB -->
                <div class="tab-pane fade show active" id="portofolio" role="tabpanel">
                  <?php if (!empty($portofolio['res']) && count($portofolio['res']) > 0): ?>
                    <?php foreach($portofolio['res'] as $prt): ?>
                      <div class="entry-card">
                        <div class="entry-badge-date">
                          <i class="far fa-calendar-alt"></i> <?php echo htmlspecialchars($prt->eventdate ?? '-', ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                        <h6 class="entry-title"><?php echo htmlspecialchars($prt->subject ?? '-', ENT_QUOTES, 'UTF-8'); ?></h6>
                      </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <div class="empty-state">
                      <i class="fas fa-folder-open"></i>
                      <h5>Belum Ada Data Portofolio</h5>
                      <p>Catatan portofolio penyembelihan anggota belum ditambahkan.</p>
                    </div>
                  <?php endif; ?>
                </div>

                <!-- 2. SERTIFIKAT TAB -->
                <div class="tab-pane fade" id="sertifikat" role="tabpanel">
                  <?php if (!empty($certificate['res']) && count($certificate['res']) > 0): ?>
                    <?php foreach($certificate['res'] as $cert): ?>
                      <div class="entry-card">
                        <div class="entry-badge-date">
                          <i class="fas fa-award text-warning"></i> <?php echo htmlspecialchars($cert->certificatedate ?? '-', ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                        <h6 class="entry-title"><?php echo htmlspecialchars($cert->subject ?? '-', ENT_QUOTES, 'UTF-8'); ?></h6>
                      </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <div class="empty-state">
                      <i class="fas fa-certificate"></i>
                      <h5>Belum Ada Sertifikat</h5>
                      <p>Sertifikat keahlian atau kelulusan belum ditambahkan.</p>
                    </div>
                  <?php endif; ?>
                </div>

                <!-- 3. PELATIHAN TAB -->
                <div class="tab-pane fade" id="pelatihan" role="tabpanel">
                  <?php if (!empty($training['res']) && count($training['res']) > 0): ?>
                    <?php foreach($training['res'] as $tr): ?>
                      <div class="entry-card">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                          <div class="entry-badge-date mb-0">
                            <i class="far fa-calendar-check"></i> <?php echo htmlspecialchars($tr->eventdate ?? '-', ENT_QUOTES, 'UTF-8'); ?>
                          </div>
                          <?php if (!empty($tr->role)): ?>
                            <span class="badge badge-success px-2 py-1"><?php echo htmlspecialchars($tr->role, ENT_QUOTES, 'UTF-8'); ?></span>
                          <?php endif; ?>
                        </div>
                        <h6 class="entry-title"><?php echo htmlspecialchars($tr->subject ?? '-', ENT_QUOTES, 'UTF-8'); ?></h6>
                      </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <div class="empty-state">
                      <i class="fas fa-graduation-cap"></i>
                      <h5>Belum Ada Riwayat Pelatihan</h5>
                      <p>Riwayat keikutsertaan pelatihan Juleha belum terdata.</p>
                    </div>
                  <?php endif; ?>
                </div>

                <!-- 4. OFFICIAL KTA CARD PREVIEW TAB (REPLACES OBSOLETE TEMPLATE) -->
                <div class="tab-pane fade" id="kta" role="tabpanel">
                  <div class="kta-preview-container">
                    <canvas id="canvasKTA" width="597" height="919"></canvas>
                  </div>

                  <div class="text-center mt-3">
                    <button type="button" onclick="downloadModernKTA()" class="btn btn-action-kta px-4 py-2 font-weight-bold mr-2 mb-2">
                      <i class="fas fa-download mr-1"></i> Download Kartu KTA (.PNG)
                    </button>
                    <a href="<?php echo base_url('members/showcard/' . rawurlencode($juleha_id)); ?>" target="_blank" class="btn btn-outline-juleha px-4 py-2 font-weight-bold mr-2 mb-2">
                      <i class="fas fa-external-link-alt mr-1"></i> Buka Halaman KTA Penuh
                    </a>
                    <a href="<?php echo base_url('members/uploder/' . rawurlencode($juleha_id)); ?>" class="btn btn-outline-neutral px-4 py-2 font-weight-bold mb-2">
                      <i class="fas fa-camera mr-1"></i> Ganti / Perbarui Foto KTA
                    </a>
                  </div>
                </div>

              </div><!-- /.tab-content -->
            </div><!-- /.profile-card -->
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

  </div><!-- /.content-wrapper -->

  <!-- Footer -->
  <footer class="main-footer border-top text-sm py-3" style="border-color: #e2e8f0 !important; background: #ffffff;">
    <div class="float-right d-none d-sm-inline text-muted">
      Sistem Informasi Manajemen Keanggotaan
    </div>
    <strong>Copyright &copy; 2021-2026 <a href="https://julehajatim.com" target="_blank" class="text-success font-weight-bold">Juru Sembelih Halal (Juleha) Jawa Timur</a>.</strong> All rights reserved.
  </footer>

</div><!-- ./wrapper -->

<!-- Hidden Container for QRCode generation -->
<div id="mybarcode"></div>

<!-- Hidden file input for fast avatar click upload -->
<input type="file" name="uploader" id="uploader" accept="image/jpeg,image/png,image/jpg" style="display:none">

<!-- jQuery & Bootstrap 4 -->
<script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/adminlte/dist/js/adminlte.min.js"></script>

<!-- Edit Password Modal View -->
<?php $this->load->view('members/editPassword');?>

<script>
(function($){
  var currentJulehaId = "<?php echo addslashes($juleha_id); ?>";
  var currentNickName = "<?php echo addslashes($obj->nickname ?? $juleha_id); ?>";
  var currentMStatus  = "<?php echo addslashes(strtolower($obj->mstatus ?? 'aktif')); ?>";
  var currentMemberId = "<?php echo addslashes($obj->id ?? ''); ?>";
  var currentTimestamp = "<?php echo time(); ?>";

  // 1. Inisialisasi QR Code Resmi yang terhubung ke verifikasi anggota
  var qrCodeContainer = document.getElementById("mybarcode");
  if (qrCodeContainer) {
    new QRCode(qrCodeContainer, {
      text: "https://members.julehajatim.com/members/show/" + encodeURIComponent(currentJulehaId),
      width: 240,
      height: 240,
      colorDark: "#000000",
      colorLight: "#ffffff",
      quietZone: 15,
      quietZoneColor: "#ffffff",
      correctLevel: QRCode.CorrectLevel.H
    });
  }

  // 2. Siapkan Objek Gambar untuk Kanvas KTA Modern
  var ktaBg  = new Image();
  var foto   = new Image();
  var logo   = new Image();

  var ktaLoaded  = false;
  var fotoLoaded = false;
  var logoLoaded = false;

  ktaBg.onload  = function() { ktaLoaded  = true; renderModernCard(); };
  foto.onload   = function() { fotoLoaded = true; renderModernCard(); };
  foto.onerror  = function() { fotoLoaded = false; renderModernCard(); };
  logo.onload   = function() { logoLoaded = true; renderModernCard(); };

  ktaBg.src = "<?php echo base_url('assets/kta.jpg'); ?>";
  foto.src  = "<?php echo base_url('images/' . $juleha_id . '.jpg?t='); ?>" + currentTimestamp;
  logo.src  = "<?php echo base_url('assets/juleha.jpg'); ?>";

  // 3. Fungsi Render KTA Resmi ke Canvas
  function renderModernCard() {
    var canvas = document.getElementById("canvasKTA");
    if (!canvas) return;
    var ctx = canvas.getContext("2d");

    var cWidth  = (ktaBg && (ktaBg.naturalWidth || ktaBg.width)) ? (ktaBg.naturalWidth || ktaBg.width) : 597;
    var cHeight = (ktaBg && (ktaBg.naturalHeight || ktaBg.height)) ? (ktaBg.naturalHeight || ktaBg.height) : 919;
    canvas.width  = cWidth;
    canvas.height = cHeight;

    ctx.clearRect(0, 0, cWidth, cHeight);

    // A. Gambar Background Template Resmi
    if (ktaBg && (ktaBg.complete || ktaLoaded) && ktaBg.naturalWidth > 0) {
      ctx.drawImage(ktaBg, 0, 0, cWidth, cHeight);
    }

    // B. Gambar QR Code
    var qrCanvas = document.querySelector("#mybarcode canvas");
    if (qrCanvas) {
      var bwidth  = qrCanvas.width * 0.6;
      var bheight = qrCanvas.height * 0.6;
      var bx = cWidth * 0.37;
      var by = cHeight * 0.70;
      ctx.drawImage(qrCanvas, bx, by, bwidth, bheight);

      // Logo di tengah QR Code
      if (logo && (logo.complete || logoLoaded) && logo.naturalWidth > 0) {
        var lSize = bwidth * 0.25;
        var lx = bx + (bwidth - lSize) / 2;
        var ly = by + (bheight - lSize) / 2;
        ctx.drawImage(logo, lx, ly, lSize, lSize);
      }
    }

    // C. Frame & Foto Anggota
    var fotoframetop = cHeight * 0.27399;
    ctx.fillStyle = "#ffffff";
    ctx.fillRect(cWidth * 0.06, fotoframetop - 2, 227, 305);

    if (foto && (foto.complete || fotoLoaded) && foto.naturalWidth > 0) {
      ctx.drawImage(
        foto,
        0, 0, foto.naturalWidth, foto.naturalHeight,
        cWidth * 0.08, fotoframetop,
        175, 250
      );
    } else {
      ctx.fillStyle = "#f8fafc";
      ctx.fillRect(cWidth * 0.08, fotoframetop, 175, 250);
      ctx.strokeStyle = "#cbd5e1";
      ctx.lineWidth = 2;
      ctx.strokeRect(cWidth * 0.08, fotoframetop, 175, 250);
      ctx.fillStyle = "#64748b";
      ctx.font = "bold 16px Poppins, sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("FOTO KTA", cWidth * 0.08 + 87, fotoframetop + 120);
      ctx.font = "12px Poppins, sans-serif";
      ctx.fillText("(Belum Diunggah)", cWidth * 0.08 + 87, fotoframetop + 145);
      ctx.textAlign = "left";
    }

    // D. Garis Kotak & Teks Nama / ID Juleha
    var lineX = cWidth * 0.435;
    var lineY = fotoframetop + 150;
    ctx.beginPath();
    ctx.lineWidth = 5;
    ctx.strokeStyle = "black";
    ctx.moveTo(lineX + 256, lineY);
    ctx.lineTo(lineX, lineY);
    ctx.lineTo(lineX, lineY + 48);
    ctx.lineTo(lineX + 256, lineY + 48);
    ctx.stroke();

    ctx.fillStyle = "black";
    ctx.font = "bold 24px Poppins, sans-serif";
    ctx.fillText(currentNickName, cWidth * 0.46, cHeight * 0.42);
    ctx.font = "bold 24px Poppins, sans-serif";
    ctx.fillText(currentJulehaId, cWidth * 0.46, cHeight * 0.47);

    // E. Penanda Jika Status Tidak Aktif
    if (currentMStatus !== "aktif") {
      ctx.strokeStyle = "red";
      ctx.fillStyle = "red";
      ctx.font = "bold 20px Poppins, sans-serif";
      ctx.fillText("Bukan lagi anggota Juleha Jatim", cWidth * 0.4, cHeight * 0.37);
      ctx.beginPath();
      ctx.lineWidth = 6;
      ctx.moveTo(lineX + 400, lineY - 200);
      ctx.lineTo(0, lineY + 150);
      ctx.stroke();
    }
  }

  // 4. Download KTA Fungsi Global
  window.downloadModernKTA = function() {
    renderModernCard();
    var canvas = document.getElementById("canvasKTA");
    if (!canvas) return;
    var link = document.createElement("a");
    link.download = "KTA_JULEHA_" + currentJulehaId + ".png";
    link.href = canvas.toDataURL("image/png");
    link.click();
  };

  // Tombol Download KTA di Card Profil
  $("#btnDownloadKTA").on("click", function(e) {
    e.preventDefault();
    window.downloadModernKTA();
  });

  // Re-render saat tab KTA dibuka
  $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
    if ($(e.target).attr('href') === '#kta') {
      renderModernCard();
    }
  });

  // 5. Ubah Password Modal
  function openChangePasswordModal() {
    $("#txtEditPasswordMemberId").val(currentMemberId);
    $("#txtEditPasswordJulehaId").val(currentJulehaId);
    $("#txtEditPasswordMemberInfo").text(currentNickName + " (" + currentJulehaId + ")");
    $("#modal-lg-edit-password").modal("show");
  }

  $("#btnChangePassword, #btnChangePasswordNav").on("click", function(e){
    e.preventDefault();
    openChangePasswordModal();
  });

  // 6. Ganti Foto Profil / KTA
  $("#btnImg, #btnChangePhotoBadge").on("click", function(){
    $("#uploader").click();
  });

  $("#uploader").on("change", function(){
    if (!this.files || !this.files[0]) return;
    var file = this.files[0];

    // Cek ukuran (maks 15MB untuk direct ajax)
    if (file.size > 15 * 1024 * 1024) {
      alert("Ukuran file terlalu besar. Silakan gunakan menu 'Ganti / Perbarui Foto KTA' untuk kompresi otomatis.");
      window.location.href = "<?php echo base_url('members/uploder/' . rawurlencode($juleha_id)); ?>";
      return;
    }

    var reader = new FileReader();
    reader.onload = function(e) {
      $('#btnImg').attr('src', e.target.result);
      // Upload via ajax
      var base64data = e.target.result.replace(/^data:image\/(png|jpeg|jpg);base64,/, "");
      $.ajax({
        url: '/members/save_image',
        type: 'POST',
        data: {
          image: base64data,
          imagename: currentJulehaId
        },
        dataType: 'json'
      })
      .done(function(res){
        alert("Foto profil & KTA berhasil diperbarui!");
        // Update foto KTA dan re-render kanvas
        foto.src = e.target.result;
        renderModernCard();
      })
      .fail(function(err){
        console.error("Gagal simpan foto:", err);
        // Fallback buka halaman uploder
        window.location.href = "<?php echo base_url('members/uploder/' . rawurlencode($juleha_id)); ?>";
      });
    };
    reader.readAsDataURL(file);
  });

  // Render awal KTA saat dokumen siap
  $(document).ready(function(){
    renderModernCard();
    setTimeout(renderModernCard, 100);
    setTimeout(renderModernCard, 350);
    setTimeout(renderModernCard, 700);
  });

})(jQuery);
</script>
</body>
</html>
