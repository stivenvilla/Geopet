<?php

session_start();

//se hace la sesion para que no se pueda ingresar a la pagina principal sin antes haber iniciado sesion
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
  header("location: ingresar.php");
  exit;
}
  require '../config/database.php';
  require '../config/token.php';
  $db=new database();
  $con = $db->conectar();
  $estado='activo';
  $sql=$con->prepare("SELECT tblusuario.doc_id, tblusuario.nombres, tblusuario.apellidos, tblusuario.direccion, ciudad.nombre as ciudad, tblusuario.fecha_naci, tblusuario.telefono_movil, tblusuario.telefono_movil, tblusuario.correo FROM tblusuario INNER JOIN ciudad ON tblusuario.ciudad=ciudad.cod_ciudad");
  $sql->execute();
  $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

  if(!$resultado){
    echo'
      <script>alert("Ha ocurrido un error");
      window.location="../administrador/usuariosGeopet.php";
      </script>';
  
  }
?> 

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Configuración</title>
    <link rel="stylesheet" href="../estilosCss/adminempresas.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fd9d79a2e5.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <!-- en esta pagina se presenta unmenu lateral -->
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
      <a href="usuariosGeopet.php" class="active">
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
      <a href="copiaSe.php">
      <i class="fa-solid fa-cloud-arrow-down"></i>
        <span>Seguridad</span>
      </a>
      <a href="../ingresar/cerrar-sesion.php">
      <i class="fa-solid fa-right-from-bracket"></i>
        <span>Salir</span>
      </a>

    </div>

    <h1 class="title">Usuarios</h1>
    <!-- buscador se sirve para filtrar usuarios -->
    <div class="buscar">
      <input type="text" class="buscar_texto" placeholder="Buscar Usuario" id="buscador">
      </a>
    </div>
<!-- en una tabla se traen todos los datos de los usuarios -->
    <div id="main-container">
    
		<table>
    
			<thead>
				<tr>
                    <th>docid</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>F.Nacimiento</th>
                    <th>Telefono</th>
                    <th>Correo</th>


				</tr>
			</thead>
      <?php foreach($resultado as $row ){ ?>
			<tr class="usuario">
				<td><?php echo $row['doc_id']; ?></td>
                <td><?php echo $row['nombres']; ?></td>
                <td><?php echo $row['apellidos']; ?></td>
                <td><?php echo $row['direccion']; ?></td>
                <td><?php echo $row['ciudad']; ?></td>
                <td><?php echo $row['fecha_naci']; ?></td>
                <td><?php echo $row['telefono_movil']; ?></td>
                <td><?php echo $row['correo']; ?></td>                               
			
        </tr>
			<?php } ?>
		</table>
        
	</div>

      
  <script src="script.js"></script>
  </body>
</html>