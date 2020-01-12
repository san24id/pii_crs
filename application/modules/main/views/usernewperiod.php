<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		First Manual New Period
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
					<a target="_self" href="<?=$site_url?>/main/usermanual/manual_newperiode">User Manual</a>
				</li>
								<li>
					<a target="_self" href="javascript:;">First Manual New Period</a>
				</li>
			</ul>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				Open popup :
				<ul class="list-group">
					<li class="list-group-item"><button onclick="myFunction()">First Manual New Period</button></li></li>
				</ul>
			</div>
			<div class="col-md-12">
				<ul class="list-group">
					<?php foreach($news as $row) { ?>
					<li class="list-group-item"><a target="_self" href="<?=$site_url?>/main/usermanual/viewmanual_newperiod/<?=$row['id']?>"><?=$row['title']?></a></li>
					<?php } ?>
				</ul>
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