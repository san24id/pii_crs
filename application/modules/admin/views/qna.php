<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Q &amp; A Management
		</h3>
		<!-- END PAGE HEADER-->
		
		<div class="row">
		<div class="col-md-12">
			<div class="portlet">
			<form class="form-inline" role="form" id="filterForm">
				<div class="form-group">
					<label for="filterFormBy">Filter By</label>
					<select class="form-control input-medium input-sm" id="filterFormBy">
						<option value="a.subject">Subject</option>
						<option value="b.display_name">Submitted By</option>
						<option value="a.created_date">Date</option>
						<option value="a.status">Status Answer</option>
					</select>
				</div>

				<div class="form-group" id="sts">
						<select class="hesh form-control input-sm" id="inputsts">
							<option value="">ALL</option>	
							<option value="1">Completed</option>	
							<option value="0">Waiting For Response</option>
						</select>
				</div>

				<div class="form-group">
					<input type="text" class="form-control input-sm" id="filterFormValue" placeholder="Insert Filter Value">
				</div>
				<button type="button" id="filterFormSubmit" class="btn green btn-sm">Search</button>
			</form>	
			</div>
			
			<div class="portlet-body">
				<div class="table-container">
					<table class="table table-condensed table-bordered table-hover" id="datatable_ajax">
						<thead>
						<tr role="row" class="heading">
							<th>No</th>
							<th>Submitted By</th>
							<th>Date</th>
							<th>Subject</th>
							<th>Answer</th>
							<th>Status Answer</th>
							<th>Delete</th>
						</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>

<!-- FORM MODAL -->
<div id="form-data" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Answer Question</h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<form id="input-form" class="form-horizontal" role="form">
				<input type="hidden" name="id" value="">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-2 control-label">Subject</label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Subject" name="subject">
						</div>
						<label class="col-md-1 control-label">Date</label>
						<div class="col-md-2">
							<input type="text" readonly class="form-control" placeholder="Date" name="var_date">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Question</label>
						<div class="col-md-9">
							<textarea  class="form-control" rows="4" name="question"></textarea>
						</div>
					</div>
					<div class="form-group fg-answer">
						<label class="col-md-2 control-label">Answer</label>
						<div class="col-md-9">
							<textarea class="form-control" rows="4" name="answer"></textarea>
						</div>
					</div>
				</div>
			</form>
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