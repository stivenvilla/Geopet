<?php
	include 'plantilla.php';
	require '../config/database.php';

    $db=new database();
    $con = $db->conectar();

    $P_anno=$_POST['selecAnno'];
    $P_mesInicial=$_POST['selecMes1'] ;    
    $P_mesFinal=$_POST['selecMes2'];
	
    $tabla0=$con->prepare("CALL SPComparacionCantidadReservas(?,?,?)");
   $tabla0->execute([ intval($P_anno), intval($P_mesInicial),intval($P_mesFinal)]);
   $resultado0=$tabla0->fetchAll(PDO::FETCH_ASSOC);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(70,6,utf8_decode('AÑ0'),1,0,'C',1);
	$pdf->Cell(20,6,'MES',1,0,'C',1);
	$pdf->Cell(70,6,'Cantidad Reservas',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	foreach($resultado0 as $row0 )
	{
		$pdf->Cell(70,6,utf8_decode($row0['Año']),1,0,'C');
		$pdf->Cell(20,6,$row0['Mes'],1,0,'C');
		$pdf->Cell(70,6,utf8_decode($row0['Cantidad reservas']),1,1,'C');
	}
	$pdf->Output('D', 'Downloads/Cantidad_Reservas_Mes.pdf');
?>