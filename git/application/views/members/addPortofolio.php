<div class="modal fade" id="modal-lg-portofolio" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow border-0">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-briefcase mr-2"></i>Penambahan Portofolio Anggota</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <input type="hidden" id="porto_member_id">
                <div class="alert alert-info py-2 px-3 mb-3" style="font-size: 0.95rem;">
                    <i class="fas fa-user mr-1"></i> Anggota: <strong id="porto_member_info">-</strong>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Kegiatan / Deskripsi Portofolio <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="txtPortoSubject" rows="3" placeholder="Contoh: Penyembelihan 50 Ekor Sapi Kurban Idul Adha Masjid Al-Akbar" required></textarea>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Tanggal Kegiatan <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="txtPortoDate" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between bg-light">
                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success px-4 font-weight-bold" id="btnSavePortofolio"><i class="fas fa-save mr-1"></i> Simpan Portofolio</button>
            </div>
        </div>
    </div>
</div>

<script>
(function($){
    $('#btnSavePortofolio').click(function(){
        var memberId = $('#porto_member_id').val();
        var subject  = $('#txtPortoSubject').val().trim();
        var date     = $('#txtPortoDate').val();

        if(!subject){
            alert('Harap isi Deskripsi Portofolio!');
            $('#txtPortoSubject').focus();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...');

        $.ajax({
            url: '/members/save',
            type: 'POST',
            data: {
                tableName: 'portofolio',
                columns: {
                    member_id: memberId,
                    subject: subject,
                    eventdate: date
                }
            },
            dataType: 'json'
        })
        .done(function(res){
            $('#modal-lg-portofolio').modal('hide');
            location.reload();
        })
        .fail(function(err){
            alert('Gagal menyimpan portofolio. Silakan periksa koneksi.');
            btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Portofolio');
        });
    });
})(jQuery);
</script>
