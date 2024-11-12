<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>


<title>Seleccion de la habitacion</title>

<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script type="text/javascript" src="select_dependientes_habitaciones.js"></script>

</head>

<body>

<?php 
	if(! isset($_SESSION))
		session_start();  //PEDRO
	include "_header.inc"; 

	if(isset($_GET['paginaactual']) && $_GET['paginaactual'] != '') $paginaactual=$_GET['paginaactual'];   else    $paginaactual='';
	if(isset($_GET['numenlace'])    && $_GET['numenlace']    != '') $numenlace=$_GET['numenlace'];         else    $numenlace=0;

	//$rutaconexion=$_SESSION["rutaconexion"];
	include("_conexion2.inc");

		
	function generaPlantas()
	{
		// Voy imprimiendo el primer select compuesto por los plantas
		//$Q=ibase_query($GLOBALS['conexion'], "SELECT IDPLANTA,DENOMINACION FROM PLANTAS order by idplanta");
		global $conexion;// importa la variable '$conexion', de un scope superior
		$Q=ibase_query($conexion, "SELECT IDPLANTA,DENOMINACION FROM PLANTAS order by idplanta");
		
		echo "<select name='plantas' id='plantas' onChange='cargaContenido(this.id)'>";		
		echo "<option value='0'>Elige</option>";
		while ($R = ibase_fetch_object($Q)) 	
			echo "<option value='".$R->IDPLANTA."'>".utf8_encode($R->DENOMINACION)."</option>";						
			
		ibase_free_result($Q);	
		echo "</select>";
	}
?>


<form id="frmHabitacion" name="frmHabitacion" method="post" action="<?php echo $paginaactual ?>">


	<table align="center" width="400" border="0">
		<td> <input name="numenlace" type="hidden" value="<?php echo $numenlace ?>" /></td>
		<tr>
			<td >Seleccione una planta  </td> 
			<td ><?php generaPlantas();?></td>
		</tr>

		<tr>
			<td >Seleccione una habitacion  </td>>
			<td >
				<select disabled="disabled" name="habitaciones" id="habitaciones">
					<option value="0">Selecciona opci&oacute;n...</option>
				</select>  
			</td>					
		</tr>
	</table>

	<br>

	
   <table width="300" border="0" align="center">     
		<tr> <td> <br /></td></tr>           
		<tr><td align="center"><INPUT TYPE=IMAGE SRC="../hospitales/images/btnEnviar.jpg" onClick="return validar(this.form)"/></td></tr>
    </table>
  
  
</form>
 			  

<?php
include "_foot.inc";
?>	
</body>


</html>
