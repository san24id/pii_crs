<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Manage News
		</h3>
		<!-- END PAGE HEADER-->
		
		<div class="row">
		<div class="col-md-12">
			<div class="portlet">
			<div class="portlet-title">
				<div class="actions">
					<a href="javascript: location.href='<?=$site_url?>/admin/report/reportInput'" class="btn default green-stripe">
					<i class="fa fa-plus font-green"></i>
					<span class="hidden-480">
					New Record </span>
					</a>
				</div>
			</div>
			
			<form class="form-inline" role="form" id="filterForm">
				<div class="form-group">
					<label for="filterFormBy">Filter By</label>
					<select class="form-control input-medium input-sm" id="filterFormBy">
						<option value="title">News Title</option>
						<option value="filename">File Name</option>
						<option value="a.created_date">Created Date</option>
						<option value="a.created_by">Created By</option>
						<option value="a.date_publish">Publish Date</option>
						<option value="a.status">Status</option>
						
					</select>
				</div>
				<div class="form-group" id="sts">
						<select class="hesh form-control input-sm" id="inputsts">
							<option value="">ALL</option>	
							<option value="1">Published</option>	
							<option value="0">Unpublished</option>
						</select>
				</div>
				<div class="form-group">
					<input type="text" class="form-control input-sm" id="filterFormValue" placeholder="Search">
				</div>
				<button type="submit"  class="btn green btn-sm" id="filterFormSubmit">Search</button>
			</form>	
			</div>
			
			<div class="portlet-body">
				<?php if(isset($upload_success)) { ?>
				<div class="alert alert-success">
					<strong>Success!</strong> Success Insert and Upload News.
				</div>
				<?php } ?>
				
				<div class="table-container">
					<div class="table-actions-wrapper">
					</div>
					<table class="table table-striped table-bordered" id="datatable_ajax">
					<thead>
					<tr role="row" class="heading">
						<th width="5%">
							 No
						</th>
						<th width="25%">News Title</th>
						<th width="25%">File Name</th>
						<th width="10%">Created Date</th>
						<th width="15%">Created By</th>
						<th width="10%">Publish Date</th>
						<th>Status</th>
						<th width="7%">
							 Action
						</th>
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