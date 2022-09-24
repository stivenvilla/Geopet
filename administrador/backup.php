<?php

$db_host="localhost"; 
$db_name="geopet";
$db_user="root"; 
$db_pass=""; 

//esta parte lo que hace es ejecutar un codigo de consila en donde se le pasan los parametros de la base de datos y se le dice con que formato descargar la copia de seguridad

$fecha=date("Ymd_Hms");


$nombre_sql=$db_name . "_" . $fecha . '.sql'; 



$dump="C:\\xampp\\mysql\\bin\\mysqldump -h$db_host -u$db_user --routines --opt $db_name > $nombre_sql";

exec($dump);

echo '<script>alert("La copia de seguridad ha sido descargada Exitosamente");
window.location="../administrador/copiaSe.php";
</script>';

 



?>