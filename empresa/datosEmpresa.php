<?php
 session_start();

 $sesion=$_SESSION["cod_empresa"];
 if(!isset($sesion)){
     header("location: ../ingresar/ingresar.php");
     exit;
 }


//se le mpresentan los datos a la empresa con la posibilidad de modificarlos y esto tambien lo que hara es hacer 
//una actualizacion de estos datos
  require '../config/database.php';
  //$busquedad=$_POST['busquedad'];
  $db=new database();
  $con = $db->conectar();
  $sql=$con->prepare("SELECT ciudadoresguar.cod_empresa, ciudadoresguar.nombre, ciudadoresguar.telefono, ciudadoresguar.direccion, ciudadoresguar.servicios, ciudadoresguar.correo FROM ciudadoresguar  WHERE cod_empresa='$sesion'");
  $sql->execute();
  $resultado=$sql->fetch(PDO::FETCH_ASSOC);
  $cod_empresa=$resultado['cod_empresa'];
  $nombre=$resultado['nombre'];
  $tele=$resultado['telefono'];
  $direccion=$resultado['direccion'];
  $servicios=$resultado['servicios'];
  $correo=$resultado['correo'];

  $vive=$con->prepare("SELECT * FROM ciudad ORDER BY nombre ASC");
  $vive->execute();
  $ciudadR=$vive->fetchAll(PDO::FETCH_ASSOC);


  if(!$resultado){
    echo'
    <script>alert("Los datos no han sido cargados por favor intentelo nuevamente");
    return false; 
    </script>
    ';
  
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
        configuración
      </header>
      <a href="../empresa/datosEmpresa.php" class="active">
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
      <a href="../empresa/servicios.php">
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
            <h1 class="title">Actualizar Datos</h1>
            
            <form action="actualizarEmpresa.php" method="post" >
                <label for="">Numero de Identificación</label>
                <input type="text" name="docid" value="<?php echo $cod_empresa; ?>" readonly>

                <label for="">Nombre</label>
                <input type="text" name="nombre" value="<?php echo $nombre;?>">
                
                <label for="">Ciudad</label>
                <select name="ciud" class="select">
                  <option value="">Selecionar Ciudad</option>
                    <?php foreach($ciudadR as $ciudad){ ?>
                    <option value="<?php echo $ciudad['cod_ciudad']; ?>"><?php echo $ciudad['nombre']; ?></option>
                    <?php } ?>
                </select>

                <label for="">Telefono</label>
                <input type="text" name="telefono" value="<?php echo $tele; ?>">
                

                <label for="">dirección</label>
                <input type="text" name="direccion" value="<?php echo $direccion; ?>">
                
                
                
                <label for="">Servicios</label>
                <textarea name="service" id="" cols="30" rows="10" maxlength="120" ><?php echo $servicios; ?></textarea>
               

                <label for="">Correo electronico</label>
                <input type="text" name="correo" value="<?php echo $correo; ?>" pattern="[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$">
                
                
                
                <input type="submit" value="ACTUALIZAR">

            </form>
            
        </div>
            
        </div>
      

      <a href="../registroEmpresa/fotos.php"><button class="icon-btn add-btn">
    <div class="add-icon"></div>
    <div class="btn-txt">Modificar Foto</div>
</button></a>

<a href="../empresa/servicios.php"><button class="icon-btn add-btn">
    <div class="add-icon"></div>
    <div class="btn-txt">Servicios</div>
</button></a>


      <script src="loa.js"></script>
  </body>
</html>