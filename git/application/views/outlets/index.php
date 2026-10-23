<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<?php $this->load->view('outlets/head');?>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
	<!-- BEGIN HEADER -->
	<?php $this->load->view('outlets/header');?>
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<?php $this->load->view ('outlets/sidebar');?>
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>portlet Settings</h3>
				</div>
				<div class="modal-body">
					<p>Here will be a configuration form</p>
				</div>
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->        
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							List Outlet <small>Yayasan Suara Hati</small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="index.html">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li>
								<a href="#">Outlets</a>
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">Lists</a></li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption"><i class="icon-globe"></i>Show/Hide Columns</div>
								<div class="actions">
									<div class="btn-group">
										<a class="btn" href="#" data-toggle="dropdown">
										Columns
										<i class="icon-angle-down"></i>
										</a>
										<div id="sample_2_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
											<label><input type="checkbox" checked data-column="0">Rendering engine</label>
											<label><input type="checkbox" checked data-column="1">Browser</label>
											<label><input type="checkbox" checked data-column="2">Platform(s)</label>
											<label><input type="checkbox" checked data-column="3">Engine version</label>
											<label><input type="checkbox" checked data-column="4">CSS grade</label>
										</div>
									</div>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered table-hover table-full-width" id="sample_2">
									<thead>
										<tr>
											<th class="hidden-480">ID</th>
											<th>Nama</th>
											<th>Alamat</th>
											<th class="hidden-480">Contact Person</th>
											<th class="hidden-480">Phone</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($objs['res'] as $obj){?>
										<tr>
											<td class="hidden-480"><?php echo $obj->id;?></td>
											<td><?php echo $obj->name;?></td>
											<td><?php echo $obj->address;?>
											</td>
											<td class="hidden-480"><?php echo $obj->cp;?></td>
											<td class="hidden-480"><?php echo $obj->phone;?></td>
										</tr>
										<?php }?>
										<tr >
											<td>Trident</td>
											<td>Internet
												Explorer 5.0
											</td>
											<td class="hidden-480">Win 95+</td>
											<td class="hidden-480">5</td>
											<td class="hidden-480">C</td>
										</tr>
										<tr >
											<td>Trident</td>
											<td>Internet
												Explorer 5.5
											</td>
											<td class="hidden-480">Win 95+</td>
											<td class="hidden-480">5.5</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Trident</td>
											<td>Internet
												Explorer 6
											</td>
											<td class="hidden-480">Win 98+</td>
											<td class="hidden-480">6</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Trident</td>
											<td>Internet Explorer 7</td>
											<td class="hidden-480">Win XP SP2+</td>
											<td class="hidden-480">7</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Trident</td>
											<td>AOL browser (AOL desktop)</td>
											<td class="hidden-480">Win XP</td>
											<td class="hidden-480">6</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Firefox 1.0</td>
											<td class="hidden-480">Win 98+ / OSX.2+</td>
											<td class="hidden-480">1.7</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Firefox 1.5</td>
											<td class="hidden-480">Win 98+ / OSX.2+</td>
											<td class="hidden-480">1.8</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Firefox 2.0</td>
											<td class="hidden-480">Win 98+ / OSX.2+</td>
											<td class="hidden-480">1.8</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Firefox 3.0</td>
											<td class="hidden-480">Win 2k+ / OSX.3+</td>
											<td class="hidden-480">1.9</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Camino 1.0</td>
											<td class="hidden-480">OSX.2+</td>
											<td class="hidden-480">1.8</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Camino 1.5</td>
											<td class="hidden-480">OSX.3+</td>
											<td class="hidden-480">1.8</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Netscape 7.2</td>
											<td class="hidden-480">Win 95+ / Mac OS 8.6-9.2</td>
											<td class="hidden-480">1.7</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Netscape Browser 8</td>
											<td class="hidden-480">Win 98SE+</td>
											<td class="hidden-480">1.7</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Netscape Navigator 9</td>
											<td class="hidden-480">Win 98+ / OSX.2+</td>
											<td class="hidden-480">1.8</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Mozilla 1.0</td>
											<td class="hidden-480">Win 95+ / OSX.1+</td>
											<td class="hidden-480">1</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Mozilla 1.1</td>
											<td class="hidden-480">Win 95+ / OSX.1+</td>
											<td class="hidden-480">1.1</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Mozilla 1.2</td>
											<td class="hidden-480">Win 95+ / OSX.1+</td>
											<td class="hidden-480">1.2</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Mozilla 1.3</td>
											<td class="hidden-480">Win 95+ / OSX.1+</td>
											<td class="hidden-480">1.3</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Mozilla 1.4</td>
											<td class="hidden-480">Win 95+ / OSX.1+</td>
											<td class="hidden-480">1.4</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Mozilla 1.5</td>
											<td class="hidden-480">Win 95+ / OSX.1+</td>
											<td class="hidden-480">1.5</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Mozilla 1.6</td>
											<td class="hidden-480">Win 95+ / OSX.1+</td>
											<td class="hidden-480">1.6</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Mozilla 1.7</td>
											<td class="hidden-480">Win 98+ / OSX.1+</td>
											<td class="hidden-480">1.7</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Mozilla 1.8</td>
											<td class="hidden-480">Win 98+ / OSX.1+</td>
											<td class="hidden-480">1.8</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Seamonkey 1.1</td>
											<td class="hidden-480">Win 98+ / OSX.2+</td>
											<td class="hidden-480">1.8</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Gecko</td>
											<td>Epiphany 2.20</td>
											<td class="hidden-480">Gnome</td>
											<td class="hidden-480">1.8</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Webkit</td>
											<td>Safari 1.2</td>
											<td class="hidden-480">OSX.3</td>
											<td class="hidden-480">125.5</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Webkit</td>
											<td>Safari 1.3</td>
											<td class="hidden-480">OSX.3</td>
											<td class="hidden-480">312.8</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Webkit</td>
											<td>Safari 2.0</td>
											<td class="hidden-480">OSX.4+</td>
											<td class="hidden-480">419.3</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Webkit</td>
											<td>Safari 3.0</td>
											<td class="hidden-480">OSX.4+</td>
											<td class="hidden-480">522.1</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Webkit</td>
											<td>OmniWeb 5.5</td>
											<td class="hidden-480">OSX.4+</td>
											<td class="hidden-480">420</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Webkit</td>
											<td>iPod Touch / iPhone</td>
											<td class="hidden-480">iPod</td>
											<td class="hidden-480">420.1</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Webkit</td>
											<td>S60</td>
											<td class="hidden-480">S60</td>
											<td class="hidden-480">413</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Presto</td>
											<td>Opera 7.0</td>
											<td class="hidden-480">Win 95+ / OSX.1+</td>
											<td class="hidden-480">-</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Presto</td>
											<td>Opera 7.5</td>
											<td class="hidden-480">Win 95+ / OSX.2+</td>
											<td class="hidden-480">-</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Presto</td>
											<td>Opera 8.0</td>
											<td class="hidden-480">Win 95+ / OSX.2+</td>
											<td class="hidden-480">-</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Presto</td>
											<td>Opera 8.5</td>
											<td class="hidden-480">Win 95+ / OSX.2+</td>
											<td class="hidden-480">-</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Presto</td>
											<td>Opera 9.0</td>
											<td class="hidden-480">Win 95+ / OSX.3+</td>
											<td class="hidden-480">-</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Presto</td>
											<td>Opera 9.2</td>
											<td class="hidden-480">Win 88+ / OSX.3+</td>
											<td class="hidden-480">-</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Presto</td>
											<td>Opera 9.5</td>
											<td class="hidden-480">Win 88+ / OSX.3+</td>
											<td class="hidden-480">-</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Presto</td>
											<td>Opera for Wii</td>
											<td class="hidden-480">Wii</td>
											<td class="hidden-480">-</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Presto</td>
											<td>Nokia N800</td>
											<td class="hidden-480">N800</td>
											<td class="hidden-480">-</td>
											<td class="hidden-480">A</td>
										</tr>
										<tr >
											<td>Presto</td>
											<td>Nintendo DS browser</td>
											<td class="hidden-480">Nintendo DS</td>
											<td class="hidden-480">8.5</td>
											<td class="hidden-480">C/A<sup>1</sup></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER-->
		</div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<div class="footer-inner">
			2021 &copy; Suarahati.
		</div>
		<div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   <script src="/assets/metronics/assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="/assets/metronics/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="/assets/metronics/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="/assets/metronics/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="/assets/metronics/assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="/assets/metronics/assets/plugins/excanvas.min.js"></script>
	<script src="/assets/metronics/assets/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="/assets/metronics/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="/assets/metronics/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="/assets/metronics/assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="/assets/metronics/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script type="text/javascript" src="/assets/metronics/assets/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="/assets/metronics/assets/plugins/data-tables/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/assets/metronics/assets/plugins/data-tables/DT_bootstrap.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="/assets/metronics/assets/scripts/app.js"></script>
	<script src="/assets/metronics/assets/scripts/table-advanced.js"></script>     
	<script>
		jQuery(document).ready(function() {       
		   App.init();
		   TableAdvanced.init();
		});
	</script>
</body>
<!-- END BODY -->
</html>