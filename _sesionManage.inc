<?php

	function clearSesion(){
		//Para manipular una sesión en PHP, siempre debes asegurarte de que la sesión esté activa.
		//if(! isset($_SESSION))
		if (session_status() == PHP_SESSION_NONE)
		//if (session_status() == PHP_SESSION_NONE)  ERRORRRRRRRRRRRRRRRRRRRRR
			session_start();  //PEDRO

/*
		
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
		
		unset($_SESSION["numHabitacion"]);
		unset($_SESSION["numHabitaciontraslado"]);
*/
		unset($_SESSION);

		//session_unset(); // NUEVO 12/11/2024 // Vaciar todas las variables de sesión  ERRORRRRRRRRR

		// DESTRUIR COOKIES: Borra la cookie de sesión en el navegador. // NUEVO 12/11/2024
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], 
				$params["domain"], 
				$params["secure"], 
				$params["httponly"]
			);
		}
		session_destroy();
	}
?>
