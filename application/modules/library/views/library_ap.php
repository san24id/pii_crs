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
					<a id="bread_tab_title" target="_self" href="javascript:;">List of Action Plan</a>
				</li>
			</ul>
			  <div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/list_ap_pdf");?>">PDF</a>
						</li>
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/list_ap_excel");?>">Excel</a>
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
				    <button id="button-add" class="btn green btn-sm" type="button" style="margin-bottom: 10px;display: none;"  >Add Action Plan</button>
					<div ><!--class="table-scrollable"-->
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_action_list" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_action_list-filterBy">
								<option value="action_plan">Action Plan</option>
								<option value="division">Divisi</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-action">
							<select class="form-control input-sm" id="l_divisi-action">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_action_list-filterValue">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_action_list-filterButton">Search</button>
					</form>
						<table class="table table-condensed table-bordered table-hover " id="datatableap_ajax" cellspacing="0">
						<thead>
						<tr role="row" class="heading">
							 
							<th rowspan="2"><center>AP ID</center></th>
							<th rowspan="2"><center>Action Plan</center></th>
							<th rowspan="2"><center>Due Date</center></th>
							<th rowspan="2"><center>Action Plan Owner</center></th>
							<th colspan="2"><center>Risk</center></th>
							<th rowspan="2"><center>Action</center></th>
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
<div id="modal_listrisk" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Library of Action Plan</h4>		 
	</div>
	<div class="modal-body">
				<form id="modal-listrisk-form" role="form" class="form-horizontal">
					<div class="form-body">
				
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">AP.ID :</label>
							<div class="col-md-9">
								<div class="input-group">
									<input class="form-control input-sm" readonly="true" type="text" placeholder="" name="id" id = "id">
									<input class="form-control input-sm" readonly="true" type="hidden" placeholder="" name="ap_code" id = "ap_code">
									<span class="input-group-btn">
										<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-libraryaction"><i class="fa fa-search fa-fw"/></i></button>
									</span> 
								</div>
							</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Action Plan :</label>
							<div class="col-md-9">
							<textarea class="form-control" name ="action_plan" id ="action_plan"></textarea>  
							<textarea style="display: none;" class="form-control" name = "action_plan_ex" id = "action_plan_ex"></textarea>
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

<!-- LIBRARY ACTION-->
<div id="modal-libraryaction" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Suggested Action Plan Library</h4>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_search" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modal-libraryaction-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="library_tableaction" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="66px">&nbsp;</th>
					<th>AP.ID</th>
					<th>Action Plan</th>
					<th>Due Date</th>
					<th>Division</th> 
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>