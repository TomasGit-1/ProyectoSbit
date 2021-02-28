<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen"/>
<title>Alum_Horario</title>
	<link rel="stylesheet" type="text/css" href="Alum_Style.css"/>
	<script type="text/javascript" src="Alum_JavaScript.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script src="../js/jspdf.min.js"></script>
    <script src="../js/jspdf.plugin.autotable.min.js"></script>
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
		$strqryP = "SELECT * FROM Plan_Alumno WHERE usuario = '".$_SESSION['usuario']."';";
		$qryP = mysqli_query($conex,$strqryP);
		$rowP = mysqli_fetch_object($qryP);
		//---------------------------------------------------------------------';
		$strqry = "SELECT * FROM Materias_Alumno WHERE idCarrera = ".$rowP->idCarrera.";";
		$qry = mysqli_query($conex,$strqry);
		$i = mysqli_num_rows($qry);
		//$row = mysqli_fetch_object($qry);
		$r=0;
?>
		<form action="Alumnos.php" method="POST">
			<input class="btn btn-outline-danger text-center" id="Mostaza" type="submit" value="Volver">
		</form>
		<b><i id="Amarillo">Horario alumno.</i></b></br>
<?php
        if(isset($_POST['submitt'])){
?>
            <table border=1 id="Horario">
            <form action="Alum_Solicitud.php" name="datos" method="POST">
                <p id="Crema">Solicitud reinscripci&oacute;n: </p><input class="btn btn-outline-secondary" type="file" name="doc1" id="archivo" size="40"><br/>
                <p id="Crema">Comprobante pago a servicios escolares: </p><input class="btn btn-outline-secondary" type="file" name="doc2" id="archivo" size="40"><br/>
                <p id="Crema">Orden de pago: </p><input class="btn btn-outline-secondary" type="file" name="doc3" id="archivo" size="40"><br/><br/>
                <div class="valid-feedback">OK!</div>
<?php
			//Retorna la matricula dependiendo del usuario introducido--------------------------------------------------
			$strqryMatri = "SELECT al.matricula FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
			INNER JOIN Alumnos al ON pe.idPersona = al.idPersona WHERE us.usuario = '".$_SESSION['usuario']."';";
			$qryMatri = mysqli_query($conex,$strqryMatri);
			$rowMatri = mysqli_fetch_object($qryMatri);
			//Retorna el idMaestro dependiendo de la matricula introducida----------------------------------------------
			$strqryMtr = "SELECT idMaestro FROM Tutorias WHERE matricula = '".$rowMatri->matricula."';";
			$qryMtr = mysqli_query($conex,$strqryMtr);
			$rowMtr = mysqli_fetch_object($qryMtr);
			//Insertar horario.png en Mensajes--------------------------------------------------------------------------
			if(empty($_POST['reenvia'])){
				$strqryRE = "INSERT INTO Mensajes(idMaestro,matricula,tipo,enviado,msgTexto,msgArchivo,fecha) 
				values(".$rowMtr->idMaestro.",".$rowMatri->matricula.",1,'E2','Horario Reinscripcion',
				'Horario".$_SESSION['usuario'].".png',(SELECT CURDATE()));";
				$qryRE = mysqli_query($conex,$strqryRE);
			}
        }else{
?>
            <table border=1>
            <form action="Alum_Horario.php" name="datos" method="POST">
<?php
		}
		$strqryP = "SELECT * FROM Plan_Alumno WHERE usuario = '".$_SESSION['usuario']."';";
		$qryP = mysqli_query($conex,$strqryP);
		$rowP = mysqli_fetch_object($qryP);
?>
            <tr id="tres">
            	<td colspan=3>NOMBRE DEL ALUMNO</br><?php print $rowP->nombre." ".$rowP->apPat." ".$rowP->apMat; ?></td>
                <td colspan=5>DIAS</td>
                <!-- -------<td colspan=2>PERIODO LECTIVO</br><php $rowP->nombre." ".$rowP->apPAt." ".$rowP->apMat ?></td>
                <td rowspan=2 colspan=2>CICLO ESCOLAR</td>------- -->
                <td rowspan=3></td>
			</tr>
			<tr id="tres">
                <td>MATRICULA</br><?php print $rowP->matricula; ?></td>
                <td colspan=2>USUARIO</br><?php print $rowP->usuario; ?></td>
                <td rowspan=2 id="dia">LUNES</td>
                <td rowspan=2 id="dia">MARTES</td>
				<td rowspan=2 id="dia">MIERCOLES</td>
                <td rowspan=2 id="dia">JUEVES</td>
                <td rowspan=2 id="dia">VIERNES</td>
				<!-- -------<td colspan=2>CICLO ESCOLAR</td>---------- -->
			</tr>
			<tr id="tres">
                <td colspan=3>CARRERA</br><?php print $rowP->nombreLic; ?></td>
                <!-- -------<td>TOTAL DE MATERIAS</td><td>-NUM-</td>---------- -->
            </tr>
            <tr id="uno">
                <td>CREDITOS</td>
                <td>CLAV.MAT.</td>
                <td>NOMBRE DE LA MATERIA</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>CATEDRATICO</td>
            </tr>
<?php
			$sum = 0;
			$hIni = 8;
			$hFin = 9;
			$datos = "";
			while($r<$i){
				$val = "dos";
				for($j=0;$j<6;$j++){
					mysqli_data_seek($qry,$r); //mueve el puntero a la fila especificada
					$row = mysqli_fetch_object($qry); //obtiene los datos como un objeto
					if($r>=$i){
						print" ";
					}else{
						//Retorna un resultado si la calificacion es >= 6
						$strqryAP = "SELECT * FROM Aprobada_Alumno WHERE usuario = '".$_SESSION['usuario']."' AND idMateria = ".$row->idMateria.";";
						$qryAP = mysqli_query($conex,$strqryAP);
						$AP = mysqli_num_rows($qryAP); // Numero de resultados
						//Retorna un resultado si la calificacion es <= 5 y > 0
						$strqryRE = "SELECT * FROM Reprobada_Alumno WHERE usuario = '".$_SESSION['usuario']."' AND idMateria = ".$row->idMateria.";";
						$qryRE = mysqli_query($conex,$strqryRE);
						$RE = mysqli_num_rows($qryRE); // Numero de resultados
						//Retorna una fila de Materias INNER JOIN Maestros INNER JOIN Peronas dependiendo de la materia dada
						$strqryMat = "SELECT * FROM Horario_Alumno WHERE nombreMat = '".$row->nombreMat."'";
						$qryMat = mysqli_query($conex,$strqryMat);
						//$Mat = mysqli_num_rows($qryMat); // Numero de resultados
						$rowMat = mysqli_fetch_object($qryMat); // Fila con resultados obtenidos
						if($AP>0){
							print" ";
						}else{
							if($RE>0){
								//-----------------------------------------------------------------------
								if($sum<=50){
									$sum+=$row->creditos;
									print"<tr id=\"$val\"><td>$rowMat->creditos</td><td>$rowMat->idMateria</td><td>$row->nombreMat</td>
									<td>$hIni:00 - $hFin:00</td><td>$hIni:00 - $hFin:00</td><td>$hIni:00 - $hFin:00</td>
									<td>$hIni:00 - $hFin:00</td><td>$hIni:00 - $hFin:00</td>
									<td colspan=2>$rowMat->nombrePro $rowMat->apPat $rowMat->apMat</td></tr>";
									$datos = $datos."['".$rowMat->creditos."','".$rowMat->idMateria."','".$row->nombreMat."','".$hIni.":00-".$hFin.":00','".$hIni.":00-".$hFin.":00','".$hIni.":00-".$hFin.":00','".$hIni.":00-".$hFin.":00','".$hIni.":00-".$hFin.":00','".$rowMat->nombrePro." ".$rowMat->apPat." ".$rowMat->apMat."'],";
									$hIni++;
									$hFin++;
								}
								//-----------------------------------------------------------------------
							}else{
								//-----------------------------------------------------------------------
								if($sum<=50){
									$sum+=$row->creditos;
									print"<tr id=\"$val\"><td>$rowMat->creditos</td><td>$rowMat->idMateria</td><td>$row->nombreMat</td>
									<td>$hIni:00 - $hFin:00</td><td>$hIni:00 - $hFin:00</td><td>$hIni:00 - $hFin:00</td>
									<td>$hIni:00 - $hFin:00</td><td>$hIni:00 - $hFin:00</td>
									<td colspan=2>$rowMat->nombrePro $rowMat->apPat $rowMat->apMat</td></tr>";
									$datos = $datos."['".$rowMat->creditos."','".$rowMat->idMateria."','".$row->nombreMat."','".$hIni.":00-".$hFin.":00','".$hIni.":00-".$hFin.":00','".$hIni.":00-".$hFin.":00','".$hIni.":00-".$hFin.":00','".$hIni.":00-".$hFin.":00','".$rowMat->nombrePro." ".$rowMat->apPat." ".$rowMat->apMat."'],";
									$hIni++;
									$hFin++;
								}
								//-----------------------------------------------------------------------
							}
						}
					}
					$r++;
				}
			}
			//--------------------CAPTURA DE PANTALLA-------------------------------------
			if(isset($_POST['submitt'])&&empty($_POST['reenvia'])){
				$im = imagegrabscreen();
				imagepng($im, "Mensajes/Horario".$_SESSION['usuario'].".png");
				imagedestroy($im);
			}
			//----------------------------------------------------------------------------
		if(isset($_POST['submitt'])){
?>
			<input class="btn btn-outline-danger text-center" name="submitt" id="Mostaza" type="submit" value="Enviar documentos">
		</form>
<?php
        }else{
?>
            <!--
			<script>
                var pdf = new jsPDF();
                pdf.text(20,20,"Mostrando una Tabla con JsPDF");
                var columns = ["Id", "Nombre", "Email", "Pais"];
                var data = [
                    ['1', 'Carlos', '009@gmail.com', 'Mexico'],
                    [2, "Miguel",  "888@hotmail.com", "Brasil"],
                    [3, "Jorge", "jorge@yandex.com", "Ecuador"],
                    [3, "mario", "mario@yandex.com", "Colombia"],
                ];
                pdf.autoTable(columns,data,{ margin:{ top: 25  }});
                pdf.save("../HorarioMiTabla.pdf");
			</script>
            -->
            <script>
				var pdf = new jsPDF();
				pdf.text(20,20,"Horario alumno: <?php print $rowP->nombre." ".$rowP->apPat." ".$rowP->apMat; ?>");
				var columns = ["C\nR\nE\nD.","C.\nM.","NOMBRE DE LA MATERIA","LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","CATEDRATICO"];
				//var data = [<php echo json_encode($datos);?>]; para letra por letra
				var data = [<?php print preg_replace( "/\r|\n/", "",$datos);?>];
				//document.write(data);
				pdf.autoTable(columns,data,{
					margin:{ left:3 }, 
					theme:'grid', 
					styles:{overflow:'linebreak'}, 
					startY:25,
					columnStyles:{
						0: {columnWidth: 8},
						1: {columnWidth: 8},
						2: {columnWidth: 33},
						3: {columnWidth: 23},
						4: {columnWidth: 23},
						5: {columnWidth: 25},
						6: {columnWidth: 23},
						7: {columnWidth: 23},
						8: {columnWidth: 38}
					}
				});
				pdf.save("<?php print "Horario".$_SESSION['usuario'];?>.pdf");
			</script>
            <input class="btn btn-outline-danger text-center" name="submitt" id="Mostaza" type="submit" value="Enviar a Tutor">
		</form>
<?php
        }
?>
		</table>
        </br>
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