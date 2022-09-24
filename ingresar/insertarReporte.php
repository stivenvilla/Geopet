
<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
header("location: ingresar.php");
exit;
}

require'../config/token.php';
require '../config/database.php';


$db=new database();
$con = $db->conectar();

$empresa=$_POST['cEmpresa'];
$justificacion=$_POST['message'];
$documento=$_POST['docid'];
$correo='administradorGeopet@gmail.com';

//se inserta el reporte hecho por el usuario a la empresa en la base de datos y luego utilizando la libreria de phpmailer se le envia al administrador la notificacion de que "" empresa fue reportada

$sql=$con->prepare("INSERT INTO reportar(cod_empresa, doc_id, justificacion, fechaReporte) VALUES('$empresa','$documento','$justificacion',CURDATE())");
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
$mail->Username   = 'anonimogeopet@gmail.com';                     //SMTP username
$mail->Password   = 'yssxugkqqbzavdfn';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//Recipients
$mail->setFrom('anonimogeopet@gmail.com', 'Geopet');
$mail->addAddress('geopet.proy@gmail.com');     //correo del administrador


//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = 'Reporte de empresa en geopet';
$mail->Body    = "Señor@  administrador la empresa identifacada con el numero {$empresa} ha sido reportada por un usuario, por favor analise el siguiente reporte y tome una decision acertada: <br> <p>motivo del reporte: {$justificacion}</p>";
$mail->send();
echo '<script>alert("La empresa ha sido reportada");
window.location="../ingresar/bienvenida.php";
</script>';
} catch (Exception $e) {
echo "el mensaje no pudo ser enviado: {$mail->ErrorInfo}";
}




?>
    





