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
<title>Alum_VerMsg</title>
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
?>
		<form action="Alum_Mensajes.php" method="POST">
			<input id="Mostaza" type="submit" value="Volver">
		</form>
<?php
		if(!empty($_POST['numMsg'])){
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
			//----------------------------------------------------------------------------------------------------------
			while($r<$i){
				mysqli_data_seek($qry,$r); //mueve el puntero a la fila especificada
				$row = mysqli_fetch_object($qry);
				$id = $row->idMsg;
				if(isset($_POST[$id])){
					if(($row->enviado)=='R'){
?>
                        <b><i>De:</i></b>
                        <input name="idMaestro" type="text" <?php print"value='$row->nombre $row->apPat $row->apMat($row->correo)'";?>><br />
<?php
					}
					?>
						<b><i>Tipo de mensaje:</i></b>
					<?php
					if(($row->tipo)==1){
						?>
						<input name="tipo" type="text" value="Mensaje de tutor"><br />
                        <?php
					}else{
						?>
						<input name="tipo" type="text" value="Otro"><br />
                        <?php
					}
					?>
						<b><i>Asunto:</i></b>
                    	<input name="msgTexto" type="text" size="80" maxlength="500" <?php print"value='$row->msgTexto'";?>><br />
					<?php
					if(!empty($row->msgArchivo)){
?>
                        <b><i>Archivo:</i></b><br />
                        <?php
						$info = new SplFileInfo($row->msgArchivo);
						if(($info->getExtension())=='png'||($info->getExtension())=='jpg'){
							?>
                            	<img src=<?php print"'horarios/".$row->msgArchivo."'";?> style="width:600px"><br />
                            <?php
						}else{
							if($info->getExtension()=='pdf'){
								?>
                                    <embed src=<?php print"'horarios/".$row->msgArchivo."'";?> type="application/pdf" width="800" height="600"></embed>
								<?php
							}
						}
						?>
<?php						
					}
				}
				$r++;
			}
			//----------------------------------------------------------------------------------------------------------
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