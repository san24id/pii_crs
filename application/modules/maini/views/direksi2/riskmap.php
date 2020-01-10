<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <table class="responsive table table-striped table-bordered table-hover" width="100%" border="1" cellspacing="1" cellpadding="1" style="font-size: 10px;"> 
        <tr>
          <th><br></th>
          <th colspan="5"><div align="center"><h3><b>KEMUNGKINAN TERJADI</b></h3></div></th>
        </tr>
        <tr>
        <th><h3 align="center"><b>DAMPAK RISIKO</b></h3></th>
        <td height="20">
        <div align="center">
          <br><br><strong>SANGAT RENDAH</strong><br>
        </div></td>
    <td>
    <div align="center"><br><br><strong>RENDAH</strong></div></td>
    <td>
    <div align="center"><br><br><strong>SEDANG</strong></div></td>
    <td>
    <div align="center"><br><br><strong>TINGGI</strong></div></td>
    <td>
    <div align="center"><br><br><strong>SANGAT TINGGI</strong></div></td>
  </tr>
  
  <?php if($dashboardRiskMap):?>
  <?php $i = 1;?>
  <?php foreach($dashboardRiskMap as $row):?>
   
  <?php if($i ==1):?>
  <tr>
    <td><div align="right"><strong>CATASTROPHIC</strong><br>
    </div></td>
    <td bgcolor = "ffff80"><strong><?php echo $row->Very_Low;?></strong></td>
    <td bgcolor = "ffff80"><strong><?php echo $row->Low;?></strong></td>
    <td bgcolor = "#FFA07A"><strong><?php echo $row->Medium;?></strong></td>
    <td bgcolor = "#FFA07A"><strong><?php echo $row->High;?></strong></td>
    <td bgcolor = "#FFA07A"><strong><?php echo $row->Very_High;?></strong></td>

  </tr>
  <?php endif;?>
  <?php if($i ==2):?>
  <tr>
    <td><div align="right"><strong>MAYOR</strong><br>
    </div></td>
    <td bgcolor = "#90EE90"><strong><?php echo $row->Very_Low;?></strong></td>
    <td bgcolor = "ffff80"><strong><?php echo $row->Low;?></strong></td>
    <td bgcolor = "#FFA07A"><strong><?php echo $row->Medium;?></strong></td>
    <td bgcolor = "#FFA07A"><strong><?php echo $row->High;?></strong></td>
    <td bgcolor = "#FFA07A"><strong><?php echo $row->Very_High;?></strong></td>
  </tr>
  <?php endif;?>
  <?php if($i ==3):?>
  <tr>
    <td><div align="right"><strong>MODERATE</strong><br>
    </div></td>
    <td bgcolor = "#90EE90"><strong><?php echo $row->Very_Low;?></strong></td>
    <td bgcolor = "ffff80"><strong><?php echo $row->Low;?></strong></td>
    <td bgcolor = "ffff80"><strong><?php echo $row->Medium;?></strong></td>
    <td bgcolor = "#FFA07A"><strong><?php echo $row->High;?></strong></td>
    <td bgcolor = "#FFA07A"><strong><?php echo $row->Very_High;?></strong></td>
  </tr>
  <?php endif;?>
  
  <?php if($i ==4):?>
  <tr>
    <td><div align="right"><strong>MINOR</strong><br>
    </div></td>
    <td bgcolor = "#90EE90"><strong><?php echo $row->Very_Low;?></strong></td>
    <td bgcolor = "#90EE90"><strong><?php echo $row->Low;?></strong></td>
    <td bgcolor = "ffff80"><strong><?php echo $row->Medium;?></strong></td>
    <td bgcolor = "ffff80"><strong><?php echo $row->High;?></strong></td>
    <td bgcolor = "#FFA07A"><strong><?php echo $row->Very_High;?></strong></td>
  </tr>
  <?php endif;?>

  <?php if($i ==5):?>
  <tr>
    <td><div align="right"><strong>INSIGNIFICANT</strong><br>
    </div></td>
    <td bgcolor = "#90EE90"><strong><?php echo $row->Very_Low;?></strong></td>
    <td bgcolor = "#90EE90"><strong><?php echo $row->Low;?></strong></td>
    <td bgcolor = "#90EE90"><strong><?php echo $row->Medium;?></strong></td>
    <td bgcolor = "ffff80"><strong><?php echo $row->High;?></strong></td>
    <td bgcolor = "#FFA07A"><strong><?php echo $row->Very_High;?></strong></td>
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