<?php
	session_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--<meta name="viewport" content="width=device-width,inicial-scale=1"> -->
    <!-- <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen"/> -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen"/>
<title>SBIT/MENSAJE NUEVO</title>
	<link rel="stylesheet" type="text/css" href="Alum_Style.css"/>
	<script type="text/javascript" src="Alum_JavaScript.js"></script>
	 <link rel="shortcut icon" href="SBIT.png" type="image/png">
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
		//Retorna todos los LUMNOS INNER JOIN Personas-------------------------------------------------------
		$strqryMtr = "SELECT * FROM Alumnos al INNER JOIN Personas p ON al.idPersona = p.idPersona;";
		$qryMtr = mysqli_query($conex,$strqryMtr);
		$rowMtr = mysqli_fetch_object($qryMtr);
		$i = mysqli_num_rows($qryMtr);
		$r=0;
?>
		
<?php
		if(isset($_POST['submit'])){
			//Retorna la idMaestto dependiendo del usuario introducido--------------------------------------------------
			$strqryMatri =  "SELECT ms.idMaestro FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
		INNER JOIN Maestros ms  ON pe.idPersona = ms.idPersona WHERE us.usuario = '".$_SESSION['usuario']."';";
			$qryMatri = mysqli_query($conex,$strqryMatri);
			$rowMatri = mysqli_fetch_object($qryMatri);
			//Retorna la Matricula dependiendo del id maestro introducida----------------------------------------------
			$strqryMtr = "SELECT matricula FROM Tutorias WHERE idMaestro = '".$rowMatri->idMaestro."';";
			$qryMtr = mysqli_query($conex,$strqryMtr);
			$rowMtr = mysqli_fetch_object($qryMtr);
			//----------------------------------------------------------------------------------------------------------
			if(isset($_POST['matricula'])&&!empty($_POST['msgTexto'])&&!empty($_POST['msgArchivo'])){ //&&isset($_POST['tipo'])
				if(($_POST['matricula'])==$rowMtr->matricula){
					$strqry = "INSERT INTO Mensajes(matricula,idMaestro,tipo,enviado,msgTexto,msgArchivo,fecha) 
					values('".$_POST['matricula']."',".$rowMatri->idMaestro.",'1','E1',
					'".$_POST['msgTexto']."','".$_POST['msgArchivo']."',(SELECT CURDATE()));";
					$qry = mysqli_query($conex,$strqry);
				}else{
					$strqry = "INSERT INTO Mensajes(matricula,idMaestro,tipo,enviado,msgTexto,msgArchivo,fecha) 
					values('".$_POST['matricula']."',".$rowMatri->idMaestro.",'2','E1',
					'".$_POST['msgTexto']."','".$_POST['msgArchivo']."',(SELECT CURDATE()));";
					$qry = mysqli_query($conex,$strqry);
				}
?>
				<script language="javascript">
                    location.href="MensajesA.php";
                </script>
<?php
			}else{
				if(isset($_POST['matricula'])&&!empty($_POST['msgTexto'])){ //&&isset($_POST['tipo'])
					if(($_POST['matricula'])==$rowMtr->matricula){
						$strqry = "INSERT INTO Mensajes(matricula,idMaestro,tipo,enviado,msgTexto,fecha) 
						values('".$_POST['matricula']."',".$rowMatri->idMaestro.",'1','E1',
					'"	.$_POST['msgTexto']."',(SELECT CURDATE()));";
						$qry = mysqli_query($conex,$strqry);
					}else{
						$strqry = "INSERT INTO Mensajes(matricula,idMaestro,tipo,enviado,msgTexto,fecha) 
						values('".$_POST['matricula']."',".$rowMatri->idMaestro.",'2','E1',
						'".$_POST['msgTexto']."',(SELECT CURDATE()));";
						$qry = mysqli_query($conex,$strqry);
					}
?>
					<script language="javascript">
                        location.href="MensajesA.php";
                    </script>
<?php
			//$row = mysqli_fetch_object($qry);
				}
				?>
				<script language="javascript">
					alert('Su mensaje no pudo ser enviado, vuelva a intentar');
                    location.href="MensajesA.php";
                </script>
<?php
			}
		}else{
?>
            <h1 align="center">Mensaje nuevo</h1>
            <div class="container">
            <form action="MensajeNuevo.php" method="POST">
                <b><font face="Georgia" size="5" >Enviar a:</font></b>
                <div class="col-sm-6">
                <select name="matricula" class="custom-select sm-5">";
<?php
				while($r<$i){
					mysqli_data_seek($qryMtr,$r); //mueve el puntero a la fila especificada
					$row = mysqli_fetch_object($qryMtr); //obtiene los datos como un objeto
					print"<option value=\"$row->matricula\">".$row->nombre." ".$row->apPat." ".$row->apMat."</option>";
					$r++;
				}
?>
                </select><br />
                </div>
                <b><font face="Georgia" size="5" >Asunto:</font></b><br />
                <!--<input name="msgTexto" type="text" size="80" maxlength="500"><br />-->
                <textarea id="message" class="form-control"  name="msgTexto" rows="5" cols="60" maxlength="500"></textarea><br />
                <b><font face="Georgia" size="5" >Archivo:</font></b>
                <input name="msgArchivo" type="file"><br />
                <br>
                <div align="center"><input  class="btn btn-warning" name="submit" id="Mostaza" type="submit" value="Enviar mensaje"><br /></div>
            </form>
        </div>
        ";
<?php
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
<br>
<br>
<br>
       <form action="MensajesA.php">
         <input class="btn btn-warning" type="submit"  value="REGRESAR">
       </form>





</body>
</html>