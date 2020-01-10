<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Dashboard <small>Chief Executive Officer</small>
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
			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a id = "risk_list_export">Export</a>
						</li>					 
					</ul>
				</div>
			</div>	
		</div>
		<!--export-->
		<input type = "hidden" id = "tabactive" name ="tabactive" value = "0">
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-export" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document" >
			<div class="modal-content" >
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Risk List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_risklist">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "risk_status"></th>
						<th>Risk ID <input type = "checkbox" checked="true"  name = "risk_code" > </th>
						<th>Risk Event <input type = "checkbox" checked="true"  name = "risk_event" > </th>
						<th>Impact Level <input type = "checkbox" checked="true"  name = "risk_level_v" ></th>
						<th>Likelihood <input type = "checkbox" checked="true"  name = "impact_level_v" > </th>
						<th>Risk Level <input type = "checkbox" checked="true"  name = "likelihood_v" > </th>
						<th>Risk Owner <input type = "checkbox" checked="true"  name = "risk_owner_v" > </th> 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "risk_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "risk_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="#modal-export-risk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Risk Register List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_riskregisterlist">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "risk_status" ></th>
						<th>User <input type = "checkbox" checked="true"  name = "display_name"  > </th>
						<th>Divisi<input type = "checkbox" checked="true"  name = "division_name"  > </th>
						<th>Submission Date<input type = "checkbox" checked="true"  name = "tanggal_submit"  > </th> 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "risk_register_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "risk_register_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-export-treatment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Treatment List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_risktreatment">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "risk_status" ></th>
						<th>Risk ID <input type = "checkbox" checked="true"  name = "risk_code"  > </th>
						<th>Risk Event<input type = "checkbox" checked="true"  name = "risk_event"  > </th> 
						<th>Risk Owner<input type = "checkbox" checked="true"  name = "risk_owner_v"  > </th> 
						<th>Risk Treatment<input type = "checkbox" checked="true"  name = "suggested_risk_treatment_v"  > </th>  
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "treatment_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "treatment_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-actionplanlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Action Plan List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_actionplan">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "action_plan_status" ></th>
						<th>AP ID <input type = "checkbox" checked="true"  name = "act_code"  > </th>
						<th>Action Plan<input type = "checkbox" checked="true"  name = "action_plan"  > </th> 
						<th>Due Date<input type = "checkbox" checked="true"  name = "due_date_v"  > </th> 
						<th>Action Plan Owner<input type = "checkbox" checked="true"  name = "division_name"  > </th>  
						<th>Risk ID<input type = "checkbox" checked="true"  name = "risk_code"  > </th> 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "actionplan_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "actionplan_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-executionlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Action Plan Execution List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_execution">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "action_plan_status" ></th>
						<th>AP ID <input type = "checkbox" checked="true"  name = "act_code"  > </th>
						<th>Action Plan<input type = "checkbox" checked="true"  name = "action_plan"  > </th> 
						<th>Due Date<input type = "checkbox" checked="true"  name = "due_date_v"  > </th> 
						<th>Action Plan Owner<input type = "checkbox" checked="true"  name = "division_name"  > </th>  
						<th>Execution<input type = "checkbox" checked="true"  name = "execution_status"  > </th> 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "execution_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "execution_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-kri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">KRI List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_kri">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "kri_status" ></th>
						<th>KRI ID <input type = "checkbox" checked="true"  name = "kri_code"  > </th>
						<th>KRI<input type = "checkbox" checked="true"  name = "key_risk_indicator"  > </th> 
						<th>KRI Owner<input type = "checkbox" checked="true"  name = "treshold"  > </th> 
						<th>Timing Pelaporan<input type = "checkbox" checked="true"  name = "timing_pelaporan_v"  > </th>  
						<th>Risk ID<input type = "checkbox" checked="true"  name = "risk_code"  > </th> 
						<th>KRI Warning<input type = "checkbox" checked="true"  name = "kri_warning"  > </th> 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "kri_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "kri_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
 	<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-changereq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Change Request List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_changereq">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "GenRowNum" ></th>
						<th>ID CH<input type = "checkbox" checked="true"  name = "cr_code"  > </th>
						<th>Change In<input type = "checkbox" checked="true"  name = "cr_type"  > </th> 
						<th>Requestor<input type = "checkbox" checked="true"  name = "created_by_v"  > </th> 
						<th>Status Change Request<input type = "checkbox" checked="true"  name = "cr_status"  > </th>  						 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "changereq_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "changereq_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>

		<!-- END PAGE HEADER-->	

		<!-- BEGIN TAB MENU-->
		<div class="tabbable-custom ">
			<ul class="nav nav-tabs ">
				<li class="active">
					<a href="#tab_dashboardceo" data-toggle="tab">
					Main Dashboard
					</a>
				</li>
				<li>
					<a href="#tab_risk_list" data-toggle="tab">
					Risk
					</a>
					</li>
				<li>
					<a href="#tab_risk_register_list" data-toggle="tab">
					Action Plan 
					</a>
					</li>
				<li>
					<a href="#tab_treatment_list" data-toggle="tab">
					KRI 
					</a>
				</li>
				<!--tab Menu end-->
			</ul>
	<div class="tab-content">
	<div class="tab-pane active" id="tab_dashboardceo">
     	<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_list2" >
                    
                    <div ><!--class="table-scrollable"-->
                    <h3 align="center" class='panel-title'><marquee behavior="scroll" direction="left"><b>MY DIRECTORATE</b></marquee></h3>
                    
    <div class='panel panel-primary'>
	<div class='panel-body'>
<!--	<section class="content" style="background:#AFEEEE">
-->
<section class="content">
  <div class="row" style="padding-top: 0">
        <div class="col-sm-2" style="padding-left: 0px; padding-right: 5px; padding-bottom: 5px; min-width: 20%">
          <div class="info-box">
            

            	<table width="100%">
            		<tr>
            			<td rowspan="5" width="42%"><center><span style="font-weight: bold; font-size: 43px;"><?php echo $cekAllRiskCEO; ?></span><br />TOTAL RISK</center></td>
            			<tr>
            				<td colspan="3"><center><b>Risk Level</b></center></td>
            			</tr>
            			<tr>
            				<td width="5%"><img src="assets/images/legend/kri_red.png" width="15" /></td><td width="30%">High</td><td><font size="+1"><?php echo $cekHighRiskCEO;?></font></td>
            			</tr>
            			<tr>
            				<td width="5%"><img src="assets/images/legend/treatment.png" width="15" /></td><td width="30%">Moderate</td><td><font size="+1"><?php echo $cekModerateRiskCEO; ?></font></td>
            			</tr>
            			<tr>
            				<td width="5%"><img src="assets/images/legend/kri_green.png" width="15" /></td><td width="30%">Low</td><td><font size="+1"><?php echo $cekLowRiskCEO; ?></font></td>
            			</tr>
            		</tr>
            	</table>
            
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
 <div class="col-sm-2" style="padding-left: 0px; padding-right: 5px; padding-bottom: 5px; min-width: 20%">
          <div class="info-box">
            

            	<table width="100%">
            		<tr>
            			<td rowspan="5" width="46%"><center><span style="font-weight: bold; font-size: 43px;"><?php echo 0; ?></span><br />TOTAL ACTION PLAN</center></td>
            			<tr>
            				<td colspan="3"><center><b>Execution</b></center></td>
            			</tr>
            			<tr>
            				<td width="30%">Complete</td><td><font size="+1"><?php echo 0;?></font></td>
            			</tr>
            			<tr>
            				<td width="30%">On Going</td><td><font size="+1"><?php echo 0; ?></font></td>
            			</tr>
            			<tr>
            				<td width="30%">Extend</td><td><font size="+1"><?php echo 0; ?></font></td>
            			</tr>
            		</tr>
            	</table>
            
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

 <div class="col-sm-2" style="padding-left: 0px; padding-right: 5px; padding-bottom: 5px; min-width: 20%">
          <div class="info-box">
            

            	<table width="100%">
            		<tr>
            			<td rowspan="5" width="42%"><center><span style="font-weight: bold; font-size: 43px;"><?php echo 0; ?></span><br />TOTAL KRI</center></td>
            			<tr>
            				<td colspan="3"><center><b>KRI Warning</b></center></td>
            			</tr>
            			<tr>
            				<td width="5%"><img src="assets/images/legend/kri_red.png" width="15" /></td><td width="30%">Red</td><td><font size="+1"><?php echo 0;?></font></td>
            			</tr>
            			<tr>
            				<td width="5%"><img src="assets/images/legend/treatment.png" width="15" /></td><td width="30%">Yellow</td><td><font size="+1"><?php echo 0; ?></font></td>
            			</tr>
            			<tr>
            				<td width="5%"><img src="assets/images/legend/kri_green.png" width="15" /></td><td width="30%">Green</td><td><font size="+1"><?php echo 0; ?></font></td>
            			</tr>
            		</tr>
            	</table>
            
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

 <div class="col-sm-2" style="padding-left: 0px; padding-right: 5px; padding-bottom: 5px; min-width: 20%">
          <div class="info-box">
            

            	<table width="100%">
            		<tr>
            			<td rowspan="5" width="42%"><center><span style="font-weight: bold; font-size: 43px;"><?php echo $cekPriorAllRiskCEO; ?></span><br />PRIOR RISK</center></td>
            			<tr>
            				<td colspan="3"><center><b>Risk Level</b></center></td>
            			</tr>
            			<tr>
            				<td width="5%"><img src="assets/images/legend/kri_red.png" width="15" /></td><td width="30%">High</td><td><font size="+1"><?php echo $cekPriorHighRiskCEO;?></font></td>
            			</tr>
            			<tr>
            				<td width="5%"><img src="assets/images/legend/treatment.png" width="15" /></td><td width="30%">Moderate</td><td><font size="+1"><?php echo $cekPriorModerateRiskCEO; ?></font></td>
            			</tr>
            			<tr>
            				<td width="5%"><img src="assets/images/legend/kri_green.png" width="15" /></td><td width="30%">Low</td><td><font size="+1"><?php echo $cekPriorLowRiskCEO; ?></font></td>
            			</tr>
            		</tr>
            	</table>
            
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

 <div class="col-sm-2" style="padding-left: 0px; padding-right: 5px; padding-bottom: 5px; min-width: 20%">
          <div class="info-box">
            

            	<table width="100%">
            		<tr>
            			<td rowspan="5" width="46%"><center><span style="font-weight: bold; font-size: 43px;"><?php echo $cekAllActionPlanPriorCEO; ?></span><br />PRIOR ACTION PLAN</center></td>
            			<tr>
            				<td colspan="3"><center><b>Execution</b></center></td>
            			</tr>
 						<tr>
            				<td width="30%">Complete</td><td><font size="+1"><?php echo $cekComAllActionPlanPriorCEO;?></font></td>
            			</tr>
            			<tr>
            				<td width="30%">On Going</td><td><font size="+1"><?php echo $cekOngAllActionPlanPriorCEO; ?></font></td>
            			</tr>
            			<tr>
            				<td width="30%">Extend</td><td><font size="+1"><?php echo $cekExtAllActionPlanPriorCEO; ?></font></td>
            			</tr>
            		</tr>
            	</table>
            
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
  </div>
        <!-- /.col -->
        
      </div>
	</div>
	</div>
	<div class='panel panel-primary'>
	<div class='panel-body' >
	
                    <iframe  frameborder="no" height="520px" name="frame1" scrolling="no" src="http://localhost/PIICRStest27Desc/Chart_PII_beforebuildin/" style="border: 0px solid;" width="480px"></iframe>
                    <iframe  frameborder="no" height="520px" name="frame1" scrolling="no" src="http://localhost/PIICRStest27Desc/Chart_PII_beforebuildin/indexap.php" style="border: 0px solid;" width="480px"></iframe>
                    <iframe  frameborder="no" height="520px" name="frame1" scrolling="no" src="http://localhost/PIICRStest27Desc/Chart_PII_beforebuildin/indexkri.php" style="border: 0px solid;" width="480px"></iframe>
                    <iframe frameborder="no" height="520px" name="frame1" scrolling="no" src="http://localhost/PIICRStest27Desc/pii_pie2/indexcf.php" style="border: 0px solid;" width="480px"></iframe>

                    
    </div></div>               <!-- <div class='panel panel-primary'>-->
                  
                    </div>
                                
                    </form>
				</div>
		<div class="tab-pane " id="tab_risk_list">
		
			<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_list" >
		<div align="center">				
	<iframe align="center" frameborder="no" height="520px" name="frame1" scrolling="no" src="http://localhost/PIICRStest27Desc/Chart_PII_beforebuildin/direksi1/indextab1.php" style="border: 0px solid;" width="660px"></iframe>
	         </div>       
	
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_list" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_risk_list-filterBy">
								<option value="risk_event">Risk Event</option>
								<option value="risk_level">Risk Level</option>
								<option value="risk_impact_level">Impact Level</option>
								<option value="risk_likelihood_key">Likelihood</option>
								<option value="risk_owner">Risk Owner</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_risk_list-filterValue">
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
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_action_plan_exec-filterBy">
								<option value="action_plan">Action Plan</option>
								<option value="due_date">Due Date</option>
								<option value="division_name">Action Plan Owner</option>
								<option value="execution_status">Execution</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Insert Filter Value" id="tab_action_plan_exec-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_action_plan_exec-filterButton">Search</button>
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