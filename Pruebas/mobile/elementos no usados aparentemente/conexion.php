<?php 
				header("Content-Type: text/html;charset=utf-8");
				//gramola.sytes.net
				$conexion=mysqli_connect("localhost", "gramolap_Gramola", "GramolaPro1");

				// Check connection
				if (mysqli_connect_errno($conexion))
				  {
				  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  					} 
					else {
						mysqli_select_db($conexion, "gramolap_proyecto");
						}
?>