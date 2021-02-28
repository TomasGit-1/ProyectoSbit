<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="Alum_Style.css"/>
	<script type="text/javascript" src="Alum_JavaScript.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
<title>Alum_Solicitud</title>
</head>

<body style="background-color:#663333"> <!--background:#A00;-->
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
		//--------------------------------------------------------------------------------------------------------------
		$f1;
		$f2;
		$f3;
		if(!empty($_POST['doc1'])&&!empty($_POST['doc2'])&&!empty($_POST['doc3'])){
			$f1 = new SplFileInfo($_POST['doc1']);
			$f2 = new SplFileInfo($_POST['doc2']);
			$f3 = new SplFileInfo($_POST['doc3']);
		}
		//--------------------------------------------------------------------------------------------------------------
		if((!empty($_POST['doc1'])&&!empty($_POST['doc2'])&&!empty($_POST['doc3']))&&((($f1->getExtension())=='pdf')&&(($f2->getExtension())=='pdf')&&(($f3->getExtension())=='pdf'))){
			//Mover el horario.pdf a C:\xampp\htdocs\PHP\Login\Alumnos\Horarios-----------------------------------------
			/*$archivo_name = $_POST['doc1'];
			$extension = explode(".",$archivo_name);
			$num = count($extension)-1;
			if($extension[$num] == "png"){
				if(!copy("uabjo.png","Documentos/hola.png")){
					echo "error al copiar el archivo";
				}else{
					echo "archivo subido con exito";
				}
			}else{
				echo "el formato de archivo no es valido, solo .zip";
			}*/
			//----------------------------------------------------------------------------------------------------------
			//Actualiza los archivos del alumno con matricula introducida-----------------------------------------------
			$strqry = "UPDATE Alumnos set solicitud = '".$_POST['doc1']."',pagoServi = '".$_POST['doc2']."',
			ordenPago = '".$_POST['doc3']."' WHERE matricula = ".$rowMatri->matricula.";";
			$qry = mysqli_query($conex,$strqry);
			if($qry){
				print"<h1 id=\"Amarillo\">Los documentos se enviaron con exito!</br>Su solicitud de reinscripcion sera revisada por su Tutor</h1>";
?>
                <form action="Alumnos.php" method="POST">
                    <input class="btn btn-outline-danger text-center" id="Mostaza" type="submit" value="Volver">
                </form>
<?php
			}
		}else{
?>
			<div class="alert alert-warning" role="alert">
				<h4 class="alert-heading">Ocurrio un error!</h4>
				<p>Asegurese de cargar todos los documentos.</p>
				<hr>
				<p class="mb-0">Los documentos tienen que tener el formato PDF!</p>
			</div>
			<form action="Alum_Horario.php" method="POST">
            	<input name="reenvia" type="hidden" value="1">
                <input class="btn btn-outline-danger text-center" name="submitt" id="Mostaza" type="submit" value="Reintentar">
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