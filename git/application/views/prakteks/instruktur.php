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
    .grow {
      flex-grow: 1 !important;
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
    .dropdown-search-box {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      z-index: 1060;
      background: #ffffff;
      border: 1px solid #cbd5e1;
      border-radius: 12px;
      max-height: 290px;
      overflow-y: auto;
      margin-top: 4px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }
    .search-item {
      padding: 10px 14px;
      cursor: pointer;
      border-bottom: 1px solid #f1f5f9;
      transition: background 0.15s ease;
      display: flex;
      align-items: center;
    }
    .search-item:last-child {
      border-bottom: none;
    }
    .search-item:hover, .search-item.active {
      background-color: #ecfdf5;
    }
    .search-avatar {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #10b981;
      margin-right: 12px;
      flex-shrink: 0;
    }
    .selected-member-card {
      background: #f0fdf4;
      border: 1.5px solid #86efac;
      border-radius: 12px;
    }

    /* Table Mobile Optimization */
    .table-responsive {
      -webkit-overflow-scrolling: touch;
      overflow-x: auto;
      width: 100%;
    }
    .table-modern {
      min-width: 800px !important;
    }
    .table-responsive::-webkit-scrollbar {
      height: 6px;
    }
    .table-responsive::-webkit-scrollbar-thumb {
      background: #94a3b8;
      border-radius: 4px;
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
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0 shadow-sm" style="background: #ffffff;">
    <?php 
      $home_url = (!empty($is_admin)) ? base_url('members/index') : base_url('members/profile');
    ?>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $home_url; ?>" class="nav-link font-weight-500">Beranda</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('prakteks/index'); ?>" class="nav-link font-weight-500">Rekap Praktik</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="<?php echo base_url('prakteks/scan'); ?>" class="btn btn-outline-success btn-sm rounded shadow-sm font-weight-bold px-2 px-sm-3 mr-1 mr-sm-2">
          <i class="fas fa-qrcode mr-1"></i> <span class="d-none d-sm-inline">Scan KTA</span><span class="d-inline d-sm-none">Scan</span>
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
            <!-- Mobile Swipe Indicator Helper -->
            <div class="d-md-none alert alert-light border py-1 px-2 m-2 text-muted small d-flex align-items-center justify-content-between" style="border-radius: 8px; font-size: 0.75rem;">
              <span><i class="fas fa-arrows-alt-h text-success mr-1"></i> Geser tabel ke kanan untuk melihat kolom lengkap</span>
              <span class="badge badge-success font-weight-bold">Swipe &rarr;</span>
            </div>

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

            <!-- 1. Pencarian Live Nama / ID Anggota -->
            <div class="form-group mb-3">
              <label class="font-weight-bold small text-uppercase text-dark d-flex align-items-center justify-content-between">
                <span><i class="fas fa-search text-success mr-1"></i> Cari Nama Anggota / ID <span class="text-danger">*</span></span>
                <span class="badge badge-light border text-muted font-weight-normal">Nama Panggilan / Depan / Belakang / ID</span>
              </label>

              <div class="position-relative">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0" id="searchIconSpan">
                      <i class="fas fa-search text-muted" id="searchIcon"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control border-left-0 font-weight-500" id="inputSearchMember" 
                         placeholder="Ketik nama anggota (misal: Maftuchin, Zaidan, Ahmad)..." autocomplete="off">
                  <div class="input-group-append" id="btnGroupClearSearch" style="display: none;">
                    <button class="btn btn-outline-secondary" type="button" id="btnClearSearch" title="Hapus pencarian">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>

                <!-- Live Search Results Dropdown -->
                <div id="dropdownSearchResults" class="dropdown-search-box" style="display: none;">
                  <div id="searchResultsList"></div>
                </div>
              </div>
              <small class="text-muted d-block mt-1">
                Ketik nama (huruf besar/kecil otomatis terdeteksi) untuk memilih anggota yang akan dijadikan instruktur resmi.
              </small>
            </div>

            <!-- 2. Kartu Anggota Terpilih -->
            <div id="cardSelectedMember" class="selected-member-card p-3 mb-3 shadow-sm" style="display: none;">
              <div class="d-flex align-items-center">
                <img src="/assets/adminlte/dist/img/avatar5.png" id="selectedMemberPhoto" class="rounded-circle mr-3 border" 
                     style="width: 56px; height: 56px; object-fit: cover; border-width: 2px !important; border-color: #10b981 !important;"
                     onerror="this.onerror=null;this.src='/assets/adminlte/dist/img/avatar5.png';">
                <div class="grow" style="flex-grow: 1;">
                  <div class="d-flex align-items-center justify-content-between">
                    <h6 class="font-weight-bold mb-0 text-success" id="selectedMemberName">-</h6>
                    <span class="badge badge-success px-2 py-1 font-weight-bold" id="selectedMemberBadgeId">-</span>
                  </div>
                  <div class="small text-muted mt-1">
                    <span class="mr-2"><i class="fas fa-map-marker-alt text-danger mr-1"></i> <span id="selectedMemberRegion">-</span></span>
                    <span><i class="fas fa-user-tag text-info mr-1"></i> <span id="selectedMemberPosition">Anggota</span></span>
                  </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger ml-2 font-weight-bold" id="btnCancelSelectedMember" title="Ganti Anggota">
                  <i class="fas fa-times mr-1"></i> Ganti
                </button>
              </div>
            </div>

            <!-- Hidden input for selected Juleha ID -->
            <input type="hidden" id="new_juleha_id" name="juleha_id" value="" required>

            <!-- 3. Catatan / Bidang Pengujian -->
            <div class="form-group mb-2">
              <label class="font-weight-bold small text-uppercase text-dark">
                <i class="fas fa-pen-nib text-success mr-1"></i> Catatan / Bidang Pengujian
              </label>
              <input type="text" class="form-control" name="notes" placeholder="Misal: Instruktur Praktik Sembelih RPH TOW & Kedurus" value="Instruktur Resmi Juleha Jatim">
            </div>

          </div>
          <div class="modal-footer bg-light p-3">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success font-weight-bold px-4 shadow-sm" id="btnSubmitAdd" disabled>
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
let searchTimeout = null;

// Live Search Anggota by Name or ID with Debounce
$('#inputSearchMember').on('input', function() {
  const query = $(this).val().trim();
  clearTimeout(searchTimeout);

  if (query.length === 0) {
    $('#dropdownSearchResults').hide();
    $('#searchResultsList').empty();
    $('#btnGroupClearSearch').hide();
    return;
  }

  $('#btnGroupClearSearch').show();
  $('#searchIcon').removeClass('fa-search').addClass('fa-spinner fa-spin text-success');

  searchTimeout = setTimeout(function() {
    $.ajax({
      url: '<?php echo base_url("prakteks/search_members_ajax"); ?>',
      type: 'GET',
      data: { q: query },
      dataType: 'json',
      success: function(members) {
        $('#searchIcon').removeClass('fa-spinner fa-spin text-success').addClass('fa-search');
        renderSearchResults(members);
      },
      error: function() {
        $('#searchIcon').removeClass('fa-spinner fa-spin text-success').addClass('fa-search');
        $('#searchResultsList').html(`
          <div class="p-3 text-center text-muted small">
            Gagal mengambil data pencarian.
          </div>
        `);
        $('#dropdownSearchResults').show();
      }
    });
  }, 220);
});

function renderSearchResults(members) {
  const $list = $('#searchResultsList');
  $list.empty();

  if (!members || members.length === 0) {
    $list.html(`
      <div class="p-3 text-center text-muted small">
        <i class="fas fa-user-slash text-secondary fa-2x mb-2 d-block"></i>
        Tidak ditemukan anggota dengan nama/ID tersebut.
      </div>
    `);
    $('#dropdownSearchResults').show();
    return;
  }

  members.forEach(function(m) {
    const itemHtml = $(`
      <div class="search-item">
        <img src="${m.photo_url}" class="search-avatar" onerror="this.onerror=null;this.src='/assets/adminlte/dist/img/avatar5.png';">
        <div class="grow pr-2" style="flex-grow: 1;">
          <div class="d-flex align-items-center justify-content-between">
            <strong class="text-dark" style="font-size: 0.95rem;">${m.fullname}</strong>
            <span class="badge badge-success px-2 py-1">${m.id}</span>
          </div>
          <div class="small text-muted mt-1">
            <span class="mr-2"><i class="fas fa-tag mr-1 text-success"></i>Panggilan: <strong>${m.nickname || '-'}</strong></span>
            <span><i class="fas fa-map-marker-alt mr-1 text-danger"></i>${m.region || 'Jatim'}</span>
          </div>
        </div>
        <div class="text-right">
          <span class="btn btn-sm btn-outline-success font-weight-bold py-1 px-2">
            <i class="fas fa-check mr-1"></i> Pilih
          </span>
        </div>
      </div>
    `);

    itemHtml.on('click', function() {
      selectMember(m);
    });

    $list.append(itemHtml);
  });

  $('#dropdownSearchResults').show();
}

function selectMember(m) {
  $('#new_juleha_id').val(m.id);
  $('#selectedMemberName').text(m.fullname + (m.nickname ? ' (' + m.nickname + ')' : ''));
  $('#selectedMemberBadgeId').text(m.id);
  $('#selectedMemberRegion').text(m.region || 'Jatim');
  $('#selectedMemberPosition').text(m.position || 'Anggota');
  $('#selectedMemberPhoto').attr('src', m.photo_url + '?t=' + new Date().getTime());

  $('#cardSelectedMember').slideDown(200);
  $('#btnSubmitAdd').prop('disabled', false);

  // Sembunyikan dropdown & kosongkan search box
  $('#dropdownSearchResults').hide();
  $('#inputSearchMember').val(m.fullname + ' (' + m.id + ')');
  $('#btnGroupClearSearch').show();
}

function resetMemberSelection() {
  $('#new_juleha_id').val('');
  $('#cardSelectedMember').slideUp(150);
  $('#btnSubmitAdd').prop('disabled', true);
  $('#inputSearchMember').val('').focus();
  $('#dropdownSearchResults').hide();
  $('#searchResultsList').empty();
  $('#btnGroupClearSearch').hide();
}

$('#btnClearSearch, #btnCancelSelectedMember').on('click', function() {
  resetMemberSelection();
});

// Tutup dropdown jika klik di luar
$(document).on('click', function(e) {
  if (!$(e.target).closest('#modalAddInstructor .position-relative').length) {
    $('#dropdownSearchResults').hide();
  }
});

$('#modalAddInstructor').on('hidden.bs.modal', function() {
  resetMemberSelection();
});

$('#formAddInstructor').on('submit', function(e) {
  e.preventDefault();
  const julehaId = $('#new_juleha_id').val().trim();
  if (!julehaId) {
    alert('Silakan cari dan pilih anggota terlebih dahulu.');
    return;
  }

  const $btn = $('#btnSubmitAdd');
  $btn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...').prop('disabled', true);

  $.ajax({
    url: '<?php echo base_url("prakteks/add_instructor_ajax"); ?>',
    type: 'POST',
    data: $(this).serialize(),
    dataType: 'json',
    success: function(resp) {
      $btn.html('<i class="fas fa-save mr-1"></i> Simpan Instruktur').prop('disabled', false);
      if (resp && resp.status) {
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
    url: '<?php echo base_url("prakteks/delete_instructor_ajax"); ?>',
    type: 'POST',
    data: { juleha_id: julehaId },
    dataType: 'json',
    success: function(resp) {
      if (resp && resp.status) {
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
