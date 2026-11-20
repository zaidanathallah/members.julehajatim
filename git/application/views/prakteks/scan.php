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
    .role-btn-group .btn-check:checked + .btn-primary,
    .role-btn-group .btn.active {
      background-color: #059669 !important;
      border-color: #059669 !important;
      color: #ffffff !important;
      box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
    }
    .animal-radio-badge {
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
    .animal-radio-badge:hover {
      border-color: #059669;
      color: #059669;
    }
    input[type="radio"]:checked + .animal-radio-badge {
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
      <li class="nav-item">
        <a href="<?php echo base_url('prakteks/index'); ?>" class="btn btn-outline-secondary btn-sm rounded shadow-sm font-weight-bold px-3 mr-2">
          <i class="fas fa-list mr-1"></i> Data Praktik
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
              <i class="fas fa-qrcode text-success mr-2"></i> Scan Presensi Praktik KTA
            </h1>
            <p class="text-muted small m-0 mt-1">Presensi dan Catatan Jam Terbang Praktik Penyembelihan & Instruktur</p>
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

        <!-- Info Notification Alert -->
        <div class="alert alert-light border shadow-sm mb-4" style="border-radius: 12px; background: #ffffff;">
          <div class="d-flex align-items-center">
            <div class="mr-3 text-success" style="font-size: 1.8rem;">
              <i class="fas fa-camera"></i>
            </div>
            <div>
              <h6 class="font-weight-bold mb-1" style="color: #064e3b;">Scanner Kamera Web Terpadu</h6>
              <p class="text-muted small mb-0">
                Arahkan kamera smartphone atau webcam ke <strong>QR Code pada Kartu Tanda Anggota (KTA)</strong> fisik Juleha Jatim. Data anggota akan terisi otomatis secara instan tanpa perlu download aplikasi APK lagi.
              </p>
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
                    <p class="small text-white-50 mb-3">Klik tombol di bawah untuk menyalakan kamera scanner</p>
                    <button type="button" class="btn btn-success btn-sm px-3 rounded-pill font-weight-bold" id="btnStartCamera">
                      <i class="fas fa-video mr-1"></i> Buka Kamera Scanner
                    </button>
                  </div>
                </div>

                <!-- Scanner Controls -->
                <div class="mt-3 d-flex flex-wrap justify-content-center" style="gap: 8px;">
                  <button type="button" class="btn btn-outline-secondary btn-sm" id="btnSwitchCamera" style="display: none;">
                    <i class="fas fa-sync-alt mr-1"></i> Ganti Kamera (Depan/Belakang)
                  </button>
                  <button type="button" class="btn btn-outline-danger btn-sm" id="btnStopCamera" style="display: none;">
                    <i class="fas fa-stop mr-1"></i> Matikan Kamera
                  </button>
                  <label class="btn btn-outline-secondary btn-sm mb-0 cursor-pointer" title="Scan gambar foto QR dari galeri">
                    <i class="fas fa-image mr-1"></i> Scan dari Foto
                    <input type="file" id="qrFileInput" accept="image/*" style="display: none;">
                  </label>
                </div>

                <!-- Scanned Result Flash Alert -->
                <div id="scanFeedback" class="mt-3" style="display: none;"></div>

              </div>
            </div>

            <!-- Card Petunjuk Cepat -->
            <div class="card-modern p-3">
              <h6 class="font-weight-bold text-success mb-2"><i class="fas fa-lightbulb mr-1"></i> Tips Presensi Praktik:</h6>
              <ul class="small text-muted pl-3 mb-0" style="line-height: 1.6;">
                <li>Bisa scan langsung QR Code dari kartu fisik KTA, atau dari layar HP anggota.</li>
                <li>Jika kamera tidak tersedia, Anda bisa langsung ketik <strong>ID Juleha</strong> (misal: <code>SBY220006</code>) pada form di sebelah kanan.</li>
                <li>Baik peserta praktik (Praktikan) maupun Instruktur dapat diabsen agar jam terbang tercatat di rekapitulasi.</li>
              </ul>
            </div>

          </div>

          <!-- RIGHT COLUMN: Attendance Form & Member Preview -->
          <div class="col-lg-7 col-md-6">
            <div class="card-modern">
              <div class="card-header-juleha">
                <span class="font-weight-bold"><i class="fas fa-edit mr-2"></i> Form Presensi Praktik Penyembelihan</span>
              </div>
              <div class="card-body p-4">

                <!-- Member Preview Card (Shows upon QR Detection / ID Input) -->
                <div class="member-preview-card mb-4" id="memberPreviewCard">
                  <div class="d-flex align-items-center">
                    <img src="/assets/adminlte/dist/img/avatar5.png" id="previewPhoto" class="member-avatar-preview mr-3" alt="Foto KTA">
                    <div class="flex-grow-1">
                      <div class="d-flex align-items-center justify-content-between">
                        <span class="badge badge-success px-2 py-1 font-weight-bold" id="previewJulehaId">ID: -</span>
                        <span class="badge badge-light border text-muted" id="previewRegion">Daerah: -</span>
                      </div>
                      <h5 class="font-weight-bold mb-1 mt-1" style="color: #064e3b;" id="previewName">-</h5>
                      <div class="small text-muted d-flex flex-wrap gap-2">
                        <span class="mr-3"><i class="fas fa-user-check text-success mr-1"></i> <span id="previewStatus">Aktif</span></span>
                        <span class="mr-3"><i class="fas fa-cut text-primary mr-1"></i> Praktik: <strong id="previewPraktikCnt">0</strong> kali</span>
                        <span><i class="fas fa-chalkboard-teacher text-warning mr-1"></i> Instruktur: <strong id="previewInstrukturCnt">0</strong> kali</span>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Form Presensi -->
                <form id="formPresensi">
                  <input type="hidden" name="id" id="field_id" value="">

                  <!-- 1. Juleha ID (Input & Scan Hook) -->
                  <div class="form-group mb-3">
                    <label class="font-weight-bold text-dark small text-uppercase">
                      <i class="fas fa-id-card text-success mr-1"></i> ID Juleha Anggota <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                      <input type="text" class="form-control font-weight-bold" id="juleha_id" name="juleha_id" 
                             placeholder="Contoh: SBY220006 atau scan QR KTA" 
                             value="<?php echo htmlspecialchars($prefill_id ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                      <div class="input-group-append">
                        <button class="btn btn-outline-success font-weight-bold" type="button" id="btnCekAnggota">
                          <i class="fas fa-search mr-1"></i> Cek Data
                        </button>
                      </div>
                    </div>
                    <small class="text-muted">ID terisi otomatis saat QR KTA di-scan, atau ketik ID lalu klik "Cek Data".</small>
                  </div>

                  <!-- 2. Peran: Praktikan vs Instruktur -->
                  <div class="form-group mb-3">
                    <label class="font-weight-bold text-dark small text-uppercase">
                      <i class="fas fa-user-tag text-success mr-1"></i> Peran dalam Praktik <span class="text-danger">*</span>
                    </label>
                    <div class="d-flex role-btn-group" style="gap: 12px;">
                      <button type="button" class="btn btn-outline-success flex-fill active" id="btnRolePraktikan" onclick="setRole('praktikan')">
                        <i class="fas fa-cut mr-1"></i> Praktikan (Peserta)
                      </button>
                      <button type="button" class="btn btn-outline-primary flex-fill" id="btnRoleInstruktur" onclick="setRole('instruktur')">
                        <i class="fas fa-chalkboard-teacher mr-1"></i> Instruktur (Pembimbing)
                      </button>
                    </div>
                    <input type="hidden" name="role" id="role" value="praktikan">
                  </div>

                  <!-- 3. Instruktur Pendamping (Hanya jika peran = praktikan) -->
                  <div class="form-group mb-3" id="groupInstructor">
                    <label class="font-weight-bold text-dark small text-uppercase">
                      <i class="fas fa-user-tie text-success mr-1"></i> Instruktur Pembimbing Praktik
                    </label>
                    <input type="text" class="form-control" id="instructor_id" name="instructor_id" 
                           placeholder="Ketik ID Instruktur (misal: SBY220006) atau nama">
                    <small class="text-muted">Instruktur Juleha yang mendampingi dan menguji pada sesi praktik ini.</small>
                  </div>

                  <div class="row">
                    <!-- 4. Tanggal & Waktu Praktik -->
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark small text-uppercase">
                          <i class="far fa-calendar-alt text-success mr-1"></i> Waktu / Tanggal Praktik <span class="text-danger">*</span>
                        </label>
                        <input type="datetime-local" class="form-control" id="praktekdate" name="praktekdate" 
                               value="<?php echo date('Y-m-d\TH:i'); ?>" required>
                      </div>
                    </div>

                    <!-- 5. Lokasi / RPH -->
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark small text-uppercase">
                          <i class="fas fa-map-marker-alt text-success mr-1"></i> Lokasi RPH / Tempat <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" id="rph_id" name="rph_id" onchange="checkLocationInput()">
                          <option value="1">RPH Pegirian (Surabaya)</option>
                          <option value="2">RPH Kedurus (Surabaya)</option>
                          <option value="3">RPH Kambing Kota (Surabaya)</option>
                          <option value="4">RPH Krian Tradisional (Sidoarjo)</option>
                          <option value="5">RPH Krian Modern (Sidoarjo)</option>
                          <option value="7">RPH Malang</option>
                          <?php if (!empty($rphs)): ?>
                            <?php foreach($rphs as $r): ?>
                              <?php if (!in_array($r->id, [1,2,3,4,5,7])): ?>
                                <option value="<?php echo $r->id; ?>"><?php echo htmlspecialchars($r->name); ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          <?php endif; ?>
                          <option value="custom">-- Lokasi Lainnya / Ketik Manual --</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Optional Custom Location Name -->
                  <div class="form-group mb-3" id="groupCustomLocation" style="display: none;">
                    <label class="font-weight-bold text-dark small text-uppercase">Nama Lokasi / Tempat Kegiatan</label>
                    <input type="text" class="form-control" id="location_name" name="location_name" placeholder="Misal: Masjid Nasional Al-Akbar / Ponpes / Tempat Pelatihan">
                  </div>

                  <!-- 6. Jenis Hewan Sembelihan -->
                  <div class="form-group mb-3">
                    <label class="font-weight-bold text-dark small text-uppercase d-block">
                      <i class="fas fa-paw text-success mr-1"></i> Jenis Sembelihan / Objek Praktik <span class="text-danger">*</span>
                    </label>
                    <label>
                      <input type="radio" name="animal_type" value="Sapi" checked class="d-none">
                      <span class="animal-radio-badge"><i class="fas fa-check-circle mr-1"></i> Sapi</span>
                    </label>
                    <label>
                      <input type="radio" name="animal_type" value="Kambing / Domba" class="d-none">
                      <span class="animal-radio-badge"><i class="fas fa-check-circle mr-1"></i> Kambing / Domba</span>
                    </label>
                    <label>
                      <input type="radio" name="animal_type" value="Unggas" class="d-none">
                      <span class="animal-radio-badge"><i class="fas fa-check-circle mr-1"></i> Unggas / Ayam</span>
                    </label>
                    <label>
                      <input type="radio" name="animal_type" value="Pelatihan Umum" class="d-none">
                      <span class="animal-radio-badge"><i class="fas fa-check-circle mr-1"></i> Pelatihan / Uji Kompetensi</span>
                    </label>
                  </div>

                  <!-- 7. Keterangan / Catatan Evaluasi -->
                  <div class="form-group mb-4">
                    <label class="font-weight-bold text-dark small text-uppercase">
                      <i class="fas fa-sticky-note text-success mr-1"></i> Keterangan / Catatan Praktik
                    </label>
                    <textarea class="form-control" id="description" name="description" rows="2" 
                              placeholder="Misal: Potong 3 saluran leher sempurna, uji pisau lancar, lulus praktik"></textarea>
                  </div>

                  <!-- Submit Action Button -->
                  <button type="submit" class="btn btn-submit-presensi btn-block" id="btnSubmitPresensi">
                    <i class="fas fa-save mr-2"></i> Simpan Presensi Praktik
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
<!-- HTML5 QR Code Scanner Library -->
<script src="/assets/juleha/html5-qrcode.min.js"></script>

<script>
let html5QrCode = null;
let isScanning = false;
let currentFacingMode = "environment"; // default kamera belakang

// Play audio beep sound using Web Audio API on successful scan
function playBeep() {
  try {
    const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    const osc = audioCtx.createOscillator();
    const gain = audioCtx.createGain();
    osc.type = "sine";
    osc.frequency.setValueAtTime(880, audioCtx.currentTime); // 880Hz (A5)
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

// Start live camera QR scanner
function startCamera() {
  if (isScanning) return;

  $('#cameraPlaceholder').hide();
  $('#scannerOverlay').show();
  $('#cameraStatusBadge').text('Kamera Aktif').removeClass('badge-light badge-danger').addClass('badge-success');
  $('#btnStopCamera').show();
  $('#btnSwitchCamera').show();

  if (!html5QrCode) {
    html5QrCode = new Html5Qrcode("reader");
  }

  const config = {
    fps: 10,
    qrbox: { width: 220, height: 220 },
    aspectRatio: 1.0
  };

  html5QrCode.start(
    { facingMode: currentFacingMode },
    config,
    onScanSuccess,
    onScanFailure
  ).then(() => {
    isScanning = true;
  }).catch(err => {
    console.error("Camera start error:", err);
    $('#cameraStatusBadge').text('Kamera Error').removeClass('badge-success').addClass('badge-danger');
    $('#cameraPlaceholder').show().html(`
      <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2"></i>
      <p class="small text-white mb-2">Gagal mengakses kamera.<br>Pastikan izin kamera di browser telah diizinkan.</p>
      <button class="btn btn-sm btn-outline-light" onclick="startCamera()"><i class="fas fa-redo mr-1"></i> Coba Lagi</button>
    `);
    $('#scannerOverlay').hide();
    $('#btnStopCamera').hide();
    $('#btnSwitchCamera').hide();
  });
}

// Stop live camera
function stopCamera() {
  if (html5QrCode && isScanning) {
    html5QrCode.stop().then(() => {
      isScanning = false;
      $('#scannerOverlay').hide();
      $('#cameraPlaceholder').show();
      $('#cameraStatusBadge').text('Kamera Dimatikan').removeClass('badge-success').addClass('badge-light');
      $('#btnStopCamera').hide();
      $('#btnSwitchCamera').hide();
    }).catch(err => {
      console.error("Camera stop error:", err);
    });
  }
}

// Switch between front and back camera
$('#btnSwitchCamera').on('click', function() {
  currentFacingMode = (currentFacingMode === "environment") ? "user" : "environment";
  if (isScanning && html5QrCode) {
    html5QrCode.stop().then(() => {
      isScanning = false;
      startCamera();
    });
  }
});

// Scan success callback
function onScanSuccess(decodedText, decodedResult) {
  playBeep();
  console.log("QR Code Scanned:", decodedText);

  // Extract Juleha ID (Format: 3 letters + 6 digits, e.g. SBY220006)
  let cleanId = decodedText.trim();
  const match = cleanId.match(/([A-Za-z]{3}\d{6})/i);
  if (match) {
    cleanId = match[1].toUpperCase();
  }

  $('#juleha_id').val(cleanId);
  $('#scanFeedback').html(`
    <div class="alert alert-success py-2 px-3 small font-weight-bold mb-0">
      <i class="fas fa-check-circle mr-1"></i> Terdeteksi KTA: <strong>${cleanId}</strong>
    </div>
  `).show();

  // Load member info
  fetchMemberInfo(cleanId);
}

function onScanFailure(error) {
  // Silent frame scan miss
}

// Scan from file input
$('#qrFileInput').on('change', function(e) {
  if (e.target.files.length === 0) return;
  const imageFile = e.target.files[0];

  if (!html5QrCode) {
    html5QrCode = new Html5Qrcode("reader");
  }

  html5QrCode.scanFile(imageFile, true)
    .then(decodedText => {
      onScanSuccess(decodedText);
    })
    .catch(err => {
      alert("Tidak ditemukan QR Code yang valid pada gambar tersebut. Silakan coba gambar lain.");
    });
});

// Fetch member data via AJAX
function fetchMemberInfo(julehaId) {
  if (!julehaId) return;

  $('#btnCekAnggota').html('<i class="fas fa-spinner fa-spin mr-1"></i> Memuat...').prop('disabled', true);

  $.ajax({
    url: '/prakteks/get_member_ajax',
    type: 'GET',
    data: { juleha_id: julehaId },
    dataType: 'json',
    success: function(resp) {
      $('#btnCekAnggota').html('<i class="fas fa-search mr-1"></i> Cek Data').prop('disabled', false);
      if (resp.status) {
        $('#previewJulehaId').text('ID: ' + resp.juleha_id);
        $('#previewRegion').text(resp.region ? ('Wilayah: ' + resp.region) : 'Jawa Timur');
        $('#previewName').text(resp.name);
        $('#previewStatus').text(resp.mstatus ? resp.mstatus.toUpperCase() : 'AKTIF');
        $('#previewPraktikCnt').text(resp.total_praktikan || 0);
        $('#previewInstrukturCnt').text(resp.total_instruktur || 0);
        $('#previewPhoto').attr('src', resp.photo_url + '?t=' + new Date().getTime());
        $('#memberPreviewCard').slideDown(250);
      } else {
        $('#memberPreviewCard').slideUp(200);
        alert(resp.message || 'Anggota tidak ditemukan.');
      }
    },
    error: function() {
      $('#btnCekAnggota').html('<i class="fas fa-search mr-1"></i> Cek Data').prop('disabled', false);
      alert('Gagal menghubungi server.');
    }
  });
}

// Button check member manually
$('#btnCekAnggota').on('click', function() {
  const id = $('#juleha_id').val().trim();
  if (!id) {
    alert('Silakan masukkan ID Juleha terlebih dahulu.');
    return;
  }
  fetchMemberInfo(id);
});

// Enter key on Juleha ID triggers check
$('#juleha_id').on('keypress', function(e) {
  if (e.which === 13) {
    e.preventDefault();
    $('#btnCekAnggota').click();
  }
});

// Role switcher
function setRole(role) {
  $('#role').val(role);
  if (role === 'instruktur') {
    $('#btnRoleInstruktur').addClass('active btn-primary').removeClass('btn-outline-primary');
    $('#btnRolePraktikan').removeClass('active btn-success').addClass('btn-outline-success');
    $('#groupInstructor').slideUp(200);
  } else {
    $('#btnRolePraktikan').addClass('active btn-success').removeClass('btn-outline-success');
    $('#btnRoleInstruktur').removeClass('active btn-primary').addClass('btn-outline-primary');
    $('#groupInstructor').slideDown(200);
  }
}

// Location custom toggle
function checkLocationInput() {
  const val = $('#rph_id').val();
  if (val === 'custom') {
    $('#groupCustomLocation').slideDown(200);
    $('#location_name').prop('required', true).focus();
  } else {
    $('#groupCustomLocation').slideUp(200);
    $('#location_name').prop('required', false);
  }
}

// Handle Form Submit
$('#formPresensi').on('submit', function(e) {
  e.preventDefault();

  const julehaId = $('#juleha_id').val().trim();
  if (!julehaId) {
    alert('ID Juleha anggota wajib diisi atau di-scan!');
    return;
  }

  const $btn = $('#btnSubmitPresensi');
  $btn.html('<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan Presensi...').prop('disabled', true);

  $.ajax({
    url: '/prakteks/save_attendance_ajax',
    type: 'POST',
    data: $(this).serialize(),
    dataType: 'json',
    success: function(resp) {
      $btn.html('<i class="fas fa-save mr-2"></i> Simpan Presensi Praktik').prop('disabled', false);
      if (resp.status) {
        alert(resp.message);
        
        // Reset form for next scan
        $('#juleha_id').val('');
        $('#description').val('');
        $('#memberPreviewCard').slideUp(200);
        $('#scanFeedback').html(`
          <div class="alert alert-success py-2 px-3 small font-weight-bold mb-0">
            <i class="fas fa-check-double mr-1"></i> Presensi berhasil disimpan! Siap scan kartu berikutnya.
          </div>
        `).show();

        // Refresh member counters if camera is running
      } else {
        alert(resp.message || 'Gagal menyimpan data.');
      }
    },
    error: function() {
      $btn.html('<i class="fas fa-save mr-2"></i> Simpan Presensi Praktik').prop('disabled', false);
      alert('Terjadi kesalahan jaringan atau server saat menyimpan data.');
    }
  });
});

// Auto check if prefill_id is present
$(document).ready(function() {
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
