<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Submission Confirmation For Action Plan Execution Periode : <?=$periode_name?> &rarr;  <?=$subject?> &nbsp;  <font size="-1"><?=$create_date?></font>
		

		<script type="text/javascript">
			var g_id = <?=$id?>;
		</script>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main/mainrac">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">Other</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">User Monitoring</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">Submission Confirmation For Action Plan Execution</a>
				</li>
			</ul>
			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown"  data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a href="<?=$site_url?>/library/submission_actionplanexe_pdf/<?=$id?>" id="">PDF</a>
						</li>
						<li>
							<a href="<?=$site_url?>/library/submission_actionplanexe_excel/<?=$id?>" id="">Excel</a>
						</li>					 
					</ul>
				</div>
			</div>
		</div>
<!-- END PAGE HEADER-->
<!-- BEGIN CONTENT-->
		   
 	<!-- Modal -->
		
		

		<div class="tabbable-custom ">
			 
			<div class="tab-content">
				<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_apex" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_apex-filterBy">
								<option value="choose">Choose / Show All</option>
								<option value="status_date">Status Date</option>
								<option value="display_name">Name</option>
								<option value="division_name">Divisi</option>
							</select>
						</div>

						<div class="form-group" id="choose_status_date_apx">
							<select class="bish form-control input-medium input-sm" id="s_date_apx">
								<option value="">All</option>
								<option value="draft" data-StatusDate= "Not confirmed yet">Not confirmed yet</option>
								<option value="past" data-StatusDate = "Exceed due date">Exceed due date</option>
								<option value="before" data-StatusDate = "On due date">On due date</option>
							</select>
						</div>

						<div class="form-group" id="choose_l_divisi_apx">
						<select class="besh form-control input-sm" id="l_divisi_apx">
							<option value="">All</option>
							<?php foreach ($division_list as $key) {?>
								<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
							<?php }?>
						</select>
					   </div>
						<div class="form-group" id="ne">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_apex-filterValue">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_apex-filterButton">Search</button>
				</form>
				 
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_ajax_vapex">
						<thead>
						<tr role="row" class="heading">
							<th><center>Status</center></th>
							<th><center>User</center></th>
							<th><center>Name</center></th>
							<th><center>Divisi</center></th>
							<th><center>Submission Date</center></th>
							<th width="25%"><center>Note</center></th>
							<th><center>Action</center></th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
					</div>
					<hr/>
					<div class="row">
					 <div class="col-md-6">
						<h4>Legend</h4>
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/default.png"/> &nbsp; 
								 Not confirmed yet
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/treatment.png"/> &nbsp; 
								 Exceed due date
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed_2.png"/> &nbsp; 
								 On due date
							</li>
						</ul>
		
					</div>
					</div>
				</div>
				  
			</div>
			
		</div>
		<!-- END CONTENT-->
	</div>
</div>

		<div id="modal-submit-apex" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Edit Note</h4>
			</div>
			<div class="modal-body">
				<form id="noteform" role="form" class="form-horizontal" action ="<?=base_url('index.php/main/mainrac/submit_risk_apex');?>" method="POST">			 
					<textarea name = "note" id = "modal_pic_note" class="form-control"></textarea>
					<input type = "hidden" id = "modal_pic_risk_input_by" name = "risk_input_by">
					<input type = "hidden" id = "modal_pic_risk_periode" name = "periode_id">
					<input type = "hidden" id = "modal_pic_risk_type" name = "type">
					<input type = "hidden" id = "modal_pic_risk_id_apex" name = "id_apex">
					<button type="button" class="btn blue btn-sm" onclick = "submit_risk_apex()">Save</button>			 
				</form> 
			</div>
		</div>