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
<title>Alum_MsgNuevo</title>
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
		//Retorna todos los Maestros INNER JOIN Personas-------------------------------------------------------
		$strqryMtr = "SELECT * FROM Maestros m INNER JOIN Personas p ON m.idPersona = p.idPersona;";
		$qryMtr = mysqli_query($conex,$strqryMtr);
		$rowMtr = mysqli_fetch_object($qryMtr);
		$i = mysqli_num_rows($qryMtr);
		$r=0;
?>
		<form action="Alum_Mensajes.php" method="POST">
			<input class="btn btn-outline-danger text-center" id="Mostaza" type="submit" value="Volver">
		</form>
<?php
		if(isset($_POST['submit'])){
			//Retorna la matricula dependiendo del usuario introducido--------------------------------------------------
			$strqryMatri = "SELECT al.matricula FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
			INNER JOIN Alumnos al ON pe.idPersona = al.idPersona WHERE us.usuario = '".$_SESSION['usuario']."';";
			$qryMatri = mysqli_query($conex,$strqryMatri);
			$rowMatri = mysqli_fetch_object($qryMatri);
			//Retorna el idMaestro dependiendo de la matricula introducida----------------------------------------------
			$strqryMtr = "SELECT idMaestro FROM Tutorias WHERE matricula = '".$rowMatri->matricula."';";
			$qryMtr = mysqli_query($conex,$strqryMtr);
			$rowMtr = mysqli_fetch_object($qryMtr);
			//----------------------------------------------------------------------------------------------------------
			if(isset($_POST['idMaestro'])&&!empty($_POST['msgTexto'])&&!empty($_POST['msgArchivo'])){ //&&isset($_POST['tipo'])
				if(($_POST['idMaestro'])==$rowMtr->idMaestro){
					$strqry = "INSERT INTO Mensajes(idMaestro,matricula,tipo,enviado,msgTexto,msgArchivo,fecha) 
					values('".$_POST['idMaestro']."',".$rowMatri->matricula.",'1','E2',
					'".$_POST['msgTexto']."','".$_POST['msgArchivo']."',(SELECT CURDATE()));";
					$qry = mysqli_query($conex,$strqry);
				}else{
					$strqry = "INSERT INTO Mensajes(idMaestro,matricula,tipo,enviado,msgTexto,msgArchivo,fecha) 
					values('".$_POST['idMaestro']."',".$rowMatri->matricula.",'2','E2',
					'".$_POST['msgTexto']."','".$_POST['msgArchivo']."',(SELECT CURDATE()));";
					$qry = mysqli_query($conex,$strqry);
				}
?>
				<script language="javascript">
                    location.href="Alum_Mensajes.php";
                </script>
<?php
			}else{
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
                        location.href="Alum_Mensajes.php";
                    </script>
<?php
			//$row = mysqli_fetch_object($qry);
				}
				?>
				<script language="javascript">
					alert('Su mensaje no pudo ser enviado, vuelva a intentar');
                    location.href="Alum_Mensajes.php";
                </script>
<?php
			}
		}else{
?>
            <h1 align="center" id="Amarillo">Mensaje nuevo</h1>
            <form action="Alum_MsgNuevo.php" method="POST">
                <b><i id="Amarillo">Eviar a:</i></b>
                <select class="custom-select col-md-4" name="idMaestro">";
<?php
				while($r<$i){
					mysqli_data_seek($qryMtr,$r); //mueve el puntero a la fila especificada
					$row = mysqli_fetch_object($qryMtr); //obtiene los datos como un objeto
					print"<option value=\"$row->idMaestro\">".$row->nombre." ".$row->apPat." ".$row->apMat."</option>";
					$r++;
				}
?>
                </select><br />
                <!--
                <b><i>Tipo de mensaje:</i></b>
                <select name="tipo">
                    <option value="2">Otro</option>
                    <option value="1">Mensaje a Tutor</option>
                </select><br />
                -->
                <b><i id="Amarillo">Asunto:</i></b><br />
                <!--<input name="msgTexto" type="text" size="80" maxlength="500"><br />-->
                <textarea id="message"  class="input form-control col-md-6" name="msgTexto" rows="5" maxlength="500"></textarea><br />
                <b><i id="Amarillo">Archivo:</i></b>
                <input class="btn btn-outline-secondary" name="msgArchivo" type="file"><br />
                <input class="btn btn-outline-danger text-center" name="submit" id="Mostaza" type="submit" value="Enviar mensaje"><br />
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