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
		Risk Map Aggregate
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Transaction</a>
					<i class="fa fa-angle-right"></i>
				</li>
			 
				<li>
					<a target="_self" href="javascript:;">Other Risk</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Risk Map Aggregate</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN CONTENT-->
		<div class="row">
			<div class="col-md-12">
		<div class="portlet">
			<div class="portlet-title">
					<a href="<?php echo site_url(); ?>/main/mainrac/DivisionMapAgg/<?php echo $pid; ?>" class="btn default blue-stripe">
					<span class="hidden-480">
					Aggregete Risk From Libarary</span>
					</a>
					<a href="<?php echo site_url(); ?>/main/mainrac/DivisionMapAggnew/<?php echo $pid; ?>" class="btn default blue-stripe">
					<span class="hidden-480">
					Risk Aggregete</span>
					</a>
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
		<h4 class="modal-title">RISK MODERATE  & VERY LOW</h4>
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

var pid = <?php echo $pid; ?>;

</script>