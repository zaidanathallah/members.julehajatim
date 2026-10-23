<div class="modal fade" id="modal-lg-certificate">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Penambahan Sertifikat</h4>
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
                      <label for="exampleInputEmail1">ID Juleha</label>
                      <input type="text" class="form-control" id="txtJulehaId" placeholder="ID Juleha">
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Judul</label>
                      <input type="text" class="form-control" id="txtNickName" placeholder="Nama Panggilan">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Tanggal Sertifikat</label>
                      <input type="text" class="form-control" id="txtFirstName" placeholder="Nama Pertama">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="exampleInputFile">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text">Upload</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
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
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary" id="btnSaveCertifcate">Simpan</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<script>
console.log('add invoked');
(function($){
  $('#btnSaveCertifcate').click(function(){
    console.log('test');
    $.ajax({
      url:'/members/save',
      data:{
        tableName:'certificates',
        columns:{
          subject:$('#txtSubject').val(),
          certificatedate:$('#dtcertificatedate').val(),
          member_id:1,
        }
        
      }
    })
  });

}(jQuery))
</script>
