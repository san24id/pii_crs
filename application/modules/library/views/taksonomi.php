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
					<a id="bread_tab_title" target="_self" href="javascript:;">Taxonomy 2nd Sub Category</a>
				</li>
			</ul>
			
			 <div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/taksonomi_pdf");?>">PDF</a>
						</li>
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/taksonomi_excel");?>">Excel</a>
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
				    
					<div ><!--class="table-scrollable"-->
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_taksonomi_list">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_taksonomi_list-filterBy">
								<option value="cat_name">Name</option>
								<option value="cat_desc">Description</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_taksonomi_list-filterValue">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_taksonomi_list-filterButton">Search</button>
					</form>
						<table class="table table-condensed table-bordered table-hover " id="datatabletax_ajax">
						<thead>
						<tr role="row" class="heading">
							<th><center>ID</center></th>
							<th><center>Name</center></th> 
							<th><center>Description</center></th> 
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
		<h4 class="modal-title">Library of Risk Taxonomy</h4>		 
	</div>
	<div class="modal-body">
				<form id="modal-listrisk-form" role="form" class="form-horizontal">
					<div class="form-body">
				
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact"> ID  :</label>
							<div class="col-md-9">
							<input class="form-control input-sm input-readview" type="text" placeholder="" name="cat_code" id = "cat_code" readonly="true"  >
							</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Name  :</label>
							<div class="col-md-9">
							<input type = "text" name = "cat_name" id = "cat_name" class = "form-control">  
							</div>
						</div>
						
						<div class="form-group">
								<label class="col-md-3 control-label">Description :</label>
							 
									<div class="col-md-9">
										<textarea class="form-control" name="cat_desc" id = "cat_desc"></textarea>										 
									</div> 
							 
						</div>
						 
						 
					</div>
				</form>			
		<br>			
	</div>
	<div class="modal-footer">
		<button id="library-modal-listrisktax-update" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
		<button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
	</div>
</div>