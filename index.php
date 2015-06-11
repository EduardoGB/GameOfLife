<?php
include 'source/gol.php';
$data 		= array('2,2' => '2,2','3,3'=>'3,3','2,4'=>'2,4','2,5'=>'2,5','3,1'=>'3,1','4,2'=>'4,2');
$gol 		= new Gol_Source_Gol();
$response 	= $gol->Run($data);
echo "<p>Celdas vivas</p>";
echo json_encode($response);
?>
