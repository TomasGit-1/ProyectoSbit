<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lista Tutorados</title>
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
		$id = "select u.usuario, m.idMaestro as pre_has from usuarios u
		inner join personas p on u.idUsuario=p.idUsuario
		inner join maestros m on p.idPersona=m.idPersona
		where u.usuario='".$_SESSION['usuario']."'";
		$result = mysqli_query($link, $id);
		$row = mysqli_fetch_assoc($result);
		$pre_has= $row['pre_has'];
		//Recupero el id del maestro
		$id = "select u.usuario, m.idMaestro as pre_has from usuarios u
		inner join personas p on u.idUsuario=p.idUsuario
		inner join maestros m on p.idPersona=m.idPersona
		where u.usuario='".$_SESSION['usuario']."'";
		$result = mysqli_query($link, $id);
		$row = mysqli_fetch_assoc($result);
		$pre_has= $row['pre_has'];

		$con="select p.nombre, p.apPat, p.apMat from personas p
			inner join alumnos a on p.idPersona=a.idPersona
			inner join tutorias t on a.matricula=t.matricula
			where t.idMaestro=1";
		$resultado_consulta_mysql=mysqli_query($link,$con);?>
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
							<?php
							echo "<center><h1>Lista de Tutorados</h1>";
							echo "<table border='2', align='center'>";
							echo "<thead>";
							echo "<tr>";
							echo "<th> Nombre </th>";
							echo "<th> Apellido paterno </th>";
							echo "<th> Apellido Materno </th>";
							echo "</tr>";
							echo "</thead>";
							while ($columna= mysqli_fetch_array($resultado_consulta_mysql)){
								echo "<tr>";
								echo "<td>" .$columna['nombre'] . "</td><td>".$columna['apPat']  . "</td><td>".$columna['apMat']."</td>";
								echo "</tr>";
								}
								echo "</table>";
							?>
						</br>
						</div>
					</div>
				</div>

<?php
	}
?>
<body>
</body>
</html>
