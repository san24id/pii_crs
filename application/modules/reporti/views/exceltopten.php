<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=daftar_top_ten_risk". date('dmY_His').".xls" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Pragma: public");

$workbook = new Workbook();
$worksheet1 =& $workbook->add_worksheet(date('dmY_His'));

$title =& $workbook->add_format();
$title->set_color('blue');
$title->set_size(16);

$header =& $workbook->add_format();
$header->set_color('blue'); // set warna huruf
//$header->set_border_color('red'); // set warna border

$header->set_size(11); // Set ukuran font 

$header->set_align("center"); // set align rata tengah

$header->set_top(2); // set ketebalan border bagian atas cell 0 = border tidak tampil
$header->set_bottom(2); // set ketebalan border bagian atas cell 0 = border tidak tampil
$header->set_left(2); // set ketebalan border bagian atas cell 0 = border tidak tampil
$header->set_right(2); // set ketebalan border bagian atas cell 0 = border tidak tampil

$worksheet1->write_string(0,4,'Top Ten Risk',$title);  // Set Nama kolom
$worksheet1->set_column(0,1,10); // Set lebar kolom
$worksheet1->write_string(2,0,'No.',$header);  // Set Nama kolom
$worksheet1->set_column(0,1,5); // Set lebar kolom
$worksheet1->write_string(2,1,'Risk ID',$header);  // Set Nama kolom
$worksheet1->set_column(0,2,50); // Set lebar kolom 
$worksheet1->write_string(2,2,'Risk Event',$header);  // Set Nama kolom
$worksheet1->set_column(0,2,20); // Set lebar kolom
$worksheet1->write_string(2,3,'Risk Description',$header);  // Set Nama kolom
$worksheet1->set_column(0,3,50); // Set lebar kolom
$worksheet1->write_string(2,4,'Risk Owner',$header);  // Set Nama kolom
$worksheet1->set_column(0,4,50); // Set lebar kolom
$worksheet1->write_string(2,5,'Impact Level',$header);  // Set Nama kolom
$worksheet1->set_column(0,4,50); // Set lebar kolom
$worksheet1->write_string(2,6,'Likelihood Level',$header);  // Set Nama kolom
$worksheet1->set_column(0,4,50); // Set lebar kolom
$worksheet1->write_string(2,7,'Risk Level',$header);  // Set Nama kolom
$worksheet1->set_column(0,4,50); // Set lebar kolom

$content =& $workbook->add_format();
$content->set_size(11);

$content->set_top(1); // set ketebalan border bagian atas cell 0 = border tidak tampil
$content->set_bottom(1); // set ketebalan border bagian atas cell 0 = border tidak tampil
$content->set_left(1); // set ketebalan border bagian atas cell 0 = border tidak tampil
$content->set_right(1); // set ketebalan border bagian atas cell 0 = border tidak tampil

$row = 3;
$i = 0;
//$worksheet1->write_string($row,0,  "Jumlah Risk: ".$rows."" ,$content);
if($rows>0){
	if($i < $rows){
		foreach ($data as $key) {
			$worksheet1->write_string($row,0,  $i+1 ,$content);
		    $worksheet1->write_string($row,1,  $key->risk_code ,$content);
		    $worksheet1->write_string($row,2,  $key->risk_event ,$content);
		    $worksheet1->write_string($row,3,  $key->risk_description ,$content);
		    $worksheet1->write_string($row,4,  $key->risk_owner ,$content);
		    $worksheet1->write_string($row,5,  $key->risk_impact_level ,$content);
		    $worksheet1->write_string($row,6,  $key->risk_likelihood_key ,$content);
		    $worksheet1->write_string($row,7,  $key->risk_level ,$content);
		    $row++;
		    $i++;
		}	
		
		$worksheet1->write_string($row,0,  "Jumlah Risk: ".$rows ,$content);
	}
}
else{
	$worksheet1->write_string($row,0,  "Jumlah Risk: ".$rows ,$content);
}


$workbook->close();

/* 
 * Created by Pudyasto Adi Wibowo
 * Email : mr.pudyasto@gmail.com
 */


