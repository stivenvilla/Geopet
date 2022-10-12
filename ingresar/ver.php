<?php

    session_start();

    $sesion=$_SESSION["doc_id"];
    if(!isset($sesion)){
        header("location: ingresar.php");
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
    $sql=$con->prepare("SELECT count(cod_empresa) FROM ciudadoresguar where cod_empresa=?");
    $sql->execute([$id]);
    if($sql->fetchColumn() > 0){

      $sql=$con->prepare("SELECT * FROM ciudadoresguar where cod_empresa=? limit 1");
      $sql->execute([$id]);
      $resultado=$sql->fetch(PDO::FETCH_ASSOC);

      $cod_empresa=$resultado['cod_empresa'];
      $descripcion=$resultado['servicios'];
      $direccion=$resultado['direccion'];
      $ciudad=$resultado['ciudad'];
      $correo=$resultado['correo'];
      $nombre=$resultado['nombre'];
      $tele=$resultado['telefono'];

      



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
  <link rel="stylesheet" href="../estilosCss/ver2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
</head>
<body>
    <script>
        swal("Reservación", "Geopet necesita su autorización compartir su información con terceros");
    </script>
  
<div class="content">

<div class="contact-wrapper animated bounceInUp">
    <div class="contact-form">
        <h3>Reservar</h3>
        <form action="ver2.php" method="post"  onsubmit="return validacionContacto();">
            <p>
                <label>Empresa</label>
                <input type="text" name="empresa" id="empresa" value="<?php echo $cod_empresa ?>" readonly>
            </p><br><br>
            <p>
                <label>Documento de iDentificación</label>
                <input type="text" name="docid" id="docid" value="<?php echo $sesion;?>" readonly>
            </p>
            
                <p class="block">
                <button>
                    Autorizar
                </button>
            </p>
        </form>
    </div>
    <div class="contact-info">
        <h4><?php echo  strtoupper($nombre) ?></h4>
        <ul>
            <li><i class="fas fa-map-marker-alt"></i> <?php echo  $ciudad . "-" . $direccion ?></li>
            <li><i class="fas fa-phone"></i> <?php echo  $tele ?></li>
            <li><i class="fas fa-envelope-open-text"></i>  <?php echo $correo ?></li>
        </ul>
        <p><?php echo $descripcion ?></p>
        <a href="reportar.php?id=<?php echo $cod_empresa;?>&token=<?php echo hash_hmac('sha1', $cod_empresa, KEY_TOKEN);?>"><img src="../imagenes/alerta.png" alt="" title="Reportar"></a>
    </div>
</div>

</div>


<script src="../javaScript/validacionReserva.js"></script>

</body>
</html>
