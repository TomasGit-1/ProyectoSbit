<?php
	require_once "php/conexion.php";
	$conexion=conexion();
	$sql="select m.nombre, count(c.matricula) as Num_Al from alumnos a
	inner join calificaciones c on a.matricula=c.matricula
	inner join materias m on c.idMateria=m.idMateria where c.calificacion>5
	group by m.nombre;";
	$result=mysqli_query($conexion,$sql);
	$valoresy=array();
	$valoresx=array();
	while($ver=mysqli_fetch_row($result)){
		$valoresy[]=$ver[1];
		$valoresx[]=$ver[0];
	}
	
	$datosx=json_encode($valoresx);
	$datosy=json_encode($valoresy);
?>

<div id="GraficaA"></div> 

<script type="text/javascript">
	function crearCadenalLineal(json){
		var parsed= JSON.parse(json);
		var arr=[];
		for (var x in parsed){
			arr.push(parsed[x]);
			}
			return arr;
		}
		
</script>

<script type="text/javascript">
datosx=crearCadenalLineal('<?php echo $datosx ?>');
datosy=crearCadenalLineal('<?php echo $datosy ?>');
	var trace1 = {
  		x: datosx,
  		y: datosy,
 		type: 'scatter'
	};

	var data = [trace1];

Plotly.newPlot('GraficaA', data);
</script>

