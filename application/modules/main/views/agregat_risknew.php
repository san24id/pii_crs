<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
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
					<a target="_self" href="javascript:;">Aggregate Risk</a>
				</li>
			</ul>
			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/risk_aggregate_new_pdf/$id_period");?>">PDF</a>
						</li>
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/risk_aggregate_new_excel/$id_period");?>">Excel</a>
						</li>
					 
					</ul>
				</div>
			</div>
		</div>
<?php foreach ($periodeag as $key) {
	$mxperiod =  $key['periode_id'];
} ?>

		<!-- END PAGE HEADER-->
		<div class="row">
		<script type="text/javascript">
			/*var g_periode_id = '<?=$periode['periode_id']?>';*/
		</script>
		<div class="col-md-12">
		<div class="portlet">
			<div class="portlet-title">
					<a href="<?php echo site_url(); ?>/main/mainrac/aggregatrisk/<?php echo $id_period; ?>" class="btn default blue-stripe">
					<span class="hidden-480">
					Aggregete Risk Library</span>
					</a>
					<a href="<?php echo site_url(); ?>/main/mainrac/aggregatrisknew/<?php echo $id_period; ?>" class="btn default blue-stripe">
					<span class="hidden-480">
					Risk Aggregete</span>
					</a>
			<?php if($mxperiod == $id_period){ ?>
				<div class="actions">
					<a href="<?php echo site_url(); ?>/risk/RiskRegister/RiskAggregateInputNew/<?php echo $id_period; ?>" class="btn default green-stripe">
					<i class="fa fa-plus font-green"></i>
					<span class="hidden-480">
					Entry New</span>
					</a>
				</div>
			<?php } ?>
			</div>
			<input type="hidden" name="periode_id" id="periode_id" value="<?php echo $id_period ?>">
			
			<div class="tab-content">
				<div class="tab-pane active" id="tab_risk_list">
					<table>
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_list" >
						<tr>
						<td style="padding-right: 56px;"><label for="filterFormBy" class="smaller">Filter By</label></td>
						<td style="padding-right: 6px;"><label>:</label></td>
						<td style="padding-bottom: 5px; padding-right: 6px;"><select class="form-control input-medium input-sm" id="tab_risk_list-filterBy">
								<option value="choose" data-FilterRiskList = "Choose / Show All">Choose / Show All</option>
								<option value="risk_event" data-FilterRiskList = "Risk Event">Risk Event</option>
								<option value="risk_level" data-FilterRiskList = "Risk Level">Risk Level</option>
								<option value="risk_impact_level" data-FilterRiskList = "Impact Level">Impact Level</option>
								<option value="risk_likelihood_key" data-FilterRiskList = "Likelihood">Likelihood</option>
								<option value="risk_owner" data-FilterRiskList = "Risk Owner">Risk Owner</option>
							</select>
						</td>
					
						<td style="padding-bottom: 5px; padding-right: 6px; display: none;" id="choose_s_level">
							<select class="form-control input-medium input-sm" id="s_level">
								<option value="-">All Status</option>
								<option value="draft" data-RiskStatusLevel="Draft">Draft</option>
								<option value="submitted" data-RiskStatusLevel="Submitted to RAC">Submitted to RAC</option>
								<option value="verify" data-RiskStatusLevel="Verified by RAC ">Verified by RAC</option>
								<option value="treatment" data-RiskStatusLevel="On risk treatment process">On risk treatment process</option>
								<option value="action_plan" data-RiskStatusLevel="On action plan process">On action plan process</option>
								<option value="action_plan_execution" data-RiskStatusLevel="On action plan execution process">On action plan execution process</option>
								<option value="verified_final" data-RiskStatusLevel="Action plan has been executed and verified">Action plan has been executed and verified </option>
								<option value="adhoc" data-RiskStatusLevel="Adhoc">Adhoc</option>
							</select>
						</td>
						<td style="padding-bottom: 5px; padding-right: 6px; display: none;" id="choose_r_level">
							<select class="form-control input-medium input-sm" id="r_level">
								<option value="-">All</option>
								<option value="LOW" data-RiskLevel = "Low">Low</option>
								<option value="MODERATE" data-RiskLevel = "Moderate">Moderate</option>
								<option value="HIGH" data-RiskLevel = "High">High</option>
							</select>
						</td>
						<td style="padding-bottom: 5px; padding-right: 6px; display: none;" id="choose_l_hood">
							<select class="form-control input-medium input-sm" id="l_hood">
								<option value="-">All</option>
								<?php foreach ($likelihood as $key) {?>
									<option value="<?php echo $key['l_key']; ?>" data-likelihood = "<?php echo $key['l_key'];?>" data-likelihood2 = "<?php echo $key['l_title'];?>"><?php echo $key['l_title'];?></option>
								<?php }?>
							</select>
						</td>
						<td style="padding-bottom: 5px; padding-right: 6px; display: none;" id="choose_impact_l">
							<select class="form-control input-medium input-sm" id="impact_l">
								<option value="-">All</option>
								<?php foreach ($impact_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-impact = "<?php echo $key['ref_key'];?>" data-impact2 = "<?php echo $key['ref_value'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</td>
						<td style="padding-bottom: 5px; padding-right: 6px; display: none;" id="choose_l_divisi">
							<select class="form-control input-sm" id="l_divisi">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>" data-division2 = "<?php echo $key['ref_value'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</td>
						<td style="padding-bottom: 5px; padding-right: 6px; display: none;" id=risk_search>
							<input type="text" class="form-control input-sm" placeholder="Search" id="s_risklist">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_risk_list-filterValue">
							<input type="hidden" class="form-control input-sm" placeholder="Search" readonly="readonly" id="rl_1">
							<input type="hidden" class="form-control input-sm" placeholder="Search" readonly="readonly" id="rl_2">
						</td>
						<td style="padding-bottom: 5px;"><button type="submit" class="btn blue btn-sm" id="tab_risk_list-filterButton">Search</button></td>
					</tr>
					</form>

					<form class="form-inline" role="form" style="margin-bottom: 10px;">
					<tr>
					<td>
						<label for="filterFormBy" class="smaller">Last Filter By </label>
					</td>
					<td><label>:</label></td>
					<td style="padding-bottom: 5px; padding-right: 6px;"><input type="text" class="form-control input-sm" placeholder="Search" readonly="readonly" id="rl_3" value="<?php if(isset($_SESSION['filter_rl_1'])){echo $_SESSION['filter_rl_1']; } ?>"></td>
					<td  style="padding-bottom: 5px; padding-right: 6px;"><input type="text" class="form-control input-sm" placeholder="Search" readonly="readonly" id="rl_4" value="<?php if(isset($_SESSION['filter_rl_2'])){echo $_SESSION['filter_rl_2']; } ?>">

					</td>
				    </tr>
					</form>
				   </table>
				   <div class="portlet-body">
					<div ><!--class="table-scrollable"-->
					<table class="table table-condensed table-bordered table-hover" id="datatable_ajax">
						<thead>
						<tr role="row" class="heading">
							<th><center>Risk Event</center></th>
							<th><center>Risk Level</center></th>
							<th><center>Impact Level</center></th>
							<th><center>Likelihood</center></th>
							<th><center>Risk Owner</center></th>
							<th><center>Action</center></th>
						</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
		</div>
		
	</div>
</div>


<!-- LIBRARY -->
<div id="modal-library" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Risk Library</h4>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="col-md-6 input-group">
					<select class="form-control input-sm" name="filter_search">
						<option value="HIGH">Tinggi</option>
						<option value="MODERATE">Sedang</option>
						<option value="LOW">Rendah</option>
					</select>
					<span class="input-group-btn">
					<button class="btn btn-default btn-sm" type="button" id="modal-library-filter-submit">Search</button>
					</span>
				</div>
				<!--
				<div class="checkbox-list">
					<label class="checkbox-inline">
					<input type="checkbox" id="checkbox_high" class="checkbox_selectClass" value="HIGH"> Tinggi </label>
					<label class="checkbox-inline">
					<input type="checkbox" id="checkbox_moderate" class="checkbox_selectClass" value="MODERATE"> Sedang </label>
					<label class="checkbox-inline">
					<input type="checkbox" id="checkbox_low" class="checkbox_selectClass" value="LOW"> Rendah </label>
				</div>
				-->
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="library_table" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="2%">
						<input type="checkbox" class="group-checkable">
					</th>
					<th>No</th>
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Risk Level</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
	<div class="modal-footer">
		<button id="library-modal-add" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Add</button>
		<button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
	</div>
</div>
<!-- Action Plan -->
<div id="modal-action_plan" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Edit Statement for Action Plan</h4>
	</div>
	<div class="modal-body">
		<div class="form">
				<form id="input-form-action_plan" role="form" class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
									<label class="col-md-2 control-label">Statement Text</label>
									<div class="col-md-9">
									<textarea class="form-control" rows="10" name="s_action_plan" placeholder="Message Text" id="s_action_plan"><?=$s_action_plan['text']?></textarea>
									</div>
						</div>

					</div>
				</form>
			</div>
		</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="save-action_plan" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>	
</div>

<!-- action_plan_execution -->
<div id="modal-action_plan_exe" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Edit Statement for Action Plan Execution</h4>
	</div>
	<div class="modal-body">
		<div class="form">
				<form id="input-form-action_plan_exe" role="form" class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
									<label class="col-md-2 control-label">Statement Text</label>
									<div class="col-md-9">
									<textarea class="form-control" rows="10" name="s_action_plan_exe" placeholder="Message Text" id="s_action_plan_exe"><?=$s_action_plan_exe['text']?></textarea>
									</div>
						</div>

					</div>
				</form>
			</div>
		</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="save-action_plan_exe" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>	
</div>

<div id="modal_listrisk" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Form Action Plan Edit</h4>		 
	</div>
	<div class="modal-body">
				<form id="modal-listrisk-form" role="form" class="form-horizontal">
					<div class="form-body">
				
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">AP.ID :</label>
							<div class="col-md-9">
							<input class="form-control input-sm" readonly="true" type="text" placeholder="" name="ap_code" id = "ap_code">
							<input class="form-control input-sm" readonly="true" type="hidden" placeholder="" name="id" id = "id">
							</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Action Plan :</label>
							<div class="col-md-9">
							<textarea class="form-control" name ="action_plan" id ="action_plan"></textarea>  
							<textarea style="display:none;" class="form-control" name = "action_plan_ex" id = "action_plan_ex"></textarea>
							</div>
						</div>
						
						<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the target completion date of risk treatment plan.">Due Date</label>
								<div class="col-md-9">

										
											<input type="button" style="width: 20px; height: 20px;" onclick="Check()" id="ckc" />
											<input type="button"  style=" width: 20px; height: 20px;" onclick="Chckd()" id="kcc" />
						 					&nbsp;Continous&nbsp;<span id="checked"><img width="20px" height="20px" src="<?php echo base_url('assets/images/checkbox-checked.png')?>" /></span>
						 					<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" id="fdate">
										
											
											<input type="text" class="form-control input-sm" name="due_date" id="due_date" placeholder="select date">
									
									<span class="input-group-btn">
									<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
								</div>
							</div>
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Action Plan Owner :</label>
							<div class="col-md-9">
							<select name="division"  class="form-control" id = "division"> 
							</select>		
							<input type="hidden" class="form-control" name="division_ex" id = "division_ex"> 
							</div>
						</div>

						<div class="form-group" style="display: none;">
						 
						<label class="col-md-3 control-label smaller cl-compact">Hidden Input :</label>
							<div class="col-md-9">
								<input type="text" class="form-control input-sm" name="action_plan_status" id="action_plan_status">
								<input type="text" class="form-control input-sm" name="periode_id" id="periode_id">

							</div>
						</div>
					
						 
					</div>
				</form>			
		<br>			
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="library-modal-listriskap-update" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>