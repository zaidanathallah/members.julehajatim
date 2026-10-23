<div class="modal fade" id="modal-lg-edit-password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow border-0">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-key mr-2"></i>Ubah Password Anggota</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <input type="hidden" id="txtEditPasswordMemberId">
                <input type="hidden" id="txtEditPasswordJulehaId">
                <div class="alert alert-secondary py-2 px-3 mb-3" style="font-size: 0.95rem;">
                    <i class="fas fa-user-lock mr-1"></i> Anggota: <strong id="txtEditPasswordMemberInfo">-</strong>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Password Baru <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="txtEditPassword" placeholder="Masukkan password baru" required>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Ulangi Password Baru <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="txtEditPassword2" placeholder="Ketik ulang password baru" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between bg-light">
                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Batalkan</button>
                <button type="button" class="btn btn-primary px-4 font-weight-bold" id="btnUpdatePassword"><i class="fas fa-check mr-1"></i> Simpan Password</button>
            </div>
        </div>
    </div>
</div>

<script>
(function($){
    $('#btnUpdatePassword').click(function(){
        var memberId = $('#txtEditPasswordMemberId').val();
        var julehaId = $('#txtEditPasswordJulehaId').val();
        var pwd1     = $('#txtEditPassword').val();
        var pwd2     = $('#txtEditPassword2').val();

        if(!pwd1){
            alert('Silakan masukkan password baru!');
            $('#txtEditPassword').focus();
            return;
        }

        if(pwd1 !== pwd2){
            alert('Password dan Ulangi Password tidak sama!');
            $('#txtEditPassword2').focus();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...');

        $.ajax({
            url: '/members/update',
            type: 'POST',
            data: {
                tableName: 'members',
                columns: {
                    id: memberId,
                    juleha_id: julehaId,
                    password: pwd1
                }
            },
            dataType: 'json'
        })
        .done(function(res){
            alert('Password berhasil diperbarui.');
            $('#modal-lg-edit-password').modal('hide');
            location.reload();
        })
        .fail(function(err){
            alert('Gagal memperbarui password. Silakan coba lagi.');
            btn.prop('disabled', false).html('<i class="fas fa-check mr-1"></i> Simpan Password');
        });
    });
})(jQuery);
</script>
