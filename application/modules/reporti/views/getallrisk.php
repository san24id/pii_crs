<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Report <small>report all risk</small>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main/mainrac">Report</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">List of All Risk</a>
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
			<div class="form" id="forexcel">
				<form target="_self" action="<?=$site_url?>/report/risk/allrisk" method="post" id="input-form" role="form" class="form-horizontal">
					<div class="form-body">


						<div class="form-actions right">
							<button id="input-form-submit-button" type="submit" 
								class="btn blue ladda-button"
								 data-style="expand-right"
								>Submit</button>
						</div>
					</div>
				</form>
			</div>

			<div class="form" id="forpdf">
				<form target="_self" action="<?=$site_url?>/report/risk/allriskpdf" method="post" id="input-form" role="form" class="form-horizontal">
					<div class="form-body">


						<div class="form-actions right">
							<button id="input-form-submit-button" type="submit" 
								class="btn blue ladda-button"
								 data-style="expand-right"
								>Submit</button>
						</div>
					</div>
				</form>
			</div>

			<div class="form" id="forword">
				<form target="_self" action="<?=$site_url?>/report/risk/allrisk" method="post" id="input-form" role="form" class="form-horizontal">
					<div class="form-body">


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
		<!-- END CONTENT-->
	</div>
</div>
