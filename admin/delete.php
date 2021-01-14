<?php 
 require("../connection/config.php");
 $statment=$pdo->prepare("DELETE FROM posts WHERE id=".$_GET['id']);
 $statment->execute();
 header("Location:index.php");

 ?>