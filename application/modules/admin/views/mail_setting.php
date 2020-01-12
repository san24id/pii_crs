<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Mail Setting
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Setting</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Mail Setting</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-12">
			<?php if($update_success) { ?>
			<div class="alert alert-success">
				<strong>Success!</strong> Mail Data Updated.
			</div>
			<?php } ?>
			<div class="form">
				<form target="_self" action="<?=$site_url?>/admin/reminder/updateMail" method="post" id="input-form" role="form" class="form-horizontal">
					<div class="form-body">

						<div class="form-group">
									<label class="col-md-3 control-label">Host</label>
									<div class="col-md-5">
										<input type="text" class="form-control" name="host" value="<?php echo $mail['host']; ?>">
									</div>
						</div>

						<div class="form-group">
									<label class="col-md-3 control-label">Port</label>
									<div class="col-md-5">
										<input type="text" class="form-control" name="port" value="<?php echo $mail['port']; ?>">
									</div>
						</div>

						<div class="form-group">
									<label class="col-md-3 control-label">Username</label>
									<div class="col-md-5">
										<input type="text" class="form-control" name="user" value="<?php echo $mail['user']; ?>">
									</div>
						</div>

						<div class="form-group">
									<label class="col-md-3 control-label">Password</label>
									<div class="col-md-5">
										<input type="password" class="form-control" name="pass" value="<?php echo $mail['pass']; ?>">
									</div>
						</div>

					
						<div class="form-actions right">
							<button id="input-form-submit-button" type="submit" 
								class="btn blue ladda-button"
								 data-style="expand-right"
								>Save</button>
								<a href='index.php/main/mainrac'><button type="button" class="btn yellow" id="kri-button-cancel"><i class="fa fa-times"></i> Cancel</button></a>
						</div>
					</div>
				</form>
			</div>
		</div>	
		</div>
	</div>
</div>