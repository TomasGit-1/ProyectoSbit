<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="Alum_Style.css"/>
<title>Documento sin título</title>
</head>
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
<center><body style="background-color:#663333;">
<div class="container" style="background-color:#F1c40f" >
<div class="row">
	<div class="col" style="background-color:#663322">
			<img src="imgenes\uabjo.png"/>
	</div>
</div>
	<div class="row">
		<div class="col"  style="background-color:#F1c40f">
			<div class="col">
				<b><i>Plan de estudios.</i></b></br>
		        <table>
					<tr>
						<td>Aprobada.</td><td id="Aprobada">Materia</td>
					</tr>
		            <tr>
						<td>Reprobada.</td><td id="Reprobada">Materia</td>
					</tr>
		            <tr>
						<td>Por Cursar.</td><td id="PorCursar">Materia</td>
					</tr>
				</table>
			</div>
		</div>
	</div
	<div class="row">
		<div class="col"  style="background-color:#F1c40f">
			<div class="col">
				<?php
				        if(isset($_POST['submit'])){
							print"<b><i>Puedes cursar las materias:</i></b></br>";
				?>
				<?php
				        }else{
				?>
				            <table class="table-bordered table-dark">
				                <center><h1>Mapa curricular</h1>
				            <form action="Alum_Reinscripcion.php" name="datos" method="POST">
				<?php
						}
							$sum = 0;
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
											print"<td id=\"Aprobada\">$row->nombreMat</br>$row->creditos Creditos.</td>";
										}else{
											if($RE>0){
												if(isset($_POST['submit'])){
													if($sum<=50){
														print"<p id=\"Rojo\">".$row->nombreMat." con: ".$row->creditos." creditos</p>";
														$sum+=$row->creditos;
													}
												}
												print"<td id=\"Reprobada\">$row->nombreMat</br>$row->creditos Creditos.</td>";
											}else{
												if(isset($_POST['submit'])){
													if($sum<=50){
														print"<p id=\"Rojo\">".$row->nombreMat." con: ".$row->creditos." creditos</p>";
														$sum+=$row->creditos;
													}
												}
												print"<td id=\"PorCursar\">$row->nombreMat</br>$row->creditos Creditos.</td>";
											}
										}
									}
									$r++;
								}
								print"</tr>";
							}
				?>
			</div>
		</div>
	</div>
</div>
</body>

<?php
	}
?>
<body>
</body>
</html>
