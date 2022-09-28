<?php
//se esta llamando a la base de datos
  require '../config/database.php';
  $db=new database(); //se hace una instancia de la base de datos
  $con = $db->conectar();
  $sql=$con->prepare("SELECT * FROM mensajes"); //se prepara la consulta
  $sql->execute(); //se ejecuta la consulta
  $resultado=$sql->fetchAll(PDO::FETCH_ASSOC); //se hace un array
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Configuración</title>
    <link rel="stylesheet" href="../estilosCss/mensajesC.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fd9d79a2e5.js" crossorigin="anonymous"></script>
  </head>
  <body>
  <input type="checkbox" id="check">
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
      <header>
        Configuración
      </header>
      <a href="admin.php" >
      <i class="fa-solid fa-house-circle-check"></i>
        <span>Empresas</span>
      </a>
      <a href="bloqueadas.php" >
      <i class="fa-solid fa-house-circle-xmark"></i>
        <span>Bloqueadas</span>
      </a>
      <a href="usuariosGeopet.php">
      <i class="fa-solid fa-users"></i>
        <span>Usuarios</span>
      </a>
      <a href="mensajes.php" class="active">
      <i class="fa-solid fa-comment"></i>
        <span>Mensajes</span>
      </a>
      <a href="#">
      <i class="fas fa-calendar"></i>
        <span>Reportes</span>
      </a>
      <a href="copiaSe.php">
      <i class="fa-solid fa-cloud-arrow-down"></i>
        <span>BD</span>
      </a>
      <a href="../ingresar/cerrar-sesion.php">
      <i class="fa-solid fa-right-from-bracket"></i>
        <span>Salir</span>
      </a>

    </div>



    <!-- carta para ver los mensajes -->
    <div class="container">
      <?php foreach($resultado as $row){?>
        <div class="car">
            <div class="imgBox">
                <img src="../imagenes/logo.PNG" alt="">
            </div>
            <div class="details">
                <p><?php echo $row['correo'] ?></p> <br>
                <p>Asunto: <?php echo $row['asunto'] ?></p> <br>
                <p><?php echo $row['mensaje'] ?></p> <br> <br>
                <p>Atentamente: <?php echo $row['nombre'] ?></p> <br>
                <p>Teléfono: <?php echo $row['numero'] ?></p> 

            </div>
        </div> 
        <?php } ?>
    </div>



    </body>
</html>