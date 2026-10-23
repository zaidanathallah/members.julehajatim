<div class="modal fade" id="edit-modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Anggota</h4>
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
                          <input type="text" class="form-control" disabled="disabled" id="txteditJulehaId" placeholder="ID Juleha">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nama Panggilan</label>
                          <input type="text" class="form-control" id="txteditNickName" placeholder="Nama Panggilan">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Nama Pertama</label>
                          <input type="text" class="form-control" id="txteditFirstName" placeholder="Nama Pertama">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Nama Akhir</label>
                          <input type="text" class="form-control" id="txteditLastName" placeholder="Nama Akhir">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Alamat</label>
                          <input type="text" class="form-control" id="txteditAddress" placeholder="Alamat">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Kab/Kota</label>
                          <?php echo form_dropdown("region",$region,"1","id=cmbeditRegion");?>
                        </div>
                        <div class="form-group" style="display:none">
                          <label for="exampleInputFile">File input</label>
                          <img src="" alt="" id="editimg">
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="exampleeditInputFile">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                              <span class="input-group-text">Upload</span>
                            </div>
                          </div>
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
            <button type="button" class="btn btn-primary" id="btnUpdate">Update</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<script src="/assets/puji/puji.image.js"></script>
<script>
console.log('add invoked');
(function($){
  $('#btnUpdate').click(function(){
    console.log('test');
    myimg = document.getElementById("editimg");
    $.ajax({
      url:'/members/updatedata',
      data:{
        tableName:'members',
        columns:{
          juleha_id:$('#txteditJulehaId').val(),
          nickname:$('#txteditNickName').val(),
          firstname:$('#txteditFirstName').val(),
          lastname:$('#txteditLastName').val(),
          address:$('#txteditAddress').val(),
          region:$('#cmbeditRegion').val(),
          position:$('#cmbeditRole').val(),
        },
        //img:getBase64Image(myimg),
        img: $('#editimg').attr('src')
      },
      type:'post',
      dataType:'json'
    })
    .done(res=>{
      console.log('Res',res)
      $("#edit-modal-lg").modal("hide")
    })
    .fail(err=>{
      console.log("Err",err)
      $("#edit-modal-lg").modal("hide")
    })
  });
  $("#exampleInputFile").change(function(){
    var reader = new FileReader()
    reader.onload = imageIsLoaded
    reader.readAsDataURL(this.files[0])
  })
  imageIsLoaded = e=>{
    $('#editimg').attr('src',e.target.result)
  }
}(jQuery))
</script>
