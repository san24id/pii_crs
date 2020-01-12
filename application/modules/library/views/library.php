<!-- BEGIN CONTENT -->
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
					<a id="bread_tab_title" target="_self" href="javascript:;">Risk List</a>
				</li>
			</ul>
			 <div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/list_risk_pdf");?>">PDF</a>
						</li>
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/list_risk_excel");?>">Excel</a>
						</li>
					 
					</ul>
				</div>
			</div> 
			
			 
			
			
		</div>
<!-- END PAGE HEADER-->
<!-- BEGIN CONTENT-->
		   
 	<!-- Modal -->
		<div class="modal fade" id="modal-changereq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
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
				<button class = "btn btn-success" id = "changereq_list_excel">export to excel</button>
				<button class = "btn btn-success" id = "changereq_list_pdf" >export to pdf</button>
			  </div>
			</div>
		  </div>
		</div>
		

		<div class="tabbable-custom ">
			 
			<div class="tab-content">
				<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_list" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_risk_list-filterBy">
								<option value="risk_event">Risk Event</option>
								<option value="risk_description">Risk Description</option>
								<option value="risk_cause">Risk Cause</option>
								<option value="risk_impact">Risk Impact</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_risk_list-filterValue">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_risk_list-filterButton">Search</button>
				</form>
				 
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_ajax">
						<thead>
						<tr role="row" class="heading">
							 
							<th><center>Risk ID</center></th>
							<th><center>Risk Event</center></th>
							<th><center>Risk Description</center></th>
							<th><center>Cause</center></th> 
							<th><center>Impact</center></th>
							<th><center>Risk Category</center></th>
							<th><center>Risk Sub Category</center></th>
							<th><center>Risk 2nd sub Category</center></th> 
							<th><center>Action</center></th>
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
<div id="modal_listrisk" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Library of Risk</h4>		 
	</div>
	<div class="modal-body">
				<form id="modal-listrisk-form" role="form" class="form-horizontal">
					<div class="form-body">
				
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Risk ID :</label>
							<div class="col-md-9">
							<input class="form-control input-sm input-readview" type="text" placeholder="" name="risk_id" readonly="true">
							</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Risk Event :</label>
							<div class="col-md-9">
							<textarea name="risk_event" class = "form-control"></textarea> 
							</div>
						</div>
						 
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Risk Description :</label>
							<div class="col-md-9">
							<textarea name="risk_description" class = "form-control"></textarea>  
							</div>
						</div>
						
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Cause :</label>
							<div class="col-md-9">
							<textarea name="risk_cause" class = "form-control"></textarea> 
							</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Impact :</label>
							<div class="col-md-9">
							<textarea name="risk_impact" class = "form-control"></textarea> 
							</div>
						</div>
						
						<!--<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Risk category :</label>
							<div class="col-md-9">
							<select name="cat_name"  class="form-control" id = "cat_name"> 
							</select>							 
							</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Risk Sub category :</label>
							<div class="col-md-9">
							<select name="cat_name"  class="form-control" id = "cat_name"> 
							</select>							 
							</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Risk 2nd Sub category :</label>
							<div class="col-md-9">
							<select name="cat_name"  class="form-control" id = "cat_name"> 
							</select>							 
							</div>
						</div>-->
						
						<div class="form-group">
							<label class="col-md-3 control-label smaller cl-compact" >Risk Category<span class="required">* </span></label>
							<div class="col-md-9">
							<select class="form-control input-sm"  id="sel_risk_category" name = "risk_category" > 
							 
							</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label smaller cl-compact" >Risk Sub Category<span class="required">* </span></label>
							<div class="col-md-9">
							<select class="form-control input-sm"  id="sel_risk_sub_category" name = "risk_sub_category">
							 
							</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label small cl-compact" >Risk 2nd Sub Category<span class="required">* </span></label>
							<div class="col-md-9">
							<select class="form-control input-sm" name="cat_name" id="sel_risk_2nd_sub_category">
							 
							</select>
							</div>
						</div>
					
						 
					</div>
				</form>			
		<br>			
	</div>
	<div class="modal-footer">
		<button id="library-modal-listrisk-update" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
		<button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
	</div>
</div>

<!-- LIBRARY -->
<div id="modal_listrisk_info" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Properties</h4>		 
	</div>
	<div class="modal-body">
				<?php
				
				echo $_POST['risk_code'];
				?>
		<br>			
	</div>
	<div class="modal-footer">
		<button id="library-modal-listrisk-update" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
		<button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
	</div>
</div>


