<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="shortcut icon" href="egresados.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Cuestionario para titulados </title>
</head>

<body>
<?php  
include('conexionabd.php');
 // recupera los datos del envío POST
/*
 $nombre = $_POST['nombre'];
 $matricula = $_POST['matricula'];
 $licenciatura = $_POST['licenciatura'];
 $email = $_POST['email'];
 $ocupacion = $_POST['ocupacion'];
 $direccion = $_POST['direccion'];
 $edad = $_POST['edad'];
*/
 
 // valida los datos enviados
 
 if(isset($_POST['nombre']) && !empty ($_POST['nombre']) &&
 isset($_POST['matricula']) && !empty ($_POST['matricula']) &&
 isset($_POST['licenciatura']) && !empty ($_POST['licenciatura'])&&
 isset($_POST['email']) && !empty ($_POST['email'])&&
 isset($_POST['nacido']) && !empty ($_POST['nacido'])&&
 isset($_POST['hm']) && !empty ($_POST['hm'])&&
 isset($_POST['ocupacion']) && !empty ($_POST['ocupacion'])&&
 isset($_POST['direccion']) && !empty ($_POST['direccion'])&&
 isset($_POST['edad']) &&!empty ($_POST['edad']))
 {
$con = mysqli_connect($host,$user,$pass)or die("problemas al conectar");
mysqli_select_db($con, $db) or die ("problemas al conectar");
mysqli_query($con,"INSERT INTO registroegresados (nombre,matricula,licenciatura,email,nacido,sexo,ocupacion,direccion,edad) VALUES('$_POST[nombre]','$_POST[matricula]','$_POST[licenciatura]','$_POST[email]','$_POST[nacido]','$_POST[hm]','$_POST[ocupacion]',' $_POST[direccion]','$_POST[edad]')");
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