<?php
 session_start();

 //se hace la sesion para que no se pueda ingresar a la pagina principal sin antes haber iniciado sesion
 if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
   header("location: ingresar.php");
   exit;
}
require'../config/token.php';
require '../config/database.php';


$db=new database();
$con = $db->conectar();

//se pone el id de la empresa y el token en el get 
$id=isset($_GET['di']) ? $_GET['di'] : '';
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
    $sql=$con->prepare("SELECT count(cod_empresa) FROM ciudadoresguar where cod_empresa=?");
    $sql->execute([$id]);
    if($sql->fetchColumn() > 0){

        $borrar=$con->prepare("UPDATE ciudadoresguar  SET situacion='2' WHERE cod_empresa='$id'");
        $borrar->execute();

        if($borrar){
            echo'<script>alert("La empresa ha sido bloqueada esto significa que ningun usuario podra visualizarla");
            window.location="../administrador/admin.php";
            </script>';
        }

    
    }
    
  }else{
    echo'error al hacer la peticion';
  }
}
?>