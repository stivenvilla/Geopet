<?php
    //se definen variables constantes con los datos de la base de datos
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'geopet');

    //se hace la conexion a la base de datos
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    //condicion para saber si no se conecta lance el eeror
    if($link === false){
        die("ERROR EN LA CONEXION" . mysqli_connect_error());
    }


?>