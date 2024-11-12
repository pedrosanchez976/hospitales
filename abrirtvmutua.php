<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Activación TV Admisión</title>

<link rel="stylesheet" type="text/css" href="stylesheet.css">

<script type="text/javascript" src="funciones.js"></script>
<script type="text/javascript" >

    function validar(form)
	{
	   if(form.numHabitacion.value==""){
	         alert("Debe introducir el número de habitación");
	  		 form.numHabitacion.focus();
	   		 return false;
	    }
			
	    if(form.comentario.value==""){
	         alert("Debe introducir un comentario");
	         form.comentario.focus();
	        return false;
	    }	
		
			
	    if((form.numDia.value=="")||(form.numDia.value=="0")){
	         alert("Debe introducir un número de dias válido");
	         form.numDia.focus();
	        return false;
	    }	
		
	}
	


	radioItemClick= function (radioItem){
		document.getElementById("comentario").value=radioItem.getAttribute("texto");
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
	
	<table width="398" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr><td>
		<table width="400" border="0" align="center">
			<tr class="elegiropcion"> <td> Activación TV Admisión</td></tr>
		</table>


		<form id="frm" name="frm" method="post" action="Respuesta.php?paginaactual=<?php echo $paginaactual ?>">
		
			<table width="400" border="0" align="center">

				<tr>
					<td>Habitaci&oacute;n </td>
					<td><input name="numHabitacion" type="text"  size="10" value=<?php echo $numHabitacion ?>  > </td>
					<td> <a href="SeleccionHabitacion.php?paginaactual=<?php echo $paginaactual ?>">Seleccionar habitación</a></td>
				</tr>

				<br>
				
				<tr>
					<td colspan="5">
					<!-- Añadir grupo de opciones-->
					<fieldset>  
							<input type="radio" name="motivomutua" value="m" onclick="radioItemClick(this);" texto="Mutua/Sanitas"checked="checked" > Mutua/Sanitas<br/></input>
							<input type="radio" name="motivomutua" value="p" onclick="radioItemClick(this);" texto="Privado"> Privado<br/></input>
							<input type="radio" name="motivomutua" value="v" onclick="radioItemClick(this);" texto="Vip"> Vip<br/></input>
							<input type="radio" name="motivomutua" value="o" onclick="radioItemClick(this);" texto="Covid"> Covid</input>
					</fieldset>
					</td>
				</tr>
				
				<br>
				
				<tr>
					<td>N&ordm; D&iacute;as</td>
					<td><input name="numDia" type="text" onkeypress="LP_data(event)" size="10" value="3"/></td>
				</tr>
				
				<br>

				<tr><td>Comentario</td></tr>
				<tr>
					<td colspan="5">  
						<input type="text" id="comentario" name="comentario" size="53" value='Mutua/Sanitas'/> 
					</td>
				</tr>
						
			</table>

			<br>

			<table width="400" border="0" align="center">  
				<tr><td align="center"><INPUT TYPE=IMAGE SRC="../hospitales/images/btnEnviar.jpg" onClick="return validar(this.form)"/></td></tr>
			</table>

		</form>
	</td></tr>
	</table>

<?php include "_foot.inc";	?>
	
</body>


</html>
