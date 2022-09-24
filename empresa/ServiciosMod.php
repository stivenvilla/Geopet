<?php

/*esta parte se encargara de que el usuario pueda registrar varios servicios lo que hara es que 
insertara en la base de datos los datos que se han mandado por medio de post desde el formulario de 
servicios*/
require '../config/database.php';
$db=new database();
$con = $db->conectar();
$documento=$_POST['docid'];
$nombreServicio=$_POST['nombre'];

$sql=$con->prepare("INSERT INTO tblservicio(cod_empresa, nombre) VALUES('$documento','$nombreServicio')");
$sql->execute();

if($sql){
    echo'
     <script>alert("El servicio ha sido añadido muchas gracias");
     window.location="../empresa/servicios.php";
     </script>
    ';
}








?>