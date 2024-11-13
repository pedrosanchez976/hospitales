<?php
	// Terminar la sesión:  //session_destroy();
	// eliminar un valor vinculado a la sesion:  unset($_SESSION["usuario"]);
	//// Eliminar todos los valores vinculados a la sesion:  session_unset();
	// if (!isset($_SESSION["usuario"]))

//session_unset();
/*session_start();
session_destroy();*/

try {
	date_default_timezone_set('Europe/Madrid');
	//Para que no se vean los WARNIG cuando se mete mal un usuario
	error_reporting(E_ALL);
	ini_set('display_errors', '0');

	require_once("_sesionManage.inc");
	clearSesion(); // _sesionManage.inc   REPONERRRRRRRRRRRRR


	//    https://psh.sytes.net/https/hospitales/?usuario=pedro&password=silvia976&idhospital=45
	$usuario=htmlspecialchars($_REQUEST['usuario']); 	// viene por GET o POST
	$password=htmlspecialchars($_REQUEST['password']);	// viene por GET o POST
	$idhospital_PARAM=$_REQUEST['idhospital'];			// viene por GET o POST : para redirigir a un hospital concreto, aunque el user tenga asociados varios hospitales
	//if (empty($usuario))
	//echo "usuario: ".$usuario;
	//throw new Exception('División por cero.');
} catch (Exception $e){
	/*
	print ' <table width="300" border="0" align="center"> ';    
	print ' <tr> <td> <br /></td></tr>  ';      
	print ' <tr> <td> _conexion.inc: Error al conectar con la base de datos</td></tr> ';
	print ' <tr> <td>'. $e->getMessage().'</td></tr> ';*/
	header('Location:_error.php?error='. $e->getMessage()); 
	//die();
} finally{}

try {
	if (isset($usuario) && isset($password))
	{
		//$_SESSION["usuario"] = $usuario;	REPONERRRRRRRRRRRRR
		require_once("_conexion.inc");

	// ------- HALLAR IDUSER para el user/passw recibido -----------	
		$Q=ibase_query($conexionHospitalesFDB, "EXECUTE PROCEDURE WEB_IDUSER ('$usuario' ,'$password')" );
		if (!$Q) echo ibase_errmsg();
		$iduser=ibase_fetch_object($Q)->IDUSER; // leemos solo el primer registro (esperamos solo uno) (ibase_fetch_object), no es necesario un while 		 			  	   	 
		ibase_free_result($Q);
		//$_SESSION["iduser"]= $iduser; // REPONERRRRRRRRRRRRR


// ------- HALLAR nº de hospitales asociados a user recibido -----------	
		//$idhospital_PARAM=35;
		$query= "SELECT count(*) AS NUMHOSPITALES FROM WEB_IDUSER_HOSPITALES($iduser) ";
		//if (!empty($idhospital_PARAM))
		if (isset($idhospital_PARAM))   // se invoco en la peticion http con parametro idhospital=x
			$query= $query." WHERE IDHOSPITAL=$idhospital_PARAM";
		
		$Q=ibase_query($conexionHospitalesFDB, $query);
		//$Q=ibase_query($conexionHospitalesFDB, "SELECT count(*) AS NUMHOSPITALES FROM WEB_IDUSER_HOSPITALES($iduser)");
		$numHospitales=ibase_fetch_object($Q)->NUMHOSPITALES; // resultado de un solo registro		
		ibase_free_result($Q);
		//$_SESSION["numHospitales"]= $numHospitales; // NUEVO PEDRO 21/06/2022		REPONERRRRRRRRRRRRR
	
		if($numHospitales>=1){
			//if(! isset($_SESSION)) 
			if (session_status() == PHP_SESSION_NONE)
				session_start();  //PEDRO

			$_SESSION["iduser"]= $iduser;
			$_SESSION["usuario"] = $usuario;
			$_SESSION["numHospitales"]= $numHospitales; // NUEVO PEDRO 21/06/2022
		}

		if($numHospitales==1)   
		{   
			//$Q=ibase_query("select * FROM WEB_IDUSER_HOSPITALES(".$iduser." )");
			$querySeleccionHospital="SELECT h.idHospital, h.hospital, h.ip, h.dominio, h.puceTcod, h.modoEnvio, w.idPerfil ".
			" FROM WEB_IDUSER_HOSPITALES($iduser) w, hospitales h ". 
			" WHERE w.IDHOSPITAL=h.IDHOSPITAL " ;
			if (isset($idhospital_PARAM))   // se invoco en la peticion http con parametro idhospital=x
				$querySeleccionHospital= $querySeleccionHospital." AND h.IDHOSPITAL=$idhospital_PARAM";
			require_once("_parametrosConexionHospital.inc");  //inserta código de seleccion de hospital 

			$siguienteWeb="Location:Principal.php";// redireccion a 'Principal.php'
		}
		else if($numHospitales>1)
		{
			$siguienteWeb="Location:SeleccionHospital.php"; // redireccion a 'SeleccionHospital.php'
		}

	} // if (($usuario!='') && ($password!=''))
}catch (Exception $e){

}finally{
	ibase_close($conexionHospitalesFDB);
	header($siguienteWeb); // redireccion
}

?>
