



<!DOCTYPE html>
<html> 
<head>
<!--
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />

<link rel="stylesheet" type="text/css" href="stylesheet.css">
-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Principal</title>


<link rel="stylesheet" type="text/css" href="stylesheet.css"> 



<?php 

	if(! isset($_SESSION))
		session_start();  //PEDRO

	//require_once '_checkSesion.inc';  // si existe timeout: limpia $_SESSION 
	require_once '_sesionManage.inc'; 
	checar_timeout_session();

	if ( ! isset( $_SESSION['usuario'] ) ) {  // $_SESSION["usuario"]
		// Sesión inactiva  
		header('Location: ./'); // RETORNO A INDEX
	}


	$_SESSION["numHabitacion"]='';
	$_SESSION["numHabitaciontraslado"]='';  
	$idperfil= $_SESSION["idPerfil"];
	  
	require("_conexion.inc");
	include "_header.inc";
/*
	$myArr = array("Volvo", 15, ["apples", "bananas"]);
	array_push($myArr,"blue");

	if(! isset($_SESSION["array1"]))
	$_SESSION["array1"]=$myArr;
*/
?>


<style type="text/css">
	#hintbox{ /*CSS for pop up hint box */
		position:absolute;
		top: 0;
		background-color: lightyellow;
		width: 150px; /*Default width of hint.*/ 
		padding: 3px;
		border:1px solid black;
		font:normal 11px Verdana;
		line-height:18px;
		z-index:100;
		border-right: 3px solid black;
		border-bottom: 3px solid black;
		visibility: hidden;
	}

	.hintanchor{ /*CSS for link that shows hint onmouseover*/
		font-weight: bold;
		color: navy;
	}
	
	.hintanchor:hover { /*CSS for link that shows hint onmouseover*/
		/* text-shadow: offset-x | offset-y | blur-radius | color */
		
		background-color: navy;
		color: white;
	}
</style>


</head>


<script type="text/javascript">

/***********************************************
* Show Hint script- � Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/
		
var horizontal_offset="9px" //horizontal offset of hint box from anchor link

/////No further editting needed

var vertical_offset="0" //horizontal offset of hint box from anchor link. No need to change.
var ie=document.all
var ns6=document.getElementById&&!document.all

function getposOffset(what, offsettype){
	var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
	var parentEl=what.offsetParent;
	while (parentEl!=null){
	totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
	parentEl=parentEl.offsetParent;
	}
	return totaloffset;
}

function iecompattest(){
	return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function clearbrowseredge(obj, whichedge){
	var edgeoffset=(whichedge=="rightedge")? parseInt(horizontal_offset)*-1 : parseInt(vertical_offset)*-1
	if (whichedge=="rightedge"){
	var windowedge=ie && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-30 : window.pageXOffset+window.innerWidth-40
	dropmenuobj.contentmeasure=dropmenuobj.offsetWidth
	if (windowedge-dropmenuobj.x < dropmenuobj.contentmeasure)
	edgeoffset=dropmenuobj.contentmeasure+obj.offsetWidth+parseInt(horizontal_offset)
	}
	else{
	var windowedge=ie && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18
	dropmenuobj.contentmeasure=dropmenuobj.offsetHeight
	if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure)
	edgeoffset=dropmenuobj.contentmeasure-obj.offsetHeight
	}
	return edgeoffset
}

function showhint(menucontents, obj, e, tipwidth){
	if ((ie||ns6) && document.getElementById("hintbox")){
		dropmenuobj=document.getElementById("hintbox")
		dropmenuobj.innerHTML=menucontents
		dropmenuobj.style.left=dropmenuobj.style.top=-500
		
		if (tipwidth!=""){
			dropmenuobj.widthobj=dropmenuobj.style
			dropmenuobj.widthobj.width=tipwidth
		}
		
		dropmenuobj.x=getposOffset(obj, "left")
		dropmenuobj.y=getposOffset(obj, "top")
		dropmenuobj.style.left=dropmenuobj.x-clearbrowseredge(obj, "rightedge")+obj.offsetWidth+"px"
		dropmenuobj.style.top=dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+"px"
		dropmenuobj.style.visibility="visible"
		obj.onmouseout=hidetip
	}
}

function hidetip(e){
	dropmenuobj.style.visibility="hidden"
	dropmenuobj.style.left="-500px"
}

function createhintbox(){
	var divblock=document.createElement("div")
	divblock.setAttribute("id", "hintbox")
	document.body.appendChild(divblock)
}

if (window.addEventListener)
	window.addEventListener("load", createhintbox, false);
else if (window.attachEvent)
	window.attachEvent("onload", createhintbox);
else if (document.getElementById)
	window.onload=createhintbox;

</script>

<body>


<table width="400" border="0" align="center">
  <tr class="elegiropcion"> <td> ¿Qué desea hacer? <?php echo $myArr[3] ?> </td></tr>	
</table>
		
<table width="370" border="0" align="center">
  	<tr>
		<td>
		<ul> 
		<?php		  
		$Q =ibase_query($conexionHospitalesFDB, "select * from VW_WEB_FUNCIONES_PERFIL where IDPERFIL=".$idperfil." order by POSICION ASC");
		while ($R = ibase_fetch_object($Q)){	
			if($_SESSION["modoEnvio"]!='ws')
			if(($R->IDFUNCION==14)  //Web control tvs HBrowser
			|| ($R->IDFUNCION==13)) //consultaFehoUltimaConexion
			continue;
			
			if($_SESSION["puceTcod"]=='')
			if(($R->IDFUNCION==15) //Redirección a web de cobro onLine
			|| ($R->IDFUNCION==12) ) //consulta transacciones PUCE
			continue;

			echo '<li><a href="'.$R->PHP.'.php"  class="hintanchor" onMouseover="showhint(\''.utf8_encode($R->DESCRIPCION).'\', this, event, \'150px\')">'.utf8_encode( $R->CAPTION).'</a></li> <br/>';
		} 
		ibase_free_result($Q); 
		ibase_close($conexionHospitalesFDB);
		?>	
		</ul> 
		</td>
  	</tr>
</table>
 

<?php
include "_foot.inc";
?>		  

</body>
</html>
