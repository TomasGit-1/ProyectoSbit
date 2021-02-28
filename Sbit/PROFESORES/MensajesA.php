<?php
	session_start(); //Iniciamos la Sesion o la Continuamos
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--<meta name="viewport" content="width=device-width,inicial-scale=1"> -->
    <!-- <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen"/> -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen"/>
<title>SBIT/MENSAJES</title>
	<link rel="stylesheet" type="text/css" href="Alum_Style.css"/>
	<script type="text/javascript" src="Alum_JavaScript.js"></script>
	 <link rel="shortcut icon" href="SBIT.png" type="image/png">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
	<!--<script src="../js/bootstrap.min.js"></script>-->
</head>

<body background="f3.png"> <!--background:#A00;-->


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
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
		$strqryMatri = "SELECT ms.idMaestro FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
		INNER JOIN Maestros ms  ON pe.idPersona = ms.idPersona WHERE us.usuario = '".$_SESSION['usuario']."';";
		$qryMatri = mysqli_query($conex,$strqryMatri);
		$rowMatri = mysqli_fetch_object($qryMatri);
		//----------------------------------------------------------------------------------------------------------
		$strqry = "SELECT * FROM Mensaje_Alumno WHERE idMaestro= ".$rowMatri->idMaestro.";";
		$qry = mysqli_query($conex,$strqry);
		$i = mysqli_num_rows($qry);
		$r=0;
?>

<?php 	if(isset($_POST['op1'])){
			?><h1><p align="center">Todos sus Mensajes</p></h1>
		<?php
		}else{
			if(isset($_POST['op2'])){
				?><h1><p align="center">Mensajes Enviados</p></h1>
		<?php
			}else{
				if(isset($_POST['op3'])){
				?><h1><p align="center">Mensajes Recibidos</p></h1>
				<?php
				}else{
					if(isset($_POST['op4'])){
				?><h1><p align="center">Mensajes Tutor</p></h1>
				<?php
					}
				}
			}
		}
?>

<br>
<br>
<br>
        <form action="MensajesA.php" method="POST">
        <nav class="navbar  navbar navbar-expand-lg navbar-dark "> <!-- bg-dark-->
            <div class="navbar-nav" style="background:#663333;">
                <input name="op5" type="submit" value="Nuevo(+)" class="btn btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Envia un mensaje">
                <input name="op1" type="submit" value="Todos"  class="btn btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Todos los mensajes">
                <input name="op2" type="submit" value="Enviados" class="btn btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Mensajes enviados">
                <input name="op3" type="submit" value="Recibidos"  class="btn btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Mensajes recibidos">
                <input name="op4" type="submit" value="Tutor" class="btn btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Mesajes del tutor">
            </div>
        </nav>
        </form>

        
        <form action="VerMensaje.php" method="POST">
        <input name="numMsg" <?php print"value='$i'";?> type="hidden">
        <table class="table table-bordered table-hover">
<?php
        while($r<$i){
            mysqli_data_seek($qry,$r); //mueve el puntero a la fila especificada
            $row = mysqli_fetch_object($qry);
            $msg = "Y";
			if(("E1" == $row->enviado)||("R2" == $row->enviado)){
				$msg = "PorCursar";
			}else{
				$msg = "Aprobada";
			}
			print"<tr id=\"$msg\">";
			if(isset($_POST['op1'])||(empty($_POST['op1'])&&empty($_POST['op2'])&&empty($_POST['op3'])&&empty($_POST['op4'])&&empty($_POST['op5']))){
                //print"<td>$row->nombre $row->apPat $row->apMat($row->correo) - [$row->fecha] - $row->msgTexto</td>";
				$rest = substr($row->msgTexto, 0, 60);  
				print"<td><input name=\"$row->idMsg\" style=\"background-color: transparent; width:95%; height:25px\" 
				type=\"submit\" value=\"$row->nombre $row->apPat $row->apMat($row->correo) - [$row->fecha] - $rest\"></td>";
			}else{
				if(isset($_POST['op2'])&&(("E1"== $row->enviado)||("R2" == $row->enviado))){
					//print"<td>$row->nombre $row->apPat $row->apMat($row->correo) - [$row->fecha] - $row->msgTexto</td>";
					$rest = substr($row->msgTexto, 0, 60);  
					print"<td><input name=\"$row->idMsg\" style=\"background-color: transparent; width:95%; height:25px\" 
					type=\"submit\" value=\"$row->nombre $row->apPat $row->apMat($row->correo) - [$row->fecha] - $rest\"></td>";
				}else{
					if(isset($_POST['op3'])&&(("E2" == $row->enviado)||("R1" == $row->enviado))){
						//print"<td>$row->nombre $row->apPat $row->apMat($row->correo) - [$row->fecha] - $row->msgTexto</td>";
						$rest = substr($row->msgTexto, 0, 60);  
						print"<td><input name=\"$row->idMsg\" style=\"background-color: transparent; width:95%; height:25px\" 
						type=\"submit\" value=\"$row->nombre $row->apPat $row->apMat($row->correo) - [$row->fecha] - $rest\"></td>";
					}else{
						if(isset($_POST['op4'])&&(($row->tipo)==1)){
							//print"<td>$row->nombre $row->apPat $row->apMat($row->correo) - [$row->fecha] - $row->msgTexto</td>";
							$rest = substr($row->msgTexto, 0, 60);  
							print"<td><input name=\"$row->idMsg\" style=\"background-color: transparent; width:95%; height:25px\" 
							type=\"submit\" value=\"$row->nombre $row->apPat $row->apMat($row->correo) - [$row->fecha] - $rest\"></td>";
						}else{
							if(isset($_POST['op5'])){
								?>
								<script language="javascript">
									location.href="MensajeNuevo.php";
								</script>
                                <?php
							}
						}
					}
				}
			}
			print"</tr>";
            $r++;
        }
?>
		</table>
        </form>
        </br>
		
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
<br>
<br>
<br>
       <form action="Maestro.php">
         <input class="btn btn-warning" type="submit"  value="REGRESAR">
       </form>
</body>
</html>