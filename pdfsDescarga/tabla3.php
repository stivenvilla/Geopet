<?php
	include 'plantilla.php';
	require '../config/database.php';

    $db=new database();
    $con = $db->conectar();

        $P_annoI = intval($_POST['selecAnnoI']) ;
        $P_mesI = intval($_POST['selecMesI']) ;
        $P_diaI = intval($_POST['selecDiaI']) ;
        $P_annoF = intval($_POST['selecAnnoF']) ;
        $P_mesF = intval($_POST['selecMesF']) ;
        $P_diaF = intval($_POST['selecDiaF']) ;

    $sql=$con->prepare("CALL SPtotalReservasEmpresas(?,?,?,?,?,?)");
    $sql->execute([intval($P_annoI), intval($P_annoF), intval($P_mesI), intval($P_mesF), intval($P_diaI), intval($P_diaF) ]);
    $resultado3=$sql->fetchAll(PDO::FETCH_ASSOC);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(70,6,utf8_decode('Nombre Empresa'),1,0,'C',1);
	$pdf->Cell(70,6,'Total Reservas',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	foreach($resultado3 as $row0 )
	{
		$pdf->Cell(70,6,utf8_decode($row0['Nombre empresa']),1,0,'C');
		$pdf->Cell(70,6,utf8_decode($row0['Total reservas']),1,1,'C');
	}
	$pdf->Output('D', 'Downloads/Cantidad_de_reservas_por_empresa.pdf');
?>