<?php
session_start();

$sesion=$_SESSION["cod_empresa"];
if(!isset($sesion)){
    header("location: ../ingresar/ingresar.php");
    exit;
}
  require '../config/database.php';
  require '../config/token.php';
  //$busquedad=$_POST['busquedadEmpresa'];
  $db=new database();
  $con = $db->conectar();
  $sql=$con->prepare("SELECT tblreserva.cod_reserva, tblreserva.cod_empresa, tblreserva.doc_id, tblmascota.nombreMacota as mascota,tblservicio.Nombre AS servicio,  tblreserva.fechaAsignada, tblreserva.estado FROM tblreserva INNER JOIN tblservicio ON tblreserva.servicio=tblservicio.cod_servicio INNER JOIN tblmascota ON tblreserva.cod_mascota=tblmascota.cod_mascota  WHERE tblreserva.cod_empresa='$sesion' and estado='' || estado=null");
  $sql->execute();
  $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

  if(!$resultado){
    echo'<script>alert("No se han encontrado empresas relacionadas con la empresa")
    window.location="../empresa/datosEmpresa.php";
    </script>';
  
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Configuración</title>
    <link rel="stylesheet" href="../estilosCss/reservasEmpresa.css">
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
      <a href="../empresa/datosEmpresa.php">
      <i class="fa-solid fa-circle-info"></i>
        <span>Datos</span>
      </a>
      <a href="../empresa/reservasEmpre.php" class="active">
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

    <!-- esta parte muestra en una tabla la informacion de las reservas que estan 
  almacenadas en la base de datos -->

    <div id="main-container">
    
		<table>
			<thead>
				<tr>
					<th>Empresa</th>
                    <th>Usuario</th>
                    <th>Nombre Mascota</th>
                    <th>Servicio</th>
                    <th>Fecha de Reservación</th>
                    <th></th>
                    <th></th>


				</tr>
			</thead>
      <?php foreach($resultado as $row ){ ?>
			<tr>
				<td><?php echo $row['cod_empresa']; ?></td>
                <td><?php echo $row['doc_id']; ?></td>
                <td><a href="verMascota.php?i=<?php echo $row['doc_id'];?>&m=<?php echo $row['mascota'] ?>&token=<?php echo hash_hmac('sha1',$row['doc_id'], KEY_TOKEN);?>"><?php echo $row['mascota'];?></a></td>
                <td><?php echo $row['servicio']; ?></td>
                <th><?php echo $row['fechaAsignada']?></th>
                <th><a href="aceptar.php?id=<?php echo $row['cod_reserva'];?>&token=<?php echo hash_hmac('sha1',$row['cod_reserva'], KEY_TOKEN);?>">Aceptar</a></th>
                <th><a href="cancelarR.php?id=<?php echo $row['cod_reserva'];?>&token=<?php echo hash_hmac('sha1',$row['cod_reserva'], KEY_TOKEN);?>">Cancelar</a></th>                
        
			</tr>
			<?php } ?>
		</table>
        
	</div>

    

  </body>
</html>
