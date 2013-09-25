<?php
header("Content-Type: text/html;charset=utf-8");
if(isset($_POST['user']) && !empty($_POST['pass']) && !empty($_POST['user'])){
include "conexion.php";	
	$usuario=$_POST['user'];
	$contrasena=$_POST['pass'];
	$usuario2=mysqli_real_escape_string($conexion,$usuario);
	$contrasena=mysqli_real_escape_string($conexion,hash('md5', $contrasena));
	$consulta ="SELECT nick, pwd,idUser  FROM users where nick='$usuario' and pwd='$contrasena'";
	$result=mysqli_query($conexion, $consulta) ;
	if (mysqli_num_rows($result)==0){
	  echo 0;
		//echo "User: $usuario not exist";
		/*try {
        	throw new Exception("User: $usuario not exist");
		    } catch (ErrorException $e) {
		        // este bloque no se ejecuta, no coincide el tipo de excepción
		        echo 'ErrorException ' . $e->getMessage();
		    } catch (Exception $e) {
		        // este bloque captura la excepción
		        echo 'Exception ' . $e->getMessage();
		    }*/
		//die('ERROR');
    //  or:
        //die(json_encode(array('message' => 'ERROR', code => 1337)));
	}
	if(mysqli_num_rows($result)==1){
		while( $row = mysqli_fetch_row($result) )
	    {
		   	//el 0 es el nick, el 1 la password
		     
				//defino una sesion y guardo datos
				ini_set('session.cookie_httponly', 1);
				ini_set("session.cookie_lifetime",3600*24*30);// tiempo de vida de una cookie 
				ini_set("session.gc_maxlifetime",3600*24*30); // Tiempo de vida de las sesiones 
				
				//setcookie("GRAMOLA-PROJECT","GRAMOLA-PROJECT",time()+3600*24*365*100,"gramolapro.com",1) ; 
				session_start();
				$_SESSION['fingerprint'] = md5($_SERVER['HTTP_USER_AGENT']);
				$_SESSION["autentificado"]="SI";
				$_SESSION["nick"]=$row[0];
				$_SESSION["idUser"]=$row[2];
				//$_SESSION["N_linksEnLista"]=0;
				//header("Location: principal.php");
				$variable=$_SESSION["nick"];
				$_SESSION["NList"]=0;
				$_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s"); //Guardo los datos del último acceso a la web
				echo 1;
			 
	      }
	}
	include "close_conexion.php";
}
else {
	echo $_POST['user'];
}
?>
