<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/estilos.css" />
<script type="text/javascript" src="bootstrap-3.3.7-dist/js/jquery-3.1.0.min.js"></script>
<title>Documento sin título</title>
</head>
<?php
	if(isset($_POST['usuario'])&&isset($_POST['password'])) //Si llego un id y una contraseña via el formulario lo grabamos en la Sesion
	{
		$_SESSION['usuario'] = $_POST['usuario']; //id Grabado
		$_SESSION['password'] = $_POST['password']; //pass Grabado
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
		$consulta="select * from Num_Rep where matricula='".$pre_has."'";
		$resultado_consulta_mysql=mysqli_query($link,$consulta);


		//Materias Aprobadas
		$consulta2="select * from Num_Apr where matricula='".$pre_has."'";
		$resultado_consulta_mysql2=mysqli_query($link,$consulta2);


		//Creditos
		//guarda la cantidad total de creditos
		$id2 = "select sum(creditos) as pre_has2 from materias;";
		$result2 = mysqli_query($link, $id2);
		$row2 = mysqli_fetch_assoc($result2);
		$pre_has2= $row2['pre_has2'];
		//guarda los creditos de los alumnos
		$id3="select sum(m.creditos) as pre_has3 from usuarios u
		inner join personas p on u.idUsuario=p.idUsuario
        inner join alumnos a on p.idPersona=a.idPersona
        inner join calificaciones c on a.matricula=c.matricula
        inner join materias m on c.idMateria=m.idMateria
        where a.matricula='".$pre_has."'";
		$result3 = mysqli_query($link, $id3);
		$row3 = mysqli_fetch_assoc($result3);
		$pre_has3= $row3['pre_has3'];


		//Calificacions del alumno
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
						<?php echo "<div class='panel panel-footer col-sm-6' >";
						echo "<H3>Calificaciones cursadas</H3>";
						while ($columna2 = mysqli_fetch_array($resultado_consulta_mysql2)){
							echo "Numero de materias aprobadas:" .$columna2['Mat_Apr']."<br>";
							}
							while ($columna = mysqli_fetch_array($resultado_consulta_mysql)){
								echo "Numero de materias reprobadas:" .$columna['Mat_Rep']."<br>";
							}
							$cre=($pre_has3*100)/$pre_has2;
							echo "creditos:".$cre."%<br>";echo "</div>";
							$consulta4="select * from Cal_Ciclo where matricula='".$pre_has."'";
							$resultado_consulta_mysql4=mysqli_query($link,$consulta4); ?>
						</div>
					</div>
				<div class="col">
				<section>
					<H3>Materias cursadas</H3>
						<div class="col-md-6 col-md-off-set-3">
								<div class="panel panel-default">
										<div class="panel-body">
														<div class="form-group">
																<div class="table-responsive col aling-self-star">
																		<table class="table table-striped table-dark table-hover" align="center">
																				<thead class="active">
																						<th>Ciclo Escolar</th>
																							<th>Nombre</th>
																							<th>Calificacion</th>
																					</thead>
																					<tbody style="cursor:pointer">
																						<?php
															while ($columna4 = mysqli_fetch_array($resultado_consulta_mysql4)){
															echo "<tr>";
															echo "<td>" .$columna4['descripcion'] . "</td><td>".$columna4['nombre']  . "</td><td>".$columna4['calificacion'];
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
		</div>

    </div>
		<?php }
?>

<body>
</body>
</html>
