<?php
require '../config/database.php';
$db=new database();
$con = $db->conectar();
$estado='activo';

$P_codEmp="";
intval($P_anno="");
intval($P_mesInicial="");
intval($P_mesFinal="");

//var_dump($_POST);
    $P_codEmp = $_POST['nit'] ?? null;
    $P_anno = intval($_POST['selecAnno'] ?? NULL) ;
    $P_mesInicial  = intval($_POST['selecMes1'] ?? NULL) ;    
    $P_mesFinal = intval($_POST['selecMes2'] ?? NULL);
  


$sql=$con->prepare("CALL SPComparacionCantidadReservasEmpresa(?,?,?,?)");
$sql->execute([ $P_codEmp, intval($P_anno), intval($P_mesInicial),intval($P_mesFinal)]);
$resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
header("Content-Type: application/vnd.ms-excel; charset=iso-88-59-1");
header("Content-Disposition: attachment; filename=Geopet.xls");



?>

    <table >
        <caption>Cantidad de reservaciones</caption>
            <tr>
                <th>Año</th>
                <th>Mes</th>
                <th>Cantidad de Reservas</th>
            </tr>
                <?php foreach($resultado as $row ){ ?> 
            <tr>           
                <td><?php echo $row['Año']; ?></td>
                <td><?php echo $row['Mes']; ?></td>
                <td><?php echo $row['Cantidad reservas']; ?></td>
                
            </tr>
            <?php }?>
    </table>