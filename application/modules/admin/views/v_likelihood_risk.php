<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Risk List
		</h3>
		<!-- END PAGE HEADER-->
		
		<div class="row">
		<div class="col-md-12">

			<div class="portlet">
			<div class="portlet-title">
				
					<a href="<?php echo site_url(); ?>/admin/manage/likelihood"><button type="button" class="btn btn-sm default green-stripe">
					List Likelihood </span>
					</button></a>
				
			
			</div>
			
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_old_risk_list" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_old_risk_list-filterBy">
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
						<div class="form-group" id="choose_s_level-prior" style="display: none;">
							<select class="form-control input-medium input-sm" id="s_level-prior">
								<option value="-">All Status</option>
								<option value="draft" data-RiskStatusLevel="Draft">Draft</option>
								<option value="submitted" data-RiskStatusLevel="submitted to RAC">Submitted to RAC</option>
								<option value="treatment" data-RiskStatusLevel="On risk treatment process">On risk treatment process</option>
								<option value="action_plan" data-RiskStatusLevel="On action plan process">On action plan process</option>
								<option value="action_plan_execution" data-RiskStatusLevel="On action plan execution process">On action plan execution process</option>
								<option value="verified_final" data-RiskStatusLevel="Action plan has been executed and verified">Action plan has been executed and verified </option>
							</select>
						</div>
						<div class="form-group" id="choose_r_level-prior" style="display: none;">
							<select class="form-control input-medium input-sm" id="r_level-prior">
								<option value="-">All</option>
								<option value="LOW" data-RiskLevel = "Low">Low</option>
								<option value="MODERATE" data-RiskLevel = "Moderate">Moderate</option>
								<option value="HIGH" data-RiskLevel = "High">High</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_hood-prior" style="display: none;">
							<select class="form-control input-medium input-sm" id="l_hood-prior">
								<option value="-">All</option>
								<?php foreach ($likelihood as $key) {?>
									<option value="<?php echo $key['l_key']; ?>" data-likelihood = "<?php echo $key['l_key'];?>" data-likelihood2 = "<?php echo $key['l_title'];?>"><?php echo $key['l_title'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_impact_l-prior" style="display: none;">
							<select class="form-control input-medium input-sm" id="impact_l-prior">
								<option value="-">All</option>
								<?php foreach ($impact_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-impact = "<?php echo $key['ref_key'];?>" data-impact2 = "<?php echo $key['ref_value'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-prior" style="display: none;">
							<select class="form-control input-sm" id="l_divisi-prior">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>" data-division2 = "<?php echo $key['ref_value'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_old_risk_list-filterValue">
							<input type="text" class="form-control input-sm" style="display: none;" placeholder="Search" id="s_risklist_prior">
							<input type="hidden" class="form-control input-sm" placeholder="Search" readonly="readonly" id="rlp_1">
							<input type="hidden" class="form-control input-sm" placeholder="Search" readonly="readonly" id="rlp_2">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_old_risk_list-filterButton">Search</button>
					</form>

					<form class="form-inline" role="form" style="margin-bottom: 10px;">
					<div class="form-group" style="display: none;">
						<label for="filterFormBy" class="smaller">Last Filter By : </label>
						<input type="text" class="form-control input-sm" placeholder="Search" readonly="readonly" id="rlp_3" value="<?php if(isset($_SESSION['filter_rlp_1'])){echo $_SESSION['filter_rlp_1']; } ?>">
						<input type="text" class="form-control input-sm" placeholder="Search" readonly="readonly" id="rlp_4" value="<?php if(isset($_SESSION['filter_rlp_2'])){echo $_SESSION['filter_rlp_2']; } ?>">

					</div>
				</form>
			</div>
			<div class="portlet-body">
				<input type="hidden" id="id_l" value="<?php echo $id_l; ?>">
				<div class="table-container">
					<div class="table-actions-wrapper">
						</div>
							<table id="likelihood_risk" class="table table-condensed table-bordered table-hover">
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

