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
<title>Alum_Mensajes</title>
	<link rel="stylesheet" type="text/css" href="Alum_Style.css"/>
	<script type="text/javascript" src="Alum_JavaScript.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
	<!--<script src="../js/bootstrap.min.js"></script>-->
</head>

<body> <!--background:#A00;-->
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
		$strqryMatri = "SELECT al.matricula FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
		INNER JOIN Alumnos al ON pe.idPersona = al.idPersona WHERE us.usuario = '".$_SESSION['usuario']."';";
		$qryMatri = mysqli_query($conex,$strqryMatri);
		$rowMatri = mysqli_fetch_object($qryMatri);
		//----------------------------------------------------------------------------------------------------------
		$strqry = "SELECT * FROM Mensaje_Alumno WHERE matricula = ".$rowMatri->matricula.";";
		$qry = mysqli_query($conex,$strqry);
		$i = mysqli_num_rows($qry);
		$r=0;
?>
		<form action="Alumnos.php" method="POST">
			<input id="Mostaza" type="submit" value="Volver">
		</form>
<?php 	if(isset($_POST['op1'])){
			print"<h1>Todos sus mensajes</h1>";
		}else{
			if(isset($_POST['op2'])){
				print"<h1>Mensajes enviados</h1>";
			}else{
				if(isset($_POST['op3'])){
					print"<h1>Mensajes recibidos</h1>";
				}else{
					if(isset($_POST['op4'])){
						print"<h1>Mensajes Tutor</h1>";
					}
				}
			}
		}
?>
        <form action="Alum_Mensajes.php" method="POST">
        
        <nav class="navbar  navbar navbar-expand-lg navbar-dark "> <!-- bg-dark-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <!--<a class="nav-item nav-link active" href="#">Todos<span class="sr-only">(current)</span></a>-->
                    <input name="op5" type="submit" value="Nuevo(+)">
                    <input name="op1" type="submit" value="Todos">
                    <!--<a class="nav-item nav-link" href="#">Enviados</a>-->
                    <input name="op2" type="submit" value="Enviados">
                    <!--<a class="nav-item nav-link disabled" href="#">Enviados</a>-->
                    <input name="op3" type="submit" value="Recibidos">
                    <input name="op4" type="submit" value="Tutor">
                </div>
            </div>
        </nav>
        </form>
        
        <form action="Alum_VerMsg.php" method="POST">
        <input name="numMsg" <?php print"value='$i'";?> type="hidden">
        <table class="table table-bordered table-hover">
<?php
        while($r<$i){
            mysqli_data_seek($qry,$r); //mueve el puntero a la fila especificada
            $row = mysqli_fetch_object($qry);
            $msg = "E";
			if("E" == $row->enviado){
				$msg = "PorCursar";
			}else{
				$msg = "Aprobada";
			}
			print"<tr id=\"$msg\">";
			if(isset($_POST['op1'])||(empty($_POST['op1'])&&empty($_POST['op2'])&&empty($_POST['op3'])&&empty($_POST['op4'])&&empty($_POST['op5']))){
                //print"<td>$row->nombre $row->apPat $row->apMat($row->correo) - [$row->fecha] - $row->msgTexto</td>";
				print"<td><input name=\"$row->idMsg\" style=\"background-color: transparent; width:95%; height:25px\" 
				type=\"submit\" value=\"$row->nombre $row->apPat $row->apMat($row->correo) - [$row->fecha] - $row->msgTexto\"></td>";
			}else{
				if(isset($_POST['op2'])&&(($row->enviado)=='E')){
					//print"<td>$row->nombre $row->apPat $row->apMat($row->correo) - [$row->fecha] - $row->msgTexto</td>";
					print"<td><input name=\"$row->idMsg\" style=\"background-color: transparent; width:95%; height:25px\" 
					type=\"submit\" value=\"$row->nombre $row->apPat $row->apMat($row->correo) - [$row->fecha] - $row->msgTexto\"></td>";
				}else{
					if(isset($_POST['op3'])&&(($row->enviado)=='R')){
						//print"<td>$row->nombre $row->apPat $row->apMat($row->correo) - [$row->fecha] - $row->msgTexto</td>";
						print"<td><input name=\"$row->idMsg\" style=\"background-color: transparent; width:95%; height:25px\" 
						type=\"submit\" value=\"$row->nombre $row->apPat $row->apMat($row->correo) - [$row->fecha] - $row->msgTexto\"></td>";
					}else{
						if(isset($_POST['op4'])&&(($row->tipo)==1)){
							//print"<td>$row->nombre $row->apPat $row->apMat($row->correo) - [$row->fecha] - $row->msgTexto</td>";
							print"<td><input name=\"$row->idMsg\" style=\"background-color: transparent; width:95%; height:25px\" 
							type=\"submit\" value=\"$row->nombre $row->apPat $row->apMat($row->correo) - [$row->fecha] - $row->msgTexto\"></td>";
						}else{
							if(isset($_POST['op5'])){
								?>
								<script language="javascript">
									location.href="Alum_MsgNuevo.php";
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