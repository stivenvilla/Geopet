<?php
	include 'plantilla.php';
	require '../config/database.php';

    $db=new database();
    $con = $db->conectar();


    $sql=$con->prepare("CALL SPEmpresaConMasReservasUltimoMes");
    $sql->execute();
    $resultado2=$sql->fetchAll(PDO::FETCH_ASSOC);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(70,6,utf8_decode('Nombre Empresa'),1,0,'C',1);
	$pdf->Cell(70,6,'Total Reservas',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	foreach($resultado2 as $row0 )
	{
		$pdf->Cell(70,6,utf8_decode($row0['Nombre empresa']),1,0,'C');
		$pdf->Cell(70,6,utf8_decode($row0['Total reservas']),1,1,'C');
	}
	$pdf->Output('D', 'Downloads/Empresa_Mas_Reservas_Ultimo_Mes.pdf');
?>