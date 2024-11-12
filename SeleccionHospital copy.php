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
		$iduser= $_SESSION["iduser"];
// si no existe sesión, reenviar a pagina de acreditacion user
		/*
		if($iduser=='')
		var urlHospital=<?php echo '"'.$_SESSION["ipHospital"].'"'?>;
		echo 'window.location.replace(_URL_+urlHospital)';
		*/
	    include("_conexion.inc");
	    include "_header.inc";
	
	
	    $Q=ibase_query("select count(idhospital) AS NUMHOSPITALES FROM WEB_IDUSER_HOSPITALES(".$iduser." )");
		while ($R = ibase_fetch_object($Q)) {
			$numHospitales=$R->NUMHOSPITALES;											
		}
	    ibase_free_result($Q);
			
		
		
		$i=0;
		$Q=ibase_query("select idhospital,hospital FROM WEB_IDUSER_HOSPITALES(".$iduser.") ORDER BY hospital ASC");
		while ($R = ibase_fetch_object($Q)) {
			$vIdHospital[$i]=(string)$R->IDHOSPITAL;     // contendra id
			$vNombreHospital[$i]=utf8_encode($R->HOSPITAL); // contendra nombre
			$i=$i+1;				
		}
		ibase_free_result($Q);  
		ibase_close($conexion);
	?>

	<form id="frm" name="frm" method="post" action="ResSeleccionHospital.php">
		<br> 
		<table align="center" width="401" border="0">
			<tr>
				<td>
					<div align="left">Seleccione Hospital</div>
				</td>
				<td colspan="2">
					<select  name="idhospital">	
					<?php
					 for ($i=0;$i<$numHospitales;$i++)                             
						echo utf8_encode("<option value=$vIdHospital[$i]>$vNombreHospital[$i]");
						
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
