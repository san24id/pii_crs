<script src="assets/toogle/js/jquery-3.1.1.min"></script>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Key Risk Indicator (KRI) Form
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Key Risk Indicator Form</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-12">
			<form id="input-form" role="form" class="form-horizontal">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-2 control-label">Risk ID</label>
						<div class="col-md-6">
							<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_library_code" placeholder="" value="<?=$risk['risk_code']?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Risk Event</label>
						<div class="col-md-6">
						<textarea class="form-control input-sm input-readview"  data-container="body" data-placement="bottom" rows="3" readonly="true" name="risk_event" placeholder=""><?=$risk['risk_event']?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" >Risk Level</label>
						<div class="col-md-6">
						<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_level" placeholder="" value="<?=$risk['risk_level_v']?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" >Risk Treatment</label>
						<div class="col-md-6">
							<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_treatment" placeholder="" value="<?=$risk['treatment_v']?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" >Action Plan</label>
						<div class="col-md-8">
							<table id="action_plan_table" class="table table-condensed table-bordered table-hover">
								<thead>
								<tr role="row" class="heading">
									<th>Action Plan</th>
									<th>Due Date</th>
									<th>Action Plan Owner</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($risk['action_plan_list'] as $key => $value) { ?>
									<tr>
										<td><?=$value['action_plan']?></td>
										<td>
											<?php 
												if($value['due_date_v'] == '00-00-0000'){
													echo "Continuous";
												}else{
													echo $value['due_date_v'];
												}
											?>
										</td>
										<td><?=$value['division_v']?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</form>
			<hr/>
			<div class="form">
			<form id="kri-form" role="form" class="form-horizontal">
			<input type="hidden" name="kri_id" id="kri-id" value="<?=$kri['id']?>"/>
			<input type="hidden" name="risk_id" id="kri-risk-id" value=""/>
			<div class="form-body">
				<div class="form-group">
					<input type="hidden" name="kri_library_id" value=""/>
					<label class="col-md-2 control-label">KRI ID</label>
					<div class="col-md-6">
						<input type="text" class="form-control input-sm input-readview" readonly="true" name="kri_library_code" placeholder="" value="<?=$kri['kri_code']?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Mitigation Complete ?</label>
					<div class="col-md-6">
					<?php if($kri['mandatory'] == 'N'){ ?>
						<input data-toggle="toggle" type="checkbox" data-size="small" data-onstyle="danger" data-on = "Already" data-off = "Not Yet" disabled="disabled" />
						<input type="hidden" class="form-control input-sm input-readview" readonly="true" name="mandatory" placeholder="" value="<?=$kri['mandatory']?>">
					<?php }else{ ?>
						<input data-toggle="toggle" type="checkbox" checked="checked" data-size="small" data-onstyle="danger" data-on = "Already" data-off = "Not Yet" disabled="disabled" />
						<input type="hidden" class="form-control input-sm input-readview" readonly="true" name="mandatory" placeholder="" value="<?=$kri['mandatory']?>">
					<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Key Risk Indicator</label>
					<div class="col-md-6">
					<textarea class="form-control input-sm popovers input-readview"  readonly="true" data-container="body" data-placement="bottom" rows="3" name="key_risk_indicator" required="required" placeholder=""></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">KRI Owner</label>
					<div class="col-md-4">
						<input type="text" class="form-control input-sm input-readview" readonly="true" placeholder="" value="<?=$kri['kri_owner_v']?>">
					</div>
				</div>

				<div class="form-group">	
					<label class="col-md-2 control-label">Threshold Type</label>
					<div class="col-md-2">

						<input type="text" class="form-control input-sm input-readview" readonly="true" id="select-treshold-type-1" name="treshold_type">
						<input type="text" class="form-control input-sm input-readview" readonly="true" id="select-treshold-type" name="treshold_type">
						<input type="text" class="form-control input-sm input-readview" readonly="true" id="select-treshold-type2" name="treshold_type">

					</div>
				</div>
				<div class="form-group"  id="treshold_description">
					<label class="col-md-2 control-label">Threshold</label>
					<div class="col-md-8">
						<table id="treshold_table" class="table table-condensed table-bordered table-hover">
							<thead>
							<tr role="row" class="heading">
								<th>Operator</th>
								<th>Value 1</th>
								<th>Value 2</th>
								<th>Type Value</th>
								<th>Warning</th>
							</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 control-label">Deadline For Report</label>
					<div class="col-md-2">
					
						<input type="text" class="form-control input-sm" id="timing" name="timing_pelaporan" required="required" readonly>
					</div>
				</div>
			</div>
			<div class="form-actions right">
				
				
				<button id="kri-button-delete_verify_yes" type="button" class="btn red"><i class="fa fa-times"></i>Delete</button>
				<button type="button" class="btn yellow" id="kri-button-cancel"><i class="fa fa-times"></i> Cancel</button>
			</div>
			</form>
			</div>
		</div>
		</div>
	</div>
</div>
<?php if (isset($verifyRac) && $verifyRac) { ?>
<script type="text/javascript">
var t_treshold_type = '<?=$kri['treshold_type']?>';
var t_treshold_list = <?=json_encode($kri['treshold_list'])?>;
</script>


<?php } ?>

<!-- CATEGORY -->
<div id="modal-category" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Risk Level </h4>
	</div>

	<?php
	$this->load->database();
	$sql2 = "select * from t_risk where risk_id = (select risk_id from t_kri where id = '$kri_id')";
	$sql2_run = $this->db->query($sql2)->row();
	?>
	<div style="margin-left:50px;">
	Based on validation performed Do you consider any changes on current risk level ? <br>
	</div>
	<div style="margin-left:70px;">
	<table width="40%">
		<tr>
			<td width="23%">current impact level</td><td width="5%">=</td><td width="12%"><?php echo $sql2_run->risk_impact_level; ?></td>
		</tr>
		<tr>
			<td>current likelihood</td><td>=</td><td><?php echo $sql2_run->risk_likelihood_key; ?></td>
		</tr>
		<tr>
			<td>current risk level</td><td>=</td><td><?php echo $sql2_run->risk_level; ?></td>
		</tr>
	</table>
	</div>
	<div class="modal-body" style="display: none;">
			<form id="modal-category-form" role="form" class="form-horizontal">
				<input type="hidden" name="mode" value="add" />
				<input type="hidden" name="cat_id" value="" />
				<input type="hidden" name="cat_parent" value="0" />
				<div class="form-body">
					 <div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Impact Level <span class="required">* </span></label>
						<div class="col-md-9">
							<div class="input-group">
								 <input type="hidden" name="risk_impact_level_id" id = "risk_impact_level_id" value=""/> 
								<input type="text" class="form-control input-sm" readonly="true" name="risk_impact_level_after_kri" id = "risk_impact_level_after_mitigation_no" value="<?php echo $sql2_run->risk_impact_level; ?>" placeholder="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Likelihood <span class="required">* </span></label>
						<div class="col-md-9">
							<div class="input-group">
								 <input type="hidden" name="risk_likelihood_id" id = "risk_likelihood_id" value=""/> 
								<input type="text" class="form-control input-sm" readonly="true" name="risk_likelihood_key_after_kri" id = "risk_likelihood_key_after_mitigation_no" value="<?php echo $sql2_run->risk_likelihood_key; ?>" placeholder="">
							</div>
						</div>
					</div>
					<div class="form-group">
					    <input type="hidden" name="risk_level_id" id = "risk_level_id" value=""/> 
						<label class="col-md-3 control-label smaller cl-compact" >Risk Level </label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" readonly="true" name="risk_level_after_kri" id = "risk_level_after_mitigation_no" value="<?php echo $sql2_run->risk_level; ?>" placeholder="">
						</div>
					</div>
				</div>
			</form>
	</div>
	<div class="modal-footer">
		<!--<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>-->

		<button id="modal-impactlevel-form-submit-no" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-left"
			>NO</button>
		<button id="modal-impactlevel-form-submit-validation" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-left"
			>YES</button>
	</div>
</div>


<!-- CATEGORY -->
<div id="modal-category" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Risk Level  </h4>
	</div>
	<div class="modal-body">
			<form id="modal-category-form" role="form" class="form-horizontal">
				<input type="hidden" name="mode" value="add" />
				<input type="hidden" name="cat_id" value="" />
				<input type="hidden" name="cat_parent" value="0" />
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Impact Level <span class="required">* </span></label>
						<div class="col-md-9">
							<div class="input-group">
								 <input type="hidden" name="risk_impact_level_id" id = "risk_impact_level_id" value=""/> 
								<input type="text" class="form-control input-sm" readonly="true" name="risk_impact_level_after_kri" id = "risk_impact_level_after_mitigation" placeholder="">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" id="btn_impact_list"><i class="fa fa-search fa-fw"/></i></button>
								</span>
								
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Likelihood <span class="required">* </span></label>
						<div class="col-md-9">
							<div class="input-group">
								 <input type="hidden" name="risk_likelihood_id" id = "risk_likelihood_id" value=""/> 
								<input type="text" class="form-control input-sm" readonly="true" name="risk_likelihood_key_after_kri" id = "risk_likelihood_key_after_mitigation" placeholder="">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-likelihood"><i class="fa fa-search fa-fw"/></i></button>
								</span>
								
							</div>
						</div>
					</div>
					<div class="form-group">
					    <input type="hidden" name="risk_level_id" id = "risk_level_id" value=""/> 
						<label class="col-md-3 control-label smaller cl-compact" >Risk Level </label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" readonly="true" name="risk_level_after_kri" id = "risk_level_after_mitigation" placeholder="">
						</div>
					</div>
					
				</div>
			</form>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="modal-impactlevel-form-submit" type="button" 
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
		<span class="font-red">* Dapat diisi lebih dari satu(1) kategori, namun dalam Satu(1)
		Kategori hanya boleh diisi satu(1) parameter</span>
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

<!-- LIKELIHOOD -->
<div id="modal-likelihood" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Evaluation on Risk Likelihood</h4>
		<span class="font-red">* Pilih Salah Satu</span>
	</div>
	<div class="modal-body">
		<form id="form-likelihood">
		<table class="table table-condensed table-bordered table-hover">
			<thead>
			<tr role="row" class="heading">
				<th>&nbsp;</th>
				<th width="250px">Kemungkinan terjadinya resiko</th>
				<th>Deskripsi</th>
			</tr>
			</thead>
			<tbody>
			<?php $cnt = 0;
				foreach($likelihood as $row) { ?>
				<tr>
					<td><label><input type="radio" name="risk_likelihood" id="likelihood_<?=$row['l_id']?>" value="<?=$row['l_key']?>|<?=$row['l_title']?>" <?=$cnt == 0 ? 'checked' : ''?>></label></td>
					<td><?=$row['l_title']?></td>
					<td><?=$row['l_desc']?></td>
				</tr>
			<?php $cnt++; } ?>
			</tbody>
		</table>
		</form>
	</div>
	<div class="modal-footer">
		<button id="input-form-likelihood-button" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>

<!-- LIBRARY -->
<div id="modal-library" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Risk Library</h4>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_search" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modal-library-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="library_table" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="66px">&nbsp;</th>
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<!-- KRI LIBRARY -->
<div id="modal-kri" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">KRI Library</h4>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_search" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modal-kri-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="kri_library_table" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="66px">&nbsp;</th>
					<th>KRI Code</th>
					<th>Key Risk Indicator</th>
					<th>Mandatory</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<!-- KRI Treshold BY SELECTION -->
<div id="modal-treshold-selection" class="modal fade" tabindex="-1" data-width="860" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>-->
		<h4 class="modal-title">Threshold Type Selection</h4>
	</div>
	<div class="modal-body">
		<input type = "hidden" id = "form-control-revid-objective">
		<form id="kri-form-selection" role="form" class="form-horizontal">
			<input type="hidden" name="operator" value="EQUAL" />
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-2 control-label">Equal to</label>
					<div class="col-md-6">
					<input type="text" class="form-control input-sm input-readview" name="value-equal-1" id="value-equal-1" placeholder="">
					</div>
					<label class="col-md-1 control-label">Warning</label>
					<div class="col-md-2">
					<select class="form-control input-sm" name="value-equal-1-result" id="value-equal-1-result" >
						<option value="GREEN">Green</option>
						<option value="YELLOW">Yellow</option>
						<option value="RED">Red</option>
					</select>
					</div>
				</div>
			</div>
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-2 control-label">Equal to</label>
					<div class="col-md-6">
					<input type="text" class="form-control input-sm input-readview" name="value-equal-2" id="value-equal-2" placeholder="">
					</div>
					<label class="col-md-1 control-label">Warning</label>
					<div class="col-md-2">
					<select class="form-control input-sm" name="value-equal-2-result" id="value-equal-2-result" >
						<option value="GREEN">Green</option>
						<option value="YELLOW">Yellow</option>
						<option value="RED">Red</option>
					</select>
					</div>
				</div>
			</div>
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-2 control-label">Equal to</label>
					<div class="col-md-6">
					<input type="text" class="form-control input-sm input-readview" name="value-equal-3" id="value-equal-3" placeholder="">
					</div>
					<label class="col-md-1 control-label">Warning</label>
					<div class="col-md-2">
					<select class="form-control input-sm" name="value-equal-3-result" id="value-equal-3-result" >
						<option value="GREEN">Green</option>
						<option value="YELLOW">Yellow</option>
						<option value="RED">Red</option>
					</select>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<button id="button-treshold-selection-add" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Close</button>
	</div>
</div>

<!-- KRI Treshold BY VALUE -->
<div id="modal-treshold-value" class="modal fade" tabindex="-1" data-width="950" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<h4 class="modal-title">Threshold Type Value</h4>
	</div>
	<div class="modal-body">
	<input type = "hidden" id = "form-control-value-objective">
		<form id="kri-form-value" role="form" class="form-horizontal">
			<div class="form-body row">
				<div class="col-md-6" id="t-col-left-treshold">
					<h4 style="margin-top: 0;"><b>Numeric Treshold</b></h4>
					<div class="form-group">
						<input type="hidden" name="value-below-2" value='-'>
						<input type="hidden" name="value-below-oper_v" value='Below'>
						<input type="hidden" name="value-below-oper" value='BELOW'>
						<input type="hidden" name="value-below-value_type" value='NUMERIC'>
						
						<label class="col-md-2 control-label">Below</label>
						<div class="col-md-7" style="padding-right: 0px;">
						<input type="number" class="form-control input-sm" name="value-below-1" id="value-below-1" placeholder="">
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="value-below-result" id="value-below-result">
								<option value="GREEN">Green</option>
								<option value="YELLOW">Yellow</option>
								<option value="RED">Red</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<input type="hidden" name="value-between-oper_v" value='Between'>
						<input type="hidden" name="value-between-oper" value='BETWEEN'>
						<input type="hidden" name="value-between-value_type" value='NUMERIC'>
						
						<label class="col-md-2 control-label">Between</label>
						<div class="col-md-7" style="padding-right: 0px;">
							<div class="input-group">
								<input type="number" class="form-control input-sm" name="value-between-1" id="value-between-1">
								<span class="input-group-addon" style="min-width: 10px; padding: 0;"></span>
								<input type="number" class="form-control input-sm" name="value-between-2" id="value-between-2">
							</div>
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="value-between-result" id="value-between-result">
								<option value="GREEN">Green</option>
								<option value="YELLOW">Yellow</option>
								<option value="RED">Red</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<input type="hidden" name="value-above-2" value='-'>
						<input type="hidden" name="value-above-oper_v" value='Above'>
						<input type="hidden" name="value-above-oper" value='ABOVE'>
						<input type="hidden" name="value-above-value_type" value='NUMERIC'>
						
						<label class="col-md-2 control-label">Above</label>
						<div class="col-md-7" style="padding-right: 0px;">
						<input type="number" class="form-control input-sm" name="value-above-1" id="value-above-1" placeholder="">
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="value-above-result" id="value-above-result">
								<option value="GREEN">Green</option>
								<option value="YELLOW">Yellow</option>
								<option value="RED">Red</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="col-md-6" id="t-col-right-treshold">
					<h4 style="margin-top: 0;"><b>Percentage Threshold</b></h4>
					<div class="form-group">
						<input type="hidden" name="perc-below-2" value='-'>
						<input type="hidden" name="perc-below-oper_v" value='Below'>
						<input type="hidden" name="perc-below-oper" value='BELOW'>
						<input type="hidden" name="perc-below-value_type" value='PERCENTAGE'>
						
						<label class="col-md-2 control-label">Below</label>
						<div class="col-md-7" style="padding-right: 0px;">
						<input type="number" class="form-control input-sm" name="perc-below-1" id="perc-below-1">
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="perc-below-result" id="perc-below-result">
								<option value="GREEN">Green</option>
								<option value="YELLOW">Yellow</option>
								<option value="RED">Red</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<input type="hidden" name="perc-between-oper_v" value='Between'>
						<input type="hidden" name="perc-between-oper" value='BETWEEN'>
						<input type="hidden" name="perc-between-value_type" value='PERCENTAGE'>
						
						<label class="col-md-2 control-label">Between</label>
						<div class="col-md-7" style="padding-right: 0px;">
							<div class="input-group">
								<input type="number" class="form-control input-sm" name="perc-between-1" id="perc-between-1">
								<span class="input-group-addon" style="min-width: 10px; padding: 0;"></span>
								<input type="number" class="form-control input-sm" name="perc-between-2" id="perc-between-2">
							</div>
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="perc-between-result" id="perc-between-result">
								<option value="GREEN">Green</option>
								<option value="YELLOW">Yellow</option>
								<option value="RED">Red</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<input type="hidden" name="perc-above-2" value='-'>
						<input type="hidden" name="perc-above-oper_v" value='Above'>
						<input type="hidden" name="perc-above-oper" value='ABOVE'>
						<input type="hidden" name="perc-above-value_type" value='PERCENTAGE'>
						
						<label class="col-md-2 control-label">Above</label>
						<div class="col-md-7" style="padding-right: 0px;">
						<input type="number" class="form-control input-sm" name="perc-above-1" id="perc-above-1" placeholder="">
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="perc-above-result" id="perc-above-result">
								<option value="GREEN">Green</option>
								<option value="YELLOW">Yellow</option>
								<option value="RED">Red</option>
							</select>
						</div>
					</div>
				</div>
				
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<button id="button-treshold-value-add" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Close</button>
	</div>
</div>

<?php if(isset($modifyKri)) { ?>
<script type="text/javascript">
	var g_kri_id = <?=$id?>;
	var g_risk_id = <?=$risk_id?>;
</script>
<?php } ?>



