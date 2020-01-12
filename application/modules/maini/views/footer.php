	<div id="global-app-modal-error" class="modal fade alert-block alert-danger" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-body">
		<button type="button" class="close" data-dismiss="modal"></button>
		<h4 class="alert-heading">Error!</h4>
		<p class="alert_container"></p>
		<p>
		    <button type="button" class="btn red" data-dismiss="modal">OK</button>
		</p>
		</div>
	</div>

	<div id="global-app-modal-error-alert" class="modal fade alert-block alert-danger" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-body">
		<button type="button" class="close" data-dismiss="modal"></button>
		<h4 class="alert-heading">Alert</h4>
		<p class="alert_container"></p>
		<p>
		    <button type="button" class="btn blue" data-dismiss="modal">OK</button>
		</p>
		</div>
	</div>
	
	<div id="global-app-modal-success" class="modal fade alert-block alert-success" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-body">
		<button type="button" class="close" data-dismiss="modal"></button>
		<h4 class="alert-heading">Success!</h4>
		<p class="alert_container"></p>
		<p>
		    <button type="button" class="btn green btn-ok-success" data-dismiss="modal">OK</button>
		</p>
		</div>
	</div>
	
	<div id="global-app-modal-warning" class="modal fade alert-block alert-warning" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-body">
		<h4 class="alert-heading">Information</h4>
		<p class="alert_container"></p>
		<p>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
	        <button type="button" class="btn green btn-danger">Ya</button>
		</p>
		</div>
	</div>

	<div id="global-app-modal-confirmation" class="modal fade alert-block alert-warning" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-body">
		<h4 class="alert-heading">Informasi</h4>
		<p class="alert_container"></p>
		<p>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
	        <button type="button" class="btn btn-primary btn-ok-success">Ya</button>
		</p>
		</div>
	</div>

	<div id="global-app-modal-confirmation-change" class="modal fade alert-block alert-warning" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-body">
		<h4 class="alert-heading">Konfirmasi?</h4>
		<p class="alert_container"></p>
		<p>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Tolak</button>
	        <button type="button" class="btn btn-primary btn-ok-success">Terima</button>
		</p>
		</div>
	</div>

	<div id="global-app-modal-warning-maintenance" class="modal fade alert-block alert-warning" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-body">
		<h4 class="alert-heading">Informasi</h4>
		<p class="alert_container"></p>
		<p>
	         <button type="button" class="btn btn-primary btn-ok-success">OK</button>
		</p>
		</div>
	</div>
</div>
<div class="page-footer">
	<div class="page-footer-inner">
		<span>Copyright © <?=date('Y')?> </span><span><?=$app_config['COPYRIGHT']?></span>.
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>

<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-loading/lada.min.js"></script>
<script src="assets/scripts/jquery.webticker.js"></script>
<script src="assets/scripts/app.js"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="assets/global/scripts/datatable.js"></script>
<?=isset($pageLevelScripts) ? $pageLevelScripts : ''?>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Metronic.setAssetsPath(base_url+'assets/');
   Layout.init(); // init layout
   MainApp.init(); // global function
   <?=isset($pageLevelScriptsInit) ? $pageLevelScriptsInit : ''?>
   

});
</script>

    </body>
</html>