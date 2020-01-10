  
			<div class="table-header">
				<center><div class="table-caption"><font = "3"><b> RISK MAP</b></font></center> </div>
			</div>	
			<div class="table-header">
				<center><div class="table-caption"><font = "3"><b> Periode <?=$periodenya[0]['periode_name'];?> (<?=date("d-m-Y", strtotime($periodenya[0]['periode_start']));?> s/d <?=date("d-m-Y", strtotime($periodenya[0]['periode_end']));?>) </b></font></center> </div>
			</div>
			<table class="responsive table table-striped table-bordered table-hover"  border = "1"> 
  <tr>
    <th rowspan="2">Dampak Risiko dalam hal Materialisasi Risiko<br></th>
    <th colspan="5">Kemungkinan Resiko</th>
  </tr>
  <tr>
    <td>Sangat Rendah<br></td>
    <td>Rendah</td>
    <td>Sedang</td>
    <td>Tinggi</td>
    <td>Sangat Tinggi</td>
  </tr>
  
  <?php if($datanya):?>
  <?php $i = 1;?>
  <?php foreach($datanya as $key):?>
   
  <?php if($i ==1):?>
  <tr>
    <td>Catastrophic<br></td>
    <td bgcolor = "yellow"><?php echo $key['Very Low'];?></td>
    <td bgcolor = "yellow"><?php echo $key['Low'];?></td>
    <td bgcolor = "red"><?php echo $key['Medium'];?></td>
    <td bgcolor = "red"><?php echo $key['High'];?></td>
    <td bgcolor = "red"><?php echo $key['Very High'];?></td>

  </tr>
  <?php endif;?>
  <?php if($i ==2):?>
  <tr>
    <td>Mayor<br></td>
    <td bgcolor = "green"><?php echo $key['Very Low'];?></td>
    <td bgcolor = "yellow"><?php echo $key['Low'];?></td>
    <td bgcolor = "red"><?php echo $key['Medium'];?></td>
    <td bgcolor = "red"><?php echo $key['High'];?></td>
    <td bgcolor = "red"><?php echo $key['Very High'];?></td>
  </tr>
  <?php endif;?>
  <?php if($i ==3):?>
  <tr>
    <td>Sedang<br></td>
    <td bgcolor = "green"><?php echo $key['Very Low'];?></td>
    <td bgcolor = "yellow"><?php echo $key['Low'];?></td>
    <td bgcolor = "yellow"><?php echo $key['Medium'];?></td>
    <td bgcolor = "red"><?php echo $key['High'];?></td>
    <td bgcolor = "red"><?php echo $key['Very High'];?></td>
  </tr>
  <?php endif;?>
  
  <?php if($i ==4):?>
  <tr>
    <td>Minor<br></td>
    <td bgcolor = "green"><?php echo $key['Very Low'];?></td>
    <td bgcolor = "green"><?php echo $key['Low'];?></td>
    <td bgcolor = "yellow"><?php echo $key['Medium'];?></td>
    <td bgcolor = "yellow"><?php echo $key['High'];?></td>
    <td bgcolor = "red"><?php echo $key['Very High'];?></td>
  </tr>
  <?php endif;?>

  <?php if($i ==5):?>
  <tr>
    <td>Tidak Signifikan<br></td>
    <td bgcolor = "green"><?php echo $key['Very Low'];?></td>
    <td bgcolor = "green"><?php echo $key['Low'];?></td>
    <td bgcolor = "green"><?php echo $key['Medium'];?></td>
    <td bgcolor = "yellow"><?php echo $key['High'];?></td>
    <td bgcolor = "red"><?php echo $key['Very High'];?></td>
  </tr>
  <?php endif;?>
  
  <?php $i++;?>
  <?php endforeach;?>
  <?php else:?>
	<tr>
    <td colspan = "6">No Data</td>     
  </tr>
  <?php endif;?>
</table>
			 
			 
	 

					
						
		