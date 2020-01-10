<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		View News
		</h3>
		<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-6">
			<h4>Title : <?=$news['title']?></h4>
			<h5>Filename : <?=$news['filename']?></h5>
			<h5>Created Date : <?=$news['created_date_v']?></h5>
			<h5>Created By : <?=$news['created_by_v']?></h5>
			<h5>Status : <?=$news['status_v']?></h5>
		</div>
		<div class="col-md-6">
			<a href="javascript: location.href='<?=$site_url?>/admin/news/newsEdit/<?=$news['id']?>'" class="btn default green pull-right">
			<i class="fa fa-pencil font-white"></i>
			<span class="hidden-480">
			Edit News </span>
			</a>
		</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="news-item-page">
					<iframe id="blockrandom" name="iframe" src="<?=$base_url?>/uploadedFile/news/<?=$news['filename']?>" 
					width="100%" height="500" scrolling="auto" align="top" frameborder="0" class="wrapper">
                    This option will not work correctly. Unfortunately, your browser does not support
                    inline frames.</iframe>

				</div>
			</div>
		</div>		
	</div>
</div>