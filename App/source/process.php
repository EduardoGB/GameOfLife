<?php
include 'life.php';
session_start();
$world = ($_GET['celds']) ? $_GET['celds'] : $_SESSION['celds'];
$gol= new GameOfLife_Source_Life($world);
echo $gol->run();
?>
