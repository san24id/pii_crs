<style type="text/css">
	.pre-scrollable {
    max-height: 850px;
    overflow-y: scroll;
}	
</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Dashboard <small>Direksi 1</small>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main/maindireksi">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">Risk List</a>
				</li>
			</ul>	
		</div>
		<!-- END PAGE HEADER-->	

		<!-- BEGIN TAB MENU-->
		<div class="tabbable-custom ">
			<ul class="nav nav-tabs ">
				<li class="active">
					<a href="#tab_risk_list" data-toggle="tab">
					Risk Own By Me
					</a>
				</li>
				<li>
					<a href="#tab_risk_register_list" data-toggle="tab">
					My Action Plan 
					</a>
					</li>
				<li>
					<a href="#tab_treatment_list" data-toggle="tab">
					My KRI 
					</a>
				</li>
				<!--tab Menu end-->
			</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tab_risk_list">
		
			<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_list" >
		<div align="center">				
	<iframe align="center" frameborder="no" height="520px" name="frame1" scrolling="no" src="http://localhost/PIICRStest27Desc/Chart_PII_beforebuildin/direksi1/indextab1.php" style="border: 0px solid;" width="660px"></iframe>
	         </div>       
	
						<div class="form-group">
						
				<label for="filterFormBy" class="smaller">Select Division : </label>
							<select class="form-control input-medium input-sm" id="tab_risk_list-filterBy">
								<option value="risk_event"> </option>
								
				</select>
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_risk_list-filterButton">Search</button>



					</form>
					
	<div ><!--class="table-scrollable"-->
	
<div class="col-md-7">
	<table class="table table-condensed table-bordered table-hover " id="datatable_old_risk">
						<thead>
						<tr role="row" class="heading">
							<th width="30px">Status</th>
							<th>Risk ID</th>
							<th width="30px"> Risk Event</th>
							<th>Risk Level</th>
							<th>Impact Level</th>
							<th width="30px">Likelihood</th>
							<th>Risk Owner</th>
							
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
</div>
<div class="col-md-4">
<div class="row">
	<div><br/><br/></div>
</div>
	<div class="row">
		<div class="col-md-4">
			<iframe align="center" frameborder="no" height="520px" name="frame1" scrolling="no" src="http://localhost/PIICRStest27Desc/pii_pie2/index.php" style="border: 0px solid;" width="550px"></iframe>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
		<iframe align="center" frameborder="no" height="520px" name="frame1" scrolling="no" src="http://localhost/PIICRStest27Desc/pii_pie2/indexst.php" style="border: 0px solid;" width="550px"></iframe>
		</div>
	</div>
	
	
</div> 						
					</div>
					<hr/>
					<div class="row">
					
					<div class="col-md-6">
						<h4>Legend</h4>
						<ul class="list-group">
							<li class="list-group-item">
								<i class="fa fa-square" style="font-size:24px;color:#98FB98"></i> &nbsp; 
								 Draft
							</li>
							<li class="list-group-item">
								<i class="fa fa-square" style="font-size:24px;color:#00FF00"></i> &nbsp; 
								 Submitted to RAC
							</li>
							<li class="list-group-item">
							<i class="fa fa-square" style="font-size:24px;color:#008000"></i> &nbsp; 
								 Verified by RAC
							</li>
						</ul>
					</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_risk_register_list">	
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_register_list">
					<div align="center">
					<iframe align="center" frameborder="no" height="520px" name="frame1" scrolling="no" src="http://localhost/PIICRStest27Desc/Chart_PII_beforebuildin/direksi1/indextabap2.php" style="border: 0px solid;" width="660px"></iframe>
    				</div>
						<div class="form-group">
						
				<label for="filterFormBy" class="smaller">Select Division : </label>
							<select class="form-control input-medium input-sm" id="tab_risk_list-filterBy">
								<option value="risk_event"> </option>
								
				</select>
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_risk_list-filterButton">Search</button>

							</form>
			
					
					<div ><!--class="table-scrollable"-->
<div class="col-md-7">					
					<table class="table table-condensed table-bordered table-hover " id="datatable_action_plan">
						
						<thead>
						<tr role="row" class="heading">
							<th width="30px">Status</th>
							<th>AP ID</th>
							<th>Action Plan</th>
							<th>Due Date</th>
							<th>Action Plan Owner</th>
							<th>Excecution</th>
							<th>Risk ID</th>
							
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
					</div>
<div class="col-md-4">
<div class="row">
	<div><br/><br/></div>
</div>
	<div class="row">
		<div class="col-md-4">
			<iframe align="center" frameborder="no" height="520px" name="frame1" scrolling="no" src="http://localhost/PIICRStest27Desc/pii_pie2/indexap.php" style="border: 0px solid;" width="550px"></iframe>
		</div>
	</div>
	
	
	
</div> 						
					</div>

					<hr/>
					<div class="row">
					
					<div class="col-md-6">
								<h4>Legend</h4>
						<ul class="list-group">
							<li class="list-group-item">
								<i class="fa fa-square-o" style="font-size:24px;color:#FFFFFF"></i> &nbsp; 
								 Not Have Execution Yet
							</li>
							<li class="list-group-item">
								<i class="fa fa-square" style="font-size:24px;color:#FF0000"></i> &nbsp; 
								 Action Plan Execution Extend
							</li>
							<li class="list-group-item">
								<i class="fa fa-square" style="font-size:24px;color:#FFFF00"></i> &nbsp; 
								 Action Plan Execution On Going
							</li>
							<li class="list-group-item">
							<i class="fa fa-square" style="font-size:24px;color:#008000"></i> &nbsp; 
								 Action Plan Execution Complete
							</li>
						</ul>
		
		
					</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_treatment_list">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_treatment_list">
	<div align="center">
	   <iframe align="center" frameborder="no" height="520px" name="frame1" scrolling="no" src="http://localhost/PIICRStest27Desc/Chart_PII_beforebuildin/direksi1/indexkri1.php" style="border: 0px solid;" width="660px"></iframe>
		</div>			
    			<div class="form-group">
						
				<label for="filterFormBy" class="smaller">Select Division : </label>
							<select class="form-control input-medium input-sm" id="tab_risk_list-filterBy">
								<option value="risk_event"> </option>
								
				</select>
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_risk_list-filterButton">Search</button>


					</form>
				
					<div ><!--class="table-scrollable"-->
<div class="col-md-7">						
						<table class="table table-condensed table-bordered table-hover " id="datatable_kri">
						<thead>
						<tr role="row" class="heading">
							<th width="30px">Status</th>
							<th>KRI ID</th>
							<th>KRI</th>
							<th>KRI Owner</th>
							<th>Timing Pelaporan</th>
							<th>Response</th>
							<th>Risk ID</th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
					</div>
<div class="col-md-4">
<div class="row">
	<div><br/><br/></div>
</div>
	<div class="row">
		<div class="col-md-4">
			<iframe align="center" frameborder="no" height="520px" name="frame1" scrolling="no" src="http://localhost/PIICRStest27Desc/pii_pie2/indexkri.php" style="border: 0px solid;" width="550px"></iframe>
		</div>
	</div>
	
	
	
</div> 						
					</div>

					<hr/>
					<div class="row">
					
					<div class="col-md-6">
							<h4>Legend</h4>
						<ul class="list-group">
							<li class="list-group-item">
								<i class="fa fa-square-o" style="font-size:24px;color:#FFFFFF"></i> &nbsp; 
								 Not Have KRI Warning Yet
							</li>
							<li class="list-group-item">
								<i class="fa fa-square" style="font-size:24px;color:#FF0000"></i> &nbsp; 
								 KRI Warning Red
							</li>
							<li class="list-group-item">
								<i class="fa fa-square" style="font-size:24px;color:#FFFF00"></i> &nbsp; 
								 KRI Warning Yellow
							</li>
							<li class="list-group-item">
							<i class="fa fa-square" style="font-size:24px;color:#008000"></i> &nbsp; 
								 KRI Warning Green
							</li>
						</ul>
		
					</div>
					</div>
				</div>
		</form>
	</div>
</div>