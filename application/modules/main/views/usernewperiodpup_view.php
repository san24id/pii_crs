<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		&nbsp;&nbsp;First Manual New Period
		</h3>
		<!-- END PAGE HEADER-->
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
					 if($back < 1){
						$back = 1;
					}
					?>
					<center><a href="<?=$base_url?>index.php/main/usermanual/viewmanual_pupnewperiod/<?=$back?>">Back</a> | <a href="<?=$base_url?>index.php/main/usermanual/viewmanual_pupnewperiod/<?=$next?>">Next</a></center>
				</div>
			</div>
		</div>

	</div>
</div>