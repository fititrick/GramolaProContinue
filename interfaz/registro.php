<?php
//Se comprueba que el POST recibe datos de usuario y contraseña.
if(isset($_POST['user']) && !empty($_POST['pass'])){
include "conexion.php";	
	//Archivo de conexion a la base de datos.
	
	//Los datos se pasan a variables para poder trabajar.
	$usuario=$_POST['user'];
	$contrasena=$_POST["pass"];
	$email=$_POST["email"];	
$usuario=mysqli_real_escape_string($conexion, $usuario);
$contrasena=mysqli_real_escape_string($conexion, hash('md5', $contrasena));
$email=mysqli_real_escape_string($conexion,$email);
	/*
		Se realiza la consulta sobre la base de datos para ver si existe o no ese usuario.
		En caso de que el numero de filas sea 0 se inserta sino se deshecha.
	*/
	$consulta = "SELECT nick FROM users where nick='$usuario'";
	$result=mysqli_query($conexion,$consulta) ;	
	if (mysqli_num_rows($result)==0){
			$resultado=mysqli_query($conexion,"INSERT INTO users (nick, pwd, email) values ('".$usuario."', '".$contrasena."','".$email."')") ;	
		 if (! $resultado){
		 		echo "Fail in data\n";
				exit();
			}
		 else{
		    //Se recoge los datos insertados en una lianea para despues poder crear la sesion.
			$consulta = "SELECT nick, pwd,idUser  FROM users where nick='$usuario'";
			$result=mysqli_query($conexion,$consulta) ;	
			if (! $result){
			  echo false;
				exit();
			}
			while( $row = mysqli_fetch_row($result) )
		    {
			   	//el 0 es el nick, el 1 la password
					//defino una sesion y guardo datos
					ini_set('session.cookie_httponly', 1);
					ini_set("session.cookie_lifetime",3600*24*30);// tiempo de vida de una cookie 
					ini_set("session.gc_maxlifetime",3600*24*30); // Tiempo de vida de las sesiones 
					session_start();
					$_SESSION["autentificado"]="SI";
					$_SESSION["nick"]=$row[0];
					$_SESSION["idUser"]=$row[2];
					//header("Location: principal.php");
					echo true;
				 
		      }
				
		  } 	
	}
	else {
		echo "<p>The user already exists</p>\n";
 		exit();
	}		 
	 
	include "close_conexion.php";
}
?>