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
					<a target="_self" href="<?=$site_url?>/maini/policy">Kebijakan</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Tampilan Kebijakan</a>
				</li>
			</ul>
		</div>
		
		<h4><?=$news['title']?></h4>
		<div class="row">
			<div class="col-md-12">
				<div class="news-item-page">
					<iframe id="blockrandom" name="iframe" src="<?=$base_url?>/uploadedFile/news/<?=$news['filename']?>" 
					width="100%" height="1225" scrolling="auto" align="top" frameborder="0" class="wrapper">
					Pilihan ini tidak akan bekerja dengan benar. Sayangnya, browser Anda tidak mendukung inline frames.</iframe>

				</div>
			</div>
		</div>		
	</div>
</div>