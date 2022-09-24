<?php

session_start();
$sesion=$_SESSION["cod_empresa"];
if(!isset($sesion)){
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
    <!-- menu lateral el cual sirve para que el usuario pueda selecionar lo que desea hacer -->
    <input type="checkbox" id="check">
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
      <header>
        configuración
      </header>
      <a href="../empresa/datosEmpresa.php">
      <i class="fa-solid fa-circle-info"></i>
        <span>Datos</span>
      </a>
      <a href="../empresa/reservasEmpre.php">
         <i class="fas fa-calendar"></i>
        <span>Reservas</span>
      </a>
      <a href="../empresa/finalizarReservas.php">
      <i class="fas fa-calendar"></i>
        <span>Finalizar</span>
      </a>
      <a href="../empresa/servicios.php" class="active">
      <i class="fa-solid fa-truck-medical"></i>
        <span>Servicios</span>
      </a>
      <a href="../empresa/cambioDeclaveE.php">
      <i class="fa-solid fa-lock"></i>
        <span>Contraseña</span>
      </a>
      <a href="../ayuda/ayudaEmpresa.php">
      <i class="fa-sharp fa-solid fa-question"></i>
        <span>Ayuda</span>
      </a>
      <a href="../ingresar/cerrar-sesion.php">
      <i class="fa-solid fa-right-from-bracket"></i>
        <span>Salir</span>
      </a>

    </div>
      <div class="container-all">

        <div class="ctn-form">
            <h1 class="title">Añadir Servicio</h1>
            
            <form action="ServiciosMod.php" method="post" >
                <label for="">Nit Empresa</label>
                <input type="text" name="docid" value="<?php echo $sesion;?>" readonly>

                <label for="">Nombre</label>
                <input type="text" name="nombre" value="">
                
            <input type="submit" value="Enviar">

            </form>
            
        </div>
            
        </div>
  </body>
</html>