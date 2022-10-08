<?php    
    include ("../reportes/informes.php");
    require '../config/database.php';
    $db=new database();
    $con = $db->conectar();
    $estado='activo';

    intval($P_annoI="");
    intval($P_mesI="");
    intval($P_diaI="");
    intval($P_annoF="");
    intval($P_mesF="");
    intval($P_diaF="");

    if(isset($_POST['enviar'])){
        $P_annoI = intval($_POST['selecAnnoI']) ?? NULL;
        $P_mesI = intval($_POST['selecMesI']) ?? NULL;
        $P_diaI = intval($_POST['selecDiaI']) ?? NULL;
        $P_annoF = intval($_POST['selecAnnoF']) ?? NULL;
        $P_mesF = intval($_POST['selecMesF']) ?? NULL;
        $P_diaF = intval($_POST['selecDiaF']) ?? NULL; 
    }

    $sql=$con->prepare("CALL SPtotalReservasEmpresas(?,?,?,?,?,?)");
    $sql->execute([intval($P_annoI), intval($P_annoF), intval($P_mesI), intval($P_mesF), intval($P_diaI), intval($P_diaF) ]);
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
    <div class="titulo">Cantidad de reservas por empresa</div>

    <div class = "containerFecha" id="containerFecha2">
        
        <form method="post" action="" class="fecha">
                    
            <input type="number" class="selecAnio" placeholder="Año"  name="selecAnnoI" min="2019" max="2023" required>
            <select  class="seleccionarFecha"  name ="selecMesI" required>
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
            
            <select  class="seleccionarFecha"  name ="selecDiaI" required>
                <option value="" disabled selected hidden>1° Día</option>
                <option value="01">1</option>
                <option value="02">2</option>
                <option value="03">3</option>
                <option value="04">4</option>
                <option value="05">5</option>
                <option value="06">6</option>
                <option value="07">7</option>
                <option value="08">8</option>
                <option value="09">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="10">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
            </select>
            
            <div class="espacio"></div>
        
            <input type="number" class="selecAnio" placeholder="Año"  name="selecAnnoF" min="2019" max="2023" required> 
            <select  class="seleccionarFecha"  name ="selecMesF" required>
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

            <select  class="seleccionarFecha"  name ="selecDiaF" required>
                <option value="" disabled selected hidden>2° Día</option>
                <option value="01">1</option>
                <option value="02">2</option>
                <option value="03">3</option>
                <option value="04">4</option>
                <option value="05">5</option>
                <option value="06">6</option>
                <option value="07">7</option>
                <option value="08">8</option>
                <option value="09">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="10">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
            </select>
            <input type="submit" value="Enviar" name="enviar" class="enviar">
                
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
				<td><?php echo $row['Nombre Empresa']; ?></td>
                <td><?php echo $row['Total reservas']; ?></td>
            </tr>
			<?php } ?>
         

        </table>
    </div>

    </body>
</html>