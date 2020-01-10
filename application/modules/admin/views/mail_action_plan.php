<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Mail Action Plan related to the risk of other division that need your support
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
					<a target="_self" href="javascript:;">Reminder for you to confirm action plan related to the risk of other division that need your support</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->

<script type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
        selector: "textarea",
         elementpath: false,
        plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
        ],

        toolbar1: "bold italic underline | fontsizeselect | forecolor",
        toolbar2: "",
        
        menubar: false,
        toolbar_items_size: 'small',

        style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],

        templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
        ]
});</script>

		
		<div class="row">
		<div class="col-md-12">
			<div class="form">
				<form  action="<?=$site_url?>/admin/reminder/send_mail_risk" method="post" id="input-form" role="form" class="form-horizontal">
					<div class="form-body">

						<div class="form-group">
									<label class="col-md-2 control-label">Subject</label>
									<div class="col-md-6">
									<input type="text" name="subject" class="form-control" value="<?=$mail['mail_subject'];?>">
									</div>
						</div>
						<div class="form-group">
						<label class="col-md-2 control-label" title="fill this field with the target completion date of risk treatment plan.">Due Date</label>
						<div class="col-md-9">
						<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d" id="fdate">
							<input type="text" class="form-control input-sm" name="due_date" id = "due_date" placeholder="select date" readonly value="<?=$mail['due_date_v'];?>">
							<span class="input-group-btn">
							<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
							</span>
						</div>
						</div>
						</div>
						<div class="form-group">
									<label class="col-md-2 control-label">Message Text</label>
									<div class="col-md-9">
									<textarea class="" rows="10" name="message" placeholder="Message Text" id="Message-text"> <?=$mail['message']?> </textarea>
									</div>
						</div>

						<div class="form-group">
						<label class="col-md-2 control-label" title="fill this field with the target completion date of risk treatment plan.">Reminder 1</label>
						<div class="col-md-9">
						<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d" id="fdate">
							<input type="text" class="form-control input-sm" name="r1due_date" id = "r1due_date" placeholder="select date" readonly value="<?=$mail['f1due_date'];?>" >
							<span class="input-group-btn">
							<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
							</span>
						</div>
						</div>
						</div>
						<div class="form-group">
						<label class="col-md-2 control-label" title="fill this field with the target completion date of risk treatment plan.">Reminder 2</label>
						<div class="col-md-9">
						<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d" id="fdate">
							<input type="text" class="form-control input-sm" name="r2due_date" id = "r2due_date" placeholder="select date" readonly value="<?=$mail['f2due_date'];?>">
							<span class="input-group-btn">
							<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
							</span>
						</div>
						</div>
						</div>
						<div class="form-group">
						<label class="col-md-2 control-label" title="fill this field with the target completion date of risk treatment plan.">Reminder 3</label>
						<div class="col-md-9">
						<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d" id="fdate">
							<input type="text" class="form-control input-sm" name="r3due_date" id = "r3due_date" placeholder="select date" readonly value="<?=$mail['f3due_date'];?>">
							<span class="input-group-btn">
							<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
							</span>
						</div>
						</div>
						</div>
						<div class="form-actions right">
								<button id="input-form-send-register"  name="send_action_plan" class="btn green ladda-button" data-style="expand-right">Save & Send Mail</button>
								<button id="input-form-save-register"  name="save_action_plan" class="btn blue ladda-button" data-style="expand-right">Save</button>
								<button type="button" class="btn yellow" id="button-cancel-send"><i class="fa fa-times"></i> Cancel</button></a>
						</div>
					</div>
				</form>
			</div>
		</div>	
		</div>
	</div>
</div>