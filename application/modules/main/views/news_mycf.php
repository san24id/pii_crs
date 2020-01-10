<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		News
		</h3>
		<!-- END PAGE HEADER-->
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main/maindireksirac/getmyDirectorate">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">News</a>
				</li>
			</ul>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<ul class="list-group">
					<?php 
					$no = 1;
					foreach($news as $row) { 

					$modulus = $no%2;
					if($modulus == 0){
						$warna = 'white';
					}else{
						$warna = '#99FFCC';
					}

					?>
					<li class="list-group-item" style="background-color:<?=$warna?>;"><font style="font-size:19px;"><a target="_self" href="<?=$site_url?>/main/newsdir/news_view_my_cf/<?=$row['id']?>"><?=$row['title']?></a></font> <br> <font style="color:gray; font-size:11px;"> --- Publish On <?=$row['date_publish_v']?> </font></li>
					
					<?php
					$no++;
					 } 
					 ?>
				</ul>
			</div>
		</div>
	</div>
</div>