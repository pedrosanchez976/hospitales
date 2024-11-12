<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Respuesta Seleccion Hospital</title>
</head>

<body>

<?php

	if(! isset($_SESSION))
		session_start();  //PEDRO

   	$iduser=$_SESSION["iduser"];
   	$idhospital=$_POST["idhospital"]; 
	$_SESSION["idhospital"] = $idhospital;	
   
    //============== calcular $hospital ==================================================
	
	require_once("_conexion.inc");
   
   	//$Q=ibase_query("select * FROM WEB_IDUSER_HOSPITALES(".$iduser." ) where idhospital=".$idhospital );

	   $querySeleccionHospital='SELECT h.idHospital, h.hospital, h.ip, h.dominio, h.puceTcod, h.modoEnvio, w.idPerfil '.
	   ' FROM WEB_IDUSER_HOSPITALES('.$iduser.') w, hospitales h '. 
	   ' where h.idhospital='.$idhospital.' and w.IDHOSPITAL=h.IDHOSPITAL'
	   ;
	   require_once("_parametrosConexionHospital.inc");  //inserta código de seleccion de hospital 

	ibase_close($conexionHospitalesFDB);
	
	// redireccion a principal.php
	header("Location:Principal.php");

?>

</body>
</html>