<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('common/head');?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
        <li><button class="btn" data-toggle="modal" data-target="#modal-lg">Baru</button></li>
      <!-- Messages Dropdown Menu -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $this->load->view('common/sidemenu')?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Juleha Jatim</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Anggota</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar anggota Juleha Jawa Timur</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID Juleha</th>
                    <th>Panggilan</th>
                    <th>Region</th>
                    <th>Jabatan</th>
                    <th>Alamat</th>
                    <th>Sertifikat</th>
                    <th>Portofolio</th>
                    <th>Pelatihan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($objs as $obj){?>
                  <tr id=<?php echo $obj->id;?>>
                    <td class='juleha_id'><?php echo $obj->juleha_id?></td>
                    <td><?php echo $obj->nickname;?></td>
                    <td><?php echo $obj->region;?></td>
                    <td><?php echo $obj->position?></td>
                    <td><?php echo $obj->address?></td>
                    <td><?php echo $obj->certificate?></td>
                    <td><?php echo $obj->portofolio?></td>
                    <td><?php echo $obj->training?></td>
                    <td>
                    <button type="button" class="btn btn-default">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item edit">Edit</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item btneditpassword">Edit Password</a>
                      <a class="dropdown-item addCertificate" href="#">Penambahan Sertifikat</a>
                      <a class="dropdown-item addPortofolio" href="#">Penambahan Portofolio</a>
                      <a class="dropdown-item addTraining" href="#">Penambahan Pelatihan</a>
                      <a class="dropdown-item addTraining" target="_blank" href="/members/showcard/<?php echo $obj->juleha_id?>">KTA</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Jadikan Non Aktif</a>
                      <a class="dropdown-item" href="/members/uploder/<?php echo $obj->juleha_id?>" target="_blank">Upload Foto</a>
                    </div>
                    </td>
                  </tr>
                  <?php }?>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2021-2025 <a href="http://julehajatim.com">Julehajatim.com</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php $this->load->view('common/footerscripts');?>
<?php $this->load->view('members/add');?>
<?php $this->load->view('members/edit');?>
<?php $this->load->view('members/addCertificate');?>
<?php $this->load->view('members/addPortofolio');?>
<?php $this->load->view('members/editPassword');?>
<script>
  $.fn.stairUp = function(options){
	var settings = $.extend({
		level:1
	},options);
	out=$(this);
	for(i=0;i<settings.level;i++){
		out=out.parent();
	}
	return out;
}

  $('#example2').on('click','.addCertificate',function(){
    console.log('x')
    $('#modal-lg-certificate').modal();
  })
  $('#example2').on('click','.addPortofolio',function(){
    console.log('x')
    $('#modal-lg-portofolio').modal();
  })
  $('#example2').on('click','.addTraining',function(){
    console.log('x')
    $('#modal-lg-training').modal();
  })
  $('#example2').on('click','.btneditpassword',function(){
    console.log('edit passsword clicked');
    $('#example2 tr').removeClass('selected')
    $(this).stairUp({level:3}).addClass('selected')
    idedit = $(this).stairUp({level:3}).addClass('selected').attr('id')
    //$('#example2 tr.selected').attr('id')
    idedit = $(this).stairUp({level:3}).attr("id")
    $('#modal-lg-edit-password').modal();
  })
  $("#example2").on("click",".edit",function(){
    let juleha_id = $(this).stairUp({level:3}).find(".juleha_id").text()
    console.log("TEs E",juleha_id)
    $.ajax({
      url:'/members/get/'+juleha_id,
      type:'get',
      dataType:'json'
    })
    .done(res=>{
      console.log("R",res)
      $('#txteditJulehaId').val(res.res.juleha_id)
      $('#txteditNickName').val(res.res.nickname)
      $('#txteditFirstName').val(res.res.firstname)
      $('#txteditLastName').val(res.res.lastname)
      $('#txteditAddress').val(res.res.address)
      $('#cmbeditRegion').val(res.res.region)
      $('#cmbeditRegion option').each(function(){
        console.log("this combo",$(this).val())
        if((res.res.region).toUpperCase() === ($(this).val()).toUpperCase()){
          $(this).attr('selected','selected')
        }
      })
      $("#edit-modal-lg").modal()
    })
    .fail(err=>{
      console.log("ERr",err)
    })
  })
</script>
</body>
</html>
