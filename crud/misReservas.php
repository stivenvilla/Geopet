<?php

session_start();

    $sesion=$_SESSION["doc_id"];
    if(!isset($sesion)){
        header("location: ../ingresar/ingresar.php");
        exit;
    }
  require '../config/database.php';
  require '../config/token.php';
  $db=new database();
  $con = $db->conectar();
  //$busquedad=$_POST['busquedaMis'];
  $estado='activo';
  $sql=$con->prepare("SELECT tblreserva.cod_reserva, tblreserva.cod_empresa, tblreserva.doc_id,tblmascota.nombreMacota as mascota,tblservicio.nombre AS servicio, tblreserva.fechaAsignada, tblreserva.estado FROM tblreserva INNER JOIN tblservicio ON tblreserva.servicio=tblservicio.cod_servicio INNER JOIN tblmascota ON tblreserva.cod_mascota=tblmascota.cod_mascota  where tblreserva.doc_id='$sesion' and estado='$estado'");
  $sql->execute();
  $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

  if(!$resultado){
    echo'
      <script>alert("Señor usuario en el momento no se han encontrado reservaciones si cree que es un error por favor comuniquese con el administrador");
      window.location="../crud/datos.php";
      </script>
    
    ';
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Configuración</title>
    <link rel="stylesheet" href="../estilosCss/reservasUsuario.css">
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
  <a href="../crud/datos.php" >
  <i class="fa-solid fa-circle-info"></i>
    <span>Datos</span>
  </a>
  <a href="../crud/misReservas.php" class="active">
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

    <!-- por medio de una tabla y utilizando codigo php se llena una tabla con la informacion de las reservas que tiene el 
  usuario y aca el podra cancelar las reservas -->

    <div id="main-container">
    
		<table>
			<thead>
				<tr>
                    <th>Empresa</th>
                    <th>Usuario</th>
                    <th>Nombre Mascota</th>
                    <th>Servicio</th>
                    <th>Fecha Reserva</th>
                    <th>Estado</th>
                    <th></th>


				</tr>
			</thead>
      <?php foreach($resultado as $row ){ ?>
			<tr>
				<td><?php echo $row['cod_empresa']; ?></td>
                <td><?php echo $row['doc_id']; ?></td>
                <td><?php echo $row['mascota']; ?></td>
                <td><?php echo $row['servicio']; ?></td>
                <td><?php echo $row['fechaAsignada']; ?></td>
                <td><?php echo $row['estado']; ?></td>
                <th><a href="cancelarReservacionU.php?id=<?php echo $row['cod_reserva'];?>&token=<?php echo hash_hmac('sha1',$row['cod_reserva'], KEY_TOKEN);?>">Cancelar</a></th>                                 
			</tr>
			<?php } ?>
		</table>
        
	</div>


  </body>
</html>
