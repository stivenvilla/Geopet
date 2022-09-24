<?php
require_once "../config/database.php";
$db=new database();
$con = $db->conectar();
$tipoUsuario=$_POST['user'];
$docid=$_POST['docid'];
$correo=$_POST['correo'];
$clave1=$_POST['pass'];
$clave2=$_POST['pass2'];


switch($tipoUsuario){
    case 1:
        if($clave1===$clave2){
            $param_password =password_hash($clave1, PASSWORD_DEFAULT);
            $sql=$con->prepare("UPDATE tblusuario SET clave='$param_password' where doc_id='$docid'");
            $sql->execute();
        
            if($sql){
                echo'
                  <script>alert("Apreciado usuario su clave ha sido cambiada exitosamente");
                  window.location="../ingresar/ingresar.php";
                  </script>
                
                ';
              }else{
            echo'
            <script>alert("Las contraseñas no son iguales por favor verifiquelas");
            return false; 
            </script>
          
          ';
          }

        }
        
        break;
    case 2:
        if($clave1===$clave2){
            $param_password =password_hash($clave1, PASSWORD_DEFAULT);
            $sql=$con->prepare("UPDATE ciudadoresguar SET clave='$param_password' where cod_empresa='$docid'");
            $sql->execute();
        
            if($sql){
                echo'
                <script>alert("Apreciada empresa su clave ha sido cambiada exitosamente");
                window.location="../ingresar/ingresar.php";
                </script>
                
                ';
              }
            
          }else{
            echo'
            <script>alert("Las contraseñas no son iguales por favor verifiquelas");
            return false; 
            </script>
          
          ';
          }
        break; 
    case 3:
        if($clave1===$clave2){
            $param_password =password_hash($clave1, PASSWORD_DEFAULT);
            $sql=$con->prepare("UPDATE administrador SET clave='$param_password' where correo='$correo'");
            $sql->execute();
        
            if($sql){
                echo'
                <script>alert("Apreciado administrador su clave ha sido cambiada exitosamente");
                window.location="../ingresar/ingresar.php";
                </script>
                
                ';
              }
            
          }else{
            echo'
            <script>alert("Las contraseñas no son iguales por favor verifiquelas");
            return false; 
            </script>
          
          ';
          }
        break;
    default:

}

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
$mail->Subject = utf8_decode('Notificación de Geopet cambio de contraseña');
$mail->Body    = "Apreciado usuario usted ha decidido cambiar su contraseña si no ha sido usted por favor reportelo muchas gracias";
$mail->send();
} catch (Exception $e) {
echo "el mensaje no pudo ser enviado: {$mail->ErrorInfo}";
}

?>