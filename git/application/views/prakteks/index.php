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
    .badge-animal {
      background-color: #f1f5f9;
      color: #334155;
      border: 1px solid #cbd5e1;
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 0.78rem;
      font-weight: 500;
    }
    .member-thumb {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 10px;
      border: 2px solid #e2e8f0;
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
            <p class="text-muted small m-0 mt-1">Data Riwayat Praktik Penyembelihan & Instruktur Juleha Jawa Timur</p>
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

        <!-- Filter Card -->
        <div class="card-modern p-3 mb-4">
          <form method="GET" action="<?php echo base_url('prakteks/index'); ?>" class="row align-items-end">
            <div class="col-md-3 col-6 mb-2">
              <label class="small text-muted font-weight-bold text-uppercase mb-1">Peran</label>
              <select name="role" class="form-control form-control-sm">
                <option value="">-- Semua Peran --</option>
                <option value="praktikan" <?php echo ($filters['role'] === 'praktikan') ? 'selected' : ''; ?>>Praktikan</option>
                <option value="instruktur" <?php echo ($filters['role'] === 'instruktur') ? 'selected' : ''; ?>>Instruktur</option>
              </select>
            </div>
            <div class="col-md-2 col-6 mb-2">
              <label class="small text-muted font-weight-bold text-uppercase mb-1">Jenis Hewan</label>
              <select name="animal_type" class="form-control form-control-sm">
                <option value="">-- Semua Hewan --</option>
                <option value="Sapi" <?php echo ($filters['animal_type'] === 'Sapi') ? 'selected' : ''; ?>>Sapi</option>
                <option value="Kambing / Domba" <?php echo ($filters['animal_type'] === 'Kambing / Domba') ? 'selected' : ''; ?>>Kambing / Domba</option>
                <option value="Unggas" <?php echo ($filters['animal_type'] === 'Unggas') ? 'selected' : ''; ?>>Unggas</option>
                <option value="Pelatihan Umum" <?php echo ($filters['animal_type'] === 'Pelatihan Umum') ? 'selected' : ''; ?>>Pelatihan / Uji</option>
              </select>
            </div>
            <div class="col-md-3 col-6 mb-2">
              <label class="small text-muted font-weight-bold text-uppercase mb-1">Lokasi / RPH</label>
              <select name="rph_id" class="form-control form-control-sm">
                <option value="">-- Semua Lokasi RPH --</option>
                <option value="1" <?php echo ($filters['rph_id'] == '1') ? 'selected' : ''; ?>>Pegirian (Surabaya)</option>
                <option value="2" <?php echo ($filters['rph_id'] == '2') ? 'selected' : ''; ?>>Kedurus (Surabaya)</option>
                <option value="3" <?php echo ($filters['rph_id'] == '3') ? 'selected' : ''; ?>>Kambing Kota (Surabaya)</option>
                <option value="4" <?php echo ($filters['rph_id'] == '4') ? 'selected' : ''; ?>>Krian Tradisional (Sidoarjo)</option>
                <option value="5" <?php echo ($filters['rph_id'] == '5') ? 'selected' : ''; ?>>Krian Modern (Sidoarjo)</option>
                <option value="7" <?php echo ($filters['rph_id'] == '7') ? 'selected' : ''; ?>>Malang</option>
              </select>
            </div>
            <div class="col-md-2 col-6 mb-2">
              <label class="small text-muted font-weight-bold text-uppercase mb-1">Tahun</label>
              <select name="year" class="form-control form-control-sm">
                <option value="">-- Semua Tahun --</option>
                <?php for($y = (int)date('Y'); $y >= 2020; $y--): ?>
                  <option value="<?php echo $y; ?>" <?php echo ($filters['year'] == $y) ? 'selected' : ''; ?>><?php echo $y; ?></option>
                <?php endfor; ?>
              </select>
            </div>
            <div class="col-md-2 col-12 mb-2 d-flex" style="gap: 6px;">
              <button type="submit" class="btn btn-success btn-sm flex-fill font-weight-bold">
                <i class="fas fa-filter mr-1"></i> Filter
              </button>
              <a href="<?php echo base_url('prakteks/index'); ?>" class="btn btn-outline-secondary btn-sm" title="Reset Filter">
                <i class="fas fa-redo"></i>
              </a>
            </div>
          </form>
        </div>

        <!-- Main Table Card -->
        <div class="card-modern">
          <div class="card-header-juleha d-flex flex-wrap align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold"><i class="fas fa-list mr-2"></i> Riwayat Sesi Praktik & Instruktur</h5>
            <div class="mt-2 mt-sm-0">
              <a href="<?php echo base_url('prakteks/scan'); ?>" class="btn btn-light btn-sm font-weight-bold text-success mr-2">
                <i class="fas fa-plus-circle mr-1"></i> Tambah Presensi Baru
              </a>
              <a href="<?php echo base_url('prakteks/rekap_anggota'); ?>" class="btn btn-outline-light btn-sm font-weight-bold">
                <i class="fas fa-chart-bar mr-1"></i> Rekap Tiap Anggota
              </a>
            </div>
          </div>
          <div class="card-body p-3">
            <div class="table-responsive">
              <table id="tablePraktik" class="table table-hover table-striped align-middle mb-0" style="width:100%">
                <thead class="bg-light">
                  <tr>
                    <th style="width: 40px;">No</th>
                    <th>Waktu / Tanggal</th>
                    <th>Anggota / Peserta</th>
                    <th>Peran</th>
                    <th>Instruktur Pembimbing</th>
                    <th>Lokasi RPH / Tempat</th>
                    <th>Objek Praktik</th>
                    <th>Catatan / Keterangan</th>
                    <th style="width: 80px;" class="text-center">Aksi</th>
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
                  ?>
                    <tr>
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
                            <small class="badge badge-light border"><?php echo htmlspecialchars($r->juleha_id); ?></small>
                            <?php if (!empty($r->member_region)): ?>
                              <small class="text-muted ml-1">(<?php echo htmlspecialchars($r->member_region); ?>)</small>
                            <?php endif; ?>
                          </div>
                        </div>
                      </td>
                      <td>
                        <?php if (($r->role ?? '') === 'instruktur'): ?>
                          <span class="badge-role-instruktur"><i class="fas fa-chalkboard-teacher mr-1"></i> Instruktur</span>
                        <?php else: ?>
                          <span class="badge-role-praktikan"><i class="fas fa-cut mr-1"></i> Praktikan</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php if (!empty($r->instructor_id) || $inst_name !== '-'): ?>
                          <span class="font-weight-500 text-dark"><?php echo htmlspecialchars($inst_name); ?></span>
                          <?php if (!empty($r->instructor_id)): ?>
                            <small class="text-muted d-block"><?php echo htmlspecialchars($r->instructor_id); ?></small>
                          <?php endif; ?>
                        <?php else: ?>
                          <span class="text-muted">-</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <span class="font-weight-500 text-dark"><i class="fas fa-map-marker-alt text-danger mr-1"></i> <?php echo htmlspecialchars($r->effective_location ?? 'RPH Jatim'); ?></span>
                      </td>
                      <td>
                        <span class="badge-animal"><i class="fas fa-tag mr-1"></i> <?php echo htmlspecialchars($r->animal_type ?? 'Sapi'); ?></span>
                      </td>
                      <td>
                        <small class="text-muted"><?php echo htmlspecialchars($r->description ?? '-'); ?></small>
                      </td>
                      <td class="text-center">
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

<script>
$(document).ready(function() {
  $('#tablePraktik').DataTable({
    "responsive": true,
    "lengthChange": true,
    "autoWidth": false,
    "ordering": false,
    "pageLength": 25,
    "buttons": [
      { extend: "copy", text: "<i class='fas fa-copy mr-1'></i> Copy" },
      { extend: "csv", text: "<i class='fas fa-file-csv mr-1'></i> CSV" },
      { extend: "excel", text: "<i class='fas fa-file-excel mr-1'></i> Excel" },
      { extend: "pdf", text: "<i class='fas fa-file-pdf mr-1'></i> PDF" },
      { extend: "print", text: "<i class='fas fa-print mr-1'></i> Cetak" },
      { extend: "colvis", text: "Kolom" }
    ]
  }).buttons().container().appendTo('#tablePraktik_wrapper .col-md-6:eq(0)');
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
