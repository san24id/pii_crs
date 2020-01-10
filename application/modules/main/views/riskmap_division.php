<?php error_reporting(0); ?>
<!-- BEGIN CONTENT -->
<style type="text/css">
	
td{
	padding: 10px;
}
</style>
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Risk Map Division
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main/mainrac">Other</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a  >Risk Map Division</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN CONTENT-->
		<div class="row">
			<div class="col-md-12">

			<div class="form">
				 <form method="post" id="map_divisi-form" autocomplete="off">
					<div class="form-group">
						<label class="col-md-3 control-label">Division Name</label>
							<div class="col-md-5">
							<select class="form-control input-sm" id="l_divisi" name="divisi_map">
								<option value="alldiv">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>" data-division2 = "<?php echo $key['ref_value'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
							</div>
							<button type="submit" class="btn blue btn-sm" id="select_divisi">Search</button>
					</div>
				</form>
			</div>
		<div class="row">
			<div id="content-map">
				<label>Total all records</label>
						<label>:</label>
						<label><?php echo $sumAllRisk; 
							$totalrecord = $sumAllRisk;
						?></label>
				<div class="col-md-12">			
				<table class="responsive table-striped table-bordered table-hover" width="100%" border="1" cellspacing="1" cellpadding="1" style="font-size: 12px;"> 
        		<tr>
          			<th><br></th>
          			<th colspan="5"><div align="center"><h3><b>LIKELIHOOD</b></h3></div></th>
        		</tr>
        		<tr>
        			<th width="15%"><h3 align="center"><b> RISK IMPACT</b></h3></th>
        			<td height="20" valign="center"><div align="center"><strong>VERY LOW</strong></div></td>
    				<td valign="center"><div align="center"><strong>LOW</strong></div></td>
    				<td valign="center"><div align="center"><strong>MEDIUM</strong></div></td>
    				<td valign="center"><div align="center"><strong>HIGH</strong></div></td>
    				<td valign="center"><div align="center"><strong>VERY HIGH</strong></div></td>
  				</tr>
  				<tr>
    				<td valign="center"><div align="right"><strong>CATASTROPHIC</strong></div></td>
    				<td bgcolor = "ffff80" align="center"><h4><?php if($allCataVLow == '0'){ ?><?php echo number_format(($allCataVLow/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allCataVLow/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allCataVLow == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allCataVLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allCataVLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "ffff80" align="center"><h4><?php if($allCataLow == '0'){ ?><?php echo number_format(($allCataLow/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allCataLow/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allCataLow == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allCataLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allCataLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "#FFA07A" align="center"><h4><?php if($allCataMed == '0'){ ?><?php echo number_format(($allCataMed/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allCataMed/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allCataMed == '0'){ ?> </h4><button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allCataMed"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allCataMed"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "#FFA07A" align="center"><h4><?php if($allCataHigh == '0'){ ?><?php echo number_format(($allCataHigh/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allCataHigh/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allCataHigh == '0'){ ?> </h4><button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allCataHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allCataHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "#FFA07A" align="center"><h4><?php if($allCataVhigh == '0'){ ?><?php echo number_format(($allCataVhigh/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allCataVhigh/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allCataVhigh == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allCataVHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allCataVHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>
  				</tr>
  				<tr>
    				<td><div align="right"><strong>MAYOR</strong></div></td>
    				<td bgcolor = "#90EE90" align="center"><h4><?php if($allMayVLow == '0'){ ?><?php echo number_format(($allMayVLow/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allMayVLow/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allMayVLow == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allMayVLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allMayVLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "ffff80" align="center"><h4><?php if($allMayLow == '0'){ ?><?php echo number_format(($allMayLow/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allMayLow/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allMayLow == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allMayLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allMayLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "#FFA07A" align="center"><h4><?php if($allMayMed == '0'){ ?><?php echo number_format(($allMayMed/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allMayMed/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allMayMed == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allMayMed"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allMayMed"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "#FFA07A" align="center"><h4><?php if($allMayHigh == '0'){ ?><?php echo number_format(($allMayHigh/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allMayHigh/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allMayHigh == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allMayHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allMayHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "#FFA07A" align="center"><h4><?php if($allMayVhigh == '0'){ ?><?php echo number_format(($allMayVhigh/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allMayVhigh/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allMayVhigh == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allMayVHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allMayVHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>
  				</tr>
  				<tr>
  					<td><div align="right"><strong>MODERATE</strong><br></div></td>
    				<td bgcolor = "#90EE90" align="center"><h4><?php if($allModVLow == '0'){ ?><?php echo number_format(($allModVLow/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allModVLow/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allModVLow == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allModVLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allModVLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "ffff80" align="center"><h4><?php if($allModLow == '0'){ ?><?php echo number_format(($allModLow/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allModLow/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allModLow == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allModLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allModLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "ffff80" align="center"><h4><?php if($allModMed == '0'){ ?><?php echo number_format(($allModMed/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allModMed/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allModMed == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allModMed"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allModMed"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "#FFA07A" align="center"><h4><?php if($allModHigh == '0'){ ?><?php echo number_format(($allModHigh/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allModHigh/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allModHigh == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allModHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allModHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "#FFA07A" align="center"><h4><?php if($allModVhigh == '0'){ ?><?php echo number_format(($allModVhigh/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allModVhigh/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allModVhigh == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allModVHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allModVHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>
  				</tr>
  				<tr>
    				<td><div align="right"><strong>MINOR</strong><br></div></td>
    				<td bgcolor = "#90EE90" align="center"><h4><?php if($allMinVLow == '0'){ ?><?php echo number_format(($allMinVLow/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allMinVLow/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allMinVLow == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allMinVLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allMinVLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "#90EE90" align="center"><h4><?php if($allMinLow == '0'){ ?><?php echo number_format(($allMinLow/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allMinLow/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allMinLow == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allMinLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allMinLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "ffff80" align="center"><h4><?php if($allMinMed == '0'){ ?><?php echo number_format(($allMinMed/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allMinMed/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allMinMed == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allMinMed"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allMinMed"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "ffff80" align="center"><h4><?php if($allMinHigh == '0'){ ?><?php echo number_format(($allMinHigh/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allMinHigh/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allMinHigh == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allMinHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allMinHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "#FFA07A" align="center"><h4><?php if($allMinVhigh == '0'){ ?><?php echo number_format(($allMinVhigh/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allMinVhigh/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allMinVhigh == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allMinVHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allMinVHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>
  				</tr>
  				<tr>
    				<td><div align="right" align="center"><strong>INSIGNIFICANT</strong><br></div></td>
    				<td bgcolor = "#90EE90" align="center"><h4><?php if($allInsiVLow == '0'){ ?><?php echo number_format(($allInsiVLow/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allInsiVLow/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allInsiVLow == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allInsiVLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allInsiVLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "#90EE90" align="center"><h4><?php if($allInsiLow == '0'){ ?><?php echo number_format(($allInsiLow/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allInsiLow/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allInsiLow == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allInsiLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allInsiLow"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "#90EE90" align="center"><h4><?php if($allInsiMed == '0'){ ?><?php echo number_format(($allInsiMed/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allInsiMed/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allInsiMed == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allInsiMed"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allInsiMed"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "ffff80" align="center"><h4><?php if($allInsiHigh == '0'){ ?><?php echo number_format(($allInsiHigh/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allInsiHigh/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allInsiHigh == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allInsiHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allInsiHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>

    				<td bgcolor = "#FFA07A" align="center"><h4><?php if($allInsiVhigh == '0'){ ?><?php echo number_format(($allInsiVhigh/$totalrecord)*100,2).'%'; ?><?php }else{?> <b><?php echo number_format(($allInsiVhigh/$totalrecord)*100,2).'%'; ?></b><?php }?></h4><?php if($allInsiVhigh == '0'){ ?> <button class="btn-primary" style="display: none;" title="view" type="button" data-toggle="modal" href="#modal-allInsiVHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }else{?><button class="btn-primary" title="view" type="button" data-toggle="modal" href="#modal-allInsiVHigh"><span class="glyphicon glyphicon-eye-open"></span></button><?php }?></td>
  				</tr>
				</table>
				</div>

			</div>
		</div>
					
		</div>	
		</div>
		</div>		
		<!-- END CONTENT-->
	</div>
</div>

<div id="modal-allCataVLow" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK CATASTROPHIC & VERY LOW</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<!--<form id="form1pdf" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_pdf" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divpdf1">
					<input type="hidden" name="a" value="CATASTROPHIC">
					<input type="hidden" name="b" value="VERY LOW">
					<input type="hidden" name="nfile" value="riskmapcatavlow">
					<input type="hidden" name="judul" value="RISK CATASTROPHIC & VERY LOW">
					<a href="javascript:;" onclick="document.getElementById('form1pdf').submit();">PDF</a>
				</li>-->
			</form>
			<form id="form1exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel1">
					<input type="hidden" name="a" value="CATASTROPHIC">
					<input type="hidden" name="b" value="VERY LOW">
					<input type="hidden" name="nfile" value="riskmapcatavlow">
					<input type="hidden" name="judul" value="RISK CATASTROPHIC & VERY LOW">
					<a href="javascript:;" onclick="document.getElementById('form1exel').submit();">Excel</a>
				</li>
			</form>	 
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_catvlow" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="catavlow-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_catvlow" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allCataLow" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK CATASTROPHIC & LOW</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form2exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel2">
					<input type="hidden" name="a" value="CATASTROPHIC">
					<input type="hidden" name="b" value="LOW">
					<input type="hidden" name="nfile" value="riskmapcatalow">
					<input type="hidden" name="judul" value="RISK CATASTROPHIC & LOW">
					<a href="javascript:;" onclick="document.getElementById('form2exel').submit();">Excel</a>
				</li>
			</form>	 
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_catlow" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="catalow-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_catlow" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allCataMed" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK CATASTROPHIC & MEDIUM</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form3exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel3">
					<input type="hidden" name="a" value="CATASTROPHIC">
					<input type="hidden" name="b" value="MEDIUM">
					<input type="hidden" name="nfile" value="riskmapcatamedium">
					<input type="hidden" name="judul" value="RISK CATASTROPHIC & MEDIUM">
					<a href="javascript:;" onclick="document.getElementById('form3exel').submit();">Excel</a>
				</li>
			</form>	 	 
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_catmed" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="catamed-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_catmed" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allCataHigh" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK CATASTROPHIC & HIGH</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form4exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel4">
					<input type="hidden" name="a" value="CATASTROPHIC">
					<input type="hidden" name="b" value="HIGH">
					<input type="hidden" name="nfile" value="riskmapcatahigh">
					<input type="hidden" name="judul" value="RISK CATASTROPHIC & HIGH">
					<a href="javascript:;" onclick="document.getElementById('form4exel').submit();">Excel</a>
				</li>
			</form>	 
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_cathigh" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="catahigh-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_cathigh" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allCataVHigh" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK CATASTROPHIC & VERY HIGH</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form5exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel5">
					<input type="hidden" name="a" value="CATASTROPHIC">
					<input type="hidden" name="b" value="VERY HIGH">
					<input type="hidden" name="nfile" value="riskmapcatavhigh">
					<input type="hidden" name="judul" value="RISK CATASTROPHIC & VERY HIGH">
					<a href="javascript:;" onclick="document.getElementById('form5exel').submit();">Excel</a>
				</li>
			</form>	 
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_catvhigh" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="catavhigh-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_catvhigh" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allMayVLow" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK MAYOR  & VERY LOW</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form6exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel6">
					<input type="hidden" name="a" value="MAJOR">
					<input type="hidden" name="b" value="VERY LOW">
					<input type="hidden" name="nfile" value="riskmapmayvlow">
					<input type="hidden" name="judul" value="RISK MAYOR & VERY LOW">
					<a href="javascript:;" onclick="document.getElementById('form6exel').submit();">Excel</a>
				</li>
			</form>	 
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_mayvlow" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="mayvlow-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_mayvlow" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allMayLow" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK MAYOR & LOW</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form7exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel7">
					<input type="hidden" name="a" value="MAJOR">
					<input type="hidden" name="b" value="LOW">
					<input type="hidden" name="nfile" value="riskmapmaylow">
					<input type="hidden" name="judul" value="RISK MAYOR & LOW">
					<a href="javascript:;" onclick="document.getElementById('form7exel').submit();">Excel</a>
				</li>
			</form>	 
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_maylow" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="maylow-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_maylow" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allMayMed" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK MAYOR & MEDIUM</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form8exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel8">
					<input type="hidden" name="a" value="MAJOR">
					<input type="hidden" name="b" value="MEDIUM">
					<input type="hidden" name="nfile" value="riskmapmaymedium">
					<input type="hidden" name="judul" value="RISK MAYOR & MEDIUM">
					<a href="javascript:;" onclick="document.getElementById('form8exel').submit();">Excel</a>
				</li>
			</form>	
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_maymed" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="maymed-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_maymed" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allMayHigh" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK MAYOR & HIGH</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form9exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel9">
					<input type="hidden" name="a" value="MAJOR">
					<input type="hidden" name="b" value="HIGH">
					<input type="hidden" name="nfile" value="riskmapmayhigh">
					<input type="hidden" name="judul" value="RISK MAYOR & HIGH">
					<a href="javascript:;" onclick="document.getElementById('form9exel').submit();">Excel</a>
				</li>
			</form>	 
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_mayhigh" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="mayhigh-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_mayhigh" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allMayVHigh" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK MAYOR & VERY HIGH</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form10exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel10">
					<input type="hidden" name="a" value="MAJOR">
					<input type="hidden" name="b" value="VERY HIGH">
					<input type="hidden" name="nfile" value="riskmapmayvhigh">
					<input type="hidden" name="judul" value="RISK MAYOR & VERY HIGH">
					<a href="javascript:;" onclick="document.getElementById('form10exel').submit();">Excel</a>
				</li>
			</form>	 
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_mayvhigh" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="mayvhigh-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_mayvhigh" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allModVLow" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK MODERATE  & VERY LOW</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form11exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel11">
					<input type="hidden" name="a" value="MODERATE">
					<input type="hidden" name="b" value="VERY LOW">
					<input type="hidden" name="nfile" value="riskmapmodevlow">
					<input type="hidden" name="judul" value="RISK MODERATE & VERY LOW">
					<a href="javascript:;" onclick="document.getElementById('form11exel').submit();">Excel</a>
				</li>
			</form>	 
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_modvlow" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modvlow-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_modvlow" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allModLow" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK MODERATE & LOW</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form12exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel12">
					<input type="hidden" name="a" value="MODERATE">
					<input type="hidden" name="b" value="LOW">
					<input type="hidden" name="nfile" value="riskmapmodelow">
					<input type="hidden" name="judul" value="RISK MODERATE & LOW">
					<a href="javascript:;" onclick="document.getElementById('form12exel').submit();">Excel</a>
				</li>
			</form>	
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_modlow" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modlow-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_modlow" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allModMed" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK MODERATE & MEDIUM</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form13exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel13">
					<input type="hidden" name="a" value="MODERATE">
					<input type="hidden" name="b" value="MEDIUM">
					<input type="hidden" name="nfile" value="riskmapmodemedium">
					<input type="hidden" name="judul" value="RISK MODERATE & MEDIUM">
					<a href="javascript:;" onclick="document.getElementById('form13exel').submit();">Excel</a>
				</li>
			</form>	 
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_modmed" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modmed-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_modmed" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allModHigh" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK MODERATE & HIGH</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form14exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel14">
					<input type="hidden" name="a" value="MODERATE">
					<input type="hidden" name="b" value="HIGH">
					<input type="hidden" name="nfile" value="riskmapmodehigh">
					<input type="hidden" name="judul" value="RISK MODERATE & HIGH">
					<a href="javascript:;" onclick="document.getElementById('form14exel').submit();">Excel</a>
				</li>
			</form>	
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_modhigh" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modhigh-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_modhigh" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allModVHigh" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK MODERATE & VERY HIGH</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form15exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel15">
					<input type="hidden" name="a" value="MODERATE">
					<input type="hidden" name="b" value="VERY HIGH">
					<input type="hidden" name="nfile" value="riskmapmodevhigh">
					<input type="hidden" name="judul" value="RISK MODERATE & VERY HIGH">
					<a href="javascript:;" onclick="document.getElementById('form15exel').submit();">Excel</a>
				</li>
			</form>	 
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_modvhigh" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modvhigh-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_modvhigh" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allMinVLow" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK MINOR  & VERY LOW</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form16exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel16">
					<input type="hidden" name="a" value="MINOR">
					<input type="hidden" name="b" value="VERY LOW">
					<input type="hidden" name="nfile" value="riskmapminvlow">
					<input type="hidden" name="judul" value="RISK MINOR & VERY LOW">
					<a href="javascript:;" onclick="document.getElementById('form16exel').submit();">Excel</a>
				</li>
			</form>	 
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_minvlow" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="minvlow-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_minvlow" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allMinLow" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK MINOR & LOW</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form17exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel17">
					<input type="hidden" name="a" value="MINOR">
					<input type="hidden" name="b" value="LOW">
					<input type="hidden" name="nfile" value="riskmapminlow">
					<input type="hidden" name="judul" value="RISK MINOR & LOW">
					<a href="javascript:;" onclick="document.getElementById('form17exel').submit();">Excel</a>
				</li>
			</form>	 				 
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_minlow" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="minlow-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_minlow" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allMinMed" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK MINOR & MEDIUM</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form18exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel18">
					<input type="hidden" name="a" value="MINOR">
					<input type="hidden" name="b" value="MEDIUM">
					<input type="hidden" name="nfile" value="riskmapminmedium">
					<input type="hidden" name="judul" value="RISK MINOR & MEDIUM">
					<a href="javascript:;" onclick="document.getElementById('form18exel').submit();">Excel</a>
				</li>
			</form>
			</ul>	 
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_minmed" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="minmed-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_minmed" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allMinHigh" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK MINOR & HIGH</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form19exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel19">
					<input type="hidden" name="a" value="MINOR">
					<input type="hidden" name="b" value="HIGH">
					<input type="hidden" name="nfile" value="riskmapminhigh">
					<input type="hidden" name="judul" value="RISK MINOR & HIGH">
					<a href="javascript:;" onclick="document.getElementById('form19exel').submit();">Excel</a>
				</li>
			</form>	 
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_minhigh" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="minhigh-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_minhigh" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allMinVHigh" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK MINOR & VERY HIGH</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form20exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel20">
					<input type="hidden" name="a" value="MINOR">
					<input type="hidden" name="b" value="VERY HIGH">
					<input type="hidden" name="nfile" value="riskmapminvhigh">
					<input type="hidden" name="judul" value="RISK MINOR & VERY HIGH">
					<a href="javascript:;" onclick="document.getElementById('form20exel').submit();">Excel</a>
				</li>
			</form>	
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_minvhigh" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="minvhigh-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_minvhigh" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allInsiVLow" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK INSIGNIFICANT  & VERY LOW</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form21exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel21">
					<input type="hidden" name="a" value="INSIGNIFICANT">
					<input type="hidden" name="b" value="VERY LOW">
					<input type="hidden" name="nfile" value="riskmapinsvlow">
					<input type="hidden" name="judul" value="RISK INSIGNIFICANT & VERY LOW">
					<a href="javascript:;" onclick="document.getElementById('form21exel').submit();">Excel</a>
				</li>
			</form>	
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_insvlow" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="insvlow-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_insvlow" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allInsiLow" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK INSIGNIFICANT & LOW</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form22exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel22">
					<input type="hidden" name="a" value="INSIGNIFICANT">
					<input type="hidden" name="b" value="LOW">
					<input type="hidden" name="nfile" value="riskmapinslow">
					<input type="hidden" name="judul" value="RISK INSIGNIFICANT & LOW">
					<a href="javascript:;" onclick="document.getElementById('form22exel').submit();">Excel</a>
				</li>
			</form>	
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_inslow" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="inslow-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_inslow" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allInsiMed" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK INSIGNIFICANT & MEDIUM</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form23exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel23">
					<input type="hidden" name="a" value="INSIGNIFICANT">
					<input type="hidden" name="b" value="MEDIUM">
					<input type="hidden" name="nfile" value="riskmapinsmedium">
					<input type="hidden" name="judul" value="RISK INSIGNIFICANT & MEDIUM">
					<a href="javascript:;" onclick="document.getElementById('form23exel').submit();">Excel</a>
				</li>
			</form>	
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_insmed" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="insmed-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_insmed" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allInsiHigh" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK INSIGNIFICANT & HIGH</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form24exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel24">
					<input type="hidden" name="a" value="INSIGNIFICANT">
					<input type="hidden" name="b" value="HIGH">
					<input type="hidden" name="nfile" value="riskmapinshigh">
					<input type="hidden" name="judul" value="RISK INSIGNIFICANT & HIGH">
					<a href="javascript:;" onclick="document.getElementById('form24exel').submit();">Excel</a>
				</li>
			</form>	
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_inshigh" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="inshigh-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_inshigh" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="modal-allInsiVHigh" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">RISK INSIGNIFICANT & VERY HIGH</h4>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">Export<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
			<form id="form25exel" action="<?php echo base_url()?>index.php/report/risk/riskmapdivisi_excel" method="post" target="_blank">
				<li>
					<input type="hidden" name="divisi_c1" id="divexel25">
					<input type="hidden" name="a" value="INSIGNIFICANT">
					<input type="hidden" name="b" value="VERY HIGH">
					<input type="hidden" name="nfile" value="riskmapinsvhigh">
					<input type="hidden" name="judul" value="RISK INSIGNIFICANT & VERY HIGH">
					<a href="javascript:;" onclick="document.getElementById('form25exel').submit();">Excel</a>
				</li>
			</form>	
			</ul>
		</div>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_insvhigh" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="insvhigh-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="table_insvhigh" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>				



<script type="text/javascript">

$(document).ready(function() {  
  
  // submit form using $.ajax() method
  
  $('#map_divisi-form').submit(function(e){
    
    e.preventDefault(); // Prevent Default Submission
    
    $.ajax({
      url: '<?php echo site_url() ?>/main/mainrac/DivisionMapUs',
      type: 'POST',
      data: $(this).serialize() // it will serialize the form data
    })
    .done(function(data){
      
    $('#content-map').html(data);
      
    })
    .fail(function(){
      alert('Submit Failed ...');  
    });
  }); 
  
});


  $('#select_divisi').on('click', function() {

  	 $('#divpdf1').val($('#l_divisi').val());
  	 $('#divpdf2').val($('#l_divisi').val());
  	 $('#divpdf3').val($('#l_divisi').val());
  	 $('#divpdf4').val($('#l_divisi').val());
  	 $('#divpdf5').val($('#l_divisi').val());
  	 $('#divpdf6').val($('#l_divisi').val());
  	 $('#divpdf7').val($('#l_divisi').val());
  	 $('#divpdf8').val($('#l_divisi').val());
  	 $('#divpdf9').val($('#l_divisi').val());
  	 $('#divpdf10').val($('#l_divisi').val());
  	 $('#divpdf11').val($('#l_divisi').val());

  	 $('#divexel1').val($('#l_divisi').val());
  	 $('#divexel2').val($('#l_divisi').val());
  	 $('#divexel3').val($('#l_divisi').val());
  	 $('#divexel4').val($('#l_divisi').val());
  	 $('#divexel5').val($('#l_divisi').val());
  	 $('#divexel6').val($('#l_divisi').val());
  	 $('#divexel7').val($('#l_divisi').val());
  	 $('#divexel8').val($('#l_divisi').val());
  	 $('#divexel9').val($('#l_divisi').val());
  	 $('#divexel10').val($('#l_divisi').val());
  	 $('#divexel11').val($('#l_divisi').val());
  	 $('#divexel12').val($('#l_divisi').val());
  	 $('#divexel13').val($('#l_divisi').val());
  	 $('#divexel14').val($('#l_divisi').val());
  	 $('#divexel15').val($('#l_divisi').val());
  	 $('#divexel16').val($('#l_divisi').val());
  	 $('#divexel17').val($('#l_divisi').val());
  	 $('#divexel18').val($('#l_divisi').val());
  	 $('#divexel19').val($('#l_divisi').val());
  	 $('#divexel20').val($('#l_divisi').val());
  	 $('#divexel21').val($('#l_divisi').val());
  	 $('#divexel22').val($('#l_divisi').val());
  	 $('#divexel23').val($('#l_divisi').val());
  	 $('#divexel24').val($('#l_divisi').val());
  	 $('#divexel25').val($('#l_divisi').val());
            
   });
</script>