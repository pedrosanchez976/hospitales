<?php

/*
ESTE FRAGMENTO DE CÓDIGO
accede a db hospitales.fdb para extraer los parámetros de conexión del hospital de destino al que queremos conectar
antes de la invocacion, setear en origen la variable $querySeleccionHospital, con el query a ejecutar

es usado desde 
	index.php
		$querySeleccionHospital='select h.idHospital, h.hospital, h.ip, h.dominio, h.puceTcod, h.modoEnvio, w.idPerfil '.
		' FROM WEB_IDUSER_HOSPITALES('.$iduser.') w, hospitales h '. 
		' where  w.IDHOSPITAL=h.IDHOSPITAL' ;

	resSeleccionHospital.php
		$querySeleccionHospital='select h.idHospital, h.hospital, h.ip, h.dominio, h.puceTcod, h.modoEnvio, w.idPerfil '.
	   ' FROM WEB_IDUSER_HOSPITALES('.$iduser.') w, hospitales h '. 
	   ' where h.idhospital='.$idhospital.' and w.IDHOSPITAL=h.IDHOSPITAL'


*/

if(! isset($_SESSION)) 
	session_start();  //PEDRO

require_once("_conexion.inc"); // por si acaso;; ya invocados en .php de origen de la llamada a este .php

//======================= End Calcular $rutaconexion ========================================	
$Q=ibase_query($conexionHospitalesFDB, $querySeleccionHospital);

//while ($R = ibase_fetch_object($Q)) {			
	$R = ibase_fetch_object($Q);  
	$_SESSION["idPerfil"] = $R->IDPERFIL;
	$_SESSION["hospital"] = utf8_encode($R->HOSPITAL);
	$_SESSION["ipHospital"] = (string)$R->IP;// PEDRO 26/03/2024
	$_SESSION["dominioHospital"] = (string)$R->DOMINIO;// PEDRO 26/03/2024
	$_SESSION["puceTcod"] = (string)$R->PUCETCOD;// PEDRO 14/05/2024
	$_SESSION["modoEnvio"] = (string)$R->MODOENVIO;// PEDRO 14/05/2024  'ws'

	$idhospital=$R->IDHOSPITAL;
	$_SESSION["idhospital"] = $idhospital;
//}	 
ibase_free_result($Q);  

//ibase_close($conexion);

//======================= Calcular $rutaconexion (Modificacion 27/02/2015) ========================================
//$dbusuario="SYSDBA";  YA ESTÁ EN _conexion.inc
//$dbpassword="hola";
$Q=ibase_query($conexionHospitalesFDB, "select RUTACONEXION FROM  web_rutaConexion(".$idhospital." )");
while ($R = ibase_fetch_object($Q)) {
	$rutaconexion=(string)$R->RUTACONEXION;			
	$conexion1 = ibase_connect($rutaconexion, $dbusuario, $dbpassword);			
	if ($conexion1){ 
		$_SESSION["rutaconexion"] = $rutaconexion; 
		break;
	} 		
}	
ibase_close($conexion1); 
ibase_free_result($Q);	



?>
