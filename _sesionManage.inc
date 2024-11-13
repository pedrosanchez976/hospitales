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

		unset($_SESSION);
*/

// no destruye el archivo c:\wamp\temp\sess_xxxx, solo lo limpia; mantenemos la misma cookie, no necesario generar otra
		session_unset(); // NUEVO 12/11/2024 // Vaciar todas las variables de sesión  ERRORRRRRRRRR
/*
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
		session_destroy();  // destruye el archivo de datos de sesion en c:\wamp\temp
		*/
		//iduser|i:1001;usuario|s:5:"pedro";numHospitales|i:61;idhospital|i:18;idPerfil|i:1;hospital|s:16:"B-IGU C.S. Anoia";ipHospital|s:17:"csanoia.sytes.net";dominioHospital|s:17:"csanoia.sytes.net";puceTcod|s:5:"W00ZT";modoEnvio|s:4:"UART";rutaconexion|s:42:"csanoia.sytes.net/3051:c:\tv\igualada1.fdb";ULTIMA_ACTIVIDAD|i:1731455871;numHabitacion|s:0:"";numHabitaciontraslado|s:0:"";
	}

	// LIMITAR LA INACTIVIDAD EN WEB A MEDIA HORA




// Máxima duración de sesión activa en media hora
define( 'MAX_SESSION_TIEMPO', 1800 );

function checar_timeout_session() {
	try {
		// Controla cuando se ha creado y cuando tiempo ha recorrido 
		if ( isset( $_SESSION[ 'ULTIMA_ACTIVIDAD' ] ) && 
			( time() - $_SESSION[ 'ULTIMA_ACTIVIDAD' ] > MAX_SESSION_TIEMPO ) ) {

			// Si ha pasado el tiempo sobre el limite destruye la session
			//destruir_session();
			//clearSesion();
			header("Location:index.php"); // redireccion
		}
		else
			$_SESSION[ 'ULTIMA_ACTIVIDAD' ] = time();
	} catch (\Throwable $th) {
		//throw $th;
	}
	
}

// Función para destruir y resetear los parámetros de sesión
function destruir_session() {  // NO USADOOOOO

    $_SESSION = array();
    //unset($_SESSION);
    if ( ini_get( 'session.use_cookies' ) ) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            //time() - MAX_SESSION_TIEMPO,
            0,
            $params[ 'path' ],
            $params[ 'domain' ],
            $params[ 'secure' ],
            $params[ 'httponly' ] );
    }

    @session_destroy();
}


?>
