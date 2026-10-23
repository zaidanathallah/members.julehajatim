<!DOCTYPE html>
<html lang="id">
<?php $this->load->view('common/head');?>
<style>
  /* Responsive Table & UI Tuning */
  .dataTables_wrapper {
    width: 100%;
    position: relative;
    clear: both;
  }
  .dataTables_scrollBody {
    -webkit-overflow-scrolling: touch;
  }
  #example2 th, #example2 td {
    white-space: nowrap;
    vertical-align: middle;
  }
  .table thead th {
    font-size: 0.9rem;
    font-weight: 600;
    background-color: #f8fafc;
  }
  .table tbody td {
    font-size: 0.88rem;
  }
  .dt-buttons .btn {
    font-size: 0.82rem;
    padding: 0.32rem 0.65rem;
    border-radius: 6px;
    font-weight: 500;
  }
  .dataTables_filter input {
    border-radius: 6px;
    border: 1px solid #cbd5e1;
    padding: 5px 12px;
    font-size: 0.88rem;
  }
  .dropdown-menu {
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    border: 1px solid #e2e8f0;
    min-width: 210px;
    padding: 6px 0;
    z-index: 1060;
  }
  .dropdown-item {
    font-size: 0.88rem;
    padding: 8px 16px;
    cursor: pointer;
    transition: all 0.15s ease;
  }
  .dropdown-item:hover {
    background-color: #f1f5f9;
  }
  .badge-count {
    font-size: 0.82rem;
    padding: 4px 8px;
    border-radius: 50px;
    font-weight: 600;
  }
  /* Styling Showing info & Pagination */
  .dataTables_info {
    font-size: 0.85rem !important;
    color: #64748b !important;
    font-weight: 500;
    padding-top: 14px !important;
  }
  .dataTables_paginate {
    padding-top: 10px !important;
  }
  .pagination {
    margin: 0 !important;
  }
  .pagination .page-item .page-link {
    border-radius: 8px !important;
    border: 1px solid #e2e8f0;
    color: #1e293b;
    background-color: #ffffff;
    font-size: 0.82rem;
    font-weight: 600;
    padding: 6px 11px;
    margin: 0 2px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    transition: all 0.2s ease;
  }
  .pagination .page-item .page-link:hover {
    background-color: #f1f5f9;
    color: #007bff;
    border-color: #cbd5e1;
  }
  .pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #007bff, #0056b3) !important;
    border-color: #0056b3 !important;
    color: #ffffff !important;
    box-shadow: 0 3px 8px rgba(0, 123, 255, 0.35) !important;
  }
  .pagination .page-item.disabled .page-link {
    background-color: #f8fafc !important;
    border-color: #e2e8f0 !important;
    color: #94a3b8 !important;
    box-shadow: none !important;
  }

  @media (max-width: 768px) {
    .content-header h1 {
      font-size: 1.35rem;
    }
    .dt-buttons {
      display: flex !important;
      flex-wrap: wrap !important;
      gap: 4px;
      margin-bottom: 10px;
      width: 100%;
    }
    .dt-buttons .btn {
      flex: 1 1 30%;
      text-align: center;
      margin: 0 !important;
      font-size: 0.78rem;
      padding: 6px 4px;
    }
    .dataTables_filter {
      text-align: left !important;
      margin-top: 6px;
      width: 100%;
    }
    .dataTables_filter input {
      width: 100% !important;
      max-width: 100%;
      margin-left: 0 !important;
    }
    .btn-action-mobile {
      padding: 4px 8px;
      font-size: 0.85rem;
    }
    .dataTables_info {
      text-align: center !important;
      padding-top: 12px !important;
      padding-bottom: 4px !important;
      font-size: 0.8rem !important;
      width: 100%;
    }
    .dataTables_paginate {
      text-align: center !important;
      width: 100%;
      margin: 0 auto;
    }
    .dataTables_paginate .pagination {
      justify-content: center !important;
      flex-wrap: wrap;
      gap: 2px;
    }
    .pagination .page-item .page-link {
      font-size: 0.76rem !important;
      padding: 5px 8px !important;
      min-width: 28px;
      margin: 0 1px;
    }
  }

  @media (max-width: 420px) {
    .pagination .page-item .page-link {
      font-size: 0.72rem !important;
      padding: 4px 6px !important;
      min-width: 25px;
    }
  }
</style>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url(); ?>" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://julehajatim.com" target="_blank" class="nav-link">Portal Juleha</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <button class="btn btn-primary btn-sm rounded shadow-sm font-weight-bold px-3" data-toggle="modal" data-target="#modal-lg">
          <i class="fas fa-user-plus mr-1"></i> + Tambah Anggota
        </button>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $this->load->view('common/sidemenu')?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="font-weight-bold text-dark">Daftar Anggota Juleha Jatim</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item active">Anggota</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-outline card-primary shadow-sm">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title font-weight-bold">
                  <i class="fas fa-users mr-1 text-primary"></i> Data Keanggotaan Juru Sembelih Halal Jawa Timur
                </h3>
              </div>
              <div class="card-body">
                <div class="d-block d-md-none alert alert-light border py-2 px-3 mb-3 text-muted" style="font-size: 0.82rem; border-radius: 8px;">
                  <i class="fas fa-arrows-alt-h text-primary mr-1"></i> <strong>Mode HP:</strong> Geser tabel ke samping untuk melihat seluruh kolom (Status, Sertifikat, Pelatihan, & Opsi Aksi).
                </div>
                <table id="example2" class="table table-bordered table-hover w-100">
                    <thead>
                    <tr>
                      <th>ID Juleha</th>
                      <th>Panggilan</th>
                      <th>Region</th>
                      <th>Jabatan</th>
                      <th>Alamat</th>
                      <th>Sertifikat</th>
                      <th>Portofolio</th>
                      <th>Pelatihan</th>
                      <th>Status</th>
                      <th class="text-center" style="width: 100px;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($objs as $obj){ 
                      $isAktif = strtolower($obj->mstatus) === 'aktif';
                      $cleanNick = htmlspecialchars($obj->nickname ?? '', ENT_QUOTES, 'UTF-8');
                      $cleanJulehaId = htmlspecialchars($obj->juleha_id ?? '', ENT_QUOTES, 'UTF-8');
                    ?>
                    <tr id="<?php echo $obj->id;?>" data-id="<?php echo $obj->id;?>" data-juleha-id="<?php echo $cleanJulehaId;?>">
                      <td class="juleha_id font-weight-bold text-primary">
                        <a href="<?php echo base_url('members/showcard/' . rawurlencode($cleanJulehaId)); ?>" target="_blank" title="Lihat Kartu KTA">
                          <?php echo $cleanJulehaId;?>
                        </a>
                      </td>
                      <td><strong><?php echo $cleanNick;?></strong></td>
                      <td><span class="badge badge-light border"><?php echo htmlspecialchars($obj->region ?? '', ENT_QUOTES, 'UTF-8');?></span></td>
                      <td><?php echo htmlspecialchars($obj->position ?? '-', ENT_QUOTES, 'UTF-8');?></td>
                      <td><small class="text-muted"><?php echo htmlspecialchars($obj->address ?? '-', ENT_QUOTES, 'UTF-8');?></small></td>
                      <td class="text-center">
                        <span class="badge badge-info badge-count" title="Jumlah Sertifikat">
                          <i class="fas fa-certificate mr-1"></i><?php echo (int)($obj->certificate ?? 0);?>
                        </span>
                      </td>
                      <td class="text-center">
                        <span class="badge badge-success badge-count" title="Jumlah Portofolio">
                          <i class="fas fa-briefcase mr-1"></i><?php echo (int)($obj->portofolio ?? 0);?>
                        </span>
                      </td>
                      <td class="text-center">
                        <span class="badge badge-warning badge-count" title="Jumlah Pelatihan">
                          <i class="fas fa-graduation-cap mr-1"></i><?php echo (int)($obj->training ?? 0);?>
                        </span>
                      </td>
                      <td class="text-center">
                        <?php if ($isAktif): ?>
                          <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i>Aktif</span>
                        <?php else: ?>
                          <span class="badge badge-danger px-2 py-1"><i class="fas fa-times-circle mr-1"></i>Non Aktif</span>
                        <?php endif; ?>
                      </td>
                      <td class="text-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle btn-action-mobile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog mr-1"></i> Opsi
                          </button>
                          <div class="dropdown-menu dropdown-menu-right shadow" role="menu">
                            <a class="dropdown-item edit" href="javascript:void(0);" 
                               data-id="<?php echo $obj->id;?>" data-juleha-id="<?php echo $cleanJulehaId;?>" data-nickname="<?php echo $cleanNick;?>">
                              <i class="fas fa-edit mr-2 text-primary"></i> Edit Data Anggota
                            </a>
                            <a class="dropdown-item btneditpassword" href="javascript:void(0);" 
                               data-id="<?php echo $obj->id;?>" data-juleha-id="<?php echo $cleanJulehaId;?>" data-nickname="<?php echo $cleanNick;?>">
                              <i class="fas fa-key mr-2 text-warning"></i> Ubah Password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item addCertificate" href="javascript:void(0);" 
                               data-id="<?php echo $obj->id;?>" data-juleha-id="<?php echo $cleanJulehaId;?>" data-nickname="<?php echo $cleanNick;?>">
                              <i class="fas fa-certificate mr-2 text-info"></i> Tambah Sertifikat
                            </a>
                            <a class="dropdown-item addPortofolio" href="javascript:void(0);" 
                               data-id="<?php echo $obj->id;?>" data-juleha-id="<?php echo $cleanJulehaId;?>" data-nickname="<?php echo $cleanNick;?>">
                              <i class="fas fa-briefcase mr-2 text-success"></i> Tambah Portofolio
                            </a>
                            <a class="dropdown-item addTraining" href="javascript:void(0);" 
                               data-id="<?php echo $obj->id;?>" data-juleha-id="<?php echo $cleanJulehaId;?>" data-nickname="<?php echo $cleanNick;?>">
                              <i class="fas fa-graduation-cap mr-2 text-secondary"></i> Tambah Pelatihan
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-primary font-weight-bold" target="_blank" href="<?php echo base_url('members/showcard/' . rawurlencode($cleanJulehaId)); ?>">
                              <i class="fas fa-id-card mr-2"></i> Lihat & Cetak KTA
                            </a>
                            <a class="dropdown-item text-info font-weight-bold" target="_blank" href="<?php echo base_url('members/uploder/' . rawurlencode($cleanJulehaId)); ?>">
                              <i class="fas fa-camera mr-2"></i> Upload / Ganti Foto
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item toggleStatus <?php echo $isAktif ? 'text-warning' : 'text-success'; ?>" href="javascript:void(0);"
                               data-id="<?php echo $obj->id;?>" data-juleha-id="<?php echo $cleanJulehaId;?>" data-nickname="<?php echo $cleanNick;?>" data-status="<?php echo $isAktif ? '0' : '1'; ?>">
                              <i class="fas <?php echo $isAktif ? 'fa-user-slash text-warning' : 'fa-user-check text-success'; ?> mr-2"></i> 
                              <?php echo $isAktif ? 'Jadikan Non Aktif' : 'Jadikan Aktif'; ?>
                            </a>
                            <a class="dropdown-item btn-delete-member text-danger" href="javascript:void(0);"
                               data-id="<?php echo $obj->id;?>" data-juleha-id="<?php echo $cleanJulehaId;?>" data-nickname="<?php echo $cleanNick;?>">
                              <i class="fas fa-trash-alt mr-2 text-danger"></i> Hapus Data Anggota
                            </a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <?php }?>
                    </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Versi</b> 1.0 (Auto-Compress & Mobile Optimized)
    </div>
    <strong>Copyright &copy; 2021-2026 <a href="https://julehajatim.com" target="_blank">Juru Sembelih Halal (Juleha) Jawa Timur</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php $this->load->view('common/footerscripts');?>
<?php $this->load->view('members/add');?>
<?php $this->load->view('members/edit');?>
<?php $this->load->view('members/addCertificate');?>
<?php $this->load->view('members/addPortofolio');?>
<?php $this->load->view('members/addTraining');?>
<?php $this->load->view('members/editPassword');?>

<script>
  // Helper universal untuk mendeteksi ID dan Juleha ID di desktop maupun responsive child row
  function extractRowMember(el) {
    var $el = $(el);
    var id = $el.data('id');
    var julehaId = $el.data('juleha-id');
    var nickname = $el.data('nickname');

    if (!id || !julehaId) {
      var $row = $el.closest('tr');
      if ($row.hasClass('child')) {
        $row = $row.prev('tr');
      }
      id = $row.attr('id') || $row.data('id');
      julehaId = $row.find('.juleha_id').text().trim() || $row.data('juleha-id');
      nickname = $row.find('td:eq(1)').text().trim() || $row.data('nickname');
    }
    return { id: id, julehaId: julehaId, nickname: nickname };
  }

  // 1. Tambah Sertifikat
  $('#example2').on('click', '.addCertificate', function(e){
    e.preventDefault();
    var info = extractRowMember(this);
    $('#cert_member_id').val(info.id);
    $('#cert_member_info').text((info.nickname || '') + ' (' + info.julehaId + ')');
    $('#txtCertSubject').val('');
    $('#modal-lg-certificate').modal('show');
  });

  // 2. Tambah Portofolio
  $('#example2').on('click', '.addPortofolio', function(e){
    e.preventDefault();
    var info = extractRowMember(this);
    $('#porto_member_id').val(info.id);
    $('#porto_member_info').text((info.nickname || '') + ' (' + info.julehaId + ')');
    $('#txtPortoSubject').val('');
    $('#modal-lg-portofolio').modal('show');
  });

  // 3. Tambah Pelatihan
  $('#example2').on('click', '.addTraining', function(e){
    e.preventDefault();
    var info = extractRowMember(this);
    $('#training_member_id').val(info.id);
    $('#training_member_info').text((info.nickname || '') + ' (' + info.julehaId + ')');
    $('#txtTrainingSubject').val('');
    $('#txtTrainingRole').val('Peserta');
    $('#modal-lg-training').modal('show');
  });

  // 4. Ubah Password
  $('#example2').on('click', '.btneditpassword', function(e){
    e.preventDefault();
    var info = extractRowMember(this);
    $('#txtEditPasswordMemberId').val(info.id);
    $('#txtEditPasswordJulehaId').val(info.julehaId);
    $('#txtEditPasswordMemberInfo').text((info.nickname || '') + ' (' + info.julehaId + ')');
    $('#txtEditPassword').val('');
    $('#txtEditPassword2').val('');
    $('#modal-lg-edit-password').modal('show');
  });

  // 5. Edit Data Anggota
  $('#example2').on('click', '.edit', function(e){
    e.preventDefault();
    var info = extractRowMember(this);
    if (!info.julehaId) {
      alert('Gagal mendeteksi ID Juleha.');
      return;
    }

    $.ajax({
      url: '/members/get/' + encodeURIComponent(info.julehaId),
      type: 'GET',
      dataType: 'json'
    })
    .done(function(res){
      if (res && res.res) {
        var m = res.res;
        $('#txteditJulehaId').val(m.juleha_id);
        $('#txteditNickName').val(m.nickname);
        $('#txteditFirstName').val(m.firstname);
        $('#txteditLastName').val(m.lastname);
        $('#txteditAddress').val(m.address);
        $('#cmbeditRegion').val(m.region);
        if (m.region) {
          $('#cmbeditRegion option').each(function(){
            if ($(this).val().toUpperCase() === m.region.toUpperCase()){
              $(this).prop('selected', true);
            }
          });
        }
        $('#edit-modal-lg').modal('show');
      } else {
        alert('Data anggota tidak ditemukan.');
      }
    })
    .fail(function(err){
      alert('Gagal mengambil data anggota dari server.');
    });
  });

  // 6. Toggle Status Aktif / Non-Aktif
  $('#example2').on('click', '.toggleStatus', function(e){
    e.preventDefault();
    var info = extractRowMember(this);
    var targetStatus = $(this).data('status');
    var statusText = targetStatus == '1' ? 'MENGAKTIFKAN' : 'MENONAKTIFKAN';

    if (confirm('Apakah Anda yakin ingin ' + statusText + ' status anggota: ' + (info.nickname || info.julehaId) + '?')) {
      $.ajax({
        url: '/members/updatedata',
        type: 'POST',
        data: {
          tableName: 'members',
          columns: {
            id: info.id,
            juleha_id: info.julehaId,
            mstatus: targetStatus
          }
        },
        dataType: 'json'
      })
      .done(function(res){
        location.reload();
      })
      .fail(function(err){
        alert('Gagal mengubah status anggota.');
      });
    }
  });

  // 7. Hapus Data Anggota Permanen (Khusus Admin)
  $('#example2').on('click', '.btn-delete-member', function(e){
    e.preventDefault();
    var info = extractRowMember(this);
    var memberName = info.nickname || info.julehaId || 'Anggota ini';

    var confirmMsg = 'PERINGATAN:\nApakah Anda yakin ingin MENGHAPUS PERMANEN data anggota:\n' + 
                     memberName + ' (' + info.julehaId + ')?\n\n' +
                     'Seluruh data terkait (sertifikat, portofolio, pelatihan, dan foto KTA) akan ikut terhapus.\n' +
                     'Tindakan ini TIDAK DAPAT DIBATALKAN!';

    if (confirm(confirmMsg)) {
      $.ajax({
        url: '/members/deletemember',
        type: 'POST',
        data: {
          id: info.id,
          juleha_id: info.julehaId
        },
        dataType: 'json'
      })
      .done(function(res){
        if (res && res.status) {
          alert('Berhasil: ' + (res.message || 'Data anggota berhasil dihapus.'));
          location.reload();
        } else {
          alert('Gagal: ' + (res.message || 'Tidak dapat menghapus data anggota.'));
        }
      })
      .fail(function(xhr, status, error){
        alert('Terjadi kesalahan saat memproses penghapusan anggota.');
      });
    }
  });
</script>
</body>
</html>
