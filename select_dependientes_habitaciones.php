<?php
	if(! isset($_SESSION))
		session_start();  //PEDRO
//$rutaconexion=$_SESSION["rutaconexion"];
include("_conexion2.inc");

// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"plantas"=>"PLANTAS",
"habitaciones"=>"HABITACIONES"
);

function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(is_numeric($opcionSeleccionada)) return true;
	else return false;
}

$selectDestino=$_GET["select"]; $opcionSeleccionada=$_GET["opcion"];

if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
	$tabla=$listadoSelects[$selectDestino];

	
	
	 $Q=ibase_query("SELECT IDHABITACION FROM HABITACIONES WHERE IDPLANTA='$opcionSeleccionada' and activo='s' order by idhabitacion") or die(mysql_error());
	// Comienzo a imprimir el select
	echo "<select name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido(this.id)'  size=10>";
	echo "<option value='0'>Elige</option>";
	while ($R = ibase_fetch_object($Q)) 	
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$R->IDHABITACION=htmlentities($R->IDHABITACION);
		// Imprimo las opciones del select
		echo "<option value='".$R->IDHABITACION."'>".$R->IDHABITACION."</option>";
	}	
	ibase_free_result($Q);		
	echo "</select>";
}
?>