<?php    
    include ("../reportes/informes.php");
    require '../config/database.php';
    $db=new database();
    $con = $db->conectar();
    $estado='activo';

    $P_codEmp="";

    if (isset($_POST['enviar'])){
        $P_codEmp = $_POST['nit'] ?? null;
    }

    $sql=$con->prepare("CALL SPUsuarioMasReserva(?)");
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
    <title>consulta 5</title>
</head>
<body>
    <div class="titulo">Usuario que más reserva en una empresa</div>

    <div class = "containerFecha" id = "containerFecha6">
               
        <form method="post" action="" class="fecha">
            
            <input type="text" class = "codEmpresa"  name= "nit" placeholder="Nit Empresa" required>  
            <input type="submit" value="Enviar" name="enviar" class ="enviar">          
        </form>

        <form method="post" action="#" >
            <input type="submit" value="Descargar" name="descargar" class="descargar">
        </form> 
    </div>

    <div id="informe6">
        <div class="tlbusuarioReserva">

            <table >
                <thead>
                    <tr>
                        <th>Doc. identidad</th>
                        <th>Nombre usuario</th>
                        <th>Total reservas</th>
                    </tr>
                </thead>
                <?php foreach($resultado as $row ){ ?>
                <tr class="datosInforme">
                    <td><?php echo $row['Doc. id']; ?></td>
                    <td><?php echo $row['Nombre Usuario']; ?></td>
                    <td><?php echo $row['Total reservas']; ?></td>
                </tr>
                <?php } ?>
            </div> 

            

        </table>
    </div>

    </body>
</html>