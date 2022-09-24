<?php
//pasar datos a variables
$docid=$_POST['docid'];
$nombre=$_POST['nombre']; 
$direc=$_POST['direccion']; 
$ciudad=$_POST['ciud']; 
$servicios=$_POST['service'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];

//traer base de datos
require '../config/database.php';
  $db=new database();
  $con = $db->conectar();
  //se hace la consulta sql para actualizar
  $sql=$con->prepare("UPDATE ciudadoresguar SET nombre='$nombre', ciudad='$ciudad', telefono='$telefono', direccion='$direc',  servicios='$servicios', correo='$correo' WHERE cod_empresa='$docid'");
  $sql->execute();

  if($sql){
     echo '<script>alert("Los datos han sido modificados");
     window.location="../empresa/datosEmpresa.php"; 
     </script>';
  
  }else{
    echo '<script>alert("Ha ocurrido un error al modificar los datos intentar luego");
     window.location="../empresa/datosEmpresa.php"; 
     </script>';
  }



 


  
?>