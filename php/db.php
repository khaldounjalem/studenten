<?php 
// $con = mysqli_connect("localhost", "root", "", "wptesten");
 //$con = mysqli_connect("localhost", "jalemora_wpfri", "WSp2u]523-", "jalemora_wpfri");	
	//if (mysqli_connect_errno()) {
	//	die ("MySQL-Fehler: ".mysqli_connect_error());
	//}
//mysqli_set_charset($con,"utf8");

?>


<?php
 $con=mysqli_connect("localhost","root","","authuser");
// $con = mysqli_connect("localhost", "jalemora_wpfri", "WSp2u]523-", "jalemora_wpfri");	
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit;
}

//echo "Initial character set is: " . mysqli_character_set_name($con);

// Change character set to utf8
mysqli_set_charset($con,"utf8");

//echo "Current character set is: " . mysqli_character_set_name($con);

//mysqli_close($con);
?>
