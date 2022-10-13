<?php
    
    require_once "../config/database.php";
    $db=new database();
    $con = $db->conectar();

    $empresa=$_POST['empresa'];
    $usuario=$_POST['docid'];
    $nombreMacota=$_POST['namePet'];
    $servicio=$_POST['service'];
    $fechaReservacion=$_POST['reservation'];

    //se traen los datos de la reservacion y esos datos se insertan en la base de datos
    
  $sql=$con->prepare("INSERT INTO tblreserva(cod_empresa, doc_id, cod_mascota,  servicio, fechaAsignada) VALUES('$empresa', '$usuario','$nombreMacota','$servicio','$fechaReservacion')");
  $sql->execute();

  if($sql){
    echo'
     <script>
     alert("Señor usuario, debe de estar pendiente del corrreo electrónico para la verificación de su reserva por parte de  la empresa");
     window.location="../ingresar/bienvenida.php"
     </script>
    
    ';
  }

  ?>
  






