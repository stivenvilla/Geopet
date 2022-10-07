<?php    
    include ("../reportes/informes.php");
    require '../config/database.php';
    $db=new database();
    $con = $db->conectar();
    $estado='activo';

    $P_codEmp="";
    $empresa="";

    if (isset($_POST['enviar'])){
        $P_codEmp = $_POST['nit'] ?? null;

        $nombre=$con->prepare("SELECT cod_empresa, nombre from ciudadoresguar where cod_empresa='$P_codEmp'");
        $nombre->execute();
        $nombreEmpresa=$nombre->fetch(PDO::FETCH_ASSOC);
        $empresa=$nombreEmpresa['nombre'] ?? null; 
    }

    $sql=$con->prepare("CALL SPreservasFinalizadas(?)");
    $sql->execute([$P_codEmp]);
    $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilosCss/tablas.css">
    <title>Reservas Finalizadas</title>
</head>
<body>
    <div class="titulo"> Reservas finalizadas por empresa</div>

    <div class = "containerFecha" id = "containerFecha6">
   
        <form method="post" action="" class="fecha">
            
            <input type="text" class = "codEmpresa"  name= "nit" placeholder="Nit Empresa" required>  
            <input type="submit" value="Enviar" name="enviar" class ="enviar">
                   
        </form>
        
    </div>

    <div id="informe7">

        <div class ="nomEmpresa" > 
            <?php echo "Empresa: ", $empresa ?>
        </div>    

        <table >
            <thead>
                <tr>
                    
                    <th>Cod reserva</th>
                    <th>Doc. Id</th>
                    <th>Nombre usuario</th>
                    <th>Servicio</th>
                    <th>Fecha</th>
                                            
                </tr>
            </thead>
                <?php foreach($resultado as $row ){ ?>
                <tr class="datosInforme">
                    
                    <td><?php echo $row['Cod reserva']; ?></td>
                    <td><?php echo $row['Doc. Id']; ?></td>
                    <td><?php echo $row['Nombre usuario']; ?></td>
                    <td><?php echo $row['Servicio']; ?></td>
                    <td><?php echo $row['Fecha']; ?></td>
                </tr>
                <?php } ?>
        </table>
    </div>
</body>
</html>