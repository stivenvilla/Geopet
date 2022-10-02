<?php
    require_once '../config/conexion.php';
	$sql="SELECT month(fechaAsignada) as 'Mes' ,COUNT(cod_reserva) as 'Cantidad reservas' from tblreserva WHERE (year(fechaAsignada)= year(now())) AND (month(fechaAsignada) BETWEEN 1 AND 12) GROUP by year(fechaAsignada), month(fechaAsignada) ORDER by month(fechaAsignada) DESC LIMIT 6";
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
<div id="grafica-lineal"></div>

            <script type="text/javascript">
                function crearCadenaLineal(json){
		            var parsed = JSON.parse(json);
		            var arr = [];
		            for(var x in parsed){
			            arr.push(parsed[x]);
		                }
                    return arr;
                }
            </script>
            <script type="text/javascript">
                datosX=crearCadenaLineal('<?php echo $datosX ?>');
	            datosY=crearCadenaLineal('<?php echo $datosY ?>');

	            var trace1 = {
		            x: datosX,
		            y: datosY,
		            type: 'scatter', 
					line: {
						color: '#9E7F7F',
						width: 2
					}
	            };

				var layout={
					title: 'Reservas últimos seis meses',
				}

	            var data = [trace1];
                Plotly.newPlot('grafica-lineal', data, layout);

            </script>