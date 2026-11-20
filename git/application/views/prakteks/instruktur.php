<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title ?? 'Daftar Instruktur Resmi - Juleha Jawa Timur'; ?></title>

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
    .table-modern thead th {
      background: #f1f5f9;
      color: #475569;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.78rem;
      letter-spacing: 0.5px;
      border-bottom: 2px solid #e2e8f0;
      padding: 12px 14px;
    }
    .table-modern tbody td {
      padding: 14px;
      vertical-align: middle;
      font-size: 0.88rem;
      border-top: 1px solid #f1f5f9;
    }
    .instructor-avatar {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #10b981;
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
        <a href="<?php echo base_url('prakteks/scan'); ?>" class="btn btn-outline-success btn-sm rounded shadow-sm font-weight-bold px-3 mr-2">
          <i class="fas fa-qrcode mr-1"></i> Scan KTA
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
              <i class="fas fa-chalkboard-teacher text-success mr-2"></i> Daftar Instruktur Resmi Juleha Jatim
            </h1>
            <p class="text-muted small m-0 mt-1">Manajemen Instruktur yang berwenang menguji dan mengevaluasi praktik penyembelihan di RPH TOW & RPH Kedurus</p>
          </div>
          <div class="col-sm-6 mt-2 mt-sm-0 text-sm-right">
            <button type="button" class="btn btn-success font-weight-bold shadow-sm" data-toggle="modal" data-target="#modalAddInstructor" style="border-radius: 10px;">
              <i class="fas fa-user-plus mr-1"></i> Tambah Instruktur Resmi
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <section class="content mt-3">
      <div class="container-fluid">

        <div class="card-modern">
          <div class="card-header-juleha d-flex align-items-center justify-content-between">
            <span class="font-weight-bold"><i class="fas fa-list-check mr-2"></i> Instruktur Terdaftar & Berwenang Menilai</span>
            <span class="badge badge-light px-3 py-1 font-weight-bold"><?php echo count($instructors); ?> Instruktur</span>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-modern table-hover mb-0">
                <thead>
                  <tr>
                    <th style="width: 50px;">No</th>
                    <th>Instruktur</th>
                    <th>ID Juleha</th>
                    <th>Daerah / Wilayah</th>
                    <th>Jabatan</th>
                    <th class="text-center">Sesi Evaluasi Peserta</th>
                    <th class="text-center">Penugasan di RPH</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 100px;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($instructors)): ?>
                    <?php $no = 1; foreach ($instructors as $inst): ?>
                      <?php 
                        $instName = trim(($inst->firstname ?? '') . ' ' . ($inst->lastname ?? ''));
                        if (empty($instName)) $instName = $inst->nickname ?? '-';
                      ?>
                      <tr>
                        <td class="text-center font-weight-bold text-muted"><?php echo $no++; ?></td>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="/images/<?php echo htmlspecialchars($inst->juleha_id, ENT_QUOTES, 'UTF-8'); ?>.jpg" 
                                 class="instructor-avatar mr-3" 
                                 onerror="this.onerror=null;this.src='/assets/adminlte/dist/img/avatar5.png';">
                            <div>
                              <strong class="text-dark d-block" style="font-size: 0.95rem;"><?php echo htmlspecialchars($instName, ENT_QUOTES, 'UTF-8'); ?></strong>
                              <small class="text-muted"><?php echo htmlspecialchars($inst->instructor_notes ?? 'Instruktur Resmi', ENT_QUOTES, 'UTF-8'); ?></small>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span class="badge badge-success px-2 py-1 font-weight-bold">
                            <?php echo htmlspecialchars($inst->juleha_id, ENT_QUOTES, 'UTF-8'); ?>
                          </span>
                        </td>
                        <td><?php echo htmlspecialchars($inst->region ?? 'Jatim', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($inst->position ?? 'Instruktur', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="text-center">
                          <span class="badge badge-light border font-weight-bold px-2 py-1">
                            <i class="fas fa-clipboard-check text-success mr-1"></i> <?php echo (int)($inst->total_evaluasi ?? 0); ?> kali
                          </span>
                        </td>
                        <td class="text-center">
                          <span class="badge badge-light border font-weight-bold px-2 py-1">
                            <i class="fas fa-briefcase text-primary mr-1"></i> <?php echo (int)($inst->total_tugas ?? 0); ?> kali
                          </span>
                        </td>
                        <td>
                          <?php if (($inst->instructor_status ?? 'active') === 'active'): ?>
                            <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> Aktif</span>
                          <?php else: ?>
                            <span class="badge badge-secondary px-2 py-1">Non-Aktif</span>
                          <?php endif; ?>
                        </td>
                        <td class="text-center">
                          <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteInstructor('<?php echo htmlspecialchars($inst->juleha_id, ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($instName), ENT_QUOTES, 'UTF-8'); ?>')" title="Hapus dari daftar instruktur">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="9" class="text-center py-4 text-muted">
                        Belum ada instruktur terdaftar. Klik tombol <strong>Tambah Instruktur Resmi</strong> di atas untuk menambahkan.
                      </td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </section>

  </div>

  <!-- Modal Tambah Instruktur -->
  <div class="modal fade" id="modalAddInstructor" tabindex="-1" role="dialog" aria-labelledby="modalAddInstructorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; overflow: hidden; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
        <div class="modal-header text-white" style="background: linear-gradient(135deg, #064e3b 0%, #059669 100%);">
          <h5 class="modal-title font-weight-bold" id="modalAddInstructorLabel">
            <i class="fas fa-user-plus mr-2"></i> Tambah Instruktur Resmi Juleha
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formAddInstructor">
          <div class="modal-body p-4">
            <div class="form-group mb-3">
              <label class="font-weight-bold small text-uppercase text-dark">ID Juleha Anggota <span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="text" class="form-control font-weight-bold" id="new_juleha_id" name="juleha_id" placeholder="Misal: SBY220006" required>
                <div class="input-group-append">
                  <button type="button" class="btn btn-outline-success font-weight-bold" id="btnCheckMember">
                    <i class="fas fa-search mr-1"></i> Cek
                  </button>
                </div>
              </div>
              <small class="text-muted" id="memberCheckResult">Ketik ID dan klik Cek untuk memastikan nama anggota.</small>
            </div>
            <div class="form-group mb-3">
              <label class="font-weight-bold small text-uppercase text-dark">Catatan / Bidang Pengujian</label>
              <input type="text" class="form-control" name="notes" placeholder="Misal: Instruktur Praktik Sembelih RPH TOW & Kedurus" value="Instruktur Resmi Juleha Jatim">
            </div>
          </div>
          <div class="modal-footer bg-light p-3">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success font-weight-bold px-4" id="btnSubmitAdd">
              <i class="fas fa-save mr-1"></i> Simpan Instruktur
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
<script src="/assets/adminlte/dist/js/adminlte.min.js"></script>

<script>
$('#btnCheckMember').on('click', function() {
  const id = $('#new_juleha_id').val().trim();
  if (!id) {
    alert('Masukkan ID Juleha terlebih dahulu.');
    return;
  }
  $('#btnCheckMember').html('<i class="fas fa-spinner fa-spin mr-1"></i> ...').prop('disabled', true);
  $.ajax({
    url: '/prakteks/get_member_ajax',
    type: 'GET',
    data: { juleha_id: id },
    dataType: 'json',
    success: function(resp) {
      $('#btnCheckMember').html('<i class="fas fa-search mr-1"></i> Cek').prop('disabled', false);
      if (resp.status) {
        $('#memberCheckResult').html(`
          <div class="alert alert-success py-1 px-2 mt-1 mb-0 small">
            <i class="fas fa-check-circle mr-1"></i> Ditemukan: <strong>${resp.name}</strong> (${resp.region || 'Jatim'})
          </div>
        `);
      } else {
        $('#memberCheckResult').html(`
          <div class="alert alert-danger py-1 px-2 mt-1 mb-0 small">
            <i class="fas fa-times-circle mr-1"></i> ${resp.message}
          </div>
        `);
      }
    },
    error: function() {
      $('#btnCheckMember').html('<i class="fas fa-search mr-1"></i> Cek').prop('disabled', false);
      alert('Gagal menghubungi server.');
    }
  });
});

$('#formAddInstructor').on('submit', function(e) {
  e.preventDefault();
  const $btn = $('#btnSubmitAdd');
  $btn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...').prop('disabled', true);

  $.ajax({
    url: '/prakteks/add_instructor_ajax',
    type: 'POST',
    data: $(this).serialize(),
    dataType: 'json',
    success: function(resp) {
      $btn.html('<i class="fas fa-save mr-1"></i> Simpan Instruktur').prop('disabled', false);
      if (resp.status) {
        alert(resp.message);
        location.reload();
      } else {
        alert(resp.message || 'Gagal menyimpan instruktur.');
      }
    },
    error: function() {
      $btn.html('<i class="fas fa-save mr-1"></i> Simpan Instruktur').prop('disabled', false);
      alert('Terjadi kesalahan sistem.');
    }
  });
});

function deleteInstructor(julehaId, name) {
  if (!confirm('Apakah Anda yakin ingin menghapus ' + name + ' (' + julehaId + ') dari daftar Instruktur Resmi?')) {
    return;
  }

  $.ajax({
    url: '/prakteks/delete_instructor_ajax',
    type: 'POST',
    data: { juleha_id: julehaId },
    dataType: 'json',
    success: function(resp) {
      if (resp.status) {
        alert(resp.message);
        location.reload();
      } else {
        alert(resp.message || 'Gagal menghapus instruktur.');
      }
    },
    error: function() {
      alert('Terjadi kesalahan komunikasi dengan server.');
    }
  });
}
</script>
</body>
</html>
