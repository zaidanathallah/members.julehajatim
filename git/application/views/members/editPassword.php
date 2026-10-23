<div class="modal fade" id="modal-lg-edit-password">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Password Anggota</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>
            <div class="container-fluid">
              <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                      <div class="card-body">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Password</label>
                          <input type="password" class="form-control" id="txtEditPassword" placeholder="Password">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Ulangi Password</label>
                          <input type="password" class="form-control" id="txtEditPassword2" placeholder="Konfirmasi Password">
                        </div>
                      </div>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <!--/.col (right) -->
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
            </p>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
            <button type="button" class="btn btn-primary" id="btnUpdatePassword">Simpan</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<script>
console.log('add invoked');
(function($){
  $('#btnUpdatePassword').click(function(){
    console.log('test',$('#example2 tr.selected').attr('id'));
    $.ajax({
      url:'/members/update',
      data:{
        tableName:'members',
        columns:{
          password:$('#txtEditPassword').val(),
          id:idedit,
        },
      },
      type:'post',
      dataType:'json'
    })
    .done(res=>{
      console.log('Res',res)
      $("#modal-lg-edit-password").modal("hide")
    })
    .fail(err=>{
      console.log("Err",err)
      $("#modal-lg-edit-password").modal("hide")
    })
  });
}(jQuery))
</script>
