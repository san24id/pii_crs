<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Report
		</h3>
		<!-- END PAGE HEADER-->
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Report</a>
				</li>
			</ul>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<ul class="list-group">
					<?php foreach($report as $row) { ?>
					<li class="list-group-item"><font style="font-size:20px;"><a target="_self" href="<?=$site_url?>/main/upload/view/<?=$row['id']?>"><?=$row['title']?><br><img src="assets/images/pdf.png" width="80" height="80"/></a></font> <br> <font style="color:gray; font-size:11px;"> Publish On <?=$row['date_publish_v']?> </font></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>