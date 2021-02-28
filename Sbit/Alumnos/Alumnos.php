<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen"/>
    <link rel="stylesheet" type="text/css" href="Alum_Style.css"/>
	<script type="text/javascript" src="Alum_JavaScript.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
<title>Alumno</title>
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
		$strqry = "SELECT p.nombre,p.apPat,p.apMat,p.tipo,a.matricula,a.validacion1,a.validacion2 FROM Usuarios u INNER JOIN Personas p ON u.idUsuario=p.idUsuario INNER JOIN Alumnos a ON p.idPersona=a.idPersona WHERE u.usuario='".$_SESSION['usuario']."';";
		$qry = mysqli_query($conex,$strqry);
		$row = mysqli_fetch_object($qry);
?>	
        <br />
        <script>
			function mouseUp1() {
				document.getElementById("Reinscripcion").style.backgroundColor = "red";
				if(document.getElementsByName("validacion2")[0].value==0){
					alert("Primero completa la Evaluacion docente"); //falso
				}else{
					//alert("Verdadero");
					location.href = "Alum_Reinscripcion.php";
				}
			}
			function mouseUp8() {
				document.getElementById("Evaluacion").style.backgroundColor = "red";
				if(document.getElementsByName("validacion1")[0].value==0){
					alert("Las evaluaciones aun no estan disponibles"); //falso
				}else{
					//alert("Verdadero");
					location.href = "Alum_Evaluacion.php";
				}
			}
		</script>
		<!-- ------------------------------------------------------------------------------------------------------------------- -->
		<div class="container">
			<div class="bg-dark" align="center"  style="height:30px">
		    <p class="text-light">Recuerde cerrar su sesión al terminar su actividad en la plataforma</p>
		</div>
		<div ><img style="height:137px"  class="w-100" src="Imagenes/SBIT.jpeg"  /></div>
		  <!--
		  <nav class="navbar  navbar navbar-expand-lg navbar-dark bg-dark">
		      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"></button>
		      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		         <div class="navbar-nav">
		            <a class="nav-item nav-link " href="Administrador.php">
		             <img src="Imagenes/sbit.jpg" width="30" height="30" >&ensp;&ensp;
		             Inicio <span class="sr-only">(current)</span></a>
		            <a class="nav-item nav-link" href="Alumno.php">Alumno</a>
		            <a class="nav-item nav-link" href="Docente.php">Docente</a>
		            <a class="nav-item nav-link active " href="#">Titulacion</a>
		            <a class="nav-item nav-link " href="Tutorias.php">Tutorias</a>
		         </div>
		      </div>
		  </nav>
			-->
		<div id="tres"> <!-- State Button  class="row"-->
			<div id="tres">
            	<?php if(($row->tipo)=='H'){
					print"<i id=\"BIENVENIDO\"><span>BIENVENIDO</span></br>$row->nombre $row->apPat $row->apMat</i>";
			}else{
					print"<i id=\"BIENVENIDO\"><span>BIENVENIDA</span></br>$row->nombre $row->apPat $row->apMat</i>";
				}
				print"<br/><i id=\"Matricula\">Matricula: $row->matricula</i>";
				?>
            </div>  
        	<div style="height:320px;" id="tres" class="list-group" id="list-tab" role="tablist">
                <button class="btn btn-danger text-center" id="Reinscripcion" onMouseOut="mouseOut()" onMouseMove="mouseMove1()" onMouseUp="mouseUp1()" name="validacion2" 
				<?php print"value=\"$row->validacion2\"";?>>Reinscripci&oacute;n</button>
		        <button class="btn btn-warning text-center" id="Materias" onMouseOut="mouseOut()" onMouseMove="mouseMove2()" onMouseUp="mouseUp2()">Materias</button>
		        <button class="btn btn-danger text-center" id="Tramites" onMouseOut="mouseOut()" onMouseMove="mouseMove3()" onMouseUp="mouseUp3()">Tramites</button>
		        <button class="btn btn-warning text-center" id="Tutorias" onMouseOut="mouseOut()" onMouseMove="mouseMove4()" onMouseUp="mouseUp4()">Tutorias</button>
		        <button class="btn btn-danger text-center" id="Mensajes" onMouseOut="mouseOut()" onMouseMove="mouseMove5()" onMouseUp="mouseUp5()">Mensajes</button>
				<button class="btn btn-warning text-center" id="Calificaciones" onMouseOut="mouseOut()" onMouseMove="mouseMove6()" onMouseUp="mouseUp6()">Calificaciones</button>
		        <button class="btn btn-danger text-center" id="Kardex" onMouseOut="mouseOut()" onMouseMove="mouseMove7()" onMouseUp="mouseUp7()">Kardex-S.S</button>
		        <button class="btn btn-warning text-center" id="Evaluacion" onMouseOut="mouseOut()" onMouseMove="mouseMove8()" onMouseUp="mouseUp8()" name="validacion1" 
				<?php print"value=\"$row->validacion1\"";?>>Evaluaci&oacute;n docente</button>  
        	</div>  
        </div>
	 	<div class="bg-dark" align="center"  style="height:30px">
	   	 	<p class="text-light">Recuerde cerrar su sesión al terminar su actividad en la plataforma</p>
	 	</div>
		</div>
		<!-- ------------------------------------------------------------------------------------------------------------------- -->
		<form action="Alum_Cerrar_Sesion.php" method="POST">
			<input class="btn btn-outline-danger text-center" id="Mostaza" type="submit" value="Cerrar Sesion">
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