<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--<meta name="viewport" content="width=device-width,inicial-scale=1"> -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet" media="screen"/> -->
<title>Alumno</title>
	<link rel="stylesheet" type="text/css" href="Alum_Style.css"/>
	<script type="text/javascript" src="Alum_JavaScript.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
	<!--<script src="js/bootstrap.min.js"></script>-->
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
		$strqry = "SELECT p.nombre,p.apPat,p.apMat,p.tipo,a.matricula FROM Usuarios u INNER JOIN Personas p ON u.idUsuario=p.idUsuario INNER JOIN Alumnos a ON p.idPersona=a.idPersona WHERE u.usuario='".$_SESSION['usuario']."';";
		$qry = mysqli_query($conex,$strqry);
		$row = mysqli_fetch_object($qry);
		if(($row->tipo)=='H'){
			print"<h1 id=\"BIENVENIDO\"><span>BIENVENIDO</span></br>$row->nombre $row->apPat $row->apMat</h1>";
		}else{
			print"<h1 id=\"BIENVENIDO\"><span>BIENVENIDA</span></br>$row->nombre $row->apPat $row->apMat</h1>";
		}
		print"<h1 id=\"Matricula\">Matricula: $row->matricula</h1>";
?>	
        <div><p>Alumnos</p></div>
        <br />
        <button id="Reinscripcion" onMouseOut="mouseOut()" onMouseMove="mouseMove1()" onMouseUp="mouseUp1()">Reinscripcion</button><br/>
        <button id="Materias" onMouseOut="mouseOut()" onMouseMove="mouseMove2()" onMouseUp="mouseUp2()">Materias</button><br/>
        <button id="Tramites" onMouseOut="mouseOut()" onMouseMove="mouseMove3()" onMouseUp="mouseUp3()">Tramites</button><br/>
        <button id="Tutorias" onMouseOut="mouseOut()" onMouseMove="mouseMove4()" onMouseUp="mouseUp4()">Tutorias</button><br/>
        <button id="Mensajes" onMouseOut="mouseOut()" onMouseMove="mouseMove5()" onMouseUp="mouseUp5()">Mensajes</button><br/>
		<button id="Calificaciones" onMouseOut="mouseOut()" onMouseMove="mouseMove6()" onMouseUp="mouseUp6()">Calificaciones</button><br/>
        <button id="Kardex" onMouseOut="mouseOut()" onMouseMove="mouseMove7()" onMouseUp="mouseUp7()">Kardex-S.S</button><br/>
        <button id="Evaluacion" onMouseOut="mouseOut()" onMouseMove="mouseMove8()" onMouseUp="mouseUp8()">Evaluacion docente</button><br/>
        <br />
		<form action="Alum_Cerrar_Sesion.php" method="POST">
			<input id="Mostaza" type="submit" value="Cerrar Sesion">
		</form>
<?php /*
		mysqli_close($conex);
		session_unset();
		session_destroy();*/
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