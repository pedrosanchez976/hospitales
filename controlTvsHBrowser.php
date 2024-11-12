<!DOCTYPE html>
<html>
<body onload="document.getElementById('form1').submit();">

	<!-- REDIRECCION A https://psh.sytes.net/https/clienteWSforTv/testClienteWSforTv.html -->
	<?php 
		if(! isset($_SESSION))
			session_start();  //PEDRO
		//header("Location:https://psh.sytes.net/https/clienteWsTv/ClienteWsTv.html?url=".$_SESSION["dominioHospital"]); // redireccion web

		$peticion='http://';
		if($_SERVER['HTTPS']=='on')
			$peticion='https://';

			// NO ES NECESARIO EL SERVER_PORT, ya viene en el HTTP_HOST
		$peticion.=$_SERVER['HTTP_HOST'];//.':'.$_SERVER['SERVER_PORT'];
		// $peticion  ===> https://psh.sytes.net:443 

		//header("Location:$peticion/clienteWsTv?url=".$_SESSION['dominioHospital']); // redireccion web
		$action=$peticion."/clienteWsTv";
	?>


<form id="form1" action="<?php echo $action?>" method="POST"  >
<input name="host" value=<?php echo "\"".$_SESSION['dominioHospital']."\""?>> 
</form>
	 

</body>
</html>
