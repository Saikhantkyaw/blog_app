<?php 
$option=array(
				PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION

             );

$pdo = new PDO ("mysql:host=localhost;dbname=blog","saiblog","saiblog1551",$option);
 ?>