<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/estilos.css" />
<script src="bootstrap-3.3.7-dist/js/jquery-3.1.0.min.js"></script>
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
		//Materias Reprobadas
		$id = "select t.matricula as pre_has from usuarios u
		inner join personas p on u.idUsuario=p.idUsuario
		inner join alumnos a on p.idPersona=a.idPersona
		inner join tutorias t on a.matricula=t.matricula
		where u.usuario='".$_SESSION['usuario']."'";
		$result = mysqli_query($link, $id);
		$row = mysqli_fetch_assoc($result);
		$pre_has= $row['pre_has'];
		$con1="select p.nombre,p.apPat, p.apMat, m.nombre, c.calificacion from personas p
		inner join alumnos a on p.idPersona=a.idPersona
		inner join calificaciones c on a.matricula=c.matricula
		inner join materias m on c.idMateria=m.idMateria
		where a.matricula='".$pre_has."' and c.calificacion >5;";
		$resultado_consulta_mysql=mysqli_query($link,$con1);


		$con2="select p.nombre,p.apPat, p.apMat, m.nombre, c.calificacion from personas p
	 inner join alumnos a on p.idPersona=a.idPersona
	 inner join calificaciones c on a.matricula=c.matricula
	 inner join materias m on c.idMateria=m.idMateria
	 where a.matricula='".$pre_has."' and c.calificacion <=5 and c.calificacion > 0;";
	 $resultado_consulta_mysql2=mysqli_query($link,$con2);

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
							<section>
									<div class="col-md-6 col-md-off-set-3">
											<div class="panel panel-default">
													<div class="panel-body">
														<div class="form-group">
															<div class="table-responsive">
																<table class="table" align="center">
																		<thead>
																			<h3>Materias Aprobadas</h3>
																				<th>Materia</th>
																					<th>Nombre</th>
																					<th>Apellido</th>
																					<th>Calificacion</th>
																			</thead>
																			<tbody style="cursor:pointer">
																				<?php
																		while ($columna = mysqli_fetch_array($resultado_consulta_mysql)){
																		echo "<tr>";
																		echo "<td>" .$columna['nombre'] . "</td><td>".$columna['apPat']  . "</td><td>".$columna['apMat']."</td><td>".$columna['calificacion']."</td>";
																		echo "</tr>";}
																 ?>
																</table>
															</div>
														</div>
													</div>
												</div>
										</div>
								</section>
						</div>
					</div>
					<div class="col"  style="background-color:#F1c40f">
						<div class="col">
							<section>
							<div class="col-md-6 col-md-off-set-3">
									<div class="panel panel-default">
											<div class="panel-body">
															<div class="form-group">
																	<div class="table-responsive">
																			<table class="table" align="center">
																					<thead>
																						<h3>Materias Reprobadas</h3>
																							<th>Materias</th>
																								<th>Nombre</th>
																								<th>Apellido</th>
																								<th>Calificacion</th>
																						</thead>
																						<tbody style="cursor:pointer">
																							<?php
																while ($columna2 = mysqli_fetch_array($resultado_consulta_mysql2)){
						 echo "<tr>";
						 echo "<td>" .$columna2['nombre'] . "</td><td>".$columna2['apPat']  . "</td><td>".$columna2['apMat']."</td><td>".$columna2['calificacion']."</td>";
						 echo "</tr>";
							}
						 echo "</table>";
														 ?>
																						</tbody>
																				</table>
																		</div>
																</div>
												</div>
										</div>
								</div>
						</section>
						</div>
					</div>
				</div>


<?php }
		?>
<body>
</body>
</html>
