<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css" />
<script type="text/javascript" src="bootstrap-3.3.7-dist/js/jquery-3.1.0.min.js"></script>
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
		//selecciono el idM
		$id = "select t.matricula as pre_has from tutorias t inner join
		 alumnos a on a.matricula=t.matricula inner join
		 personas p on p.idPersona=a.idPersona inner join
		 usuarios u on u.idUsuario=p.idUsuario where u.usuario='".$_SESSION['usuario']."'";
		 $result = mysqli_query($link, $id);
		 $row = mysqli_fetch_assoc($result);
		 $pre_has= $row['pre_has'];
		 //selecciono al profesor
		 $pro="select p.idPersona as idp from personas p inner join
		 maestros m on m.idPersona=p.idPersona inner join
		 tutorias t on t.idMaestro=m.idMaestro where matricula='".$pre_has."'";
		 $result2 = mysqli_query($link, $pro);
		 $row2 = mysqli_fetch_assoc($result2);
		 $idM= $row2['idp'];
		 $con = "select p.nombre, p.apPat, p.apMat,p.correo
		from personas p inner join maestros m on
		p.idPersona=m.idPersona
		where p.idPersona='".$idM."'";
		$resultado_consulta_mysql=mysqli_query($link,$con);
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
					<h2>Tu Tutor asignado es:</h2>
					<table class="table table-striped table-dark table-hover" align="center">
							<thead>
								<th>Nombre</th>
									<th>Apellido Paterno</th>
									<th>Apellido Materno</th>
									<th>Correo</th>
							</thead>
							<tbody style="cursor:pointer">
								<?php
							while ($columna = mysqli_fetch_array($resultado_consulta_mysql)){
							echo "<tr>";
							echo "<td>" .$columna['nombre'] . "</td><td>".$columna['apPat']  . "</td><td>".$columna['apMat']. "</td><td>".$columna['correo'];
						echo "</tr>";
						}
						 echo "</table>";
					 ?>
						</tbody>
				</table>
				</div>
			</div>
		</div>
	<?php }
?>

<body>
</body>
</html>
