<?php

require'../config/token.php';
require '../config/database.php';
$cod_reserva=$_POST['RSC'];
$mensaje=$_POST['message'];
$cod_empresa=$_POST['empresa'];
$docid=$_POST['docid'];
$mascota=$_POST['mas'];
$correo=$_POST['correo'];
$servicio=$_POST['serv'];

//se realizan consultas de datos que son importantes a la hora de enviar el correo que le informara al usuario de que la empresa ha cancelado la reservacion

$db=new database();
$con = $db->conectar();

$usuario=$con->prepare("SELECT nombres, apellidos from tblusuario where doc_id='$docid'");
$usuario->execute();
$resultado=$usuario->fetch(PDO::FETCH_ASSOC);

$nombreU=$resultado['nombres'];
$apellidosU=$resultado['apellidos'];

$empresa=$con->prepare("SELECT * from ciudadoresguar where cod_empresa='$cod_empresa'");
$empresa->execute();
$resultadoE=$empresa->fetch(PDO::FETCH_ASSOC);
$nombreEM=$resultadoE['nombre'];
$ciudadEM=$resultadoE['ciudad'];
$teleEM=$resultadoE['telefono'];
$direccionEM=$resultadoE['direccion'];
$cambio='cancelado';

$sql=$con->prepare("UPDATE tblreserva SET  estado='$cambio' where cod_reserva='$cod_reserva'");
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
    $mail->Subject = 'Reservacion Denegada en Geopet';
    $mail->Body    = 'Señor@ ' . $nombreU . ' la empresa  ' . $nombreEM . ' ubicada en ' . $direccionEM . '-' . $ciudadEM . ' a denegado su reservacion por las siguientes razones ' . $mensaje . ' <br>si presenta alguna inquietud comuniquese con la empresa al numero  ' . $teleEM;

    $mail->send();
    echo '<script>alert("El mensaje ha sido enviado");
    window.location="../empresa/datosEmpresa.php";
    </script>';
}catch (Exception $e) {
    echo "el mensaje no pudo ser enviado: {$mail->ErrorInfo}";
}
    


        







?>