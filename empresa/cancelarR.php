<?php

    session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../ingresar/ingresar.php");
    exit;
}

require'../config/token.php';
require '../config/database.php';


$db=new database();
$con = $db->conectar();

//se pone el id de la empresa y el token en el get 
$id=isset($_GET['id']) ? $_GET['id'] : '';
$token=isset($_GET['token']) ? $_GET['token'] : '';

//se verifica el id y el token de que no esten vacios
if($id==''  || $token==''){
    echo'error al hacer la peticion'; 
    exit; 
}else{
  /*lo que se esta haciendo es poner hacer que no se pueda modificar el token 
  si se le cambia alguna letra o numero este mostrara error*/
  $token_tmp=hash_hmac('sha1', $id, KEY_TOKEN);
  if($token==$token_tmp){
    $sql=$con->prepare("SELECT count(cod_reserva) FROM tblreserva where cod_reserva=?");
    $sql->execute([$id]);
    if($sql->fetchColumn() > 0){

        $sql=$con->prepare("SELECT tblreserva.cod_reserva, tblreserva.cod_empresa, tblreserva.doc_id, tblmascota.nombreMacota as mascota,tblservicio.Nombre AS servicio,  tblreserva.fechaAsignada, tblreserva.estado FROM tblreserva INNER JOIN tblservicio ON tblreserva.servicio=tblservicio.cod_servicio INNER JOIN tblmascota ON tblreserva.cod_mascota=tblmascota.cod_mascota where cod_reserva='$id'");
        $sql->execute();
        $resultado=$sql->fetch(PDO::FETCH_ASSOC);
        $cod_reserva=$resultado['cod_reserva'];
        $cod_empresa=$resultado['cod_empresa'];
        $usuarioG=$resultado['doc_id'];
        $ms=$resultado['mascota'];
        $serv=$resultado['servicio'];

        $sql=$con->prepare("SELECT correo FROM tblusuario where  doc_id='$usuarioG' limit 1");
        $sql->execute();
        $r=$sql->fetch(PDO::FETCH_ASSOC);

        $correo=$r['correo'];

    }
    
  }else{
    echo'error al hacer la peticion';
  }
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>GEOPET</title>
  <link rel="stylesheet" href="../estilosCss/ver.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  
</head>
<body>
  <!-- en esta parte se presenta un formulario en donde la empresa le dara a conocer al usuario de las razones para cancelar la reserva -->
<div class="content">

<div class="contact-wrapper animated bounceInUp">
    <div class="contact-form">
        <h3>Reservar</h3>
        <form action="enviarCorreoCancelado.php" method="post"">
            <p>
                <label>Reserva #</label>
                <input type="text" name="RSC" id="empresa" value="<?php echo $cod_reserva;?>">
            </p>
            <p>
                <label>Empresa</label>
                <input type="text" name="empresa" id="empresa" value="<?php echo $cod_empresa;?>">
            </p>
            <p>
                <label>Usuario</label>
                <input type="text" name="docid" id="docid" value="<?php echo $usuarioG;?>">
            </p>
            <p>
                <label>Mascota</label>
                <input type="text" name="mas" id="mas" value="<?php echo $ms;?>">
            </p>
            <p>
                <label>Servicio</label>
                <input type="text" name="serv" id="ser" value="<?php echo $serv;?>">
            </p>
            <p>
               <label>Correo usuario</label>
               <input type="text" name="correo" id="correo" value="<?php echo $correo;?>">
           </p>
            
            </p>
            <p class="block">
               <label>Justifición de cancelación</label> 
                <textarea name="message" rows="3" id="mesa" placeholder="Pro favor escriba el motivo por el cual ha cancelado la reservacion"></textarea>
            </p>
            <p class="block">
                <button>
                    Enviar
                </button>
            </p>
        </form>
    </div>
</div>

</div>

</body>
</html>
