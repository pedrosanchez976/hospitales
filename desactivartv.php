<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Cerrar TV</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">

	<script type="text/javascript" src="funciones.js"></script>
	<script type="text/javascript" >

		function validar(form){
			if(form.numHabitacion.value==""){
				alert("Debe introducir el numero de habitacion");
				form.numHabitacion.focus();
				return false;
			}	
		}
		
	</script>
</head>

<body>
	
	<?php
	if(! isset($_SESSION))
		session_start();  //PEDRO
	include "_header.inc"; 
	
	$paginaactual = basename($_SERVER['PHP_SELF']);

	if(isset($_POST['habitaciones']) && $_POST['habitaciones'] != ''){         
		 $numHabitacion = $_POST['habitaciones'];}
	else
		$numHabitacion='';
	?>
	
	<table width="400" border="0" align="center">
		  <tr class="elegiropcion"> <td> Cerrar TV</td></tr>
		  <tr> <td> <br /></td></tr>
	</table>
	

	<form id="frm" name="frm" method="post" action="Respuesta.php?paginaactual=<?php echo $paginaactual ?>">
		<table width="400" border="0" align="center">
			<tr>
				<td>N&ordm; Habitaci&oacute;n </td>
				<td><input name="numHabitacion" type="text"  size="10" value=<?php echo $numHabitacion ?>  > </td>
				<td> <a href="SeleccionHabitacion.php?paginaactual=<?php echo $paginaactual ?>">Seleccionar habitación</a></td>
			</tr>	
		</table>

		<table width="300" border="0" align="center">     
			<tr> <td> <br /></td></tr>           
			<tr><td align="center"><INPUT TYPE=IMAGE SRC="../hospitales/images/btnEnviar.jpg" onClick="return validar(this.form)"/></td></tr>
		</table>
	</form>

<?php include "_foot.inc";	?>
	
</body>

</html>
