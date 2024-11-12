
	
<?php
// https://programadorphp.es/docs/php_manual_espanol/function.ibase-execute.html

$cambios = array(
    1 => 'Eric',
    5 => 'Filip',
    7 => 'Larry'
);

$db = ibase_connect($host, $nombre_usuario, $contrasenya);
$consulta = ibase_prepare($db, "UPDATE FOO SET BAR = ? WHERE BAZ = ?");

foreach ($cambios as $baz => $bar) {
    ibase_execute($consulta, $bar, $baz);
}



/*
https://programadorphp.es/docs/php_manual_espanol/function.ibase-query.html

Example#1 Ejemplo de ibase_query()
*/

$host = 'localhost:/ruta/a/su/base_de_datos.gdb';

$db = ibase_connect($host, $nombre_usuario, $contrasenya);
$query = 'SELECT * FROM nombre_tabla';

$gestor_sent = ibase_query($db, $query) or die(ibase_errmsg());


?>