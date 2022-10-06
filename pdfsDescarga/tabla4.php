<?php
	include 'plantilla.php';
	require '../config/database.php';

    $db=new database();
    $con = $db->conectar();

    $P_meses = intval($_POST['selecMes']);

    $sql=$con->prepare("CALL SPServicioMasSolicitadoMeses(?)");
    $sql->execute(array(intval($P_meses)));
    $resultado4=$sql->fetchAll(PDO::FETCH_ASSOC);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(70,6,utf8_decode('Servicio'),1,0,'C',1);
	$pdf->Cell(70,6,'Veces Reservado',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	foreach($resultado4 as $row0 )
	{
		$pdf->Cell(70,6,utf8_decode($row0['Servicio']),1,0,'C');
		$pdf->Cell(70,6,utf8_decode($row0['Veces reservado']),1,1,'C');
	}
	$pdf->Output('D', 'Downloads/Servicio_Mas_Solicitado.pdf');
?>