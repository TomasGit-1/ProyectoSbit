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
<title>Alum_Tramites</title>
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
		//Retorna el idMaestro del administrador -------------------------------------------------------------------
		$strqryMtr = "SELECT m.idMaestro,p.nombre,p.apPat,p.apMat  FROM Usuarios u INNER JOIN Personas p ON u.idUsuario = p.idUsuario INNER JOIN Maestros m ON p.idPersona = m.idPersona WHERE u.nivel = 1;";
		$qryMtr = mysqli_query($conex,$strqryMtr);
		$rowMtr = mysqli_fetch_object($qryMtr);
		$i = mysqli_num_rows($qryMtr);
		$r=0;
?>
		<form action="Alumnos.php" method="POST">
			<input class="btn btn-outline-danger text-center" id="Mostaza" type="submit" value="Volver">
		</form>
<?php
		if(isset($_POST['submit'])){
			//Retorna la matricula dependiendo del usuario introducido--------------------------------------------------
			$strqryMatri = "SELECT al.matricula FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
			INNER JOIN Alumnos al ON pe.idPersona = al.idPersona WHERE us.usuario = '".$_SESSION['usuario']."';";
			$qryMatri = mysqli_query($conex,$strqryMatri);
			$rowMatri = mysqli_fetch_object($qryMatri);
			//----------------------------------------------------------------------------------------------------------
			if(isset($_POST['idMaestro'])&&!empty($_POST['msgTexto'])){ //&&isset($_POST['tipo'])
				if(($_POST['idMaestro'])==$rowMtr->idMaestro){
					$strqry = "INSERT INTO Mensajes(idMaestro,matricula,tipo,enviado,msgTexto,fecha) 
					values('".$_POST['idMaestro']."',".$rowMatri->matricula.",'1','E2',
					'".$_POST['msgTexto']."',(SELECT CURDATE()));";
					$qry = mysqli_query($conex,$strqry);
				}else{
					$strqry = "INSERT INTO Mensajes(idMaestro,matricula,tipo,enviado,msgTexto,fecha) 
					values('".$_POST['idMaestro']."',".$rowMatri->matricula.",'2','E2',
					'".$_POST['msgTexto']."',(SELECT CURDATE()));";
					$qry = mysqli_query($conex,$strqry);
				}
?>
				<script language="javascript">
                    location.href="Alumnos.php";
                </script>
<?php
			}else{
?>
				<script language="javascript">
					alert('Su mensaje no pudo ser enviado, vuelva a intentar');
	                location.href="Alum_Tramites.php";
	            </script>
<?php
			}
		}else{
?>
            <h1 align="center" id="Amarillo">Tramites</h1>
            <form action="Alum_Tramites.php" method="POST">
                <b><i id="Amarillo">Eviar a:</i></b>
                <div class="input-group mb-3" style="background:#663333;">
                	<div class="input-group-prepend">
				    	<label class="input-group-text" for="idMaestro">Administradores</label>
				    </div>
	                <select class="custom-select col-md-5" name="idMaestro">";
<?php
					while($r<$i){
						mysqli_data_seek($qryMtr,$r); //mueve el puntero a la fila especificada
						$row = mysqli_fetch_object($qryMtr); //obtiene los datos como un objeto
						print"<option value=\"$row->idMaestro\">".$row->nombre." ".$row->apPat." ".$row->apMat."</option>";
						$r++;
					}
?>
	                </select><br />
	            </div>
                <b><i id="Amarillo">Tramite a solicitar:</i></b>
                <select class="custom-select col-md-3" name="msgTexto">
                    <option value="Solicitud comprobante de estudios <?php print $_SESSION['usuario'];?>">Comprobante de estudios</option>
                    <option value="Solicitud constancias <?php print $_SESSION['usuario'];?>">Constancias</option>
                    <option value="Solicitud certificado <?php print $_SESSION['usuario'];?>">Certificado</option>
                    <option value="Solicitud examen titulacion <?php print $_SESSION['usuario'];?>">Examen titulacion</option>
                    <option value="Solicitud correccion de datos <?php print $_SESSION['usuario'];?>">Correccion de datos</option>
                </select><br />
                <input class="btn btn-outline-danger text-center" name="submit" id="Mostaza" type="submit" value="Enviar Solicitud"><br />
            </form>
<?php
		}
?>
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