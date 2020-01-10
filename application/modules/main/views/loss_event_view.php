<?php error_reporting(0); ?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Loss Event Form
		</h3>
	
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				
				<li>
					<a target="_self" href="javascript:;">Transaction</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Other Risk</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="<?=$site_url?>/risk/RiskRegister">Loss Event</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption" id="div-portlet-page-caption">
						Loss Event Form
					</div>
				</div>
				
				<div class="portlet-body form">
					<form id="input-form" role="form" class="form-horizontal">
						<div class="form-body">
							<div class="row">
							<div class="col-md-6">
							<input type="hidden" name="id_event" class="form-control input-sm" value="<?php echo $row_event['id_event']; ?>">	
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Sektor Proyek <span class="required">* </span></label>
									<div class="col-md-9">
									<select class="form-control input-sm" name="sektor_proyek" disabled="disabled">
										<?php foreach($sektor_list as $row) { 
												if($row['id_sektor'] == $row_event['sektor_proyek']){
													echo '<option value="'.$row_event['id_sektor'].'" selected>'.$row_event['sektor'].'</option>';
												}else{
											?>
												<option value="<?=$row['id_sektor']?>"><?=$row['sektor']?></option>
										<?php }} ?>
									</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Nama Proyek <span class="required">* </span></label>
									<div class="col-md-9">
										<input type="text" name="nama_proyek" class="form-control input-sm input-readview" readonly="readonly" value="<?php echo $row_event['nama_proyek']; ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Nilai Proyek <span class="required">* </span></label>
									<div class="col-md-9">
										<input type="text" name="nilai_proyek" class="form-control input-sm input-readview" value="<?php echo $row_event['nilai_proyek']; ?>" readonly>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Kejadian<span class="required">* </span></label>
									<div class="col-md-9">
										<textarea class="form-control input-sm popovers input-readview"  data-container="body" data-placement="bottom" rows="3" name="kejadian" data-required="1" placeholder="" data-content="" readonly><?php echo $row_event['kejadian']; ?></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Tipe Kerugian<span class="required">* </span></label>
									<div class="col-md-9">
									<select class="form-control input-sm" name="tipe" disabled="disabled">
										<?php if($row_event['tipe'] == 'Loss Event'){
											echo '<option value="Loss Event" selected>Loss Event</option>
										          <option value="Near Miss">Near Miss</option>';
										}else if($row_event['tipe'] == 'Near Miss'){
											echo '<option value="Loss Event">Loss Event</option>
										          <option value="Near Miss" selected>Near Miss</option>';
										}else{
											echo '<option value="Loss Event">Loss Event</option>
										          <option value="Near Miss">Near Miss</option>';
										} ?>
									</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Nilai Kerugian <span class="required">* </span></label>
									<div class="col-md-9">
										<input type="text" name="nilai_kerugian" class="form-control input-sm input-readview" value="<?php echo $row_event['nilai_kerugian']; ?>" readonly>
									</div>
								</div>
								
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Deskripsi/ Keterangan<span class="required">* </span></label>
									<div class="col-md-9">
										<textarea class="form-control input-sm popovers input-readview"  data-container="body" data-placement="bottom" rows="3" name="deskripsi" data-required="1" placeholder="" data-content="" readonly="readonly"><?php echo $row_event['deskripsi']; ?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Periode<span class="required">* </span></label>
									<div class="col-md-9">
									<div class="input-group input-medium">
										<input type="text" class="form-control input-sm input-readview" name="periode" value="<?php echo $row_event['periode']; ?>" id = "periode" placeholder="select date" readonly>
									</div>
								</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Penyebab<span class="required">* </span></label>
									<div class="col-md-9">
										<textarea class="form-control input-sm popovers input-readview"  data-container="body" data-placement="bottom" rows="3" name="penyebab" data-required="1" placeholder="" data-content="" readonly="readonly" ><?php echo $row_event['penyebab']; ?></textarea>
									</div>
								</div>
								<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact"></label>
								<div class="panel-body col-md-9">
									 <div class="table-scrollable">
									 	<table id="divisi_table" class="table table-condensed table-bordered table-hover">
									 		<thead>
									 		<tr role="row" class="heading">
									 			<th><center>Fungsi Terkait</center></th>
									 			<th width="30px">&nbsp;</th>
									 		</tr>
									 		</thead>
									 		<tbody>
									 		</tbody>
									 	</table>
									 </div>
								</div>	
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Lesson Learned<span class="required">* </span></label>
									<div class="col-md-9">
										<textarea class="form-control input-sm popovers input-readview"  data-container="body" data-placement="bottom" rows="3" name="lesson_learned" data-required="1" placeholder="" data-content="" readonly="readonly"><?php echo $row_event['lesson']; ?></textarea>
									</div>
								</div>
								
							</div>
							</div>


						</div>
						<div class="form-actions right">
								<a href="<?php echo site_url() ?>/main/mainrac/lossevent"><button type="button" class="btn yellow"><i class="fa fa-times"></i> Cancel/ Back</button></a>
						</div>

					</form>
				</div>
			</div>
		</div>
		</div>
		
	</div>
		</div>
		</div>
	</div>
</div>




<script type="text/javascript">
	var g_risk_id = <?php echo $row_event['id_event']; ?>;
	var g_username = null;
</script>