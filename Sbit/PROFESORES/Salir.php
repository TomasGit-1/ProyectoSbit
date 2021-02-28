<?php
	session_start();
?>
<!DOCTYPE>
<html >
<head>
<title>CerrarSesion</title>
</head>

<body>
<?php
	if(isset($_POST['usuario'])&&isset($_POST['password']))
	{
		$_SESSION['usuario'] = $_POST['usuario'];
		$_SESSION['password'] = $_POST['password']; 
	}
	if($_SESSION['usuario']&&$_SESSION['password']){
		$conex = mysqli_connect('localhost','root','','SBIT')or die("No se pudo conectar con la base de datos");
		mysqli_close($conex);
		session_unset();
		session_destroy();
?>
		<script language="javascript">
            alert('Sesion Cerrada');
            location.href="../IniciarSesion.php";
        </script>
<?php
	}

?>
</body>
</html>