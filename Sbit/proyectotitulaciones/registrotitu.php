<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="shortcut icon" href="egresados.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Registro</title>
</head>

<body>
<?php
include('conexionabd.php');
 if(isset($_POST['nombre']) && !empty ($_POST['nombre']) &&
 isset($_POST['paterno']) && !empty ($_POST['paterno']) &&
 isset($_POST['materno']) && !empty ($_POST['materno']) &&
 isset($_POST['curp']) && !empty ($_POST['curp']) &&
 isset($_POST['edad']) &&!empty ($_POST['edad']) &&
 isset($_POST['hm']) &&!empty ($_POST['hm']) &&
 isset($_POST['asesor']) && !empty ($_POST['asesor'])&&
 isset($_POST['externo']) && !empty ($_POST['externo'])&&
 isset($_POST['tipo']) && !empty ($_POST['tipo'])&&
 isset($_POST['fecha']) && !empty ($_POST['fecha']))
 {
$con = mysqli_connect($host,$user,$pass)or die("problemas al conectar");
mysqli_select_db($con, $db) or die ("problemas al conectar");
mysqli_query($con,"INSERT INTO registrotitu(nombre,appat,apmat,curp,edad,sexo,asesor,asesorexterno,tipotitu,fechatitu) VALUES('$_POST[nombre]','$_POST[paterno]','$_POST[materno]','$_POST[curp]','$_POST[edad]','$_POST[hm]','$_POST[asesor]','$_POST[externo]','$_POST[tipo]','$_POST[fecha]')");
echo'<script type="text/javascript">
        alert("formulario Guardado");
        window.location.href="titu.html";
        </script>';
 }else {
     echo "no se ha podido guardar los datos";
 }
 ?>
</body>
</html>