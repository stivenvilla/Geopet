<?php    
    include ("../reportes/informes.php");
    require '../config/database.php';
    $db=new database();
    $con = $db->conectar();
    $estado='activo';

    $sql=$con->prepare("CALL SPEmpresaConMasReservasUltimoMes");
    $sql->execute();
    $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
   
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilosCss/tablas.css">
    <title>consulta 1</title>
</head>
<body>
    <div class="titulo">Cantidad de reservaciones por empresa en el último mes</div>
    
    <div class = "containerFecha" id = "containerFecha0">
    
        <form method="post" action="#" >
            <input type="submit" value="Descargar" name="descargar" class="descargar">
        </form>
    </div>

    <div id="informes">
        <table >
            <thead>
                <tr>
                    <th>Nombre Empresa</th>
                    <th>Total reservas</th>
                </tr>
            </thead>
            <?php foreach($resultado as $row ){ ?>
			<tr class="datosInforme">
				<td><?php echo $row['Nombre empresa']; ?></td>
                <td><?php echo $row['Total reservas']; ?></td>
            </tr>
			<?php } ?>
         

        </table>
    </div>
    </body>
</html>