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
    <link rel="shortcut icon" href="SBIT.png" type="image/png">
<title>SBIT/VER MENSAJES</title>
	<link rel="stylesheet" type="text/css" href="Alum_Style.css"/>
	<script type="text/javascript" src="Alum_JavaScript.js"></script>
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
?>

<?php
		if(!empty($_POST['numMsg'])){
			//Retorna la matricula dependiendo del usuario introducido--------------------------------------------------
			$strqryMatri =  "SELECT ms.idMaestro FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
			INNER JOIN Maestros ms  ON pe.idPersona = ms.idPersona WHERE us.usuario = '".$_SESSION['usuario']."';";
			$qryMatri = mysqli_query($conex,$strqryMatri);
			$rowMatri = mysqli_fetch_object($qryMatri);
			//----------------------------------------------------------------------------------------------------------
			$strqry = "SELECT per.nombre,per.apPat,per.apMat,per.correo,msg.idMsg,msg.msgTexto,
			msg.msgArchivo,msg.tipo,msg.fecha,msg.idMaestro,msg.matricula,msg.enviado
			FROM Mensajes msg 
			INNER JOIN Alumnos al ON msg.matricula = al.matricula
			INNER JOIN Personas per ON al.idPersona = per.idPersona WHERE idMaestro = ".$rowMatri->idMaestro.";";
			$qry = mysqli_query($conex,$strqry);
			$i = mysqli_num_rows($qry);
			$r=0;
			//----------------------------------------------------------------------------------------------------------
			while($r<$i){
				mysqli_data_seek($qry,$r); //mueve el puntero a la fila especificada
				$row = mysqli_fetch_object($qry);
				$id = $row->idMsg;
				if(isset($_POST[$id])){
					if(("E2" == $row->enviado)||("R1" == $row->enviado)){

?>
                        					<h1 align="center">Ver Mensaje</h1>
					<br>
					<br>
					<br>
					<div class="container">
                        <b><font face="Georgia" size="5" >De:</font></b>
                        <input name="idMaestro"  class="form-control" type="text" <?php print"value='$row->nombre $row->apPat $row->apMat($row->correo)'";?>><br />
                    </div>    
<?php

					}
					?>

					<div class="container">
						<b><font face="Georgia" size="5" >Tipo de mensaje:</font></b>
					<?php
					if(($row->tipo)==1){
						?>
						<input class="form-control"  name="tipo" type="text" value="Mensaje de tutor"><br />
                        <?php
					}else{
						?>
						<input name="tipo" type="text" value="Otro"><br />
                        <?php
					}
					?>
						<b><font face="Georgia" size="5" >Asunto:</font></b><br />
                    	<!--<input name="msgTexto" type="text" size="80" maxlength="500" <?php print"value='$row->msgTexto'";?>><br />-->
                        <textarea  class="form-control"  id="message" class="input" name="msgTexto" rows="5" cols="60" maxlength="500"><?php print $row->msgTexto;?></textarea><br />
                    </div>
					<?php
					if(!empty($row->msgArchivo)){
?>
                        <b><i>Archivo:</i></b><br />
                        <?php
						$info = new SplFileInfo($row->msgArchivo);
						if(($info->getExtension())=='png'||($info->getExtension())=='jpg'){
							?>
                            	<img src=<?php print"'../Alumnos/Mensajes/".$row->msgArchivo."'";?> style="width:600px"><br />
                            <?php
						}else{
							if($info->getExtension()=='pdf'){
								?>
                                    <embed src=<?php print"'../Alumnos/Mensajes/".$row->msgArchivo."'";?> type="application/pdf" width="800" height="600"></embed>
								<?php
							}else{
								if($info->getExtension()=='pptx'){
									?>
										<iframe src="http://docs.google.com/viewer?url=http%3A%2F%2Fmeridadesign.com%2Fdemos%2Fquotes.ppsx&embedded=true" width="600" height="300" style="border: none;"></iframe>
									<?php
								}
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



		<form action="MensajesA.php" method="POST">
			<input id="Mostaza" class="btn btn-warning"type="submit" value="Regresar">
		</form>





</body>
</html>