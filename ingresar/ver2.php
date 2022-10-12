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

$empresa=$_POST['empresa'];
$identificación=$_POST['docid'];


$sql=$con->prepare("SELECT * FROM ciudadoresguar where cod_empresa='$empresa' limit 1");
$sql->execute();
$resultado=$sql->fetch(PDO::FETCH_ASSOC);

$cod_empresa=$resultado['cod_empresa'];
$descripcion=$resultado['servicios'];
$direccion=$resultado['direccion'];
$ciudad=$resultado['ciudad'];
$correo=$resultado['correo'];
$nombre=$resultado['nombre'];
$tele=$resultado['telefono'];


$sql2=$con->prepare("SELECT cod_servicio, nombre FROM tblservicio where cod_empresa='$empresa'");
$sql2->execute();
$resultado2=$sql2->fetchAll(PDO::FETCH_ASSOC);


$mascotaSql=$con->prepare("SELECT cod_mascota, nombreMacota from tblmascota where doc_id='$identificación'");
$mascotaSql->execute();
$ms=$mascotaSql->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>GEOPET</title>
  <link rel="stylesheet" href="../estilosCss/ver.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
</head>
<body>

<script>  
      swal("ADVERTENCIA", "Señor usuario en la pagina Geopet no se realiza ningun tipo de pago si debe de hacer algun pago por favor reportelo");
</script>
  
<div class="content">

<div class="contact-wrapper animated bounceInUp">
    <div class="contact-form">
        <h3>Reservar</h3>
        <form action="reservar.php" method="post"  onsubmit="return validacionContacto();">
            <p>
                <label>Empresa</label>
                <input type="text" name="empresa" id="empresa" value="<?php echo $cod_empresa ?>" readonly>
            </p>
            <p>
                <label>Documento de iDentificación</label>
                <input type="text" name="docid" id="docid" value="<?php echo $identificación;?>" readonly>
            </p>
            <p>
                <label>Mascota</label>
                <select name="namePet" class="block">
                <option value="0">Selecionar Mascota</option>
                <?php foreach($ms as $mascota){ ?>
                    <option value="<?php echo $mascota['cod_mascota'];?>"><?php echo $mascota['nombreMacota']; ?></option>
                    <?php } ?>
                   
                </select>
                <a href="../Login_UE/mascotaRegistro.php"><img src="../imagenes/huella.png" title="Registrar Mascota"></a>
            </p>
            <p></p>
            
            <p>
                <label>Servicio</label>
                <select name="service" id="servicio" class="block">
                    <option value="">Selecionar Servicio</option>
                    <?php foreach($resultado2 as $servici){ ?>
                    <option value="<?php echo $servici['cod_servicio']; ?>"><?php echo $servici['nombre']; ?></option>
                    <?php } ?>
                </select>
            </p>
            <p>
                <label>Fecha de Reservación</label>
                <input type="date" name="reservation" id="reservat">
            </p>

            <p class="block">
                <button>
                    Reservar
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
        <a href="reportar.php?id=<?php echo $cod_empresa;?>&token=<?php echo hash_hmac('sha1',$cod_empresa, KEY_TOKEN);?>"><img src="../imagenes/alerta.png" alt="" title="Reportar"></a>

    </div>
</div>

</div>


<script src="../javaScript/validacionReserva.js"></script>

</body>
</html>
