<div class="modal fade" id="modal-lg-training" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow border-0">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-graduation-cap mr-2"></i>Penambahan Pelatihan Anggota</h5>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <input type="hidden" id="training_member_id">
                <div class="alert alert-info py-2 px-3 mb-3" style="font-size: 0.95rem;">
                    <i class="fas fa-user mr-1"></i> Anggota: <strong id="training_member_info">-</strong>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Nama / Judul Pelatihan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="txtTrainingSubject" placeholder="Contoh: Bimbingan Teknis Standar Higiene dan Sanitasi Penyembelihan" required>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Peran dalam Pelatihan</label>
                    <input type="text" class="form-control" id="txtTrainingRole" placeholder="Contoh: Peserta / Pemateri / Panitia" value="Peserta">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Tanggal Pelatihan <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="txtTrainingDate" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between bg-light">
                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-warning px-4 font-weight-bold" id="btnSaveTraining"><i class="fas fa-save mr-1"></i> Simpan Pelatihan</button>
            </div>
        </div>
    </div>
</div>

<script>
(function($){
    $('#btnSaveTraining').click(function(){
        var memberId = $('#training_member_id').val();
        var subject  = $('#txtTrainingSubject').val().trim();
        var role     = $('#txtTrainingRole').val().trim();
        var date     = $('#txtTrainingDate').val();

        if(!subject){
            alert('Harap isi Nama / Judul Pelatihan!');
            $('#txtTrainingSubject').focus();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...');

        $.ajax({
            url: '/members/save',
            type: 'POST',
            data: {
                tableName: 'trainings',
                columns: {
                    member_id: memberId,
                    subject: subject,
                    role: role,
                    eventdate: date
                }
            },
            dataType: 'json'
        })
        .done(function(res){
            $('#modal-lg-training').modal('hide');
            location.reload();
        })
        .fail(function(err){
            alert('Gagal menyimpan pelatihan. Silakan periksa koneksi.');
            btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Pelatihan');
        });
    });
})(jQuery);
</script>
