<?php

	error_reporting(E_ALL);
	ini_set('display_errors', '0');
	
	//global $rutaconexion;
	//global $ipHospital; // PEDRO 26/03/2024

	$dbusuario="SYSDBA";
	$dbpassword="hola";
    
	//$conexion = ibase_connect($rutaconexion, $dbusuario, $dbpassword);
	$conexion = ibase_connect($_SESSION["rutaconexion"], $dbusuario, $dbpassword);
		
	if (!$conexion)
	{ 
		print ' <table width="300" border="0" align="center"> ';    
		print ' <tr> <td> <br /></td></tr>  ';      
		print ' <tr> <td> Error al conectar con la base de datos</td></tr> ';
	
		Exit;
	} 
	ini_set ('error_reporting', E_ALL & ~E_NOTICE);


?>