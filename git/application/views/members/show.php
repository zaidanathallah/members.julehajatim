<?php
// Bentuk Nama Lengkap Resmi
$firstName  = trim($obj->firstname ?? '');
$middleName = trim($obj->middlename ?? '');
$lastName   = trim($obj->lastname ?? '');
$nickName   = trim($obj->nickname ?? '');

if (!empty($firstName) && !empty($lastName)) {
    if (strcasecmp($firstName, $lastName) === 0) {
        $fullName = $firstName;
    } else if (stripos($firstName, $lastName) !== false) {
        $fullName = $firstName;
    } else if (stripos($lastName, $firstName) !== false) {
        $fullName = $lastName;
    } else {
        $fullName = !empty($middleName) ? ($firstName . ' ' . $middleName . ' ' . $lastName) : ($firstName . ' ' . $lastName);
    }
} else if (!empty($firstName)) {
    $fullName = !empty($middleName) ? ($firstName . ' ' . $middleName) : $firstName;
} else if (!empty($lastName)) {
    $fullName = $lastName;
} else if (!empty($nickName)) {
    $fullName = $nickName;
} else {
    $fullName = $obj->juleha_id ?? 'ANGGOTA';
}

$fullName = preg_replace('/\s+/', ' ', trim($fullName));
$displayName = strtoupper($fullName);
$is_admin = !empty($is_admin);
$is_instructor = !empty($is_instructor);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Verifikasi Anggota - <?php echo htmlspecialchars($displayName, ENT_QUOTES, 'UTF-8'); ?> - Juleha Jatim</title>

  <!-- Google Font: Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/adminlte/dist/css/adminlte.min.css">

  <style>
    * {
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    body {
      background-color: #f8fafc;
      color: #1e293b;
      min-height: 100vh;
      padding-bottom: 40px;
    }
    .profile-card {
      background: #ffffff;
      border-radius: 16px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
      overflow: hidden;
      margin-bottom: 24px;
    }
    .profile-card-top-bar {
      height: 6px;
      background: linear-gradient(90deg, #064e3b 0%, #059669 100%);
    }
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
    }
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
    }
    .info-value {
      font-size: 0.95rem;
      font-weight: 600;
      color: #1e293b;
    }
    .btn-action-praktek {
      background: linear-gradient(135deg, #064e3b 0%, #059669 100%);
      color: #ffffff !important;
      font-weight: 600;
      border: none;
      border-radius: 12px;
      padding: 12px 20px;
      box-shadow: 0 4px 14px rgba(5, 150, 105, 0.3);
      transition: all 0.2s;
    }
    .btn-action-praktek:hover {
      background: linear-gradient(135deg, #043f30 0%, #047857 100%);
      transform: translateY(-1px);
      box-shadow: 0 6px 18px rgba(5, 150, 105, 0.4);
    }
    .badge-instructor-official {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      color: #92400e;
      border: 1.5px solid #f59e0b;
      padding: 8px 16px;
      border-radius: 30px;
      font-size: 0.9rem;
      font-weight: 700;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      box-shadow: 0 2px 8px rgba(245, 158, 11, 0.2);
    }
    .banner-praktek {
      background: #f0fdf4;
      border: 1.5px solid #86efac;
      border-radius: 14px;
      padding: 18px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

  <!-- Top Navbar -->
  <nav class="navbar navbar-expand navbar-white navbar-light border-bottom bg-white shadow-sm mb-4">
    <div class="container">
      <a class="navbar-brand font-weight-bold" href="/" style="color: #064e3b;">
        <i class="fas fa-certificate text-success mr-2"></i> Juleha Jawa Timur
      </a>
      <ul class="navbar-nav ml-auto">
        <?php if (!empty($logged_id)): ?>
          <li class="nav-item">
            <a href="/members/profile" class="btn btn-outline-success btn-sm font-weight-bold rounded-pill px-3 mr-2">
              <i class="fas fa-user-circle mr-1"></i> Profil Saya
            </a>
          </li>
          <li class="nav-item">
            <a href="/members/logout" class="btn btn-outline-danger btn-sm font-weight-bold rounded-pill px-3">
              <i class="fas fa-sign-out-alt mr-1"></i> Keluar
            </a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a href="/members/login" class="btn btn-success btn-sm font-weight-bold rounded-pill px-4">
              <i class="fas fa-sign-in-alt mr-1"></i> Login Anggota
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">

        <!-- Banner Presensi & Evaluasi Praktik di RPH (TOW & Kedurus) -->
        <div class="banner-praktek shadow-sm">
          <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap: 14px;">
            <div>
              <div class="d-flex align-items-center mb-1">
                <span class="badge badge-success px-2 py-1 mr-2 font-weight-bold">RPH RESMI</span>
                <strong style="color: #064e3b; font-size: 1.05rem;">Presensi & Evaluasi Praktik Sembelih</strong>
              </div>
              <p class="small text-muted mb-0">
                Penyelenggaraan praktik resmi di <strong>RPH TOW</strong> & <strong>RPH Kedurus</strong> Juleha Jawa Timur.
              </p>
            </div>
            <div>
              <a href="<?php echo base_url('prakteks/scan/' . rawurlencode($juleha_id)); ?>" class="btn btn-action-praktek">
                <i class="fas fa-clipboard-check mr-2"></i> Buka Form Evaluasi Praktik
              </a>
            </div>
          </div>
        </div>

        <!-- Main Profile Summary Card -->
        <div class="profile-card text-center p-4">
          <div class="profile-card-top-bar" style="margin: -24px -24px 20px -24px;"></div>

          <div class="avatar-wrapper">
            <img class="profile-avatar-img"
                 src="/images/<?php echo htmlspecialchars($juleha_id, ENT_QUOTES, 'UTF-8'); ?>.jpg?t=<?php echo time(); ?>"
                 alt="Foto Anggota"
                 onerror="this.onerror=null;this.src='/assets/adminlte/dist/img/avatar5.png';">
          </div>

          <h3 class="font-weight-bold mb-1" style="color: #0f172a; font-size: 1.35rem;">
            <?php echo htmlspecialchars($displayName, ENT_QUOTES, 'UTF-8'); ?>
          </h3>

          <div class="mb-2">
            <span class="badge-id">
              <i class="fas fa-id-badge text-success mr-1"></i> ID: <?php echo htmlspecialchars($juleha_id, ENT_QUOTES, 'UTF-8'); ?>
            </span>
          </div>

          <!-- Pengakuan Khusus Jika Instruktur Resmi -->
          <?php if ($is_instructor): ?>
            <div class="mb-3">
              <span class="badge-instructor-official">
                <i class="fas fa-award text-warning"></i> INSTRUKTUR RESMI JULEHA JATIM
              </span>
            </div>
          <?php endif; ?>

          <div class="mb-4">
            <?php if (strtolower($obj->mstatus ?? 'aktif') === 'aktif'): ?>
              <span class="badge-status-active">
                <i class="fas fa-check-circle mr-1"></i> Anggota Terverifikasi Aktif
              </span>
            <?php else: ?>
              <span class="badge badge-secondary px-3 py-1 font-weight-bold">
                Status: <?php echo htmlspecialchars($obj->mstatus ?? 'Non-Aktif', ENT_QUOTES, 'UTF-8'); ?>
              </span>
            <?php endif; ?>
          </div>

          <!-- Quick Actions -->
          <div class="d-flex flex-wrap justify-content-center" style="gap: 10px;">
            <a href="<?php echo base_url('members/showcard/' . rawurlencode($juleha_id)); ?>" class="btn btn-outline-success font-weight-bold px-3 py-2" style="border-radius: 10px;">
              <i class="fas fa-id-card mr-1"></i> Lihat Kartu KTA Resmi
            </a>

            <a href="<?php echo base_url('prakteks/scan/' . rawurlencode($juleha_id)); ?>" class="btn btn-success font-weight-bold px-3 py-2" style="border-radius: 10px;">
              <i class="fas fa-qrcode mr-1"></i> Input / Scan Presensi Praktik
            </a>

            <!-- Tombol Download KTA HANYA DITAMPILKAN UNTUK ADMIN / DEVELOPER -->
            <?php if ($is_admin): ?>
              <a href="<?php echo base_url('members/showcard/' . rawurlencode($juleha_id)); ?>" class="btn btn-primary font-weight-bold px-3 py-2" style="border-radius: 10px;">
                <i class="fas fa-download mr-1"></i> Download KTA (Admin)
              </a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Detail Informasi Anggota Box -->
        <div class="profile-card p-4">
          <h5 class="font-weight-bold mb-3" style="color: #064e3b; font-size: 1.05rem;">
            <i class="fas fa-info-circle text-success mr-2"></i> Data Keanggotaan Terdaftar
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
            <div class="info-icon"><i class="fas fa-cut"></i></div>
            <div>
              <div class="info-label">Riwayat Praktik Sembelih (RPH TOW / Kedurus)</div>
              <div class="info-value">
                <?php echo (int)($praktek_info['count_praktikan'] ?? 0); ?> kali sebagai Praktikan
                <?php if (!empty($praktek_info['count_instruktur'])): ?>
                  &bull; <?php echo (int)$praktek_info['count_instruktur']; ?> kali sebagai Instruktur
                <?php endif; ?>
              </div>
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
    </div>
  </div>

  <footer class="text-center text-muted small mt-4">
    <strong>Copyright &copy; 2021-2026 <a href="https://julehajatim.com" class="text-success font-weight-bold">Juru Sembelih Halal (Juleha) Jawa Timur</a>.</strong>
    Semua hak dilindungi.
  </footer>

  <!-- Scripts -->
  <script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>
  <script src="/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
