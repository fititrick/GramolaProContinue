<?php

/*/* Abrimos la base de datos */

header("Content-Type: text/html;charset=utf-8");
include "conexion.php";	
session_start(); 
$nickpass=$_SESSION["nick"];

   
/* Realizamos la consulta SQL */

$consulta="SELECT * FROM users where nick=\"$nickpass\"";
$result=mysqli_query($conexion,$consulta) ;	

if (mysqli_num_rows($result)==0)die("No hay registros para mostrar");


/* Desplegamos cada uno de los registros dentro de una tabla */  
echo "<TABLE WIDTH='70%' height='50%' CELLPADDING='2' CELLSPACING='3' BORDER='1'   >";


/*Priemro los encabezados*/
 echo "<tr>
       <tr>
         <th> <font color='black'>Avatar  </font>  </th><th> <font color='black'>Nick </font>  </th>
         <th> <font color='black'>Email </font>  </th>
      </tr>";
	  
	  

/*Y ahora todos los registros */
while($array = mysqli_fetch_array($result) ) {

 echo "<tr>
         <td ROWSPAN='2' ALIGN=CENTER><img src='$array[imgPerfil]'  border='5%' height='80' width='80' /></td>
          
         <td height='45' width='200'><font color='black'> $array[nick] </font></td>
          
         <td height='45' width='200'><font color='black'> $array[email] </font></td>
               </tr>";
}
echo "</table>";



?>