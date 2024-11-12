
	<?php

		if ( ! isset( $_SESSION['usuario'] ) ) {  // $_SESSION["usuario"]
			// Sesión inactiva  
			header('Location: ./'); // RETORNO A INDEX
		}

		$nombre= $_SESSION["usuario"];
		$hospital= $_SESSION["hospital"];

		header("Version: 24.05.25.a");

	?>		 

   	<table width="400" height="100" border="0" cellpadding="0" cellspacing="0" align="center" background="images/cabecera.jpg">
    </table>
	
	    
	<table width="400" border="0" align="center"cellpadding="0" cellspacing="0"  background="images/BienvenidoUsuario.jpg">
	<tr>
		<td colspan="2"><div align="left" class="textoBienvenida" >Bienvenido : <?php echo utf8_encode($nombre) ?>  </div></td>
		<td colspan="2"><div align="right" class="textoBienvenida" > <?php echo date("d/m/Y,  H:i:s").'h'; ?>    </div></td>
	</tr>
	</table>

	<table width="400" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td>
			<div class="imagenFondo"><span><?php echo $hospital ?></span> 
				<?php // pedro 21/06/2022
				if($_SESSION["numHospitales"]>1){
					echo '<img src="../hospitales/images/Hospital2.jpg"   width="400" height="59" border="0" usemap="#Map" />	';
				}
				else{
					echo '<img src="../hospitales/images/Hospital.jpg"   width="400" height="59" border="0" usemap="#Map" />	';
				}
				?>
			</div>
     	</td>
	<tr>
	</table>
	  

	<map name="Map" id="Map">

		<?php // pedro 21/06/2022, nuevo para retornar a seleccion hospital
		if($_SESSION["numHospitales"]>1){
			echo '<area shape="rect" coords="290,8,325,60" href="SeleccionHospital.php" />';
		}?>

		<area shape="rect" coords="330,8,360,60" href="index.php" />
		<area shape="rect" coords="365,8,400,60" href="Principal.php" />

	</map>
