<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=List Of 2nd Category". date('dmY_His').".xls" );
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

$worksheet1->write_string(0,0,'List of 2nd Sub Category',$title);  // Set Nama kolom
$worksheet1->set_column(0,1,10); // Set lebar kolom
$worksheet1->write_string(1,0,$pa,$title);  // Set Nama kolom
$worksheet1->set_column(0,1,10); // Set lebar kolom
$worksheet1->write_string(2,0,'No',$header);  // Set Nama kolom
$worksheet1->set_column(0,2,50); // Set lebar kolom
$worksheet1->write_string(2,1,'2nd Sub Category ID',$header);  // Set Nama kolom
$worksheet1->set_column(0,2,50); // Set lebar kolom 
$worksheet1->write_string(2,2,'2nd Sub Category',$header);  // Set Nama kolom
$worksheet1->set_column(0,2,50); // Set lebar kolom
$worksheet1->write_string(2,3,'Impact Level',$header);  // Set Nama kolom
$worksheet1->set_column(0,2,50); // Set lebar kolom
$worksheet1->write_string(2,4,'Likelihood Level',$header);  // Set Nama kolom
$worksheet1->set_column(0,2,50); // Set lebar kolom
$worksheet1->write_string(2,5,'Risk Level',$header);  // Set Nama kolom
$worksheet1->set_column(0,2,50); // Set lebar kolom
$worksheet1->write_string(3,0,'1',$content);
$worksheet1->write_string(3,1,$cc,$content);
$worksheet1->write_string(3,2,$cn,$content);
$worksheet1->write_string(3,3,$il,$content);
$worksheet1->write_string(3,4,$li,$content);
$worksheet1->write_string(3,5,$ri,$content);


$content =& $workbook->add_format();
$content->set_size(11);

$content->set_top(1); // set ketebalan border bagian atas cell 0 = border tidak tampil
$content->set_bottom(1); // set ketebalan border bagian atas cell 0 = border tidak tampil
$content->set_left(1); // set ketebalan border bagian atas cell 0 = border tidak tampil
$content->set_right(1); // set ketebalan border bagian atas cell 0 = border tidak tampil


$workbook->close();

/* 
 * Created by Pudyasto Adi Wibowo
 * Email : mr.pudyasto@gmail.com
 */


