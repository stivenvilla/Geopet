<?php
  session_start();

  $sesion=$_SESSION["doc_id"];
  if(!isset($sesion)){
      header("location: ../ingresar/ingresar.php");
      exit;
  }
  require '../config/database.php';
  //$busquedad=$_POST['busquedad'];
  $db=new database();
  $con = $db->conectar();
  $sql=$con->prepare("SELECT tblusuario.doc_id, tblusuario.nombres, tblusuario.apellidos, tblusuario.direccion, tblusuario.fecha_naci, tblusuario.telefono_movil, tblusuario.correo FROM tblusuario  WHERE doc_id='$sesion'");
  $sql->execute();
  $resultado=$sql->fetch(PDO::FETCH_ASSOC);
  $doc_id=$resultado['doc_id'];
  $nombres=$resultado['nombres'];
  $apellido=$resultado['apellidos'];
  $direccion=$resultado['direccion'];
  $fecha=$resultado['fecha_naci'];
  $telefono=$resultado['telefono_movil'];
  $correo=$resultado['correo'];

  $vive=$con->prepare("SELECT * FROM ciudad ORDER BY nombre ASC");
  $vive->execute();
  $ciudadR=$vive->fetchAll(PDO::FETCH_ASSOC);

 
  if(!$sql){
    echo'<script>alert("Los datos no se pudieron cargar");
    window.location="../ingresar/bienvenida.php";
    </script>';
    
  
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
      <a href="../ingresar/bienvenida.php">
      <i class="fa-solid fa-house-user"></i>
        <span>Inicio</span>
      </a>
      <a href="../crud/datos.php" class="active">
      <i class="fa-solid fa-circle-info"></i>
        <span>Datos</span>
      </a>
      <a href="../crud/misReservas.php">
         <i class="fas fa-calendar"></i>
        <span>Reservas</span>
      </a>
      <a href="../crud/mascotas.php">
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

    <!-- utilizando un foreach se le presenta al usuario su informacion en un formulario 
  el cual puede ser modificado y esa informacion se enviara por post para realizar la consulta de update que modificara los datos -->

      <div class="container-all">

        <div class="ctn-form">
            <h1 class="title">ACTUALIZAR DATOS</h1>
            
            <form action="actualizar.php" method="post" >
                <label for="">Numero de Identificación</label>
                <input type="text" name="docid" value="<?php echo $doc_id; ?>" readonly>

                <label for="">Nombre</label>
                <input type="text" name="nombre" value="<?php echo $nombres; ?>">
                
                <label for="">Apellido</label>
                <input type="text" name="apellidos" value="<?php echo $apellido; ?>">

                 
            
                <label for="">Dirección</label>
                <input type="text" name="direccion" value="<?php echo $direccion; ?>">
                

                <label for="">Ciudad</label>
                <select name="ciud" class="select">
                  <!-- <option value="">Selecionar Ciudad</option> -->
                    <?php foreach($ciudadR as $ciudad){ ?>
                    <option value="<?php echo $ciudad['cod_ciudad']; ?>"><?php echo $ciudad['nombre']; ?></option>
                    <?php } ?>
                </select>
                
                <label for="">Fecha de Nacimiento</label>
                <input type="date" name="naci" value="<?php echo $fecha; ?>">
               
                
            
                <label for="">Telefono</label>
                <input type="text" name="telefono" value="<?php echo $telefono; ?>">
                
                

                <label for="">Correo Electronico</label>
                <input type="text" name="correo" value="<?php echo $correo; ?>" pattern="[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$">
                
                
                
                <input type="submit" value="ACTUALIZAR">

            </form>
            
        </div>
            
        </div>

      <script src="loa.js"></script>
  </body>
</html>