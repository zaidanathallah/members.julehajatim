<div class="modal fade" id="modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow border-0" style="border-radius: 14px; overflow: hidden;">
      
      <!-- Modal Header -->
      <div class="modal-header bg-primary text-white py-3">
        <h5 class="modal-title font-weight-bold">
          <i class="fas fa-user-plus mr-2"></i>Penambahan Anggota Baru
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-4 bg-white">
        <form id="formAddMember">
          <div class="row">
            
            <!-- Kolom Kiri: Akun & Penomoran -->
            <div class="col-md-6">
              <div class="form-group">
                <label class="font-weight-bold text-dark">
                  <i class="fas fa-map-marker-alt text-danger mr-1"></i> Wilayah Kab / Kota <span class="text-danger">*</span>
                </label>
                <select id="cmbRegion" class="form-control custom-select">
                  <?php foreach($region as $k => $v): ?>
                    <option value="<?php echo htmlspecialchars($k, ENT_QUOTES, 'UTF-8'); ?>">
                      <?php echo htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label class="font-weight-bold text-dark">
                  <i class="fas fa-id-badge text-primary mr-1"></i> Nomor ID Juleha <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                  <input type="text" class="form-control font-weight-bold text-primary" id="txtJulehaId" placeholder="Klik 'Auto ID' / ketik manual" required>
                  <div class="input-group-append">
                    <button class="btn btn-outline-primary font-weight-bold" type="button" id="btnGenerateJulehaID" title="Generate ID Berdasarkan Wilayah">
                      <i class="fas fa-magic mr-1"></i> Auto ID
                    </button>
                  </div>
                </div>
                <small class="form-text text-muted">Contoh: SDA240001 (Bisa digenerate otomatis)</small>
              </div>

              <div class="form-group">
                <label class="font-weight-bold text-dark">
                  <i class="fas fa-lock text-warning mr-1"></i> Password Akun <span class="text-danger">*</span>
                </label>
                <input type="password" class="form-control" id="txtPassword" placeholder="Buat password login anggota" required>
              </div>

              <div class="form-group">
                <label class="font-weight-bold text-dark">
                  <i class="fas fa-user-tag text-info mr-1"></i> Jenis Keanggotaan
                </label>
                <select id="cmbRole" class="form-control custom-select">
                  <option value="Anggota" selected>Anggota</option>
                  <option value="Pengurus">Pengurus</option>
                </select>
              </div>
            </div>

            <!-- Kolom Kanan: Identitas & Alamat -->
            <div class="col-md-6">
              <div class="form-group">
                <label class="font-weight-bold text-dark">
                  <i class="fas fa-user text-success mr-1"></i> Nama Panggilan (Untuk KTA) <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control font-weight-bold" id="txtNickName" placeholder="Contoh: Arif Hermanto" required>
                <small class="form-text text-muted">Nama yang dicetak di Kartu Tanda Anggota</small>
              </div>

              <div class="form-row">
                <div class="col-6 form-group">
                  <label class="font-weight-bold text-dark">Nama Depan</label>
                  <input type="text" class="form-control" id="txtFirstName" placeholder="Nama Depan">
                </div>
                <div class="col-6 form-group">
                  <label class="font-weight-bold text-dark">Nama Belakang</label>
                  <input type="text" class="form-control" id="txtLastName" placeholder="Nama Belakang">
                </div>
              </div>

              <div class="form-group">
                <label class="font-weight-bold text-dark">
                  <i class="fas fa-home text-secondary mr-1"></i> Alamat Lengkap
                </label>
                <textarea class="form-control" id="txtAddress" rows="3" placeholder="Alamat domisili lengkap"></textarea>
              </div>
            </div>
          </div>

          <!-- Section Foto KTA -->
          <div class="card bg-light border p-3 mt-2 mb-0" style="border-radius: 10px;">
            <label class="font-weight-bold mb-2 text-dark">
              <i class="fas fa-camera text-primary mr-1"></i> Foto KTA Anggota (Opsional)
            </label>
            <div class="row align-items-center">
              <div class="col-auto text-center">
                <img id="imgPreviewAdd" src="https://via.placeholder.com/90x110?text=Foto+KTA" alt="Preview Foto" class="img-thumbnail shadow-sm" style="width: 85px; height: 110px; object-fit: cover; border-radius: 8px;">
              </div>
              <div class="col">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="exampleInputFile" accept=".jpg,.jpeg,.png">
                  <label class="custom-file-label text-truncate" for="exampleInputFile" id="lblFileInput">Pilih foto dari perangkat...</label>
                </div>
                <small class="form-text text-muted mt-2">
                  <i class="fas fa-check-circle text-success mr-1"></i> Format: <strong>JPG, JPEG, PNG</strong>. Foto resolusi tinggi/kamera HP akan <strong>otomatis dikompres & disesuaikan</strong> oleh sistem.
                </small>
              </div>
            </div>
          </div>
        </form>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer justify-content-between bg-light py-3">
        <button type="button" class="btn btn-secondary px-4 font-weight-bold" data-dismiss="modal">
          <i class="fas fa-times mr-1"></i> Batal
        </button>
        <button type="button" class="btn btn-primary px-4 font-weight-bold shadow-sm" id="btnSave">
          <i class="fas fa-save mr-1"></i> Simpan Data Anggota
        </button>
      </div>

    </div>
  </div>
</div>

<script>
(function($){
  // 1. Fungsi Fetch ID Otomatis Berdasarkan Wilayah
  function fetchNextId(region) {
    if(!region) {
      region = $("#cmbRegion").val();
    }
    if(!region) return;

    var btn = $("#btnGenerateJulehaID");
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Memuat...');

    $.ajax({
      url: "/members/getmax/" + encodeURIComponent(region),
      dataType: "json"
    })
    .done(function(res){
      if(res && res.res && res.res.length > 0){
        var generatedId = res.res[0].m;
        var prefix = (res.initial) ? res.initial : region;
        $('#txtJulehaId').val(prefix + generatedId);
      }
      btn.prop('disabled', false).html('<i class="fas fa-magic mr-1"></i> Auto ID');
    })
    .fail(function(err){
      console.log("Gagal fetch ID maksimal", err);
      btn.prop('disabled', false).html('<i class="fas fa-magic mr-1"></i> Auto ID');
    });
  }

  // Auto generate saat ganti wilayah
  $("#cmbRegion").on("change", function(){
    fetchNextId($(this).val());
  });

  // Tombol Auto ID manual
  $("#btnGenerateJulehaID").on("click", function(){
    fetchNextId($("#cmbRegion").val());
  });

  // Saat tombol Tambah Anggota diklik maupun saat modal ditampilkan
  $('[data-target="#modal-lg"]').on('click', function(){
    setTimeout(function(){
      fetchNextId($("#cmbRegion").val());
    }, 50);
  });

  $('#modal-lg').on('show.bs.modal shown.bs.modal', function(){
    fetchNextId($("#cmbRegion").val());
  });

  // 2. Preview Foto KTA
  $("#exampleInputFile").on("change", function(){
    if (this.files && this.files[0]) {
      var file = this.files[0];
      $("#lblFileInput").text(file.name);
      var reader = new FileReader();
      reader.onload = function(e){
        $("#imgPreviewAdd").attr("src", e.target.result);
      };
      reader.readAsDataURL(file);
    }
  });

  // 3. Simpan Anggota Baru via AJAX
  $('#btnSave').on("click", function(){
    var julehaId = $('#txtJulehaId').val().trim();
    var nickName = $('#txtNickName').val().trim();
    var password = $('#txtPassword').val().trim();

    if(!julehaId){
      alert('Harap isi atau generate Nomor ID Juleha!');
      $('#txtJulehaId').focus();
      return;
    }
    if(!nickName){
      alert('Harap isi Nama Panggilan anggota untuk KTA!');
      $('#txtNickName').focus();
      return;
    }
    if(!password){
      alert('Harap buat password untuk akun anggota!');
      $('#txtPassword').focus();
      return;
    }

    var btn = $(this);
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan Data Anggota...');

    var formData = new FormData();
    formData.append('tableName', 'members');
    formData.append('columns[juleha_id]', julehaId);
    formData.append('columns[nickname]', nickName);
    formData.append('columns[firstname]', $('#txtFirstName').val().trim());
    formData.append('columns[lastname]', $('#txtLastName').val().trim());
    formData.append('columns[address]', $('#txtAddress').val().trim());
    formData.append('columns[region]', $('#cmbRegion').val());
    formData.append('columns[position]', $('#cmbRole').val());
    formData.append('columns[password]', password);
    formData.append('columns[mstatus]', '1'); // Default status aktif

    var fileInput = document.getElementById('exampleInputFile');
    if (fileInput.files.length > 0) {
      formData.append('img_file', fileInput.files[0]);
    }

    $.ajax({
      url: '/members/save',
      type: 'POST',
      data: formData,
      dataType: 'json',
      processData: false,
      contentType: false
    })
    .done(function(res){
      btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Data Anggota');

      var finalJulehaId = (res && res.juleha_id) ? res.juleha_id : julehaId;
      var finalNickName = (res && res.nickname) ? res.nickname : nickName;
      var finalMemberId = (res && res.id) ? res.id : '';
      var finalRegion   = (res && res.region) ? res.region : $('#cmbRegion').val();
      var finalPosition = (res && res.position) ? res.position : ($('#cmbRole').val() || 'Anggota');
      var finalAddress  = (res && res.address) ? res.address : $('#txtAddress').val().trim();

      // 1. Tutup modal penambahan anggota
      $("#modal-lg").modal("hide");

      // 2. Bersihkan isian form untuk pendaftaran berikutnya
      $('#formAddMember')[0].reset();
      $('#imgPreviewAdd').attr('src', 'https://via.placeholder.com/90x110?text=Foto+KTA');
      $('#lblFileInput').text('Pilih foto dari perangkat...');

      // 3. Masukkan data anggota baru LANGSUNG ke DataTables frontend tanpa perlu refresh browser
      var dt = window.membersTable || ($.fn.DataTable.isDataTable('#example2') ? $('#example2').DataTable() : null);

      if (dt) {
        var cleanNick = $('<div>').text(finalNickName).html();
        var cleanJulehaId = $('<div>').text(finalJulehaId).html();
        var cleanRegion = $('<div>').text(finalRegion).html();
        var cleanPosition = $('<div>').text(finalPosition || '-').html();
        var cleanAddress = $('<div>').text(finalAddress || '-').html();
        var encodedId = encodeURIComponent(finalJulehaId);

        var rowHtml = '<tr id="' + finalMemberId + '" data-id="' + finalMemberId + '" data-juleha-id="' + cleanJulehaId + '" data-nickname="' + cleanNick + '" class="table-success">' +
          '<td class="juleha_id font-weight-bold text-primary">' +
            '<a href="/members/showcard/' + encodedId + '" target="_blank" title="Lihat Kartu KTA">' + cleanJulehaId + '</a>' +
          '</td>' +
          '<td><strong>' + cleanNick + '</strong></td>' +
          '<td><span class="badge badge-light border">' + cleanRegion + '</span></td>' +
          '<td>' + cleanPosition + '</td>' +
          '<td><small class="text-muted">' + cleanAddress + '</small></td>' +
          '<td class="text-center">' +
            '<span class="badge badge-info badge-count" title="Jumlah Sertifikat"><i class="fas fa-certificate mr-1"></i>0</span>' +
          '</td>' +
          '<td class="text-center">' +
            '<span class="badge badge-success badge-count" title="Jumlah Portofolio"><i class="fas fa-briefcase mr-1"></i>0</span>' +
          '</td>' +
          '<td class="text-center">' +
            '<span class="badge badge-warning badge-count" title="Jumlah Pelatihan"><i class="fas fa-graduation-cap mr-1"></i>0</span>' +
          '</td>' +
          '<td class="text-center">' +
            '<span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i>Aktif</span>' +
          '</td>' +
          '<td class="text-center">' +
            '<div class="btn-group">' +
              '<button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle btn-action-mobile" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">' +
                '<i class="fas fa-cog mr-1"></i> Opsi' +
              '</button>' +
              '<div class="dropdown-menu dropdown-menu-right shadow" role="menu">' +
                '<a class="dropdown-item edit" href="javascript:void(0);" data-id="' + finalMemberId + '" data-juleha-id="' + cleanJulehaId + '" data-nickname="' + cleanNick + '">' +
                  '<i class="fas fa-edit mr-2 text-primary"></i> Edit Data Anggota' +
                '</a>' +
                '<a class="dropdown-item btneditpassword" href="javascript:void(0);" data-id="' + finalMemberId + '" data-juleha-id="' + cleanJulehaId + '" data-nickname="' + cleanNick + '">' +
                  '<i class="fas fa-key mr-2 text-warning"></i> Ubah Password' +
                '</a>' +
                '<div class="dropdown-divider"></div>' +
                '<a class="dropdown-item addCertificate" href="javascript:void(0);" data-id="' + finalMemberId + '" data-juleha-id="' + cleanJulehaId + '" data-nickname="' + cleanNick + '">' +
                  '<i class="fas fa-certificate mr-2 text-info"></i> Tambah Sertifikat' +
                '</a>' +
                '<a class="dropdown-item addPortofolio" href="javascript:void(0);" data-id="' + finalMemberId + '" data-juleha-id="' + cleanJulehaId + '" data-nickname="' + cleanNick + '">' +
                  '<i class="fas fa-briefcase mr-2 text-success"></i> Tambah Portofolio' +
                '</a>' +
                '<a class="dropdown-item addTraining" href="javascript:void(0);" data-id="' + finalMemberId + '" data-juleha-id="' + cleanJulehaId + '" data-nickname="' + cleanNick + '">' +
                  '<i class="fas fa-graduation-cap mr-2 text-secondary"></i> Tambah Pelatihan' +
                '</a>' +
                '<div class="dropdown-divider"></div>' +
                '<a class="dropdown-item text-primary font-weight-bold" target="_blank" href="/members/showcard/' + encodedId + '">' +
                  '<i class="fas fa-id-card mr-2"></i> Lihat & Cetak KTA' +
                '</a>' +
                '<a class="dropdown-item text-info font-weight-bold" target="_blank" href="/members/uploder/' + encodedId + '">' +
                  '<i class="fas fa-camera mr-2"></i> Upload / Ganti Foto' +
                '</a>' +
                '<div class="dropdown-divider"></div>' +
                '<a class="dropdown-item toggleStatus text-warning" href="javascript:void(0);" data-id="' + finalMemberId + '" data-juleha-id="' + cleanJulehaId + '" data-nickname="' + cleanNick + '" data-status="0">' +
                  '<i class="fas fa-user-slash text-warning mr-2"></i> Jadikan Non Aktif' +
                '</a>' +
                '<a class="dropdown-item btn-delete-member text-danger" href="javascript:void(0);" data-id="' + finalMemberId + '" data-juleha-id="' + cleanJulehaId + '" data-nickname="' + cleanNick + '">' +
                  '<i class="fas fa-trash-alt mr-2 text-danger"></i> Hapus Data Anggota' +
                '</a>' +
              '</div>' +
            '</div>' +
          '</td>' +
        '</tr>';

        // Sisipkan baris baru ke DataTables secara instan
        var addedRow = dt.row.add($(rowHtml)).draw(false);

        // Filter / Cari langsung ke nomor ID Juleha ini agar otomatis TAMPIL DI DEPAN LAYAR
        dt.search(finalJulehaId).draw();

        var node = addedRow.node();
        if (node) {
          $('html, body').animate({
            scrollTop: $(node).offset().top - 140
          }, 400);

          setTimeout(function(){
            $(node).removeClass('table-success');
          }, 5000);
        }

        alert('Alhamdulillah! Anggota baru ' + finalNickName + ' (' + finalJulehaId + ') berhasil ditambahkan dan otomatis tampil di tabel!');
      } else {
        // Fallback jika ditambahkan dari halaman luar tabel
        alert('Alhamdulillah! Anggota baru ' + finalNickName + ' (' + finalJulehaId + ') berhasil ditambahkan!');
        window.location.href = '/members/index';
      }
    })
    .fail(function(err){
      alert('Gagal menyimpan data anggota. Pastikan ID Juleha belum pernah digunakan.');
      btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Data Anggota');
    });
  });
})(jQuery);
</script>
