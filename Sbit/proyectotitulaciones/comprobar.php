<?php  
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
	<?php  
session_start();
	if($_POST)
	{
			$_SESSION['usuario']=$_POST['usuario'];
			$_SESSION['password']=$_POST['password'];
			
			$conexion=mysqli_connect('localhost','root','','sbit')or die("No es Posible Conectar Con la Base De Datos");
			mysqli_select_db($conexion,"sbit");
			$strqry="select matricula from titulos where(
select a.matricula from usuarios u 
inner join personas p on u.idUsuario=p.idUsuario
inner join alumnos a on p.idPersona=a.idPersona where u.passwordd = '".$_SESSION['password']."';";
  			$qry=mysqli_query($conexion,$strqry);
  			
			if (!$qry)
           print "no puedes registrarte lo sentimos no estas titulado ".$strqry." fue fallida.<br>". mysqli_error()."<br>";
		   else{
        ?>         <script language="javascript">
            alert('Registrado satisfactoriamnete.');
            location.href = "../proyectotitulaciones/registrotitulacion.php";
			
           </script>
<?php
};
	}
mysqli_close($link);
?>	
</body>
</html>