<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alum_Materias</title>
	<link rel="stylesheet" type="text/css" href="Alum_Style.css"/>
	<script type="text/javascript" src="Alum_JavaScript.js"></script>
	<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen"/>
    <link rel="stylesheet" type="text/css" href="Alum_Style.css"/>
	<script type="text/javascript" src="Alum_JavaScript.js"></script>
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
		$strqry = "SELECT * FROM Plan_Alumno WHERE usuario = '".$_SESSION['usuario']."';";
		$qry = mysqli_query($conex,$strqry);
		$row = mysqli_fetch_object($qry);
		//---------------------------------------------------------------------';
		$strqry = "SELECT * FROM Materias_Alumno WHERE idCarrera = ".$row->idCarrera.";";
		$qry = mysqli_query($conex,$strqry);
		$i = mysqli_num_rows($qry);
		$row = mysqli_fetch_object($qry);
		$r=0;
?>
		<form action="Alumnos.php" method="POST">
			<input class="btn btn-outline-danger text-center" id="Mostaza" type="submit" value="Volver">
		</form>
		<b><i id="Amarillo">Plan de estudios.</i></b></br>
        <table>
			<tr>
				<td id="Crema">Aprobada.</td><td id="Aprobada">Materia</td>
			</tr>
            <tr>
				<td id="Crema">Reprobada.</td><td id="Reprobada">Materia</td>
			</tr>
            <tr>
				<td id="Crema">Por Cursar.</td><td id="PorCursar">Materia</td>
			</tr>
		</table>
		<table border=1>
<?php
			while($r<$i){
				print"<tr id=\"$row->idMateria\">";
				for($j=0;$j<6;$j++){
					mysqli_data_seek($qry,$r); //mueve el puntero a la fila especificada
					$row = mysqli_fetch_object($qry); //obtiene los datos como un objeto
					if($r>=$i){
						print"<td id=\"vacio\"> </td>";
					}else{
						//Retorna un resultado si la calificacion es >= 6
						$strqryAP = "SELECT * FROM Aprobada_Alumno WHERE usuario = '".$_SESSION['usuario']."' AND idMateria = ".$row->idMateria.";";
						$qryAP = mysqli_query($conex,$strqryAP);
						$AP = mysqli_num_rows($qryAP); // Numero de resultados
						//Retorna un resultado si la calificacion es <= 5 y > 0
						$strqryRE = "SELECT * FROM Reprobada_Alumno WHERE usuario = '".$_SESSION['usuario']."' AND idMateria = ".$row->idMateria.";";
						$qryRE = mysqli_query($conex,$strqryRE);
						$RE = mysqli_num_rows($qryRE); // Numero de resultados
						if($AP>0){
							print"<td id=\"Aprobada\">$row->nombreMat</td>";
						}else{
							if($RE>0){
								print"<td id=\"Reprobada\">$row->nombreMat</td>";
							}else{
								print"<td id=\"PorCursar\">$row->nombreMat</td>";
							}
						}
					}
					$r++;
				}
				print"</tr>";
			}
?>
		</table>
        <b><i id="Amarillo">Materias faltantes.</i></b></br>
<?php
		$r=0;
		print"<p id=\"Rojo\">";
        while($r<$i){
			mysqli_data_seek($qry,$r); //mueve el puntero a la fila especificada
			$row = mysqli_fetch_object($qry); //obtiene los datos como un objeto
			if($r>=$i){
				break;
			}else{
				//Retorna un resultado si la calificacion es <= 5 y > 0
				$strqryAP = "SELECT * FROM Aprobada_Alumno WHERE usuario = '".$_SESSION['usuario']."' AND idMateria = ".$row->idMateria.";";
				$qryAP = mysqli_query($conex,$strqryAP);
				$AP = mysqli_num_rows($qryAP); // Numero de resultados
				if($AP>0){
					print"";
				}else{
					print"<p id=\"Crema\">".$row->nombreMat." (".$row->creditos." creditos).</p>";
					//<input name=\"cred.$row->idMateria\" type=\"radio\" id=\"$row->idMateria\" value=\"$row->idMateria\">
				}
			}
			$r++;
		}
		print"</p>";
?>
        <!--
        <script language="javascript">
            var elemsradio = document.getElementsByName("datos");
            for(var i=0;i<elemsradio.length;i++){
				alert("Elemento: "+elemsradio[i].value+"\nSeleccionado "+elemsradio[i].checked);
			}
        </script>
        -->
		<form action="Alum_Cerrar_Sesion.php" method="POST">
			<input class="btn btn-outline-danger text-center" id="Mostaza" type="submit" value="Cerrar Sesion">
		</form>
<?php
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