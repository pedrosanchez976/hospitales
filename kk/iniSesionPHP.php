<?php
if(! isset($_SESSION))
    session_start();  //PEDRO
$paginaactual = basename($_SERVER['PHP_SELF']);

if(isset($_POST['habitaciones']) && $_POST['habitaciones'] != ''){         
    $numHabitacion = $_POST['habitaciones'];}
else
    $numHabitacion='';
?>