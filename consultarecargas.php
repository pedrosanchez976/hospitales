<!DOCTYPE html>
<html> 
<head>
<!--
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />

-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Consulta recargas</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">

<script type="text/javascript" src="funciones.js"></script>

</head>

<body>
<?php
	if(! isset($_SESSION))
		session_start();  //PEDRO

	include "_header.inc"; 
	include("_conexion2.inc");

/////////////////////////////////////////////////////////////////////////////////////
////////////////////////  CONSULTA DE RECARGA /////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
?>

<table width="400" border="0" align="center">
	<tr class="elegiropcion"> <td> Consulta recarga de monedas</td></tr>
	<tr> <td> <br /></td></tr>
</table>

<br>

<table width="400" border="0" align="center">  
 <?php
  $Q = ibase_query("select * from  WEB_CONSULTARECARGAS"); 	 
	if (!$Q)
	echo ibase_errmsg();

	while ($o = ibase_fetch_object($Q))
		echo '<tr><td>'.utf8_encode($o->CADENA).'</tr></td>';

	ibase_close($conexion);
?>
</table>

<?php include "_foot.inc";	?>
</body>

</html>
