<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=daftar_action_plan". date('dmY_His').".xls" );
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

$worksheet1->write_string(0,4,'List Of Action Plan',$title);  // Set Nama kolom
$worksheet1->set_column(0,1,10); // Set lebar kolom
$worksheet1->write_string(1,4,$periode,$title);  // Set Nama kolom
$worksheet1->set_column(0,1,10); // Set lebar kolom
$worksheet1->write_string(4,0,'No.',$header);  // Set Nama kolom
$worksheet1->set_column(0,1,5); // Set lebar kolom
$worksheet1->write_string(4,1,'Ap. ID',$header);  // Set Nama kolom
$worksheet1->set_column(0,2,50); // Set lebar kolom 
$worksheet1->write_string(4,2,'Action Plan',$header);  // Set Nama kolom
$worksheet1->set_column(0,2,20); // Set lebar kolom
$worksheet1->write_string(4,3,'Due Date',$header);  // Set Nama kolom
$worksheet1->set_column(0,2,20); // Set lebar kolom
$worksheet1->write_string(4,4,'Action Plan Owner',$header);  // Set Nama kolom
$worksheet1->set_column(0,3,50); // Set lebar kolom
$worksheet1->write_string(4,5,'Risk ID',$header);  // Set Nama kolom
$worksheet1->set_column(0,4,50); // Set lebar kolom
$worksheet1->write_string(4,6,'Risk Event',$header);  // Set Nama kolom
$worksheet1->set_column(0,4,50); // Set lebar kolom
$worksheet1->write_string(4,7,'Risk Owner',$header);  // Set Nama kolom
$worksheet1->set_column(0,4,50); // Set lebar kolom
$worksheet1->write_string(4,8,'Impact Level',$header);  // Set Nama kolom
$worksheet1->set_column(0,4,50); // Set lebar kolom
$worksheet1->write_string(4,9,'Likelihood Level',$header);  // Set Nama kolom
$worksheet1->set_column(0,4,50); // Set lebar kolom
$worksheet1->write_string(4,10,'Risk Level',$header);  // Set Nama kolom
$worksheet1->set_column(0,4,50); // Set lebar kolom

$content =& $workbook->add_format();
$content->set_size(11);

$content->set_top(1); // set ketebalan border bagian atas cell 0 = border tidak tampil
$content->set_bottom(1); // set ketebalan border bagian atas cell 0 = border tidak tampil
$content->set_left(1); // set ketebalan border bagian atas cell 0 = border tidak tampil
$content->set_right(1); // set ketebalan border bagian atas cell 0 = border tidak tampil

$row = 5;
$i = 0;
//$worksheet1->write_string($row,0,  "Jumlah Risk: ".$rows."" ,$content);
if($rows>0){
	if($i < $rows){
		foreach ($data as $key) {
			$worksheet1->write_string($row,0,  $i+1 ,$content);
		    $worksheet1->write_string($row,1,  'Ap. ' . $key->id ,$content);
		    $worksheet1->write_string($row,2,  $key->action_plan ,$content);
		    $worksheet1->write_string($row,3,  $key->due_date ,$content);
		    $worksheet1->write_string($row,4,  $key->division ,$content);
		    $worksheet1->write_string($row,5,  $key->risk_code ,$content);
		    $worksheet1->write_string($row,6,  $key->risk_event ,$content);
		    $worksheet1->write_string($row,7,  $key->risk_owner ,$content);
		    $worksheet1->write_string($row,8,  $key->risk_impact_level ,$content);
		    $worksheet1->write_string($row,9,  $key->risk_likelihood_key ,$content);
		    $worksheet1->write_string($row,10,  $key->risk_level ,$content);
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


