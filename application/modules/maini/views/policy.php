<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Kebijakan
		</h3>
		<!-- END PAGE HEADER-->
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/maini">Beranda</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Kebijakan</a>
				</li>
			</ul>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<ul class="list-group">
					<?php foreach($news as $row) { ?>
					<li class="list-group-item"><font style="font-size:19px;"><a target="_self" href="<?=$site_url?>/maini/policy/view/<?=$row['id']?>"><?=$row['title']?></a></font> <br> <font style="color:gray; font-size:11px;"> --- Diterbitkan pada <?=$row['date_publish_v']?> </font></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>