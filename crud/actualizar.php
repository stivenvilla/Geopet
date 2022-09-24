<?php
//pasar datos a variables
$docid=$_POST['docid'];
$nombre=$_POST['nombre']; 
$apellidos=$_POST['apellidos']; 
$direc=$_POST['direccion']; 
$ciudad=$_POST['ciud']; 
$naci=$_POST['naci']; 
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];

//traer base de datos
  require '../config/database.php';
  $db=new database();
  $con = $db->conectar();
  //se hace la consulta sql para actualizar
  $sql=$con->prepare("UPDATE tblusuario SET nombres='$nombre', apellidos='$apellidos', direccion='$direc',ciudad='$ciudad', fecha_naci='$naci', telefono_movil='$telefono', correo='$correo' WHERE doc_id='$docid'");
  $sql->execute();

  if($sql){
    echo'<script>alert("Sus datos han sido actulizados exitosamente");
    window.location="../crud/datos.php";
    </script>';
  
  }else{
    echo'<script>alert("Los datos no se han podido modificar por favor intentelo mas tarde");
    window.location="../crud/datos.php";
    </script>';
  }



 

  
?>