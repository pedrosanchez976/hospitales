<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Seleccion hospital</title>


<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>

	<?php
		if(! isset($_SESSION))
			session_start();  //PEDRO
		//$iduser= $_SESSION["iduser"];

	    require("_conexion.inc");
	    include "_header.inc";
	?>

	<form id="frm" name="frm" method="post" action="ResSeleccionHospital.php">
		<br> 
		<table align="center" width="401" border="0">
			<tr>
				<td>
					<div align="left">Seleccione Hospital  </div>
				</td>
				<td colspan="2">
					<select  name="idhospital">	
					<?php
					try{
						//$Q=ibase_query($conexionHospitalesFDB, "SELECT idhospital,hospital FROM WEB_IDUSER_HOSPITALES(".$_SESSION["iduser"].") ORDER BY hospital ASC");
						$iduser=$_SESSION["iduser"];
						$Q=ibase_query($conexionHospitalesFDB, "SELECT idhospital,hospital FROM WEB_IDUSER_HOSPITALES($iduser) ORDER BY hospital ASC");
						while ($R = ibase_fetch_object($Q)) {
							echo "<option value=$R->IDHOSPITAL>".utf8_encode($R->HOSPITAL);
						}
						ibase_free_result($Q);  
						ibase_close($conexionHospitalesFDB);
						//throw new Exception('División por cero.');
					} catch (Exception $e){
						/*
						print ' <table width="300" border="0" align="center"> ';    
						print ' <tr> <td> <br /></td></tr>  ';      
						print ' <tr> <td> _conexion.inc: Error al conectar con la base de datos</td></tr> ';
						print ' <tr> <td>'. $e->getMessage().'</td></tr> ';*/
						header('Location:_error.php?error='. $e->getMessage()); 
						//die();
					} finally{}
					?> 
					</select>				  
				</td>
			</tr>
		</table>

		<br> 
		
	  	<table align="center" width="81" border="0">
		<tr>
		  <td colspan="2"><input type="submit" name="Submit" value="Enviar" /></td>
		</tr>
	  	</table>
	  
	</form>

	<?php
					
	include "_foot.inc";
	?>

</body>
</html>
