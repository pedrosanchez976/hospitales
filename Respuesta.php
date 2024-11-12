<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Respuesta</title>


<link rel="stylesheet" type="text/css" href="stylesheet.css">


</head>

<body>

<?php 
	function warningCamposObligatorios(){
		print ' <table width="300" border="0" align="center"> ';    
		print ' <tr> <td> <br /></td></tr>  ';         
		print ' <tr> <td> Todos los datos del formulario anterior son obligatorios</td></tr> ';
		print ' <tr> <td> <a href="#" onClick="history.go(-1)">Intentelo de nuevo</a></td></tr> ';
	}


	if(! isset($_SESSION))
		session_start();  //PEDRO
	include "_header.inc"; 

//	�OJO NO CONTROLO ERRORES , Pedro debe modificar procedimiento y devolverme codigo de errores!!!!
	$textosinerror='La actualizacion se ha llevado con exito';
	$textoerror='';

	$iduser= $_SESSION["iduser"];
	include("_conexion2.inc");


	$pagina_anterior=$_GET['paginaactual'];

	if(isset($_POST['numHabitacion']) && $_POST['numHabitacion'] != ''){    $numHabitacion = $_POST['numHabitacion'];}
	if(isset($_POST['numDia']) && $_POST['numDia'] != ''){                  $numDia = $_POST['numDia'];} else $numDia=0;
	if(isset($_POST['comentario']) && $_POST['comentario'] != ''){          $comentario = $_POST['comentario'];}
	if(isset($_POST['numHabitacionTraspaso']) && $_POST['numHabitacionTraspaso'] != ''){   $numHabitacionTraspaso = $_POST['numHabitacionTraspaso'];}
	if(isset($_POST['mensajetelevisor']) && $_POST['mensajetelevisor'] != ''){$mensajetelevisor = nl2br($_POST['mensajetelevisor']);}
	if(isset($_POST['numContrato']) && $_POST['numContrato'] != ''){		 $numContrato = $_POST['numContrato'];}
	if(isset($_POST['numHora']) && $_POST['numHora'] != ''){                $numHora = $_POST['numHora'];} else $numHora=0;
		
	
	if(isset($_POST['motivomutua']) && $_POST['motivomutua'] != ''){  $motivo = $_POST['motivomutua'];}

	if(isset($_POST['ejecutarcomando']) && $_POST['ejecutarcomando'] != ''){  $ejecutarcomando = $_POST['ejecutarcomando'];}
	
	 

/////////////////////////////////////////////////////////////////////////////////////
////////////////////////  ABRIR TV  /////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

/*
m: si se selecciona mutua
p: si se selecciona privado
v: si se selecciona vip

*/
//if($pagina_anterior=='abrirtvmutua.php')     { $motivo='p';   } //Antes de la modificacion
if($pagina_anterior=='abrirtvcompromiso.php'){  $motivo='c';  }

if($pagina_anterior=='abrirtvmutua.php' || $pagina_anterior=='abrirtvcompromiso.php')
{
    // Comprobacion datos obligatorios
	   if(empty($numHabitacion)==true || empty($comentario)==true )
	   {
			warningCamposObligatorios();
			/*
		   print ' <table width="300" border="0" align="center"> ';    
		   print ' <tr> <td> <br /></td></tr>  ';         
		   print ' <tr> <td> Todos los datos del formulario anterior son obligatorios</td></tr> ';
		   print ' <tr> <td> <a href="#" onClick="history.go(-1)">Intentelo de nuevo</a></td></tr> ';*/
		   Exit;
	   }
	   
   //Activar televisor
// PETICION DE TANAKI: en el caso de apertura por cuestión técnica, que sean horas en vez de días
   		if($pagina_anterior=='abrirtvcompromiso.php'){ 
			$numDia= $numDia/24;
		}
   
		$Q = ibase_query("EXECUTE PROCEDURE WEB_ACTIVARTV ('".$numHabitacion."',".$numDia.",'".$motivo."','".$comentario."',".$iduser.")");  
			
		if (!$Q)
		echo ibase_errmsg();
		
		while ($o = ibase_fetch_object($Q))
		{			  
			if($o->CADENAERROR!='') 
				$textoerror=$o->CADENAERROR;		
			else
				$textosinerror='Error '.$pagina_anterior;
		}

		ibase_close($conexion);
}


/////////////////////////////////////////////////////////////////////////////////////
////////////////////////  MENSAJES TV  /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

if($pagina_anterior=='textossamsung.php')
{
    /* 
	   echo "<br>"."numero habitacion: ".$numHabitacion;
       echo "<br>"."mensajes televisor : ".$mensajetelevisor;
	*/
	  
	   // Comprobacion datos obligatorios
	if(empty($numHabitacion)==true || empty($mensajetelevisor)==true )
	{
		warningCamposObligatorios(); /*
		print ' <table width="300" border="0" align="center"> ';    
		print ' <tr> <td> <br /></td></tr>  ';         
		print ' <tr> <td> Todos los datos del formulario anterior son obligatorios</td></tr> ';
		print ' <tr> <td> <a href="#" onClick="history.go(-1)">Intentelo de nuevo</a></td></tr> ';*/
		Exit;
	}
	   
	   // Enviar mensaje al televisor
   
	//  $Q = ibase_query("EXECUTE PROCEDURE COMANDOSSAMSUNGWeb('".$numHabitacion."','".$mensajetelevisor."')");     
	//   ibase_close($conexion);
	$Q = ibase_query("EXECUTE PROCEDURE COMANDOSSAMSUNGWEB('".$numHabitacion."','".$mensajetelevisor."',".$iduser.")");  
			
	if (!$Q)
	echo ibase_errmsg();
	
	while ($o = ibase_fetch_object($Q)) 
	{			  
		if($o->CADENAERROR!='') 
			$textoerror=$o->CADENAERROR;		
		else
			$textosinerror='Error textossamsung.php';
		
	}

	ibase_close($conexion);
				
}

/////////////////////////////////////////////////////////////////////////////////////
////////////////////////  CERRAR TV  /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

if($pagina_anterior=='desactivartv.php')
{
	/* 
	echo "<br>"."numero habitacion: ".$numHabitacion;
	*/
	
	// Comprobacion datos obligatorios
	if(empty($numHabitacion)==true )
	{
		warningCamposObligatorios(); /*
		print ' <table width="300" border="0" align="center"> ';    
		print ' <tr> <td> <br /></td></tr>  ';         
		print ' <tr> <td> Todos los datos del formulario anterior son obligatorios</td></tr> ';
		print ' <tr> <td> <a href="#" onClick="history.go(-1)">Intentelo de nuevo</a></td></tr> ';*/
		Exit;
	}
	   
	  // Cerrar Tv
	  
//	  $Q = ibase_query("update TVSABIERTOS set cancelado='s' where idhabitacion='".$numHabitacion."' and (fehofin is null or fehofin>CURRENT_TIMESTAMP)");  

//ibase_close($conexion);

	$Q = ibase_query("EXECUTE PROCEDURE WEB_DESACTIVARTV ('".$numHabitacion."',".$iduser.")");  
	
	if (!$Q)
	echo ibase_errmsg();
	
	while ($o = ibase_fetch_object($Q))
	{			  
		if($o->CADENAERROR!='') 
			$textoerror=$o->CADENAERROR;		
	else
			$textosinerror='Error desactivartv.php';
		
	}

	ibase_close($conexion);
  
}

/////////////////////////////////////////////////////////////////////////////////////
////////////////////////  TRASLADO HABITACION  /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

if($pagina_anterior=='trasladohabitacion.php')
{
     /*
	  echo "<br>"."numero habitacion origen : ".$numHabitacion;
      echo "<br>"."numHabitacionTraspaso : ".$numHabitacionTraspaso;
	*/
	  
	// Comprobacion datos obligatorios
	if(empty($numHabitacion)==true || empty($numHabitacionTraspaso)==true )
	{
		warningCamposObligatorios(); /*
		print ' <table width="300" border="0" align="center"> ';    
		print ' <tr> <td> <br /></td></tr>  ';         
		print ' <tr> <td> Todos los datos del formulario anterior son obligatorios</td></tr> ';
		print ' <tr> <td> <a href="#" onClick="history.go(-1)">Intentelo de nuevo</a></td></tr> '; */
		Exit;
	}
	   

	$Q = ibase_query("EXECUTE PROCEDURE WEB_TRASPASOHABITACION ('".$numHabitacion."','".$numHabitacionTraspaso."',".$iduser.")");   
				
	if (!$Q)
	echo ibase_errmsg();
	
	while ($o = ibase_fetch_object($Q))
	{			  
		if($o->CADENAERROR!='') 
			$textoerror=$o->CADENAERROR;		
	else
			$textosinerror='Error trasladohabitacion.php';
		
	}

	ibase_close($conexion);
}

/////////////////////////////////////////////////////////////////////////////////////
////////////////////////  TRASLADO CONTRATO  /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
if($pagina_anterior=='trasladocontrato.php')
{
	/*       
		   
		   print ' <table width="300" border="0" align="center"> ';    
		   print ' <tr> <td> <br /></td></tr>  ';         
		   print ' <tr> <td>En construccion  traslado de contrato</td></tr> ';
		   Exit;
		   
     */
	 
	  /* 
	  echo "<br>"."numero habitacion: ".$numHabitacion;
	  echo "<br>"."numero contrato: ".$numCOntrato;
	  */
	  
	   // Comprobacion datos obligatorios
	   if(empty($numHabitacion)==true )
	   {
			warningCamposObligatorios(); /*
		   print ' <table width="300" border="0" align="center"> ';    
		   print ' <tr> <td> <br /></td></tr>  ';         
		   print ' <tr> <td> Todos los datos del formulario anterior son obligatorios</td></tr> ';
		   print ' <tr> <td> <a href="#" onClick="history.go(-1)">Intentelo de nuevo</a></td></tr> ';*/
		   Exit;
	   }
	   
	   	if(empty($numContrato)==true )
	   {
			warningCamposObligatorios(); /*
		   print ' <table width="300" border="0" align="center"> ';    
		   print ' <tr> <td> <br /></td></tr>  ';         
		   print ' <tr> <td> Todos los datos del formulario anterior son obligatorios</td></tr> ';
		   print ' <tr> <td> <a href="#" onClick="history.go(-1)">Intentelo de nuevo</a></td></tr> '; */
		   Exit;
	   }
	   
	   
	  // Traspaso contrato
	  
//	  $Q = ibase_query("update TVSABIERTOS set cancelado='s' where idhabitacion='".$numHabitacion."' and (fehofin is null or fehofin>CURRENT_TIMESTAMP)");  

//ibase_close($conexion);

		$Q = ibase_query("EXECUTE PROCEDURE WEB_TRASPASOCONTRATO (".$numContrato.",'".$numHabitacion."',".$iduser.")");  
		
		if (!$Q)
		echo ibase_errmsg();
		
		while ($o = ibase_fetch_object($Q))
		{			  
			if($o->CADENAERROR!='') 
				$textoerror=$o->CADENAERROR;		
		else
				$textosinerror='Error trasladocontrato.php';
			
		}

		ibase_close($conexion);
		   
}

/////////////////////////////////////////////////////////////////////////////////////
////////////////////////  ESTADO CONTRATACION  /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
if($pagina_anterior=='estadocontratacion.php')
{

	   /* 
	  echo "<br>"."numero habitacion: ".$numHabitacion;
	  */
	  
	   // Comprobacion datos obligatorios
	   if(empty($numHabitacion)==true )
	   {
			warningCamposObligatorios(); /*
		   print ' <table width="400" border="0" align="center"> ';    
		   print ' <tr> <td> <br /></td></tr>  ';         
		   print ' <tr> <td> Todos los datos del formulario anterior son obligatorios</td></tr> ';
		   print ' <tr> <td> <a href="#" onClick="history.go(-1)">Intentelo de nuevo</a></td></tr> ';*/
		   Exit;
	   }
	   
	  // Estado contratacion Tv
	  

		$Q = ibase_query("EXECUTE PROCEDURE WEB_ESTADOTV ('".$numHabitacion."',".$iduser.")");  
		
		if (!$Q)
		echo ibase_errmsg();
		
		while ($o = ibase_fetch_object($Q))
		{			  
			if($o->CADENAERROR!='') 
				$textoerror=$o->CADENAERROR;		
		else
			$textosinerror='Error estadocontratacion.php';
			
		}

		ibase_close($conexion);
  
}


/////////////////////////////////////////////////////////////////////////////////////
////////////////////////  PROLONGAR ACTIVIDAD TV  /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
if($pagina_anterior=='prolongaractividadtv.php')
{

	   /* 
	  echo "<br>"."numero habitacion: ".$numHabitacion;
	  */
	  
	   // Comprobacion datos obligatorios
	   if(empty($numHabitacion)==true )
	   {
			warningCamposObligatorios(); /*
		   print ' <table width="300" border="0" align="center"> ';    
		   print ' <tr> <td> <br /></td></tr>  ';         
		   print ' <tr> <td> Todos los datos del formulario anterior son obligatorios</td></tr> ';
		   print ' <tr> <td> <a href="#" onClick="history.go(-1)">Intentelo de nuevo</a></td></tr> ';
	  */
		   Exit;
	   }
	   
	   if(empty($numHora)==true )
	   {
			warningCamposObligatorios(); /*
		   print ' <table width="300" border="0" align="center"> ';    
		   print ' <tr> <td> <br /></td></tr>  ';         
		   print ' <tr> <td> Todos los datos del formulario anterior son obligatorios</td></tr> ';
		   print ' <tr> <td> <a href="#" onClick="history.go(-1)">Intentelo de nuevo</a></td></tr> ';
	  */
		   Exit;
	   }	   
	   
	   
	  // Prolongar actividad Tv
	  

		$Q = ibase_query("EXECUTE PROCEDURE  web_prolongarActividadTV('".$numHabitacion."',".$numHora.",".$iduser.")");  
		
		if (!$Q)
		echo ibase_errmsg();
		
		while ($o = ibase_fetch_object($Q))
		{			  
			if($o->CADENAERROR!='') 
				$textoerror=$o->CADENAERROR;		
			else
				$textosinerror='Error prolongaractividadtv.php';
		}

     	ibase_close($conexion);
  
}


/////////////////////////////////////////////////////////////////////////////////////
////////////////////////  EJECUTAR COMANDO  ///////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
if($pagina_anterior=='ejecutarComando.php')
{

	   /* 
	  echo "<br>"."numero habitacion: ".$numHabitacion;
	  */
	  
	   // Comprobacion datos obligatorios
	   if(empty($numHabitacion)==true ) // empty:: si valor de la variable es cadena vacia: empty=>true: rareza: devuelve true para cadena "0"
	   {
			warningCamposObligatorios(); /*
		   print ' <table width="300" border="0" align="center"> ';    
		   print ' <tr> <td> <br /></td></tr>  ';         
		   print ' <tr> <td> Todos los datos del formulario anterior son obligatorios</td></tr> ';
		   print ' <tr> <td> <a href="#" onClick="history.go(-1)">Intentelo de nuevo</a></td></tr> '; */
		   Exit;
	   }
	      
	  // Ejecutar comando
	  

		$Q = ibase_query("EXECUTE PROCEDURE  web_ejecutarComando('".$numHabitacion."',".$ejecutarcomando.")");  
		
		if (!$Q)
		echo ibase_errmsg();
		
		while ($o = ibase_fetch_object($Q))
		{			  
			if($o->CADENA!='') 
				$textoerror=$o->CADENA;		
			else
				$textosinerror='Error ejecutarComando.php';
		}

     	ibase_close($conexion);
  
}



	if($textoerror=='')
		$texto=$textosinerror;
	else
		$texto=$textoerror;
?>


<table width="400" border="0" align="center">     
		<tr> <td> <br /></td></tr>           
		<tr class="elegiropcion"> <td> <?php echo utf8_encode($texto) ?></td></tr> 
		<tr> <td> <br /></td></tr>    
</table>
	

<?php include "_foot.inc"; ?>

</body>

</html>
