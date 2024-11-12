<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Ejecutar comando</title>
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
			
	    if(form.comentario.value==""){
	         alert("Debe introducir un comentario");
	         form.numHabitacion.focus();
	        return false;
	    }	
		
	}
	
</script>

<?php 
	if(! isset($_SESSION))
		session_start();  //PEDRO
	
	$paginaactual = basename($_SERVER['PHP_SELF']);

	if(isset($_POST['habitaciones']) && $_POST['habitaciones'] != ''){         
		$numHabitacion = $_POST['habitaciones'];}
	else
		$numHabitacion='';

	include "_header.inc"; 
?>

</head>

<body>
	<table width="400" border="0" align="center">
		<tr class="elegiropcion"> <td> Ejecutar comando</td></tr>
	</table>

	<br>


<form id="frm" name="frm" method="post" action="Respuesta.php?paginaactual=<?php echo $paginaactual ?>">
 
	<table width="400" border="0" align="center">
		<tr>
			<td>N&ordm; Habitaci&oacute;n </td>
			<td><input name="numHabitacion" type="text"  size="10" value=<?php echo $numHabitacion ?>  > </td>
			<td> <a href="SeleccionHabitacion.php?paginaactual=<?php echo $paginaactual ?>">Seleccionar habitación</a></td>
		</tr>
		
		<br> 
		<tr>
			<td colspan="5">
			<!-- A�adir grupo de opciones-->
			<fieldset>            
			<p>  
				<input type="radio" name="ejecutarcomando" value="1"> reset tv / wsocket<br/>
				<input type="radio" name="ejecutarcomando" value="2"> reset micro / sdap<br/>
				<input type="radio" name="ejecutarcomando" value="3"> apagar tv<br/>
				<input type="radio" name="ejecutarcomando" value="4"> encender tv</p>
			</fieldset>
			</td>
		</tr>		 
                 
	</table>

	<br> 

	<table width="300" border="0" align="center">     
		<tr><td align="center"><INPUT TYPE=IMAGE SRC="../hospitales/images/btnEnviar.jpg" onClick="return validar(this.form)"/></td></tr>
    </table>

</form>

<?php include "_foot.inc";	?>
	
</body>
</html>
