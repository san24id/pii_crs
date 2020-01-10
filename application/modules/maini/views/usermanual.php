<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Panduan Pengguna
		</h3>
		<!-- END PAGE HEADER-->
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Beranda</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Panduan Pengguna</a>
				</li>
			</ul>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<ul class="list-group">
					<?php foreach($news as $row) { ?>
					<li class="list-group-item"><a target="_self" href="<?=$site_url?>/main/usermanual/view/<?=$row['id']?>"><?=$row['title']?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>