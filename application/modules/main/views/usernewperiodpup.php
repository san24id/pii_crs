<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		&nbsp;&nbsp;First Manual New Period
		</h3>
		<!-- END PAGE HEADER-->
		
		<div class="row">
			<div class="col-md-12">
				<ul class="list-group">
					<?php foreach($news as $row) { ?>
					<li class="list-group-item"><a target="_self" href="<?=$site_url?>/main/usermanual/viewmanual_pupnewperiod/<?=$row['id']?>"><?=$row['title']?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>