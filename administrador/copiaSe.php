<?php session_start();

//se hace la sesion para que no se pueda ingresar a la pagina principal sin antes haber iniciado sesion
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
  header("location: ../ingresar/ingresar.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Configuración</title>
    <link rel="stylesheet" href="../estilosCss/modificar.css">
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
      <a href="mensajes.php">
      <i class="fa-solid fa-comment"></i>
        <span>Mensajes</span>
      </a>
      <a href="../graficas/graficas.php">
      <i class="fas fa-calendar"></i>
        <span>Reportes</span>
      </a>
      <a href="copiaSe.php" class="active">
      <i class="fa-solid fa-cloud-arrow-down"></i>
        <span>Seguridad</span>
      </a>
      <a href="../ingresar/cerrar-sesion.php">
      <i class="fa-solid fa-right-from-bracket"></i>
        <span>Salir</span>
      </a>

    </div>

    <!-- boton que servira para descargar la base de datos -->

    <h1 class="title">Descargar Copia de Seguridad</h1>

      
<a href="backup.php"><button class="button" style="vertical-align:middle"><span>Descargar</span></button></a>

  </body>
</html>