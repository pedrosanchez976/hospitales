<!DOCTYPE html>
<html>
<body>
	<!-- REDIRECCION A https://hospital.sytes.net  :: web de cobro on line -->
	<?php 
		if(! isset($_SESSION))
			session_start();  //PEDRO
		header("Location:https://".$_SESSION["dominioHospital"]); // redireccion web
	?>
</body>
</html>
