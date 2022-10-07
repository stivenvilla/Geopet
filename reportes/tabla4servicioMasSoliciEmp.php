<?php    
    include ("../reportes/informes.php");
    require '../config/database.php';
    $db=new database();
    $con = $db->conectar();
    $estado='activo';

    $P_codEmp="";
    intval($P_meses="");
    $empresa="";

    if (isset($_POST['enviar'])){
        $P_meses = intval($_POST['selecMes']) ?? null;
        $P_codEmp = $_POST['nit'] ?? null;

        $nombre=$con->prepare("SELECT cod_empresa, nombre from ciudadoresguar where cod_empresa='$P_codEmp'");
        $nombre->execute();
        $nombreEmpresa=$nombre->fetch(PDO::FETCH_ASSOC);
        $empresa=$nombreEmpresa['nombre'] ?? null; 
        
    }

    $sql=$con->prepare("CALL SPServicioMasSolicitadoEmpresa(?,?)");
    $sql->execute([intval($P_meses), ($P_codEmp)]);
    $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
   
   
 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilosCss/tablas.css">
    <title>consulta 5</title>
</head>
<body>
    <h1 class="titulo">Servicio más solicitado en empresa</h1>

    <div class = "containerFecha" id = "containerFecha4">
       
        <form method="post" action="" class="fecha">  
            <input type="text" class = "codEmpresa"  name= "nit" placeholder="Nit Empresa" required>
            <input type="number" class="selecAnio" placeholder="N° meses"  name="selecMes" min="01" max="12" required>   
            <input type="submit" value="Enviar" name="enviar" class ="enviar">                   
        </form>
        
        
        
    </div>
    <div id="informes">
    
        <div class ="nomEmpresa" > 
            <?php echo "Empresa: ", $empresa ?>
        </div>

            <table >
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Veces reservado</th>
                    </tr>
                </thead>
                <?php foreach($resultado as $row ){ ?>
                <tr class="datosInforme">
                    <td><?php echo $row['Servicio']; ?></td>
                    <td><?php echo $row['Veces reservado']; ?></td>
                </tr>
                <?php } ?>     

        </table>
    </div>


    

<!-- <script src="js.js"></script> -->

    </body>
</html>