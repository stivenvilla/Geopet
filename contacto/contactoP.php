<?php
    
    // Incluir archivo de conexion a la base de datos
    require_once "../config/database.php";
    $db=new database();
    $con = $db->conectar();

    $nombre=$_POST['nombre'];
    $correo=$_POST['correo'];
    $asunto=$_POST['asunto'];
    $numero=$_POST['numero'];
    $mensaje=$_POST['mensaje'];

    //se inserta el mensaje en la base de datos
  $sql=$con->prepare("INSERT INTO mensajes(correo, asunto, mensaje,numero, nombre, fechan) VALUES('$correo','$asunto','$mensaje','$numero', '$nombre',CURDATE())");
  $sql->execute();

  if($sql){
    echo'
    <script>alert("Gracias por comunicarse con nosotros en poco tiempo nos comunicaremos via correo electronico con usted");
    window.location="../contacto/email.php";
    </script>';
  }else{
    echo'
    <script>alert("El mensaje no pudo ser enviado por favor intentelo nuevamente");
    return false;
    </script>';
  }

  ?>

  