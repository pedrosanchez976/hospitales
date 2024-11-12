<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Cabecera</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">

</head>

<body>
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
		<td colspan="2"><div align="right" class="textoBienvenida" >Bienvenido : <?php echo $nombre ?>           </div></td>
	  </tr>
</table>

	 <table width="400" border="0" cellpadding="0" cellspacing="0" align="center">
	 <tr><td>
       <div class="imagenFondo"><span><?php echo $hospital ?></span>
		 <img src="../hospitales/images/Hospital.jpg"   width="400" height="59" border="0" usemap="#Map" />	   </div>
     </td><tr>
</table>
	  

	<map name="Map" id="Map">
		<area shape="rect" coords="327,4,366,61" href="index.php" />
		<area shape="rect" coords="367,5,400,60" href="Principal.php" />
	</map>

</body>
</html>
