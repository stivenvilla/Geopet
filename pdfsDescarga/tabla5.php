<?php
	include 'plantilla.php';
	require '../config/database.php';

    $db=new database();
    $con = $db->conectar();

    $P_meses = intval($_POST['selecMes']) ?? null;
    $P_codEmp = $_POST['nit'] ?? null;


    $sql=$con->prepare("CALL SPServicioMasSolicitadoEmpresa(?,?)");
    $sql->execute([intval($P_meses), ($P_codEmp)]);
    $resultado5=$sql->fetchAll(PDO::FETCH_ASSOC);

	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(70,6,utf8_decode('Servicio'),1,0,'C',1);
	$pdf->Cell(70,6,'Veces Reservado',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	foreach($resultado5 as $row0 )
	{
		$pdf->Cell(70,6,utf8_decode($row0['Servicio']),1,0,'C');
		$pdf->Cell(70,6,utf8_decode($row0['Veces reservado']),1,1,'C');
	}
	$pdf->Output('D', 'Downloads/Servicio_Mas_Solicitado_en_empresa.pdf');
?>