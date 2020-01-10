<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Edit Report
		</h3>
		<!-- END PAGE HEADER-->
		
		<div class="row">
		<div class="col-md-12">
			<div class="portlet">
			<div class="portlet-title">
				<div class="actions">
					<a href="javascript: location.href='<?=$site_url?>/admin/report'" class="btn default green-stripe">
					<i class="fa fa-plus font-green"></i>
					<span class="hidden-480">
					Back To report List </span>
					</a>
				</div>
			</div>
			
			<div class="portlet-body form">
				<?php if(isset($error)) { ?>
				<div class="alert alert-danger">
					<strong>Error!</strong><br/> <?=$error?>
				</div>
				<?php } ?>
				<form target="_self" action="<?=$site_url?>/admin/report/reportEditData" enctype="multipart/form-data" method="post" id="input-form" role="form" class="form-horizontal">
					<input type="hidden" name="id" value="<?=$report['id']?>">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">report Title</label>
							<div class="col-md-6">
								<input type="text" class="form-control" placeholder="report Title" name="title" id="report-title" value="<?=$report['title']?>">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Uploaded Filename</label>
							<div class="col-md-6">
								<input type="text" class="form-control" readonly value="<?=$report['filename']?>">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Update Upload report Content</label>
							<div class="col-md-6">
								<input type="file" class="form-control" placeholder="Filename" name="filename" id="report-file">
								<span class="help-block">Don't fill this field if you dont want to update the report file</span>
							</div>
							
							
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Status</label>
							<div class="col-md-6">
								<select class="form-control input-sm" name="status">
									<option value="1" <?=$report['status'] == 1 ? 'SELECTED': ''?>>Published</option>
									<option value="0" <?=$report['status'] == 0 ? 'SELECTED': ''?>>Unpublished</option>
								</select>
							</div>
						</div>
						<div class="form-actions right">
							<button id="input-form-submit-button" type="button" 
								class="btn blue ladda-button"
								 data-style="expand-right"
								>Submit</button>
						</div>
					</div>
				</form>
			</div>
			</div>
		</div>
		
	</div>
</div>