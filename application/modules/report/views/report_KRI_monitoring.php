<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Report <small>Risk Report</small>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main/mainrac">Report</a>
					<i class="fa fa-angle-right"></i>
				</li>
				 
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">KRI Monitoring</a>
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
						<label class="col-md-3 control-label">Report type</label>
							<div class="col-md-6">
								<select class="form-control input-sm" id="typereport">
									<option value="-">Choose</option>
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
							<form   action="<?=$site_url?>/report/risk/KRI_monitoring_excel" method="post" id="input-form" role="form" class="form-horizontal">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Periode</label>
											<div class="col-md-6">
												<select class="form-control input-sm" name="periode">
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
							<form target="_self" action="<?=$site_url?>/report/risk/KRI_monitoring_pdf" method="post" id="input-form" role="form" class="form-horizontal">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Periode</label>
											<div class="col-md-6">
												<select class="form-control input-sm" name="periode">
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
							<form target="_self" action="<?=$site_url?>/report/risk/KRI_monitoring_word" method="post" id="input-form" role="form" class="form-horizontal">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Periode</label>
											<div class="col-md-6">
												<select class="form-control input-sm" name="periode">
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
