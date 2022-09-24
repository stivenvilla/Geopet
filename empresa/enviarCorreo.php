<?php

require'../config/token.php';
require '../config/database.php';

$cod_reserva=$_POST['RS'];
$cod_empresa=$_POST['empresa'];
$docid=$_POST['docid'];
$mascota=$_POST['mas'];
$correo=$_POST['correo'];
$servicio=$_POST['serv'];
$hora=$_POST['hora'];

//se le enviara un correo electronico al usuario utilizando el phpmailer en donde se le dara a concer que la reservacion fue aceptada
$db=new database();
$con = $db->conectar();

$usuario=$con->prepare("SELECT nombres, apellidos from tblusuario where doc_id='$docid'");
$usuario->execute();
$resultado=$usuario->fetch(PDO::FETCH_ASSOC);
$nombreU=$resultado['nombres'];
$apellidosU=$resultado['apellidos'];


$fechaReservacion=$con->prepare("SELECT fechaAsignada from tblreserva where cod_reserva='$cod_reserva'");
$fechaReservacion->execute(); 
$resultadoFecha=$fechaReservacion->fetch(PDO::FETCH_ASSOC);

$fechaDeReservacion=$resultadoFecha['fechaAsignada'];

$empresa=$con->prepare("SELECT * from ciudadoresguar where cod_empresa='$cod_empresa'");
$empresa->execute();
$resultadoE=$empresa->fetch(PDO::FETCH_ASSOC);
$nombreEM=$resultadoE['nombre'];
$ciudadEM=$resultadoE['ciudad'];
$teleEM=$resultadoE['telefono'];
$direccionEM=$resultadoE['direccion'];
$estado='activo';

$sql=$con->prepare("UPDATE tblreserva SET estado='$estado' where cod_reserva='$cod_reserva'");
$sql->execute();


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
    $mail->addAddress($correo);     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reservacion aceptada en Geopet';
    $mail->Body    = 'Señor@  ' . $nombreU . ' Su reservacion ha sido aceptada por la empresa ' . $nombreEM . ' ubicada en ' . $direccionEM . '-' . $ciudadEM . ' y a quedado asiganada para la hora ' . $hora .  ' para la relización del servicio  ' . $servicio . ' a la mascota ' . $mascota .  ' el dia ' . $fechaDeReservacion;
    $mail->send();
    echo '<script>alert("El mensaje ha sido enviado recuerde al finalizar la reservacion finalizar en geopet");
    window.location="../empresa/reservasEmpre.php"
    </script>';
} catch (Exception $e) {
    echo "el mensaje no pudo ser enviado: {$mail->ErrorInfo}";
}
    


        







?>