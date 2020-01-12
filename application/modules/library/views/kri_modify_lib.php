<script src="assets/toogle/js/jquery-3.1.1.min"></script>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		KRI Edit Library
		</h3>

		<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-12">
			<form id="input-form" role="form" class="form-horizontal">
				<div class="form-body">
					<div class="form-group">
						<input type="hidden" name="risk_id" value="<?=$risk_id?>"/>
						<label class="col-md-2 control-label">Risk ID</label>
						<div class="col-md-6">
							<div class="input-group">
								<input type="text" class="form-control input-sm" readonly="true" name="risk_library_code" placeholder="">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-library"><i class="fa fa-search fa-fw"/></i></button>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Risk Event</label>
						<div class="col-md-6">
						<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_event" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" >Risk Level</label>
						<div class="col-md-6">
						<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_level" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" >Risk Treatment</label>
						<div class="col-md-6">
							<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_treatment" placeholder="">
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
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</form>
			<hr/>
			<div class="form">
			<form id="kri-form" role="form" class="form-horizontal">
			<input type="hidden" name="id" id="id" value="<?=$id?>"/>
			<input type="hidden" name="risk_id" id="kri-risk-id" value=""/>
			<div class="form-body">
				<div class="form-group">
					<input type="hidden" name="kri_library_id" value=""/>
					<label class="col-md-2 control-label">KRI ID</label>
					<div class="col-md-6">
						<div class="input-group">
							<input type="text" class="form-control input-sm" readonly="true" name="kri_library_code" placeholder="">
							<span class="input-group-btn">
							<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-kri"><i class="fa fa-search fa-fw"/></i></button>
							</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Mandatory/Non Mandatory?</label>
					<div class="col-md-6">
					<span class="man"><input checked data-toggle="toggle" type="checkbox" data-size="small" data-onstyle="danger" data-width="140" data-on = "Mandatory" data-off = "Non Mandatory" id="cek-mitigation"></span>
					<span class="man2"><input data-toggle="toggle" type="checkbox" data-size="small" data-onstyle="danger" data-width="140" data-on = "Mandatory" data-off = "Non Mandatory" id="cek-mitigation2"></span>
					<input type="hidden" class="form-control input-sm" id="mandatory" name="mandatory" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Key Risk Indicator</label>
					<div class="col-md-6">
					<textarea class="form-control input-sm popovers"  data-container="body" data-placement="bottom" rows="3" name="key_risk_indicator" required="required" placeholder=""></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">KRI Owner</label>
					<div class="col-md-4">
					<select class="form-control input-sm" name="kri_owner" required="required">
						<option value="" style="color: #cccccc;">Choose One</option>
						<?php foreach($division_list as $row) { ?>
						<option value="<?=$row['ref_key']?>"><?=$row['ref_value']?></option>
						<?php } ?>
					</select>
					</div>
				</div>
				<div class="form-group">	
					<label class="col-md-2 control-label">Threshold</label>
					<div class="col-md-6">
					<select class="form-control input-sm" id="select-treshold-type-1" name="treshold_type" required="required">
						<option value="" style="color: #cccccc;">Choose One</option>
						<option value="SELECTION">Text</option>
						<option value="VALUE">Value</option>
					</select>

					<select class="form-control input-sm" id="select-treshold-type" name="treshold_type" required="required">
						<option value="" style="color: #cccccc;">Choose One</option>
						<option value="SELECTION">Text</option>
						<option value="VALUE">Value</option>
					</select>

					<select class="form-control input-sm" id="select-treshold-type2" name="treshold_type" required="required">
						<option value="" style="color: #cccccc;">Choose One</option>
						<option value="SELECTION">Text</option>
						<option value="VALUE">Value</option>
					</select>
					</div>
				</div>

				<div class="form-group"  id="treshold_description">
				<label class="col-md-2"></label>
					<div class="col-md-8">
						<button class="btn green btn-sm" style="margin-bottom: 10px;" type="button" id="button-kri-open-treshold"><span class="glyphicon glyphicon-cog"></span>&nbsp;Edit</button>
						<button class="btn green btn-sm" style="margin-bottom: 10px;" type="button" id="button-kri-open-treshold2"><span class="glyphicon glyphicon-cog"></span>&nbsp;Edit</button>
						<table id="treshold_table" class="table table-condensed table-bordered table-hover">
							<thead id="tselect">
							<tr role="row" class="heading">
								<th>Value</th>
								<th>Warning</th>
							</tr>
							</thead>
							<thead id="tvalue">
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
					<label class="col-md-2 control-label">Timing Report</label>
					<div class="col-md-8">
					<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy">
						<input type="text" class="form-control input-sm" id="timing" name="timing_pelaporan" required="required" readonly>
						<span class="input-group-btn">
						<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
						</span>
					</div>
					</div>
				</div>
							<br/>
					<div class="form-group">
					<div class="col-md-9">
					<table>
					<tr><td>- Mandatory: KRI will show up in the KRI owner dashboard</td></tr>
					<tr><td>- Non Mandatory: KRI won't show up in the KRI owner dashboard, and remain on RAC's dashboard</td></tr></table>
					</div>
					</div>
			</div>
			<div class="form-actions right">
				<button id="kri-button-save-modif" type="button" class="btn blue"><i class="fa fa-circle-o"></i> Save</button>
				<button id="kri-button-delete" type="button" class="btn red"><i class="fa fa-times"></i>Delete</button>
				<button type="button" class="btn yellow" id="kri-button-cancel"><i class="fa fa-times"></i> Cancel</button>
			</div>
			</form>
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
					<textarea class="form-control input-sm popovers"  data-container="body" data-placement="bottom" rows="3" name="value-equal-1" id="value-equal-1" placeholder=""></textarea>
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
					<textarea class="form-control input-sm popovers"  data-container="body" data-placement="bottom" rows="3" name="value-equal-2" id="value-equal-2" placeholder=""></textarea>
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
					<textarea class="form-control input-sm popovers"  data-container="body" data-placement="bottom" rows="3" name="value-equal-3" id="value-equal-3" placeholder=""></textarea>
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
