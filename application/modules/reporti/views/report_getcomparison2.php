<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Sub Kategori Level 2
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/maini/mainrac">Laporan</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a  >Perbandingan Hasil </a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">Sub Kategori Level 2  </a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN CONTENT-->
		<div class="row">
			<div class="col-md-12">
			<div class="form">
				<form class="form-horizontal">		
					<div class="form-group">
						<label class="col-md-3 control-label">Tipe Laporan</label>
							<div class="col-md-6">
								<select class="form-control input-sm" id="typereport">
									<option value="-">Pilih</option>
									<option value="excel">MS. Excel</option>
									<option value="pdf">PDF</option>
		<!-- 							<option value="word">MS. Word</option> -->
								</select>
							</div>
					</div>
				</form>
			</div>
				<div class="row">
					<div class="col-md-12">			
						<div class="form" id="forexcel">
							<form   action="<?=$site_url?>/report/risk/getcomparison2_excel" method="post" id="input-form" role="form" class="form-horizontal">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Periode 1</label>
											<div class="col-md-6">
												<select class="form-control input-sm" name="periode_prev">
													<?php 
														foreach ($periode as $key) {
															echo "<option value='".$key->periode_id."'>".$key->periode_name."</option>";
														}
													?>
												</select>
											</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Periode 2</label>
											<div class="col-md-6">
												<select class="form-control input-sm" name="periode_cur">
													<?php 
														foreach ($periode as $key) {
															echo "<option value='".$key->periode_id."'>".$key->periode_name."</option>";
														}
													?>
												</select>
											</div>
									</div>
									 

									<div class="form-actions right">
										<button id="input-form-submit-button" type="submit" 
											class="btn blue ladda-button"
											 data-style="expand-right"
											>Submit</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">			
						<div class="form" id="forpdf">
							<form target="_self" action="<?=$site_url?>/report/risk/getcomparison2_pdf" method="post" id="input-form" role="form" class="form-horizontal">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Periode 1</label>
											<div class="col-md-6">
												<select class="form-control input-sm" name="periode_prev">
													<?php 
														foreach ($periode as $key) {
															echo "<option value='".$key->periode_id."'>".$key->periode_name."</option>";
														}
													?>
												</select>
											</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Periode 2</label>
											<div class="col-md-6">
												<select class="form-control input-sm" name="periode_cur">
													<?php 
														foreach ($periode as $key) {
															echo "<option value='".$key->periode_id."'>".$key->periode_name."</option>";
														}
													?>
												</select>
											</div>
									</div>
									 

									<div class="form-actions right">
										<button id="input-form-submit-button" type="submit" 
											class="btn blue ladda-button"
											 data-style="expand-right"
											>Submit</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">			
						<div class="form" id="forword">
							<form target="_self" action="<?=$site_url?>/report/risk/getcomparison2_word" method="post" id="input-form" role="form" class="form-horizontal">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Periode 1</label>
											<div class="col-md-6">
												<select class="form-control input-sm" name="periode_prev">
													<?php 
														foreach ($periode as $key) {
															echo "<option value='".$key->periode_id."'>".$key->periode_name."</option>";
														}
													?>
												</select>
											</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Periode 2</label>
											<div class="col-md-6">
												<select class="form-control input-sm" name="periode_cur">
													<?php 
														foreach ($periode as $key) {
															echo "<option value='".$key->periode_id."'>".$key->periode_name."</option>";
														}
													?>
												</select>
											</div>
									</div>
									 

									<div class="form-actions right">
										<button id="input-form-submit-button" type="submit" 
											class="btn blue ladda-button"
											 data-style="expand-right"
											>Submit</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>					
			</div>	
		</div>		
		<!-- END CONTENT-->
	</div>
</div>
