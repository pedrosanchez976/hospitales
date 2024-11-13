


<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Hospitales</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">


</head>

<body>
<!--	<form action="index.php" method="post" name="login" > -->

	 
		<table width="400" height="100" border="0" align="center" background="images/cabecera.jpg">
		</table>
		
		<table width="400" border="0" align="center"cellpadding="0" cellspacing="0"  background="images/BienvenidoUsuario.jpg">
		<tr>
			<td colspan="2"><div align="right" class="textoBienvenida" > <?php echo date("d/m/Y,  H:i:s").'h'; ?>    </div></td>
		</tr>
		</table>

		<br><br>

		<table width="400" border="0" align="center">
		<tr class="elegiropcion"> <td> ERROR: </td></tr>	
		<tr > <td> <?php echo($_REQUEST['error'])?> </td></tr>	
		</table>

		<br>

		<table align="center" width="300" border="0">
			<!-- 
			<tr>
				<td align="right">Usuario</td>
				<td align="center" >
					<input type="text" name="usuario" id="textfield1"> 
				</td>
			</tr>
			<tr>
				<td align="right">Contrase&ntilde;a</td>
				<td align="center">
					<input type="password" name="password" id="textfield2" >    
				</td>
			</tr>
		  -->
		  	<tr><td> <br> </td></tr>
		  
			<tr>
				<td colspan="2" align="center">
					<input type="submit" name="button" id="button" value="Reiniciar" onclick="window.location.href='index.php';">    
				</td>
			</tr>

			<tr><td> <br> </td></tr>
		</table>

	
<?php
include "_foot.inc";
?>
</body>
</html>