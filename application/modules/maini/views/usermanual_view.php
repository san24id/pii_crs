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
					<a target="_self" href="<?=$site_url?>/main/usermanual">Panduan Pengguna</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Tampilan Panduan Pengguna</a>
				</li>
			</ul>
		</div>
		
		<h4><?=$news['title']?></h4>
		
		<div class="row">
			<div class="col-md-12">
				<div class="news-item-page">
				<fieldset>
					<p><?=$news['content']?></p>
				</fieldset>
					<!--
					<iframe id="blockrandom" name="iframe" src="<?=$base_url?>/uploadedFile/usermanual/<?//=$news['filename']?>" 
					width="100%" height="500" scrolling="auto" align="top" frameborder="0" class="wrapper">
					This option will not work correctly. Unfortunately, your browser does not support
					inline frames.</iframe>
					-->
					<?php
					$next = $nid+1;
					$back = $nid-1;
					
					$role = $this->session->credential['role_id'];
					
				if($role == 3){
					if($next > 7){
						$next = 3;
					}else if($back < 3){
						$back = 3;
					}
				}else if($role == 4){
					if($next > 20){
						$next = 10;
					}else if($back < 10){
						$back = 10;
					}
				}else if($role == 5){
					if($next > 31){
						$next = 21;
					}else if($back < 21){
						$back = 21;
					}
				}else if($role == 2){
					if($next > 61){
						$next = 32;
					}else if($back < 32){
						$back = 32;
					}
				}
					?>
					<center><a href="<?=$base_url?>index.php/main/usermanual/view/<?=$back?>">Kembali</a> | <a href="<?=$base_url?>index.php/main/usermanual/view/<?=$next?>">Selanjutnya</a></center>
				</div>
			</div>
		</div>

	</div>
</div>