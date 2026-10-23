<div class="modal fade" id="modal-lg-certificate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-certificate mr-2"></i>Penambahan Sertifikat Anggota</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <input type="hidden" id="cert_member_id">
                <div class="alert alert-info py-2 px-3 mb-3" style="font-size: 0.95rem;">
                    <i class="fas fa-user mr-1"></i> Anggota: <strong id="cert_member_info">-</strong>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Nama / Judul Sertifikat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="txtCertSubject" placeholder="Contoh: Sertifikat Juru Sembelih Halal BNSP" required>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Tanggal Sertifikat <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="txtCertDate" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between bg-light">
                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary px-4 font-weight-bold" id="btnSaveCertificate"><i class="fas fa-save mr-1"></i> Simpan Sertifikat</button>
            </div>
        </div>
    </div>
</div>

<script>
(function($){
    $('#btnSaveCertificate').click(function(){
        var memberId = $('#cert_member_id').val();
        var subject  = $('#txtCertSubject').val().trim();
        var date     = $('#txtCertDate').val();

        if(!subject){
            alert('Harap isi Nama / Judul Sertifikat!');
            $('#txtCertSubject').focus();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...');

        $.ajax({
            url: '/members/save',
            type: 'POST',
            data: {
                tableName: 'certificates',
                columns: {
                    member_id: memberId,
                    subject: subject,
                    certificatedate: date
                }
            },
            dataType: 'json'
        })
        .done(function(res){
            $('#modal-lg-certificate').modal('hide');
            location.reload();
        })
        .fail(function(err){
            alert('Gagal menyimpan sertifikat. Silakan periksa koneksi.');
            btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Sertifikat');
        });
    });
})(jQuery);
</script>
