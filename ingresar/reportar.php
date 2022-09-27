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
  <link rel="stylesheet" href="../estilosCss/reportar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<script>
    swal("RECUERDA", "La difamación de una empresa o persona es un acto delictivo");
    </script>
  <!-- por medio de un formulario se le dara la opcion al usuario de reportar una empresa 
para ello le proporcionamos un combobox donde debera buscar la empresa y un textarea en donde
debera de justificar su reporte -->
<div class="content">

<div class="contact-wrapper animated bounceInUp">
    <div class="contact-form">
        <h3>Reportar</h3>
        <form action="insertarReporte.php" method="post"  onsubmit="return validacionReporte();">
            <p>
                <label>Empresa</label>
                <input type="text" name="cEmpresa" value="<?php echo $cod_empresa;?>" readonly>
            </p>
            <p class="block">
               <label>Documento de identificación</label> 
               <input type="text" name="docid" id="docdi" value="<?php echo $sesion;?>" readonly>            
            </p>
            
            <p class="block">
               <label>Justifique el reporte de la empresa</label> 
                <textarea name="message" rows="3" id="empresaReport" required ></textarea>
            </p>
            <p class="block">
                <button>
                    Reportar
                </button>
            </p>
        </form>
    </div>
    
</div>

</div>

<script src="validacionReporte.js"></script>

</body>
</html>
