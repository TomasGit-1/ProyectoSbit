<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<?php
	if(isset($_POST['usuario'])&&isset($_POST['password']))
	{
		$_SESSION['usuario'] = $_POST['usuario'];
		$_SESSION['password'] = $_POST['password'];
	}
	if($_SESSION['usuario']&&$_SESSION['password']){
		$link = mysqli_connect ('localhost','root','','sbit') or die ("No se logro la conexion");
		$db = mysqli_select_db ($link,"sbit");
		//Consultar la tabla
		$consulta="select nombre, apPat, apMat, n from Num_Tut
		where usuario='".$_SESSION['usuario']."'";
		$resultado_consulta_mysql=mysqli_query($link,$consulta);

		//Imprimir el listado de alumnos rep
		$id = "select u.usuario, m.idMaestro as pre_has from usuarios u
		inner join personas p on u.idUsuario=p.idUsuario
		inner join maestros m on p.idPersona=m.idPersona
		where u.usuario='".$_SESSION['usuario']."'";
		$result = mysqli_query($link, $id);
		$row = mysqli_fetch_assoc($result);
		$pre_has= $row['pre_has'];
		$consulta2="select nombre, apPat, apMat, Mat_Rep from Num_Rep
		where idMaestro='".$pre_has."'";
		$resultado_consulta_mysql2=mysqli_query($link,$consulta2);

		//Imprimir el listado de alumnos Aprobados
		$consulta3="select nombre, apPat, apMat, Mat_Apr from Num_Apr
		where idMaestro='".$pre_has."'";
		$resultado_consulta_mysql3=mysqli_query($link,$consulta3);
		?>

		<body style="background-color:#663333;">
		<center><div class="container" style="background-color:#F1c40f" >
			<div class="row">
				<div class="col" style="background-color:#663322">
						<img src="imgenes\uabjo.png"/>
				</div>
			</div>
				<div class="row">
					<div class="col"  style="background-color:#F1c40f">
						<div class="col">
							<?php echo "<center><h1>Numero de Tutorados</h1>";
							echo "<table border='2', align='center'>";
							echo "<thead>";
							echo "<tr>";
							echo "<th> Nombre </th>";
							echo "<th> Apellido paterno </th>";
							echo "<th> Apellido Materno </th>";
							echo "<th> Num. Alumnos </th>";
							echo "</tr>";
							echo "</thead>";
							while ($columna = mysqli_fetch_array($resultado_consulta_mysql)){
								echo "<tr>";
								echo "<td>" .$columna['nombre'] . "</td><td>".$columna['apPat']  . "</td><td>".$columna['apMat']."</td><td>".$columna['n']."</td>";
								echo "</tr>";
								}
								echo "</table>";
							 ?>
						</div>
					</div>
					<div class="col"  style="background-color:#F1c40f">
						<div class="col">
							<?php
							echo "<center><h1>Numero de Materias Reprobadas por el alumno</h1>";
							echo "<table border='2', align='center'>";
							echo "<thead>";
							echo "<tr>";
							echo "<th> Nombre </th>";
							echo "<th> Apellido paterno </th>";
							echo "<th> Apellido Materno </th>";
							echo "<th> Materias Reprobadas </th>";
							echo "</tr>";
							echo "</thead>";
							while ($columna2 = mysqli_fetch_array($resultado_consulta_mysql2)){
								echo "<tr>";
								echo "<td>" .$columna2['nombre'] . "</td><td>".$columna2['apPat']  . "</td><td>".$columna2['apMat']."</td><td>".$columna2['Mat_Rep']."</td>";
								echo "</tr>";
								}
								echo "</table>";

							 ?>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col"  style="background-color:#F1c40f">
						<div class="col">
							<?php
							echo "<center><h1>Numero de Materias Reprobadas por el alumno</h1>";
							echo "<table border='2', align='center'>";
							echo "<thead>";
							echo "<tr>";
							echo "<th> Nombre </th>";
							echo "<th> Apellido paterno </th>";
							echo "<th> Apellido Materno </th>";
							echo "<th> Materias Reprobadas </th>";
							echo "</tr>";
							echo "</thead>";
							while ($columna3 = mysqli_fetch_array($resultado_consulta_mysql3)){
								echo "<tr>";
								echo "<td>" .$columna3['nombre'] . "</td><td>".$columna3['apPat']  . "</td><td>".$columna3['apMat']."</td><td>".$columna3['Mat_Apr']."</td>";
								echo "</tr>";
								}
								echo "</table>";
							 ?>
							 </br>
						</div>
					</div>
				</div>

<?php
		mysqli_close($link);
	}
?>
<body>
</body>
</html>
