<?php
 session_start();

 //se hace la sesion para que no se pueda ingresar a la pagina principal sin antes haber iniciado sesion
 if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
   header("location: ../ingresar/ingresar.php");
   exit;
}
 require '../config/database.php'; //conexion a la base de datos
 $db=new database();
 $con = $db->conectar();

 
$docid=$_POST['docid']; //pasar documento pos post

//se hace la preparacion de la imagen con el tipo file
$imagen=addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
//se realiza la consulta encargada de la modificacion de la imagen 
 $sql=$con->prepare("UPDATE ciudadoresguar SET foto_establecimiento='$imagen' where cod_empresa='$docid'");
 $sql->execute();

 //condicion para darle a conocer al usuario lo sucedido
if($sql){
    echo'<script>alert("la imagen ha sido modificada");
    window.location="../empresa/datosEmpresa.php";
    </script>';
}else{
    echo'<script>alert("Ha ocurrido un error por favor intentelo nuevamente");
    window.location="../ingresar/fotos.php";
    </script>'; 
}