<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Regular Period for Risk Register Exercise
		</h3>
		<!-- END PAGE HEADER-->
		
		<div class="row">
		<div class="col-md-12">
			<div class="portlet">
			<div class="portlet-title">
				<div class="actions">
					<a href="javascript: Periode.showInputForm()" class="btn default green-stripe">
					<i class="fa fa-plus font-green"></i>
					<span class="hidden-480">
					New Record </span>
					</a>
				</div>
			</div>

			<?php 
				$path = base_url('assets/images/2.png');
			?>
			
			<form class="form-inline" role="form" id="filterForm">
				<div class="form-group">
					<label for="filterFormBy">Filter By</label>
					<select class="form-control input-medium input-sm" id="filterFormBy">
						<option value="periode_name">Periode</option>
						<option value="periode_start">Periode Start</option>
						<option value="periode_end">Periode End</option>
						
					</select>
				</div>
				<div class="form-group">
					<input type="text" class="form-control input-sm" id="filterFormValue" placeholder="Insert Filter Value">
				</div>
				<button type="submit" id="filterFormSubmit" class="btn green btn-sm">Search</button>
			</form>	
			</div>
			
			<div class="portlet-body">
				<div class="table-container">
					<div class="table-actions-wrapper">
					</div>
					<table class="table table-striped table-bordered " id="datatable_ajax">
					<thead>
					<tr role="row" class="heading">
						<th width="5%">
							 No
						</th>
						<th width="25%">Periode</th>
						<th width="20%">Periode Start</th>
						<th width="20%">Periode End</th>
						<th width="10%">
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
			
			<!-- FORM MODAL -->
		<div id="form-data" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Add Periode</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="input-form" class="form-horizontal" role="form">
						<input type="hidden" name="periode_id" value="">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Periode</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="pm" placeholder="Periode Name" name="periode_name">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Date</label>
								<div class="col-md-4">
									<div class="input-group input-large date-picker input-daterange" data-date="<?=date('d-m-Y')?>" data-date-format="dd-mm-yyyy">
										<input type="text" class="form-control" name="periode_start">
										<span class="input-group-addon">
										s/d </span>
										<input type="text" class="form-control" name="periode_end">
									</div>
									<!-- /input-group -->
									<span class="help-block">
									Select date range </span>
								</div>
							</div>
						</div>
					</form>
					<br /><br />
			 		<span style="color:#035CFF;"><p align="left" style="padding-left: 20px;"><i>Note : <br/>This period only affect to open the process from entry regular risk until verify action plan process and keep the risk on dashboard until the next period will be created.
Please go to the other setting period if you wanna open other process 
</i></p></span>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
				<button id="input-form-submit-button" type="button" 
					class="btn blue ladda-button"
					 data-style="expand-right"
					>Submit</button>
			</div>
		</div>

					<!-- FORM MODAL -->
	<div id="form-data2" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Add Periode</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="input-form2" class="form-horizontal" role="form">
						<input type="hidden" name="periode_id" value="">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Periode</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="pm" placeholder="Periode Name" name="periode_name">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Date</label>
								<div class="col-md-3">
								<div class="input-group date-picker input-daterange" data-date="<?=date('d-m-Y')?>" data-date-format="dd-mm-yyyy">
										<input type="text" class="form-control" name="periode_start"><span class="input-group-addon" id="basic-addon1">s/d</span>
								</div>
								Select date range </span>
								</div>
								<div class="col-md-3">	
									<div class="date-picker input-daterange" data-date="<?=date('d-m-Y')?>" data-date-format="dd-mm-yyyy">
										<input type="text" class="form-control" name="periode_end">
									</div>
									<!-- /input-group -->
									<span class="help-block">
									
								</div>
							</div>
						</div>

					</form>
					<br /><br />
			 		<span style="color:#035CFF;"><p align="left" style="padding-left: 20px;"><i>Note : <br/>This period only affect to open the process from entry regular risk until verify action plan process and keep the risk on dashboard until the next period will be created.
Please go to the other setting period if you wanna open other process 
</i></p></span>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
				<button id="input-form-submit-button_edit" type="button" 
					class="btn blue ladda-button"
					 data-style="expand-right"
					>Submit</button>
			</div>
		</div>

		<div id="form-information" class="modal fade" tabindex="-1" data-width="860" data-backdrop="static" data-keyboard="false">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Information</h4>
			</div>
			<div class="modal-dialog" style="width: 800px;">

						<?php echo $msg; ?>
						
			<div class="row">
					<div class="col-md-6">
						<h4>Legend</h4>
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/default.png"/> &nbsp; 
								 To-do task
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Complete task
							</li>
						</ul>
		
					</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
			</div>
		</div>

	</div>
</div>

<div id="first-newperiode" class="modal fade" tabindex="-1" data-width="720" data-backdrop="static" data-keyboard="false">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Information</h4>
			</div>
					<div class="col-md-12">
						<ul class="list-group">
							<li class="list-group-item">
								1. &nbsp; Set the Reminder Setting
							</li>
							<li class="list-group-item">
								2. &nbsp; Entry Regular Period for Action Plan (optional)
							</li>
							<li class="list-group-item">
								3. &nbsp; Entry Regular Period for KRI (optional)
							</li>
						</ul>
						For more information on Reminder Setting please refer to User Manual 
		
					</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
			</div>
		</div>

	</div>
</div>

<script>
var x = screen.width/2 - 950/2;
var y = screen.height/2 - 700/2;
function myFunction() {
    window.open("index.php/main/usermanual/manual_pupnewperiode","name","location=no,menubar=no,scrollbars=yes,resizable=no,fullscreen=no,height=550,width=1024,left="+x+",top="+y);
}
</script>