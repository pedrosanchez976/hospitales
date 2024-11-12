<!DOCTYPE html>
<html>
<body>
	<!-- REDIRECCION A https://psh.sytes.net/https/clienteWSforTv/testClienteWSforTv.html -->
	<?php 
		if(! isset($_SESSION))
			session_start();  //PEDRO
		//header("Location:https://psh.sytes.net/https/clienteWsTv/ClienteWsTv.html?url=".$_SESSION["dominioHospital"]); // redireccion web

		$peticion='http://';
		if($_SERVER['HTTPS']=='on')
			$peticion='https://';
		$peticion.=$_SERVER['HTTP_HOST'].':'.$_SERVER['SERVER_PORT'];
		//echo $http.	$_SERVER['HTTP_HOST'].$port;     https://psh.sytes.net:443 
		header("Location:$peticion/clienteWsTv?url=".$_SESSION['dominioHospital']); // redireccion web
	?>
</body>
</html>
