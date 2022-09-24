<?php
//se iniciar y se destruye la sesion
    session_start();

$_SESSION = array();

session_destroy();

header("location: ingresar.php");

exit;



?>