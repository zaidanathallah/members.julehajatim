<div class="modal fade" id="edit-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow border-0" style="border-radius: 14px; overflow: hidden;">
      
      <!-- Modal Header -->
      <div class="modal-header bg-warning text-dark py-3">
        <h5 class="modal-title font-weight-bold">
          <i class="fas fa-user-edit mr-2"></i>Edit Data Anggota Juleha
        </h5>
        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close" style="opacity: 0.9;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-4 bg-white">
        <form id="formEditMember">
          <div class="row">
            
            <!-- Kolom Kiri: Akun & Penomoran -->
            <div class="col-md-6">
              <div class="form-group">
                <label class="font-weight-bold text-dark">
                  <i class="fas fa-id-badge text-primary mr-1"></i> Nomor ID Juleha
                </label>
                <input type="text" class="form-control font-weight-bold bg-light" id="txteditJulehaId" readonly>
                <small class="form-text text-muted">ID Juleha bersifat permanen sebagai identitas anggota</small>
              </div>

              <div class="form-group">
                <label class="font-weight-bold text-dark">
                  <i class="fas fa-map-marker-alt text-danger mr-1"></i> Wilayah Kab / Kota <span class="text-danger">*</span>
                </label>
                <select id="cmbeditRegion" class="form-control custom-select">
                  <?php foreach($region as $k => $v): ?>
                    <option value="<?php echo htmlspecialchars($k, ENT_QUOTES, 'UTF-8'); ?>">
                      <?php echo htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label class="font-weight-bold text-dark">
                  <i class="fas fa-user-tag text-info mr-1"></i> Jenis Keanggotaan
                </label>
                <select id="cmbeditRole" class="form-control custom-select">
                  <option value="Anggota">Anggota</option>
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
                <input type="text" class="form-control font-weight-bold" id="txteditNickName" placeholder="Contoh: Arif Hermanto" required>
                <small class="form-text text-muted">Nama yang dicetak di Kartu Tanda Anggota</small>
              </div>

              <div class="form-row">
                <div class="col-6 form-group">
                  <label class="font-weight-bold text-dark">Nama Depan</label>
                  <input type="text" class="form-control" id="txteditFirstName" placeholder="Nama Depan">
                </div>
                <div class="col-6 form-group">
                  <label class="font-weight-bold text-dark">Nama Belakang</label>
                  <input type="text" class="form-control" id="txteditLastName" placeholder="Nama Belakang">
                </div>
              </div>

              <div class="form-group">
                <label class="font-weight-bold text-dark">
                  <i class="fas fa-home text-secondary mr-1"></i> Alamat Lengkap
                </label>
                <textarea class="form-control" id="txteditAddress" rows="3" placeholder="Alamat domisili anggota"></textarea>
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
        <button type="button" class="btn btn-warning px-4 font-weight-bold shadow-sm" id="btnUpdate">
          <i class="fas fa-save mr-1"></i> Simpan Perubahan
        </button>
      </div>

    </div>
  </div>
</div>

<script>
(function($){
  $('#btnUpdate').on("click", function(){
    var julehaId = $('#txteditJulehaId').val().trim();
    var nickName = $('#txteditNickName').val().trim();

    if(!nickName){
      alert('Nama Panggilan tidak boleh kosong!');
      $('#txteditNickName').focus();
      return;
    }

    var btn = $(this);
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan Perubahan...');

    $.ajax({
      url: '/members/updatedata',
      type: 'POST',
      data: {
        tableName: 'members',
        columns: {
          juleha_id: julehaId,
          nickname: nickName,
          firstname: $('#txteditFirstName').val().trim(),
          lastname: $('#txteditLastName').val().trim(),
          address: $('#txteditAddress').val().trim(),
          region: $('#cmbeditRegion').val(),
          position: $('#cmbeditRole').val()
        }
      },
      dataType: 'json'
    })
    .done(function(res){
      alert('Data anggota ' + nickName + ' berhasil diperbarui!');
      $("#edit-modal-lg").modal("hide");
      location.reload();
    })
    .fail(function(err){
      alert('Gagal memperbarui data anggota. Silakan periksa koneksi.');
      btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Perubahan');
    });
  });
})(jQuery);
</script>
