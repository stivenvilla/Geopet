<?php    
    include ("../reportes/informes.php");
    require '../config/database.php';
    $db=new database();
    $con = $db->conectar();
    $estado='activo';

 
   
    intval($P_anno="");
    intval($P_mesInicial="");
    intval($P_mesFinal="");

    if(isset($_POST['enviar'])){
        $P_anno = intval($_POST['selecAnno']) ?? NULL ;
        $P_mesInicial  = intval($_POST['selecMes1'] )?? NULL ;    
        $P_mesFinal = intval($_POST['selecMes2'] )?? NULL;
        
    }  
    

   $sql=$con->prepare("CALL SPComparacionCantidadReservas(?,?,?)");
   $sql->execute([ intval($P_anno), intval($P_mesInicial),intval($P_mesFinal)]);
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
    <div class="titulo"> Cantidad de reservas por mes</div>

    <div class = "containerFecha" id = "containerFecha1">

        <form method="post" action="" class="fecha">
            
            <input type="number" class="selecAnio" placeholder="Año"  name="selecAnno" min="2019" max="2023" required>   
            
            <select  class="seleccionarFecha"  name ="selecMes1" required>
                <option value="" disabled selected hidden >1° Mes</option>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiempre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>

            <select  class="seleccionarFecha"  name ="selecMes2" required>
                <option value="" disabled selected hidden>2° Mes</option>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiempre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
            
                <input type="submit" value="Enviar" name="enviar" class ="enviar" >
                
        </form>
            

    </div>


    <div id="informes">
        <table >
            <thead>
                <tr>
                    <th>Año</th>
                    <th>Mes</th>
                    <th>Cantidad de Reservas</th>
                </tr>
            </thead>
            <?php foreach($resultado as $row ){ ?>
			<tr class="datosInforme">
				<td><?php echo $row['Año']; ?></td>
                <td><?php echo $row['Mes']; ?></td>
                <td><?php echo $row['Cantidad reservas']; ?></td>
            </tr>
			<?php } ?>
         

        </table>
    </div>

</body>
</html>