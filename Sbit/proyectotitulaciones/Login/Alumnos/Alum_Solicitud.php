<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--<meta name="viewport" content="width=device-width,inicial-scale=1"> -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet" media="screen"/> -->
<title>Alum_Solicitud</title>
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
		//Retorna la matricula dependiendo del usuario introducido--------------------------------------------------
		$strqryMatri = "SELECT al.matricula FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
		INNER JOIN Alumnos al ON pe.idPersona = al.idPersona WHERE us.usuario = '".$_SESSION['usuario']."';";
		$qryMatri = mysqli_query($conex,$strqryMatri);
		$rowMatri = mysqli_fetch_object($qryMatri);
		
		if(!empty($_POST['doc1'])&&!empty($_POST['doc2'])&&!empty($_POST['doc3'])){
			//Insertar horario.png en Mensajes--------------------------------------------------------------------------
			$strqryRE = "INSERT INTO Mensajes(idMaestro,matricula,tipo,enviado,msgTexto,msgArchivo,fecha) 
			values(4,".$rowMatri->matricula.",1,'E','Horario Reinscripcion','Horario".$_SESSION['usuario'].".png',(SELECT CURDATE()));";
			$qryRE = mysqli_query($conex,$strqryRE);
			//Actualiza los archivos del alumno con matricula introducida-----------------------------------------------
			$strqry = "UPDATE Alumnos set solicitud = '".$_POST['doc1']."',pagoServi = '".$_POST['doc2']."',
			ordenPago = '".$_POST['doc3']."' WHERE matricula = ".$rowMatri->matricula.";";
			$qry = mysqli_query($conex,$strqry);
			//$i = mysqli_num_rows($qry); // Numero de resultados DUDASDUDASDUDASDUDASDUDASDUDASDUDASDUDASDUDASDUDASDUDAS
			if($qry){
				print"<h1>Los documentos se enviaron con exito!</br>Su solicitud de reinscripcion sera revisada por su Tutor</h1>";
?>
                <form action="Alumnos.php" method="POST">
                    <input id="Mostaza" type="submit" value="Volver">
                </form>
<?php
			}
		}else{
?>
				<h1>Ocurrio un error, asegurese de cargar todos los documentos!</h1>
				<form action="Alum_Horario.php" method="POST">
                    <input name="submitt" id="Mostaza" type="submit" value="Reintentar">
                </form>
<?php
        }	
?>
        </br>
		<form action="Alum_Cerrar_Sesion.php" method="POST">
			<input id="Mostaza" type="submit" value="Cerrar Sesion">
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