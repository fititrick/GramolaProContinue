<?php
header("Content-Type: text/html;charset=utf-8");
include "conexion.php";	
session_start(); 
$nickpass=$_SESSION["nick"];

	

	$consulta ="SELECT imgPerfil FROM users where nick=\"$nickpass\" ";	
	$result=mysqli_query($conexion, $consulta) ;
	if (mysqli_num_rows($result)==1){
		while( $row = mysqli_fetch_row($result) ){
			echo '<div>Welcome '.$nickpass.'</div><img class="imagePerfil" src="'.$row[0].'" alt="Profile"/>';
		}
	}
	
	

	include "close_conexion.php";

?>