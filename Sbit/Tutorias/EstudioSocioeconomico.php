<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" type="text/css" href="Mensaje/librerias/bootstrap-3.3.7-dist/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="Mensaje/librerias/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" />
<script type="text/javascript" src="Mensaje/librerias/jquery-2.1.3.min.js"></script>
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
		$id = "select u.usuario AS pre_has from usuarios u 
		inner join personas p on p.idUsuario=u.idUsuario
		inner join alumnos a on p.idPersona=a.idPersona
		inner join estudiosocioeconomico es on a.matricula=es.matricula 
		where u.usuario='".$_SESSION['usuario']."'";
		 $result = mysqli_query($link, $id);
		 $row = mysqli_fetch_assoc($result);
		 $pre_has= $row['pre_has'];?>
<form class="form-inline" role="form">
<FORM ACTION="dos.php" METHOD="POST" class="">
	<body style="background-color:#663333;">
	<center><div class="container" style="background-color:#F1c40f" >
		<div class="row">
			<div class="col" style="background-color:#663322">
					<img src="imgenes\uabjo.png"/>
					<h2>Estudio socio-economico</h2><br>
			</div>
		</div>
        <?php if($pre_has==$_SESSION['usuario']){?>
			<div class="row">
				<div class="col"  style="background-color:#F1c40f">
					<div class="col">
						<div align="center">
								<div class="form-group">
                                <h2>Usted ya esta registrado</h2><br>
								</div>
						</div>
					</div>
				</div>
			</div>
			<?php }else{ ?>
			<div class="row">
				<div class="col"  style="background-color:#F1c40f">
					<div class="col">
						<div align="center">
								<div class="form-group">
										<h3>1. Estado civil</h3>
									<h4>Estado civil</h4>
									<INPUT TYPE="radio" NAME="es" VALUE="casad@">Casado(a)
								<INPUT TYPE="radio" NAME="es" VALUE="solter@">Soltero(a)
										<INPUT TYPE="radio" NAME="es" VALUE="separad@">Separado(a)
										<INPUT TYPE="radio" NAME="es" VALUE="divorciad@">Divorciado
										<INPUT TYPE="radio" NAME="es" VALUE="union libre">Unios libre
										<br>
									 </div>
									 <h3>2. ANTECEDENTES DE EDUCACIÓN MEDIA SUPERIOR</h3>
									 <div class="form-group">
										<h4>¿En qué tipo de institución	concluiste la educación media superior?</h4>
								<INPUT TYPE="radio" NAME="institucion" VALUE="Publica">Pública
										<INPUT TYPE="radio" NAME="institucion" VALUE="Privada">Privada
										<br>
											</div>
									 <div class="form-group">
										<h4>¿Cuánto	tiempo hace	que	terminaste la educación media superior?</h4>
								<INPUT TYPE="radio" NAME="tiempo" VALUE="Menos de 1 ano">Menos de 1 año
										<INPUT TYPE="radio" NAME="tiempo" VALUE="De 1 a menos de 2 anos">De 1 a menos de 2 años
											<INPUT TYPE="radio" NAME="tiempo" VALUE="De 2 a menos de 3 anos">De 2 a menos de 3 años
										<INPUT TYPE="radio" NAME="tiempo" VALUE="Más de 3 anos">Más de 3 años
										<br>
											</div>
									 <div class="form-group">
											<h4>Entidad federativa donde concluiste la educación media	superior:</h4>
								<select name="Estados" size="1">
								<option value="Aguascalientes">Aguascalientes</option>
								<option value="Baja California">Baja California </option>
								<option value="Baja California Sur">Baja California Sur </option>
								<option value="Campeche">Campeche </option>
								<option value="Chiapas">Chiapas </option>
								<option value="Chihuahua">Chihuahua </option>
								<option value="Coahuila ">Coahuila </option>
								<option value="Colima">Colima </option>
								<option value="Distrito Federal">Distrito Federal</option>
								<option value="Durango">Durango </option>
								<option value="Estado de México">Estado de México </option>
								<option value="Guanajuato">Guanajuato </option>
								<option value="Guerrero">Guerrero </option>
								<option value="Hidalgo">Hidalgo </option>
								<option value="Jalisco">Jalisco </option>
								<option value="Michoacan">Michoacán </option>
								<option value="Morelos">Morelos </option>
								<option value="Nayarit">Nayarit </option>
								<option value="Nuevo Leon">Nuevo León </option>
								<option value="Oaxaca ">Oaxaca </option>
								<option value="Puebla">Puebla </option>
								<option value="Queretaro">Querétaro </option>
								<option value="Quintana Roo">Quintana Roo </option>
								<option value="San Luis Potosi">San Luis Potosí </option>
								<option value="Sinaloa">Sinaloa </option>
								<option value="Sonora">Sonora </option>
								<option value="Tabasco">Tabasco </option>
								<option value="Tamaulipas">Tamaulipas </option>
								<option value="Tlaxcala">Tlaxcala </option>
								<option value="Veracruz">Veracruz </option>
								<option value="Yucatan">Yucatán </option>
								<option value="Zacatecas">Zacatecas</option>
								</select>
									 </div>
									 <h3>3. DATOS SOCIOECONÓMICOS, CARACTERÍSTICAS DE LA VIVIENDA</h3>
									 <div class="form-group">
										<h4>La vivienda que habitas es:?</h4>
								<INPUT TYPE="radio" NAME="vivienda" VALUE="Propia">Propia
											<INPUT TYPE="radio" NAME="vivienda" VALUE="Rentada">Rentada
											<INPUT TYPE="radio" NAME="vivienda" VALUE="Prestada">Prestada
											<INPUT TYPE="radio" NAME="vivienda" VALUE="Otra">Otra
											</div>
											<div class="form-group">
											<h4>¿Cuántas personas habitan normalmente esta vivienda?</h4>
								<INPUT TYPE="radio" NAME="habitantes" VALUE="Una persona">Una persona
											<INPUT TYPE="radio" NAME="habitantes" VALUE="Dos personas">Dos personas
											<INPUT TYPE="radio" NAME="habitantes" VALUE="Tres personas">Tres personas
											<INPUT TYPE="radio" NAME="habitantes" VALUE="Cuatro	personas">Cuatro personas
											<INPUT TYPE="radio" NAME="habitantes" VALUE=" Más de seis personas">Más de seis personas
											</div>
											<div class="form-group">
											<h4>¿Qué número de	cuartos	se usan	para dormir? (Sin contar pasillos)</h4>
								<INPUT TYPE="radio" NAME="habitaciones" VALUE="1">1
											<INPUT TYPE="radio" NAME="habitaciones" VALUE="De 2 a 4">De 2 a 4
											<INPUT TYPE="radio" NAME="habitaciones" VALUE="De 5 a 7">De 5 a 7
											<INPUT TYPE="radio" NAME="habitaciones" VALUE="De 8 a 10">De 8 a 10
									 </div>
									 <h3>4. SITUACIÓN LABORAL PERSONAL</h3>
									 <div class="form-group">
										<h4>¿Trabajas actualmente?</h4>
								<INPUT TYPE="radio" NAME="Trabajas" VALUE="Si">Si
											<INPUT TYPE="radio" NAME="Trabajas" VALUE="No">No
											<h4>¿El trabajo que realizas tiene relación directa con la carrera que deseas estudiar?</h4>
											</div>
											<div class="form-group">
								<INPUT TYPE="radio" NAME="Trabajo-relacion" VALUE="Si">Si
											<INPUT TYPE="radio" NAME="Trabajo-relacion" VALUE="No">No
									 </div>
									 <h3>5. Transporte</h3>
									 <div class="form-group">
										<h4>¿Cuál es el medio de transporte que utilizas con mayor frecuencia?</h4>
								<INPUT TYPE="radio" NAME="Transporte" VALUE="Automóvil propio">Automóvil propio
											<INPUT TYPE="radio" NAME="Transporte" VALUE="Metro, pesero, camión">Metro, pesero, camión
											<INPUT TYPE="radio" NAME="Transporte" VALUE="Motocicleta">Motocicleta
											<INPUT TYPE="radio" NAME="Transporte" VALUE="Otro">Otro
									 </div>
					</div>
				</div>
				<div class="col"  style="background-color:#F1c40f">
					<div class="col">
					 <INPUT TYPE="submit" VALUE="aceptar">
					</div>
				</div>
			</div>

	</div>
    <?php }
	} ?>



<body>
</body>
</html>
