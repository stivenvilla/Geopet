<?php
	include 'plantilla.php';
	require '../config/database.php';

    $db=new database();
    $con = $db->conectar();

    $P_codEmp = $_POST['nit'];

    $sql=$con->prepare("CALL SPreservasCanceladas(?)");
    $sql->execute([$P_codEmp]);
    $resultado8=$sql->fetchAll(PDO::FETCH_ASSOC);

	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(30,6,utf8_decode('Doc. identidad'),1,0,'C',1);
	$pdf->Cell(70,6,utf8_decode('Nombre usuario'),1,0,'C',1);
    $pdf->Cell(70,6,utf8_decode('Servicio'),1,0,'C',1);
    $pdf->Cell(20,6, 'Fecha',1,1,'C',1);
    
	
	$pdf->SetFont('Arial','',10);
	
	foreach($resultado8 as $row0 )
	{
		$pdf->Cell(30,6,utf8_decode($row0['Doc. Id']),1,0,'C');
        $pdf->Cell(70,6,utf8_decode($row0['Nombre usuario']),1,0,'C');
        $pdf->Cell(70,6,utf8_decode('Servicio'),1,0,'C',1);
		$pdf->Cell(20,6,utf8_decode($row0['Fecha']),1,1,'C');
	}
	$pdf->Output('D', 'Downloads/reservacionesCanceladas.pdf');
?>