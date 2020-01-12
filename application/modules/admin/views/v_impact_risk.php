<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Manage Impact
		</h3>
		<!-- END PAGE HEADER-->
		
		<div class="row">
		<div class="col-md-12">

			<div class="portlet">
			<div class="portlet-title">
				
					<a href="<?php echo site_url(); ?>/admin/manage"><button type="button" class="btn btn-sm default green-stripe">
					List Impact </span>
					</button></a>
				
			
			</div>
			
			<form class="form-inline" role="form" id="filterForm">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_risk_list-filterBy">
								<option value="choose" data-FilterRiskList = "Choose / Show All">Choose / Show All</option>
								<option value="risk_status" data-FilterRiskList = "Status">Status</option>
								<option value="risk_code" data-FilterRiskList = "Risk ID">Risk ID</option>
								<option value="risk_event" data-FilterRiskList = "Risk Event">Risk Event</option>
								<option value="risk_level" data-FilterRiskList = "Risk Level">Risk Level</option>
								<option value="risk_impact_level" data-FilterRiskList = "Impact Level">Impact Level</option>
								<option value="risk_likelihood_key" data-FilterRiskList = "Likelihood">Likelihood</option>
								<option value="risk_owner" data-FilterRiskList = "Risk Owner">Risk Owner</option>
							</select>
						</div>
						<div class="form-group" id="choose_s_level" style="display: none;">
							<select class="form-control input-medium input-sm" id="s_level">
								<option value="-">All Status</option>
								<option value="draft" data-RiskStatusLevel="Draft">Draft</option>
								<option value="submitted" data-RiskStatusLevel="submitted to RAC">Submitted to RAC</option>
								<option value="treatment" data-RiskStatusLevel="On risk treatment process">On risk treatment process</option>
								<option value="action_plan" data-RiskStatusLevel="On action plan process">On action plan process</option>
								<option value="action_plan_execution" data-RiskStatusLevel="On action plan execution process">On action plan execution process</option>
								<option value="verified_final" data-RiskStatusLevel="Action plan has been executed and verified">Action plan has been executed and verified </option>
							</select>
						</div>
						<div class="form-group" id="choose_r_level" style="display: none;">
							<select class="form-control input-medium input-sm" id="r_level">
								<option value="-">All</option>
								<option value="LOW" data-RiskLevel = "Low">Low</option>
								<option value="MODERATE" data-RiskLevel = "Moderate">Moderate</option>
								<option value="HIGH" data-RiskLevel = "High">High</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_hood" style="display: none;">
							<select class="form-control input-medium input-sm" id="l_hood">
								<option value="-">All</option>
								<?php foreach ($likelihood as $key) {?>
									<option value="<?php echo $key['l_key']; ?>" data-likelihood = "<?php echo $key['l_key'];?>" data-likelihood2 = "<?php echo $key['l_title'];?>"><?php echo $key['l_title'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_impact_l" style="display: none;">
							<select class="form-control input-medium input-sm" id="impact_l">
								<option value="-">All</option>
								<?php foreach ($impact_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-impact = "<?php echo $key['ref_key'];?>" data-impact2 = "<?php echo $key['ref_value'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi" style="display: none;">
							<select class="form-control input-sm" id="l_divisi">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>" data-division2 = "<?php echo $key['ref_value'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" style="display: none;" placeholder="Search" id="s_risklist">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_risk_list-filterValue">
							<input type="hidden" class="form-control input-sm" placeholder="Search" readonly="readonly" id="rl_1">
							<input type="hidden" class="form-control input-sm" placeholder="Search" readonly="readonly" id="rl_2">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_risk_list-filterButton">Search</button>
					</form>

					<form class="form-inline" role="form" style="margin-bottom: 10px;">
					<div class="form-group" style="display: none;">
						<label for="filterFormBy" class="smaller">Last Filter By : </label>
						<input type="text" class="form-control input-sm" placeholder="Search" readonly="readonly" id="rl_3" value="<?php if(isset($_SESSION['filter_rl_1'])){echo $_SESSION['filter_rl_1']; } ?>">
						<input type="text" class="form-control input-sm" placeholder="Search" readonly="readonly" id="rl_4" value="<?php if(isset($_SESSION['filter_rl_2'])){echo $_SESSION['filter_rl_2']; } ?>">

					</div>
					</form>	
			</div>
			<div class="portlet-body">
				<input type="hidden" id="id_im" value="<?php echo $id_im; ?>">
				<div class="table-container">
					<div class="table-actions-wrapper">
						</div>
							<table id="library_table" class="table table-condensed table-bordered table-hover">
								<thead>
									<tr role="row" class="heading">
									<th width="30px"><center>Status</center></th>
									<th><center>Risk ID</center></th>
									<th><center>Risk Event</center></th>
									<th><center>Risk Level</center></th>
									<th><center>Impact Level</center></th>
									<th><center>Likelihood</center></th>
									<th><center>Risk Owner</center></th>
									<th><center>Type</center></th>
									</tr>
								</thead>
							<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>

<div id="modal_impact_edit" class="modal fade" tabindex="-1" data-width="1000" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Form Edit Impact</h4>		 
	</div>
	<div class="modal-body">
				<form id="impact_edit" role="form" class="form-horizontal">
					<div class="form-body">
				
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Impact Category :</label>
							<div class="col-md-9">
							<input type="hidden" class="form-control input-sm input-readview" name="impact_id" placeholder="impact_id">
							<textarea class="form-control input-sm input-readview" name ="impact_category" id="impact_category"></textarea>  
							</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-2 control-label cl-compact">Impact Level</label>
							<div class="col-md-9">
							
							</div>
						</div>
						
						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact">Level 1 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Insignificant</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_1" placeholder="level_1">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 1 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_1_desc" id="level_1_desc"></textarea>  
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" >Level 2 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Minor</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_2" placeholder="level_2">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 2 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_2_desc" id="level_2_desc"></textarea>  
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" >Level 3 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Moderate</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_3" placeholder="level_3">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 3 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_3_desc" id="level_3_desc"></textarea>  
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" >Level 4 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Major</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_4" placeholder="level_4">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 4 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_4_desc" id="level_4_desc"></textarea>  
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" >Level 5 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Catastrophic</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_5" placeholder="level_5">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 5 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_5_desc" id="level_5_desc"></textarea>  
							</div>
						</div>

					</div>

				</form>			
		<br>			
	</div>
	<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
			<button id="impact_button_edit" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>

<div id="modal_impact_insert" class="modal fade" tabindex="-1" data-width="1000" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Form Insert Impact</h4>		 
	</div>
	<div class="modal-body">
				<form id="impact_insert" role="form" class="form-horizontal">
					<div class="form-body">
				
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Impact Category :</label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="impact_category" id="impact_category"></textarea>  
							</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-2 control-label cl-compact">Impact Level</label>
							<div class="col-md-9">
							
							</div>
						</div>
						
						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact">Level 1 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Insignificant</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_1" placeholder="level_1" value="INSIGNIFICANT">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 1 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_1_desc" id="level_1_desc"></textarea>  
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" >Level 2 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Minor</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_2" placeholder="level_2" value="MINOR">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 2 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_2_desc" id="level_2_desc"></textarea>  
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" >Level 3 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Moderate</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_3" placeholder="level_3" value="MODERATE">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 3 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_3_desc" id="level_3_desc"></textarea>  
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" >Level 4 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Major</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_4" placeholder="level_4" value="MAJOR">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 4 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_4_desc" id="level_4_desc"></textarea>  
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" >Level 5 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Catastrophic</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_5" placeholder="level_5" value="CATASTROPHIC">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 5 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_5_desc" id="level_5_desc"></textarea>  
							</div>
						</div>

					</div>

				</form>			
		<br>			
	</div>
	<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
			<button id="impact_button_insert" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Submit</button>
	</div>
</div>

<div id="modal_level_name_edit" class="modal fade" tabindex="-1" data-width="1000" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Form Edit Name Level</h4>		 
	</div>
	<div class="modal-body">
					<div class="form-body">
					<h4>Impact Level</h4>
							 <table class="table table-striped table-bordered" id="datatable_impactlevel">
								<thead>
									<tr role="row" class="heading">
										<th>Name Level</th>
										<th width="7%">Action</th>
									</tr>
								</thead>
							
								 <tbody>
								</tbody>
							</table>
							</div>

						
						
	</div>		
		<br>			
	</div>
</div>

<div id="modal_level_edit" class="modal fade" tabindex="-1" data-width="400" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	</div>
	<div class="modal-body">
				<form id="namelevel_edit" role="form" class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
								<div class="col-md-12">
									<input type="hidden" class="form-control input-sm input-readview" readonly="readonly" name="level_id" placeholder="level_id">
									<input type="hidden" class="form-control input-sm input-readview" readonly="readonly" name="name_level" placeholder="name_level">
									<input type="text" class="form-control input-sm input-readview" readonly="readonly" name="level_name" placeholder="level_name">
								</div>
						</div>
					</div>
				</form>			
		<br>			
	</div>
	<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
			<button id="name_level_button_edit" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>

<!-- IMPACT LEVEL -->
<div id="modal-impact" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Evaluation on Risk Impact</h4>
		<span class="font-red">* Choose one(1) or more from category, but one(1) category only have one(1) parameter</span>
	</div>
	<div class="modal-body" style="height: 400px; max-height: 400px; overflow: none; overflow-y: auto;">
		<form id="form-impact">
		<table class="table table-condensed table-bordered table-hover">
			<thead>
			<tr role="row" class="heading">
				<th>Category</th>
				<th>Parameter</th>
			</tr>
			</thead>
			<tbody>
			<?php $cnt = 0;
				foreach($impact_list['impact'] as $k=>$v) { ?>
				<tr>
					<td><?=$v?></td>
					<td>
						<div class="radio-list">
							<label>
							<input type="radio" name="impactlevel_<?=$k?>" value="NA" checked> N/A</label>
							<?php foreach($impact_list['impact_list'][$k] as $key=>$row) { ?>
							<label>
							<input type="radio" name="impactlevel_<?=$k?>" value="<?=$key?>"> <?=$row?></label>
							<?php } ?>
						</div>
					</td>
				</tr>
			<?php $cnt++; } ?>
			</tbody>
		</table>
		</form>
	</div>
	<div class="modal-footer">
		<button id="input-form-impact-button" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>