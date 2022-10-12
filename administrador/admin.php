<?php
session_start();

//se hace la sesion para que no se pueda ingresar a la pagina principal sin antes haber iniciado sesion
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
  header("location: ../ingresar/ingresar.php");
  exit;
}
  require '../config/database.php';
  require '../config/token.php';
  $db=new database();
  $con = $db->conectar();
  $estado='activo';
  $sql=$con->prepare("SELECT ciudadoresguar.cod_empresa,  ciudadoresguar.nombre, ciudad.nombre as ciudad,  ciudadoresguar.telefono,ciudadoresguar.direccion,  ciudadoresguar.servicios,  ciudadoresguar.correo, ciudadoresguar.situacion  FROM ciudadoresguar INNER JOIN ciudad ON ciudadoresguar.ciudad=ciudad.cod_ciudad WHERE situacion='1'");
  $sql->execute();
  $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

  if(!$resultado){
    echo'
      <script>alert("No se han encontrado empresas activas");
      window.location="../administrador/admin.php";
      </script>
    
    ';
  
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
    <input type="checkbox" id="check">
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
      <header>
        Configuración
      </header>
      <a href="admin.php" class="active">
      <i class="fa-solid fa-house-circle-check"></i>
        <span>Empresas</span>
      </a>
      <a href="bloqueadas.php">
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
      <a href="copiaSe.php">
      <i class="fa-solid fa-cloud-arrow-down"></i>
        <span>Seguridad</span>
      </a>
      <a href="../ingresar/cerrar-sesion.php">
      <i class="fa-solid fa-right-from-bracket"></i>
        <span>Salir</span>
      </a>

    </div>

    <h1 class="title">Empresas</h1>

    <div class="buscar">
      <input type="text" class="buscar_texto" placeholder="Busquar Empresa" id="buscador">
      </a>
    </div>
  <!-- parte en la que se podran ver las empresas que estan registradas -->
    <div id="main-container">
    
		<table>
    
			<thead>
				<tr>
                    <th>Nit</th>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                    <th>Servicios</th>
                    <th>Correo</th>
                    <th></th>


				</tr>
			</thead>
      <?php foreach($resultado as $row ){ ?>
			<tr class="usuario">
				        <td><?php echo $row['cod_empresa']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['ciudad']; ?></td>
                <td><?php echo $row['telefono']; ?></td>
                <td><?php echo $row['direccion']; ?></td>
                <td><?php echo $row['servicios']; ?></td>
                <td><?php echo $row['correo']; ?></td>
                <th><a href="eliminarEmpresa.php?di=<?php echo $row['cod_empresa'];?>&token=<?php echo hash_hmac('sha1',$row['cod_empresa'], KEY_TOKEN);?>">Bloquear</a></th>
                               
			</tr>
			<?php } ?>
		</table>
        
	</div>

      
  <script src="script.js"></script>
  </body>
</html>