<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		User Manual
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
					<a target="_self" href="<?=$site_url?>/main/usermanual">User Manual</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">View User Manual</a>
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
					if($next > 44){
						$next = 35;
					}else if($back < 35){
						$back = 35;
					}
				}else if($role == 4){
					if($next > 65){
						$next = 50;
					}else if($back < 50){
						$back = 50;
					}
				}else if($role == 5){
					if($next > 135){
						$next = 120;
					}else if($back < 120){
						$back = 120;
					}
				}else if($role == 2){
					if($next > 32){
						$next = 1;
					}else if($back < 1){
						$back = 1;
					}
				}else if($role == 7){
					if($next > 80){
						$next = 71;
					}else if($back < 71){
						$back = 71;
					}
				}else if($role == 9){
					if($next > 110){
						$next = 101;
					}else if($back < 101){
						$back = 101;
					}
				}else if($role == 8){
					if($next > 99){
						$next = 91;
					}else if($back < 91){
						$back = 91;
					}
				}else if($role == 6){
					if($next > 89){
						$next = 81;
					}else if($back < 81){
						$back = 81;
					}
				}
					?>
					<center><a href="<?=$base_url?>index.php/main/usermanual/view/<?=$back?>">Back</a> | <a href="<?=$base_url?>index.php/main/usermanual/view/<?=$next?>">Next</a></center>
				</div>
			</div>
		</div>

	</div>
</div>