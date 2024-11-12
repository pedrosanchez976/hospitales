
<?php
		 $nombre= $_SESSION["nombre"];
		 $hospital= $_SESSION["hospital"];
?>		 

	<!--
	<table align="center" width="400" border="0">
	  <tr>
		<td colspan="2"><img src="images/cabecera.jpg" width="400" height="100" alt="Hospitales" </td>
	  </tr>
   </table>
   -->
   	 <table width="400" height="100" border="0" cellpadding="0" cellspacing="0" align="center" background="images/cabecera.jpg">
	   <tr>
	<!--	<td colspan="2"><div class="TituloPpal" align="center"> width=400px height=100px </div></td> -->
	  </tr>
    </table>
	
	    
	 <table width="400" border="0" align="center"cellpadding="0" cellspacing="0"  background="images/BienvenidoUsuario.jpg">
	   <tr>
		<td colspan="2"><div align="right" class="textoBienvenida" >Bienvenido : <?php echo utf8_encode($nombre) ?>  </div></td>
	  </tr>
	</table>

	 <table width="400" border="0" cellpadding="0" cellspacing="0" align="center">
	 <tr>
		 <td>
			<div class="imagenFondo"><span><?php echo utf8_encode($hospital) ?></span> 

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

