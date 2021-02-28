<?php
	require_once "php/conexion.php";
	$conexion=conexion();
	$sql="select p.nombre, sum(m.creditos) as pre_has3 from usuarios u
		inner join personas p on u.idUsuario=p.idUsuario
        inner join alumnos a on p.idPersona=a.idPersona
        inner join calificaciones c on a.matricula=c.matricula
        inner join materias m on c.idMateria=m.idMateria
        where c.calificacion > 0 group by a.matricula;";
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

<div id="GraficaC"></div>
<script type="text/javascript">
datosx=crearCadenalLineal('<?php echo $datosx ?>');
datosy=crearCadenalLineal('<?php echo $datosy ?>');
	var data = [
  		{
    		x: datosx,
    		y: datosy,
    		type: 'bar'
  		}
		];

	Plotly.newPlot('GraficaC', data);
</script>