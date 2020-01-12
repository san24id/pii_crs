<!-- BEGIN CONTENT -->
<style>
hr { 
    margin-top: 0.5em;
    margin-bottom: 0.5em;
} 
</style>
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Dashboard <small>reports &amp; statistics</small>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main/mainrac">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">Library Management</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">Risk</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">List of Existing Control</a>
				</li>
			</ul>
			
			 <div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/list_ec_pdf");?>">PDF</a>
						</li>
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/list_ec_excel");?>">Excel</a>
						</li>
					 
					</ul>
				</div>
			</div>
			 
			
		</div>
<!-- END PAGE HEADER-->
<!-- BEGIN CONTENT-->
		    
		<div class="tabbable-custom ">
			 
			<div class="tab-content">
				<div class="tab-pane active" id="tab_risk_list">
				    <button id="button-add-ec" class="btn green btn-sm" type="button" style="margin-bottom: 10px;display: none;"  >Add Existing Control</button>
					<div ><!--class="table-scrollable"-->
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_control_list" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_control_list-filterBy">
								<option value="risk_existing_control">Existing Control</option>
								<option value="risk_evaluation_control">Evaluation Control</option>
								<option value="risk_control_owner">Control Owner</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-control">
							<select class="form-control input-sm" id="l_divisi-control">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_control_list-filterValue">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_control_list-filterButton">Search</button>
					</form>
						<table class="table table-condensed table-bordered table-hover " id="datatableec_ajax">
						<thead>
						<tr role="row" class="heading">
							 
							<th rowspan="2">Existing Control ID</th>
							<th rowspan="2">Existing Control</th>
							<th rowspan="2">Evaluation Control</th>
							<th rowspan="2">Control Owner</th>
							<th colspan="2"><center>Risk</center></th>  
							<th rowspan="2"> Action</th>
						</tr>
						<tr role="row" class="heading">
							<th><center>Risk ID</center></th>
							<th width="10%"><center>Periode</center></th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
					</div>
					<hr/>
					<div class="row">
					 
					</div>
				</div>
				  
			</div>
			
		</div>
		<!-- END CONTENT-->
	</div>
</div>


<!-- LIBRARY -->
<div id="modal_listrisk" class="modal fade" tabindex="-1" data-width="860"  data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Library Of Existing Control</h4>		 
	</div>
	<div class="modal-body">
				<form id="modal-listrisk-form" role="form" class="form-horizontal">
					<div class="form-body">
				
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact">EC.ID</label>
						<div class="col-md-9">
							<div class="input-group">
								<input class="form-control input-sm" readonly="true" type="text" placeholder="" name="id" id = "id">
								<input class="form-control input-sm" readonly="true" type="hidden" placeholder="" name="idex" id = "idex">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-control"><i class="fa fa-search fa-fw"/></i></button>
								</span>
								
							</div>
						</div>
					</div>
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Existing Control   :</label>
							<div class="col-md-9">
								<textarea class="form-control" name="risk_existing_control" id = "risk_existing_control"></textarea>
								<textarea style="display: none" class="form-control" name = "risk_existing_control_ex" id = "risk_existing_control_ex"></textarea>
							</div>
						</div>
						
						<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact">Evaluation Control :</label>
							 
									<div class="col-md-9">
										<select name = "risk_evaluation_control" id = "risk_evaluation_control" class = "form-control">
										</select> 
										<input type="hidden" name = "risk_evaluation_control_ex" id = "risk_evaluation_control_ex" class = "form-control" />									 
									</div> 
							 
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Control Owner :</label>
							<div class="col-md-9">
							<select name="risk_control_owner"  class="form-control" id = "risk_control_owner"> 
							</select>
							<input type="hidden" name = "risk_control_owner_ex" id = "risk_control_owner_ex" class = "form-control" />
							</div>
						</div>
					
						 
					</div>
				</form>			
		<br>			
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
		<button id="library-modal-listriskec-update" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>

<!-- CONTROL -->
<div id="modal-control" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Existing Control</h4>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_search" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modal-control-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="library_control_table" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="66px">&nbsp;</th>
					<th>EC.ID</th>
					<th>Existing Control</th>
					<th>Evaluation on Existing Control</th>
					<th>Control Owner</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>


