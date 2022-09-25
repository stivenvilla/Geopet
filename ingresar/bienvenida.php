<?php

    session_start();

    //se hace la sesion para que no se pueda ingresar a la pagina principal sin antes haber iniciado sesion
    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
      header("location: ingresar.php");
      exit;
  }

require'../config/token.php';
require '../config/database.php';
$db=new database();
$con = $db->conectar();
$sql=$con->prepare("SELECT ciudadoresguar.cod_empresa, ciudadoresguar.nombre, ciudad.nombre AS ciudad, ciudadoresguar.telefono, ciudadoresguar.direccion, ciudadoresguar.servicios, ciudadoresguar.correo, ciudadoresguar.foto_establecimiento, ciudadoresguar.situacion FROM ciudadoresguar INNER JOIN ciudad ON ciudadoresguar.ciudad=ciudad.cod_ciudad WHERE situacion='1' ");
$sql->execute();
$resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

include '../comentar/comentario.php';

$coment=$con->prepare("SELECT correo, contacto, mensaje, fechaComent FROM comentarios ORDER BY day(fechaComent) DESC");
$coment->execute();
$resultadoComent=$coment->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>GEOPET</title>
  <link rel="stylesheet" href="../estilosCss/principal.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  
</head>
<body>



  <div class="wrapper">
    <nav>
      <input type="checkbox" id="show-search">
      <input type="checkbox" id="show-menu">
      <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
      <div class="content">
      <div class="logo"><a href="#">GEOPET</a></div>
        <ul class="links">
          <li><a href="../contacto/email.php">Contacto</a></li>
          <li><a href="../ayuda/ayuda.php">Ayuda</a></li>
          
          <li>
            <a href="#" class="desktop-link">Configuración</a>
            <input type="checkbox" id="show-features">
            <label for="show-features">Configuración</label>
            <ul>
              <li><a href="../crud/datos.php">Datos</a></li>
              <li><a href="../crud/misReservas.php">Reservas</a></li>
              <li><a href="../crud/cambioDeclaveU.php">Contraseña</a></li>
              <li><a href="../crud/mascotas.php">Mascotas</a></li>
              <li><a href="cerrar-sesion.php">Salir</a></li>
            </ul>
          </li>

          <li><a href="#comments"  onclick="toggle()">Comentarios</a></li>
        </ul>
      </div>




      <label for="show-search" class="search-icon" ><i class="fas fa-search"></i></label>
      <form action="#" class="search-box">
        <input type="text" placeholder="Busca por ciudad, nombre o servicio.." required id="buscador">
        <!-- <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button> -->
      </form>
    </nav>
  </div>


  


  <!-- en este codigo lo que hacemos es poner las cartas de forma dinamica para que traigan los datos de la base de datos utilizando php -->
  <div class="grid">
    <!--carta de los servicios de la pagina-->
    <?php foreach($resultado as $row){?>
  <div class="grid-item articulo">
    <div class="card articulo">
    <img class="card-img" src="data:image/jpeg;base64,<?php echo base64_encode($row['foto_establecimiento']); ?>" alt="">
      <div class="card-content articulo">
        <h1 class="card-header "><?php echo strtoupper($row['nombre']);?></h1>
        <span class="direcion "><?php echo $row['ciudad'] . " " . $row['direccion'];?></span>
        <p class="card-text "><?php echo $row['servicios'] ?></p>
        <a href="ver.php?id=<?php echo $row['cod_empresa'];?>&token=<?php echo hash_hmac('sha1',$row['cod_empresa'], KEY_TOKEN);?>"><button class="card-btn ">Reservar</button></a>
      </div>
    </div>
  </div>
  <?php } ?>

  </div>


  <!-- comentarios -->
  <div class="contact" id="coment">
        <h2 onClick="toggleClass()">Comentar<span>+</span></h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="row">
                <div class="col-2">
                    <label>Correo</label>
                    <input type="text" name="correo" class="text" placeholder="Correo electronico" required>
                    <span class="msg-error"> <?php echo $correo_err; ?></span>
                </div>

                
                <div class="col-2">
                    <label>Numero de contacto</label>
                    <input type="text" name="telefono" class="text" placeholder="numero de contacto">
                    <span class="msg-error"><?php echo $telefono_err; ?></span>
                  </div>

                
                <div class="col-2">
                    <label>escriba su comentario aqui</label>
                    <textarea placeholder="mensaje" name="mensaje" required></textarea>
                    <span class="msg-error"><?php echo $mensaje_err; ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-1">
                    <input type="submit" name="" value="Comentar">
                </div>
            </div>
            
        </form>
  
  
    </div>

    <script type="text/javascript">
        function toggleClass(){
            var element=document.getElementById('coment');
            element.classList.toggle("active")
        }

    </script>


    <!-- zona donde se mostraran todos los comentarios -->
    <?php foreach($resultadoComent as $co){?>
    <div id="L">
    <div id="container">
    	<ul id="comments">
        	<li class="cmmnt">
            	<div class="avatar">
                <img src="../imagenes/logomientras.jpg" height="55" width="55">
                </div>
                <div class="cmmnt-content">
                	<header>
                    <a href="#" class="userlink"><?php echo $co['correo'];?></a> - <span class="pubdate"><?php echo $co['fechaComent']; ?></span>
                    </header>
                    <p>
                    <?php echo $co['mensaje'];?>
                    </p>
                    <span>
                    
                    </span>
                </div>
                
            </li>        
        
        </ul>
    </div>
  </div>
  <?php } ?>
       

 


  <script src="../nab/script.js"></script>
</body>
</html>
