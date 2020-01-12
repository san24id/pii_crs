<?php

if( $_POST ){
	
	$divisi =  $_POST['divisi_risk'];
	
}

	$sql  = "select * from m_division where division_id = '".$divisi."'";
	$query = $this->db->query($sql);
	$row = $query->row();
?>
	
<?php if($divisi == '-' || $divisi == ''){ ?>
						<div class="row">
			<div class="col-xs-12" style="padding-right:15px; padding-left: 0px;">
             <div style="background-color:#f2f2f2;box-shadow: 0px 5px 15px 10px #595959;">
            <div style="background-color:#A9A9A9; border: 5px #999999 solid;"> <p style="color:white;  font-size: 16px; margin-left: 20px; margin-top: 5px;" align="left"><b>IIGF RISK - by Risk Level</b></div>
             <div style="background-color:#f2f2f2;"> <span style="font-size: 16px"><center><b>ALL Division</b></center></span></div>
							<object align="center" frameborder="no" name="frame1" scrolling="no" data="<?php echo base_url(); ?>/index.php1/pii_pie2/direksirac_risk.php" style="border: 0px solid;" width="100%" height="290"></object>
					</div>
					</div>
					</div>

					<div class="row">
			<div class="col-xs-12" style="padding-right:15px; padding-left: 0px; padding-top: 10px;">
             <div style="background-color:#f2f2f2;box-shadow: 0px 5px 15px 10px #595959;">
            <div style="background-color:#A9A9A9; border: 5px #999999 solid;"> <p style="color:white;  font-size: 16px; margin-left: 20px; margin-top: 5px;" align="left"><b>IIGF RISK - by Risk Status</b></div>
             <div style="background-color:#f2f2f2;"> <span style="font-size: 16px"><center><b>ALL Division</b></center></span></div>
						<object align="center" frameborder="no" name="frame1" scrolling="no" data="<?php echo base_url(); ?>/index.php1/pii_pie2/indexstrac.php" style="border: 0px solid;" width="100%" height="290"></object>
					</div>
					</div>
					</div>
<?php }else{ 
		if($divisi == 'D-CFO'){?>
		<div class="row">
			<div class="col-xs-12" style="padding-right:15px; padding-left: 0px;">
            <div style="background-color:#f2f2f2;box-shadow: 0px 5px 15px 10px #595959;">
            <div style="background-color:#A9A9A9; border: 5px #999999 solid;"> <p style="color:white;  font-size: 16px; margin-left: 20px; margin-top: 5px;" align="left"><b>IIGF RISK - by Risk Level</b></div>
             <div style="background-color:#f2f2f2;"> <span style="font-size: 16px"><center><b><?php echo $row->division_name; ?></b></center></span></div>
							<object align="center" frameborder="no" name="frame1" scrolling="no" data="<?php echo base_url(); ?>/index.php1/pii_pie2/direksicfo_risk.php" style="border: 0px solid;" width="100%" height="290"></object>
					</div>
					</div>
		</div>
		<div class="row">
			<div class="col-xs-12" style="padding-right:15px; padding-left: 0px; padding-top: 10px;">
            <div style="background-color:#f2f2f2;box-shadow: 0px 5px 15px 10px #595959;">
            <div style="background-color:#A9A9A9; border: 5px #999999 solid;"> <p style="color:white;  font-size: 16px; margin-left: 20px; margin-top: 5px;" align="left"><b>IIGF RISK - by Risk Status</b></div>
             <div style="background-color:#f2f2f2;"> <span style="font-size: 16px"><center><b><?php echo $row->division_name; ?></b></center></span></div>
						<object align="center" frameborder="no" name="frame1" scrolling="no" data="<?php echo base_url(); ?>/index.php1/pii_pie2/indexstcfo.php" style="border: 0px solid;" width="100%" height="290"></object>
					</div>
					</div>
		</div>
	<?php 
	}else if($divisi == 'D-CEO'){?>
		<div class="row">
			<div class="col-xs-12" style="padding-right:15px; padding-left: 0px;">
            <div style="background-color:#f2f2f2;box-shadow: 0px 5px 15px 10px #595959;">
            <div style="background-color:#A9A9A9; border: 5px #999999 solid;"> <p style="color:white;  font-size: 16px; margin-left: 20px; margin-top: 5px;" align="left"><b>IIGF RISK - by Risk Level</b></div>
             <div style="background-color:#f2f2f2;"> <span style="font-size: 16px"><center><b><?php echo $row->division_name; ?></b></center></span></div>
							<object align="center" frameborder="no" name="frame1" scrolling="no" data="<?php echo base_url(); ?>/index.php1/pii_pie2/direksiceo_risk.php" style="border: 0px solid;" width="100%" height="290"></object>
					</div>
					</div>
		</div>
		<div class="row">
			<div class="col-xs-12" style="padding-right:15px; padding-left: 0px; padding-top: 10px;">
            <div style="background-color:#f2f2f2;box-shadow: 0px 5px 15px 10px #595959;">
            <div style="background-color:#A9A9A9; border: 5px #999999 solid;"> <p style="color:white;  font-size: 16px; margin-left: 20px; margin-top: 5px;" align="left"><b>IIGF RISK - by Risk Status</b></div>
             <div style="background-color:#f2f2f2;"> <span style="font-size: 16px"><center><b><?php echo $row->division_name; ?></b></center></span></div>
						<object align="center" frameborder="no" name="frame1" scrolling="no" data="<?php echo base_url(); ?>/index.php1/pii_pie2/indexstceo.php" style="border: 0px solid;" width="100%" height="290"></object>
					</div>
					</div>
		</div>
	<?php 
	}else if($divisi == 'D-COO'){?>
		<div class="row">
			<div class="col-xs-12" style="padding-right:15px; padding-left: 0px;">
            <div style="background-color:#f2f2f2;box-shadow: 0px 5px 15px 10px #595959;">
            <div style="background-color:#A9A9A9; border: 5px #999999 solid;"> <p style="color:white;  font-size: 16px; margin-left: 20px; margin-top: 5px;" align="left"><b>IIGF RISK - by Risk Level</b></div>
             <div style="background-color:#f2f2f2;"> <span style="font-size: 16px"><center><b><?php echo $row->division_name; ?></b></center></span></div>
							<object align="center" frameborder="no" name="frame1" scrolling="no" data="<?php echo base_url(); ?>/index.php1/pii_pie2/direksicoo_risk.php" style="border: 0px solid;" width="100%" height="290"></object>
					</div>
					</div>
		</div>
		<div class="row">
			<div class="col-xs-12" style="padding-right:15px; padding-left: 0px; padding-top: 10px;">
            <div style="background-color:#f2f2f2;box-shadow: 0px 5px 15px 10px #595959;">
            <div style="background-color:#A9A9A9; border: 5px #999999 solid;"> <p style="color:white;  font-size: 16px; margin-left: 20px; margin-top: 5px;" align="left"><b>IIGF RISK - by Risk Status</b></div>
             <div style="background-color:#f2f2f2;"> <span style="font-size: 16px"><center><b><?php echo $row->division_name; ?></b></center></span></div>
						<object align="center" frameborder="no" name="frame1" scrolling="no" data="<?php echo base_url(); ?>/index.php1/pii_pie2/indexstcoo.php" style="border: 0px solid;" width="100%" height="290"></object>
					</div>
					</div>
		</div>
	<?php 
		}else{
	?>
		<div class="row">
			<div class="col-xs-12" style="padding-right:15px; padding-left: 0px;">
            <div style="background-color:#f2f2f2;box-shadow: 0px 5px 15px 10px #595959;">
            <div style="background-color:#A9A9A9; border: 5px #999999 solid;"> <p style="color:white;  font-size: 16px; margin-left: 20px; margin-top: 5px;" align="left"><b>IIGF RISK - by Risk Level</b></div>
             <div style="background-color:#f2f2f2;"> <span style="font-size: 16px"><center><b><?php echo $row->division_name; ?></b></center></span></div>
							<object align="center" frameborder="no" name="frame1" scrolling="no" data="<?php echo base_url(); ?>/index.php1/pii_pie2/direksirac_risk_div.php?div=<?php echo $divisi; ?>" style="border: 0px solid;" width="100%" height="290"></object>
					</div>
					</div>
					</div>
					<div class="row">
			<div class="col-xs-12" style="padding-right:15px; padding-left: 0px; padding-top: 10px;">
            <div style="background-color:#f2f2f2;box-shadow: 0px 5px 15px 10px #595959;">
            <div style="background-color:#A9A9A9; border: 5px #999999 solid;"> <p style="color:white;  font-size: 16px; margin-left: 20px; margin-top: 5px;" align="left"><b>IIGF RISK - by Risk Status</b></div>
             <div style="background-color:#f2f2f2;"> <span style="font-size: 16px"><center><b><?php echo $row->division_name; ?></b></center></span></div>
						<object align="center" frameborder="no" name="frame1" scrolling="no" data="<?php echo base_url(); ?>/index.php1/pii_pie2/indexstrac_div.php?div=<?php echo $divisi; ?>" style="border: 0px solid;" width="100%" height="290"></object>
					</div>
					</div>
					</div>
<?php }} ?>
