<?php
    require_once '../config/conexion.php';
	$sql="call SPEmpresaConMasReservasUltimoMes()";
	$result=mysqli_query($link,$sql);
	$valoresY=array();//cantidad reservas
	$valoresX=array();//nombre de la empresa

	while ($ver=mysqli_fetch_row($result)) {
		$valoresY[]=$ver[1];
		$valoresX[]=$ver[0];
	}

	$datosX=json_encode($valoresX);
	$datosY=json_encode($valoresY);
?>
<div id="grafica-barras"></div>
            <script type="text/javascript">
                function crearCadenaBarras(json){
		        var parsed = JSON.parse(json);
		        var arr = [];
		            for(var x in parsed){
			            arr.push(parsed[x]);
		            }
		            return arr;
	            }
            </script>
            <script type="text/javascript">
                datosX=crearCadenaBarras('<?php echo $datosX ?>');
	            datosY=crearCadenaBarras('<?php echo $datosY ?>');

        	var data = [
        		{
        			x: datosX,
        			y: datosY,
        			type: 'bar'
        		}
        	];
            Plotly.newPlot('grafica-barras', data);
            </script>