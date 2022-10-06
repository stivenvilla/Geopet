<?php
	include 'plantilla.php';
	require '../config/database.php';

    $db=new database();
    $con = $db->conectar();

    $P_codEmp = $_POST['nit'];
    $P_anno = intval($_POST['selecAnno']);
    $P_mesInicial  = intval($_POST['selecMes1'] );    
    $P_mesFinal = intval($_POST['selecMes2'] );

    
    //procedimiento almacenado
    $sql=$con->prepare("CALL SPComparacionCantidadReservasEmpresa(?,?,?,?)");
    //$sql->bind_param("iiii", $P_codEmp, $P_año, $P_mesInicial,$P_mesFinal);
    $sql->execute([ $P_codEmp, intval($P_anno), intval($P_mesInicial),intval($P_mesFinal)]);
   $resultado1=$sql->fetchAll(PDO::FETCH_ASSOC);
	
   
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(70,6,utf8_decode('AÑ0'),1,0,'C',1);
	$pdf->Cell(20,6,'MES',1,0,'C',1);
	$pdf->Cell(70,6,'Cantidad Reservas',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	foreach($resultado1 as $row1 )
	{
		$pdf->Cell(70,6,utf8_decode($row1['Año']),1,0,'C');
		$pdf->Cell(20,6,$row1['Mes'],1,0,'C');
		$pdf->Cell(70,6,utf8_decode($row1['Cantidad reservas']),1,1,'C');
	}
	$pdf->Output('D', 'Downloads/Cantidad_Reservas_Empresa.pdf');
?>