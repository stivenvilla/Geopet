<?php
  require '../config/database.php';
  $db=new database();
  $con = $db->conectar();
  $sql=$con->prepare("SELECT ciudadoresguar.cod_empresa, ciudadoresguar.nombre, ciudad.nombre AS ciudad, ciudadoresguar.telefono, ciudadoresguar.direccion, ciudadoresguar.servicios, ciudadoresguar.correo, ciudadoresguar.foto_establecimiento, ciudadoresguar.situacion FROM ciudadoresguar INNER JOIN ciudad ON ciudadoresguar.ciudad=ciudad.cod_ciudad WHERE situacion='1'");
  $sql->execute();
  $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>GEOPET</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
</head>
<body>
  <div class="wrapper">
    <nav>
      <input type="checkbox" id="show-search">
      <input type="checkbox" id="show-menu">
      <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
      <div class="content">
        <!-- se realiza el logo -->
      <div class="logo"><a href="#">GEOPET</a></div>
       <!-- en esta parte es donde se realiza los botones que estaran en el header
      tambien las listas desplegables -->
        <ul class="links">
          <li><a href="../contacto/email.php">Contacto</a></li>
          <li><a href="../ayuda/ayuda.php">Ayuda</a></li>
          <li>
            <a href="../ingresar/ingresar.php" class="desktop-link">Ingresar</a>
            <input type="checkbox" id="show-services">
            <label for="show-services">Ingresar</label>
          </li>
          <li>
            <a href="#" class="desktop-link">Registrarse</a>
            <input type="checkbox" id="show-features">
            <label for="show-features">Registrarse</label>
            <ul>
              <li><a href="../Login_UE/register.php">Usuario</a></li>
              <li><a href="../registroEmpresa/empresaRegistro.php">Empresa</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- parte encargada de la realizacion de busqyedas -->
      <label for="show-search" class="search-icon" ><i class="fas fa-search"></i></label>
      <form action="#" class="search-box">
        <input type="text" placeholder="Busca por ciudad, nombre o servicio.." required id="buscador">
      </form>
    </nav>
  </div>

  <script type="text/javascript">
    function mostrar(){
      swal("ADVERTENCIA", "Señor usuario para realizar una reservación debe de iniciar sesión");
    }

  </script>
  


  <!-- en este codigo lo que hacemos es poner las cartas de forma dinamica para que traigan los datos de la base de datos utilizando php -->
  <div class="grid">
    <!--carta de los servicios de la pagina-->
    <?php foreach($resultado as $row){?>
  <div class="grid-item articulo">
    <div class="card articulo">
      <img class="card-img" src="data:image/jpeg;base64,<?php echo base64_encode($row['foto_establecimiento']); ?>" alt="">
      <div class="card-content articulo">
        <h1 class="card-header "><?php echo $row['nombre'];?></h1>
        <span class="direcion "><?php echo $row['ciudad'] . " " . $row['direccion'];?></span>
        <p class="card-text "><?php echo $row['servicios'] ?></p>
        <button class="card-btn" onclick="mostrar()">Reservar</button>
        <!-- <div class="alert hide">
         <span class="fas fa-exclamation-circle"></span>
         <span class="msg">POR FAVOR INICIE SESIÓN</span>
         <div class="close-btn">
            <span class="fas fa-times"></span>
         </div>
      </div> -->
      </div>
    </div>
  </div>
  <?php } ?>

  </div>

  <!-- codigo java script que se encarga de generar una notificacion a la hora de oprimir un boton -->
  <!-- <script>
         $('button').click(function(){
           $('.alert').addClass("show");
           $('.alert').removeClass("hide");
           $('.alert').addClass("showAlert");
           setTimeout(function(){
             $('.alert').removeClass("show");
             $('.alert').addClass("hide");
           },5000);
         });
         $('.close-btn').click(function(){
           $('.alert').removeClass("show");
           $('.alert').addClass("hide");
         });
      </script> -->


  <script src="script.js"></script>
</body>
</html>
