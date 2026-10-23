<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title ?? 'Laporan Statistik Keanggotaan Juleha Jawa Timur'; ?></title>

  <!-- Google Font: Poppins & Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/adminlte/plugins/fontawesome-free/css/all.min.css">

  <style>
    * {
      box-sizing: border-box;
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    body {
      background-color: #f1f5f9;
      margin: 0;
      padding: 24px;
      color: #1e293b;
      font-size: 11pt;
    }

    .report-sheet {
      background: #ffffff;
      width: 100%;
      max-width: 900px;
      margin: 0 auto;
      padding: 40px 45px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border-radius: 8px;
    }

    /* KOP SURAT */
    .kop-surat {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 3px double #064e3b;
      padding-bottom: 14px;
      margin-bottom: 24px;
    }

    .kop-logo {
      width: 85px;
      height: 85px;
      object-fit: contain;
    }

    .kop-text {
      text-align: center;
      flex: 1;
      padding: 0 15px;
    }

    .kop-text h2 {
      font-size: 15pt;
      font-weight: 700;
      color: #064e3b;
      margin: 0 0 2px 0;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }

    .kop-text h1 {
      font-size: 18pt;
      font-weight: 800;
      color: #059669;
      margin: 0 0 4px 0;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .kop-text p {
      font-size: 9pt;
      color: #475569;
      margin: 0;
      line-height: 1.4;
    }

    /* REPORT TITLE */
    .report-title-box {
      text-align: center;
      margin-bottom: 24px;
    }

    .report-title {
      font-size: 14pt;
      font-weight: 700;
      color: #0f172a;
      text-transform: uppercase;
      margin: 0 0 4px 0;
      text-decoration: underline;
    }

    .report-subtitle {
      font-size: 9.5pt;
      color: #64748b;
      margin: 0;
    }

    /* KPI BOXES */
    .kpi-row {
      display: flex;
      gap: 12px;
      margin-bottom: 24px;
    }

    .kpi-box {
      flex: 1;
      border: 1px solid #cbd5e1;
      border-radius: 6px;
      padding: 12px 14px;
      text-align: center;
      background: #f8fafc;
    }

    .kpi-box.active {
      border-top: 4px solid #059669;
      background: #f0fdf4;
    }

    .kpi-box.inactive {
      border-top: 4px solid #ef4444;
      background: #fef2f2;
    }

    .kpi-box.total {
      border-top: 4px solid #0284c7;
      background: #f0f9ff;
    }

    .kpi-val {
      font-size: 17pt;
      font-weight: 700;
      color: #0f172a;
      line-height: 1.1;
      margin-bottom: 3px;
    }

    .kpi-lbl {
      font-size: 8.5pt;
      font-weight: 600;
      color: #64748b;
      text-transform: uppercase;
    }

    /* TABLES */
    .section-heading {
      font-size: 11pt;
      font-weight: 700;
      color: #064e3b;
      margin: 20px 0 10px 0;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    table.data-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 22px;
      font-size: 9pt;
    }

    table.data-table th, table.data-table td {
      border: 1px solid #cbd5e1;
      padding: 6px 10px;
    }

    table.data-table th {
      background-color: #064e3b;
      color: #ffffff;
      font-weight: 600;
      text-align: left;
    }

    table.data-table th.center, table.data-table td.center {
      text-align: center;
    }

    table.data-table th.right, table.data-table td.right {
      text-align: right;
    }

    table.data-table tbody tr:nth-child(even) {
      background-color: #f8fafc;
    }

    .badge-aktif {
      color: #059669;
      font-weight: 600;
    }

    .badge-nonaktif {
      color: #dc2626;
      font-weight: 600;
    }

    /* SIGNATURE BLOCK */
    .signature-section {
      display: flex;
      justify-content: space-between;
      margin-top: 40px;
      page-break-inside: avoid;
    }

    .signature-col {
      width: 250px;
      text-align: center;
      font-size: 9.5pt;
    }

    .signature-space {
      height: 70px;
    }

    .signature-name {
      font-weight: 700;
      text-decoration: underline;
      color: #0f172a;
      margin-bottom: 2px;
    }

    /* FLOATING ACTION BAR */
    .floating-bar {
      position: fixed;
      top: 15px;
      right: 20px;
      display: flex;
      gap: 10px;
      z-index: 99999;
    }

    .btn-action {
      background: #059669;
      color: #ffffff;
      border: none;
      padding: 10px 18px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 13px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      box-shadow: 0 4px 14px rgba(5, 150, 105, 0.4);
      text-decoration: none;
      transition: all 0.2s;
    }

    .btn-action:hover {
      background: #047857;
      color: #ffffff;
      transform: translateY(-1px);
    }

    .btn-close-rep {
      background: #475569;
      box-shadow: 0 4px 14px rgba(71, 85, 105, 0.3);
    }
    .btn-close-rep:hover {
      background: #334155;
    }

    /* PRINT SPECIFIC STYLES */
    @media print {
      body {
        background: #ffffff;
        padding: 0;
        margin: 0;
      }
      .report-sheet {
        box-shadow: none;
        padding: 0;
        max-width: 100%;
        border-radius: 0;
      }
      .no-print {
        display: none !important;
      }
      @page {
        size: A4 portrait;
        margin: 12mm 15mm;
      }
    }
  </style>
</head>
<body>

  <!-- Floating Print & Back Buttons (Hidden during printing) -->
  <div class="floating-bar no-print">
    <button onclick="window.print();" class="btn-action">
      <i class="fas fa-print"></i> Cetak / Simpan PDF
    </button>
    <a href="/members/analisis" class="btn-action btn-close-rep">
      <i class="fas fa-times"></i> Tutup
    </a>
  </div>

  <div class="report-sheet">
    <!-- KOP SURAT RESMI -->
    <div class="kop-surat">
      <img src="/assets/juleha/logo.png" alt="Logo Juleha Jatim" class="kop-logo" onerror="this.onerror=null;this.src='/assets/juleha/julehajatim72.png';">
      <div class="kop-text">
        <h2>Dewan Pengurus Wilayah</h2>
        <h1>Juru Sembelih Halal (Juleha)</h1>
        <p>
          <strong>PROVINSI JAWA TIMUR</strong><br>
          Sekretariat: Jawa Timur | Website: members.julehajatim.com<br>
          Email: info@julehajatim.com | Layanan Keanggotaan Terpadu
        </p>
      </div>
      <img src="/assets/juleha/logo.png" alt="Logo Juleha" class="kop-logo" style="visibility: hidden;">
    </div>

    <!-- TITLE -->
    <div class="report-title-box">
      <h3 class="report-title">Laporan Analisis & Statistik Data Keanggotaan</h3>
      <p class="report-subtitle">
        Tanggal Dicetak: <strong><?php echo htmlspecialchars($generate_date); ?></strong> | Status Data: <em>Real-Time Database</em>
      </p>
    </div>

    <!-- 1. KPI EXECUTIVE SUMMARY -->
    <div class="kpi-row">
      <div class="kpi-box total">
        <div class="kpi-val"><?php echo number_format($summary['total']); ?></div>
        <div class="kpi-lbl">Total Anggota</div>
      </div>
      <div class="kpi-box active">
        <div class="kpi-val"><?php echo number_format($summary['active']); ?></div>
        <div class="kpi-lbl">Anggota Aktif (<?php echo $summary['pct_active']; ?>%)</div>
      </div>
      <div class="kpi-box inactive">
        <div class="kpi-val"><?php echo number_format($summary['inactive']); ?></div>
        <div class="kpi-lbl">Tidak Aktif (<?php echo $summary['pct_inactive']; ?>%)</div>
      </div>
      <div class="kpi-box">
        <div class="kpi-val"><?php echo number_format($summary['trainings']); ?></div>
        <div class="kpi-lbl">Pelatihan Diikuti</div>
      </div>
    </div>

    <!-- 2. TOP 10 WILAYAH TERBANYAK -->
    <div class="section-heading">
      <i class="fas fa-medal text-warning mr-1"></i> A. 10 Wilayah dengan Anggota Terbanyak di Jawa Timur
    </div>
    <table class="data-table">
      <thead>
        <tr>
          <th class="center" style="width: 45px;">No</th>
          <th style="width: 80px;">Kode</th>
          <th>Kabupaten / Kota</th>
          <th class="center" style="width: 100px;">Anggota Aktif</th>
          <th class="center" style="width: 100px;">Tidak Aktif</th>
          <th class="center" style="width: 110px;">Total Anggota</th>
          <th class="center" style="width: 100px;">Persentase</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $noTop = 1;
        $totalAll = $summary['total'] > 0 ? $summary['total'] : 1;
        foreach ($top_regions as $top): 
          $pctFromTotal = round(((int)$top['total'] / $totalAll) * 100, 1);
        ?>
        <tr>
          <td class="center font-weight-bold"><?php echo $noTop++; ?></td>
          <td class="center"><strong><?php echo htmlspecialchars($top['region_code']); ?></strong></td>
          <td><strong><?php echo htmlspecialchars($top['region_name']); ?></strong></td>
          <td class="center badge-aktif"><?php echo number_format((int)$top['active_count']); ?></td>
          <td class="center <?php echo (int)$top['inactive_count'] > 0 ? 'badge-nonaktif' : ''; ?>">
            <?php echo (int)$top['inactive_count'] > 0 ? number_format((int)$top['inactive_count']) : '-'; ?>
          </td>
          <td class="center font-weight-bold"><?php echo number_format((int)$top['total']); ?></td>
          <td class="center"><?php echo $pctFromTotal; ?>%</td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- 3. REKAPITULASI LENGKAP KABUPATEN / KOTA -->
    <div class="section-heading">
      <i class="fas fa-list-alt text-primary mr-1"></i> B. Rekapitulasi Data Keanggotaan Seluruh Kabupaten/Kota
    </div>
    <table class="data-table">
      <thead>
        <tr>
          <th class="center" style="width: 40px;">No</th>
          <th style="width: 75px;">Kode</th>
          <th>Nama Kabupaten / Kota</th>
          <th class="center" style="width: 100px;">Jumlah Aktif</th>
          <th class="center" style="width: 100px;">Tidak Aktif</th>
          <th class="center" style="width: 110px;">Total Anggota</th>
          <th class="center" style="width: 100px;">Rasio Keaktifan</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $noReg = 1;
        foreach ($all_regions as $reg): 
          $t = (int)$reg['total'];
          $a = (int)$reg['active_count'];
          $i = (int)$reg['inactive_count'];
          $rasio = $t > 0 ? round(($a / $t) * 100, 1) : 0;
        ?>
        <tr>
          <td class="center"><?php echo $noReg++; ?></td>
          <td class="center"><?php echo htmlspecialchars($reg['region_code']); ?></td>
          <td><?php echo htmlspecialchars($reg['region_name']); ?></td>
          <td class="center badge-aktif"><?php echo number_format($a); ?></td>
          <td class="center <?php echo $i > 0 ? 'badge-nonaktif' : ''; ?>"><?php echo $i > 0 ? number_format($i) : '-'; ?></td>
          <td class="center font-weight-bold"><?php echo number_format($t); ?></td>
          <td class="center"><?php echo $rasio; ?>%</td>
        </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr style="background: #e2e8f0; font-weight: 700;">
          <td colspan="3" class="center">TOTAL KESELURUHAN ANGGOTA JAWA TIMUR</td>
          <td class="center badge-aktif"><?php echo number_format($summary['active']); ?></td>
          <td class="center <?php echo $summary['inactive'] > 0 ? 'badge-nonaktif' : ''; ?>"><?php echo number_format($summary['inactive']); ?></td>
          <td class="center font-weight-bold"><?php echo number_format($summary['total']); ?></td>
          <td class="center"><?php echo $summary['pct_active']; ?>%</td>
        </tr>
      </tfoot>
    </table>

    <!-- 4. PENGESAHAN DOKUMEN -->
    <div class="signature-section">
      <div class="signature-col">
        <p>Mengetahui,<br><strong>Sekretaris DPW Juleha Jatim</strong></p>
        <div class="signature-space"></div>
        <p class="signature-name">( Pengurus Wilayah )</p>
        <small style="color: #64748b;">NID. Juleha Jatim</small>
      </div>

      <div class="signature-col">
        <p>Jawa Timur, <?php echo date('d F Y'); ?><br><strong>Ketua DPW Juleha Jatim</strong></p>
        <div class="signature-space"></div>
        <p class="signature-name">H. IMAM FAUZI, S.T.</p>
        <small style="color: #64748b;">Ketua DPW Juleha Jawa Timur</small>
      </div>
    </div>

  </div>

</body>
</html>
