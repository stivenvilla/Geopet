<?php
require '../config/database.php';
$db=new database();
$con = $db->conectar();

$cod_especie=$_POST['cod_especie'];

$raza=$con->prepare("SELECT cod_raza, nombre FROM tblraza where cod_especie='$cod_especie' ORDER BY nombre ASC");
$raza->execute();
$resultadoRaza=$raza->fetchAll(PDO::FETCH_ASSOC);

foreach($resultadoRaza as $raza){
    $html.="<option value='". $raza['cod_raza']."'>". $raza['nombre']."</option>";
}

echo $html;