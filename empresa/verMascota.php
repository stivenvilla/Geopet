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
$id=isset($_GET['i']) ? $_GET['i'] : '';
$mascota=isset($_GET['m']) ? $_GET['m'] : '';
$token=isset($_GET['token']) ? $_GET['token'] : '';

//se verifica el id y el token de que no esten vacios
if($id=='' || $mascota=='' || $token==''){
    echo'error al hacer la peticion'; 
    exit; 
}else{
  /*lo que se esta haciendo es poner hacer que no se pueda modificar el token 
  si se le cambia alguna letra o numero este mostrara error*/
  $token_tmp=hash_hmac('sha1', $id, KEY_TOKEN);
  if($token==$token_tmp){
    $sql=$con->prepare("SELECT count(doc_id) FROM tblmascota where doc_id=?");
    $sql->execute([$id]);
    if($sql->fetchColumn() > 0){

        $consultaMAS=$con->prepare("SELECT tblmascota.cod_mascota, tblmascota.doc_id, tblmascota.nombreMacota, tblmascota.fechaNaci, tblraza.nombre as raza, tblmascota.recomendaciones, tblmascota.fotoMascota FROM tblmascota INNER JOIN tblraza ON tblmascota.raza=tblraza.cod_raza WHERE tblmascota.doc_id='$id' and tblmascota.nombreMacota='$mascota'");
        $consultaMAS->execute();
        $resultadoR=$consultaMAS->fetch(PDO::FETCH_ASSOC);
        $cod_mascota=$resultadoR['cod_mascota'];
        $doc_id=$resultadoR['doc_id'];
        $nombre=$resultadoR['nombreMacota'];
        $fechaN=$resultadoR['fechaNaci'];
        $raza=$resultadoR['raza'];
        $recomendaciones=$resultadoR['recomendaciones'];
        $fotoM=$resultadoR['fotoMascota'];

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../estilosCss/verMascota.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mascota</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="imgBx" data-text="Mascota">
            <img class="card-img" src="data:image/jpeg;base64,<?php echo base64_encode($fotoM); ?>" alt="">
            </div>
            <div class="content">
            <div>
            <h3><?php echo $nombre;?></h3>
            <p>Fecha Nacimiento: <?php echo $fechaN;?><br>Raza: <?php echo $raza;?><br>Recomendaciones: <?php echo $recomendaciones;?></p>
        </div>
    </div>
</div>
</div>
</body>
</html>