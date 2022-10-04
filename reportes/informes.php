
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../estilosCss/reportes.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fd9d79a2e5.js" crossorigin="anonymous"></script>

    <title>GEOPET</title>
</head>

 
  
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> -->
  <!-- <script src="https://code.jquery.com/jquery-3.4.1.js"></script> -->
 
  
</head>
<body>
  <div class="wrapper">
    <nav>
        <div class="content">
           <div class="logo"> <a href="#">GEOPET</a></div>
           <div class ="inicio" ><a href="../administrador/admin.php">Volver</a></div>
        </div>
    </nav>
  </div>

  <input type="checkbox" id="check">
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar" style="overflow-y:scroll;">
      <header>
        REPORTES
      </header>

      <a href="tabla0cantidadReservas.php" >
      <i class='fa fa-file-text-o'></i>
       <span>Cant. Reservas por mes </span>
      </a>

      <a href="tabla1cantidadReservasEmp.php" >
      <i class='fa fa-file-text-o'></i>
       <span>Cant. Reservas por mes (Empr)</span>
      </a>

      <a href="tabla2reservaultimomes.php">
      <i class="fa-solid fa fa-file-text-o"></i>
        <span>Empr. con reservas el último mes</span>
      </a>

      <a href="tabla2totReservaEmp.php">
      <i class="fa-solid fa fa-file-text-o"></i>
        <span> Cant. reservas por empresa</span>
      </a>

      
      <a href="tabla3servicioMasSolic.php">
      <i class="fa-solid fa fa-file-text-o"></i>
        <span>Servicios más solicitados</span>
      </a>
    
      <a href="tabla4servicioMasSoliciEmp.php">
      <i class="fa-solid fa fa-file-text-o"></i>
        <span> Servicios solicitados (Empr)</span>
      </a>

      <a href="tabla5fechasReserva.php">
      <i class="fa-solid fa fa-file-text-o"></i>
        <span> información de reservas </span>
      </a>

      <a href="tabla6usuarioMasReserva.php">
      <i class="fa fa-file-text-o"></i>
        <span>Usuario que más reserva</span>
      </a>

      <a href="tabla7reservasCanceladas.php">
      <i class="fa-solid fa fa-file-text-o"></i>
        <span>Reservas canceladas</span>
      </a>

      <a href="tabla8reservasActivas.php">
      <i class="fa-solid fa fa-file-text-o"></i>
        <span>Reservas Activas</span>
      </a>
      <a href="tabla9reservasFinalizadas.php">
      <i class="fa-solid fa fa-file-text-o"></i>
        <span>Reservas Finalizadas</span>
      </a>

      <a href="../ingresar/cerrar-sesion.php">
      <i class="fa-solid fa-right-from-bracket"></i>
        <span>Salir</span>
      </a>

    <ul>
      <li><a href=""></a></li>
    </ul>


    </div>

</body>

</html>

