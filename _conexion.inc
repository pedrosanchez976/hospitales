<?php
// https://programadorphp.es/docs/php_manual_espanol/ref.ibase.html

	//global $conexion;
try{
	$dbusuario="SYSDBA";
	$dbpassword="hola";

	//$dbHospitales = 'localhost:C:/tv/HOSPITALES.FDB'; 
	$dbHospitales = 'localhost/3050:D:/movialnorte/Televisores/DBs/hospitales.fdb';
	// $dbHospitales = '213.96.32.27:C:/tv/Figueras1.fdb'; 			 // FUNCIONA
	// $dbHospitales = '87.216.168.163/3051:C:/tv/montpellier1.fdb';  // FUNCIONA

//	$conexion = ibase_pconnect($dbHospitales, $dbusuario, $dbpassword);				
	$conexionHospitalesFDB = ibase_connect($dbHospitales, $dbusuario, $dbpassword);			
	if (!$conexionHospitalesFDB)
	{ 
		print ' <table width="300" border="0" align="center"> ';    
		print ' <tr> <td> <br /></td></tr>  ';         
		print ' <tr> <td> Error al conectar con la base de datos</td></tr> ';
		Exit;
	} 
	ini_set ('error_reporting', E_ALL & ~E_NOTICE);
} catch (Exception $e){
		print ' <table width="300" border="0" align="center"> ';    
		print ' <tr> <td> <br /></td></tr>  ';      
		print ' <tr> <td> _conexion.inc: Error al conectar con la base de datos</td></tr> ';
		print ' <tr> <td>'. $e->getMessage().'</td></tr> ';
		
		die();
} finally{}
  
?>