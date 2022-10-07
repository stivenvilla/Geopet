<?php
	include 'plantilla.php';
	require '../config/database.php';

    $db=new database();
    $con = $db->conectar();

    $P_anno = intval($_POST['selecAnno'])  ;
    $P_mesInicial  = intval($_POST['selecMes1'] ) ;    
    $P_mesFinal = intval($_POST['selecMes2'] );

    $sql=$con->prepare("CALL SPFechaReservas(?,?,?)");
    $sql->execute([ intval($P_anno), intval($P_mesInicial),intval($P_mesFinal)]);
    $resultado6=$sql->fetchAll(PDO::FETCH_ASSOC);

	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(50,6,utf8_decode('Nombre usuario'),1,0,'C',1);
	$pdf->Cell(50,6,utf8_decode('Empresa'),1,0,'C',1);
    $pdf->Cell(50,6,utf8_decode('Servicio'),1,0,'C',1);
    $pdf->Cell(20,6, 'Fecha',1,1,'C',1);
    
	
	$pdf->SetFont('Arial','',10);
	
	foreach($resultado6 as $row0 )
	{
		$pdf->Cell(50,6,utf8_decode($row0['Nombre usuario']),1,0,'C');
        $pdf->Cell(50,6,utf8_decode($row0['Empresa']),1,0,'C');
        $pdf->Cell(50,6,utf8_decode($row0['Servicio']),1,0,'C');
		$pdf->Cell(20,6,utf8_decode($row0['Fecha']),1,1,'C');
	}
	$pdf->Output('D', 'Downloads/Informacion_Reservas.pdf');
?>