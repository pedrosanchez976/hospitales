<?php

function clearSesion(){
	if(! isset($_SESSION))
		session_start();  //PEDRO

	unset($_SESSION["iduser"]);
	unset($_SESSION["usuario"]);
	unset($_SESSION["numHospitales"]);
	unset($_SESSION["idPerfil"]);

	unset($_SESSION["idhospital"]);
	unset($_SESSION["hospital"]);
	unset($_SESSION["rutaconexion"]);
	unset($_SESSION["ipHospital"]);
	unset($_SESSION["dominioHospital"]);

	unset($_SESSION["puceTcod"]);
	unset($_SESSION["modoEnvio"]);
	unset($_SESSION["ULTIMA_ACTIVIDAD"]);
	/**/
	unset($_SESSION["numHabitacion"]);
	unset($_SESSION["numHabitaciontraslado"]);

	unset($_SESSION);
	session_destroy();
}
?>
