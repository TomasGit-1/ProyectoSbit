<!--Niveles
	1.....Administrador
    2.....Maestro
    3.....Alumno
-->
<?php
	session_start();
	if($_POST)
	{
		$_SESSION['usuario']=$_POST['usuario'];
		$_SESSION['password']=$_POST['password'];
			
		$conexion=mysqli_connect('localhost','root','','SBIT')or die("No es Posible Conectar Con la Base De Datos");
		mysqli_select_db($conexion,"SBIT");
		$strqry="SELECT * FROM Usuarios WHERE passwordd='".$_SESSION['password']."' and  usuario='".$_SESSION['usuario']."' ;";
		$qry=mysqli_query($conexion,$strqry);
		$i=mysqli_num_rows($qry);
		if ($i > 0) 
		{
			//listar informacion
			$link = mysqli_connect ('localhost','root','','SBIT') or die ("No se logro la conexión ...");
			$db = mysqli_select_db ($link,"SBIT");
			$strqry = "SELECT nivel,usuario FROM Usuarios ORDER BY idUsuario;";
			$qry = mysqli_query ($link,$strqry);
			$i = mysqli_num_rows ($qry);
			$r = 0;
			$c = 0;
			$row = 0;
			while ($r < $i)
			{
				mysqli_data_seek ($qry, $r);
				$row = mysqli_fetch_object ($qry);
				$nivel=$row->nivel;
				$usuario=$row->usuario;
				//--------------------------------------------------------------------------------
				$strqryName = "SELECT p.nombre FROM Usuarios u INNER JOIN Personas p ON u.idUsuario=p.idUsuario WHERE u.usuario='".$_SESSION['usuario']."';";
				$qryName = mysqli_query ($link,$strqryName);
				$j = mysqli_num_rows ($qryName);
				$row = mysqli_fetch_object ($qryName);
				if ($j > 0)
				{
					$nombre=$row->nombre;
				// Elegir Nivel de Usuario 1 .... alumno   2 Docente

					if ($nivel==1 and $_SESSION['usuario']==$usuario)
					{
?>
						<script language="javascript">
							alert('Bienvenido Administrador  <?php print $nombre ?>') 
							location.href="Administrador.php";
                        </script>
<?php
					}
					else if ($nivel==2 and $_SESSION['usuario']==$usuario)
					{
?>
						<script language="javascript">
                            alert('Bienvenido Maestr@  <?php print $nombre ?>')
                        </script>
<?php		
					}
					else if ($nivel==3 and $_SESSION['usuario']==$usuario)
					{
?>
						<script language="javascript">
                            alert('Bienvenido Alumn@  <?php print $nombre ?>')
							location.href="Alumnos/Alumnos.php";
                        </script>
<?php
					}
					$r++;
				}
			}
		}
		else
		{
?>
			<script language="javascript">
				alert('Usuario o Contraseña Incorrecto');
				location.href="IniciarSesion.php";
			</script>
<?php 
		 	mysqli_close($conexion);
			session_unset();
			session_destroy();
		}
	}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SBIT LOGIN</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body  style=" background:#900">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

    <div  class="container text-center shadow-lg p-3 mb-5  rounded rounded border border-dark w-25" style=" position:relative;top:150px; background:#F1C40F;" >
        <form action=" " method="post" >
            <div>
                <img  src="Imagenes/UsuarioArriba.jpg" class="rounded-circle w-25 border border-dark "  />
            </div>
            <div class="form-group ">
                <input   type="text"  class="form-control" aria-describedby="usuarioHelp" placeholder="Usuario" name="usuario">
                <small id="usuarioHelp" class="form-text text-muted  text-left"  >Ingrese su Usuario</small>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Contraseña" name="password">
                <small id="usuarioHelp"  class="form-text text-muted text-left" >Ingrese su Contraseña</small>
            </div>
            <button type="submit" class="btn  btn-block btn-secondary">Entrar</button>
        </form>
    </div>
</body>
</html>