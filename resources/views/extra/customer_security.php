
<?php
  ob_start();
  session_start();
	 if(!isset($_SESSION['chk']))
	 {
	   header("location:index.php?chk=3");
	 } 
?>

