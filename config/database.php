<?php

//se hace una clase en donde se hara la conexion a la base de datos
class database{
    private $hostname="localhost";
    private $database="geopet"; 
    private $username="root";
    private $password=""; 
    private $charset="utf8";

    function conectar(){
        try{
        $conexion="mysql:host=" . $this->hostname . "; dbname=" . $this->database . "; charset=" . $this->charset;
        $opciones=[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES =>false

        ];

        $pdo = new PDO($conexion, $this->username, $this->password, $opciones );

        return $pdo;
        //manejo de errores
        }catch(PDOException $e){
            echo 'Error en la conexion ' . $e->getMessage();
            exit;

        }
    }
}


?>