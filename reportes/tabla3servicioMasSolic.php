<?php    
    include ("../reportes/informes.php");
    require '../config/database.php';
    $db=new database();
    $con = $db->conectar();
    $estado='activo';

    intval($P_meses="");

    if (isset($_POST['enviar'])){
        $P_meses = intval($_POST['selecMes']) ?? null;
    }

    $sql=$con->prepare("CALL SPServicioMasSolicitadoMeses(?)");
    $sql->execute(array(intval($P_meses)));
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
    <div class="titulo">Servicio más solicitado </div>

    <div class = "containerFecha" id = "containerFecha3">

        <form method="post" action="" class="fecha">
            <input type="number" class="selecAnio" placeholder="N° meses"  name="selecMes" min="01" max="12" required>   
            <input type="submit" value="Enviar" name="enviar" class ="enviar">       
        </form>
        
        
    </div>
    <div id="informes">
        <div class="servMasSolici">

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
            </div> 

            

        </table>
    </div>


    

<!-- <script src="js.js"></script> -->

    </body>
</html>