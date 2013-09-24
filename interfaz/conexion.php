<?php 
				//gramola.sytes.net
				$conexion=mysqli_connect("localhost", "gramolap_Gramola", "GramolaPro1");

				// Check connection
				if (mysqli_connect_errno($conexion))
				  {
				  echo "\n\nFailed to connect to MySQL: \n\n" . mysqli_connect_error();
  					} 
					else {
						mysqli_select_db($conexion, "gramolap_proyecto");
						}
  								
?>