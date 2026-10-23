<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/adminlte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="/assets/fontawesome-free-5.15.4-web/css/fontawesome.css">
  <link rel="stylesheet" href="/assets/fontawesome-free-5.15.4-web/css/brands.css">
  <link rel="stylesheet" href="/assets/fontawesome-free-5.15.4-web/css/solid.css">
  <style>
      #tmember td{
          padding: 10px;
      }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <!--<i class="far fa-comments"></i>-->
          <!--<i class="fas fa-arrow-right text-muted"></i>-->
          <!--<span class="badge badge-danger navbar-badge">3</span>-->
        </a>
      </li>
      <!-- Notifications Dropdown Menu -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $this->load->view('common/fakesidemenu')?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 id="btnProfil">Profil Anggota</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline" id="yourcard">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="/images/<?php echo strtoupper($juleha_id);?>.jpg"
                       alt="User profile picture" id="btnImg" width='80px' height='120px'>
                </div>

                <h3 class="profile-username text-center"><?php echo strtoupper($juleha_id);?></h3>

                <p class="text-muted text-center"><?php echo strtoupper($obj->nickname);?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Status</b> <a class="float-right"><?php echo $obj->mstatus;?></a>
                  </li>
                </ul>
                <button class="btn btn-primary btn-block" id="btnDownloadKTA" style="display:none"><b>Download KTA</b></button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Keterangan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Kota</strong>

                <p class="text-muted">
                <?php echo strtoupper($obj->region);?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                <p class="text-muted"><?php echo $obj->address;?></p>

                <hr>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!-- /.tab-pane -->
                    <div>
                        <table id="tmember">
                            <tr>
                                <td>ID JULEHA</td><td>:</td><td><?php echo strtoupper($obj->juleha_id) ;?></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td><td>:</td><td><?php echo $obj->firstname . " ". $obj->middlename . " " . $obj->lastname;?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td><td>:</td><td><?php echo $obj->address . ", ". strtoupper($obj->region) ;?></td>
                            </tr>
                            <tr>
                                <td>Region</td><td>:</td><td><?php echo strtoupper($obj->region) ;?></td>
                            </tr>
                            <tr>
                                <td>Status</td><td>:</td><td><?php echo strtoupper($obj->mstatus) ;?></td>
                            </tr>
                        </table>
                    </div>
                  <div class="tab-pane" id="kta">
                  <img id="templatekta" src="/images/templatekta.jpeg" alt="" srcset="">
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0-rc
    </div>
    <strong>Copyright &copy; 2022 <a href="https://julehajatim.com">julehajatim.com</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<canvas id="c" style="display:none"></canvas>
<!-- ./wrapper -->
<input style="display:none" type="file" name="uploader" id="uploader">
<!-- jQuery -->
<script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="/assets/adminlte/dist/js/demo.js"></script>-->
<script src="/assets/puji/puji.image.js"></script>
<script src="/assets/puji/juleha.js"></script>
<?php $this->load->view('members/editPassword');?>

<script>
$("#btnDownloadKTA").click(function(){
  console.log("KTA hould be downloaded")
  odownload({
    nickname:"<?php echo $obj->nickname;?>",
    juleha_id:"<?php echo $obj->juleha_id;?>"
  });
});
$("#btnDownloadApp").click(function(){

})
$('#btnImg').click(function(){
  $("#uploader").click();
})
$("#uploader").change(function(){
    var reader = new FileReader()
    reader.onload = imageIsLoaded
    reader.readAsDataURL(this.files[0])
  })

  imageIsLoaded = e=>{
    $('#btnImg').attr('src',e.target.result)
    setTimeout(() => {
      saveImage()
    }, 1000);
  }
  svImage = _=>{
    resizeImage(document.getElementById("btnImg"),function(out){
      console.log('OUT',out)
      $.ajax({
        url:'/members/save_image',
        data:{
          image:out.replace(/^data:image\/(png|jpg);base64,/, ""),
          imagename:'<?php echo $juleha_id;?>'
        },
        type:'post',
        dataType:'json'
      })
      .done(res=>{
        console.log('OoutJ',res)
      })
      .fail(err=>{
        console.log('ERr save image',err)
      })
    })
  }
  saveImage = _=>{
    myimg = document.getElementById("btnImg");
    $.ajax({
      url:'/members/save_image',
      data:{
        image:getBase64Image(myimg),
        imagename:'<?php echo $juleha_id;?>'
      },
      type:'post',
      dataType:'json'
    })
    .done(res=>{
      console.log('OJ',res)
    })
    .fail(err=>{
      console.log('ERr save image',err)
    })
  }
  $("#btnLogout").click(function(){
    window.location.href = '/members/login'
  });
  $('#btnProfil').click(function(){
    saveImage();
  });
  $("#btnChangePassword").click(function(){
    idedit = <?php echo $obj->id;?>;
    $("#modal-lg-edit-password").modal();
  });

  var download = function(obj){
    myimg = new Image();
//    myimg.src = logo;
templatekta = document.getElementById("templatekta")
//templatekta = $("#templatekta").attr("src")
myimg.src = templatekta;//kartu;
    var canvas = document.createElement("canvas");
    var ctx = canvas.getContext("2d");
    ctx.fillStyle = 'rgb(255, 255, 200)';
  //  ctx.fillRect(0, 0, 1500, 500);


//    ctx.fillStyle = 'rgb(0, 0, 0)';
//    ctx.fillRect(0, 0, 1500, 40);


    ctx.beginPath()
    ctx.moveTo(0,0)
//    ctx.drawImage(myimg, 5, 5,30,30);
    btnimg = document.getElementById("btnImg");
    //ctx.drawImage(btnimg, 5, 45,50,50);

    ctx.drawImage(templatekta,0,0)
    ctx.fillStyle = 'rgb(200, 200, 200)';
    //ctx.fillRect(10, 10, 50, 50);
    ctx.font = '16px serif';
    ctx.fillText('Jurux Sembelih Halal Jawa Timur', 60, 30);
    ctx.font = '12px serif';
    ctx.fillStyle = 'rgb(0, 0, 0)';
    ctx.fillText('Nama       : '+obj.nickname, 100, 60);
    ctx.font = '12px serif';
    ctx.fillStyle = 'rgb(0, 0, 0)';
    ctx.fillText('ID Juleha : '+obj.juleha_id, 100, 80);
    var link = document.createElement('a');
    link.download = 'kta.jpg';
    link.href = canvas.toDataURL("image/jpeg")
    link.click();
  }
  odownload = obj =>{
    var c = document.getElementById("c")
    c.setAttribute('id','c')
    var ctx = c.getContext("2d");
    var img = document.getElementById("templatekta");
    c.height = img.height
    c.width = img.width
    ctx.drawImage(img, 0, 0);
    ctx.font = "32px Arial";
    ctx.textAlign = "center";
    ctx.fillStyle = 'rgb(0, 0, 0)';
    ctx.fillText(obj.nickname, img.width/2, img.height*0.76);

    ctx.font = "30px Arial";
    ctx.textAlign = "center";
    ctx.fillStyle = 'rgb(0, 0, 0)';
    ctx.fillText(obj.juleha_id, img.width/2, img.height*0.8);

    photo = document.getElementById('btnImg')
//    ctx.textAlign = "center";
    ctx.drawImage(photo, img.width/2 - 200, img.height*0.40,400,410);
    var link = document.createElement('a');
    link.download = 'kta.png';
    link.href = document.getElementById('c').toDataURL()
    link.click();
  }
  </script>
</body>
</html>
