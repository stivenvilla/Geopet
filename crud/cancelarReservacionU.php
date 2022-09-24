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
if($id=='' || $token==''){
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

        $consultRE=$con->prepare("SELECT tblreserva.cod_reserva, tblreserva.cod_empresa, tblreserva.doc_id, tblmascota.nombreMacota as mascota, tblservicio.nombre as servicio, tblreserva.fechaAsignada, tblreserva.estado FROM tblreserva INNER JOIN tblmascota ON tblreserva.cod_mascota=tblmascota.cod_mascota INNER JOIN tblservicio ON tblreserva.servicio=tblservicio.cod_servicio WHERE tblreserva.cod_reserva='$id'");
        $consultRE->execute();
        $resultadoR=$consultRE->fetch(PDO::FETCH_ASSOC);

        $cod_empresa=$resultadoR['cod_empresa'];
        $usuarioG=$resultadoR['doc_id'];
        $ms=$resultadoR['mascota'];
        $serv=$resultadoR['servicio'];
        $fecha=$resultadoR['fechaAsignada'];

       
        $correo=$con->prepare("SELECT nombre, correo from ciudadoresguar where cod_empresa='$cod_empresa'");
        $correo->execute();
        $resultadoCe=$correo->fetch(PDO::FETCH_ASSOC);

        $correoEmpresa=$resultadoCe['correo'];
        $nombreEmpresa=$resultadoCe['nombre'];

        $nombreDeUsuarioR=$con->prepare("SELECT nombres, apellidos from tblusuario where doc_id='$usuarioG'");
        $nombreDeUsuarioR->execute();
        $datosPersonales=$nombreDeUsuarioR->fetch(PDO::FETCH_ASSOC);
        $nombrePersona=$datosPersonales['nombres'];
        $apellidoPersona=$datosPersonales['apellidos'];

    
    }
    
  }else{
    echo'error al hacer la peticion';
  }
}

    $estado='cancelado';
    $terminar=$con->prepare("UPDATE tblreserva SET estado='$estado' where cod_reserva='$id'");
    $terminar->execute();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';

    //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'geopet.proy@gmail.com';                     //SMTP username
    $mail->Password   = 'bvktwithihysldoe';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('geopet.proy@gmail.com', 'Geopet');
    $mail->addAddress($correoEmpresa);     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Se ha cancelado la reserva';
    $mail->Body    = 'Estimada ' . $nombreEmpresa . ' El usuario  ' . $nombrePersona . $apellidoPersona .  ' ha decido cancelar la reservación que estaba programada para la fecha  ' . $fecha;

    $mail->send();
    echo '<script>alert("El mensaje ha sido enviado");
    window.location="../crud/datos.php";
    </script>';
}catch (Exception $e) {
    echo "el mensaje no pudo ser enviado: {$mail->ErrorInfo}";
}
    



?>