<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Traslado habitaci&oacute;n</title>
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
</head>

<body>
	
	<?php
	
	if(! isset($_SESSION))
		session_start();  //PEDRO
	include "_header.inc"; 
	$paginaactual = basename($_SERVER['PHP_SELF']);


	$numHabitacion='';
	$numHabitaciontraslado='';		 	
	$numenlace=0;


	
	if(isset($_POST['numenlace']) && $_POST['numenlace'] != ''){$numenlace=$_POST['numenlace']; }
	
	
	if(isset($_POST['habitaciones']) && $_POST['habitaciones'] != '')
	{
		if($numenlace==1)
		{
			$numHabitacion = $_POST['habitaciones'];
			$_SESSION["numHabitacion"]=$numHabitacion;
			$numHabitaciontraslado=$_SESSION["numHabitaciontraslado"];  
		
		}
		else if($numenlace==2)
		{
			$numHabitacion=$_SESSION["numHabitacion"];
			$numHabitaciontraslado = $_POST['habitaciones'];
			$_SESSION["numHabitaciontraslado"]=$numHabitaciontraslado;
		}
		else
		{
			$numHabitacion='';
			$numHabitaciontraslado='';
		}
	}

	if(isset($_POST['habitaciones2']) && $_POST['habitaciones2'] != '')
	{
		echo "<br>"."habitaciones2";
		$numHabitacion=$_SESSION["numHabitacion"];
		$numHabitaciontraslado = $_POST['habitaciones2'];
		$_SESSION["numHabitaciontraslado"]=$numHabitaciontraslado;
    }
	?>
	
<form id="frm" name="frm" method="post" action="Respuesta.php?paginaactual=<?php echo $paginaactual ?>">

	<table width="400" border="0" align="center">
		<tr class="elegiropcion"> <td> Traslado habitaci&oacute;n</td></tr>
		<tr> <td> <br /></td></tr>
	</table>


	<table width="400" border="0" align="center">

		<tr>
			<td>N&ordm; Habitaci&oacute;n Origen</td>
			<td><input name="numHabitacion" type="text"  size="10" value=<?php echo $numHabitacion ?>  > </td>
			<td> <a href="SeleccionHabitacion.php?numenlace=1&paginaactual=<?php echo $paginaactual ?>">Seleccionar habitación</a></td>
	
		</tr>
				
		<tr>
			<td>N&ordm; Habitaci&oacute;n destino </td>
			<td><input name="numHabitacionTraspaso" type="text"  size="10" value=<?php echo $numHabitaciontraslado ?>  > </td>
			<td> <a href="SeleccionHabitacion.php?numenlace=2&paginaactual=<?php echo $paginaactual ?>">Seleccionar habitación</a></td>
		</tr>
		
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
                 
	</table>

	<table width="300" border="0" align="center">     
		<tr> <td> <br /></td></tr>           
		<tr><td align="center"><INPUT TYPE=IMAGE SRC="../hospitales/images/btnEnviar.jpg" onClick="return validar(this.form)"/></td></tr>
    </table>

</form>

<?php include "_foot.inc";	?>
	
</body>


</html>
