<?php
session_start();
$sesion=$_SESSION["cod_empresa"];
if(!isset($sesion)){
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
if($id=='' ||  $token==''){
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
        $estado='finalizado';
        $consult=$con->prepare("UPDATE tblreserva SET fechaFinalizada=CURDATE(), estado='$estado'  where cod_reserva='$id'");
        $consult->execute();

        if($consult){
          echo'<script>alert("la reservacion ha sido finalizada");
          window.location="../empresa/datosEmpresa.php";
          </script>';
            
        }
        
    }
    
  }else{
    echo'error al hacer la peticion';
  }
}


?>

