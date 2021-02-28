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
<title>Alum_Calificaciones</title>
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
		//Retorna la matricula dependiendo del usuario introducido--------------------------------------------------
		$strqryMatri = "SELECT al.matricula FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
		INNER JOIN Alumnos al ON pe.idPersona = al.idPersona WHERE us.usuario = '".$_SESSION['usuario']."';";
		$qryMatri = mysqli_query($conex,$strqryMatri);
		$rowMatri = mysqli_fetch_object($qryMatri);
		//Retorna los id de ciclos escolares dependiendo de la matricula introducida--------------------------------
		$strqryCic= "SELECT DISTINCT idCiclo FROM Calificaciones WHERE matricula = '".$rowMatri->matricula."';";
		$qryCic = mysqli_query($conex,$strqryCic);
		//$rowCic = mysqli_fetch_object($qryCic);
		$j = mysqli_num_rows($qryCic);
		$t = 0;
		//----------------------------------------------------------------------------------------------------------
		$rowBoleta = mysqli_fetch_object($qryCic);
		$min = $t;
		$max = $j;
		//----------------------------------------------------------------------------------------------------------
?>
		<form action="Alumnos.php" method="POST">
			<input class="btn btn-outline-danger text-center" id="Mostaza" type="submit" value="Volver">
		</form>
		<!-- -------------------------------------------------------------------------------------------------------------------------- -->
		<form action="Alum_Calificaciones.php" method="POST">
			<b><i id="Amarillo">Consultar: </i></b><br />
			<div class="input-group" style="background:#663333;">
				<select class="custom-select col-md-3" name="cicloBoleta">
<?php
				while($t<$j){
					mysqli_data_seek($qryCic,$t); //mueve el puntero a la fila especificada
					$rowCic = mysqli_fetch_object($qryCic); //obtiene los datos como un objeto
					$t++;
					print"<option value=\"$rowCic->idCiclo\">Boleta ($t)</option>";
				}
?>
				</select>
				<div class="input-group-append">
					<input class="btn btn-outline-danger text-center" id="Mostaza" name="submit" type="submit" value="Consultar Boleta">
			  	</div>
			</div>
		</form>
		<br>
<?php
		if(isset($_POST['submit'])){
			//Retorna la boleta dependiendo el ciclo introducido--------------------------------------------------------
			$strqryBA = "SELECT * FROM Boleta_Alumno WHERE usuario = '".$_SESSION['usuario']."' AND idCiclo = '".$_POST['cicloBoleta']."';";
			$qryBA = mysqli_query($conex,$strqryBA);
			$rowBA = mysqli_fetch_object($qryBA);
			$k = mysqli_num_rows($qryBA);
			$s = 0;
			$boleta;
			//-----------------------------------------------
			while($min<$max){
				mysqli_data_seek($qryCic,$min); //mueve el puntero a la fila especificada
				$rowCic = mysqli_fetch_object($qryCic); //obtiene los datos como un objeto
				$min++;
				if(($rowCic->idCiclo)==$_POST['cicloBoleta']){
					$boleta = $min;
				}
			}
			//-----------------------------------------------
?>
			<!-- -------------------------------------------------------------------------------------------------------------------------- -->
			<b><i id="Amarillo">Boleta <?php print"$boleta";?></i></b>
			<table border=1 class="table table-bordered table-hover">
				<!-- <caption style="color:red">Solo materias cursadas</caption> -->
				<tr id="uno">
					<td rowspan=3 colspan=2>Sin fotografia</td><td colspan=2>NOMBRE DEL ALUMNO<br><?php print"$rowBA->nombre $rowBA->apPat $rowBA->apMat";?></td>
					<td colspan=4>EVALUACIONES</td><td>GRADO<br><?php print"$boleta";?></td><td colspan=2>NUMERO DE MATERIAS<br><?php print"$k";?></td>
				</tr>
				<tr id="uno">
					<td>MATRICULA<br><?php print"$rowBA->matricula";?></td><td>CURP<br><?php print"$rowBA->usuario";?></td><td rowspan=2></td><td rowspan=2></td><td rowspan=2></td><td rowspan=2></td><td rowspan=2 colspan=3>CICLO ESCOLAR<br><?php print"$rowBA->descripcion";?></td>
				</tr>
				<tr id="uno">
					<td colspan=2>CARRERA<br><?php print"$rowBA->nombreLic";?></td>
				</tr>
				<tr id="uno">
					<td>CRED.</td><td>CLAV.MAT.</td><td colspan=2>NOMBRE DE LA MATERIA</td><td>1a</td><td>2a</td><td>3a</td><td>4a</td><td>CALIF</td><td>FECHA EX.</td><td>TIPO EX.</td>
				</tr>
<?php
				while($s<$k){
					mysqli_data_seek($qryBA,$s); //mueve el puntero a la fila especificada
					$row = mysqli_fetch_object($qryBA); //obtiene los datos como un objeto
					$val = "uno";
					if(($s%2)==0){
						$val = "dos";
					}else{
						$val = "tres";
					}
					$apro = 6;
					if(($row->calificacion)>=$apro){
						print"
						<tr id=\"$val\">
							<td>$row->creditos</td><td>$row->idMateria</td><td colspan=2>$row->nombreMat</td><td></td><td></td><td></td><td></td>
							<td>$row->calificacion</td><td>$row->fecha</td><td>$row->tipoExamen</td>
						</tr>";
					}else{
						print"
						<tr id=\"$val\">
							<td>$row->creditos</td><td>$row->idMateria</td><td colspan=2>$row->nombreMat</td><td></td><td></td><td></td><td></td>
							<td id=\"Reprobada\">$row->calificacion</td><td>$row->fecha</td><td>$row->tipoExamen</td>
						</tr>";
					}
					$s++;
				}
?>
			</table>
<?php
		}
?>
		<!-- -------------------------------------------------------------------------------------------------------------------------- -->
		<!--
		<b style="font-size:38px; color:cian"><i>Todas sus calificaciones.</i></b>
		<table border=1 class="table table-bordered table-hover">
			<!- <caption style="color:red">Solo materias cursadas</caption> ->
			<tr id="uno">
				<td rowspan=2>Ciclo</td><td colspan=4>Materias</td>
			</tr>
			<tr id="dos">
				<td>Nombre</td><td>Calificacion</td><td>Fecha</td><td>Examen</td>
			</tr>
		
-- <php/*
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
-- ?>
		</table>
        <br />
        -->
		<form action="Alum_Cerrar_Sesion.php" method="POST">
			<input class="btn btn-outline-danger text-center" id="Mostaza" type="submit" value="Cerrar Sesion">
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