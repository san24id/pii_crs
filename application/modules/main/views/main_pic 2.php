<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Dashboard <small>reports & statistics</small>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN CONTENT-->
		<div class="panel panel-success">
			<div class="panel-body">
				<div class="col-md-3">
					<span>My Risk Register</span>
					<div id="chart_1" class="chart" style="width: 200px; height: 120px;"></div>
				</div>
				<div class="col-md-3">
					<span>Risk Owned By Me</span>
					<div id="chart_2" class="chart" style="width: 200px; height: 120px;"></div>
				</div>
				<div class="col-md-3">
					<span>My Action Plan</span>
					<div id="chart_3" class="chart" style="width: 200px; height: 120px;"></div>
				</div>
				<div class="col-md-3">
					<span>My KRI</span>
					<div id="chart_4" class="chart" style="width: 200px; height: 120px;"></div>
				</div>
			</div>
		</div>

		<div class="tabbable-custom ">
			<ul class="nav nav-tabs ">
				<li class="active">
					<a href="#tab_1" data-toggle="tab">
					My Risk Register </a>
				</li>
				<li>
					<a href="#tab_2" data-toggle="tab">
					Risk Owned By Me </a>
				</li>
				<li>
					<a href="#tab_3" data-toggle="tab">
					My Action Plan </a>
				</li>
				<li>
					<a href="#tab_4" data-toggle="tab">
					My Action Plan Execution </a>
				</li>
				<li>
					<a href="#tab_5" data-toggle="tab">
					My KRI </a>
				</li>
				<li>
					<a href="#tab_6" data-toggle="tab">
					Change Request List </a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1">
					<div class="row">
						<div class="col-md-4">
						<form role="form form-horizontal">
							<div class="form-body">
								<div class="form-group">
									<select class="form-control input-sm">
										<option>Pilih Kategori Resiko</option>
										<option>Option 2</option>
										<option>Option 3</option>
										<option>Option 4</option>
										<option>Option 5</option>
									</select>
								</div>
								<div class="form-group">
									<select class="form-control input-sm">
										<option>Pilih Sub Kategori Resiko</option>
										<option>Option 2</option>
										<option>Option 3</option>
										<option>Option 4</option>
										<option>Option 5</option>
									</select>				
								</div>
								<div class="form-group">
									<select class="form-control input-sm">
										<option>Pilih Second Sub Kategori Resiko</option>
										<option>Option 2</option>
										<option>Option 3</option>
										<option>Option 4</option>
										<option>Option 5</option>
									</select>	
								</div>
								<div class="form-group">
									<button type="button" class="btn blue btn-sm">Find Risk</button>
								</div>
							</div>
						</form>
						</div>
						<div class="col-md-8 clearfix" style="margin-top: 130px;">
							<a href="javascript: location.href='<?=$site_url?>/risk/RiskRegister/RiskRegisterInput';" class="btn default green pull-right">
							<i class="fa fa-plus"></i>
							<span class="hidden-480">
							Add New Risk </span>
							</a>
						</div>
					</div>
					
					<div class="table-scrollable">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
							<tr role="row" class="heading">
								<th width="30px">Status</th>
								<th>Risk ID</th>
								<th>Risk Event</th>
								<th>Impact Level</th>
								<th>Likelihood</th>
								<th>Risk Level</th>
								<th>Risk Owner</th>
								<th width="50px">Change Request</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>
									<center><img src="<?=$base_url?>assets/images/legend/draft.png"/></center>
								</td>
								<td>A.1.1-01</td>
								<td>Event of Risk</td>
								<td>Moderate</td>
								<td>High</td>
								<td>Danger</td>
								<td>John Doe</td>
								<td>&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									<center><img src="<?=$base_url?>assets/images/legend/draft.png"/></center>
								</td>
								<td>A.1.1-01</td>
								<td>Event of Risk</td>
								<td>Moderate</td>
								<td>High</td>
								<td>Danger</td>
								<td>John Doe</td>
								<td>&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									<center><img src="<?=$base_url?>assets/images/legend/submit.png"/></center>
								</td>
								<td>A.1.1-01</td>
								<td>Event of Risk</td>
								<td>Moderate</td>
								<td>High</td>
								<td>Danger</td>
								<td>John Doe</td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href='<?=$site_url?>/risk/RiskRegister/ChangeRequestInput'"><i class="fa fa-pencil"> Edit </i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<center><img src="<?=$base_url?>assets/images/legend/actplan.png"/></center>
								</td>
								<td>A.1.1-01</td>
								<td>Event of Risk</td>
								<td>Moderate</td>
								<td>High</td>
								<td>Danger</td>
								<td>John Doe</td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href='<?=$site_url?>/risk/RiskRegister/ChangeRequestInput'"><i class="fa fa-pencil"> Edit </i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<center><img src="<?=$base_url?>assets/images/legend/verified.png"/></center>
								</td>
								<td>A.1.1-01</td>
								<td>Event of Risk</td>
								<td>Moderate</td>
								<td>High</td>
								<td>Danger</td>
								<td>John Doe</td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href='<?=$site_url?>/risk/RiskRegister/ChangeRequestInput'"><i class="fa fa-pencil"> Edit </i></button>
									</div>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						<h4>Legend</h4>
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 submitted to rac
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified By RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/treatment.png"/> &nbsp; 
								 on Risk Treatment Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/actplan.png"/> &nbsp; 
								 on Action Plan Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed_2.png"/> &nbsp; 
								 On Action Plan Execution Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed.png"/> &nbsp; 
								 Action Plan Has Been Executed and Verified
							</li>
						</ul>
		
					</div>
					<div class="clearfix">
					</div>
				</div>
				<div class="tab-pane" id="tab_2">
					<div class="row">
						<div class="col-md-12">
							<div class="table-scrollable">
								<table class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th width="30px">Status</th>
										<th>Risk ID</th>
										<th>Risk Event</th>
										<th>Risk Level</th>
										<th>Assigned To</th>
										<th>Risk Treatment</th>
										<th width="50px">Change Request</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td>
											<center><img src="<?=$base_url?>assets/images/legend/draft.png"/></center>
										</td>
										<td>A.1.1-01</td>
										<td>Event of Risk</td>
										<td>Moderate</td>
										<td>
											Unasigned
											<button href="#modal-pic" data-toggle="modal" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Edit </i></button>
										</td>
										<td>Treatment</td>
										<td>&nbsp;
										</td>
									</tr>
									<tr>
										<td>
											<center><img src="<?=$base_url?>assets/images/legend/submit.png"/></center>
										</td>
										<td>A.1.1-01</td>
										<td>Event of Risk</td>
										<td>Moderate</td>
										<td>Division Head</td>
										<td>Treatment</td>
										<td>
											<div class="btn-group">
												<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href='<?=$site_url?>/risk/RiskRegister/ChangeRequestInput'"><i class="fa fa-pencil"> Edit </i></button>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<center><img src="<?=$base_url?>assets/images/legend/verified_head.png"/></center>
										</td>
										<td>A.1.1-01</td>
										<td>Event of Risk</td>
										<td>Moderate</td>
										<td>PIC</td>
										<td>Treatment</td>
										<td>
											<div class="btn-group">
												<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href='<?=$site_url?>/risk/RiskRegister/ChangeRequestInput'"><i class="fa fa-pencil"> Edit </i></button>
											</div>
										</td>
									</tr>
	
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
					<div class="col-md-6">
						<h4>Legend</h4>
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 submitted to rac
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified By RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/treatment.png"/> &nbsp; 
								 on Risk Treatment Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/actplan.png"/> &nbsp; 
								 on Action Plan Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed_2.png"/> &nbsp; 
								 On Action Plan Execution Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed.png"/> &nbsp; 
								 Action Plan Has Been Executed and Verified
							</li>
						</ul>
		
					</div>
					</div>
					<div class="clearfix">
					</div>
				</div>
				<div class="tab-pane" id="tab_3">
					<div class="row">
						<div class="col-md-12">
							<div class="table-scrollable">
								<table class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th width="30px">Status</th>
										<th>AP ID</th>
										<th>Action Plan</th>
										<th>Due Date</th>
										<th>Assigned To</th>
										<th>Risk ID</th>
										<th width="50px">Change Request</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td>
											<center><img src="<?=$base_url?>assets/images/legend/draft.png"/></center>
										</td>
										<td>AP.00001</td>
										<td>Action Plan</td>
										<td>12-10-2015</td>
										<td>
											Unasigned
											<button href="#modal-pic" data-toggle="modal" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Edit </i></button>
										</td>
										<td>A.1.1-01</td>
										<td>&nbsp;
										</td>
									</tr>
									<tr>
										<td>
											<center><img src="<?=$base_url?>assets/images/legend/submit.png"/></center>
										</td>
										<td>AP.00002</td>
										<td>Action Plan 2</td>
										<td>12-11-2015</td>
										<td>Division Head</td>
										<td>A.1.1-01</td>
										<td>
											<div class="btn-group">
												<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href='<?=$site_url?>/risk/RiskRegister/ChangeRequestInput'"><i class="fa fa-pencil"> Edit </i></button>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<center><img src="<?=$base_url?>assets/images/legend/verified_head.png"/></center>
										</td>
										<td>AP.00002</td>
										<td>Action Plan 2</td>
										<td>12-11-2015</td>
										<td>Division Head</td>
										<td>A.1.1-01</td>
										<td>
											<div class="btn-group">
												<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href='<?=$site_url?>/risk/RiskRegister/ChangeRequestInput'"><i class="fa fa-pencil"> Edit </i></button>
											</div>
										</td>
									</tr>
	
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
					<div class="col-md-6">
						<h4>Legend</h4>
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 submitted to rac
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified By RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/treatment.png"/> &nbsp; 
								 on Risk Treatment Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/actplan.png"/> &nbsp; 
								 on Action Plan Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed_2.png"/> &nbsp; 
								 On Action Plan Execution Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed.png"/> &nbsp; 
								 Action Plan Has Been Executed and Verified
							</li>
						</ul>
					</div>
					</div>
					<div class="clearfix">
					</div>
				</div>
				<div class="tab-pane" id="tab_4">
					<div class="row">
						<div class="col-md-12">
							<div class="table-scrollable">
								<table class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th width="30px">Status</th>
										<th>AP ID</th>
										<th>Action Plan</th>
										<th>Due Date</th>
										<th>Assigned To</th>
										<th>Execution</th>
										<th width="50px">Change Request</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td>
											<center><img src="<?=$base_url?>assets/images/legend/draft.png"/></center>
										</td>
										<td>AP.00001</td>
										<td>Action Plan</td>
										<td>12-10-2015</td>
										<td>Division Head</td>
										<td>
											<select class="form-control input-sm">
												<option>Complete</option>
												<option>Extend</option>
											</select>
										</td>
										<td>&nbsp;
										</td>
									</tr>
									<tr>
										<td>
											<center><img src="<?=$base_url?>assets/images/legend/submit.png"/></center>
										</td>
										<td>AP.00002</td>
										<td>Action Plan</td>
										<td>12-10-2015</td>
										<td>Division Head</td>
										<td>
											Complete
										</td>
										<td>
											<div class="btn-group">
												<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href='<?=$site_url?>/risk/RiskRegister/ChangeRequestInput'"><i class="fa fa-pencil"> Edit </i></button>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<center><img src="<?=$base_url?>assets/images/legend/verified_head.png"/></center>
										</td>
										<td>AP.00003</td>
										<td>Action Plan</td>
										<td>12-10-2015</td>
										<td>Division Head</td>
										<td>
											Extend
										</td>
										<td>
											<div class="btn-group">
												<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href='<?=$site_url?>/risk/RiskRegister/ChangeRequestInput'"><i class="fa fa-pencil"> Edit </i></button>
											</div>
										</td>
									</tr>
	
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
					<div class="col-md-6">
						<h4>Legend</h4>
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 submitted to rac
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified By RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/treatment.png"/> &nbsp; 
								 on Risk Treatment Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/actplan.png"/> &nbsp; 
								 on Action Plan Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed_2.png"/> &nbsp; 
								 On Action Plan Execution Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed.png"/> &nbsp; 
								 Action Plan Has Been Executed and Verified
							</li>
						</ul>
		
					</div>
					</div>
					<div class="clearfix">
					</div>
				</div>
				<div class="tab-pane" id="tab_5">
					<div class="row">
						<div class="col-md-12">
							<div class="table-scrollable">
								<table class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th width="30px">Status</th>
										<th>KRI ID</th>
										<th>KRI</th>
										<th>Threshold</th>
										<th>Timing Pelaporan</th>
										<th>Assigned To</th>
										<th>Risk ID</th>
										<th width="50px">Change Request</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td>
											<center><img src="<?=$base_url?>assets/images/legend/draft.png"/></center>
										</td>
										<td>KRI.00001</td>
										<td>KRI Description</td>
										<td>Threshold</td>
										<td>Timing</td>
										<td>
											Unasigned
											<button href="#modal-pic" data-toggle="modal" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Edit </i></button>
										</td>
										<td>A.1.1-01</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>
											<center><img src="<?=$base_url?>assets/images/legend/submit.png"/></center>
										</td>
										<td>KRI.00002</td>
										<td>KRI Description</td>
										<td>Threshold</td>
										<td>Timing</td>
										<td>Division Head</td>
										<td>A.1.1-01</td>
										<td>
											<div class="btn-group">
												<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href='<?=$site_url?>/risk/RiskRegister/ChangeRequestInput'"><i class="fa fa-pencil"> Edit </i></button>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<center><img src="<?=$base_url?>assets/images/legend/verified_head.png"/></center>
										</td>
										<td>KRI.00002</td>
										<td>KRI Description</td>
										<td>Threshold</td>
										<td>Timing</td>
										<td>PIC</td>
										<td>A.1.1-01</td>
										<td>
											<div class="btn-group">
												<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href='<?=$site_url?>/risk/RiskRegister/ChangeRequestInput'"><i class="fa fa-pencil"> Edit </i></button>
											</div>
										</td>
									</tr>
	
									</tbody>
								</table>
							</div>
						</div>
								</div>
					<div class="row">
					<div class="col-md-6">
						<h4>Legend</h4>
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 submitted to rac
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified By RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/treatment.png"/> &nbsp; 
								 on Risk Treatment Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/actplan.png"/> &nbsp; 
								 on Action Plan Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed_2.png"/> &nbsp; 
								 On Action Plan Execution Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed.png"/> &nbsp; 
								 Action Plan Has Been Executed and Verified
							</li>
						</ul>
					</div>
					</div>
					<div class="clearfix">
					</div>
				</div>
				<div class="tab-pane" id="tab_6">
					<div class="table-scrollable">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
							<tr role="row" class="heading">
								<th>No</th>
								<th>ID CH</th>
								<th>Risk ID</th>
								<th>Risk Event</th>
								<th>Status Request</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>1</td>
								<td>CH.00001</td>
								<td>A.1.1-01</td>
								<td>Event of Risk</td>
								<td>Status</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
				
			</div>
			
		</div>
		<!-- END CONTENT-->
	</div>
</div>


<!-- LIBRARY -->
<div id="modal-pic" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Select Asignee</h4>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="submit">Go!</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<table class="table table-condensed table-bordered table-hover">
			<thead>
			<tr role="row" class="heading">
				<th width="30px">&nbsp;</th>
				<th>Name</th>
				<th>Division</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>
				<div class="btn-group">
					<button type="button" class="btn btn-default btn-xs"><i class="fa fa-check-circle font-blue"> Select </i></button>
				</div>
				</td>
				<td>John Doe</td>
				<td>Marketing</td>
			</tr>
			</tbody>
		</table>
	</div>
</div>