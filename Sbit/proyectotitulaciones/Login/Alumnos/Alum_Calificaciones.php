<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--<meta name="viewport" content="width=device-width,inicial-scale=1"> -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet" media="screen"/> -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen"/>
<title>Alum_Calificaciones</title>
	<link rel="stylesheet" type="text/css" href="Alum_Style.css"/>
	<script type="text/javascript" src="Alum_JavaScript.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
	<!--<script src="js/bootstrap.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body> <!--background:#A00;-->
<?php
	if(isset($_POST['usuario'])&&isset($_POST['password'])) //Si llego un id y una contraseña via el formulario lo grabamos en la Sesion
	{
		$_SESSION['usuario'] = $_POST['usuario']; //id Grabado
		$_SESSION['password'] = $_POST['password']; //pass Grabado
	}
	if($_SESSION['usuario']&&$_SESSION['password']){
		$conex = mysqli_connect('localhost','root','','SBIT')or die("No se pudo conectar con la base de datos");
		$db = mysqli_select_db($conex,'SBIT');
		$strqry = "SELECT * FROM Calif_Alumno WHERE usuario = '".$_SESSION['usuario']."';";
		$qry = mysqli_query($conex,$strqry);
		$i = mysqli_num_rows($qry);
		$row = mysqli_fetch_object($qry);
		$r=0;
?>
		<form action="Alumnos.php" method="POST">
			<input id="Mostaza" type="submit" value="Volver">
		</form>
		<b style="font-size:38px; color:cian"><i>Calificaciones hasta el momento.</i></b>
		<table border=1 class="table table-bordered table-hover">
			<caption style="color:red">Solo materias cursadas</caption>
			<tr id="uno">
				<td rowspan=2>Ciclo</td><td colspan=4>Materias</td>
			</tr>
			<tr id="dos">
				<td>Nombre</td><td>Calificacion</td><td>Fecha</td><td>Examen</td>
			</tr>
<?php
			while($r<$i){
				mysqli_data_seek($qry,$r); //mueve el puntero a la fila especificada
				$row = mysqli_fetch_object($qry); //obtiene los datos como un objeto
				$val = "uno";
				if(($r%2)==0){
					$val = "uno";
				}else{
					$val = "dos";
				}
				$apro = 6;
				if(($row->calificacion)>=$apro){
					print"
					<tr id=\"$val\">
						<td>$row->descripcion</td><td>$row->nombreMat</td><td>$row->calificacion</td><td>$row->fecha</td><td>$row->tipoExamen</td>
					</tr>";
				}else{
					print"
					<tr id=\"$val\">
						<td>$row->descripcion</td><td>$row->nombreMat</td><td id=\"Reprobada\">$row->calificacion</td><td>$row->fecha</td><td>$row->tipoExamen</td>
					</tr>";
				}
				
				$r++;
			}
?>
		</table>
        <br />
		<form action="Alum_Cerrar_Sesion.php" method="POST">
			<input id="Mostaza" type="submit" value="Cerrar Sesion">
		</form>
<?php
		/*
		mysqli_close($conex);
		session_unset();
		session_destroy();
		*/
	}else{
?>
		<script language="javascript">
            alert('No se pudo continuar la sesion');
            location.href="../IniciarSesion.php";
        </script>
<?php 
	}
?>
</body>
</html>