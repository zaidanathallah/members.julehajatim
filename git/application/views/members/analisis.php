<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title ?? 'Analisis & Statistik Keanggotaan Juleha Jatim'; ?></title>

  <!-- Google Font: Poppins & Source Sans Pro -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/adminlte/dist/css/adminlte.min.css">

  <style>
    * {
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    .kpi-card {
      border-radius: 14px;
      overflow: hidden;
      border: 1px solid rgba(0,0,0,0.06);
      box-shadow: 0 4px 15px rgba(0,0,0,0.04);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .kpi-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }
    .kpi-card .inner {
      padding: 20px 22px;
    }
    .kpi-card h3 {
      font-size: 2.1rem;
      font-weight: 700;
      margin-bottom: 4px;
    }
    .kpi-card p {
      font-size: 0.9rem;
      font-weight: 500;
      margin-bottom: 0;
      opacity: 0.9;
    }
    .kpi-card .icon {
      top: 15px;
      right: 20px;
      opacity: 0.25;
      font-size: 65px;
    }
    .chart-card {
      border-radius: 14px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
      border: 1px solid #e2e8f0;
    }
    .table-rekap th {
      background-color: #f8fafc;
      font-size: 0.84rem;
      font-weight: 600;
      color: #334155;
    }
    .table-rekap td {
      font-size: 0.86rem;
      vertical-align: middle;
    }
    .badge-percent {
      font-size: 0.78rem;
      padding: 3px 8px;
      border-radius: 6px;
      font-weight: 600;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0 shadow-sm">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/members/index" class="nav-link font-weight-bold">Daftar Anggota</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/members/analisis" class="nav-link active text-primary font-weight-bold">Analisis Keanggotaan</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto d-flex flex-row align-items-center">
      <li class="nav-item mr-2">
        <a href="/members/cetak_analisis" target="_blank" class="btn btn-danger btn-sm rounded shadow-sm font-weight-bold px-3">
          <i class="fas fa-file-pdf mr-1"></i> Export Laporan PDF
        </a>
      </li>
      <li class="nav-item">
        <a href="/members/index" class="btn btn-outline-secondary btn-sm rounded shadow-sm font-weight-bold px-3">
          <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $this->load->view('common/sidemenu')?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header pb-2">
      <div class="container-fluid">
        <div class="row mb-2 align-items-center">
          <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold text-dark" style="font-size: 1.55rem;">
              <i class="fas fa-chart-line text-success mr-2"></i>Analisis & Statistik Keanggotaan
            </h1>
            <p class="text-muted mt-1 mb-0" style="font-size: 0.88rem;">
              Data analitik terintegrasi Juru Sembelih Halal (Juleha) Jawa Timur
            </p>
          </div>
          <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
            <a href="/members/cetak_analisis" target="_blank" class="btn btn-outline-danger btn-sm font-weight-bold shadow-sm">
              <i class="fas fa-print mr-1"></i> Cetak / Simpan PDF
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- 1. KPI SUMMARY CARDS -->
        <div class="row">
          <!-- Total Anggota -->
          <div class="col-lg-3 col-6 mb-3">
            <div class="small-box bg-gradient-primary kpi-card">
              <div class="inner">
                <h3><?php echo number_format($summary['total']); ?></h3>
                <p>Total Seluruh Anggota</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
            </div>
          </div>

          <!-- Anggota Aktif -->
          <div class="col-lg-3 col-6 mb-3">
            <div class="small-box bg-gradient-success kpi-card">
              <div class="inner">
                <h3><?php echo number_format($summary['active']); ?></h3>
                <p>Anggota Aktif (<?php echo $summary['pct_active']; ?>%)</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-check"></i>
              </div>
            </div>
          </div>

          <!-- Anggota Non-Aktif -->
          <div class="col-lg-3 col-6 mb-3">
            <div class="small-box bg-gradient-danger kpi-card">
              <div class="inner">
                <h3><?php echo number_format($summary['inactive']); ?></h3>
                <p>Non-Aktif (<?php echo $summary['pct_inactive']; ?>%)</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-times"></i>
              </div>
            </div>
          </div>

          <!-- Total Pelatihan & Kompetensi -->
          <div class="col-lg-3 col-6 mb-3">
            <div class="small-box bg-gradient-info kpi-card">
              <div class="inner">
                <h3><?php echo number_format($summary['trainings']); ?></h3>
                <p>Total Data Pelatihan</p>
              </div>
              <div class="icon">
                <i class="fas fa-graduation-cap"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- 2. CHARTS SECTION -->
        <div class="row">
          <!-- Donut Chart: Status Keaktifan -->
          <div class="col-lg-5 col-12 mb-4">
            <div class="card chart-card h-100">
              <div class="card-header bg-white border-bottom-0 pb-0">
                <h3 class="card-title font-weight-bold text-dark">
                  <i class="fas fa-chart-pie text-success mr-2"></i>Komposisi Status Anggota
                </h3>
              </div>
              <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <div style="position: relative; width: 100%; max-width: 280px; height: 260px;">
                  <canvas id="statusChart"></canvas>
                </div>
                <div class="mt-3 w-100">
                  <div class="d-flex justify-content-between align-items-center px-3 py-2 border rounded mb-2 bg-light">
                    <span><i class="fas fa-circle text-success mr-2"></i><strong>Anggota Aktif:</strong></span>
                    <span class="badge badge-success px-2 py-1"><?php echo number_format($summary['active']); ?> orang (<?php echo $summary['pct_active']; ?>%)</span>
                  </div>
                  <div class="d-flex justify-content-between align-items-center px-3 py-2 border rounded bg-light">
                    <span><i class="fas fa-circle text-danger mr-2"></i><strong>Tidak Aktif:</strong></span>
                    <span class="badge badge-danger px-2 py-1"><?php echo number_format($summary['inactive']); ?> orang (<?php echo $summary['pct_inactive']; ?>%)</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Bar Chart: 10 Daerah dengan Anggota Terbanyak -->
          <div class="col-lg-7 col-12 mb-4">
            <div class="card chart-card h-100">
              <div class="card-header bg-white border-bottom-0 pb-0 d-flex justify-content-between align-items-center">
                <h3 class="card-title font-weight-bold text-dark">
                  <i class="fas fa-map-marked-alt text-primary mr-2"></i>10 Wilayah dengan Anggota Terbanyak
                </h3>
                <span class="badge badge-primary px-2 py-1">Top Ranking</span>
              </div>
              <div class="card-body">
                <div style="position: relative; height: 320px; width: 100%;">
                  <canvas id="regionChart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- 3. DETAILED REGIONAL TABLE -->
        <div class="row">
          <div class="col-12 mb-4">
            <div class="card chart-card">
              <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h3 class="card-title font-weight-bold text-dark">
                  <i class="fas fa-table text-info mr-2"></i>Tabel Rekapitulasi Keanggotaan per Wilayah (Jawa Timur)
                </h3>
                <a href="/members/cetak_analisis" target="_blank" class="btn btn-outline-danger btn-sm font-weight-bold">
                  <i class="fas fa-file-pdf mr-1"></i> Cetak Laporan PDF
                </a>
              </div>
              <div class="card-body table-responsive p-0">
                <table id="tableRekap" class="table table-hover table-striped table-rekap mb-0 w-100">
                  <thead>
                    <tr>
                      <th class="text-center" style="width: 50px;">No</th>
                      <th>Kode</th>
                      <th>Nama Kabupaten / Kota</th>
                      <th class="text-center">Total Anggota</th>
                      <th class="text-center">Status Aktif</th>
                      <th class="text-center">Tidak Aktif</th>
                      <th class="text-center">Rasio Keaktifan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ($all_regions as $reg): 
                      $totalReg = (int)$reg['total'];
                      $activeReg = (int)$reg['active_count'];
                      $inactiveReg = (int)$reg['inactive_count'];
                      $ratio = $totalReg > 0 ? round(($activeReg / $totalReg) * 100, 1) : 0;
                    ?>
                    <tr>
                      <td class="text-center font-weight-bold text-muted"><?php echo $no++; ?></td>
                      <td><span class="badge badge-light border font-weight-bold"><?php echo htmlspecialchars($reg['region_code']); ?></span></td>
                      <td class="font-weight-bold text-dark"><?php echo htmlspecialchars($reg['region_name']); ?></td>
                      <td class="text-center">
                        <span class="badge badge-primary font-weight-bold px-2 py-1" style="font-size: 0.88rem;">
                          <?php echo number_format($totalReg); ?>
                        </span>
                      </td>
                      <td class="text-center text-success font-weight-bold">
                        <i class="fas fa-check-circle mr-1"></i><?php echo number_format($activeReg); ?>
                      </td>
                      <td class="text-center <?php echo $inactiveReg > 0 ? 'text-danger font-weight-bold' : 'text-muted'; ?>">
                        <?php echo $inactiveReg > 0 ? '<i class="fas fa-times-circle mr-1"></i>' . number_format($inactiveReg) : '-'; ?>
                      </td>
                      <td class="text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <div class="progress mr-2" style="flex-grow: 1; height: 6px; max-width: 90px; border-radius: 4px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $ratio; ?>%;"></div>
                          </div>
                          <span class="badge-percent bg-light border text-muted"><?php echo $ratio; ?>%</span>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
  </div>

  <footer class="main-footer text-sm">
    <div class="float-right d-none d-sm-inline">
      Sistem Informasi Manajemen Keanggotaan
    </div>
    <strong>&copy; 2021-2026 <a href="#">Juru Sembelih Halal (Juleha) Jawa Timur</a>.</strong> All rights reserved.
  </footer>
</div>

<!-- REQUIRED SCRIPTS -->
<script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/adminlte/plugins/chart.js/Chart.min.js"></script>
<script src="/assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/adminlte/dist/js/adminlte.min.js"></script>

<script>
  $(function () {
    // 1. DataTables untuk Rekapitulasi Daerah
    $('#tableRekap').DataTable({
      "paging": true,
      "pageLength": 10,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "language": {
        "search": "Cari Daerah:",
        "info": "Menampilkan _START_ - _END_ dari _TOTAL_ wilayah",
        "infoEmpty": "Tidak ada data",
        "paginate": { "previous": "‹", "next": "›" }
      }
    });

    // 2. Chart.js: Donut Chart Status Anggota
    var statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
      type: 'doughnut',
      data: {
        labels: ['Anggota Aktif', 'Tidak Aktif'],
        datasets: [{
          data: [<?php echo $summary['active']; ?>, <?php echo $summary['inactive']; ?>],
          backgroundColor: ['#059669', '#ef4444'],
          borderWidth: 2,
          borderColor: '#ffffff'
        }]
      },
      options: {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          display: true,
          position: 'bottom',
          labels: { boxWidth: 12, fontStyle: 'bold', fontSize: 11 }
        },
        cutoutPercentage: 70
      }
    });

    // 3. Chart.js: Horizontal Bar Chart Top 10 Wilayah Terbanyak
    var topLabels = <?php echo json_encode(array_column($top_regions, 'region_name')); ?>;
    var topCounts = <?php echo json_encode(array_map('intval', array_column($top_regions, 'total'))); ?>;

    var regionCtx = document.getElementById('regionChart').getContext('2d');
    new Chart(regionCtx, {
      type: 'horizontalBar',
      data: {
        labels: topLabels,
        datasets: [{
          label: 'Jumlah Anggota',
          data: topCounts,
          backgroundColor: '#059669',
          hoverBackgroundColor: '#047857',
          borderRadius: 6
        }]
      },
      options: {
        maintainAspectRatio: false,
        responsive: true,
        legend: { display: false },
        scales: {
          xAxes: [{
            gridLines: { color: '#f1f5f9' },
            ticks: { beginAtZero: true, fontStyle: 'bold', fontSize: 10 }
          }],
          yAxes: [{
            gridLines: { display: false },
            ticks: { fontStyle: 'bold', fontSize: 11, fontColor: '#1e293b' }
          }]
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
              return ' ' + tooltipItem.xLabel + ' Anggota';
            }
          }
        }
      }
    });
  });
</script>

</body>
</html>
