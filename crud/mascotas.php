<?php
session_start();

$sesion=$_SESSION["doc_id"];
if(!isset($sesion)){
    header("location: ../ingresar/ingresar.php");
    exit;
}
//se esta llamando a la base de datos
  require '../config/database.php';
  $db=new database(); //se hace una instancia de la base de datos
  $con = $db->conectar();
  //$pets=$_POST['petsSearch'];
  $mascotas=$con->prepare("SELECT tblmascota.nombreMacota, tblmascota.fechaNaci, tblraza.nombre as raza, tblmascota.recomendaciones, tblmascota.fotoMascota   FROM tblmascota inner join tblraza on tblmascota.raza=tblraza.cod_raza where doc_id='$sesion'"); //se prepara la consulta
  $mascotas->execute(); //se ejecuta la consulta
  $resultadoPets=$mascotas->fetchAll(PDO::FETCH_ASSOC); //se hace un array
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../estilosCss/mascotas.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fd9d79a2e5.js" crossorigin="anonymous"></script>
    <title>configuración</title>
</head>
<body>
<input type="checkbox" id="check">
<label for="check">
  <i class="fas fa-bars" id="btn"></i>
  <i class="fas fa-times" id="cancel"></i>
</label>
<div class="sidebar">
  <header>
    configuración
  </header>
  <a href="../ingresar/bienvenida.php">
  <i class="fa-solid fa-house-user"></i>
    <span>Inicio</span>
  </a>
  <a href="../crud/datos.php">
  <i class="fa-solid fa-circle-info"></i>
    <span>Datos</span>
  </a>
  <a href="../crud/misReservas.php">
     <i class="fas fa-calendar"></i>
    <span>Reservas</span>
  </a>
  <a href="../crud/mascotas.php" class="active">
  <i class="fa-sharp fa-solid fa-paw"></i>
    <span>Mascotas</span>
  </a>
  <a href="../crud/cambioDeclaveU.php">
  <i class="fa-sharp fa-solid fa-lock"></i>
  <span>Contraseña</span>
  </a>
  <a href="../ingresar/cerrar-sesion.php">
  <i class="fa-solid fa-right-from-bracket"></i>
    <span>Salir</span>
  </a>

</div>
    <!-- pagina en la que el usuario podra ver las mascotas que son de su propieda -->
    <div class="container">
      <?php foreach($resultadoPets as $ism) { ?>
        <div class="card">
        <div class="imgBx">
        <img class="card-img" src="data:image/jpeg;base64,<?php echo base64_encode($ism['fotoMascota']); ?>" alt="">

      </div>
        <div class="content">
            <h2><?php echo $ism['nombreMacota']?></h2><br>
            <p>Nacimiento: <?php echo $ism['fechaNaci']?> <br>
              Raza: <?php echo $ism['raza']?><br>
              recomendaciones: <?php echo $ism['recomendaciones']?>
          </p>
          
        </div>
        </div>
        <?php } ?>
  </div>

    
  
</body>
</html>