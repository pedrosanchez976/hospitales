<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Traspaso contrato</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">

<script type="text/javascript" src="funciones.js"></script>
<script type="text/javascript" >

    function validar(form)
	{
	   if(form.numHabitacion.value==""){
	         alert("Debe introducir el numero de habitacion");
	  		 form.numHabitacion.focus();
	   		 return false;
	    }
		
		if(form.numContrato.value==""){
	         alert("Debe introducir el numero de contrato");
	  		 form.numContrato.focus();
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
	
<form id="frm" name="frm" method="post" action="Respuesta.php?paginaactual=<?php echo $paginaactual ?>">

	<table width="400" border="0" align="center">
		  <tr class="elegiropcion"> <td> Traspaso contrato</td></tr>
	</table>

	<br>

	<table width="400" border="0" align="center">
		<tr>
			<td>
				<i>
				* El n&ordm; contrato origen puede hallarse en "estado contrataci&oacute;n" de la habitaci&oacute;n de origen.<br>
				* El contrato de la habitaci&oacute;n origen se cancela.<br>
				* Se genera un nuevo contrato para la habitaci&oacute;n destino. 
			</td>
		</tr>	
	</table>
	<br><br>

	<table width="400" border="0" align="center">
		<tr>
			<td>N&ordm; contrato origen</td>
			<td><input name="numContrato" type="text"  size="10"  onKeyPress="LP_data(event)"  > </td>
		</tr>
		
		<tr>
			<td>N&ordm; Habitaci&oacute;n destino </td>
			<td><input name="numHabitacion" type="text"  size="10" value=<?php echo $numHabitacion ?>  > </td>
			<td> <a href="SeleccionHabitacion.php?paginaactual=<?php echo $paginaactual ?>">Seleccionar habitación</a></td>
		</tr>    
	</table>

	<table width="400" border="0" align="center">     
		<tr> <td> <br /></td></tr>           
		<tr><td align="center"><INPUT TYPE=IMAGE SRC="../hospitales/images/btnEnviar.jpg" onClick="return validar(this.form)"/></td></tr>
    </table>

</form>

	
</body>

<?php include "_foot.inc";	?>
</html>
