<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title ?? 'Rekapitulasi Praktik per Anggota - Juleha Jawa Timur'; ?></title>

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
    .member-thumb {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 12px;
      border: 2px solid #10b981;
    }
    .badge-count-green {
      background: #ecfdf5;
      color: #059669;
      border: 1px solid #a7f3d0;
      padding: 5px 12px;
      border-radius: 20px;
      font-weight: 700;
      font-size: 0.9rem;
    }
    .badge-count-blue {
      background: #eff6ff;
      color: #2563eb;
      border: 1px solid #bfdbfe;
      padding: 5px 12px;
      border-radius: 20px;
      font-weight: 700;
      font-size: 0.9rem;
    }
    .badge-count-total {
      background: #f8fafc;
      color: #0f172a;
      border: 1px solid #cbd5e1;
      padding: 5px 14px;
      border-radius: 20px;
      font-weight: 700;
      font-size: 0.95rem;
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
        <a href="<?php echo base_url('prakteks/index'); ?>" class="nav-link font-weight-500">Riwayat Praktik</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('prakteks/rekap_anggota'); ?>" class="nav-link font-weight-500 active text-success font-weight-bold">Rekap per Anggota</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="<?php echo base_url('prakteks/scan'); ?>" class="btn btn-success btn-sm rounded shadow-sm font-weight-bold px-3 mr-2">
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
              <i class="fas fa-users-cog text-success mr-2"></i> Rekapitulasi Jam Terbang Praktik per Anggota
            </h1>
            <p class="text-muted small m-0 mt-1">Daftar Jumlah Keikutsertaan Praktik Penyembelihan & Penugasan Instruktur Juleha Jatim</p>
          </div>
          <div class="col-sm-6 mt-2 mt-sm-0">
            <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>" class="text-success">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('prakteks/index'); ?>" class="text-success">Praktik</a></li>
              <li class="breadcrumb-item active text-muted">Rekap Anggota</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <section class="content mt-3">
      <div class="container-fluid">

        <!-- Main Card -->
        <div class="card-modern">
          <div class="card-header-juleha d-flex flex-wrap align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold"><i class="fas fa-medal mr-2"></i> Rekap Jam Terbang Praktik Anggota</h5>
            <div class="mt-2 mt-sm-0">
              <a href="<?php echo base_url('prakteks/scan'); ?>" class="btn btn-light btn-sm font-weight-bold text-success mr-2">
                <i class="fas fa-qrcode mr-1"></i> Scan Presensi KTA
              </a>
              <a href="<?php echo base_url('prakteks/index'); ?>" class="btn btn-outline-light btn-sm font-weight-bold">
                <i class="fas fa-list mr-1"></i> Lihat Semua Riwayat
              </a>
            </div>
          </div>
          <div class="card-body p-3">
            <div class="table-responsive">
              <table id="tableRekap" class="table table-hover table-striped align-middle mb-0" style="width:100%">
                <thead class="bg-light">
                  <tr>
                    <th style="width: 40px;" class="text-center">No</th>
                    <th>Nama Anggota & ID Juleha</th>
                    <th>Daerah / Wilayah</th>
                    <th class="text-center">Sebagai Praktikan</th>
                    <th class="text-center">Sebagai Instruktur</th>
                    <th class="text-center">Total Jam Terbang</th>
                    <th>Praktik Terakhir</th>
                    <th style="width: 130px;" class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $bulan_id = array(1=>'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
                  if (!empty($members)): 
                    $no = 1;
                    foreach ($members as $m): 
                      $full_name = trim(($m->firstname ?? '') . ' ' . ($m->lastname ?? ''));
                      if (empty($full_name)) {
                        $full_name = $m->nickname ?? $m->juleha_id;
                      }

                      $last_str = '-';
                      if (!empty($m->last_date)) {
                        $ts = strtotime($m->last_date);
                        if ($ts > 0) {
                          $last_str = date('d', $ts) . ' ' . ($bulan_id[(int)date('m', $ts)] ?? '') . ' ' . date('Y', $ts);
                        }
                      }
                  ?>
                    <tr>
                      <td class="text-center font-weight-bold"><?php echo $no++; ?></td>
                      <td>
                        <div class="d-flex align-items-center">
                          <img src="/images/<?php echo htmlspecialchars($m->juleha_id); ?>.jpg" 
                               onerror="this.onerror=null;this.src='/assets/adminlte/dist/img/avatar5.png';"
                               class="member-thumb" alt="Foto">
                          <div>
                            <div class="font-weight-bold text-dark" style="font-size: 1rem;">
                              <?php echo htmlspecialchars($full_name); ?>
                            </div>
                            <span class="badge badge-success px-2 py-1 font-weight-bold">
                              ID: <?php echo htmlspecialchars($m->juleha_id); ?>
                            </span>
                          </div>
                        </div>
                      </td>
                      <td>
                        <span class="badge badge-light border font-weight-500">
                          <i class="fas fa-map-marker-alt text-success mr-1"></i> <?php echo htmlspecialchars($m->region ?? 'Jawa Timur'); ?>
                        </span>
                      </td>
                      <td class="text-center">
                        <span class="badge-count-green">
                          <i class="fas fa-cut mr-1"></i> <?php echo (int)($m->total_praktikan ?? 0); ?> kali
                        </span>
                      </td>
                      <td class="text-center">
                        <span class="badge-count-blue">
                          <i class="fas fa-chalkboard-teacher mr-1"></i> <?php echo (int)($m->total_instruktur ?? 0); ?> kali
                        </span>
                      </td>
                      <td class="text-center">
                        <span class="badge-count-total">
                          <?php echo (int)($m->total_aktivitas ?? 0); ?> kali
                        </span>
                      </td>
                      <td>
                        <small class="text-muted"><i class="far fa-calendar-alt mr-1"></i><?php echo $last_str; ?></small>
                      </td>
                      <td class="text-center">
                        <a href="<?php echo base_url('prakteks/my_history/' . rawurlencode($m->juleha_id)); ?>" 
                           class="btn btn-outline-success btn-sm font-weight-bold mr-1" title="Lihat Riwayat Praktik Lengkap">
                          <i class="fas fa-history mr-1"></i> Detail
                        </a>
                        <a href="<?php echo base_url('prakteks/scan/' . rawurlencode($m->juleha_id)); ?>" 
                           class="btn btn-outline-primary btn-sm font-weight-bold" title="Input Presensi untuk Anggota Ini">
                          <i class="fas fa-plus"></i>
                        </a>
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
  $('#tableRekap').DataTable({
    "responsive": true,
    "lengthChange": true,
    "autoWidth": false,
    "ordering": true,
    "order": [[5, "desc"]], // Urutkan berdasarkan total jam terbang
    "pageLength": 25,
    "buttons": [
      { extend: "copy", text: "<i class='fas fa-copy mr-1'></i> Copy" },
      { extend: "csv", text: "<i class='fas fa-file-csv mr-1'></i> CSV" },
      { extend: "excel", text: "<i class='fas fa-file-excel mr-1'></i> Excel" },
      { extend: "pdf", text: "<i class='fas fa-file-pdf mr-1'></i> PDF" },
      { extend: "print", text: "<i class='fas fa-print mr-1'></i> Cetak" }
    ]
  }).buttons().container().appendTo('#tableRekap_wrapper .col-md-6:eq(0)');
});
</script>

</body>
</html>
