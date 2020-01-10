<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Pengaturan Baner
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Beranda</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Pengaturan</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Pengaturan Banner</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->

<script type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
        selector: "textarea",
         elementpath: false,
        plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
        ],

        toolbar1: "bold italic underline | fontsizeselect | forecolor",
        toolbar2: "",
        
        menubar: false,
        toolbar_items_size: 'small',

        style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],

        templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
        ]
});</script>

		
		<div class="row">
		<div class="col-md-12">
			<?php if($update_success) { ?>
			<div class="alert alert-success">
				<strong>Sukses!</strong> Banner Berhasil Diubah.
			</div>
			<?php } ?>
			<div class="form">
				<form target="_self" action="<?=$site_url?>/admini/banner/updateBanner" method="post" id="input-form" role="form" class="form-horizontal">
					<div class="form-body">
					<!--
						<div class="form-group">
							<label class="col-md-3 control-label">Text Banner</label>
							<div class="col-md-6">
								<input type="text" class="form-control" placeholder="Banner Text" name="banner_text" id="banner-text" value="<?//=$banner['banner_text']?>">
							</div>
						</div>
						-->
						<div class="form-group">
									<label class="col-md-3 control-label">Teks Banner</label>
									<div class="col-md-6">
									<textarea class="" rows="3" name="banner_text" placeholder="Banner Text" id="banner-text"> <?=$banner['banner_text']?> </textarea>
									</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Status</label>
							<div class="col-md-6">
								<select class="form-control input-sm" name="banner_status">
									<option value="1" <?=$banner['banner_status'] == '1' ? 'SELECTED' : ''?>>Published</option>
									<option value="0" <?=$banner['banner_status'] == '0' ? 'SELECTED' : ''?>>Unpublished</option>
								</select>
							</div>
						</div>
						<div class="form-actions right">
							<button id="input-form-submit-button" type="submit" 
								class="btn blue ladda-button"
								 data-style="expand-right"
								>Simpan Banner</button>
								<a href='index.php/main/mainrac'><button type="button" class="btn yellow" id="kri-button-cancel"><i class="fa fa-times"></i>Batal</button></a>
						</div>
					</div>
				</form>
			</div>
		</div>	
		</div>
	</div>
</div>